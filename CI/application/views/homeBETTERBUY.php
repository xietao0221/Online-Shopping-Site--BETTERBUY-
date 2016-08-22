<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/header.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/homeBETTERBUY.css'); ?>">
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-1.11.3.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/homeBETTERBUY.js'); ?>"></script>
    <title>Welcome To BETTERBUY</title>
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
    <div id="contentNormalProduct">
        <?php
        for ($i=0; $i<sizeof($categoryNameArrayForImageFrame); $i++) {
            $para1 = 'categoryImageImage' . $categoryNameArrayForImageFrame[$i][0];
            $para2 = 'categoryImageGrayPad' . $categoryNameArrayForImageFrame[$i][0];
            $para3 = 'categoryImageWords' . $categoryNameArrayForImageFrame[$i][0];
            $para4 = 'assets/' . $categoryNameArrayForImageFrame[$i][1];
            echo '<div class="categoryImage_frame" onmouseover="makeOpacity(\'' . $para1 . '\', \'' . $para2 . '\', \'' . $para3 . '\')" onmouseout="makeNormal(\'' . $para1 . '\', \'' . $para2 . '\', \'' . $para3 . '\')" onclick="jumpLocation(\'' . $categoryNameArrayForImageFrame[$i][0] . '\')">';
            echo '<div class="categoryImage_words" id="categoryImageWords' . $categoryNameArrayForImageFrame[$i][0] . '">' . $categoryNameArrayForImageFrame[$i][0] . '</div>';
            echo '<div class="categoryImage_grayPad" id="categoryImageGrayPad' . $categoryNameArrayForImageFrame[$i][0] . '"><img src="' . base_url($para4) . '" class="categoryImage_image" id="categoryImageImage' . $categoryNameArrayForImageFrame[$i][0] . '"/></div>';
            echo '</div>';
        }
        ?>
    </div>

    <div id="specialSalesProduct">
        <div class="categoryImage_frame" onmouseover="makeOpacity('categoryImageImageSales', 'categoryImageGrayPadSales', 'categoryImageWordsSales')" onmouseout="makeNormal('categoryImageImageSales', 'categoryImageGrayPadSales', 'categoryImageWordsSales')" onclick="jumpLocation('sales')">
            <div class="categoryImage_words" id="categoryImageWordsSales">Special Sales</div>
            <div class="categoryImage_grayPad" id="categoryImageGrayPadSales">
                <img src="<?php echo base_url('assets/picture/category_sales.jpg');?>" class="categoryImage_image" id="categoryImageImageSales"/>
            </div>
        </div>
    </div>
</div>
</body>
</html>