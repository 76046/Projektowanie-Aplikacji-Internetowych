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

          require_once "PolaczeniezMySQL.php";

          $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);

          if($polaczenie->connect_errno!=0)
          {
              echo "Error: ".$polaczenie->connect_errno;
          }
          else
          {
            $rezultat = $polaczenie->query("SELECT * FROM watek WHERE ID_WATEK=".$_GET['id']);

            if(!$rezultat)
            {
              throw new Exception($polaczenie->error);
            }
            else
            {
              while($row = mysqli_fetch_array($rezultat))
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
                <?php $row_autor = mysqli_fetch_array($wyciagniecie_danych_autora = $polaczenie->query("SELECT * FROM user WHERE ID_USER=".$row['ID_USER'])); ?>
                <div class="awatar">
                <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row_autor['ZDJECIE'] ).'" alt="zdjecie"/>;' ?>
                    <!-- avatar -->
                </div>
                <div class="nickname">
                    <?php echo '<a href="user.php?user='.$row['ID_USER'].'" target=" blank"><k style=" font-weight: 700;">'.$row_autor['LOGIN'].'</k></a>'; ?>
                    <!-- adam777 -->
                </div>
            </div>
            <div class="wiadomosc-tresc">
                <div class="czas-wyslania">
                    <?php echo $row['DATA']; ?>
                    <!-- 2020-12-12 20:09 -->
                </div>
                <div class="wiadomosc-trescwiadomosci">
                    <?php echo $row['TRESC_WATKU']; ?>
                    <!-- bla bla bla </br>
                    bla bla bla </br>
                    bla bla bla </br>
                    bla bla bla </br>
                    bla bla bla </br>
                    bla bla bla </br>
                    bla bla bla </br>
                    bla bla bla </br>
                    bla bla bla </br>
                    bla bla bla </br>
                    bla bla bla </br>
                    bla bla bla </br>
                    bla bla bla </br>
                    bla bla bla </br> -->
                </div>
                <div class="panel-spolecznosci-admina">
                    XXXXXx
                </div>
            </div>
            <div style="clear: both;"></div>
        </div>
        <!-- <div class="artykul-wypowiedz">
            <div class="wiadomosc-profil">
                <div class="awatar">avatar</div>
                <div class="nickname">adam777</div>
            </div>
            <div class="wiadomosc-tresc">
                <div class="czas-wyslania">
                    2020-12-12 20:09
                </div>
                <div class="wiadomosc-trescwiadomosci">
                    bla bla bla </br>
                    bla bla bla </br>
                </div>
                <div class="panel-spolecznosci-admina">
                    XXXXXx
                </div>

            </div>
            <div style="clear: both;"></div>
        </div>
        <div class="artykul-wypowiedz">
            <div class="wiadomosc-profil">
                <div class="awatar">avatar</div>
                <div class="nickname">adam777</div>
            </div>
            <div class="wiadomosc-tresc">
                <div class="czas-wyslania">
                    2020-12-12 20:09
                </div>
                <div class="wiadomosc-trescwiadomosci">
                    bla bla bla </br>
                    bla bla bla </br>
                </div>
                <div class="panel-spolecznosci-admina">
                    XXXXXx
                </div>

            </div> -->
            <div style="clear: both;"></div>
        </div>
    </div>
</article>
<?php

    $l_odwiedzin = $row['ILOSC_ODWIEDZIN'];
    $l_odwiedzin++;
    $polaczenie->query("UPDATE `watek` SET `ILOSC_ODWIEDZIN`= $l_odwiedzin WHERE `ID_WATEK`=".$_GET['id']);

                    }
                    }
                    $wyciagniecie_danych_autora->close();
                    $rezultat->close();
                    }
                    $polaczenie->close();
                ?>
</main>

<?php
include_once('rysowanieStopki.php');
rysowanieStopki();
?>
</body>
</html>