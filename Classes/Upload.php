<?php
namespace kvd\Classes;
use \PDO;


class Upload extends DbPDO {


  public function uplImg(){
    $usID = $_SESSION['sess_user_id'];
    $File_Name = $_POST['nosaukums'];
    $File_Name2 = iconv('UTF-8','ASCII//TRANSLIT',$File_Name);
    $FName = str_replace(' ', '_', $File_Name2);

    $msg = "<p class='im-leb'>Jūsu fails nav attēls.</p>";

    $folderName = "uzn_".$FName."_files";
    $folderPath = "uznemumi/".$folderName;
    $dir = "uznemumi/$folderName";

    $fileToUpl = $_FILES["up_img"]["tmp_name"];
    $name = $_FILES["up_img"]["name"];
    $checkFile = @getimagesize($fileToUpl);
    $newName = "uzn_".$FName.".jpg";

    $createFolder = !file_exists($folderPath) ? mkdir($folderPath, 0777) : null ;
    if ($checkFile){
      move_uploaded_file($fileToUpl, "$dir/$newName");
//надо сделать проверку названия на уникальность
      $pathForImg = "$dir/$newName";
      $upd = "UPDATE info
      SET img = ? WHERE nosaukums = ? AND AuthorID = ?";
      $do = $this->connect()->prepare($upd);
      $do->execute([$pathForImg, $FName, $usID]);
    } else{
        printf($msg);
      }

  }

  //for user image //ajax
  public function uplProfileImage(){
    $msg = "<p class='im-leb'>Jūsu fails nav attēls.</p>";
    $usID = $_SESSION['sess_user_id'];

    $usName = iconv('UTF-8','ASCII//TRANSLIT',$_SESSION['sess_user_name']);
    $userName = str_replace(' ', '_', $usName);

    $file_name = 'user_'.$usID.'_'.$userName.'';

    $folderName = 'userFolder_'.$userName.'_'.$usID.'';
    $folderPath = "user_files/".$folderName;
    $dir = "user_files/$folderName";
    //upload image
    $fileToUpl = $_FILES["up_img"]["tmp_name"];
    $name = $_FILES["up_img"]["name"];
    $checkFile = getimagesize($fileToUpl);
    $newName = "uzn_".$file_name.".jpg";

//потом закончу
    $createFolder = !file_exists($folderPath) ? mkdir($folderPath, 0777) : null ;
    if ($checkFile){
      move_uploaded_file($fileToUpl, "$dir/$newName");

      $pathForImg = "$dir/$newName";
      $upd = "UPDATE  users
      SET user_img = ? WHERE id = ?";
      $do = $this->connect()->prepare($upd);
      $do->execute([$pathForImg, $usID]);
    } else{
        printf($msg);
      }
  }
}
