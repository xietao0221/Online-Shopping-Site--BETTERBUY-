<?php
if ($addUserSuccess == 'duplicate') {
    echo '<script type="text/javascript">';
    echo 'alert("Email has been existed, you need to change it.");';
    echo 'window.location.href = "/CI/index.php/Signupmodify/customerSignUp"';
    echo '</script>';
} else if ($addUserSuccess == 'success') {
    echo '<script type="text/javascript">';
    echo 'alert("You have successfully registered, please login.");';
    echo 'window.location.href = "/CI/index.php/Loginout/customerLogin"';
    echo '</script>';
}
?>