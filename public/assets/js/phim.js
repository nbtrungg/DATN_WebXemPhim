$(document).ready(function () {
    $("#table_phim").DataTable({
        aLengthMenu: [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"],
        ],
    });
});
$(".deletephim").on("click", function () {
    // return confirm('Are you sure want to delete?');
    var id = $(this).data('id');
    event.preventDefault(); //this will hold the url
    Swal.fire({
        title: "Bạn có chắc chắn muốn xóa?",
        text: "Bạn sẽ không khôi phục lại được dữ liệu này!",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Đồng ý!",
    }).then((result) => {
        if (result.isConfirmed) {
            $('#'+id).submit();
        }
    });
});