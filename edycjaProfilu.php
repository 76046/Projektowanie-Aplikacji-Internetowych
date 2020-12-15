<?php
session_start();

require_once "PolaczeniezMySQL.php";

$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);

if($polaczenie->connect_errno!=0)
{
    echo "Error: ".$polaczenie->connect_errno;//." Opis ".$polaczenie->connect_error;
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
                    echo '<div class="p_avatar" style="background-image:url("data:image/jpeg;base64,' . base64_decode($row['ZDJECIE']) . '");" alt="zdjecie profilowe" />';
                } else {

                    echo '<div class="p_avatar" alt="zmienilo" style="background-image:url("img/un.jpg ")/>';
                }
                echo '<div class="staty" id="zdjecie">';
                echo '<input type="file" name="zdjecie">';
                echo '</div>';
                //<!--  DO ZROBIENIA -->
                //style="background-image:url("'.$row_usera['ZDJECIE'].'");"
                //style="background-image:url("../OBRAZY/un.jpg ");"

                ?>

            </div>
            <div class="pro_statystyki">
                <div class="staty">Statystyki</div>
                <div class="staty">Liczba utworzonych wątków</div>
                <div class="staty"><?php echo $row['STW_WATKI']; ?></div>
                <div class="staty">Liczba komentarzy</div>
                <div class="staty"><?php echo $row['LICZ_KOMENTARZY']; ?></div>

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
                <div class="staty-opis" id="opis">
                    <?php $opisProfilu = $row['OPIS_PROFILU'];
                    echo '<input type="textarea" name="imie" value="'.$opisProfilu.'">' ?>
                </div>
            </div>
            <div class="edycjaProfilu"><?php echo '<a href="profilowe.php?user=' . $row['ID_USER'] . '">'?><input type="submit" value="Edytuj profil" name="edytuj_profil"></a></div>

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