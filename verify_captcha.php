<?php
session_start();

$captcha = $_POST['captcha_text'];

if($captcha == $_SESSION['captcha_code']){
    echo "success";
}

?>