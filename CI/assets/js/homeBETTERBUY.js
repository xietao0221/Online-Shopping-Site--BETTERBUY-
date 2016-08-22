$(document).ready(function() {
    $("#signInUpButton").click(function(){
        var url = "/CI/index.php/Loginout/customerLogin";
        $(location).attr('href',url);
    });

    $("#logoField").click(function(){
        var url = "/CI/index.php/Pagedisplay/homepage";
        $(location).attr('href',url);
    });

    $('#menuField').hover(
        function(){
            $('#subMenu').slideDown(200);
        },
        function(){
            $('#subMenu').slideUp(200);
        }
    );

    $('#signInUpField').hover(
        function(){
            $('#subMenu1').slideDown(200);
        },
        function(){
            $('#subMenu1').slideUp(200);
        }
    );
});

function ShowShoppingCart(status) {
    if (status == true) {
        var url = "/CI/index.php/Productpurchase/shoppingCart";
        $(location).attr('href',url);
    } else {
        alert('You need to login first.');
        var url = "/CI/index.php/Loginout/customerLogin";
        $(location).attr('href',url);
    }
}

function searchSubmit() {
    var keyWord = document.getElementById('searchItem').value;
    var regexLetter = /^[a-zA-Z]+$/;
    var errMsg = '';

    if (keyWord == '') {
        errMsg = 'You should input the keyword';
    } else if (!keyWord.match(regexLetter)) {
        errMsg = 'You can only input letters (no space).';
    }

    if (errMsg == '') {
        var url = '/CI/index.php/Pagedisplay/keywordSearch/' + keyWord;
        $(location).attr('href',url);
        return true;
    } else {
        alert(errMsg);
        return false;
    }
}


function jumpToAccount() {
    var url = '/CI/index.php/Signupmodify/showCustomerAccount';
    $(location).attr('href',url);
}

function jumpToOrders() {
    var url = '/CI/index.php/Productpurchase/customerOrder';
    $(location).attr('href',url);
}

function jumpLocation(categoryName) {
    var url = '/CI/index.php/Pagedisplay/showSingleCategory/' + categoryName;
    $(location).attr('href',url);
}

function jumpToLogout() {
    var retVal = confirm("Do you want to Log out ?");
    if( retVal == true ){
        var url = '/CI/index.php/Loginout/customerLogOut';
        $(location).attr('href',url);
    } else {
        return false;
    }
}

function makeOpacity(imgPara, grayPadPara, wordsPara) {
    $('#'+ imgPara).css('opacity', 0.5);
    $('#'+ grayPadPara).css('opacity', 1);
    $('#'+ wordsPara).css('visibility', 'visible');
}
function makeNormal(imgPara, grayPadPara, wordsPara) {
    $('#'+ imgPara).css('opacity', 1);
    $('#'+ grayPadPara).css('opacity', 1);
    $('#'+ wordsPara).css('visibility', 'hidden');
}

$(document).ready(function() {
    if ($(document).width() <= 600 ){
        $('.categoryImage_frame').css('width', '100%');
        $('.categoryImage_frame').css('height', $('.categoryImage_frame').width()*0.5454);
    } else if ($(document).width() >= 601 && $(document).width() <= 1100) {
        $('.categoryImage_frame').css('width', '50%');
        $('.categoryImage_frame').css('height', $('.categoryImage_frame').width()*0.5454);  //Category Picture display
    } else {
        $('.categoryImage_frame').css(
            {
                'width': '550px',
                'height': '300px'
            }
        );
    }
});