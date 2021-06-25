<?php
namespace kvd\Classes;
use \PDO;
class CreateAccount extends DbPDO {
    public $username;
    public $email;
    public $userPassword;

    public function sendCodeToEmail($reciever, $code){
      $body = "Labdien! Šeit ir jūsu aktivācijas kods: $code ";
      $subj = "Kods";
      $emSend = new Email();
      $emSend->sendEmail($reciever, $subj, $body);
    }

    public function enterAccountInfo () {
        try{

            $IDsql = "SELECT * FROM users WHERE id = ?";
            $IDstmt = $this->connect()->prepare($IDsql);

        while(true){
            $randomID = mt_rand(1, 100000);
            $IDstmt->execute([$randomID]);
            $IDrow = $IDstmt->fetch(PDO::FETCH_ASSOC);

            if($IDrow == false){
                echo $randomID . "<br>";
                break;
            }
        }


            $username = $_POST["username"];
            $email = $_POST["email"];
            $userPassword = $_POST["userPassword"];

            $code = new Email();
            $emailCode = $code->generateCode();

            $hashPwd = password_hash($userPassword, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (id, username, email, email_verify_code, userPassword, reg_date)
            VALUES ($randomID, :username, :email, $emailCode, :userPassword, NOW())";
            $stmt = $this->connect()->prepare($sql);

            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":userPassword", $hashPwd);
            $stmt->execute();
            //send code to user email
            $this->sendCodeToEmail($email, $emailCode);

        }catch (PDOException $e) {
            die($e->getMessage());
          }

    }
}
