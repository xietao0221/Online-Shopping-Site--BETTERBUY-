<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Loginout extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Loginout_model');
        $this->load->model('Pagedisplay_model');
        $this->load->model('Signupmodify_model');
    }

    public function customerLogin() {
        $data['categoryNameArrayForMenu'] = $this->Pagedisplay_model->getCategoryName();
        if (isset($_POST['customerLoginUserName']) && isset($_POST['customerLoginPassword'])) {
            $customerUserNamePara =
                $this->Signupmodify_model->filterCharacter($this->input->post('customerLoginUserName'));
            $customerPasswordPara =
                $this->Signupmodify_model->filterCharacter($this->input->post('customerLoginPassword'));
            $data['errorMessage'] = $this->Loginout_model->customerLogIn($customerUserNamePara, $customerPasswordPara);
        } else {
            $data['errorMessage'] = '';
        }
        $this->load->view('customerLogin', $data);
    }

    public function customerLogOut() {
        $this->Loginout_model->customerLogOut();
        redirect('Pagedisplay/homepage');
    }
}
?>