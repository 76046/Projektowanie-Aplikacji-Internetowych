<?php
session_start();

require_once "PolaczeniezMySQL.php";

$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);

if($polaczenie->connect_errno!=0)
{
    echo "Error: ".$polaczenie->connect_errno;
}
else
{
$rezultat = $polaczenie->query("SELECT * FROM user WHERE ID_USER=" . $_GET['user']);

if (!$rezultat)
{
    throw new Exception($polaczenie->error);
}
else
{

$row = mysqli_fetch_array($rezultat);

?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Kantman</title>
    <meta charset="UTF-8">
    <link href="CSS/styleGlowne.css" rel="stylesheet" type="text/css">
    <link href="CSS/styleProfilowe.css" rel="stylesheet" type="text/css">
</head>

<body>

<?php
include_once('rysowanieMenu.php');
rysowanieGlownegoMenu();
?>

<main>
    <article class="artykol">

        <div class="lewybaner">
            <div class="pro_avatar">

                <?php
                if ($row['ZDJECIE'] != NULL) {
                    echo '<input type="file" name="zdjecie">';
                } else {

                    echo '<div class="p_avatar" alt="zmienilo"/>';
                }
                //<!--  DO ZROBIENIA -->
                //style="background-image:url("'.$row_usera['ZDJECIE'].'");"
                //style="background-image:url("../OBRAZY/un.jpg ");"

                ?>

            </div>

        </div>
        </div>
        <div class="prawybaner">
            <div class="pro_nicname">

            </div>
            <div class="pro_szczegolowe">
                <div class="lewy_szcz">
                    <div class="staty">Imie:</div>
                    <div class="staty">Nazwisko:</div>
                    <div class="staty">Email:</div>
                    <div class="staty">Miasto:</div>
                    <div class="staty">Wiek:</div>
                    <div class="staty">Kraj:</div>
                </div>
                <div class="prawy_szcz">
                <?php ?>
                    <div class="staty" id="imie">
                    <?php $imie = $row['IMIE'];
                    echo '<input type="text" name="imie" value="'.$imie.'">' ?>
                    </div>
                    <div class="staty" id="nazwisko">
                    <?php $nazwisko = $row['NAZWISKO'];
                    echo '<input type="text" name="imie" value="'.$nazwisko.'">' ?>
                    </div>
                    <div class="staty" id="email">
                    <?php $email = $row['EMAIL'];
                    echo '<input type="text" name="imie" value="'.$email.'">' ?>
                    </div>
                    <div class="staty" id="miasto">
                    <?php $miasto = $row['MIASTO'];
                    echo '<input type="text" name="imie" value="'.$miasto.'">' ?>
                    </div>
                    <div class="staty" id="wiek">
                    <?php $wiek = $row['WIEK'];
                    echo '<input type="text" name="imie" value="'.$wiek.'">' ?>
                    </div>
                    <div class="staty" id="kraj">
                    <?php $kraj = $row['KRAJ'];
                    echo '<input type="text" name="imie" value="'.$kraj.'">' ?>
                    </div>
                </div>
                <div class="o_sobie">Coś o sobie:</div>
                <div class="staty_opis">
                <?php $opisProfilu = $row['OPIS_PROFILU'];
                echo '<input type="text" name="imie" value="'.$opisProfilu.'">' ?>
                </div>
            </div>
            <div class="edycjaProfilu"><a href="profilowe.php"><input type="submit" value="Wprowadź zmiany" name="wprowadz_zmiany"></a></div>
        </div>
        <div class="koniec"></div>

    </article>
    <?php
    }
    $polaczenie->close();
    }
    ?>


</main>

<?php
include_once('rysowanieStopki.php');
rysowanieStopki();
?>



</body>
</html>