function jumpToHome() {
    var url = '/CI/index.php/Pagedisplay/homepage';
    $(location).attr('href',url);
}

function jumpToCheckout(userID) {
    var table = document.getElementById('shoppingCartDetail');
    var length = table.rows.length;
    var quantity = new Array();
    var productID = new Array();
    var sendData = '';
    for (i=1; i<length; i++) {
        quantity[i-1] = parseInt(table.rows[i].cells[3].childNodes[1].value);
        productID[i-1] = table.rows[i].cells[3].childNodes[1].id;
        sendData += userID + '_' + productID[i-1] + '_' + quantity[i-1] + '_';
    }
    sendData = sendData.substring(0, sendData.length-1);
    if (length == 1) {
        alert('You did not buy anything.');
        return false;
    }
    var url = '/CI/index.php/Productpurchase/checkOut/' + sendData;
    $(location).attr('href',url);
    return true;
}

function saveCart(userID) {
    var table = document.getElementById('shoppingCartDetail');
    var length = table.rows.length;
    var quantity = new Array();
    var productID = new Array();
    var sendData = '';
    for (i=1; i<length; i++) {
        quantity[i-1] = parseInt(table.rows[i].cells[3].childNodes[1].value);
        productID[i-1] = table.rows[i].cells[3].childNodes[1].id;
        sendData += userID + '_' + productID[i-1] + '_' + quantity[i-1] + '_';
    }
    sendData = sendData.substring(0, sendData.length-1);
    var url = '/CI/index.php/Productpurchase/updateShoppingCart/' + sendData;
    $(location).attr('href',url);
}

function quantityMinus(price, productID) {
    if (productID.value > 1) {
        productID.value--;
        productID.parentNode.parentNode.childNodes[4].innerHTML = price * productID.value;
        var total = parseInt(document.getElementById('totalPriceNum').innerHTML);
        total -= price;
        $('#totalPriceNum').html(total);
        return true;
    } else {
        return false;
    }
}

function quantityAdd(price, productID, stock) {
    var num = parseInt(stock);
    if (productID.value < num) {
        productID.value++;
        productID.parentNode.parentNode.childNodes[4].innerHTML = price * productID.value;
        var total = parseInt(document.getElementById('totalPriceNum').innerHTML);
        total += price;
        $('#totalPriceNum').html(total);
        return true;
    } else {
        alert('You have ordered all of our product.');
        return false;
    }
}

function deleteProduct(productID) {
    var url = '/CI/index.php/Productpurchase/deleteCart/' + productID.id;
    $(location).attr('href',url);
}




$(document).ready(function() {
     if ($(document).width() >= 501 && $(document).width() <= 1000) {
         $('img.shoppingCartDisplay').css('width', $(document).width() * 0.2);
         $('img.shoppingCartDisplay').css('height', $('img.shoppingCartDisplay').width());
     }
});