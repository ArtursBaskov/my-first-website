<?php
namespace kvd\Classes;
use \PDO;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once "vendor/autoload.php";

class Email extends DbPDO {

  private $emailSender = 'pilsetlv@gmail.com';
  private $emailSenderPwd = 'BurstingDecadence';



  //sends email
  public function sendEmail($sendTo, $subj, $bod){
    $mail = new PHPMailer(TRUE);
    try {
      $mail->setFrom($this->emailSender);
      //reciever
      $mail->addAddress($sendTo);
      $mail->Subject = $subj;
      $mail->Body = $bod;

      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->Port = 587;
      $mail->SMTPAuth = true;
      $mail->SMTPSecure = 'tls';

      $mail->Username = $this->emailSender;
      $mail->Password = $this->emailSenderPwd;

//      $mail->SMTPDebug = 4;
      $mail->send();
      echo "<br> Message has been sent successfully";
      } catch (Exception $e) {
      echo "Mailer Error: " . $mail->ErrorInfo;
      }
  }

  //email verification code generator
  public function generateCode(){
    //check if code exists
    $FindCode = "SELECT * FROM users WHERE email_verify_code = ? ";
    $do = $this->connect()->prepare($FindCode);

    while(true){
      $randomCode = mt_rand(1, 1000000);
      $do->execute([$randomCode]);
      $row = $do->fetch(PDO::FETCH_ASSOC);
      //return if code is unique
      if($row == false){
        return $randomCode;
        break;
      }
    }
  }

  //get code from db
  private function getCode($id){
    $sql = "SELECT email_verify_code FROM users WHERE id = ?";
    $do = $this->connect()->prepare($sql);
    $do->execute([$id]);

    $row = $do->fetch();
    return $row['email_verify_code'];
  }

  //send verification code again
  public function sendAgain(){
    $id = $_SESSION['sess_user_id'];
    $email = trim($_POST['email-again']);
    $newCode = $this->generateCode();
    //new code
    $formObj = new FormVerify();
    $formObj->updEmailCode($newCode, $id);//upate code
    $EmCode = $this->getCode($id);//then get the code
    //send
    $this->sendEmail($email, "Kods", "Jūsu ē-pasta apstiprināšanas kods: $EmCode");
    $_SESSION['sess_user_email'] = $email;
    header("location: code-verify.php");
  }


}
