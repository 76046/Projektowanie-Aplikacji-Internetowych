<?php
session_start();
var_dump($_SESSION['admin']);
echo '</br>';
echo $_GET['panel'];
echo '</br>';
echo $_GET['akcja'];
echo '</br>';
echo $_GET['idusera'];
echo '</br>';

if($_SESSION['admin']==false && $_SESSION['mod']==false)
{
    header('Location: index.php');
    exit();
}


require_once "polaczeniezMySQL.php";

$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);

if($polaczenie->connect_errno!=0)
{
    echo "Error: ".$polaczenie->connect_errno;//." Opis ".$polaczenie->connect_error;
}
else {
//    //usuwanie komentarza
//    if (isset($_GET['komentarz'])) {
//        $rezultat = $polaczenie->query("SELECT * FROM `ocenakomentarz` WHERE `ID_KOMENTARZA_OCENIONEGO` =" . $_GET['komentarz']);
//        if (!$rezultat) {
//            throw new Exception($polaczenie->error);
//        } else {
//            while ($jednaocena = mysqli_fetch_array($rezultat)) {
//                $polaczenie->query("DELETE FROM `ocenakomentarz` WHERE `ocenakomentarz`.`ID_KOMENTARZA_OCENIONEGO` =" . $jednaocena['ID_KOMENTARZA_OCENIONEGO']);
//            }
//        }
//        $polaczenie->query("DELETE FROM `komentarz` WHERE `ID_KOMENTARZ` =" . $_GET['komentarz']);
//    }
////usuwanie watku poprzez ukrycie go
//    if (isset($_GET['watek'])) {
//        $rezultat = $polaczenie->query("UPDATE `watek` SET `STATUS` = 'USUNIETE' WHERE `watek`.`ID_WATEK`=" . $_GET['watek']);
//    }
//}
////akceptacja postu admina bądź też nie
//if (isset($_GET['akceptacja_postu'])) {
//    $rezultat = $polaczenie->query("UPDATE `watek` SET `STATUS` = 'ZAKCEPTOWANE' WHERE `watek`.`ID_WATEK`=" . $_GET['akceptacja_postu']); //id postu


if($_GET['panel']=='uzytkownicy'){
    echo -2;
    echo '</br>';
    if($_GET['akcja']=='zmutuj'){
        $rezultat = $polaczenie->query("UPDATE `user` SET `UPRAWNIENIA` = 'MUTE' WHERE `ID_USER`=".$_GET['idusera']);
        var_dump($rezultat);
        echo -3;
        echo '</br>';
    }
    if($_GET['akcja']=='odmutuj'){
        $rezultat = $polaczenie->query("UPDATE `user` SET `UPRAWNIENIA` = 'USER' WHERE `ID_USER`=".$_GET['idusera']);
        var_dump($rezultat);
        echo -4;
        echo '</br>';
    }
    if($_GET['akcja']=='banuj'){
        $rezultat = $polaczenie->query("UPDATE `user` SET `UPRAWNIENIA` = 'BAN' WHERE `ID_USER`=".$_GET['idusera']);

    }
    if($_GET['akcja']=='odbanuj'){
        $rezultat = $polaczenie->query("UPDATE `user` SET `UPRAWNIENIA` = 'USER' WHERE `ID_USER`=".$_GET['idusera']);

    }

    if($_GET['akcja']=='zabierzmoda'){
        $rezultat = $polaczenie->query("UPDATE `user` SET `UPRAWNIENIA` = 'USER' WHERE `ID_USER`=".$_GET['idusera']);

    }
    if($_GET['akcja']=='nadajmoda'){
        $rezultat = $polaczenie->query("UPDATE `user` SET `UPRAWNIENIA` = 'MOD' WHERE `ID_USER`=".$_GET['idusera']);
    }

    if (!$rezultat) {
        throw new Exception($polaczenie->error);
    }
    $polaczenie->close();
    header('Location: panel_admin_u.php');
}

    if($_GET['panel']=='artykuly'){

        if($_GET['akcja']=='ukryj'){
            $rezultat = $polaczenie->query("UPDATE `artykul` SET `STATUS` = 'UKRYTY' WHERE `ID_ARTYKULU`=".$_GET['idartykul']);
            var_dump($rezultat);
            echo -3;
            echo '</br>';
        }

        if($_GET['akcja']=='stronaglowna'){
            $rezultat = $polaczenie->query("UPDATE `artykul` SET `STATUS` = 'POKAZANY' WHERE `ID_ARTYKULU`=".$_GET['idartykul']);
            var_dump($rezultat);
            echo -3;
            echo '</br>';
        }

        if (!$rezultat) {
            throw new Exception($polaczenie->error);
        }

        $polaczenie->close();
        header('Location: panel_admin_a.php');
    }

    if($_GET['panel']=='zgloszenie1'){
        //komentarze
        if($_GET['akcja']=='usunzgloszenie'){
            //idzgloszenia
            $rezultat = $polaczenie->query("UPDATE `zgloszenie` SET `STATUS` = 'USUNIENTY' WHERE `ID_ZGLOSZENIE`=".$_GET['idzgloszenia']);

        }
        if($_GET['akcja']=='usunkomentarz'){
            //idzgloszenia
            $rezultat = $polaczenie->query("UPDATE `komentarz` SET `STATUS` = 'USUNIETY' WHERE `ID_KOMENTARZ`=".$_GET['idkomentarza']);

        }
        if($_GET['akcja']=='zmutuj'){
            $rezultat = $polaczenie->query("UPDATE `user` SET `UPRAWNIENIA` = 'MUTE' WHERE `ID_USER`=".$_GET['idusera']);
            var_dump($rezultat);
            echo -3;
            echo '</br>';
        }
        if (!$rezultat) {
            throw new Exception($polaczenie->error);
        }
        $polaczenie->close();
        header('Location: panel_admin_z_k.php');
    }
    if($_GET['panel']=='zgloszenie2') {
        //watki
        if ($_GET['akcja'] == 'usunwatek') {
            //idzgloszenia
            $rezultat = $polaczenie->query("UPDATE `watek` SET `STATUS` = 'USUNIETY' WHERE `ID_WATEK`=".$_GET['idwatku']);

        }
        if($_GET['akcja']=='usunzgloszenie'){
            //idzgloszenia
            $rezultat = $polaczenie->query("UPDATE `zgloszenie` SET `STATUS` = 'USUNIENTY' WHERE `ID_ZGLOSZENIE`=".$_GET['idzgloszenia']);

        }
        if($_GET['akcja']=='zmutuj'){
            $rezultat = $polaczenie->query("UPDATE `user` SET `UPRAWNIENIA` = 'MUTE' WHERE `ID_USER`=".$_GET['idusera']);
            var_dump($rezultat);
            echo -3;
            echo '</br>';
        }
        if (!$rezultat) {
            throw new Exception($polaczenie->error);
        }
        $polaczenie->close();
        header('Location: panel_admin_z_w.php');
    }



}




$polaczenie->close();

?>
