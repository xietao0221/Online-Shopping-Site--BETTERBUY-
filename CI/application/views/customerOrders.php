<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/header.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/customerOrders.css'); ?>">
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-1.11.3.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/homeBETTERBUY.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/customerOrders.js'); ?>"></script>
    <title>Your Order Summary</title>
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
        <div class="pageFrameHeader">Your Orders</div>
<?php
for ($i=0; $i<sizeof($orderInformation); $i++) {
    echo '<div class="orderFrame">';
        echo '<div class="orderFrameHeader">';
            echo '<div class="orderPlaced">';
                echo '<div class="smallHeader">Order Placed</div>';
                echo '<div class="smallContent">' . $orderInformation[$i][0]['orderDate'] . '</div>';
            echo '</div>';

            echo '<div class="fragment"></div>';

            echo '<div class="orderTotal">';
                echo '<div class="smallHeader">Total</div>';
                echo '<div class="smallContent">$' . $orderInformation[$i][0]['total'] . '</div>';
            echo '</div>';

            echo '<div class="fragment"></div>';

            echo '<div class="orderShipTo">';
                echo '<div class="smallHeader">Ship To</div>';
                echo '<div class="smallContent" style="line-height:20px;">';
                echo $orderInformation[$i][0]['shippingName'] . ', ' . $orderInformation[$i][0]['shippingPhone'] . '<br>';
                echo $orderInformation[$i][0]['shippingAddress'];
                echo '</div>';
            echo '</div>';

            echo '<div class="fragment"></div>';

            echo '<div class="orderNumber">';
                echo '<div class="smallHeader">Order Number</div>';
                echo '<div class="smallContent"><a href="/CI/index.php/Productpurchase/customerOrdersDetail/' . $orderInformation[$i][0]['orderID'] . '">' . $orderInformation[$i][0]['orderID'] . '</a></div>';
            echo '</div>';
            echo '<div style="clear:both;"></div>';
        echo '</div>';


        echo '<div class="orderFrameContent">';
        for ($j=1; $j<sizeof($orderInformation[$i]); $j++) {
            echo '<img class="orderDetailImage" src="' . base_url() . 'assets/' . $orderInformation[$i][$j]['productImage'] . '">';
            echo 'Name: ' . $orderInformation[$i][$j]['productName'] . '&nbsp';
            echo 'Price: $' .  $orderInformation[$i][$j]['price'] . '&nbsp';
            echo 'Quantity: ' . $orderInformation[$i][$j]['quantity'] . '<br>';
        }
        echo '</div>';      //orderFrameContent
    echo '</div>';      //orderFrame
}
?>
</div>
</div>
</body>
</html>