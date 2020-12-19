<?php
session_start();

require_once "polaczeniezMySQL.php";

$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);

if($polaczenie->connect_errno!=0)
{
    echo "Error: ".$polaczenie->connect_errno;
}
else
{
if(isset($_POST['aktualizuj'])){ 
    $kupnoInput=$_POST['kupno-input'];
    $sprzedazInput=$_POST['sprzedaz-input'];   
    if($polaczenie->query("UPDATE waluta SET KUPNO=".$_POST['kupno-input'].",SPRZEDAZ=".$_POST['sprzedaz-input']." WHERE KOD_WALUTA=".$_POST['kod'])){
        header("refresh: 1; url=waluty.php");
    }
    else{
        echo "Nie udało się zaktualizować";
    }
    }
}
$polaczenie->close();
?>