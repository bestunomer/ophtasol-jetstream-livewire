<?php

include('connectdb1.php');
//error_reporting(E_ALL);

class USER
{ 

 private $conn;
 
 public function __construct()
 {
  $database = new Database();
  $db = $database->dbConnection();
  $this->conn = $db;
    }
 
 public function runQuery($sql)
 {
  $stmt = $this->conn->prepare($sql);
  return $stmt;
 }
 
 public function lasdID()
 {
  $stmt = $this->conn->lastInsertId();
  return $stmt;
 }
 
 public function register($full_name,$phone,$email,$question_cat, $subject, $message,$ip_address,$language_id)
 {
  try
  {       
  
   $stmt = $this->conn->prepare("INSERT INTO contact_form(title,mobile,email, contact_cat_id,subject,detail,ip,language_id) 
    VALUES(:full_name,:phone,:email, :question_cat, :subject, :message,:ip_address, :language_id)");
 
   $stmt->bindparam(":full_name",$full_name);
   $stmt->bindparam(":phone",$phone);
   $stmt->bindparam(":email",$email);
   $stmt->bindparam(":question_cat",$question_cat);
   $stmt->bindparam(":subject",$subject);
   $stmt->bindparam(":message",$message);
   $stmt->bindparam(":ip_address",$ip_address);
   $stmt->bindparam(":language_id",$language_id);

   $stmt->execute(); 
   return $stmt;
   
  }
  catch(PDOException $ex)
  {
   echo $ex->getMessage();
  }
 }
 
 
 
 public function redirect($url)
 {
  header("Location: $url");
 }
 
 
 function send_mail($email,$reply_to,$message1,$subject1)
 {  
try{ 

include_once('phpmailer/class.phpmailer.php');

require_once('phpmailer/class.smtp.php');
  $mail = new PHPMailer();
  	

 $mail->CharSet = 'UTF-8';


  $mail->IsSMTP(); 
  $mail->SMTPDebug  =0;                     
  $mail->SMTPAuth   = true;                  
  $mail->SMTPSecure = 'tls';                 
  $mail->Host       = 'smtp.gmail.com';      
  $mail->Port       = 587;             
  $mail->Encoding = '7bit';
  $mail->AddAddress($email);
  $mail->Username='ibinsinacenter@gmail.com';  
  $mail->Password='sina@ibin@8989';
  $mail->SetFrom('ibinsinacenter@gmail.com','New Message from Contact Form');
  $mail->AddReplyTo($reply_to,'New Message from Contact Form');
 
  $mail->Subject=$subject1;
  $mail->MsgHTML($message1);
  return $mail->Send();
	
	

	
	
}
catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
	  
 }
}
?>

