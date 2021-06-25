<?php
namespace kvd\Classes;
use \PDO;
class CreateInfo extends DbPDO {
  public function sendInfo() {
    try{
      $nosaukums =  preg_replace('/\s+/', '_', trim(htmlspecialchars($_POST['nosaukums'], ENT_QUOTES)));
      $authID = htmlspecialchars($_SESSION['sess_user_id'], ENT_QUOTES);
      $iela = htmlspecialchars($_POST['iela'], ENT_QUOTES);
      $pilseta = htmlspecialchars($_POST['pilseta'], ENT_QUOTES);
      $indeks = htmlspecialchars($_POST['indeks'], ENT_QUOTES);

      //
      $darba_laiks = htmlspecialchars($_POST['darba_laiks'], ENT_QUOTES);
      $talrunis = htmlspecialchars($_POST['talrunis'], ENT_QUOTES);
      $epasts = htmlspecialchars($_POST['epasts'], ENT_QUOTES);
      $apraksts = htmlspecialchars($_POST['apraksts'], ENT_QUOTES);
      $author = $_SESSION['sess_user_name'];
      //sql statemant to insert inputed data
      $sql = "INSERT INTO info
      (postAuthor, AuthorID, nosaukums, iela, pilseta, indeks, darba_laiks, talrunis, epasts, apraksts)
      VALUES
      ('$author', :AuthorID, :nosaukums, :iela, :pilseta, :indeks, :darba_laiks, :talrunis, :epasts, :apraksts)";
      $stmt = $this->connect()->prepare($sql);
      // bind insert values with input field VALUES
      $stmt->bindParam(":AuthorID", $authID);
      $stmt->bindParam(":nosaukums", $nosaukums);
      $stmt->bindParam(":iela", $iela);
      $stmt->bindParam(":pilseta", $pilseta);
      $stmt->bindParam(":indeks", $indeks);
      $stmt->bindParam(":darba_laiks", $darba_laiks);
      $stmt->bindParam(":talrunis", $talrunis);
      $stmt->bindParam(":epasts", $epasts);
      $stmt->bindParam(":apraksts", $apraksts);

      $stmt->execute();
    }catch (PDOException $e) {
        die($e->getMessage());
      }
  }
//check if user inputed appropriate data
  public function userInputCheck() {

    $nosaukums = $_POST['nosaukums'];
    $adrese = [$_POST['iela'], $_POST['pilseta'], $_POST['indeks']];
    $darba_laiks = $_POST['darba_laiks'];
    $talrunis = $_POST['talrunis'];
    $epasts = $_POST['epasts'];
    $apraksts = $_POST['apraksts'];


    $errorMsg = [];
    if(empty($nosaukums && $adrese && $darba_laiks && $talrunis && $epasts && $apraksts)){
        array_push($errorMsg, "Visiem laukiem jābūt aizpildītiem! <br>");
    }
    if (!filter_var($epasts, FILTER_VALIDATE_EMAIL)) {
      array_push($errorMsg, "Nepareizs ēpasta formāts! <br>");
    }
    if (!preg_match('/^[+][0-9]/', $talrunis)){
      array_push($errorMsg, "Nepareizas tāruņa nummura formāts! <br>");
    }

    if(!empty($errorMsg)){
        echo implode($errorMsg);
    }else {
            //if there is no error then call create method
        $this->sendInfo();
        echo "<h>Jūsu pieteikums ir veiksmīgi aizsūtīts!<h>";
        }
  }
// show table contents to admin
  public function adminSeesInfo(){
      $sql = "SELECT * FROM info WHERE (status = 'waiting')";
      $stmt = $this->connect()->query($sql);
      while ($row = $stmt->fetch()){
      $btnID = $row['idinfo'];
      echo '
        <div class="btn-group">
          <button class="acceptBTN" type="submit" id="accept" value='.$btnID.' name="accept" method="POST"  >Accept</button>
          <textarea type="text" class="admin-comment" name="admin-comm"></textarea>
          <button type="submit" class="denyBTN" id="deny" value='.$btnID.' name="deny" method="POST"  >Deny</button>
        </div>';
      echo '<div class="Table">';
        echo '
          <div class="inf-group">
            <h1>Autors</h1>   ' .$row['postAuthor']. '
            <h1>Nosaukums</h1>   ' .$row['nosaukums'] . '
            <h1>Adrese</h1>   ' .$row['iela'].', '. $row['pilseta'].', '. $row['indeks']. '
          </div>
          ';
        echo '
          <div class="inf-group">
            <h1>Darba laiks</h1>  ' .$row['darba_laiks'] . '
            <h1>Ēpasts</h1>  ' .$row['epasts'] . '
            <h1>Tālrunis</h1> ' .$row['talrunis'] .'
          </div>';

        echo '
        <div class="inf-group apr-img">
          <h1>Apraksts</h1>  <p>' .$row['apraksts'] . '</p><br><br>
          <img class="uzn_img" src="'.$row['img'].'" ><br><br>
        </div>';


      echo '</div>';
      }

  }
//admin accepts post or denies
  private function getAuthotEm( $buttonID )
  {
    //get author ID to find author email in users table
    $authID = "SELECT AuthorID FROM info WHERE idinfo = ?";
    $doAuthID = $this->connect()->prepare($authID);
    $doAuthID->execute([$buttonID]);
    $rowAuthID = $doAuthID->fetch();

    $users = "SELECT email FROM users WHERE id = ?";
    $doEmail = $this->connect()->prepare($users);
    $doEmail->execute([$rowAuthID['AuthorID']]);
    $row = $doEmail->fetch();
    return $row['email'];
  }
  public function acceptPost()
  {
    try{
    $buttonID = $_POST['accept'];
    $comm = $_POST['admin-comm'];
    $sql = "UPDATE info SET status='accepted', admin_comment = ? WHERE idinfo = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$comm ,$buttonID]);

    //send accept mesage to email
    $em = $this->getAuthotEm( $buttonID );
    $send = new Email();
    $send->sendEmail($em, 'Jūsu publikācija', "Labdien! Jūsu publikācija tika pieņemta.");
    }catch (PDOException $e) {
        die($e->getMessage());
      }
  }
  public function denyPost()
  {
    try{
    $buttonID = $_POST['deny'];
    $comm = $_POST['admin-comm'];
    $sql = "UPDATE info SET status='denied', admin_comment = ? WHERE idinfo = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$comm ,$buttonID]);

    $em = $this->getAuthotEm( $buttonID );
    $send = new Email();
    $send->sendEmail($em, 'Jūsu publikācija', "Labdien! Jūsu publikācija tika atteikta. Administratora komentāru ar iemeslu var apskatīt Jūsu priflā.");
    }catch (PDOException $e) {
        die($e->getMessage());
      }
  }



