<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/header.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/orderDetail.css'); ?>">
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-1.11.3.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/homeBETTERBUY.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/orderDetail.js'); ?>"></script>
    <title>Your Order Detail</title>
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
<div id="aaa" class="pageFrame">
    <div class="pageFrameHeader">
        Order Detail
    </div>

    <div class="shippingInformation">
        <?php
        echo $orderInformationDetail[0]['shippingName'] . ', ' . $orderInformationDetail[0]['shippingPhone'] . '<br>';
        echo $orderInformationDetail[0]['shippingAddress'];
        ?>
    </div>

    <div class="productTable">
        <table id="shoppingCartDetail">
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal($)</th>
            </tr>

            <?php
            $total = 0;
            for ($i=0; $i<sizeof($orderInformationDetail[1]); $i++) {
                echo '<tr>';
                echo '<th><img class="productImageDisplay" src="'. base_url() . 'assets/' . $orderInformationDetail[1][$i]['productImage'] . '"/></th>';
                echo '<th>' . $orderInformationDetail[1][$i]['productName'] . '</th>';
                echo '<th>' . $orderInformationDetail[1][$i]['price'] . '</th>';
                echo '<th>' . $orderInformationDetail[1][$i]['quantity'] . '</th>';
                echo '<th>' . $orderInformationDetail[1][$i]['quantity'] * $orderInformationDetail[1][$i]['price'] . '</th>';
                echo '</tr>';
            $total += $orderInformationDetail[1][$i]['quantity'] * $orderInformationDetail[1][$i]['price'];
            }
            ?>
        </table>
    </div>

    <div class="totalPrice">
        Total: <span style="color:#FC461E">$</span><span style="color:#FC461E" id="totalPriceNum"><?php echo $total; ?></span>
    </div>

    <div class="pageFrameFooter">
        <button class="normalButton" onclick="jumpToOrders()">Return To My Orders</button>
    </div>
</div>
</div>
</body>
</html>