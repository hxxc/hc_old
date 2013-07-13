<?php
function sendWelcomeEmail($recipient, $username){
	$message = "Hello ".$username."<br/><br/>Do you think you can code? <br/> Welcome and have fun";

// In case any of our lines are larger than 70 characters, we should use wordwrap()
	$message = wordwrap($message, 70);

	$headers = "From: HuaHCoding <no-reply@huahcoding.com>\r\n";
	$subject = 'Welcome to HuaHCoding';

	// Send

	$accepted = mail($recipient, $subject, $message, $headers);
	// echo $accepted;
}
	
?>
