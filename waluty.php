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
?>


<main>
    <article>
        <div class="pas-tytulowy">
                Kursy Walut
        </div>

        <section class="tablica-walut">
            <div class="tabliczki">
                <table>
                    <tr>
                        <th class="nazwa-waluty">Waluta</th>
                        <th class="kupno-waluty">Kupno</th>
                        <th class="sprzedaz-waluty">Sprzedaż</th>
                        <th class="operacje-waluty">Operacje</th>
                    </tr>
                    <?php
                    require_once "polaczeniezMySQL.php";

                    $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);

                    if($polaczenie->connect_errno!=0)
                    {
                        echo "Error: ".$polaczenie->connect_errno;
                    }
                    else
                    {
                    $rezultat = $polaczenie->query("SELECT * FROM waluta");

                    if(!$rezultat)
                    {
                        throw new Exception($polaczenie->error);
                    }
                    else
                    {
                    while($row = mysqli_fetch_assoc($rezultat))
                    {
                    ?>
                    <tr class="co-drugi">
                        <td class="nazwa-waluty">
                            <div class="flaga">
                                <?php echo '<img src="data:image/jpeg;base64,'.base64_decode($row['FLAGA']).'" alt="flaga"/>;' ?>
                            </div>
                            <div class="nazwa-skrocona">
                                <?php echo $row['KOD_WALUTA']; ?>
                                <!-- USD -->
                            </div>
                            <div class="nazwa-calkowita">
                                <?php echo $row['NAZWA']; ?>
                                <!-- Dolar Amerykański -->
                            </div>
                        </td>
                        <td class="kupno-waluty">
                            <?php echo $row['KUPNO']; ?>
                            <!-- 200 PLN -->
                        </td>
                        <td class="sprzedaz-waluty">
                            <?php echo $row['SPRZEDAZ']; ?>
                            <!-- 100PLN -->
                        </td>
                        <td class="operacje-waluty">

                        </td>
                    </tr>
                    <!-- <tr class="co-drugi">
                        <td class="nazwa-waluty">
                            <div class="flaga"></div>
                            <div class="nazwa-skrocona">USD</div>
                            <div class="nazwa-calkowita">Dolar Amerykański</div>
                        </td>
                        <td class="kupno-waluty">
                            200 PLN
                        </td>
                        <td class="sprzedaz-waluty">
                            100PLN
                        </td>
                        <td class="operacje-waluty">

                        </td>
                    </tr>
                    <tr class="co-drugi">
                        <td class="nazwa-waluty">
                            <div class="flaga"></div>
                            <div class="nazwa-skrocona">USD</div>
                            <div class="nazwa-calkowita">Dolar Amerykański</div>
                        </td>
                        <td class="kupno-waluty">
                            200 PLN
                        </td>
                        <td class="sprzedaz-waluty">
                            100PLN
                        </td>
                        <td class="operacje-waluty">

                        </td>
                    </tr> -->
                        <?php
                    }
                    }
                        $rezultat->close();
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


</body>
</html>