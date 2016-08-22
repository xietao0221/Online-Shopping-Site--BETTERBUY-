<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/header.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/shoppingCart.css'); ?>">
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-1.11.3.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/homeBETTERBUY.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/shoppingCart.js'); ?>"></script>
    <title>Shopping Cart</title>
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
        Shopping Cart
        <span class="wordHeader">Please click "Save Cart" to save changes before leaving this page.</span>
    </div>

    <div class="productTable">
        <table id="shoppingCartDetail">
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal($)</th>
                <th>Delete</th>
            </tr>
                <?php
                $totalPrice = 0;
                for ($i=0; $i<sizeof($shoppingCart); $i++) {
                    if ($shoppingCart[$i][0] == 1) {
                        echo '<tr>';
                        echo '<td><img class="shoppingCartDisplay" src="' . base_url() . '/assets/' . $shoppingCart[$i][1]['productImage'] . '"></td>';
                        echo '<td>' . $shoppingCart[$i][1]['productName'] . '</td>';
                        echo '<td>' . $shoppingCart[$i][1]['salesPrice'] . '</td>';

                        echo '<td>';
                        echo '<button class="purchaseNumButton" onclick="return quantityMinus('. $shoppingCart[$i][1]['salesPrice'] . ', ' . $shoppingCart[$i][1]['productID'] . ')"><i class="fa fa-minus-square-o"></i></button>';
                        echo '<input type="number" class="purchaseNum" id="' . $shoppingCart[$i][1]['productID'] . '" name="' . $shoppingCart[$i][1]['productID'] . '" value="' . $shoppingCart[$i][1]['quantity'] . '" readonly/>';
                        echo '<button class="purchaseNumButton" onclick="return quantityAdd('. $shoppingCart[$i][1]['salesPrice'] . ', ' . $shoppingCart[$i][1]['productID'] . ', ' . $shoppingCart[$i][1]['productQuantity'] . ')"><i class="fa fa-plus-square-o"></i></button>';
                        echo '</td>';

                        echo '<td>' . $shoppingCart[$i][1]['salesPrice'] * $shoppingCart[$i][1]['quantity'] . '</td>';
                        $totalPrice += $shoppingCart[$i][1]['salesPrice'] * $shoppingCart[$i][1]['quantity'];
                        echo '<td><button class="deleteButton" onclick="deleteProduct(' . $shoppingCart[$i][1]['productID'] . ')"><i class="fa fa-trash-o"></i></button></td>';
                        echo '</tr>';
                    } else {
                        echo '<tr>';
                        echo '<td><img class="shoppingCartDisplay" src="' . base_url() . '/assets/' . $shoppingCart[$i][1]['productImage'] . '"/></td>';
                        echo '<td>' . $shoppingCart[$i][1]['productName'] . '</td>';
                        echo '<td>' . $shoppingCart[$i][1]['productOriginalPrice'] . '</td>';

                        echo '<td>';
                        echo '<button class="purchaseNumButton" onclick="return quantityMinus('. $shoppingCart[$i][1]['productOriginalPrice'] . ', ' . $shoppingCart[$i][1]['productID'] . ')"><i class="fa fa-minus-square-o"></i></button>';
                        echo '<input type="number" class="purchaseNum" id="' . $shoppingCart[$i][1]['productID'] . '" name="' . $shoppingCart[$i][1]['productID'] . '" value="' . $shoppingCart[$i][1]['quantity'] . '" readonly/>';
                        echo '<button class="purchaseNumButton" onclick="return quantityAdd('. $shoppingCart[$i][1]['productOriginalPrice'] . ', ' . $shoppingCart[$i][1]['productID'] . ', ' . $shoppingCart[$i][1]['productQuantity'] . ')"><i class="fa fa-plus-square-o"></i></button>';
                        echo '</td>';

                        echo '<td>' . $shoppingCart[$i][1]['productOriginalPrice'] * $shoppingCart[$i][1]['quantity'] . '</td>';
                        $totalPrice += $shoppingCart[$i][1]['productOriginalPrice'] * $shoppingCart[$i][1]['quantity'];
                        echo '<td><button class="deleteButton" onclick="deleteProduct(' . $shoppingCart[$i][1]['productID'] . ')"><i class="fa fa-trash-o"></i></button></td>';
                        echo '</tr>';
                    }
                }
                ?>
        </table>
    </div>
    <div class="totalPrice">
        Total: <span style="color:#FC461E">$</span><span style="color:#FC461E" id="totalPriceNum"><?php echo $totalPrice; ?></span>
    </div>

    <div class="pageFrameFooter">
        <button class="normalButton" onclick="jumpToHome()">Continue Shopping</button>
        <button class="normalButton" onclick="saveCart('<?php echo $_SESSION['customerUserID']; ?>')">Save Cart</button>
        <button class="specialButton" onclick="return jumpToCheckout('<?php echo $_SESSION['customerUserID']; ?>')">Proceed to Checkout</button>
    </div>
</div>
</div>
</body>
</html>