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
    $ID_watku = $_GET['idwatku'];
    $ID_user = $_GET['user'];


    if($_GET['update']=='n') {

        if ($_GET['z'] == 'p') {
            $polaczenie->query("INSERT INTO `ocenawatek` (`ID_WATKU`, `ID_UZYTKOWNIKA`, `WARTOSC_OCENY`) VALUES ('$ID_watku','$ID_user','PLUS');");
            $row_komentarz = mysqli_fetch_array($polaczenie->query("SELECT * FROM watek WHERE ID_WATEK=" . $ID_watku));
            $l_p_k = $row_komentarz['OCENA'];
            $l_p_k++;
            $polaczenie->query("UPDATE `watek` SET `OCENA`= $l_p_k WHERE `ID_WATEK`=" . $ID_watku);
        } else {
            $polaczenie->query("INSERT INTO `ocenawatek` (`ID_WATKU`, `ID_UZYTKOWNIKA`, `WARTOSC_OCENY`) VALUES ('$ID_watku','$ID_user','MINUS');");
            $row_komentarz = mysqli_fetch_array($polaczenie->query("SELECT * FROM watek WHERE ID_WATEK=" . $ID_watku));
            $l_p_k = $row_komentarz['OCENA'];
            $l_p_k--;
            $polaczenie->query("UPDATE `watek` SET `OCENA`= $l_p_k WHERE `ID_WATEK`=" . $ID_watku);
        }
    }else{

        $ocenione = mysqli_fetch_array($polaczenie->query("SELECT * FROM ocenawatek WHERE ID_WATKU=".$ID_watku." AND ID_UZYTKOWNIKA=".$ID_user));

        if ($_GET['z'] == 'p') {

            $polaczenie->query("UPDATE `ocenawatek` SET `WARTOSC_OCENY`= 'PLUS' WHERE ID_WATKU=".$ID_watku." AND ID_UZYTKOWNIKA=".$ID_user);

            $row_komentarz = mysqli_fetch_array($polaczenie->query("SELECT * FROM watek WHERE ID_WATEK=" . $ID_watku));
            $l_p_k = $row_komentarz['OCENA'];
            $l_p_k+=2;
            $polaczenie->query("UPDATE `watek` SET `OCENA`= $l_p_k WHERE `ID_WATEK`=" . $ID_watku);

        } else {

            $polaczenie->query("UPDATE `ocenawatek` SET `WARTOSC_OCENY`= 'MINUS' WHERE ID_WATKU=".$ID_watku." AND ID_UZYTKOWNIKA=".$ID_user);

            $row_komentarz = mysqli_fetch_array($polaczenie->query("SELECT * FROM watek WHERE ID_WATEK=" . $ID_watku));
            $l_p_k = $row_komentarz['OCENA'];
            $l_p_k-=2;
            $polaczenie->query("UPDATE `watek` SET `OCENA`= $l_p_k WHERE `ID_WATEK`=" . $ID_watku);
        }
    }
}

$polaczenie->close();
header('Location: watek.php?id='.$_GET['idwatku']);
?>
