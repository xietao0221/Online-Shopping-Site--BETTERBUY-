<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Signupmodify_model extends CI_model {
    public function customerAddUser($data) {
        date_default_timezone_set("America/Los_Angeles");
        $userID = 'C' . date('mdGis');

        $string = 'SELECT userID FROM user WHERE userName="' . $data['inputEmail'] . '"';
        $query = $this->db->query($string);
        if ($query->num_rows() > 0) {     // Cannot use this username
            $addUserSuccess = 'duplicate';
            return $addUserSuccess;
        } else {
            $string = 'INSERT INTO user ' .
                '(userID, userType, userName, passWord) ' .
                'VALUE ' .
                '("' . $userID . '", "customer", "' . $data['inputEmail'] . '", MD5("' . $data['inputPassword'] . '"))';
            $this->db->query($string);

            $string = 'INSERT INTO customerProfile ' .
                '(userID, firstName, lastName, gender, addressLine1, addressLine2, city, state, zipCode, phone) ' .
                'VALUE' .
                '("' . $userID . '", "' . $data['inputFirstName'] . '", "' . $data['inputLastName'] . '", ' .
                '"' . $data['inputGender'] . '", "' . $data['inputAddressLine1'] . '", "' .
                $data['inputAddressLine2'] . '", ' .
                '"' . $data['inputCity'] . '", "' . $data['inputState'] .'", "' . $data['inputZipCode'] . '", ' .
                '"' . $data['inputTelephoneNumber'] . '")';
            $this->db->query($string);


            $string = 'INSERT INTO customerCreditCard ' .
                '(userID, cardType, cardNumber, expirationMonth, expirationYear, cvv) ' .
                'VALUE' .
                '("' . $userID . '", "' . $data['inputCardType'] . '", "' . $data['inputCardNumber'] . '", ' .
                '"' . $data['inputExpirationMonth'] . '", "' . $data['inputExpirationYear'] .
                '", "' . $data['inputCVV'] . '")';
            $this->db->query($string);

            $addUserSuccess = 'success';
            return $addUserSuccess;
        }
    }

    public function displayAccount() {
        $editProfileArray = array();
        $string = 'SELECT userID, userName FROM user WHERE userName="' . $_SESSION['customerUserName'] .'";';
        $query = $this->db->query($string);
        foreach ($query->result() as $row) {
            $inputEmail = $row->userName;
            $userID = $row->userID;
        }

        $string = 'SELECT firstName, lastName, gender, addressLine1, addressLine2, city, state, ' .
            'zipCode, phone FROM customerProfile ' .
            'WHERE userID="' . $userID .'";';
        $query = $this->db->query($string);
        foreach ($query->result() as $row) {
            $inputFirstName = $row->firstName;
            $inputLastName = $row->lastName;
            $inputGender = $row->gender;
            $inputAddressLine1 = $row->addressLine1;
            $inputAddressLine2 = $row->addressLine2;
            $inputCity = $row->city;
            $inputState = $row->state;
            $inputZipCode = $row->zipCode;
            $inputTelephoneNumber = $row->phone;
        }


        $string = 'SELECT cardType, cardNumber, expirationMonth, expirationYear, cvv FROM customerCreditCard ' .
            'WHERE userID="' . $userID .'";';
        $query = $this->db->query($string);
        foreach ($query->result() as $row)  {
            $inputCardType = $row->cardType;
            $inputCardNumber = $row->cardNumber;
            $inputExpirationMonth = $row->expirationMonth;
            $inputExpirationYear = $row->expirationYear;
            $inputCVV = $row->cvv;
        }
        $editProfileArray = array(
            'inputEmail' => $inputEmail,
            'userID' => $userID,
            'inputFirstName' => $inputFirstName,
            'inputLastName' => $inputLastName,
            'inputGender' => $inputGender,
            'inputAddressLine1' => $inputAddressLine1,
            'inputAddressLine2' => $inputAddressLine2,
            'inputCity' => $inputCity,
            'inputState' => $inputState,
            'inputZipCode' => $inputZipCode,
            'inputTelephoneNumber' => $inputTelephoneNumber,
            'inputCardType' => $inputCardType,
            'inputCardNumber' => $inputCardNumber,
            'inputExpirationMonth' => $inputExpirationMonth,
            'inputExpirationYear' => $inputExpirationYear,
            'inputCVV' => $inputCVV
        );
        return $editProfileArray;
    }

    public function customerModifyUser($data) {
        $userNameChange = false;
        $passwordChange = false;

        if ($_SESSION['customerUserName'] != $data['inputEmail']) {
            $userNameChange = true;
        }
        if ($_SESSION['customerPassword'] != MD5($data['inputPassword'])) {
            $passwordChange = true;
        }

        if ($userNameChange == true) {          //check whether you can use the new username or not
            $string = 'SELECT userID FROM user WHERE userName="' . $data['inputEmail'] . '"';
            $query = $this->db->query($string);
            if ($query->num_rows() > 0) {     // Cannot use this username
                $canUpdate = false;
                $modifyUserSuccess = 'duplicate';
            } else {
                $canUpdate = true;
            }
        } else {
            $canUpdate = true;
        }

        if ($canUpdate == true) {
            $string = 'SELECT userID FROM user WHERE userName="' . $_SESSION['customerUserName'] . '"';
            $query = $this->db->query($string);
            foreach ($query->result() as $row) {
                $userID = $row->userID;
            }

            $string = 'UPDATE user SET userName="' . $data['inputEmail'] .
                '", passWord=MD5("' . $data['inputPassword'] .
                '") WHERE userID="' . $userID . '"';
            $this->db->query($string);

            $string = 'UPDATE customerProfile SET firstName="' . $data['inputFirstName'] .
                '", lastName="' . $_POST['inputLastName'] .
                '", gender="' . $data['inputGender'] . '", addressLine1="' . $data['inputAddressLine1'] .
                '", addressLine2="' . $data['inputAddressLine2'] . '", city="' . $data['inputCity'] .
                '", state="' . $data['inputState'] . '", zipCode="' . $_POST['inputZipCode'] .
                '", phone="' . $data['inputTelephoneNumber'] . '" WHERE userID="' . $userID . '";';
            $this->db->query($string);

            $string = 'UPDATE customerCreditCard SET cardType="' . $data['inputCardType'] .
                '", cardNumber="' . $data['inputCardNumber'] . '", expirationMonth="' . $data['inputExpirationMonth'] .
                '", expirationYear="' . $data['inputExpirationYear'] . '", cvv="' . $data['inputCVV'] .
                '" WHERE userID="' . $userID . '";';
            $this->db->query($string);


                if ($userNameChange == true || $passwordChange == true) {
                    $modifyUserSuccess = 'loginAgain';
                } else {
                    $modifyUserSuccess = 'success';
                    $_SESSION['customerFirstName'] = $data['inputFirstName'];
                }
        }
        return $modifyUserSuccess;
    }

    public function filterCharacter($string) {
        $filterArray = array("&lt;", "&gt;", "&quot;", "&#039;", "&amp;", "<", ">", "\"", "'", "\\", "/", "&", ",", "=");
        $string = str_replace($filterArray, "", $string);
        $string = trim($string);
        $string = htmlspecialchars($string);
        return $string;
    }
}
?>