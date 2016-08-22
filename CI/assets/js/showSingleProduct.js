function quantityMinus() {
    var inputValue = parseInt($('#inputNumber').val());
    if (inputValue > 1) {
        $('#inputNumber').val(inputValue - 1);
        return true;
    } else {
        return false;
    }
}

function quantityAdd(stock) {
    var num = parseInt(stock);
    var inputValue = parseInt($('#inputNumber').val());
    if (inputValue < num) {
        $('#inputNumber').val(inputValue + 1);
        return true;
    } else {
        alert('You have ordered all of our product.');
        return false;
    }
}

function addToCart(productID, status, canAdd) {
    if (status == true) {
        if (canAdd == true) {
            var num = $('#inputNumber').val();
            var url = '/CI/index.php/Productpurchase/customerAddProduct/' + productID + '/' + num;
            $(location).attr('href',url);
        } else {
            alert('You already added this item, please check it in your Shopping Cart.');
            var url = '/CI/index.php/Productpurchase/shoppingCart';
            $(location).attr('href',url);
        }
    } else {
        alert('You need to login first.');
        var url = '/CI/index.php/Loginout/customerLogin';
        $(location).attr('href',url);
    }
}

$(document).ready(function() {
    if ($(document).width() <= 500 ){
        $('.productImageFrame').css('width', '60%');
        $('.productImageFrame').css('height', $('.productImageFrame').width());
    } else if ($(document).width() >= 501 && $(document).width() <= 900) {
        $('.productImageFrame').css('width', '50%');
        $('.productImageFrame').css('height', $('.productImageFrame').width());
    } else {
        $('.productImageFrame').css(
            {
                'width': '448px',
                'height': '448px'
            }
        );
    }
});