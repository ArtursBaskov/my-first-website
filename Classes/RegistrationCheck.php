<?php
namespace kvd\Classes;
use \PDO;
class RegistrationCheck extends DbPDO {
    public $email;
    public $userPass;
    
    public function InputCheck () {
        try{
        
        $email = $_POST['email'];
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->connect()->prepare($sql);

        $stmt->execute([$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        //check if password is good
        $userPass = $_POST['userPassword'];
        $repeatUserPass = $_POST['repeatUserPassword'];
        
        $acceptablePwd = [
            $number = preg_match('@[0-9]@', $userPass),
            $uppercase = preg_match('@[A-Z]@', $userPass),
            $lowercase = preg_match('@[a-z]@', $userPass),
            $specialChars = preg_match('@[^\w]@', $userPass),
        ];
        $truePwd = count(array_filter($acceptablePwd));

        
        $errorMsg = [];
        if(empty($userPass || $repeatUserPass ||$email || $_POST['username'])){
            array_push($errorMsg, "Visiem laukiem jābūt aizpildītiem! <br>");
        }
        //checks if $row has entered email
        if($row){
           array_push($errorMsg, "Šis ēpasts ir aizņemts! <br>");
        }
        if($userPass != $repeatUserPass){
            array_push($errorMsg, "Paroles nesakrīt! <br>");
        }
        if(strlen($userPass) < 6){
            array_push($errorMsg, "Parolei ir jābūt garākai par 6 simboliem! <br>");
        }
        if($truePwd < 3){
            array_push($errorMsg, "Parole ir pārāk vāja! Jāatbilst vismaz 3 nosacījumiem: <br> <ul>
            <li>lielie burti</li>
            <li>mazie burti</li>
            <li>skaitļi</li>
            <li>speciālie simboli</li>
            </ul>");
        }

        //check if error exists
        if(!empty($errorMsg)){
            echo implode($errorMsg);
        }else {
                //if there is no error then call create method
            $createObj = new CreateAccount();
            $createObj->enterAccountInfo();
            header("location: login.php");
            }
   

    }catch (PDOException $e) {
        die($e->getMessage());
      } 
    }
    
}

