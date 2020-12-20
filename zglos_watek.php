<?php
session_start();

?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>KANT-MEN</title>
    <link href="CSS/styleGlowne.css" rel="stylesheet" type="text/css">
    <link href="CSS/styleWatek.css" rel="stylesheet" type="text/css">

</head>
<body>
<?php
include_once('rysowanieMenu.php');
rysowanieGlownegoMenu();
?>

<main>
    <?php

    require_once "polaczeniezMySQL.php";

    $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);

    if($polaczenie->connect_errno!=0)
    {
        echo "Error: ".$polaczenie->connect_errno;
    }
    else
    {
    $rezultat = $polaczenie->query("SELECT * FROM watek WHERE ID_WATEK=" . $_GET['watek']);

    if (!$rezultat)
    {
        throw new Exception($polaczenie->error);
    }
    else
    {
        while ($row = mysqli_fetch_array($rezultat))
        {
    ?>
    <div class="artykul-glowny">
        <div class="artykul-tytul">
            Zgłaszasz wątek o tytule: <?php echo $row['TEMAT']; ?>
        </div>
        <div class="artykul-wypowiedz">
            <div class="wiadomosc-profil">
                <?php $row_autor = mysqli_fetch_array($wyciagniecie_danych_autora = $polaczenie->query("SELECT * FROM user WHERE ID_USER=" . $_GET['user'])); ?>
                <div class="awatar">
                    <?php
                    if($row_autor['ZDJECIE']!=NULL)
                    {
                        echo '<img src="data:image/jpeg;base64,' . base64_decode($row_autor['ZDJECIE']) . '" alt="zdjecie"/>;';
                    }else {

                    }
                    ?>
                </div>
                <div class="nickname">
                    <?php echo '<a href="profilowe.php?user=' . $row['ID_USER'] . '"><k style=" font-weight: 700;">' . $row_autor['LOGIN'] . '</k></a>'; ?>
                </div>
            </div>
            <div class="wiadomosc-tresc">
                <div class="czas-wyslania">
                    <?php echo $row['DATA']; ?>
                </div>
                <div class="wiadomosc-trescwiadomosci">
                    <?php echo $row['TRESC_WATKU']; ?>
                </div>
                <div class="panel-spolecznosci-admina">

                </div>
            </div>
            <div style="clear: both;"></div>
        </div>

        <div style="clear: both;"></div>
    </div>
    <?php
        }
        $rezultat->close();
    }
    }

    echo '<div class="komentarz_contener">';
        if(isset($_SESSION['mute'])&&$_SESSION['mute']==true)
        {
        echo '<k style="font-size: 13px; font-weight: 700; color: rgb(40, 39, 0);">Twoje konto jest zmutowane, nie możesz zgłaszać !</k>';
        }
        else
        {
            if((isset($_SESSION['zalogowany']))&&($_SESSION['zalogowany']==true))
            {
                echo '<div class="kom_kom">';

                if(isset($_POST['komentarz_watek'])&& strlen($_POST['komentarz_watek'])<=2000)
                {
                    echo 'Wpisz treść zgłoszenia: max 2000 znaków: ';

                    // dodanie do bazy komentarza
                    $id_watku = $_GET['watek'];
                    $id_zalogowanego = $_SESSION['id_usera_zalog'];
                    $tresc = $_POST['komentarz_watek'];

                    $_SESSION['zgloszenie'] = 0;
                    if($polaczenie->query("INSERT INTO `zgloszenie` (`WATEK_CZY_KOM`,`ID_WATEK`,`ID_ZGLASZAJACEGO`,`POWOD`) VALUES ('WATEK','$id_watku','$id_zalogowanego','$tresc');"))
                    {
                        $_SESSION['zgloszenie'] = 5;
                    }
                    else
                    {
                    echo 'Blad2'.$polaczenie->error;
                    }
                }
                elseif (isset($_POST['komentarz_watek'])&& strlen($_POST['komentarz_watek'])>2000)
                {
                echo 'Wpisany przez ciebie zgłoszenie jest za długie ( max 2000 znaków)';
                }
                else
                {
                echo 'Wpisz skargę: max 2000 znaków: ';
                }

                echo '</div>';

                echo '<form method="post" action="zglos_watek.php?watek='.$_GET['watek'].'&user='.$_GET['user'].'">';
                if(isset($_SESSION['zgloszenie'])&&$_SESSION['zgloszenie'] == 5){
                        echo '<center>Dziekujemy za zgloszenie, bedzie ono rozpatrzone przez administracjię</center>';
                        echo'</br>';
                        echo '<center>Zostaniesz za chwilę przekierowany/a na poprzednia stronę</center>';
                        unset($_SESSION['zgloszenie']);
                        header("refresh:4; url=watek.php?id=".$_GET['watek']);
                }else{
                    echo '<textarea name="komentarz_watek" required="required" ></textarea>';

                    echo '<input class="przycisk_dodaj" type="submit" value="Zgłoś">';
                }


                echo '</form>';

            }
            else
            {
            echo '<k style="font-size: 13px; font-weight: 700; color: rgb(40, 39, 0);"><center>Aby skomentować zaloguj się ! </center></k>';
            }

        }
        ?>

</main>

<?php
include_once('rysowanieStopki.php');
rysowanieStopki();
?>
</body>
</html>
