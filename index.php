<?php


?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>KANT-MEN</title>
        <link href="CSS/styleGlowne.css" rel="stylesheet" type="text/css">
        <script>
            function convertCurrency() {
                var from = Document.getElementById("from").value;
                var to = Document.getElementById("to").value;
                var xmlhttp = new XMLHttpRequest();
                var url = "http://api.fixer.io/latest?symbols=" + from + "," + to;
                xmlhttp.open("GET", url, true);
                xmlhttp.send();
                xmlhttp.onreadystatechange = function() {
                    if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        var result = xmlhttp.responseText;
                        var jsResult = JSON.parse(result);
                        var oneUnit = jsResult.rates[to]/jsResult.rates[from];
                        var amt = document.getElementById("fromAmount").value;
                        document.getElementById("toAmount").value = (oneUnit*amt).toFixed(2);
                    }
                }
            }
        </script>
    </head>
    <body>
    <?php
    include_once('rysowanieMenu.php');
    rysowanieGlownegoMenu();
    ?>


        <main>
            <div id="calculator">
                <h2 id="calculator-header">Currency converter</h2>
                <table id="calculator-table">
                    <tr>
                        <td><input id="fromAmount" type="text" value="100" onkeyup="convertCurrency();"></td>
                        <td>
                            <select id="from" onchange="convertCurrency();">
                                <option value="PLN" selected>Polski złoty (PLN)</option>
                                <option value="EUR">Euro (EUR)</option>
                                <option value="USD">Dolar amerykański (USD)</option>
                                <option value="GBP">Funt brytyjski (GBP)</option>
                                <option value="CHF">Frank szwajcarski (CHF)</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><input id="toAmount" type="text" disabled></td>
                        <td>
                            <select id="to" onchange="convertCurrency();">
                                <option value="PLN" selected>Polski złoty (PLN)</option>
                                <option value="EUR">Euro (EUR)</option>
                                <option value="USD" selected>Dolar amerykański (USD)</option>
                                <option value="GBP">Funt brytyjski (GBP)</option>
                                <option value="CHF">Frank szwajcarski (CHF)</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
        </main>


    <?php
    include_once('rysowanieStopki.php');
    rysowanieStopki();
    ?>
    </body>
</html>