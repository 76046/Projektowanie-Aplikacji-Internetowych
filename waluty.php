<?php
session_start();

?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>KANT-MEN</title>
    <link href="CSS/styleGlowne.css" rel="stylesheet" type="text/css">
    <link href="CSS/styleWalutyKruszce.css" rel="stylesheet" type="text/css">

</head>
<body>
<?php
include_once('rysowanieMenu.php');
rysowanieGlownegoMenu();
require_once "polaczeniezMySQL.php";
$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);

if($polaczenie->connect_errno!=0)
{
    echo "Error: ".$polaczenie->connect_errno;
}
else
{
if(!isset($_POST['wybor_kontynentu'])){
    $_POST['wybor_kontynentu'] = "wszystkie";
}

?>
<main id="main">
    <article>
        <div class="pas-tytulowy">
            Kursy Walut
        </div>
        <section class="tablica-walut">
            <div class="tabliczki">
                <!-- <input type="submit" value="Aktualizuj kursy walut" name="aktualizuj" id="aktualizuj"> -->
                <form method="post">
                                <select name="wybor_kontynentu">
                                    <?php
                                    echo '<option value="wszystkie"';

                                    if(!isset($_POST['wybor_kontynentu'])){
                                        echo 'selected';
                                    }

                                    echo '>Wszystkie</option>';
                                    $rezultat = $polaczenie->query("SELECT DISTINCT kontynent FROM waluta");
                                    while ($row = mysqli_fetch_assoc($rezultat)) {
                                        echo '<option value="' . $row['kontynent'].'"';

                                        if(isset($_POST['wybor_kontynentu'])){
                                            if($_POST['wybor_kontynentu'] == $row['kontynent'])
                                            {
                                                echo 'selected';
                                            }
                                        }

                                        echo '>';
                                        if ($row['kontynent'] == "AM_N") {
                                            echo 'Ameryka Północna';
                                        } elseif ($row['kontynent'] == "AM_S") {
                                            echo 'Ameryka Południowa';
                                        } elseif ($row['kontynent'] == "EUROPA") {
                                            echo 'Europa';
                                        } elseif ($row['kontynent'] == "AZJA") {
                                            echo 'Azja';
                                        } elseif ($row['kontynent'] == "OCEANIA") {
                                            echo 'Oceania';
                                        } elseif ($row['kontynent'] == "AFRYKA") {
                                            echo 'Afryka';
                                        }
                                        echo '</option>';
                                    }
                                    ?>
                                </select>
                                <input type="submit" name="refresh" value="Odśwież"/>
                            </form>
                <table class="table">
                    <tr class="thead">
                        <th class="nazwa-waluty">Waluta
                            
                        </th>
                        <th class="kupno-waluty">Kupno</th>
                        <th class="sprzedaz-waluty">Sprzedaż</th>
                        <th class="operacje-waluty">Operacje</th>
                    </tr>
                    <?php


                    if (isset($_POST['wybor_kontynentu'])) {
                        $value = $_POST['wybor_kontynentu'];
                        if ($value == "wszystkie") {
                            $rezultat = $polaczenie->query("SELECT * FROM waluta");
                        } else {
                            $rezultat = $polaczenie->query("SELECT * FROM waluta WHERE KONTYNENT='$value'");
//                            echo var_dump($rezultat);
//                            echo '</br>';
//                            echo var_dump($value);
                        }

                        if (!$rezultat) {
                            throw new Exception($polaczenie->error);
                        } else {
                            $iterator = 0;
                            while ($row = mysqli_fetch_assoc($rezultat)) {
                                if (($iterator % 2) == 0) {
                                    ?>
                                    <tr class="tr">
                                        <td class="nazwa-waluty">
                                            <div class="flaga">
                                                <?php echo '<img src="data:image/svg+xml;base64,' . $row['FLAGA'] . '" alt="flaga"/>' ?>
                                            </div>
                                            <div class="nazwa-skrocona">
                                                <?php echo $row['KOD_WALUTA'];
                                                echo '<input class="kod-input" type="hidden" name="kod" value="' . $row['KOD_WALUTA'] . '">' ?>
                                            </div>
                                            <div class="nazwa-calkowita">
                                                <?php echo $row['NAZWA']; ?>
                                            </div>
                                        </td>
                                        <td data-label="Kupno" class="kupno-waluty">
                                            <input class="kupno-input" name="kupno-input" id="fromAmount" type="hidden"
                                                   disabled>

                                        </td>
                                        <td data-label="Sprzedaż" class="sprzedaz-waluty">
                                            <input class="sprzedaz-input" name="sprzedaz-input" id="fromAmount"
                                                   type="hidden" disabled>

                                        </td>
                                        <td data-label="Operacje" class="operacje-waluty">
                                        </td>
                                    </tr>
                                    <?php
                                } else {
                                    ?>
                                    <tr class="co-drugi">
                                        <td class="nazwa-waluty">
                                            <div class="flaga">
                                                <?php echo '<img src="data:image/svg+xml;base64,' . $row['FLAGA'] . '" alt="flaga"/>' ?>
                                            </div>
                                            <div class="nazwa-skrocona">
                                                <?php echo $row['KOD_WALUTA'];
                                                echo '<input class="kod-input" type="hidden" name="kod" value="' . $row['KOD_WALUTA'] . '">' ?>
                                            </div>
                                            <div class="nazwa-calkowita">
                                                <?php echo $row['NAZWA']; ?>
                                            </div>
                                        </td>
                                        <td data-label="Kupno" class="kupno-waluty">
                                            <input class="kupno-input" name="kupno-input" id="fromAmount" type="hidden"
                                                   disabled>

                                        </td>
                                        <td data-label="Sprzedaż" class="sprzedaz-waluty">
                                            <input class="sprzedaz-input" name="sprzedaz-input" id="fromAmount"
                                                   type="hidden" disabled>

                                        </td>
                                        <td data-label="Operacje" class="operacje-waluty">
                                        </td>
                                    </tr>

                                    <?php

                                }
                                $iterator++;
                            }
                        }
                        $rezultat->close();
                    }
                    }
                    $polaczenie->close();
                    ?>
                </table>
        </section>

    </article>
</main>
<?php
include_once('rysowanieStopki.php');
rysowanieStopki();
?>

<script type="text/javascript" src="scripts/rates.js"></script>

</body>
</html>
<?php
    if(isset($_POST['aktualizuj'])){
        $kupno = $_POST['kupno-input'];
        $sprzedaz = $_POST['sprzedaz-input'];
        if($polaczenie->query("UPDATE waluta SET KUPNO='$kupno',SPRZEDAZ='$sprzedaz' WHERE KOD_WALUTA=".$row['KOD_WALUTA'])){
            echo ' ';
        }  
        else{
            echo $polaczenie->error;
        }     
    }
?>