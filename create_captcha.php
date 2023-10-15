<?php

session_start();

$permitted_chars ='abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUWXYZ';

function generate_string($input, $strength=''){
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++){
        $random_character = $input[mt_rand(0, $input_length -1)];
        $random_string.= $random_character;
    }
    return $random_string;
}

$captcha_code = generate_string($permitted_chars,6);

$_SESSION['captcha_code'] = $captcha_code;

header('Content-Type: image/png');

$image = imagecreatetruecolor(180, 40);

$background_color = imagecolorallocate($image, 180,43,226);

$text_color = imagecolorallocate($image, 255, 255, 255);

imagefilledrectangle($image, 0 ,0 ,180, 40, $background_color);

$font = dirname(__FILE__).'/arial.ttf';

imagettftext($image, 20, 0, 40, 30, $text_color, $font, $captcha_code);

imagepng($image);

imagedestroy($image);

?>