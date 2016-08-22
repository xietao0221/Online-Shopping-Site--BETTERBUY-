<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/header.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/showSingleProduct.css'); ?>">
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-1.11.3.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/homeBETTERBUY.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/showSingleProduct.js'); ?>"></script>
    <title>Single Product</title>
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
    <div id="singleProductFrame">
        <div class="productImageFrame">
            <div class="productImageBig">
                <?php
                echo '<img src="' . base_url() . '/assets/' . $productInformationArray[2]['image'] .'">';
                ?>
            </div>

            <div class="productImageSmall">
                <?php
                echo '<img src="' . base_url() . '/assets/' . $productInformationArray[2]['image'] .'">';
                ?>
            </div>
        </div>

        <div class="productChoose">
            <div class="productInformation">
                <?php
                if ($productInformationArray[1] == 0) {
                    echo '<span class="wordProductName">' . $productInformationArray[2]['productName'] . '</span><br>';
                    echo '<span class="wordProductPrice">$' . $productInformationArray[2]['productPrice'] . '</span><br>';
                    echo '<span class="wordStock">Stock: ' . $productInformationArray[2]['stock'] . '</span>';

                } else {
                    echo '<span class="wordProductName">' . $productInformationArray[2]['productName'] . '</span><br>';
                    echo '<span class="wordProductPrice">$' . $productInformationArray[2]['productSalesPrice'] . '</span>';
                    echo '&nbsp&nbsp&nbsp&nbsp<span class="wordSales1">$' . $productInformationArray[2]['productOriginalPrice'] . '</span>';
                    echo '<span class="wordSales2">&nbsp&nbsp&nbsp(' . (1 - $productInformationArray[2]['discount']) * 100 . '% Off)</span><br>';
                    echo '<span class="wordStock">Stock: ' . $productInformationArray[2]['stock'] . '</span>';
                }
                ?>
            </div>
            <div class="productNumber">
                <button onclick="return quantityMinus()">
                    <span class="quantityIcon"><i class="fa fa-minus-square-o"></i></span>
                </button>
                <input type="number" id="inputNumber" name="inputNumber" value="1" readonly/>
                <button onclick="quantityAdd('<?php echo $productInformationArray[2]['stock']; ?>')">
                    <span class="quantityIcon"><i class="fa fa-plus-square-o"></i></span>
                </button>
            </div>

            <div class="addToCartButton">
                <button onclick="addToCart('<?php echo $productInformationArray[2]['productID']; ?>', '<?php echo $_SESSION['customerLoginStatus']; ?>', '<?php echo $productInformationArray[0]; ?>')">Add To Cart</button>
            </div>

        </div>

        <div style="clear:both;"></div>

        <div class="productDescriptionFrame">
            <?php
            echo $productInformationArray[2]['description'];
            ?>
        </div>
    </div>
</div>
</body>
</html>