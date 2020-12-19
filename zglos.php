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

    <div class="artykul-glowny">
        <div class="artykul-tytul">
            Zgłaszasz wątek o tytule:
        </div>
        <div class="artykul-wypowiedz">
            <div class="wiadomosc-profil">

                <div class="awatar">

                </div>
                <div class="nickname">

                </div>
            </div>
            <div class="wiadomosc-tresc">
                <div class="czas-wyslania">


                </div>
                <div class="wiadomosc-trescwiadomosci">


                </div>
                <div class="panel-spolecznosci-admina">


                </div>
            </div>
            <div style="clear: both;"></div>
        </div>

        <div style="clear: both;"></div>
    </div>

    <?php

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
                    echo 'Skomentuj: max 2000 znaków: ';

                    // dodanie do bazy komentarza
                    $id_watku = $_GET['id'];
                    $id_zalogowanego = $_SESSION['id_usera_zalog'];
                    $tresc = $_POST['komentarz_watek'];


                    if($polaczenie->query("INSERT INTO `komentarz` (`ID_WATEK`,`ID_USER`,`TRESC_KOMENTARZA`) VALUES ('$id_watku','$id_zalogowanego','$tresc');"))
                    {
                        echo ' ';
                        $_POST['komentarz_watek']=0;
                        $row_usera = mysqli_fetch_array($polaczenie->query("SELECT * FROM user WHERE ID_USER=".$_SESSION['id_usera_zalog']));
                        $liczba_komentarzy = $row_usera['LICZ_KOMENTARZY'];
                        $liczba_komentarzy++;
                        if($polaczenie->query("UPDATE `user` SET `LICZ_KOMENTARZY`= $liczba_komentarzy WHERE `ID_USER`= '$id_zalogowanego'"))
                        {
                            echo ' ';
                        }
                        else
                        {
                        echo 'Blad1'.$polaczenie->error;
                        }
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
                //echo '<form method="post" action="watek.php?id='.$_GET['id'].'">';
                echo '<textarea name="komentarz_watek" required="required" ></textarea>';
                echo '<input class="przycisk_dodaj" type="submit" value="Zgłoś">';
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
