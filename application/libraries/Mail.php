<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mail { 


function send($body,$to,$from,$subject,$attach = null,$tocc=null){ 
// 	// echo SWIFT; exit;
$CI = & get_instance();
$websiteData = $CI->session->userdata(WebSiteSession);
require_once SWIFT."swift_required.php"; 

if(isset($from) && $from  != ''){
	$from;                                                             //as given
}else{
	$from = array($websiteData->FromEmail => trim($websiteData->FromEmail)); //admin
}

if(isset($to) && $to  != ''){
	$to;                                                               //as given
}else{
	$to =$websiteData->FromEmail;                                      //admin
}


$transport = Swift_SmtpTransport::newInstance($websiteData->MailHost,$websiteData->MailPort);
$transport->setUsername($websiteData->MailUserName);
$transport->setPassword($websiteData->MailPassword);
$swift = Swift_Mailer::newInstance($transport);

$message = new Swift_Message($subject);
$message->setFrom($from);
$message->setBody($body, 'text/html');
$message->setTo($to);
if($attach != null){
$base_url=base_url();
	 $message->attach(Swift_Attachment::fromPath("$base_url/assets/adminfiles/letters/$attach"));
}

		if($tocc) {
			$tocc_array=explode(",",$tocc);
			$message->setCc($tocc_array);
		}
// $message->addPart($text, 'text/plain');

if ($recipients = $swift->send($message, $failures))
{
 return true;
} else {
 return "There was an error:\n";
 // print_r($failures);
}
}


function send_mail($message,$to,$from,$subject,$attach = null,$tocc=null){ 
/*

 $to = "$to, test";
// $subject = "HTML email";

// $message = "
// <html>
// <head>
// <title>HTML email</title>
// </head>
// <body>
// <p>This email contains HTML Tags!</p>
// <table>
// <tr>
// <th>Firstname</th>
// <th>Lastname</th>
// </tr>
// <tr>
// <td>John</td>
// <td>Doe</td>
// </tr>
// </table>
// </body>
// </html>
// ";


if(isset($from) && $from  != ''){
	$from;                                                             //as given
}else{
	$from = ""; //admin
}

if(isset($to) && $to  != ''){
	$to;                                                               //as given
}else{
	$to = "";                                      //admin
}


// Always set content-type when sending HTML email
//$headers = "MIME-Version: 1.0" . "\r\n";
//$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
//$headers .= "From: <webmaster@example.com>" . "\r\n";
//$headers .= "From: <$from>" . "\r\n";

//$headers .= 'Cc: test@gmail.com' . "\r\n";

mail($to,$subject,$message,$headers);
*/
 }



function send_email($to, $subject, $message, $headers){ 
		mail($to, $subject, $message, $headers);
		echo "Ok"; // success message
 }


}