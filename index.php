<?php


?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>KANT-MEN</title>
        <link href="CSS/styleGlowne.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="scripts/currencyConverter.js" async></script>
    </head>
    <body onload="currencyConverter();">
    <?php
    include_once('rysowanieMenu.php');
    rysowanieGlownegoMenu();
    ?>


        <main>
            <div id="calculator">
                <h2 id="calculator-header">Kalkulator walutowy</h2>
                <div>
                    <input id="fromAmount" type="number" value="100" onkeyup="currencyConverter();">
                    <select id="from" onchange="currencyConverter();">
                        <option value="currency">Wybierz walutę</option>
                    </select>
                </div>
                <span> = </span>
                <div>
                    <input id="toAmount" type="number" disabled>
                    <select id="to" onchange="currencyConverter();">
                        <option value="currency">Wybierz walutę</option>
                    </select>
                </div>
            </div>
        </main>


    <?php
    include_once('rysowanieStopki.php');
    rysowanieStopki();
    ?>
    </body>
</html>