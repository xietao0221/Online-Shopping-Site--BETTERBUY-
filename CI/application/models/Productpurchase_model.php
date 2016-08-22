<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Productpurchase_model extends CI_model {
    public function showCustomerOrder() {
        $userID = $_SESSION['customerUserID'];
        $orderInformation = array();
        $i = 0;
        $string = 'SELECT orderID, orderDate, total, shippingName, shippingAddress, shippingPhone ' .
            'FROM orderSummary ' .
            'WHERE userID="' . $userID . '"';
        $querySummary = $this->db->query($string);
        foreach ($querySummary->result() as $rowSummary) {
            $j = 1;
            $orderInformation[$i][0] = array(
                'orderID' => $rowSummary->orderID,
                'orderDate' => $rowSummary->orderDate,
                'total' => $rowSummary->total,
                'shippingName' => $rowSummary->shippingName,
                'shippingPhone' => $rowSummary->shippingPhone,
                'shippingAddress' => $rowSummary->shippingAddress
            );

            $string = 'SELECT productID, price, quantity ' .
                'FROM orderDetail WHERE orderID="' . $rowSummary->orderID . '"';
            $queryDetail = $this->db->query($string);
            foreach ($queryDetail->result() as $rowDetail) {
                $string = 'SELECT productImage, productName ' .
                    'FROM product WHERE productID="' . $rowDetail->productID . '"';
                $queryProduct = $this->db->query($string);
                foreach ($queryProduct->result() as $rowProduct) {
                    $orderInformation[$i][$j] = array(
                        'productID' => $rowDetail->productID,
                        'productImage' => $rowProduct->productImage,
                        'productName' => $rowProduct->productName,
                        'price' => $rowDetail->price,
                        'quantity' => $rowDetail->quantity
                    );
                    $j++;
                }
            }
            $i++;
        }
        return $orderInformation;
    }

    public function showCustomerOrdersDetail($orderID) {
        $orderInformationDetail = array();
        $i = 0;
        $stringSummary = 'SELECT orderDate, total, shippingName, shippingAddress, shippingPhone FROM orderSummary ' .
            'WHERE orderID="' . $orderID . '"';
        $querySummary = $this->db->query($stringSummary);
        foreach ($querySummary->result() as $rowSummary) {
            $orderInformationDetail[0] = array(
                'orderID' => $orderID,
                'orderDate' => $rowSummary->orderDate,
                'total' => $rowSummary->total,
                'shippingName' => $rowSummary->shippingName,
                'shippingAddress' => $rowSummary->shippingAddress,
                'shippingPhone' => $rowSummary->shippingPhone
            );
        }

        $stringDetail = 'SELECT productID, price, quantity FROM orderDetail WHERE orderID="' . $orderID . '"';
        $queryDetail = $this->db->query($stringDetail);
        foreach ($queryDetail->result() as $rowDetail) {
            $stringProduct = 'SELECT productImage, productName FROM product WHERE productID="'
                . $rowDetail->productID . '"';
            $queryProduct = $this->db->query($stringProduct);
            foreach ($queryProduct->result() as $rowProduct) {
                $orderInformationDetail[1][$i] = array(
                    'productImage' => $rowProduct->productImage,
                    'productName' => $rowProduct->productName,
                    'price' => $rowDetail->price,
                    'quantity' => $rowDetail->quantity
                );
                $i++;
            }
        }
        return $orderInformationDetail;
    }

    public function shoppingCart() {
        $userID = $_SESSION['customerUserID'];
        $shoppingCart = array();
        $i = 0;
        $string = 'SELECT productID, quantity FROM shoppingCart WHERE userID="' . $userID . '";';
        $queryShoppingCart = $this->db->query($string);
        foreach ($queryShoppingCart->result() as $rowShoppingCart) {
            $string = 'SELECT salesType FROM product WHERE productID="' . $rowShoppingCart->productID . '"';
            $queryProduct = $this->db->query($string);
            foreach ($queryProduct->result() as $rowProduct) {
                if ($rowProduct->salesType == 1) {
                    $string = 'SELECT product.productImage, product.productName, sales.salesPrice, ' .
                        'product.productQuantity FROM product, sales WHERE ' .
                        'product.productID=sales.productID ' .
                        'AND product.productID="' . $rowShoppingCart->productID . '"';
                    $queryResult = $this->db->query($string);
                    foreach ($queryResult->result() as $rowResult) {
                        $shoppingCart[$i][0] = 1;
                        $shoppingCart[$i][1] = array(
                            'productID' => $rowShoppingCart->productID,
                            'productImage' => $rowResult->productImage,
                            'productName' => $rowResult->productName,
                            'salesPrice' => $rowResult->salesPrice,
                            'quantity' => $rowShoppingCart->quantity,
                            'productQuantity' => $rowResult->productQuantity
                        );
                    }
                } else {
                    $string = 'SELECT productImage, productName, productOriginalPrice, productQuantity ' .
                        'FROM product ' .
                        'WHERE productID="' . $rowShoppingCart->productID . '"';
                    $queryResult = $this->db->query($string);
                    foreach ($queryResult->result() as $rowResult) {
                        $shoppingCart[$i][0] = 0;
                        $shoppingCart[$i][1] = array(
                            'productID' => $rowShoppingCart->productID,
                            'productImage' => $rowResult->productImage,
                            'productName' => $rowResult->productName,
                            'productOriginalPrice' => $rowResult->productOriginalPrice,
                            'quantity' => $rowShoppingCart->quantity,
                            'productQuantity' => $rowResult->productQuantity
                        );
                    }
                }
                $i++;
            }
        }
        return $shoppingCart;
    }

    public function customerAddProduct($productID, $purchaseQuantity) {
        $userID = $_SESSION['customerUserID'];
        $addToShoppingCart = array();
        $string = 'SELECT productName, productOriginalPrice, salesType, productQuantity, productImage ' .
            'FROM product ' .
            'WHERE productID="' . $productID . '"';
        $query = $this->db->query($string);
        foreach ($query->result() as $row) {
            if ($row->salesType == 1) {
                $string = 'SELECT salesPrice FROM sales WHERE productID="' . $productID . '"';
                $query2 = $this->db->query($string);
                foreach ($query2->result() as $row2) {
                    $purchasePrice = $row2->salesPrice;
                    $addToShoppingCart[0] = 1;
                    $addToShoppingCart[1] = array(
                        'productID' => $productID,
                        'purchaseQuantity' => $purchaseQuantity,
                        'productImage' => $row->productImage,
                        'productName' => $row->productName,
                        'stock' => $row->productQuantity,
                        'purchasePrice' => $row2->salesPrice
                    );
                }
            } else {
                $addToShoppingCart[0] = 0;
                $addToShoppingCart[1] = array(
                    'productID' => $productID,
                    'purchaseQuantity' => $purchaseQuantity,
                    'productImage' => $row->productImage,
                    'productName' => $row->productName,
                    'stock' => $row->productQuantity,
                    'purchasePrice' => $row->productOriginalPrice
                );
            }
        }
        $string = 'INSERT INTO shoppingCart ' .
            '(userID, productID, quantity) ' .
            'VALUE ' .
            '("' . $userID . '", "' . $productID . '", "' . $purchaseQuantity . '")';
        $this->db->query($string);
        return $addToShoppingCart;
    }

    public function recommendProduct($productID) {
        date_default_timezone_set("America/Los_Angeles");
        $currentDate = date('Y-m-d');

        $productIDArray = array();
        $recommendArray = array();
        $i = 0;
        $string = 'SELECT orderID FROM orderDetail WHERE productID="' . $productID . '"';
        $queryRecommend = $this->db->query($string);
        foreach ($queryRecommend->result() as $rowRecommend) {
            $string = 'SELECT productID FROM orderDetail WHERE orderID="' . $rowRecommend->orderID . '" AND ' .
                'productID!="' . $productID . '"';
            $queryProduct = $this->db->query($string);
            foreach ($queryProduct->result() as $rowProduct){
                $productIDArray[$i] = $rowProduct->productID;
                $i++;
            }
        }
        $productIDArray = array_values(array_unique($productIDArray, SORT_STRING));

        if (sizeof($productIDArray) > 0) {
            for ($i=0; $i<sizeof($productIDArray); $i++) {
                $string = 'SELECT salesType FROM product WHERE productID="' . $productIDArray[$i] . '"';
                $query = $this->db->query($string);
                foreach ($query->result() as $row) {
                    if ($row->salesType == '1') {
                        $string = 'SELECT product.productID, product.productName, product.productOriginalPrice, product.productQuantity, product.productImage, sales.salesDiscount, sales.salesPrice, sales.salesStartDate, sales.salesEndDate FROM product, sales ' .
                            'WHERE product.productQuantity>=0 AND product.productID=sales.productID ' .
                            'AND product.productID="' . $productIDArray[$i] . '";';
                        $query1 = $this->db->query($string);
                        foreach ($query1->result() as $row1) {
                            if ($row1->productQuantity > 0 && $row1->salesStartDate <= $currentDate && $row1->salesEndDate >= $currentDate) {
                                $recommendArray[$i][0] = 1;
                                $recommendArray[$i][1] = array(
                                    'productID' => $row1->productID,
                                    'productName' => $row1->productName,
                                    'productImage' => $row1->productImage,
                                    'salesPrice' => $row1->salesPrice,
                                    'productOriginalPrice' => $row1->productOriginalPrice,
                                    'salesDiscount' => $row1->salesDiscount
                                );
                            }
                        }
                    } else {
                        // For Normal Category
                        $string = 'SELECT productID, productName, productOriginalPrice, productQuantity, productImage FROM product ' .
                            'WHERE product.productQuantity>=0 AND productID="' . $productIDArray[$i] . '"';
                        $query1 = $this->db->query($string);
                        foreach ($query1->result() as $row1) {
                            if ($row1->productQuantity > 0) {
                                $recommendArray[$i][0] = 0;
                                $recommendArray[$i][1] = array(
                                    'productID' => $row1->productID,
                                    'productName' => $row1->productName,
                                    'productImage' => $row1->productImage,
                                    'productOriginalPrice' => $row1->productOriginalPrice
                                );
                            }
                        }
                    }
                }
            }
        }
        return $recommendArray;
    }

    public function updateShoppingCart($sqlStatement) {
        $result = explode("_", $sqlStatement);
        $sql = Array();
        $i = 0;
        $j = 0;
        foreach ($result as $key => $value) {
            $sql[$i][$j] = $value;
            $j++;
            if ($j%3 == 0) {
                $i++;
                $j = 0;
            }
        }
        for ($i=0; $i<sizeof($sql); $i++) {
            $string = 'UPDATE shoppingCart SET quantity=' . $sql[$i][2] . ' WHERE userID="' .
                $sql[$i][0] . '" AND productID="' . $sql[$i][1] . '"';
            $this->db->query($string);
        }
    }

    public function checkOut() {
        date_default_timezone_set("America/Los_Angeles");
        $orderID = 'O' . date('mdGis');
        $orderDate = date('Y-m-d');
        $userID = $_SESSION['customerUserID'];
        $totalPrice = 0;

        $string = 'SELECT firstName, lastName, addressLine1, addressLine2, city, ' .
            'state, zipCode, phone FROM customerProfile ' .
            'WHERE userID="' . $userID . '";';
        $queryShipping = $this->db->query($string);
        foreach ($queryShipping->result() as $rowShipping) {
            $shippingName = $rowShipping->firstName . ' ' . $rowShipping->lastName;
            $shippingAddress = $rowShipping->addressLine1 . ', ' . $rowShipping->addressLine2 . ', ' .
                $rowShipping->city . ', ' . $rowShipping->state . '. ' . $rowShipping->zipCode . '.';
            $shippingPhone = $rowShipping->phone;
        }

        $string = 'SELECT productID, quantity FROM shoppingCart WHERE userID="' . $userID . '"';
        $queryShoppingCart = $this->db->query($string);
        foreach ($queryShoppingCart->result() as $rowShoppingCart) {       //INSERT INTO orderDetail
            $string = 'SELECT productOriginalPrice, salesType, purchasePrice, productQuantity, sellQuantity, profit FROM product WHERE productID="' . $rowShoppingCart->productID . '"';
            $queryPurchasePrice = $this->db->query($string);
            foreach ($queryPurchasePrice->result() as $rowPurchasePrice) {
                if ($rowPurchasePrice->salesType == 0) {
                    //Normal Product
                    $string = 'INSERT INTO orderDetail ' .
                        '(orderID, productID, price, purchasePrice, quantity)' .
                        'VALUE ' .
                        '("' . $orderID . '", "' . $rowShoppingCart->productID . '", ' .
                        $rowPurchasePrice->productOriginalPrice . ', ' .
                        $rowPurchasePrice->purchasePrice . ', ' . $rowShoppingCart->quantity . ')';
                    $this->db->query($string);
                    $totalPrice += $rowPurchasePrice->productOriginalPrice * $rowShoppingCart->quantity;

                    $string = 'UPDATE product SET productQuantity=' .
                        ($rowPurchasePrice->productQuantity - $rowShoppingCart->quantity) .
                        ', sellQuantity=' . ($rowPurchasePrice->sellQuantity + $rowShoppingCart->quantity) .
                        ', profit=' .
                        ($rowPurchasePrice->profit + $rowShoppingCart->quantity * ($rowPurchasePrice->productOriginalPrice - $rowPurchasePrice->purchasePrice)) .
                        ' WHERE productID="' . $rowShoppingCart->productID . '"';
                    $this->db->query($string);
                } else {
                    // Sales Product
                    $string = 'SELECT salesPrice FROM sales WHERE productID="' . $rowShoppingCart->productID . '"';
                    $querySales = $this->db->query($string);
                    foreach ($querySales->result() as $rowSales) {
                        $string = 'INSERT INTO orderDetail ' .
                            '(orderID, productID, price, purchasePrice, quantity)' .
                            'VALUE ' .
                            '("' . $orderID . '", "' . $rowShoppingCart->productID . '", ' . $rowSales->salesPrice . ', ' . $rowPurchasePrice->purchasePrice . ', ' . $rowShoppingCart->quantity . ')';
                        $this->db->query($string);
                        $totalPrice += $rowSales->salesPrice * $rowShoppingCart->quantity;

                        $string = 'UPDATE product SET productQuantity=' . ($rowPurchasePrice->productQuantity - $rowShoppingCart->quantity) . ', sellQuantity=' . ($rowPurchasePrice->sellQuantity + $rowShoppingCart->quantity) . ', profit=' . ($rowPurchasePrice->profit + $rowShoppingCart->quantity * ($rowSales->salesPrice - $rowPurchasePrice->purchasePrice)) . ' WHERE productID="' . $rowShoppingCart->productID . '"';
                        $this->db->query($string);
                    }
                }
            }
        }
        // INSERT INTO orderSummary
        $string = 'INSERT INTO orderSummary ' .
            '(orderID, userID, orderDate, total, shippingName, shippingAddress, shippingPhone)' .
            'VALUE ' .
            '("' . $orderID . '", "' . $userID . '", "' . $orderDate . '", ' . $totalPrice . ' , "' . $shippingName . '", "' . $shippingAddress . '", "' . $shippingPhone . '");';
        $this->db->query($string);

        // delete shoppingCart
        $string = 'DELETE FROM shoppingCart WHERE userID="' . $userID . '";';
        $this->db->query($string);
    }

    public function deleteCart($productID) {
        $string = 'DELETE FROM shoppingCart WHERE productID="' . $productID .
            '" AND userID="' . $_SESSION['customerUserID'] . '";';
        $this->db->query($string);
    }

}
?>