  public function citiesList(){

    $sql = "SELECT * FROM cities";
    $stmt = $this->connect()->query($sql);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

      echo '
      <div class="imgBlock">
        <div class="imgLink">
          <h1>'.$row['city'].'</h1>

          <a href="pilseta.php?p='.iconv('UTF-8','ASCII//TRANSLIT',$row['city']).'" data-no="'.$row['city'].'"> <img src="img/'.iconv('UTF-8','ASCII//TRANSLIT',$row['city']).'.png" alt="" /> </a>
        </div>
      </div>
      ';
    }
  }
  public function cityPage(){
    $cityName = $_GET['p'];
  //Select statemant for city name
    $citySql = "SELECT * FROM cities WHERE (city LIKE '$cityName')";
    $cityStmt = $this->connect()->query($citySql);
    $cityRow = $cityStmt->fetch(PDO::FETCH_ASSOC);
  //select for posts
    $sql = "SELECT * FROM info WHERE (status = 'accepted') AND (pilseta LIKE '%$cityName%')";
    $stmt = $this->connect()->query($sql);

    echo '
    <div class="cd-full-width">
      <div class="panel row col-xs-12 col-md-12">
        <div class="city">
          <h name="cityName">'.$cityRow['city'].'<h>
        </div>
      </div>
    <div class="BG row col-xs-12 col-md-10">

        <div id="sear" class="search-f uzn-page">
          <h class="search-h">Meklēt uzņēmumu</h>
          <form method="POST" id="ser-uzn-form">
            <div class="ser-cont">
              <input type="text" name="search" id="serF-uzn">
              <button type="submit" name="search-btn-uzn" class="searBtn"></button>
            </div>
          </form>
        </div>


    <div class="imgBlock-city row col-xs-12 col-md-10" id="uzn-cont">
        ';

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      $name = preg_replace('/_/', ' ', $row['nosaukums']);
      echo '

      <div class="imgBlock-CityPage row col-xs-12 col-md-10 mx-auto">
          <div class="col-xs-12 col-md-6 mx-auto">
            <a href="info.php?'.iconv('UTF-8','ASCII//TRANSLIT',$row['nosaukums']).'" class="imgLink-CityPage"> '. $name .' </a>
          </div>
          <div class="apraksts col-xs-12 col-md-6 ">
            <p>'.$row['apraksts'].'</p>
          </div>
      </div>
      ';

    }

    echo '

    </div>
    </div>
    </div>';
  }
