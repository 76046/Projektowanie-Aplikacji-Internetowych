<?php

session_start();


if((!isset($_POST['User'])) || (!isset($_POST['Password'])))
{
  $_SESSION['BladLogowania'] = true;
  //header('Location: Zalogowaniephp.php');
  exit();
}

require_once "PolaczeniezMySQL.php";

$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);

if($polaczenie->connect_errno!=0)
{
    echo "Error: ".$polaczenie->connect_errno;
}
else
{

  $login=$_POST['User'];
  $haslo=$_POST['Password'];

  $login = htmlentities($login,ENT_QUOTES,"UTF-8"); // funkcja ta ktora sprowadza kod do encji


 // funkcja przecikwo wtrzykiwaniu mysql
if($rezultat = $polaczenie->query(
sprintf("SELECT * FROM user WHERE LOGIN='%s'",
mysqli_real_escape_string($polaczenie,$login))))
  {

    $ilu_userow = $rezultat->num_rows;
    if($ilu_userow>0)
    {
      $wiersz = $rezultat->fetch_assoc();
      if($wiersz['UPRAWNIENIA']=='BAN')
      {
        $_SESSION['ban'] = true;
        header('Location: Logowaniephp.php');
        exit();
      }
        if(password_verify($haslo,$wiersz['HASLO']))
        {

        $_SESSION['zalogowany'] = true; // flaga ze jestesmy zalogowany
        $_SESSION['login_wyswietlanie'] = $_POST['User'];
        $_SESSION['id_usera_zalog'] = $wiersz['ID_USER'];
        if($wiersz['UPRAWNIENIA']=='ADMIN' || $wiersz['UPRAWNIENIA']=='MOD')
        {
        echo $wiersz['UPRAWNIENIA'];
        $_SESSION['admin'] = true;
      }else{
        echo $_SESSION['admin'];
        $_SESSION['admin'] = false;
      }
      if($wiersz['UPRAWNIENIA']=='MUTE')
      {
        $_SESSION['mute'] = true;
      }



        // $_SESSION['user'] = $wiersz['LOGIN'];
        // $_SESSION['userImie']=$wiersz['IMIE'];
        // $_SESSION['userNazwisko']=$wiersz['NAZWISKO'];
        // $_SESSION['userNazwisko']=$wiersz['EMAIL'];
        // $_SESSION['userMiasto']=$wiersz['MIASTO'];
        // $_SESSION['userwiek']=$wiersz['WIEK'];
        // $_SESSION['userwiek']=$wiersz['KRAJ'];
        // $_SESSION['userOpis']=$wiersz['COS_O_SOBIE'];
        // $_SESSION['userPlus']=$wiersz['PLUS'];
        // $_SESSION['userMinus']=$wiersz['MINUS'];
        // $_SESSION['userStwMemy']=$wiersz['STW_MEMY'];
        // $_SESSION['userLiczKom']=$wiersz['LICZ_KOMENTARZY'];
        // $_SESSION['userPrawa']=$wiersz['UPRAWNIENIA'];
        // echo $_SESSION['user'],$_SESSION['userImie'],$_SESSION['userNazwisko'],$_SESSION['userNazwisko'],$_SESSION['userMiasto'],$_SESSION['userwiek'],$_SESSION['userwiek'],$_SESSION['userOpis'],$_SESSION['userLiczKom'],$_SESSION['userPrawa'];

        $rezultat->close(); // usuwamy rezultaty z pamieci servera
        header('Location: index.php'); // tutaj wpisujemy gdzie ma sie przeniesc po zalogowaniu
        }
        else {
          $_SESSION['BladLogowania'] = true;
          //echo "nie weszlo1";
          header('Location: logowanie.php');
        }

    }
    else
    {
      $_SESSION['BladLogowania'] = true;
      //echo "nie weszlo2";
      header('Location: logowanie.php');
    }

  }
  else
  {
    echo "nie weszlo2";
  }

  $polaczenie->close();
}

?>