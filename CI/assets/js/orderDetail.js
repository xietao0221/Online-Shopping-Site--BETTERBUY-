function jumpToOrders() {
    var url = '/CI/index.php/Productpurchase/customerOrder';
    $(location).attr('href',url);
}

$(document).ready(function() {
    if ($(document).width() <= 1000) {
        $('img.productImageDisplay').css('width', $(document).width() * 0.1);
        $('img.productImageDisplay').css('height', $('img.productImageDisplay').width());
    }
});