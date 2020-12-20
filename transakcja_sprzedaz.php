<?php
session_start();

?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>KANT-MEN</title>
    <link href="CSS/styleGlowne.css" rel="stylesheet" type="text/css">
    <link href="CSS/styleTransakcja.css" rel="stylesheet" type="text/css">


</head>
<body>
<?php
include_once('rysowanieMenu.php');
rysowanieGlownegoMenu();
?>
<main>
    <article class="artykol">

        <div class="tytul_artykulu">
            Wybrana waluta:
        </div>


        <section class="sekcja">

            <table>
                <tr>
                    <th class="panel_artykuly">
                        <a href="transakcja_kupno.php">Kupno</a>
                    </th>
                    <th class="panel_uzytkownicy">
                        <a href="transakcja_sprzedaz.php">Sprzedaż</a>
                    </th>
                </tr>
            </table>
            <?php

            require_once "polaczeniezMySQL.php";

            $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);

            if($polaczenie->connect_errno!=0)
            {
                echo "Error: ".$polaczenie->connect_errno;//." Opis ".$polaczenie->connect_error;
            }
            else
            {
            $rezultat = $polaczenie->query("SELECT * FROM artykul");

            if (!$rezultat)
            {
                throw new Exception($polaczenie->error);
            }
            else
            {
            $iterator = 0;
            ?>
            <div class="wymiana">

                <form>

                    <div class="kontener1">Wymieniasz --- na PLN</div>
                    <div class="kontener2"><input type="number" class="input1" min="1" max="9999"> ===> <input type="number" class="input2"></div>
                    <div class="kontener3">
                        <div class="lewa">Waluta USD na -godzina- ma: <br>
                            Sprzedaż: 222.2222 PLN<br>
                            </godzina></div>
                        <div class="prawa">
                            <input type="submit" value="Potwierdź transakcje" class="przycisk_akceptacji">
                        </div>
                    </div>

                </form>

            </div>

        </section>
    </article>
</main>
<?php
}
}
include_once('rysowanieStopki.php');
//rysowanieStopki();
?>
</body>
</html>

