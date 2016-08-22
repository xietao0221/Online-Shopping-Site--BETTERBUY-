<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/header.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/customerLogin.css'); ?>">
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-1.11.3.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/homeBETTERBUY.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/customerLogin.js'); ?>"></script>
    <title>Log In | Sign Up</title>
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
<?php
if ($_SESSION['customerLoginStatus'] == true) {
    echo '<script style="text/javascript">';
    echo 'document.getElementById("signInUpField").innerHTML = "<button onmouseover=\"menuOpen(\'subMenu1\')\" onmouseout=\"menuCloseTime()\">' . $row['firstName'] .'&nbsp<i class=\"fa fa-angle-down\"></i></button><div id=\"subMenu1\" onmouseover=\"menuCancelCloseTime()\" onmouseout=\"menuCloseTime()\"><button onclick=\"jumpToAccount()\">Your Account</button><button onclick=\"jumpToOrders()\">Your Orders</button><button onclick=\"return jumpToLogout()\">Log Out</button></div><div style=\"clear:both\"></div>"';
    echo '</script>';

    // Jump to All Category
    echo "<script type='text/javascript'>";
    echo 'window.location.href="/CI/index.php/Pagedisplay/homepage"';
    echo "</script>";
}
?>

<div class="pageFrame">
    <div class="pageHeader">
        <div class="pageHeaderLeft">Sign In</div>
        <div class="pageHeaderRight"><i>No Best, Only BETTER!</i></div>
        <div style="clear:both"></div>
    </div>

    <div class="pageLoginFrame">
        <div class="verticalLineLeft">
            <div class="loginFrameInformation">Login with Your Email</div>
            <div class="loginForm">
                <form id="loginSubmitForm" name="loginSubmitForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <input type="text" id="customerLoginUserName" name="customerLoginUserName" placeholder="Email"/><br>
                    <input type="password" id="customerLoginPassword" name="customerLoginPassword" placeholder="Password"/><br>
                    <button type="submit" onclick="return customerLogIn()">Sign In</button>
                    <p class="errorMessage""><?php echo $errorMessage; ?></p>
                </form>
            </div>
        </div>
    </div>

    <div class="pageRegisterFrame">
        <div class="verticalLineRight">
            <div class="registerFrameInformation">
                Don't have an account?<br>
                <button onclick="customerRegister()">Sign Up</button>
            </div>
        </div>
    </div>
</div>

</div>
</body>
</html>