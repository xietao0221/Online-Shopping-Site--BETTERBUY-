function showProductDetail(productID) {
    var url = '/CI/index.php/Pagedisplay/showSingleProduct/' + productID;
    $(location).attr('href',url);
}

$(document).ready(function() {
    if ($(document).width() <= 500 ){
        $('.singleCategoryProductFrame').css('width', '50%');
        $('.singleCategoryProductFrame').css('height', $('.singleCategoryProductFrame').width());
    } else if ($(document).width() >= 501 && $(document).width() <= 1100) {
        $('.singleCategoryProductFrame').css('width', '33%');
        $('.singleCategoryProductFrame').css('height', $('.singleCategoryProductFrame').width());
    } else {
        $('.singleCategoryProductFrame').css(
            {
                'width': '366px',
                'height': '366px'
            }
        );
    }
});