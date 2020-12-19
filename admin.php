<?php
session_start();
echo $_SESSION['admin'];
if($_SESSION['admin']==false)
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
else
{
    if($_GET['z_poziomu']=='usera'){

        //usuwanie komentarza
        if ($_GET['komentarz']) {
            $rezultat = $polaczenie->query("SELECT * FROM `ocenakomentarz` WHERE `ID_KOMENTARZA_OCENIONEGO` =" . $_GET['komentarz']);
            if (!$rezultat) {
                throw new Exception($polaczenie->error);
            } else {
                while ($jednaocena = mysqli_fetch_array($rezultat)) {
                    $polaczenie->query("DELETE FROM `ocenakomentarz` WHERE `ocenakomentarz`.`ID_KOMENTARZA_OCENIONEGO` =".$jednaocena['ID_KOMENTARZA_OCENIONEGO']);
                }
            }
            $polaczenie->query("DELETE FROM `komentarz` WHERE `ID_KOMENTARZ` =" . $_GET['komentarz']);
        }
    }
//usuwanie watku poprzez ukrycie go
//    if ($_GET['watek']) {
//        $rezultat = $polaczenie->query("SELECT * FROM `watek` WHERE `ID_WATEK` =" . $_GET['watek']);
//    }

//akceptacja postu admina bądź też nie

//ban użytkownika
}
$polaczenie->close();

?>
