<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/header.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/customerSignUp.css'); ?>">
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-1.11.3.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/homeBETTERBUY.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/customerSignUp.js'); ?>"></script>
    <title>Sign Up</title>
</head>
<body>
<div id="banner">
    <div id="logoField">
        <img src="<?php echo base_url('assets/picture/logo_betterbuy.png');?>">
    </div>

    <div id="menuField">
        <button>Products</button>
        <div id="subMenu">
            <?php
            for ($i=0; $i<sizeof($categoryNameArrayForMenu); $i++) {
                echo '<button onclick="jumpLocation(\'' . $categoryNameArrayForMenu[$i] . '\')">' . $categoryNameArrayForMenu[$i] . '</button>';
            }
            echo '<button onclick="jumpLocation(\'sales\')">Special Sales</button>';
            ?>
        </div>
        <div style="clear:both"></div>
    </div>

    <div id="searchField">
        <button type="submit" onclick="return searchSubmit()"><i class="fa fa-search"></i></button>
        <input type="text" id="searchItem" name="searchItem" placeholder="Search">
    </div>

    <div id="shoppingCartField">
        <button id="shoppingCartButton" onclick="ShowShoppingCart('<?php echo $_SESSION['customerLoginStatus']; ?>')">
            <i class="fa fa-shopping-cart"></i>
        </button>
    </div>

    <div id="signInUpField">
        <?php
        if ($_SESSION['customerLoginStatus'] == true) {     //already login
            echo '<button>' .
                $_SESSION['customerFirstName'] . '&nbsp<i class="fa fa-angle-down"></i></button>' .
                '<div id="subMenu1">' .
                '<button onclick="jumpToAccount()">Your Account</button>' .
                '<button onclick="jumpToOrders()">Your Orders</button>' .
                '<button onclick="return jumpToLogout()">Log Out</button></div>' .
                '<div style="clear:both;"></div>';
        } else {                                            //haven't login
            echo '<button id="signInUpButton">';
            echo '<i class="fa fa-user""></i>Sign In/Up';
            echo '</button>';
        }
        ?>
    </div>
</div>


