<style>
    .red-cell {
        color: red;
    }
    .blue-cell {
        color: blue;
    }
    th {
        font-weight: bold;
        color: rgb(162, 0, 255);
        text-transform: capitalize;
    }
    .user-row th:first-child,
    .movie-column th {
        writing-mode: vertical-lr;
        transform: rotate(180deg);
    }
</style>

<!-- Ma trận ban đầu -->
<h3>Ma trận ban đầu</h3>
<table>
    <thead>
        <tr>
            <th></th>
            @foreach ($users as $user)
                <th>{{ $user }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($movies as $movie)
            <tr>
                <th class="movie-column">{{ $movie }}</th>
                @foreach ($users as $user)
                    <td @if (isset($initialMatrix[$user]) && isset($initialMatrix[$user][$movie]) && is_numeric($initialMatrix[$user][$movie])) class="red-cell" @endif>
                        @if (isset($initialMatrix[$user]) && isset($initialMatrix[$user][$movie]))
                            {{ $initialMatrix[$user][$movie] }}
                        @else
                            ?
                        @endif
                    </td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Ma trận chuẩn hóa dữ liệu -->
<h3>Ma trận chuẩn hóa dữ liệu</h3>
<table>
    <thead>
        <tr>
            <th></th>
            @foreach ($users as $user)
                <th>{{ $user }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($movies as $movie)
            <tr>
                <th class="movie-column">{{ $movie }}</th>
                @foreach ($users as $user)
                    <td>
                        @if (isset($normalizedMatrix[$user]) && isset($normalizedMatrix[$user][$movie]))
                            @if ($normalizedMatrix[$user][$movie] != 0)
                                <span class="red-cell">{{ $normalizedMatrix[$user][$movie] }}</span>
                            @else
                                {{ $normalizedMatrix[$user][$movie] }}
                            @endif
                        @else
                            0
                        @endif
                    </td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Ma trận tính độ tương đồng -->
<h3>Ma trận tính độ tương đồng</h3>
<table>
    <thead>
        <tr>
            <th></th>
            @foreach ($users as $user)
                <th class="user-row">{{ $user }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user1)
            <tr>
                <th class="user-row">{{ $user1 }}</th>
                @foreach ($users as $user2)
                    <td>
                        @if (isset($similarityMatrix[$user1]) && isset($similarityMatrix[$user1][$user2]))
                            @if ($similarityMatrix[$user1][$user2] == 1)
                                <span class="blue-cell">{{ $similarityMatrix[$user1][$user2] }}</span>
                            @elseif ($similarityMatrix[$user1][$user2] != 0)
                                <span class="red-cell">{{ $similarityMatrix[$user1][$user2] }}</span>
                            @else
                                {{ $similarityMatrix[$user1][$user2] }}
                            @endif
                        @else
                            0
                        @endif
                    </td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Ma trận đề xuất -->
<h3>Ma trận đề xuất</h3>
<table>
    <thead>
        <tr>
            <th></th>
            @foreach ($users as $user)
                <th class="user-row">{{ $user }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($movies as $movie)
            <tr>
                <th class="movie-column">{{ $movie }}</th>
                @foreach ($users as $user)
                    <td>
                        @if (isset($recommendationMatrix[$user]) && isset($recommendationMatrix[$user][$movie]))
                            @if ($recommendationMatrix[$user][$movie] != 0)
                                <span class="red-cell">{{ $recommendationMatrix[$user][$movie] }}</span>
                            @else
                                {{ $recommendationMatrix[$user][$movie] }}
                            @endif
                        @else
                            0
                        @endif
                    </td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Ma trận đề xuất sau khi cộng lại với giá trị trung bình -->
{{-- <h3>Ma trận đề xuất hoàn thiện sau khi cộng lại với giá trị trung bình</h3>
<table>
    <thead>
        <tr>
            <th></th>
            @foreach ($users as $user)
                <th class="user-row">{{ $user }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($movies as $movie)
            <tr>
                <th class="movie-column">{{ $movie }}</th>
                @foreach ($users as $user)
                    <td>
                        @if (isset($recommendationMatrix1[$user]) && isset($recommendationMatrix1[$user][$movie]))
                            @if ($recommendationMatrix1[$user][$movie] != 0)
                                <span class="red-cell">{{ $recommendationMatrix1[$user][$movie] }}</span>
                            @else
                                {{ $recommendationMatrix1[$user][$movie] }}
                            @endif
                        @else
                            0
                        @endif
                    </td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table> --}}

{{-- Phim đề xuất --}}
<h3>Lọc các phim đã xem và đề xuất</h3>
@foreach($phimdexuat_sao as $phim)
    <p style="font-weight: bold; color: blue;">{{ $phim->id }}:{{ $phim->tieude }}</p>
@endforeach
