<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Signupmodify extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Loginout_model');
        $this->load->model('Pagedisplay_model');
        $this->load->model('Signupmodify_model');
        $this->Loginout_model->validateCustomerLogin();
    }

    public function customerSignUp() {
        $data['categoryNameArrayForMenu'] = $this->Pagedisplay_model->getCategoryName();
        $this->load->view('customerSignUp', $data);
    }

    public function customerAddUser() {
        $data['inputEmail'] = $this->Signupmodify_model->filterCharacter($this->input->post('inputEmail'));
        $data['inputPassword'] = $this->Signupmodify_model->filterCharacter($this->input->post('inputPassword'));
        $data['inputFirstName'] = $this->Signupmodify_model->filterCharacter($this->input->post('inputFirstName'));
        $data['inputLastName'] = $this->Signupmodify_model->filterCharacter($this->input->post('inputLastName'));
        $data['inputGender'] = $this->Signupmodify_model->filterCharacter($this->input->post('inputGender'));
        $data['inputAddressLine1'] = $this->Signupmodify_model->filterCharacter($this->input->post('inputAddressLine1'));
        $data['inputAddressLine2'] = $this->Signupmodify_model->filterCharacter($this->input->post('inputAddressLine2'));
        $data['inputCity'] = $this->Signupmodify_model->filterCharacter($this->input->post('inputCity'));
        $data['inputState'] = $this->Signupmodify_model->filterCharacter($this->input->post('inputState'));
        $data['inputZipCode'] = $this->Signupmodify_model->filterCharacter($this->input->post('inputZipCode'));
        $data['inputTelephoneNumber'] = $this->Signupmodify_model->filterCharacter($this->input->post('inputTelephoneNumber'));
        $data['inputCardType'] = $this->Signupmodify_model->filterCharacter($this->input->post('inputCardType'));
        $data['inputCardNumber'] = $this->Signupmodify_model->filterCharacter($this->input->post('inputCardNumber'));
        $data['inputExpirationMonth'] = $this->Signupmodify_model->filterCharacter($this->input->post('inputExpirationMonth'));
        $data['inputExpirationYear'] = $this->Signupmodify_model->filterCharacter($this->input->post('inputExpirationYear'));
        $data['inputCVV'] = $this->Signupmodify_model->filterCharacter($this->input->post('inputCVV'));

        $data['addUserSuccess'] = $this->Signupmodify_model->customerAddUser($data);
        $this->load->view('customerSignUpResult', $data);
    }

    public function showCustomerAccount() {
        $data['categoryNameArrayForMenu'] = $this->Pagedisplay_model->getCategoryName();
        $data['editProfileArray'] = $this->Signupmodify_model->displayAccount();
        $this->load->view('customerAccount', $data);
    }

    public function customerModifyUser() {
        $data['inputEmail'] = $this->Signupmodify_model->filterCharacter($this->input->post('inputEmail'));
        $data['inputPassword'] = $this->Signupmodify_model->filterCharacter($this->input->post('inputPassword'));
        $data['inputFirstName'] = $this->Signupmodify_model->filterCharacter($this->input->post('inputFirstName'));
        $data['inputLastName'] = $this->Signupmodify_model->filterCharacter($this->input->post('inputLastName'));
        $data['inputGender'] = $this->Signupmodify_model->filterCharacter($this->input->post('inputGender'));
        $data['inputAddressLine1'] = $this->Signupmodify_model->filterCharacter($this->input->post('inputAddressLine1'));
        $data['inputAddressLine2'] = $this->Signupmodify_model->filterCharacter($this->input->post('inputAddressLine2'));
        $data['inputCity'] = $this->Signupmodify_model->filterCharacter($this->input->post('inputCity'));
        $data['inputState'] = $this->Signupmodify_model->filterCharacter($this->input->post('inputState'));
        $data['inputZipCode'] = $this->Signupmodify_model->filterCharacter($this->input->post('inputZipCode'));
        $data['inputTelephoneNumber'] = $this->Signupmodify_model->filterCharacter($this->input->post('inputTelephoneNumber'));
        $data['inputCardType'] = $this->Signupmodify_model->filterCharacter($this->input->post('inputCardType'));
        $data['inputCardNumber'] = $this->Signupmodify_model->filterCharacter($this->input->post('inputCardNumber'));
        $data['inputExpirationMonth'] = $this->Signupmodify_model->filterCharacter($this->input->post('inputExpirationMonth'));
        $data['inputExpirationYear'] = $this->Signupmodify_model->filterCharacter($this->input->post('inputExpirationYear'));
        $data['inputCVV'] = $this->Signupmodify_model->filterCharacter($this->input->post('inputCVV'));

        $data['modifyUserSuccess'] = $this->Signupmodify_model->customerModifyUser($data);
        $this->load->view('customerModifyResult', $data);
    }


}
?>