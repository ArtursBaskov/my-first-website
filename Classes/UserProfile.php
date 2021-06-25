<?php
namespace kvd\Classes;
use \PDO;


class UserProfile extends DbPDO
{
  //fetch profile info
  private function getData()
  {
    $userID = $_SESSION['sess_user_id'];
    $get = "SELECT * FROM users
    where id = ?";
    $do = $this->connect()->prepare($get);
    $do->execute([$userID]);

    return $do->fetch();
  }
  //get profile image
  public function getUserImage()
  {
    $userImage = $this->getData();
    echo $userImage['user_img'];
  }
  //get username
  public function getUserName()
  {
    $userName = $this->getData();
    echo $userName['username'];
  }
  //get email
  public function getUserEmail()
  {
    $email = $this->getData();
    echo $email['email'];
  }



  public function changeUsernameIF()
  {
    $arr = [];
    $this->checkNameChangeTime() ? null :
      array_push($arr, "Lietotāja vārds jau bija mainīts šajā mēnesī. Mēģiniet vēlāk. ") ;
    strlen($_POST['user-name']) < 5 ?
      array_push($arr, "<br> Jauns lietotāja vārds ir pārāk īss. ") : null;
      //change username if array is empty
    if(empty($arr)){
      $this->changeName();
    } else{
      echo "<label class='error'>".implode($arr)."</label>";
    }
  }
  //check if username was recently changed
  public function checkNameChangeTime()
  {
    $id = $_SESSION['sess_user_id'];
    $get = $this->getUserProfileData("username_change_date" , "id = ?", [$id]);
    $row = $get->fetch();

    $changeDate = $row['username_change_date'];
    $changeDateMotnh = date('m', strtotime($changeDate));
    $currentMonth = date('m');
    if($changeDateMotnh < $currentMonth){
      return true;
    }
  }
  //get user profile data
  public function getUserProfileData($col ,$where, $exe)
  {
    $get = "SELECT $col FROM users
    WHERE $where";
    $do = $this->connect()->prepare($get);
    $do->execute($exe);
    return $do;
  }
  //check if inputed email is valid
  public function checkNewEmail()
  {
    $userEmail = $_POST['user-email'];
    $emSess = $_SESSION['sess_user_email'];
    $id = $_SESSION['sess_user_id'];
    //check if email exists
    $find = $this->getUserProfileData("email", "email = ?", [$userEmail]);
    $found = $find->fetch();

    $errors = [];
    !filter_var($userEmail, FILTER_VALIDATE_EMAIL) ? array_push($errors, "Nepareiza ē-pasta formāts") : 0;
    if($found){
      array_push($errors, "Šis ē-pasts ir aizņemts!");
    }
    //if errors found - implode //if no errors - changeEmail
    if(empty($errors)){
      $this->changeEmail();
    } else{
        echo implode($errors);
    }
  }
  //change email
  public function changeEmail()
  {
    $userEmail = $_POST['user-email'];
    $emSess = $_SESSION['sess_user_email'];
    $id = $_SESSION['sess_user_id'];
    $emailObj = new Email();
    $updNewCode = new FormVerify();

    //change email status
    $this->changeProfileInfo("email = ?, email_status = 'inactive_email_user'", [$userEmail, $id, $emSess]);
    //generate new code
    $newCode = $emailObj->generateCode();
    //get new verification code
    $updNewCode->updEmailCode($newCode, $id);
    //send new email verification code to new email
    $emailObj->sendEmail($userEmail, "Kods", "Jūsu jauna ē-pasta apstiprināšanas kods: $newCode");
    //update session
    $_SESSION['user_email_status'] = "changing_email";
    $_SESSION['sess_user_email'] = $userEmail;
    header("location: profile.php");
  }
  //change username
  public function changeName()
  {
    $userName = $_POST['user-name'];
    $emSess = $_SESSION['sess_user_email'];
    $id = $_SESSION['sess_user_id'];
    $this->changeProfileInfo("username = ?, username_change_date = NOW()", [$userName, $id, $emSess]);
    echo "Lietotāja vārds ir veiksmīgi mainīts.";
  }
  public function changeProfileInfo($col, $exe)
  {
    $upd = "UPDATE users SET $col
    WHERE id = ? AND email = ?";
    $do = $this->connect()->prepare($upd);
    $do->execute($exe);
  }

  //change password
  //check old pwd
  public function validOldPwd()
  {
    $id = $_SESSION['sess_user_id'];
    $emSess = $_SESSION['sess_user_email'];
    $oldPwd = $_POST['old-pwd'];
    $get = $this->getUserProfileData("userPassword" , "id = ? AND email = ?", [$id, $emSess]);
    $row = $get->fetch();
    $verifyPwd = password_verify($oldPwd, $row['userPassword']);
    if($verifyPwd){
      return true;
    }
  }
  //compare new passwords
  public function compareNewPwd($new, $repNew)
  {
    if($new == $repNew){
      return true;
    }
  }
  //check new pwd strngth
  public function checkNewStrength($userPass)
  {
    $acceptablePwd = [
        $number = preg_match('@[0-9]@', $userPass),
        $uppercase = preg_match('@[A-Z]@', $userPass),
        $lowercase = preg_match('@[a-z]@', $userPass),
        $specialChars = preg_match('@[^\w]@', $userPass),
    ];
    $truePwd = count(array_filter($acceptablePwd));
    return $truePwd;
  }
  //check all pwd input before changing
  public function checkNewPassword()
  {
    $new = $_POST['new-pwd'];
    $repNew = $_POST['rep-new-pwd'];

    $errorMsg = [];
    $this->validOldPwd() ? null :
      array_push($errorMsg, "<br> Nepareiza veca parole. ");
    $this->compareNewPwd($new, $repNew) ? null :
      array_push($errorMsg, "<br> Paroles nesakrīt. ");
    $this->checkNewStrength($new) < 3 ?
      array_push($errorMsg, "<br> Vāja parole. ") : null ;
    strlen($new) < 6 ?
      array_push($errorMsg, "<br> Parolei ir jābūt garākai par 6 simboliem!") : null ;

    if(empty($errorMsg)){
      $this->changeUserPassword();
      echo "Parole ir nomainīta.";
    } else{
        echo "<label class='error'>".implode($errorMsg)."</label>";
    }


  }
  public function changeUserPassword()
  {
    $new = $_POST['new-pwd'];
    $repNew = $_POST['rep-new-pwd'];
    $id = $_SESSION['sess_user_id'];
    $emSess = $_SESSION['sess_user_email'];
    $hashPwd = password_hash($new, PASSWORD_DEFAULT);

    $this->changeProfileInfo("userPassword = ?", [$hashPwd, $id, $emSess]);
  }


}
