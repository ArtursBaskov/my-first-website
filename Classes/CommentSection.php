<?php
namespace kvd\Classes;
use \PDO;
class CommentSection extends DbPDO
{
  public function commentQuery()
  {
    //posts from ajax function
    $uznName = $_POST['uzn_name'];
    $uznID = $_POST['uzn_id'];

    $authID = @$_SESSION['sess_user_id'];
    $authName = @$_SESSION['sess_user_name'];
    $commText = htmlspecialchars($_POST['comment'], ENT_QUOTES);
    if(!isset($_SESSION['sess_user_id'])){
      echo 'Rakstīt atsauksmes var tikai ielogoti lietotāji. <br>';
    }
    if(isset($_SESSION['user_email_status']) &&
      $_SESSION['user_email_status'] == 'email_code_is_checked_email_verified'){

      $insert = "INSERT INTO comment_section
      (comm_location_uzn, comm_location_uzn_id, comm_author_id, comm_auth_name,
      comm_tetx, comm_date)
      VALUES
      (?, ?, ?, ?, ?, NOW())";
      $do = $this->connect()->prepare($insert);
      $do->execute([$uznName, $uznID, $authID, $authName, $commText]);
      echo "Komentārs ir veiksmīgi izveidots.";

    } else{
        echo 'Jums ir jāapstiprina e-pasts pirms rakstīt atsauksmes.';
    }
  }

  //get user type
  private function currentUserData()
  {
    $usID = @$_SESSION['sess_user_id'];
    $sel = "SELECT user_type FROM users
    WHERE id = ?";
    $do = $this->connect()->prepare($sel);
    $do->execute([$usID]);
    return $do->fetch();
  }
  //check if user is admin
  public function adminControl()
  {
    $row = $this->currentUserData();
    if(isset($_SESSION['sess_user_type']) &&
    $_SESSION['sess_user_type'] == 'admin' && $row['user_type'] == 'admin'){
      return true;
    }
  }
  //admin can delete comment
  public function adminDelComm()
  {
    $commID = $_POST['commID'];
    $del = "DELETE FROM comment_section WHERE comm_id = ?";
    $do = $this->connect()->prepare($del);
    $do->execute([$commID]);
  }
  //show user comments
  public function userComments()
  {
    //posts from ajax function
    $uznName = $_POST['uzn_name'];
    $uznID = $_POST['uzn_id'];
    //get comment data
    $sql = "SELECT * FROM comment_section
    RIGHT JOIN users ON comment_section.comm_author_id = users.id
    WHERE comment_section.comm_location_uzn = ? AND comment_section.comm_location_uzn_id = ?
    ORDER BY comment_section.comm_date ASC";
    $do = $this->connect()->prepare($sql);
    $do->execute([$uznName, $uznID]);

    $adminAccess = $this->adminControl();

    while($row = $do->fetch()){
      if($adminAccess){
        $adminDelBtn = '<button id="delCom" value="'.$row['comm_id'].'">x</button>';
      }
      echo '
        <div id="comment-block">
          <div class="c-group">
            <img src="'.$row['user_img'].'">
            <h1>'.$row['comm_auth_name'].'</h1>
            <small>'.date('Y-m-d', strtotime($row['comm_date'])).'</small>
          </div>
          '.@$adminDelBtn.'
          <div class="c-group">
            <p>'.$row['comm_tetx'].'</p>
          </div>
        </div>
      ';
    }
  }
}
