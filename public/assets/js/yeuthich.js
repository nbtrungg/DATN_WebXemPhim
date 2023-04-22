// $('.yeuthichphim').click(function(e){
$('#yeuthich').on('click', '.yeuthichphim', function(e) {
    e.preventDefault();
    $('#yeuthich a').remove();  
    var phim_id=$(this).data("phim_id");
    // console.log(phim_id);
    $.ajax({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        },
        url:"/yeuthich",
        type:"POST",
        data:{
            phim_id: phim_id,
        },
        success: function(response) {
            if (response.success) {
                // Swal.fire({
                //     position: 'top-end',
                //     icon: 'success',
                //     title: 'Phim đã được đưa vào danh mục yêu thích',
                //     showConfirmButton: false,
                //     timer: 1500,
                //     }).then((result) => {location.reload()})
                var binhluanmoi = '<a class="download-btn huyyeuthich" data-phim_id="'+phim_id+'" style="color:hsl(216, 22%, 18%); cursor: pointer; background:#e2d703;border: 1px solid var(--jet);">'+
                '<span>ĐÃ THÍCH</span>'+
                '<ion-icon name="heart-circle-outline"></ion-icon>'+
                '</a>';
                    $('#yeuthich').append(binhluanmoi);  
            } else {
                alert('Yêu thích k thành công');
            }
        }
    })
})
// hủy yêu thích
// $('.huyyeuthich').click(function(e){
    $('#yeuthich').on('click', '.huyyeuthich', function(e) {
    e.preventDefault();
    $('#yeuthich a').remove();  
    var phim_id=$(this).data("phim_id");
    // console.log(phim_id);
    $.ajax({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        },
        url:"/huyyeuthich",
        type:"POST",
        data:{
            phim_id: phim_id,
        },
        success: function(response) {
            if (response.success) {
                // Swal.fire({
                //     position: 'top-end',
                //     icon: 'success',
                //     title: 'Bạn đã bỏ yêu thích phim',
                //     showConfirmButton: false,
                //     timer: 1500,
                //     }).then((result) => {location.reload()})
                var binhluanmoi = '<a class="download-btn yeuthichphim" data-phim_id="'+phim_id+'" style="color:#e2d703; cursor: pointer; background:hsl(216, 22%, 18%);border: 1px solid var(--jet);">'+
                '<span>YÊU THÍCH</span>'+
                '<ion-icon name="heart-circle-outline"></ion-icon>'+
                '</a>';
                    $('#yeuthich').append(binhluanmoi);
            } else {
                alert('Bỏ yêu thích không thành công');
            }
        }
    })
})