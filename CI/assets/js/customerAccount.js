function checkUpdate() {
    var inputEmail = $('[name=inputEmail]').val();
    var inputPassword = $('[name=inputPassword]').val();
    var inputConfirmPassword = $('[name=inputConfirmPassword]').val();
    var inputGender = $('[name=inputGender]').val();
    var inputFirstName = $('[name=inputFirstName]').val();
    var inputLastName = $('[name=inputLastName]').val();
    var inputAddressLine1 = $('[name=inputAddressLine1]').val();
    var inputAddressLine2 = $('[name=inputAddressLine2]').val();
    var inputCity = $('[name=inputCity]').val();
    var inputState = $('[name=inputState]').val();
    var inputZipCode = $('[name=inputZipCode]').val();
    var inputTelephoneNumber = $('[name=inputTelephoneNumber]').val();
    var inputCardType = $('[name=inputCardType]').val();
    var inputCardNumber = $('[name=inputCardNumber]').val();
    var inputExpirationMonth = $('[name=inputExpirationMonth]').val();
    var inputExpirationYear = $('[name=inputExpirationYear]').val();
    var inputCVV = $('[name=inputCVV]').val();

    var regexLetterNumber = /^\w+$/;
    var regexLetter = /^[a-zA-Z]+$/;
    var regexNumber = /^[0-9]*[1-9][0-9]*$/;
    var regexText = /[A-Za-z0-9 _.,!"'/$]*/;
    var regexFloat = /^(0(\.\d+)?|1(\.0+)?)$/;
    var regexEmail = /\S+@\S+\.\S+/;
    var errMsg = '';

    //Email
    $('#inputEmailErr').html('');
    if (inputEmail == '') {
        errMsg = 'Required.';
        $('#inputEmailErr').html(errMsg);
    } else if (!inputEmail.match(regexEmail)) {
        errMsg = 'Invalid Email.';
        $('#inputEmailErr').html(errMsg);
    }

    //password
    $('#inputPasswordErr').html('');
    if (inputPassword == '') {
        errMsg = 'Required.';
        $('#inputPasswordErr').html(errMsg);
    } else if (!inputPassword.match(regexLetter)) {
        errMsg = 'Only Letters.';
        $('#inputPasswordErr').html(errMsg);
    } else if (inputPassword.length >= 10) {
        errMsg = 'Too long';
        $('#inputPasswordErr').html(errMsg);
    }

    //password confirm
    $('#inputConfirmPasswordErr').html('');
    if (inputConfirmPassword == '') {
        errMsg = 'Required.';
        $('#inputConfirmPasswordErr').html(errMsg);
    } else if (inputConfirmPassword != inputPassword) {
        errMsg = 'No Match';
        $('#inputConfirmPasswordErr').html(errMsg);
    }

    //Gender
    $('#inputGenderErr').html('');
    if (inputGender == '') {
        errMsg = 'Required.';
        $('#inputGenderErr').html(errMsg);
    }

    //First Name
    $('#inputFirstNameErr').html('');
    if (inputFirstName == '') {
        errMsg = 'Required.';
        $('#inputFirstNameErr').html(errMsg);
    } else if (!inputFirstName.match(regexLetter)) {
        errMsg = 'Only Letters.';
        $('#inputFirstNameErr').html(errMsg);
    } else if (inputFirstName.length >= 10) {
        errMsg = 'Too long';
        $('#inputFirstNameErr').html(errMsg);
    }

    //Last Name
    $('#inputLastNameErr').html('');
    if (inputLastName == '') {
        errMsg = 'Required.';
        $('#inputLastNameErr').html(errMsg);
    } else if (!inputLastName.match(regexLetter)) {
        errMsg = 'Only Letters.';
        $('#inputLastNameErr').html(errMsg);
    } else if (inputLastName.length >= 10) {
        errMsg = 'Too long';
        $('#inputLastNameErr').html(errMsg);
    }

    //Address Line 1
    $('#inputAddressLine1Err').html('');
    if (inputAddressLine1 == '') {
        errMsg = 'Required.';
        $('#inputAddressLine1Err').html(errMsg);
    } else if (!inputAddressLine1.match(regexText)) {
        errMsg = 'Invalid.';
        $('#inputAddressLine1Err').html(errMsg);
    } else if (inputAddressLine1.length >= 20) {
        errMsg = 'Too long';
        $('#inputAddressLine1Err').html(errMsg);
    }

    //Address Line 2
    $('#inputAddressLine2Err').html('');
    if (inputAddressLine2 == '') {
        errMsg = 'Required.';
        $('#inputAddressLine2Err').html(errMsg);
    } else if (!inputAddressLine2.match(regexText)) {
        errMsg = 'Invalid.';
        $('#inputAddressLine2Err').html(errMsg);
    } else if (inputAddressLine2.length >= 20) {
        errMsg = 'Too long';
        $('#inputAddressLine2Err').html(errMsg);
    }

    //City
    $('#inputCityErr').html('');
    if (inputCity == '') {
        errMsg = 'Required.';
        $('#inputCityErr').html(errMsg);
    } else if (!inputCity.match(regexText)) {
        errMsg = 'Invalid.';
        $('#inputCityErr').html(errMsg);
    } else if (inputCity.length >= 20) {
        errMsg = 'Too long';
        $('#inputCityErr').html(errMsg);
    }

    //State
    $('#inputStateErr').html('');
    if (inputState == '') {
        errMsg = 'Required.';
        $('#inputStateErr').html(errMsg);
    } else if (!inputState.match(regexText)) {
        errMsg = 'Invalid.';
        $('#inputStateErr').html(errMsg);
    } else if (inputState.length >= 20) {
        errMsg = 'Too long';
        $('#inputStateErr').html(errMsg);
    }

    //Zip Code
    $('#inputZipCodeErr').html('');
    if (inputZipCode == '') {
        errMsg = 'Required.';
        $('#inputZipCodeErr').html(errMsg);
    } else if (!inputZipCode.match(regexNumber)) {
        errMsg = 'Only Numbers.';
        $('#inputZipCodeErr').html(errMsg);
    } else if (inputZipCode.length > 5) {
        errMsg = 'Too long';
        $('#inputZipCodeErr').html(errMsg);
    }

    //Telephone
    $('#inputTelephoneNumberErr').html('');
    if (inputTelephoneNumber == '') {
        errMsg = 'Required.';
        $('#inputTelephoneNumberErr').html(errMsg);
    } else if (!inputTelephoneNumber.match(regexNumber)) {
        errMsg = 'Only Numbers.';
        $('#inputTelephoneNumberErr').html(errMsg);
    } else if (inputTelephoneNumber.length > 11) {
        errMsg = 'Too long';
        $('#inputTelephoneNumberErr').html(errMsg);
    }

    //Credit Card Type
    $('#inputCardTypeErr').html('');
    if (inputCardType == '') {
        errMsg = 'Required.';
        $('#inputCardTypeErr').html(errMsg);
    }

    //Card Number
    $('#inputCardNumberErr').html('');
    if (inputCardNumber == '') {
        errMsg = 'Required.';
        $('#inputCardNumberErr').html(errMsg);
    } else if (!inputCardNumber.match(regexNumber)) {
        errMsg = 'Only Numbers.';
        $('#inputCardNumberErr').html(errMsg);
    } else if (inputCardNumber.length > 16) {
        errMsg = 'Invalid';
        $('#inputCardNumberErr').html(errMsg);
    }

    //Month
    $('#inputExpirationDateErr').html('');
    if (inputExpirationMonth == '' || inputExpirationYear == '') {
        errMsg = 'Required.';
        $('#inputExpirationDateErr').html(errMsg);
    }

    //CVV
    $('#inputCVVErr').html('');
    if (inputCVV == '') {
        errMsg = 'Required.';
        $('#inputCVVErr').html(errMsg);
    } else if (inputCVV.length != 3) {
        errMsg = 'Invalid';
        $('#inputCVVErr').html(errMsg);
    } else if (!inputCVV.match(regexNumber)) {
        errMsg = 'Only Numbers.';
        $('#inputCVVErr').html(errMsg);
    }

    if (errMsg == '') {
        return true;
    } else {
        alert('You need to check your input data.');
        return false;
    }
}