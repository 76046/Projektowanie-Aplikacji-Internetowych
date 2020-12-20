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
            Wybrana waluta: <?php echo $_GET['name']; ?>
        </div>


        <section class="sekcja">

            <table>
                <tr>
                    <th class="panel_artykuly">
                        <?php echo '<a href="transakcja_kupno.php?name='.$_GET['name'].'">Kupno</a>'; ?>
                    </th>
                    <th class="panel_uzytkownicy">
                        <?php echo '<a href="transakcja_sprzedaz.php?name='.$_GET['name'].'">Sprzedaż</a>'; ?>
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
            $rezultat = $polaczenie->query("SELECT * FROM waluta");

            if (!$rezultat)
            {
                throw new Exception($polaczenie->error);
            }
            else
            {
            //$iterator = 0;
            $row = mysqli_fetch_assoc($rezultat);
            ?>
            <div class="wymiana">

                <form>
                    <?php echo '<input type="hidden" id="kod" value="' . $_GET['name'] . '">' ?>
                    <div class="kontener1">Wymieniasz <?php echo $_GET['name']; ?> na PLN</div>
                    <div class="kontener2"><input type="number" id="from" name="from_sprzedaz" class="input1" min="1" max="9999"> ===> <input type="number" id="to" name="to_sprzedaz" class="input2" disabled></div>
                    <div class="kontener3">
                        <div class="lewa">Waluta <?php echo $_GET['name']; ?> ma: <br>
                            Sprzedaż: <input type="number" id="rate" disabled>PLN<br>
                        </div>
                        <div class="prawa">
                            <input type="submit" name="potwierdz_sprzedaz" value="Potwierdź transakcje" class="przycisk_akceptacji">
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
rysowanieStopki();
?>

<script type="text/javascript" src="scripts/transactionS.js"></script>

</body>
</html>
<?php
if(isset($_POST['potwierdz_sprzedaz'])){
    $kod = $_GET['name'];
    $kwotaZ = $_POST['from_sprzedaz'];
    $kwotaDo = $_POST['to_sprzedaz'];
    $user = $_SESSION['id_usera_zalog'];
    if($polaczenie->query("INSERT INTO transakcja VALUES (NULL, $kod, false, $kwotaZ, $kwotaDo, $user)")){
        $polaczenie->close();
        echo("<script>document.location.href = 'podziekowanie.php';</script>");
    }
    else{
        echo $polaczenie->error;
    }

   }
?>
