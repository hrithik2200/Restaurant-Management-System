<?php
include '../includes/connect.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';
$success=false;

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

$result = mysqli_query($con, "SELECT * FROM users WHERE username='$username' AND password='$password' AND role='Administrator' AND not deleted;");
while($row = mysqli_fetch_array($result))
{
	$success = true;
	$user_id = $row['id'];
	$name = $row['name'];
	$role= $row['role'];
}
if($success == true)
{	
	session_start();
	$_SESSION['admin_sid']=session_id();
	$_SESSION['user_id'] = $user_id;
	$_SESSION['role'] = $role;
	$_SESSION['name'] = $name;

	header("location: ../admin-page.php");
}
else
{
	$result = mysqli_query($con, "SELECT * FROM users WHERE username='$username' AND email='$email' AND password='$password' AND role='Customer' AND not deleted;");
	while($row = mysqli_fetch_array($result))
	{
	$success = true;
	$user_id = $row['id'];
	$name = $row['name'];
	$email = $row['email'];
	$role= $row['role'];
	}
	if($success == true)
	{
		session_start();
		$captcha = $_POST['captcha_text'];

		// if($captcha == $_SESSION['captcha_code']){
    	// 	echo "success";	
		$_SESSION['customer_sid']=session_id();
		$_SESSION['user_id'] = $user_id;
		$_SESSION['role'] = $role;
		$_SESSION['name'] = $name;
		$userDetails = mysqli_fetch_assoc($result);
		$_SESSION["user"] = $userDetails['username'];
		$_SESSION['LAST_ACTIVITY'] = time();
// 		$otp = rand(100000, 999999);
// 		$headers = "MIME-Version: 1.0" . "\r\n";
// 		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
// 		$headers .= 'From: support@webdamn.com' . "\r\n";
// 		$messageBody = "One Time Password for login authentication is: " . $otp;
// 		 $mail = new PHPMailer(true);
//    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
//    $mail->SMTPDebug = 4; 
//     $mail->isSMTP();                                            // Send using SMTP
//     $mail->Host       = 'smpt.office365.com';                    // Set the SMTP server to send through
//     $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
//     $mail->Username   = 'user@example.com';                     // SMTP username
//     $mail->Password   = '';                               // SMTP password
//     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
//     $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

//     $mail->IsHTML(true);
// 		$messageBody = wordwrap($messageBody,70);
// 		 $mail->setFrom('hrithikdhoka@gmail.com', 'Mailer');
// 		$mail->AddReplyTo('hrithikdhoka02@gmail.com','Dhoka');
// 		$mail->AddAddress($email);
// 		$mail->Subject = "OTP to Login";
// 		$mail->MSGHTML($messageBody);
// 		$mailStatus	= $mail->Send();	
// 		if($mailStatus == 1) {
// 			$insertQuery = "INSERT INTO authentication(otp,	expired, created) VALUES ('".$otp."', 0, '".date("Y-m-d H:i:s")."')";
// 			$result = mysqli_query($conn, $insertQuery);
// 			$insertID = mysqli_insert_id($conn);
// 			if(!empty($insertID)) {
// 				header("Location:verify.php");
// 			}
// 		}
		
		
	header("location: ../index.php");		
	}
//}
	else
	{
		header("location: ../login.php");
	}
}
?>