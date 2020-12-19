<?php

require_once "polaczeniezMySQL.php";

$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);

if($polaczenie->connect_errno!=0)
{
    echo "Error: ".$polaczenie->connect_errno;//." Opis ".$polaczenie->connect_error;
}
else
{
    $row_user = mysqli_fetch_array($polaczenie->query("SELECT * FROM user WHERE ID_USER=".$_GET['user']));
    $ID_komentarza_oc = $_GET['kom'];
    $ID_user = $_GET['user'];


if($_GET['update']=='n') {

    if ($_GET['z'] == 'p') {
        $polaczenie->query("INSERT INTO `ocenakomentarz` (`ID_KOMENTARZA_OCENIONEGO`, `ID_UZYTKOWNIKA`, `WARTOSC_OCENY`) VALUES ('$ID_komentarza_oc','$ID_user','PLUS');");
        $row_komentarz = mysqli_fetch_array($polaczenie->query("SELECT * FROM komentarz WHERE ID_KOMENTARZ=" . $_GET['kom']));
        $l_p_k = $row_komentarz['OCENA'];
        $l_p_k++;
        $polaczenie->query("UPDATE `komentarz` SET `OCENA`= $l_p_k WHERE `ID_KOMENTARZ`=" . $_GET['kom']);
    } else {
        $polaczenie->query("INSERT INTO `ocenakomentarz` (`ID_KOMENTARZA_OCENIONEGO`, `ID_UZYTKOWNIKA`, `WARTOSC_OCENY`) VALUES ('$ID_komentarza_oc','$ID_user','MINUS');");
        $row_komentarz = mysqli_fetch_array($polaczenie->query("SELECT * FROM komentarz WHERE ID_KOMENTARZ=" . $_GET['kom']));
        $l_p_k = $row_komentarz['OCENA'];
        $l_p_k--;
        $polaczenie->query("UPDATE `komentarz` SET `OCENA`= $l_p_k WHERE `ID_KOMENTARZ`=" . $_GET['kom']);
    }
}else{

    $ocenione = mysqli_fetch_array($polaczenie->query("SELECT * FROM ocenakomentarz WHERE ID_KOMENTARZA_OCENIONEGO=".$ID_komentarza_oc." AND ID_UZYTKOWNIKA=".$ID_user));

    if ($_GET['z'] == 'p') {

        $polaczenie->query("UPDATE `ocenakomentarz` SET `WARTOSC_OCENY`= 'PLUS' WHERE ID_KOMENTARZA_OCENIONEGO=".$ID_komentarza_oc." AND ID_UZYTKOWNIKA=".$ID_user);

        $row_komentarz = mysqli_fetch_array($polaczenie->query("SELECT * FROM komentarz WHERE ID_KOMENTARZ=" . $_GET['kom']));
        $l_p_k = $row_komentarz['OCENA'];
        $l_p_k+=2;
        $polaczenie->query("UPDATE `komentarz` SET `OCENA`= $l_p_k WHERE `ID_KOMENTARZ`=" . $_GET['kom']);

    } else {

        $polaczenie->query("UPDATE `ocenakomentarz` SET `WARTOSC_OCENY`= 'MINUS' WHERE ID_KOMENTARZA_OCENIONEGO=".$ID_komentarza_oc." AND ID_UZYTKOWNIKA=".$ID_user);

        $row_komentarz = mysqli_fetch_array($polaczenie->query("SELECT * FROM komentarz WHERE ID_KOMENTARZ=" . $_GET['kom']));
        $l_p_k = $row_komentarz['OCENA'];
        $l_p_k-=2;
        $polaczenie->query("UPDATE `komentarz` SET `OCENA`= $l_p_k WHERE `ID_KOMENTARZ`=" . $_GET['kom']);
    }
}
}

$polaczenie->close();
header('Location: watek.php?id='.$_GET['idwatku']);
?>
