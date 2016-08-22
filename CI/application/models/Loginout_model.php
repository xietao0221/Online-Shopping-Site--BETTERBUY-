<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Loginout_model extends CI_model {
    public function validateCustomerLogin() {
        if(!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION['customerUserName']) && isset($_SESSION['customerPassword'])) {
            $string = "SELECT userType FROM user WHERE userName='" .
                $_SESSION['customerUserName'] . "' AND passWord= '" . $_SESSION['customerPassword'] . "';";
            $query = $this->db->query($string);
            if ($query->num_rows() == 0) {
                session_destroy();
                $_SESSION['customerLoginStatus'] = false;
            } else {
                foreach ($query->result() as $row) {
                    if ($row->userType !== 'customer') {
                        session_destroy();
                        $_SESSION['customerLoginStatus'] = false;
                    } else {
                        if (time() - $_SESSION['customerLoginTime'] > 300) {
                            session_destroy();
                            echo'
	                        <script type="text/javascript">
	                        window.alert("login time longer than 5 min");
	                        window.location.href="/CI/index.php/Pagedisplay/homepage";
	                        </script>
                            ';
                            $_SESSION['customerLoginStatus'] = false;
                        } else {
                            $_SESSION['customerLoginStatus'] = true;
                            $_SESSION['customerLoginTime'] = time();
                        }
                    }
                }
            }
        } else {
            $_SESSION['customerLoginStatus'] = false;
        }
    }

    public function customerLogIn($customerUserNamePara, $customerPasswordPara) {
        if (!$_SESSION) {
            session_start();
        }
        $errorMessage = '';
        $customerUserName = $customerUserNamePara;
        $customerPassword = md5($customerPasswordPara);

        $string = "SELECT userID, userType FROM user WHERE userName= ? AND passWord = ?";
        $query = $this->db->query($string, array($customerUserName, $customerPassword));

        if ($query->num_rows() == 0) {
            $errorMessage = 'Invalid Login';		//Don't tell users why they are wrong.
        } else {
            foreach ($query->result() as $row) {
                if ($row->userType == 'customer') {
                    $_SESSION['customerUserID'] = $row->userID;
                    $string = 'SELECT firstName FROM customerProfile WHERE userID="' . $row->userID . '"';
                    $query2 = $this->db->query($string);
                    foreach ($query2->result() as $row2) {
                        $_SESSION['customerUserName'] = $customerUserName;
                        $_SESSION['customerPassword'] = $customerPassword;
                        $_SESSION['customerLoginStatus'] = true;
                        $_SESSION['customerFirstName'] = $row2->firstName;
                        $_SESSION['customerLoginTime'] = time();
                    }
                } else {
                    $errorMessage = 'Invalid Login';
                }
            }
        }
        return $errorMessage;
    }

    public function customerLogOut() {
        if (!$_SESSION) {
            session_start();
        }
        session_destroy();
        $_SESSION['customerLoginStatus'] = false;
    }

}
?>