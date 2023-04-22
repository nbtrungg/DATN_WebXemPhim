$(document).ready(function(){
    $('#timkiem').keyup(function(){
        // alert('ok');
        $('#result').html('');
        var search=$('#timkiem').val();
        
        if(search != ''){
            $('#result').css('display','inherit')
            var expression =new RegExp(search,"i");
            // alert(expression);
            $.getJSON('/json_file/phim.json',function(data){
                $.each(data,function(key,value){
                    if(value.tieude.search(expression) != -1 || value.mota.search(expression) != -1){
                        $('#result').append('<li class="" style="cursor:pointer; display:flex;  align-items: center;"><img style="width: 50px;" src="/uploads/anhphim/'+value.hinhanh+'" alt=""><span style="    padding-left: 15px;">'+value.tieude+'</span></li>');
                    }
                })
            })
        }else{
            $('#result').css('display','none')

        }
    })
})

$('#result').on('click','li',function(){
    var click_text=$(this).text().split('->');
    $('#timkiem').val($.trim(click_text[0]));
    $('#result').html('');
    $('#result').css('display','none')
})
