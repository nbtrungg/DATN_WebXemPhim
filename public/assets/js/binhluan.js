$('#binhluan').click(function(e){
    e.preventDefault();
    let content=$('#binhluan-content').val();
    let user_id=$('#user_id').val();
    let phim_id=$('#phim_id').val();
    let tenbinhluan=$('#tenbinhluan').val();
    // console.log(d);
    $.ajax({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        },
        url:"/binhluan",
        type:"POST",
        
        data:{
            content: content,
            user_id: user_id,
            phim_id: phim_id,
        },
        success: function(response) {
            if (response.success) {
                // alert(response.message); 
                $('#binhluan-content').val('');
                // Thêm bình luận mới vào danh sách bình luận
                var binhluanmoi = '<div class="media">' +
                    '<div class="media-body">'+
                    '<h4 class="media-heading">'+tenbinhluan+'</h4>'+
                    '<p>'+content+'</p>'+
                    '<ul class="list-unstyled list-inline media-detail pull-left">'+
                    '<li style="color: black"><i style="color: black" class="fa fa-calendar"></i>'+response.ngay+'</li>'+
                    '</ul></div></div>';
                    $('#hienbinhluan').prepend(binhluanmoi);   
            } else {
                alert('Failed to add comment.');
            }
        }
    })
})