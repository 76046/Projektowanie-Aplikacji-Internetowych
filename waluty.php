<?php


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
                    </tr>

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