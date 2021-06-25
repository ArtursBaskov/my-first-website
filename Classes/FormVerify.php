<?php
namespace kvd\Classes;
use \PDO;

class FormVerify extends DbPDO {

  private function getDbData(){
    $userEnteredCode = $_POST['em_ver_code'];
    $userEmail = $_SESSION['sess_user_email'];


    $sql = "SELECT email_verify_code FROM users
    WHERE email_verify_code = ? AND email = ?";
    $do = $this->connect()->prepare($sql);
    $do->execute([$userEnteredCode, $userEmail]);

    $row = $do->fetch();
    $exists = $row;
    if($exists && is_numeric($userEnteredCode)){
      return true;
    }
  }
  //if email code is valid - make user accaunt active
  public function checkCode(){
    $id = $_SESSION['sess_user_id'];
    if($this->getDbData()){
      echo "ok";
      $this->updEmailCode("NULL", $id);
      $this->updEmailStatus('email_code_is_checked_email_verified', $id);
      header('location: profile.php');
    } else{
      echo "<label class='error'>Nepareizs kods! </label>";
    }
  }
  //update email verifaction code
  public function updEmailCode($code, $id){
    $upd = "UPDATE users SET email_verify_code = ?
    WHERE id = ?";
    $do = $this->connect()->prepare($upd);
    $do->execute([$code, $id]);
  }
  public function updEmailStatus($status, $id){
    $upd = "UPDATE users SET email_status = ?
    WHERE id = ?";
    $do = $this->connect()->prepare($upd);
    $do->execute([$status, $id]);
    $_SESSION['user_email_status'] = $status;
  }



}
