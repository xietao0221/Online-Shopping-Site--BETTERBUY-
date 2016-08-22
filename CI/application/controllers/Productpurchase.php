<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Productpurchase extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Loginout_model');
        $this->load->model('Pagedisplay_model');
        $this->load->model('Signupmodify_model');
        $this->load->model('Productpurchase_model');
        $this->Loginout_model->validateCustomerLogin();
    }

    public function customerOrder() {
        $data['categoryNameArrayForMenu'] = $this->Pagedisplay_model->getCategoryName();
        $data['orderInformation'] = $this->Productpurchase_model->showCustomerOrder();
        $this->load->view('customerOrders', $data);
    }

    public function customerOrdersDetail($orderIDPara) {
        $data['categoryNameArrayForMenu'] = $this->Pagedisplay_model->getCategoryName();
        $data['orderInformationDetail'] = $this->Productpurchase_model->showCustomerOrdersDetail($orderIDPara);
        $this->load->view('customerOrdersDetail', $data);
    }

    public function shoppingCart() {
        $data['categoryNameArrayForMenu'] = $this->Pagedisplay_model->getCategoryName();
        $data['shoppingCart'] = $this->Productpurchase_model->shoppingCart();
        $this->load->view('shoppingCart', $data);
    }

    public function customerAddProduct($productID, $purchaseQuantity) {
        $data['categoryNameArrayForMenu'] = $this->Pagedisplay_model->getCategoryName();
        $data['addToShoppingCart'] = $this->Productpurchase_model->customerAddProduct($productID, $purchaseQuantity);
        $data['recommendArray'] = $this->Productpurchase_model->recommendProduct($productID);
        $this->load->view('customerAddProduct', $data);
    }

    public function updateShoppingCart($sqlStatement) {
        $this->Productpurchase_model->updateShoppingCart($sqlStatement);
        redirect('Productpurchase/shoppingCart');
    }

    public function checkOut($sqlStatement) {
        $this->Productpurchase_model->updateShoppingCart($sqlStatement);
        $this->Productpurchase_model->checkOut();
        redirect('Productpurchase/customerOrder');
    }

    public function checkOutDirect() {
        $this->Productpurchase_model->checkOut();
        redirect('Productpurchase/customerOrder');
    }

    public function deleteCart($productID) {
        $this->Productpurchase_model->deleteCart($productID);
        redirect('Productpurchase/shoppingCart');
    }


}
?>