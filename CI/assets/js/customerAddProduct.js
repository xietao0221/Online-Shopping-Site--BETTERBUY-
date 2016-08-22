function jumpToHome() {
    var url = '/CI/index.php/Pagedisplay/homepage';
    $(location).attr('href',url);
}

function jumpToShoppingCart() {
    var url = '/CI/index.php/Productpurchase/shoppingCart';
    $(location).attr('href',url);
}

function jumpToCheckout() {
    var url = '/CI/index.php/Productpurchase/checkOutDirect';
    $(location).attr('href',url);
}

function showProductDetail(productID) {
    var url = '/CI/index.php/Pagedisplay/showSingleProduct/' + productID;
    $(location).attr('href',url);
}


$(document).ready(function() {
    if ($(document).width() <= 500 ){
        $('.singleCategoryProductFrame').css('width', '50%');
        $('.singleCategoryProductFrame').css('height', $('.singleCategoryProductFrame').width());
    } else if ($(document).width() >= 501 && $(document).width() <= 1000) {
        $('img.shoppingCartImg').css('width', $(document).width() * 0.2);
        $('img.shoppingCartImg').css('height', $('img.shoppingCartImg').width());

        $('.singleCategoryProductFrame').css('width', '50%');
        $('.singleCategoryProductFrame').css('height', $('.singleCategoryProductFrame').width());
    }else {
        $('.singleCategoryProductFrame').css(
            {
                'width': '366px',
                'height': '366px'
            }
        );
    }
});