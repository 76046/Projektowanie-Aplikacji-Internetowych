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
    $rezultat = $polaczenie->query("SELECT * FROM watek WHERE ID_WATEK=" . $_GET['id']);

    if (!$rezultat)
    {
        throw new Exception($polaczenie->error);
    }
    else
    {
    while ($row = mysqli_fetch_array($rezultat))
    {
    ?>
    <article>
        <div class="artykul-glowny">
            <div class="artykul-tytul">
                <?php echo $row['TEMAT']; ?>
                <!-- Tytul watku -->
            </div>
            <div class="artykul-wypowiedz">
                <div class="wiadomosc-profil">
                    <?php $row_autor = mysqli_fetch_array($wyciagniecie_danych_autora = $polaczenie->query("SELECT * FROM user WHERE ID_USER=" . $row['ID_USER'])); ?>
                    <div class="awatar">
                        <?php echo '<img src="data:image/jpeg;base64,' . base64_decode($row_autor['ZDJECIE']) . '" alt="zdjecie"/>;' ?>
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
        </div>
        <?php
        $l_odwiedzin = $row['ILOSC_ODWIEDZIN'];
        $l_odwiedzin++;
        $polaczenie->query("UPDATE `watek` SET `ILOSC_ODWIEDZIN`= $l_odwiedzin WHERE `ID_WATEK`=".$_GET['id']);

        ?>

        <?php
        }
        $rezultat->close();
        }
    }
    echo '<div class="komentarz_contener">';
        if(isset($_SESSION['mute'])&&$_SESSION['mute']==true)
        {
        echo '<k style="font-size: 13px; font-weight: 700; color: rgb(40, 39, 0);">Twoje konto jest zmutowane, nie możesz komentować !</k>';
        }
        else
        {
            if((isset($_SESSION['zalogowany']))&&($_SESSION['zalogowany']==true))
            {
                echo '<div class="kom_kom">';

                if(isset($_POST['komentarz_user'])&& strlen($_POST['komentarz_user'])<=2000)
                {
                    echo 'Skomentuj: max 2000 znaków: ';

                    // dodanie do bazy komentarza
                    $id_watku = $_GET['id'];
                    $id_zalogowanego = $_SESSION['id_usera_zalog'];
                    $tresc = $_POST['komentarz_user'];


                    if($polaczenie->query("INSERT INTO `komentarz` (`ID_WATEK`,`ID_USER`,`TRESC_KOMENTARZA`) VALUES ('$id_watku','$id_zalogowanego','$tresc');"))
                    {
                        echo ' ';
                        $_POST['komentarz_user']=0;

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
                elseif (isset($_POST['komentarz_user'])&& strlen($_POST['komentarz_user'])>2000)
                {
                echo 'Wpisany przez ciebie komentarz jest za długi ( max 2000 znaków)';
                }
                else
                {
                echo 'Skomentuj: max 2000 znaków: ';
                }

                echo '</div>';
                echo '<form method="post" action="watek.php?id='.$_GET['id'].'">';
                echo '<textarea name="komentarz_user" required="required" ></textarea>';
                echo '<input class="przycisk_dodaj" type="submit" value="Dodaj">';
                echo '</form>';
            }
            else
            {
            echo '<k style="font-size: 13px; font-weight: 700; color: rgb(40, 39, 0);"><center>Aby skomentować zaloguj się ! </center></k>';
            }

        }
        ?>

        <?php
        $row_komentarze_profil1 = $polaczenie->query("SELECT * FROM komentarz WHERE ID_WATEK=".$_GET['id']);
        //var_dump($row_komentarze_profil);
        $row_pom = mysqli_fetch_array($row_komentarze_profil1);
        echo'<div class="kom_kom">';
        if($row_pom==NULL){
            echo    '<center>Skomentuj jako pierwszy !</center>';
        }else{
            echo    'Komentarze: ';
        }
        echo '</div>';
        $row_komentarze_profil1->close();



        $row_komentarze_profil = $polaczenie->query("SELECT * FROM komentarz WHERE ID_WATEK=".$_GET['id']);

        while($row_komentarz = mysqli_fetch_array($row_komentarze_profil))
        {
        $row_usera = mysqli_fetch_array($wyciagniecie_kom_usera = $polaczenie->query("SELECT * FROM user WHERE ID_USER=".$row_komentarz['ID_USER']));
        //var_dump($row_usera);
        // to ma wyciagac za kazdym razem dane komentujacego
        ?>
        <!-- jeden komentarz -->
        <div class="kom_komentarz">
            <div class="kom_avatar">
                <?php
                if($row_usera['ZDJECIE']!=NULL)
                {
                    echo '<div class="kom_profilowe" style="background-image:url("data:image/jpeg;base64,'.base64_decode( $row_usera['ZDJECIE'] ).'");" alt="zdjecie profilowe" />';
                }else {

                    echo '<div class="kom_profilowe" alt="zdjecie b" />';
                }
                //<!--  DO ZROBIENIA -->
                //style="background-image:url("'.$row_usera['ZDJECIE'].'");"
                //style="background-image:url("../OBRAZY/un.jpg ");"

                ?>

            </div>
        </div>
        <div class="kom_tresc">
            <div class="kom_wiadomosc">
                <?php
                echo $row_komentarz['TRESC_KOMENTARZA'];
                ?>
            </div>
        </div>
        <div class="kom_oceny">

            <div class="licznik"><?php


                ?>
            </div>
            <?php
            if((isset($_SESSION['zalogowany']))&&($_SESSION['zalogowany']==true))
            {
                echo '<button type="button" class="plus_button">+</button></a>';
                echo '<button type="button" class="minus_button">-</button></a>';
            }
            ?>
        </div>
        <div class="kom_stopka">
            <div class="kom_adminpanel1">
            </div>
            <div class="kom_nickdzien">
                <?php echo $row_komentarz['DATA'].' przez <a href="profilowe.php?user='.$row_usera['ID_USER'].'"><k style=" font-weight: 700;">'.$row_usera['LOGIN'].'</k></a>'; ?>
            </div>
            <?php
            if((isset($_SESSION['admin']))&&($_SESSION['admin']==true)){
                echo '<div class="kom_adminpanel2">';
                echo '<a href="admin.php?idkom='.$row_komentarz['ID_KOMENTARZA'].'&add='.$_GET['user'].'&w=u"><button type="button" class="del_button">Usuń</button></a>';
                echo '</div>';
            } else {
                echo '<div class="kom_adminpanel2">';
                echo '</div>';
            }

            ?>
        </div>
    </div>
    <?php
    $wyciagniecie_kom_usera->close();
    }
    $row_komentarze_profil->close();
    $polaczenie->close();
    ?>
    <!-- jeden komentarz -->

    </div>


</article>

</main>

<?php
include_once('rysowanieStopki.php');
rysowanieStopki();
?>
</body>
</html>