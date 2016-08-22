<?php
if ($modifyUserSuccess == 'duplicate') {
    echo '<script type="text/javascript">';
    echo 'alert("Email has been existed, you need to change it.");';
    echo 'window.location.href = "/CI/index.php/Signupmodify/showCustomerAccount"';
    echo '</script>';
} else if ($modifyUserSuccess == 'loginAgain') {
    echo '<script type="text/javascript">';
    echo 'alert("You have successfully update your profile.\nBecuase you just change your Username or Password, please login again.");';
    echo 'window.location.href = "/CI/index.php/Loginout/customerLogOut"';
    echo '</script>';
} else if ($modifyUserSuccess == 'success') {
    echo '<script type="text/javascript">';
    echo 'alert("You have successfully update your profile.");';
    echo 'window.location.href = "/CI/index.php/Signupmodify/showCustomerAccount"';
    echo '</script>';
}
?>
