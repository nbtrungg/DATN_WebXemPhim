$('#sapxepbang_danhmuc').sortable({
    placeholder:'ui-state-highlight',
    update:function(event,ui){
        var array_id=[];
        $('#sapxepbang_danhmuc tr').each(function(){
            array_id.push($(this).attr('id'));
        })
        // alert(array_id);
        $.ajax({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },
            url:"/sapxepbang-danhmuc",
            type:"POST",
            data:{array_id:array_id},
            success:function(data){
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Thay đổi thứ tự thành công!',
                    showConfirmButton: false,
                    timer: 1500
                    })
            }
        })
    }
});

$('#sapxepbang_theloai').sortable({
    placeholder:'ui-state-highlight',
    update:function(event,ui){
        var array_id=[];
        $('#sapxepbang_theloai tr').each(function(){
            array_id.push($(this).attr('id'));
        })
        // alert(array_id);
        $.ajax({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },
            url:"/sapxepbang-theloai",
            type:"POST",
            data:{array_id:array_id},
            success:function(data){
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Thay đổi thứ tự thành công!',
                    showConfirmButton: false,
                    timer: 1500
                    })
            }
        })
    }
});
$('#sapxepbang_quocgia').sortable({
    placeholder:'ui-state-highlight',
    update:function(event,ui){
        var array_id=[];
        $('#sapxepbang_quocgia tr').each(function(){
            array_id.push($(this).attr('id'));
        })
        // alert(array_id);
        $.ajax({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },
            url:"/sapxepbang-quocgia",
            type:"POST",
            data:{array_id:array_id},
            success:function(data){
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Thay đổi thứ tự thành công!',
                    showConfirmButton: false,
                    timer: 1500
                    })
            }
        })
    }
});