        // Lấy id của người dùng hiện tại
        $userId = Auth::id();

        // Tìm tất cả các bộ phim đã được đánh giá bởi người dùng khác
        $otherUsers = DB::table('ratings')
            ->where('user_id', '<>', $userId)
            ->pluck('user_id')
            ->unique();

        // Tính tổng điểm đánh giá và số lượt đánh giá cho tất cả các bộ phim đã được đánh giá bởi người dùng khác
        $sums = DB::table('ratings')
            ->whereIn('user_id', $otherUsers)
            ->groupBy('movie_id')
            ->selectRaw('movie_id, SUM(rating) as sum, COUNT(*) as count')
            ->get();

        // Tạo một mảng chứa độ tương đồng giữa người dùng hiện tại và từng người dùng khác
        $similarities = [];

        foreach ($otherUsers as $otherUser) {
            // Tìm các bộ phim đã được đánh giá bởi cả người dùng hiện tại và người dùng khác
            $sharedMovies = DB::table('ratings')
                ->whereIn('user_id', [$userId, $otherUser])
                ->groupBy('movie_id')
                ->havingRaw('COUNT(*) = 2')
                ->pluck('movie_id');

            // Tính tổng điểm đánh giá của các bộ phim đã được đánh giá bởi cả người dùng hiện tại và người dùng khác
            $sum1 = DB::table('ratings')
                ->where('user_id', $userId)
                ->whereIn('movie_id', $sharedMovies)
                ->sum('rating');

            $sum2 = DB::table('ratings')
                ->where('user_id', $otherUser)
                ->whereIn('movie_id', $sharedMovies)
                ->sum('rating');

            // Tính độ tương đồng dựa trên tổng điểm đánh giá của các bộ phim chung
            $similarity = $sum1 * $sum2 > 0 ? ($sum1 * $sum2) / sqrt(pow($sum1, 2) + pow($sum2, 2)) : 0;

            // Lưu độ tương đồng vào mảng
            $similarities[$otherUser] = $similarity;
        }

        // Sắp xếp mảng độ tương đồng theo thứ tự giảm dần
        arsort($similarities);

        // Tạo một mảng chứa các bộ phim được đề xuất
        $recommendations = [];

        // Lặp qua các người dùng có độ tương đồng cao nhất với người dùng hiện tại để tìm các bộ phim họ đã đánh giá
        foreach ($similarities as $otherUser => $similarity) {
            // Bỏ qua các người dùng có độ tương đồng bằng 0
            if ($similarity == 0) {
                continue;
            }

            // Tìm các bộ phim được được đánh giá bởi người dùng này và chưa được người dùng hiện tại đánh giá
            $unratedMovies = DB::table('ratings')
                ->where('user_id', $otherUser)
                ->whereNotIn('movie_id', function ($query) use ($userId) {
                    $query->select('movie_id')
                        ->from('ratings')
                        ->where('user_id', $userId);
                })
                ->pluck('movie_id');
            // Lặp qua các bộ phim chưa được người dùng hiện tại đánh giá và tính điểm đề xuất dựa trên độ tương đồng và điểm đánh giá của người dùng khác
            foreach ($unratedMovies as $movie) {
                $weightedSum = 0;
                $similaritySum = 0;

                foreach ($otherUsers as $u) {
                    // Kiểm tra xem người dùng này đã đánh giá bộ phim này chưa
                    $rating = DB::table('ratings')
                        ->where('user_id', $u)
                        ->where('movie_id', $movie)
                        ->value('rating');

                    // Nếu người dùng đã đánh giá bộ phim này, tính điểm đề xuất dựa trên độ tương đồng và điểm đánh giá của người dùng này
                    if ($rating !== null) {
                        $weightedSum += $similarities[$u] * $rating;
                        $similaritySum += $similarities[$u];
                    }
                }

                // Nếu có ít nhất một người dùng khác đã đánh giá bộ phim này, tính điểm đề xuất và lưu vào mảng
                if ($similaritySum > 0) {
                    $recommendations[$movie] = $weightedSum / $similaritySum;
                }
            }
        }
        // Sắp xếp mảng đề xuất theo thứ tự giảm dần của điểm đề xuất
        arsort($recommendations);

        // Lấy ra 10 bộ phim có điểm đề xuất cao nhất và trả về cho người dùng
        $recommendedMovies = array_slice(array_keys($recommendations), 0, 10);

        return $recommendedMovies;