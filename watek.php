<?php

setcookie("visited", "1", time() + 3600 * 24 * 7);
//Wysyła cookie na komputer użytkownika


session_start();
if(isset($_SESSION['zgloszenie'])){
    unset($_SESSION['zgloszenie']);
}
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

    if (file_exists("counter.n")) {
        //Sprawdza czy plik istnieje
        $file = fopen("counter.n", "r"); // otwiera plik
        flock($file, 1); // blokuje plik
        $ile = fgets($file, 100);
        //Odczytuje wartość z pliku counter.n

        flock($file, 3); // odblokowywuje plik
        fclose($file); //zamyka plik
        if ($_COOKIE["visited"] != "1") //Sprawdza, czy użytkownik był na stronie
        {
            $ile++;
            //Zwiększa wartość o jeden tylko po pierwszym wejściu
        }
    } else {
        $ile = 1; //jeśli plik nie istnieje, wyświetli się 1
    }

    $file = fopen("counter.n", "w"); // otwiera plik do zapisu
    flock($file, 2); // blokuje do zapisu
    fwrite($file, $ile); //zapisuje wartość
    flock($file, 3); // odblokowuje plik
    fclose($file); //zamyka plik

    //echo($ile); //Wyświetla wartość

    $rezultat = $polaczenie->query("UPDATE `watek` SET `ILOSC_ODWIEDZIN` = '$ile' WHERE ID_WATEK=".$_GET['id']);


    $rezultat = $polaczenie->query("SELECT * FROM watek WHERE ID_WATEK=".$_GET['id']);

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
                        <?php
                        if($row_autor['ZDJECIE']!=NULL)
                        {
                            echo '<img src="img/profile/'.$row_autor['ZDJECIE'].'" alt="zdjecie"/>';
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
                    <div class="panel-spolecznosci-admina"><?php

                    if((isset($_SESSION['zalogowany']))&&($_SESSION['zalogowany']==true))
                    {
                        $Czy_ocenione = mysqli_fetch_array($polaczenie->query("SELECT * FROM ocenawatek WHERE ID_WATKU=".$_GET['id']." AND ID_UZYTKOWNIKA=".$_SESSION['id_usera_zalog']));

                        if($Czy_ocenione==NULL){

                            if(!((isset($_SESSION['mute']))&&$_SESSION['mute']=='true'))
                            echo '<a href="dodajocenew.php?user='.$_SESSION['id_usera_zalog'].'&idwatku='.$_GET['id'].'&z=m&update=n"><button type="button" class="minu_button">-</button></a>';

                            if($row['OCENA'] < 0)
                            {
                                echo '<k class="licznik1">'.$row['OCENA'].'</k>';
                            }elseif ($row['OCENA'] > 0) {
                                echo '<k class="licznik2">'.$row['OCENA'].'</k>';
                            }else {
                                echo '<k class="licznik3">'.$row['OCENA'].'</k>';
                            }
                            if(!((isset($_SESSION['mute']))&&$_SESSION['mute']=='true'))
                            echo '<a href="dodajocenew.php?user='.$_SESSION['id_usera_zalog'].'&idwatku='.$_GET['id'].'&z=p&update=n"><button type="button" class="plu_button">+</button></a>';
                        }else{
                            if($Czy_ocenione['WARTOSC_OCENY']=="PLUS"){

                                if(!((isset($_SESSION['mute']))&&$_SESSION['mute']=='true'))
                                echo '<a href="dodajocenew.php?user='.$_SESSION['id_usera_zalog'].'&idwatku='.$_GET['id'].'&z=m&update=y"><button type="button" class="minu_button">-</button></a>';
                                    if($row['OCENA'] < 0)
                                    {
                                        echo '<k class="licznik1">'.$row['OCENA'].'</k>';
                                    }elseif ($row['OCENA'] > 0) {
                                        echo '<k class="licznik2">'.$row['OCENA'].'</k>';
                                    }else {
                                        echo '<k class="licznik3">'.$row['OCENA'].'</k>';
                                    }
                            }else{
                                if(!((isset($_SESSION['mute']))&&$_SESSION['mute']=='true'))
                                echo '<a href="dodajocenew.php?user='.$_SESSION['id_usera_zalog'].'&idwatku='.$_GET['id'].'&z=p&update=y"><button type="button" class="plu_button">+</button></a>';
                                    if($row['OCENA'] < 0)
                                    {
                                        echo '<k class="licznik1">'.$row['OCENA'].'</k>';
                                    }elseif ($row['OCENA'] > 0) {
                                        echo '<k class="licznik2">'.$row['OCENA'].'</k>';
                                    }else {
                                        echo '<k class="licznik3">'.$row['OCENA'].'</k>';
                                    }
                                }
                            }

                        $Czy_zgloszone = mysqli_fetch_array($polaczenie->query("SELECT * FROM zgloszenie WHERE ID_WATEK=".$_GET['id']." AND ID_ZGLASZAJACEGO =".$_SESSION['id_usera_zalog']));

                            if ($Czy_zgloszone == NULL) {
                                if (!((isset($_SESSION['mute'])) && $_SESSION['mute'] == 'true'))
                                    echo '<a href="zglos_watek.php?watek=' . $row['ID_WATEK'] . '&user=' . $row['ID_USER'] . '"><button type="button" class="zglos_button">Zgłoś</button></a>';
                            }

                    }
                        if(((isset($_SESSION['admin']))&&($_SESSION['admin']==true))||(isset($_SESSION['id_usera_zalog'])&&($_SESSION['id_usera_zalog']==$row['ID_MODERACJA']))){
                            echo '<a href="admin.php?watek='.$row['ID_WATEK'].'"><button type="button" class="del_button2">Usuń</button></a>';
                        }
                    ?>
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

                if(isset($_POST['komentarz_watek'])&& strlen($_POST['komentarz_watek'])<=2000)
                {
                    echo 'Skomentuj: max 2000 znaków: ';

                    // dodanie do bazy komentarza
                    $id_watku = $_GET['id'];
                    $id_zalogowanego = $_SESSION['id_usera_zalog'];
                    $tresc = $_POST['komentarz_watek'];
                    $tresc = htmlentities($tresc,ENT_QUOTES,"UTF-8");


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
                echo 'Wpisany przez ciebie komentarz jest za długi ( max 2000 znaków)';
                }
                else
                {
                echo 'Skomentuj: max 2000 znaków: ';
                }

                echo '</div>';
                echo '<form method="post" action="watek.php?id='.$_GET['id'].'">';
                echo '<textarea name="komentarz_watek" required="required" ></textarea>';
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
        $row_komentarze_wstep = $polaczenie->query("SELECT * FROM komentarz WHERE ID_WATEK=".$_GET['id']);
        //var_dump($row_komentarze_watku);
        $row_pom = mysqli_fetch_array($row_komentarze_wstep);
        echo'<div class="kom_kom">';
        if($row_pom==NULL){
            echo    '<center>Skomentuj jako pierwszy !</center>';
        }else{
            echo    'Komentarze: ';
        }
        echo '</div>';
        $row_komentarze_wstep->close();



        $row_komentarze_watku = $polaczenie->query("SELECT * FROM komentarz WHERE ID_WATEK=".$_GET['id']." AND STATUS='POTWIERDZONY'");

        $wynik_dla_admina349 = mysqli_fetch_array($polaczenie->query("SELECT * FROM watek WHERE ID_WATEK=".$_GET['id']));

        while($row_komentarz = mysqli_fetch_array($row_komentarze_watku))
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
                    echo '<div class="kom_profilowe" style="background-image:url("../img/profile/' . $row_usera['ZDJECIE'] . '");" alt="zdjecie profilowe" ><img src="img/profile/'.$row_usera['ZDJECIE'].'" alt="zdjecie profilowe"/>';
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
                if($row_komentarz['OCENA'] < 0)
                {
                    echo '<k style="color: #D20D0D; font-weight: 700; ">'.$row_komentarz['OCENA'].'</k>';
                }elseif ($row_komentarz['OCENA'] > 0) {
                    echo '<k style="color: #11C911; font-weight: 700;">'.$row_komentarz['OCENA'].'</k>';
                }else {
                    echo '<k style="color: #E9E94B; font-weight: 700;">'.$row_komentarz['OCENA'].'</k>';
                }
                ?>
            </div>
            <?php
            if((isset($_SESSION['zalogowany']))&&($_SESSION['zalogowany']==true))
            {
                $Czy_ocenione = mysqli_fetch_array($polaczenie->query("SELECT * FROM ocenakomentarz WHERE ID_KOMENTARZA_OCENIONEGO=".$row_komentarz['ID_KOMENTARZ']." AND ID_UZYTKOWNIKA=".$_SESSION['id_usera_zalog']));
                if(!((isset($_SESSION['mute']))&&$_SESSION['mute']=='true'))
                    if($Czy_ocenione==NULL){
                        echo '<a href="dodajocenek.php?user='.$_SESSION['id_usera_zalog'].'&kom='.$row_komentarz['ID_KOMENTARZ'].'&idwatku='.$_GET['id'].'&z=p&update=n"><button type="button" class="plus_button">+</button></a>';
                        echo '<a href="dodajocenek.php?user='.$_SESSION['id_usera_zalog'].'&kom='.$row_komentarz['ID_KOMENTARZ'].'&idwatku='.$_GET['id'].'&z=m&update=n"><button type="button" class="minus_button">-</button></a>';
                    }else{
                        if($Czy_ocenione['WARTOSC_OCENY']=="PLUS"){
                            echo '<a href="dodajocenek.php?user='.$_SESSION['id_usera_zalog'].'&kom='.$row_komentarz['ID_KOMENTARZ'].'&idwatku='.$_GET['id'].'&z=m&update=y"><button type="button" class="minus_button">-</button></a>';
                        }else{
                            echo '<a href="dodajocenek.php?user='.$_SESSION['id_usera_zalog'].'&kom='.$row_komentarz['ID_KOMENTARZ'].'&idwatku='.$_GET['id'].'&z=p&update=y"><button type="button" class="plus_button">+</button></a>';
                        }
                    }
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
            if(((isset($_SESSION['admin']))&&($_SESSION['admin']==true))
                ||
                (isset($_SESSION['id_usera_zalog'])
                    &&
                    ($_SESSION['id_usera_zalog']==$wynik_dla_admina349['ID_MODERACJA']))){

                echo '<div class="kom_adminpanel2">';
                echo '<a href="admin.php?komentarz='.$row_komentarz['ID_KOMENTARZ'].'&id='.$row_komentarz['ID_WATEK'].'"><button type="button" class="del_button">Usuń</button></a>';
                echo '</div>';
            } else {
                echo '<div class="kom_adminpanel2">';
                if((isset($_SESSION['zalogowany']))&&($_SESSION['zalogowany']==true)) {
                    $Czy_zgloszone = mysqli_fetch_array($polaczenie->query("SELECT * FROM zgloszenie WHERE ID_KOMENTARZ=".$row_komentarz['ID_KOMENTARZ']." AND ID_ZGLASZAJACEGO =".$_SESSION['id_usera_zalog']));
                    if($Czy_zgloszone==NULL) {
                        if (!((isset($_SESSION['mute'])) && $_SESSION['mute'] == 'true'))
                            echo '<a href="zglos_komentarz.php?user=' . $row_usera['ID_USER'] . '&kom=' . $row_komentarz['ID_KOMENTARZ'] . '&watek=' . $_GET['id'] . '"><button type="button" class="zglos_buttonuser">Zgłoś</button></a>';
                    }
                }
                echo '</div>';
            }

            ?>
        </div>
    </div>
    <?php
    $wyciagniecie_kom_usera->close();
    }
    $row_komentarze_watku->close();
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