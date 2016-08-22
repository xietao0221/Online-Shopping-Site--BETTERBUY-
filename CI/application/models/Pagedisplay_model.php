<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Pagedisplay_model extends CI_model {
    public function getCategoryName() {
        $categoryNameArrayForMenu = array();
        $query = $this->db->query('SELECT categoryName FROM productCategory');
        foreach ($query->result() as $row) {
            $categoryNameArrayForMenu[] = $row->categoryName;
        }
        return $categoryNameArrayForMenu;
    }

    public function getCategoryNameArrayForImageFrame() {
        $categoryNameArrayForImageFrame = array();
        $query = $this->db->query('SELECT * FROM productCategory');
        foreach ($query->result() as $row) {
            $categoryNameArrayForImageFrame[] = array(
                $row->categoryName,
                $row->categoryImage
            );
        }
        return $categoryNameArrayForImageFrame;
    }

    public function showSingleCategory($categoryNamePara) {
        $productArray = array();
        $i = 0;
        $categoryName = $categoryNamePara;
        date_default_timezone_set("America/Los_Angeles");
        $currentDate = date('Y-m-d');
        if ($categoryName == 'sales') {
            $string = 'SELECT product.productID, product.productName, product.productOriginalPrice, ' .
                'product.productQuantity, product.productImage, sales.salesDiscount, sales.salesPrice, ' .
                'sales.salesStartDate, sales.salesEndDate FROM product, sales ' .
                'WHERE product.productQuantity>=0 AND product.salesType=1 ' .
                'AND product.productID=sales.productID AND product.productQuantity>0';
            $query = $this->db->query($string);
            foreach ($query->result() as $row) {
                if ($row->salesStartDate<=$currentDate && $row->salesEndDate>=$currentDate) {
                    $productArray[$i][0] = 'sales';
                    $productArray[$i][1] = 1;
                    $productArray[$i][2] = array(
                        'productID' => $row->productID,
                        'productName' => $row->productName,
                        'productImage' => $row->productImage,
                        'productOriginalPrice' => $row->productOriginalPrice,
                        'salesPrice' => $row->salesPrice,
                        'salesDiscount' => $row->salesDiscount
                    );
                    $i++;
                }
            }
        } else {
            $string = 'SELECT productID, productName, productOriginalPrice, productQuantity, productImage ' .
                'FROM product ' .
                'WHERE productCategory="' . $categoryName . '" AND productQuantity>=0 AND salesType=0 ' .
                'AND productQuantity>0';
            $query = $this->db->query($string);
            foreach ($query->result() as $row) {
                $productArray[$i][0] = 'Normal';
                $productArray[$i][1] = 0;
                $productArray[$i][2] = array(
                    'productID' => $row->productID,
                    'productName' => $row->productName,
                    'productImage' => $row->productImage,
                    'productOriginalPrice' => $row->productOriginalPrice
                );
                $i++;
            }

            $string = 'SELECT product.productID, product.productName, product.productOriginalPrice, ' .
                'product.productQuantity, product.productImage, sales.salesDiscount, sales.salesPrice, ' .
                'sales.salesStartDate, sales.salesEndDate ' .
                'FROM product, sales ' .
                'WHERE product.productCategory="' . $categoryName . '" AND product.productQuantity>=0 ' .
                'AND product.salesType=1 AND product.productID=sales.productID AND product.productQuantity>0';
            $query = $this->db->query($string);
            foreach ($query->result() as $row) {
                if ($row->salesStartDate<=$currentDate && $row->salesEndDate>=$currentDate) {
                    $productArray[$i][0] = 'Normal';
                    $productArray[$i][1] = 1;
                    $productArray[$i][2] = array(
                        'productID' => $row->productID,
                        'productName' => $row->productName,
                        'productImage' => $row->productImage,
                        'productOriginalPrice' => $row->productOriginalPrice,
                        'salesPrice' => $row->salesPrice,
                        'salesDiscount' => $row->salesDiscount
                    );
                    $i++;
                }
            }
        }
        return $productArray;
    }

    public function showSingleProduct($productIDPara) {
        $productInformationArray = array();
        $productID = $productIDPara;
        $string = 'SELECT salesType FROM product WHERE productID="' . $productID . '"';
        $query = $this->db->query($string);
        foreach ($query->result() as $row) {
            if ($row->salesType == 1) {
                $string = 'SELECT product.productName, product.productOriginalPrice, product.productQuantity, ' .
                    ' product.productImage, product.productDescription, sales.salesDiscount, sales.salesPrice ' .
                    'FROM product, sales ' .
                    'WHERE product.productID="' . $productID . '" AND product.productID=sales.productID;';
                $query2 = $this->db->query($string);
                foreach ($query2->result() as $row2) {
                    $productInformationArray[1] = 1;
                    $productInformationArray[2] = array(
                        'productID' => $productID,
                        'productName' => $row2->productName,
                        'productOriginalPrice' => $row2->productOriginalPrice,
                        'productSalesPrice' => $row2->salesPrice,
                        'discount' => $row2->salesDiscount,
                        'stock' => $row2->productQuantity,
                        'description' => $row2->productDescription,
                        'image' => $row2->productImage
                    );
                }
            } else {
                $string = 'SELECT productName, productOriginalPrice, productQuantity, ' .
                    'productDescription, productImage FROM product ' .
                    'WHERE productID="' . $productID . '"';
                $query2 = $this->db->query($string);
                foreach ($query2->result() as $row2) {
                    $productInformationArray[1] = 0;
                    $productInformationArray[2] = array(
                        'productID' => $productID,
                        'productName' => $row2->productName,
                        'productPrice' => $row2->productOriginalPrice,
                        'stock' => $row2->productQuantity,
                        'description' => $row2->productDescription,
                        'image' => $row2->productImage
                    );
                }
            }
        }

        // Check whether this people already add this product into his Cart
        if (isset($_SESSION['customerUserID'])) {
            $string = 'SELECT quantity FROM shoppingCart ' .
                'WHERE userID="' . $_SESSION['customerUserID'] . '" AND productID="' . $productID . '"';
            $query = $this->db->query($string);
            if ($query->num_rows() > 0) {
                $productInformationArray[0] = false;
            } else {
                $productInformationArray[0] = true;
            }
        } else {
            $productInformationArray[0] = false;        //debug
        }
        return $productInformationArray;
    }

    public function keywordSearch($keywordPara) {
        $keywordSearch = array();
        $keyword = $keywordPara;
        date_default_timezone_set("America/Los_Angeles");
        $currentDate = date('Y-m-d');
        $i = 0;

        $string = 'SELECT productID, salesType FROM product WHERE productName LIKE "%' . $keyword . '%";';
        $query = $this->db->query($string);
        foreach ($query->result() as $row) {
            if ($row->salesType == '1') {
                $string = 'SELECT product.productID, product.productName, product.productOriginalPrice, ' .
                    'product.productQuantity, product.productImage, sales.salesDiscount, ' .
                    'sales.salesPrice, sales.salesStartDate, sales.salesEndDate ' .
                    'FROM product, sales ' .
                    'WHERE product.productQuantity>=0 AND product.productID=sales.productID ' .
                    'AND product.productID="' . $row->productID . '" AND product.productQuantity>0';
                $query2 = $this->db->query($string);
                foreach ($query2->result() as $row2) {
                    if ($row2->salesStartDate <= $currentDate && $row2->salesEndDate >= $currentDate) {
                        $keywordSearch[$i][0] = 1;
                        $keywordSearch[$i][1] = array(
                            'productID' => $row->productID,
                            'productName' => $row2->productName,
                            'productImage' => $row2->productImage,
                            'productOriginalPrice' => $row2->productOriginalPrice,
                            'salesPrice' => $row2->salesPrice,
                            'salesDiscount' => $row2->salesDiscount
                        );
                        $i++;
                    }
                }
            } else {
                $string = 'SELECT productID, productName, productOriginalPrice, productQuantity, productImage ' .
                    'FROM product ' .
                    'WHERE productQuantity>=0 AND productID="' . $row->productID . '"';
                $query2 = $this->db->query($string);
                foreach ($query2->result() as $row2) {
                    $keywordSearch[$i][0] = 0;
                    $keywordSearch[$i][1] = array(
                        'productID' => $row->productID,
                        'productName' => $row2->productName,
                        'productImage' => $row2->productImage,
                        'productOriginalPrice' => $row2->productOriginalPrice,
                    );
                    $i++;
                }
            }
        }
        return $keywordSearch;
    }
}
?>