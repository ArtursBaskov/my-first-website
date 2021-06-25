<?php
namespace kvd\Classes;
use \PDO;

class Search extends DbPDO
{
  public function getPageData($col, $table, $where, $exe)
  {
    $sql = "SELECT $col FROM $table
    WHERE $where";
    $do = $this->connect()->prepare($sql);
    $do->execute($exe);
    return $do;
  }
  public function getSearchedCity()
  {
    $serRequest = $_POST['search'];
    $do = $this->getPageData("city", "cities", "city LIKE ? ORDER BY city ASC", ["%".$serRequest."%"]);
    while($row = $do->fetch()){
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
  public function getSearchedUzn()
  {
    $cityName = $_POST['cit'];
    $serRequest = $_POST['search'];
    $do = $this->getPageData("*", "info", "status = 'accepted' AND pilseta LIKE ? AND nosaukums LIKE ? ORDER BY nosaukums ASC", ["%".$cityName."%", "%".$serRequest."%"]);
    while($row = $do->fetch()){

      $name = preg_replace('/_/', ' ', $row['nosaukums']);
      echo '
      <div class="imgBlock-CityPage row col-xs-12 col-md-10 mx-auto">
        <div id="uzn-cont">
          <div class="col-xs-12 col-md-6 mx-auto">
            <a href="info.php?'.iconv('UTF-8','ASCII//TRANSLIT',$row['nosaukums']).'" class="imgLink-CityPage"> '. $name .' </a>
          </div>
          <div class="apraksts col-xs-12 col-md-6 ">
            <p>'.$row['apraksts'].'</p>
          </div>
        </div>
      </div>
      ';
    }
  }
}
