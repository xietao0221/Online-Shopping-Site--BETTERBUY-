$(document).ready(function() {
    if ($(document).width() <= 1000) {
        $('img.orderDetailImage').css('width', $(document).width() * 0.1);
        $('img.orderDetailImage').css('height', $('img.orderDetailImage').width());
    }
});