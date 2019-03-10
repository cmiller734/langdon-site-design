<?php
  if($_POST)
  {
	$to_Email = "jeff@pearlmarketingdesign.com"; //Replace with recipient email address
	$subject = 'New Message From Contact Form'; //Subject line for emails

	//check if its an ajax request, exit if not
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
		$output = 'Error: request must come from Ajax';
		die($output);
    }

	//If error checking is included in JS (which it should be), this is redundant
	//check $_POST vars are set, exit if any missing
	// if(!isset($_POST["userName"]) || !isset($_POST["userEmail"]) || !isset($_POST["userMessage"]))
	// {
	// 	$output = json_encode(array('type'=>'error', 'text' => 'Input fields are empty!'));
	// 	die($output);
	// }

	//Sanitize input data using PHP filter_var().
	$user_Name = filter_var($_POST["userName"], FILTER_SANITIZE_STRING);
	$user_Email = filter_var($_POST["userEmail"], FILTER_SANITIZE_EMAIL);
	$user_Message = str_replace("\&#39;", "'", filter_var($_POST["userMessage"], FILTER_SANITIZE_STRING));
	$user_Company = filter_var($_POST["userCompany"], FILTER_SANITIZE_STRING);
	$user_Phone = filter_var($_POST["userPhone"], FILTER_SANITIZE_STRING);

	if(!filter_var($user_Email, FILTER_VALIDATE_EMAIL)) //email validation
	{
		$output = 'Error: Please enter a valid email!';
		die($output);
	}
	if(strlen($user_Message)<5) //check empty message
	{
		$output = 'Error: Message is too short! Please enter a message over 5 characters long.';
		die($output);
	}

	//proceed with PHP email.
	$headers = 'From: '.$user_Email.'' . "\r\n" .
	'Reply-To: '.$user_Email.'' . "\r\n" .
	'X-Mailer: PHP/' . phpversion();

	$replyHeaders = 'From: jeff@pearlmarketingdesign.com' . "\r\n" .
	'Reply-To: jeff@pearlmarketingdesign.com' . "\r\n" .
	'X-Mailer: PHP/' . phpversion();

	$sentMail = @mail($to_Email, $subject,  'Name: ' . $user_Name . "\r\n\n" . 'Email Address: '. $user_Email . "\r\n\n" . 'Phone Number: ' . $user_Phone . "\r\n\n" . 'Message: ' . $user_Message, $headers);

	if(!$sentMail)
	{
		$output = 'Error: Could not send mail! Please check your PHP mail configuration.';
		die($output);
	}else{
		mail($user_Email, 'Thank You For Contacting Us',  'Thank you for contacting Pearl. We have received your message and will reach out to you shortly.' . "\r\n\n" . 'caleb Lau' . "\r\n" . 'Director of Website Development' . "\r\n" . 'Pearl Marketing & Design', $replyHeaders);
		$output ="Hi ".$user_Name ."! Thanks for contacting me. I'll get back to you as soon as possible!";
		die($output);
	}
  }
?>
