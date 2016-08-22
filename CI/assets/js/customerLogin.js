function customerLogIn() {
    var regexEmail = /\S+@\S+\.\S+/;
    var regexLetter = /^[a-zA-Z]+$/;
    var errMsg = '';

    var username = $('#customerLoginUserName').val();
    var password = $('#customerLoginPassword').val();
    if (username.length == 0 && password.length == 0) {
        alert('You need to input username and password.');
        return false;
    } else {
        if (username.length == 0) {
            alert('You need to input username');
            return false;
        } else if (password.length == 0) {
            alert('You need to input password');
            return false;
        } else {
            if (!username.match(regexEmail) || !password.match(regexLetter)) {
                errMsg = 'Invalid input';
                alert(errMsg);
                return false;
            } else {
                return true;
            }
        }
    }
}

function customerRegister() {
    var url = '/CI/index.php/Signupmodify/customerSignUp';
    $(location).attr('href',url);
}