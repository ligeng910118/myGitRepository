<?php
/**
* by www.phpddt.com
*/
class email{
	public  $subject;
	public $body;
	public $receive;
	
	public function sendEmail(){
		header("content-type:text/html;charset=utf-8");
		ini_set("magic_quotes_runtime",0);
		ini_set('date.timezone','Asia/Shanghai');
		require 'class.phpmailer.php';
		
		$mail = new PHPMailer;
		//$mail->SMTPDebug = 3; // Enable verbose debug output
		$mail->isSMTP(); // Set mailer to use SMTP
		$mail->Host = 'smtp.qq.com'; // Specify main and backup SMTP servers
		$mail->SMTPAuth = true; // Enable SMTP authentication
		$mail->Username = '19915868@qq.com'; // SMTP username
		$mail->Password = 'ryleostdvqjjbhie'; // SMTP password
		$mail->SMTPSecure = 'ssl'; // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 465; // TCP port to connect to
		$mail->setFrom('info@yuntujuhe.com', 'info@yuntujuhe.com');
		$mail->addAddress("$this->receive"); // Add a recipient
		// Name is optional
		$mail->addReplyTo('info@yuntujuhe.com', 'info@yuntujuhe.com');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');
		
		$mail->isHTML(true); // Set email format to HTML
		$mail->Subject = $this->subject;
		$mail->Body = $this->body;
		//var_dump($mail);die;
		if(!$mail->send()) {
			//输出错误信息
			return false;
		} else {
			return true;
		}
	}

}
?>