//uzņēmuma lapa, kuru var apskatīts jebkurš lietotājs
  public function postPage(){
    $url = $_SERVER['REQUEST_URI'];
    $postName = substr($url, strpos($url, "?") + 1);

    $sql = "SELECT * FROM info WHERE (nosaukums = '$postName')";
    $stmt = $this->connect()->query($sql);
    $arr = $stmt->fetch(PDO::FETCH_ASSOC);
    $name = preg_replace('/_/', ' ', $arr['nosaukums']);
    echo'

    <div class="info-container col-xs-12 col-md-12 mx-auto">
      <div class="col-xs-12 col-md-6">
        <h class="nosaukums">'.$name.'</h>
        <h1 class="info-head">Adrese</h1>
          <p class="info">'.$arr['iela'].', '.$arr['pilseta'].', '.$arr['indeks'].'</p>
        <h1 class="info-head">Kontakt informācija<h2>
          <p class="info">'.$arr['epasts'].'<br><br>
          '.$arr['talrunis'].'</p>
        <h1 class="info-head">Darba laiks</h1>
        <p class="info">'.$arr['darba_laiks'].'</p>
      </div>
        <h1 class="info-head">Apraksts</h1>
        <div class="info-apraksts col-xs-12 col-md-6">  <p>'.$arr['apraksts'].'</p> </div>
        <div class="info-apraksts col-xs-12 col-md-6">
          <img  src="'.$arr['img'].'" >
        </div>
    </div>

    <input type="text" name="uzn_name" value="'.$arr['nosaukums'].'" id="hidden-input-name">
    <input type="text" name="uzn_id" value="'.$arr['idinfo'].'" id="hidden-input-id">
    ';
  }

  //publication infor // user sees his publications and can edit them
  public function getInfoData($id)
  {
    $sql = "SELECT * FROM info
    WHERE AuthorID = ? AND (status = 'accepted' OR status = 'denied')";
    $do = $this->connect()->prepare($sql);
    $do->execute([$id]);
    return $do;
  }
  public function showInf()
  {
    $id = $_SESSION['sess_user_id'];
    $do = $this->getInfoData($id);
    while($row = $do->fetch()){
      $name = preg_replace('/_/', ' ', $row['nosaukums']);
      echo '
        <div class="uzn-info">
          <form method="post" enctype="multipart/form-data">
            <h class="stat">'.$row['status'].'</h><br><br>
            <h class="stat">Administratora komentārs: '.$row['admin_comment'].'</h><br><br>
              <label>Nosaukums</label><input name="nosaukums" class="inpt" value="'.$name.'">
            <div class="main-info">
              <div class="group-of-inpt">
                <h1>Adrese</h1>
                <p>Iela</p>
                <input name="iela" class="inpt" value="'.$row['iela'].'">
                <p>Pilsēta</p>
                <input name="pilseta" class="inpt" value="'.$row['pilseta'].'">
                <p>Indeks</p>
                <input name="indeks" class="inpt" value="'.$row['indeks'].'">
              </div>

              <div class="group-of-inpt">
                <h1>Cita informācija</h1>
                <p>Tālrunis</p><input name="talrunis" class="inpt" value="'.$row['talrunis'].'">
                <p>E-pasts</p><input name="epasts" class="inpt" value="'.$row['epasts'].'">
                <p>Darba laiks</p><input name="darba_laiks" class="inpt" value="'.$row['darba_laiks'].'">
              </div>

              <div class="img-uzn group-of-inpt">
                <input type="FILE" id="uzn_img" name="up_img">
                <img src="'.$row['img'].'">
                <div id="prewImg"></div>
              </div>
            </div>




            <div class="apraksts">
              <label>Apraksts</label>
              <textarea name="apraksts" id="editorZero">'.$row['apraksts'].'</textarea>
            </div>
            <button name="sagl" class="changeBtn" value="'.$row['idinfo'].'">Saglabāt</button>
            <button name="dzest" class="changeBtn del" value="'.$row['idinfo'].'">Dzēst</button>
          </form>
        </div>

      ';
    }
  }
  public function delInfo()
  {
    $postId = $_POST['dzest'];
    $authID = $_SESSION['sess_user_id'];
    $del = "DELETE FROM info WHERE idinfo = ? AND AuthorID = ?";
    $do = $this->connect()->prepare($del);
    $do->execute([$postId, $authID]);
    echo "<script>window.location.href='profile.php'</script>";
  }
  public function validateUserInput()
  {
    $nos = preg_replace('/\s+/', '_', trim($_POST['nosaukums']));
    $adr = [$_POST['iela'], $_POST['pilseta'], $_POST['indeks']];
    $talr = $_POST['talrunis'];
    $ep = $_POST['epasts'];
    $darb_l = $_POST['darba_laiks'];
    $apr = $_POST['apraksts'];
    $errorMsg = [];

    if(empty($nos && $_POST['iela'] && $_POST['pilseta'] && $_POST['indeks'] && $darb_l && $talr && $ep && $apr)){
        array_push($errorMsg, "Visiem laukiem jābūt aizpildītiem! <br>");
    }
    if (!filter_var($ep, FILTER_VALIDATE_EMAIL)) {
      array_push($errorMsg, "Nepareizs ēpasta formāts! <br>");
    }
    if (!preg_match('/^[+][0-9]/', $talr)){
      array_push($errorMsg, "Nepareizas tāruņa nummura formāts! <br>");
    }

    if(!empty($errorMsg)){
        echo implode($errorMsg);
    } else{
            //if there is no error then call create method
        $this->changeUznInfData();
        echo "<h>Jūsu pieteikums ir veiksmīgi aizsūtīts!<h>";
      }
  }
  public function changeUznInfData()
  {
    $id = $_SESSION['sess_user_id'];
    $nos = preg_replace('/\s+/', '_', trim($_POST['nosaukums']));
    $iela = $_POST['iela'];
    $pilseta = $_POST['pilseta'];
    $indeks = $_POST['indeks'];
    $talr = $_POST['talrunis'];
    $ep = $_POST['epasts'];
    $darb_l = $_POST['darba_laiks'];
    //$img = $_POST['img'];
    $apr = $_POST['apraksts'];
    $idinfoBtn = $_POST['sagl'];

    $upd = "UPDATE info
    SET nosaukums = ?, iela = ?, pilseta = ?, indeks = ?, talrunis = ?, epasts = ?, darba_laiks = ?, apraksts = ?, status = 'waiting'
    WHERE AuthorID = ? AND idinfo = ?";
    $do = $this->connect()->prepare($upd);
    $do->execute([$nos, $iela, $pilseta, $indeks, $talr, $ep, $darb_l, $apr, $id, $idinfoBtn]);
    $upl = new Upload();
    $upl->uplImg();
    echo "<script>window.location.href='profile.php'</script>";
  }

}
