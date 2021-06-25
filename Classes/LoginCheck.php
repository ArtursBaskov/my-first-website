<?php

namespace kvd\Classes;
session_start();
use \PDO;

class LoginCheck extends DbPDO {
  public function regenerate_sess_id()
  {
    $newid = session_create_id(uniqid().'--'.uniqid().uniqid());
    session_commit();
    ini_set('session.use_strict_mode', 0);
    session_id($newid);
    session_start();
  }
  private function ifUserLogsIn()
  {
    ini_set('session.use_strict_mode', 1);
    session_start();
    $this->regenerate_sess_id();
  }
    public function correctLogin ()
    {
        try{
            $email = trim($_POST['email']);
            $userPassword = trim($_POST['userPassword']);

            $sql = "SELECT * FROM users WHERE email=:email";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam('email', $email, PDO::PARAM_STR);


            $stmt->execute();

            $count = $stmt->rowCount();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // decrypts password and returns true or false for $userPassword



            if($count == 1 && !empty($row) &&
            $verifyPwd = password_verify($userPassword, $row['userPassword'])) {
                //generate new SESSID on every login
                $this->ifUserLogsIn();

                //session

                $_SESSION['sess_user_id']   = $row['id'];
                $_SESSION['sess_user_name'] = $row['username'];
                $_SESSION['sess_user_email']   = $row['email'];
                $_SESSION['sess_user_type'] = $row['user_type'];
                $_SESSION['user_email_status'] = $row['email_status'];
                header('location:index.php');

            }else{
                //error

                echo '<label class="error">';
                echo "Nepareiza parole vai ēpasts!";
                echo '</label>';
            }


        }catch (PDOException $e) {
            die($e->getMessage());
        }


    }






    public function sessionState () {
        if(isset($_SESSION['sess_user_id']) && $_SESSION['sess_user_id'] != "") {
          if(@$_SESSION['sess_user_type'] == "admin"){
            echo '
            <li> <a class="nav-link" href="adminPage.php"> Admin Panel </a>';
          }
            echo '
            <li class="nav-item"> <a class="nav-link" href="profile.php" data-no="5">'
             . $_SESSION['sess_user_name'] . '</a>';
             echo '
            <li class="nav-item">
            <a class="nav-link" href="logout.php" data-no="5">Logout</a>
            </li>
            ';

          } else {
            echo '
            <li class="nav-item">
            <a class="nav-link" href="login.php" data-no="6">Login</a>
            </li>
            ';
          }
    }



    public function adminPageAccess() {
        if(isset($_SESSION['sess_user_id']) && $_SESSION['sess_user_id'] != ""
        && $_SESSION['sess_user_type'] == "admin") {
            echo '<p1> Lietotājs: <br>' . $_SESSION['sess_user_name'] . '#'.$_SESSION['sess_user_id'] . '</p1>';
            echo '<p> Ēpasts: <br>' . $_SESSION['sess_user_email'] . '</p>';
            echo '<p> Lietotāja tips: <br>' . $_SESSION['sess_user_type'] . '</p>';
          } else {
            header("location: index.php");
          }
    }
    public function guestLeavesPage() {
      if(isset($_SESSION['sess_user_id']) && $_SESSION['sess_user_id'] != ""){

        if(isset($_SESSION['user_email_status']) &&
        $_SESSION['user_email_status'] != 'email_code_is_checked_email_verified'){
          header("location: code-verify.php");
        }

      }else {
        header("location: login.php");
      }
    }

}