<div id="content">
<div class="pageFrame">
    <div class="pageFrameHeader">
        Sign Up
    </div>

    <form name="customerRegisterForm" action="/CI/index.php/Signupmodify/customerAddUser" method="POST">
        <div class="pageFrameInformation">
            1. Enter Your Personal Information Below<br>
            <span class="wordNote">
                NOTE: Your name and billing address must be entered exactly as they appear on your credit card.
            </span>
        </div>

        <div class="inputField">
            <div class="inputLabel">Email Address<span>&nbsp*</span></div>
            <div class="inputArea">
                <input type="text" class="inputText" id="inputEmail" name="inputEmail"/>
            </div>
            <div class="inputErrorMessage" id="inputEmailErr"></div>
            <div style="clear:both"></div>


            <div class="inputLabel">Password<span>&nbsp*</span></div>
            <div class="inputArea">
                <input type="password" class="inputText" id="inputPassword" name="inputPassword"/>
            </div>
            <div class="inputErrorMessage" id="inputPasswordErr"></div>
            <div style="clear:both"></div>


            <div class="inputLabel">Confirm Password<span>&nbsp*</span></div>
            <div class="inputArea">
                <input type="password" class="inputText" id="inputConfirmPassword" name="inputConfirmPassword"/>
            </div>
            <div class="inputErrorMessage" id="inputConfirmPasswordErr"></div>
            <div style="clear:both"></div>


            <div class="inputLabel">Gender<span>&nbsp*</span></div>
            <div class="inputArea">
                <span class="radioStyle1">
                    <input type="radio" id="male" name="inputGender" value="Male" checked/>Male
                </span>
                <span class="radioStyle2">
                    <input type="radio" id="female" name="inputGender" value="Female">Female
                </span>
            </div>
            <div class="inputErrorMessage" id="inputGenderErr"></div>
            <div style="clear:both"></div>


            <div class="inputLabel">First Name<span>&nbsp*</span></div>
            <div class="inputArea">
                <input type="text" class="inputText" id="inputFirstName" name="inputFirstName"/>
            </div>
            <div class="inputErrorMessage" id="inputFirstNameErr"></div>
            <div style="clear:both"></div>


            <div class="inputLabel">Last Name<span>&nbsp*</span></div>
            <div class="inputArea">
                <input type="text" class="inputText" id="inputLastName" name="inputLastName"/>
            </div>
            <div class="inputErrorMessage" id="inputLastNameErr"></div>
            <div style="clear:both"></div>


            <div class="inputLabel">Address Line 1<span>&nbsp*</span></div>
            <div class="inputArea">
                <input type="text" class="inputText" id="inputAddressLine1" name="inputAddressLine1"/>
            </div>
            <div class="inputErrorMessage" id="inputAddressLine1Err"></div>
            <div style="clear:both"></div>


            <div class="inputLabel">Address Line 2<span>&nbsp*</span></div>
            <div class="inputArea">
                <input type="text" class="inputText" id="inputAddressLine2" name="inputAddressLine2"/>
            </div>
            <div class="inputErrorMessage" id="inputAddressLine2Err"></div>
            <div style="clear:both"></div>


            <div class="inputLabel">City<span>&nbsp*</span></div>
            <div class="inputArea">
                <input type="text" class="inputText" id="inputCity" name="inputCity"/>
            </div>
            <div class="inputErrorMessage" id="inputCityErr"></div>
            <div style="clear:both"></div>


            <div class="inputLabel">State<span>&nbsp*</span></div>
            <div class="inputArea">
                <input type="text" class="inputText" id="inputState" name="inputState"/>
            </div>
            <div class="inputErrorMessage" id="inputStateErr"></div>
            <div style="clear:both"></div>


            <div class="inputLabel">Zip Code<span>&nbsp*</span></div>
            <div class="inputArea">
                <input type="text" class="inputText" id="inputZipCode" name="inputZipCode"/>
            </div>
            <div class="inputErrorMessage" id="inputZipCodeErr"></div>
            <div style="clear:both"></div>


            <div class="inputLabel">Telephone Number<span>&nbsp*</span></div>
            <div class="inputArea">
                <input type="tel" class="inputText" id="inputTelephoneNumber" name="inputTelephoneNumber"/>
            </div>
            <div class="inputErrorMessage" id="inputTelephoneNumberErr"></div>
            <div style="clear:both"></div>
        </div>




        <div class="pageFrameInformation">
            2. Enter Your Credit Card Information Below<br>
        <span class="wordNote">
            NOTE: You can pay in the following ways:&nbsp
            <span style="font-size: 20px;"><i class="fa fa-cc-visa"></i>&nbsp<i class="fa fa-cc-mastercard"></i></span>
        </span>
        </div>


        <div class="inputField">
            <div class="inputLabel">Card Type<span>&nbsp*</span></div>
            <div class="inputArea">
                <span class="radioStyle1">
                    <input type="radio" id="visa" name="inputCardType" value="VISA" checked/>VISA
                </span>
                <span class="radioStyle2">
                    <input type="radio" id="masterCard" name="inputCardType" value="Master Card">Master Card
                </span>
            </div>
            <div class="inputErrorMessage" id="inputCardTypeErr"></div>
            <div style="clear:both"></div>


            <div class="inputLabel">Card Number<span>&nbsp*</span></div>
            <div class="inputArea">
                <input type="text" class="inputText" id="inputCardNumber" name="inputCardNumber"/>
            </div>
            <div class="inputErrorMessage" id="inputCardNumberErr"></div>
            <div style="clear:both"></div>


            <div class="inputLabel">Expiration Date<span>&nbsp*</span></div>
            <div class="inputArea">
                <select id="inputExpirationMonth" name="inputExpirationMonth">
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
                <select id="inputExpirationYear" name="inputExpirationYear">
                    <option value="2015">2015</option>
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                </select>
            </div>
            <div class="inputErrorMessage" id="inputExpirationDateErr"></div>
            <div style="clear:both"></div>


            <div class="inputLabel">CVV<span>&nbsp*</span></div>
            <div class="inputArea">
                <input type="text" class="inputText" id="inputCVV" name="inputCVV"/>
            </div>
            <div class="inputErrorMessage" id="inputCVVErr"></div>
            <div style="clear:both"></div>
        </div>

        <div class="submitButtonDiv">
            <button class="submitButton" type="submit" onclick="return checkRegister()">Register</button>
        </div>
    </form>
</div>
</div>
</body>
</html>