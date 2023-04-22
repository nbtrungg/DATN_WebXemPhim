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

$(document).ready(function() {
    $("#dk_user").validate({
        rules: {
            // email_user: "required",
            email_dk: {
                required: true,
                email: true,
                remote: {
                    headers:{
                        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/checkemail",
                    type: "post",
                    // data: {
                    //     '_token': $('meta[name="csrf-token"]').attr('content')
                    // }
                }
            },
            pass_dk: {
                required: true,
            },
            name: {
                required: true,
            },
            cfpass: {
                equalTo: "#registerPassword"
              },
        },
        messages: {
            // name: "Please enter your name",
            email_dk: {
                required: "* Vui lòng nhập Email",
                email: "* Email không đúng định dạng",
                remote: "Email đã được sử dụng"
            },
            pass_dk: {
                required: "* Vui lòng nhập mật khẩu",
            },
            name: {
                required: "* Vui lòng nhập họ và tên",
            },
            cfpass: {
                equalTo: "Mật khẩu không khớp"
              }
        }
    });
});