<?php

require_once "PolaczeniezMySQL.php";

$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);

if($polaczenie->connect_errno!=0)
{
    echo "Error: ".$polaczenie->connect_errno;//." Opis ".$polaczenie->connect_error;
}
else
{
  $rezultat = $polaczenie->query("SELECT * FROM user");

  if(!$rezultat)
  {
    throw new Exception($polaczenie->error);
  }
  else
  {

    while($row = mysqli_fetch_array($rezultat))
    {
          $haslo_TEMP = $row['HASLO'];
          $haslo_TEMP2 = $row['HASLO'];
          $haslo_TEMP3 = $row['HASLO'];

          if(strlen($haslo_TEMP)>20)
          {
          echo "rekord ".$row['ID_USER']." ma zamienione haslo z hashem </br>";
          }
          else
          {
          $haslo_TEMP = hash('sha512', $haslo_TEMP);
          $haslo_TEMP2 = password_hash($haslo_TEMP2, PASSWORD_DEFAULT);
          $haslo_TEMP3 = password_hash(hash('sha512', $haslo_TEMP3, false), PASSWORD_DEFAULT);

          echo $row['ID_USER']." --- ".$haslo_TEMP. "</br>";
          echo $row['ID_USER']." --- ".$haslo_TEMP2. "</br>";
          echo $row['ID_USER']." --- ".$haslo_TEMP3. "</br>";

          if($polaczenie->query("UPDATE `user` SET `HASLO` = '$haslo_TEMP' WHERE `user`.`ID_USER` ='".$row['ID_USER']."';"))
          {
              echo "rekord ".$row['ID_USER']." zostal zamieniony ! </br>";
          }
      }
    }

  }




}



?>
