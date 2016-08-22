<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Pagedisplay extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Loginout_model');
        $this->load->model('Pagedisplay_model');
        $this->load->model('Signupmodify_model');
        $this->Loginout_model->validateCustomerLogin();
    }

    public function homepage() {
        $data['categoryNameArrayForMenu'] = $this->Pagedisplay_model->getCategoryName();
        $data['categoryNameArrayForImageFrame'] = $this->Pagedisplay_model->getCategoryNameArrayForImageFrame();
        $this->load->view('homeBETTERBUY', $data);
    }

    public function showSingleCategory($categoryNamePara) {
        $data['categoryNameArrayForMenu'] = $this->Pagedisplay_model->getCategoryName();
        $data['productArray'] = $this->Pagedisplay_model->showSingleCategory($categoryNamePara);
        $this->load->view('showSingleCategory', $data);
    }

    public function showSingleProduct($productIDPara) {
        $data['categoryNameArrayForMenu'] = $this->Pagedisplay_model->getCategoryName();
        $data['productInformationArray'] = $this->Pagedisplay_model->showSingleProduct($productIDPara);
        $this->load->view('showSingleProduct', $data);
    }

    public function keywordSearch($keywordPara) {
        $keywordPara = $this->Signupmodify_model->filterCharacter($keywordPara);
        $data['categoryNameArrayForMenu'] = $this->Pagedisplay_model->getCategoryName();
        $data['keywordSearch'] = $this->Pagedisplay_model->keywordSearch($keywordPara);
        $this->load->view('keywordSearch', $data);
    }
}
?>