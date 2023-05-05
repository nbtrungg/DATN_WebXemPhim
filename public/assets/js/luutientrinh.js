// Khởi tạo biến để lưu ID của interval
var intervalId = null;
// var tapphim_id=$('#my-video').data("id");
// var currentTime = document.getElementsByTagName('video')[0].currentTime;
// var currentTime = this.currentTime;
// console.log(currentTime);
// Khởi tạo hàm để gửi Ajax request
function sendAjaxRequest() {
    // Lấy giá trị thời gian hiện tại của video
    const currentTime = document.getElementsByTagName('video')[0].currentTime;
    var tapphim_id=$('#my-video').data("id");
    
    // Gửi Ajax request để lưu giá trị currentTime vào database
    $.ajax({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        },
        method: 'POST',
        url: '/luutientrinh',
        data: { currentTime: currentTime, tapphim_id: tapphim_id },
        success: function(response) {
            console.log('Giá trị currentTime đã được lưu vào database');
        },
        error: function(error) {
            console.log('Lỗi khi gửi Ajax request');
        }
    });
}

// Khởi tạo hàm để bắt đầu gửi request cứ 10 giây một lần
function startSendingAjaxRequest() {
    // Bắt đầu gửi request ngay lúc đầu
    sendAjaxRequest();
    
    // Thiết lập interval để gửi request tiếp theo sau 10 giây
    intervalId = setInterval(function() {
        sendAjaxRequest();
    }, 10000); // 10 giây
}

// Khởi tạo hàm để dừng gửi request
function stopSendingAjaxRequest() {
    clearInterval(intervalId);
}

// Bắt đầu gửi request cứ 10 giây một lần khi video được play
const videos = document.getElementsByTagName('video')[0];
videos.addEventListener('play', function() {
    startSendingAjaxRequest();
});

// Dừng gửi request khi video được pause hoặc stop
videos.addEventListener('pause', function() {
    stopSendingAjaxRequest();
});

videos.addEventListener('ended', function() {
    stopSendingAjaxRequest();
});