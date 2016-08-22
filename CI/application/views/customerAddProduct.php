<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/header.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/customerAddProduct.css'); ?>">
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-1.11.3.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/homeBETTERBUY.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/customerAddProduct.js'); ?>"></script>
    <title>Add To Your Shopping Cart</title>
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
        <i class="fa fa-check"></i>&nbsp1 item added to Shopping Cart
    </div>

    <div class="productTable">
        <table>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal($)</th>
            </tr>
            <tr>
                <td>
                    <?php
                    echo '<img class="shoppingCartImg" src="' . base_url() . '/assets/' . $addToShoppingCart[1]['productImage'] . '"></img>';
                    ?>
                </td>
                <td><?php echo $addToShoppingCart[1]['productName']; ?></td>
                <td><?php echo $addToShoppingCart[1]['purchasePrice']; ?></td>
                <td><?php echo $addToShoppingCart[1]['purchaseQuantity']; ?></td>
                <td><?php echo $addToShoppingCart[1]['purchaseQuantity'] * $addToShoppingCart[1]['purchasePrice']; ?></td>
            </tr>
        </table>
    </div>

    <div class="pageFrameFooter">
        <button class="normalButton" onclick="jumpToHome()">Continue Shopping</button>
        <button class="normalButton" onclick="jumpToShoppingCart()">Edit Your Cart</button>
        <button class="specialButton" onclick="jumpToCheckout()">Proceed to Checkout</button>
    </div>

    <div class="recommendProductFrame">
    <?php
        if (sizeof($recommendArray) > 0) {
            echo 'People Also buy: <br>';
            for ($i=0; $i<sizeof($recommendArray); $i++) {
                if ($recommendArray[$i][0] == 1) {
                    echo '<div class="singleCategoryProductFrame">';
                    echo '<div class="singleCategoryProductImage">';
                    echo '<img src="' . base_url() . '/assets/' . $recommendArray[$i][1]['productImage'] . '" onclick="showProductDetail(\'' . $recommendArray[$i][1]['productID'] . '\')">';
                    echo '</div>';
                    echo '<div class="singleCategoryProductInformation">';
                    echo '<b>' . $recommendArray[$i][1]['productName'] . '</b><br>';
                    echo '<span style="color:#E39027">$ ' . $recommendArray[$i][1]['salesPrice'] . '</span>';
                    echo '&nbsp&nbsp<span style="text-decoration: line-through;">$' . $recommendArray[$i][1]['productOriginalPrice'] . '</span>';
                    echo '&nbsp&nbsp(' . (1 - $recommendArray[$i][1]['salesDiscount']) * 100 . '% Off)';
                    echo '</div>';
                    echo '</div>';
                } else {
                    echo '<div class="singleCategoryProductFrame">';
                    echo '<div class="singleCategoryProductImage">';
                    echo '<img src="' . base_url() . '/assets/'  . $recommendArray[$i][1]['productImage'] . '" onclick="showProductDetail(\'' . $recommendArray[$i][1]['productID'] . '\')">';
                    echo '</div>';
                    echo '<div class="singleCategoryProductInformation">';
                    echo '<b>' . $recommendArray[$i][1]['productName'] . '</b><br>';
                    echo '<span style="color:#E39027">$ ' . $recommendArray[$i][1]['productOriginalPrice'] . '</span>';
                    echo '</div>';
                    echo '</div>';
                }
            }
        }
    ?>
    </div>
</div>
</div>
</body>
</html>