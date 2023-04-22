function remove_background(movie_id)
{
 for(var count = 1; count <= 5; count++)
 {
  $('#'+movie_id+'-'+count).css('color', '#ccc');
 }
}

//hover chuột đánh giá sao
$(document).on('mouseenter', '.rating', function(){
 var index = $(this).data("index");
 var movie_id = $(this).data('movie_id');
// alert(index);
// alert(movie_id);
 remove_background(movie_id);
 for(var count = 1; count<=index; count++)
 {
  $('#'+movie_id+'-'+count).css('color', '#ffcc00');
 }
});
//nhả chuột ko đánh giá
$(document).on('mouseleave', '.rating', function(){
 var index = $(this).data("index");
 var movie_id = $(this).data('movie_id');
 var rating = $(this).data("rating");
 remove_background(movie_id);
 //alert(rating);
 for(var count = 1; count<=rating; count++)
 {
  $('#'+movie_id+'-'+count).css('color', '#ffcc00');
 }
});

//click đánh giá sao
$(document).on('click', '.rating', function(){
  
     var index = $(this).data("index");
     var movie_id = $(this).data('movie_id');
 
     $.ajax({
      url:"/danhgiasao",
      method:"POST",
      data:{index:index, movie_id:movie_id},
        headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
      success:function(data)
      {
       if(data == 'done')
       {
        
        // alert("Bạn đã đánh giá &nbsp "+ index +" &nbsp trên 5");
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Bạn đã đánh giá ' +index +' trên 5 sao',
            showConfirmButton: false,
            timer: 1500,
            }).then((result) => {location.reload()})
            
        

       }else if(data =='exist'){
        //  alert("Bạn đã đánh giá phim này rồi,cảm ơn bạn nhé");
        Swal.fire({
            position: 'top-end',
            icon: 'warning',
            title: 'Bạn đã đánh giá phim này rồi, cảm ơn bạn nhé!',
            showConfirmButton: false,
            timer: 1500,
            })
       }
       else
       {
        alert("Lỗi đánh giá");
       }
       
      }
     });
   
   
     
});