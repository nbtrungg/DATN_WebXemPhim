$(document).ready(function() {
    $("#login_user").validate({
        rules: {
            // email_user: "required",
            email_user: {
                required: true,
                email: true
            },
            pass_user: {
                required: true,
            }
        },
        messages: {
            // name: "Please enter your name",
            email_user: {
                required: "* Vui lòng nhập Email",
                email: "* Email không đúng định dạng"
            },
            pass_user: {
                required: "* Vui lòng nhập mật khẩu",
            }
        }
    });
});