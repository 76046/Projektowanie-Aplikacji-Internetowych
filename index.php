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

            <div class="">
                <div>
                    <div>
                        <div>
                            <h2>nagłówek tekstu</h2>
                        </div>
                        <div>
                            <p>treść tekstu</p>
                        </div>
                    </div>
                    <div>
                        <img src="" alt="zdjęcie">
                    </div>
                </div>
                <div>
                    <div>
                        <div>
                            <img src="" alt="ikonka1">
                        </div>
                        <div>
                            <h3>nagłówek1</h3>
                        </div>
                        <div>
                            <p>treść tekstu1</p>
                        </div>
                    </div> 
                    <div>
                        <div>
                            <img src="" alt="ikonka2">
                        </div>
                        <div>
                            <h3>nagłówek2</h3>
                        </div>
                        <div>
                            <p>treść tekstu2</p>
                        </div>
                    </div>
                    <div>
                        <div>
                            <img src="" alt="ikonka3">
                        </div>
                        <div>
                            <h3>nagłówek3</h3>
                        </div>
                        <div>
                            <p>treść tekstu3</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="slider">
                <div class="slides">

                    <input type="radio" name="radio-btn" id="radio1">
                    <input type="radio" name="radio-btn" id="radio2">
                    <input type="radio" name="radio-btn" id="radio3">
                    <input type="radio" name="radio-btn" id="radio4">

                    <div class="slide first">
                        <img src="" alt="zdjęcie1">
                        <div>
                            <h2>Nagłówek artykułu 1</h2>
                        </div>
                    </div>
                    <div class="slide">
                        <img src="" alt="zdjęcie2">
                        <div>
                            <h2>Nagłówek artykułu 2</h2>
                        </div>
                    </div>
                    <div class="slide">
                        <img src="" alt="zdjęcie3">
                        <div>
                            <h2>Nagłówek artykułu 3</h2>
                        </div>
                    </div>
                    <div class="slide">
                        <img src="" alt="zdjęcie4">
                        <div>
                            <h2>Nagłówek artykułu 4</h2>
                        </div>
                    </div>

                    <div class="navigation-auto">
                        <div class="auto-btn1"></div>
                        <div class="auto-btn2"></div>
                        <div class="auto-btn3"></div>
                        <div class="auto-btn4"></div>
                    </div>

                </div>

                <div class="navigation-manual">
                    <label for="radio1" class="manual-btn"></label>
                    <label for="radio2" class="manual-btn"></label>
                    <label for="radio3" class="manual-btn"></label>
                    <label for="radio4" class="manual-btn"></label>
                </div>

            </div>

            <div>
                <div>
                    <h2>Nagrody i wyróżnienia</h2>
                </div>
                <div>
                    <div>
                        <div>
                            <div>
                                <img src="" alt="obrazek1">
                            </div>
                        </div>
                        <div>
                            <p>info o nagrodzie1</p> 
                        </div>
                    </div>
                    <div>
                        <div>
                            <div>
                                <img src="" alt="obrazek2">
                            </div>
                        </div>
                        <div>
                            <p>info o nagrodzie2</p> 
                        </div>
                    </div>
                    <div>
                        <div>
                            <div>
                                <img src="" alt="obrazek3">
                            </div>
                        </div>
                        <div>
                            <p>info o nagrodzie3</p> 
                        </div>
                    </div> 
                </div>
            </div>
        </main>
    <?php
    include_once('rysowanieStopki.php');
    rysowanieStopki();
    ?>
    </body>
</html>