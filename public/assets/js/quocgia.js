$(document).ready(function () {
    $("#table_quocgia").DataTable({
        aLengthMenu: [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"],
        ],
    });
});
$(".deletequocgia").on("click", function () {
    // let table = new DataTable('#table_quocgia');
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
            $('#quocgia'+id).submit();
        }
    });
});

// const form = document.querySelector('.deletequocgia');

//   form.addEventListener('submit', (event) => {
//     event.preventDefault(); // Dừng submit form mặc định
//     // Hiển thị thông báo với SweetAlert2
//     Swal.fire({
//       title: 'Bạn có chắc chắn muốn submit?',
//       icon: 'warning',
//       showCancelButton: true,
//       confirmButtonText: 'Submit',
//       cancelButtonText: 'Hủy bỏ'
//     }).then((result) => {
//       if (result.isConfirmed) {
//         // Nếu người dùng chấp nhận, tiếp tục submit form
//         form.submit();
//       }
//     });
//   });