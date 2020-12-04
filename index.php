<?php


?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>KANT-MEN</title>
        <link href="CSS/styleGlowne.css" rel="stylesheet" type="text/css">
    </head>
    <body onload="currencyConverter();">
    <?php
    include_once('rysowanieMenu.php');
    rysowanieGlownegoMenu();
    ?>
        <main>
            <div class="calculator">
                <h2 class="calculator-header">Kalkulator walutowy</h2>
                <div class="calculator-from">
                    <input id="fromAmount" type="number" value="100" onkeyup="currencyConverter();">
                    <select id="from" onchange="currencyConverter();">
                        <option value="currency">Wybierz walutę</option>
                    </select>
                </div>
                <div class="calculator-span">
                    <span> = </span>
                </div>
                <div class="calculator-to">
                    <input id="toAmount" type="number" disabled>
                    <select id="to" onchange="currencyConverter();">
                        <option value="currency">Wybierz walutę</option>
                    </select>
                </div>
            </div>

            <div class="informacje">
                <div class="transakcja">
                    <div class="transakcja-lewa">
                        <div class="transakcja-lewa-naglowek">
                            <h2>nagłówek tekstu</h2>
                        </div>
                        <div class="transakcja-lewa-tresc">
                            <p>treść tekstu</p>
                        </div>
                    </div>
                    <div class="transakcja-prawa">
                        <img src="" alt="zdjęcie">
                    </div>
                    <div style="clear: both;"></div>
                </div>
                <div class="benefity">
                    <div class="benefit1">
                        <div class="benefit1-img">
                            <img src="" alt="ikonka1">
                        </div>
                        <div class="benefit1-naglowek">
                            <h3>nagłówek1</h3>
                        </div>
                        <div class="benefit1-tresc">
                            <p>treść tekstu1</p>
                        </div>
                    </div> 
                    <div class="benefit2">
                        <div class="benefit2-img">
                            <img src="" alt="ikonka2">
                        </div>
                        <div class="benefit2-naglowek">
                            <h3>nagłówek2</h3>
                        </div>
                        <div class="benefit2-tresc">
                            <p>treść tekstu2</p>
                        </div>
                    </div>
                    <div class="benefit3">
                        <div class="benefit3-img">
                            <img src="" alt="ikonka3">
                        </div>
                        <div class="benefit3-naglowek">
                            <h3>nagłówek3</h3>
                        </div>
                        <div class="benefit3-tresc">
                            <p>treść tekstu3</p>
                        </div>
                    </div>
                    <div style="clear: both;"></div>
                </div>
            </div>

            <div class="slider">
                <div class="slides">

                    <input type="radio" name="radio-btn" id="radio1">
                    <input type="radio" name="radio-btn" id="radio2">
                    <input type="radio" name="radio-btn" id="radio3">
                    <input type="radio" name="radio-btn" id="radio4">

                    <div class="slide first">
                        <div class="slide-img">
                            <img src="" alt="zdjęcie1">
                        </div>                       
                        <div class="slide-naglowek">
                            <h2>Nagłówek artykułu 1</h2>
                        </div>
                    </div>
                    <div class="slide">
                        <div class="slide-img">
                            <img src="" alt="zdjęcie2">
                        </div> 
                        <div class="slide-naglowek">
                            <h2>Nagłówek artykułu 2</h2>
                        </div>
                    </div>
                    <div class="slide">
                        <div class="slide-img">
                            <img src="" alt="zdjęcie3">
                        </div> 
                        <div class="slide-naglowek">
                            <h2>Nagłówek artykułu 3</h2>
                        </div>
                    </div>
                    <div class="slide">
                        <div class="slide-img">
                            <img src="" alt="zdjęcie4">
                        </div> 
                        <div class="slide-naglowek">
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

            <div class="nagrody">
                <div class="nagrody-tytul">
                    <h2>Nagrody i wyróżnienia</h2>
                </div>
                <div class="nagrody-dolne">
                    <div class="nagroda1">
                        <div class="nagroda1-img">
                            <img src="" alt="obrazek1">
                        </div>
                        <div class="nagroda1-info">
                            <p>info o nagrodzie1</p> 
                        </div>
                    </div>
                    <div class="nagroda2">
                        <div class="nagroda2-img">
                            <img src="" alt="obrazek2">
                        </div>
                        <div class="nagroda2-info">
                            <p>info o nagrodzie2</p> 
                        </div>
                    </div>
                    <div class="nagroda3">
                        <div class="nagroda3-img">
                            <img src="" alt="obrazek3">
                        </div>
                        <div class="nagroda3-info">
                            <p>info o nagrodzie3</p> 
                        </div>
                    </div>
                    <div style="clear: both;"></div> 
                </div>
            </div>

            <?php
                include_once('rysowanieStopki.php');
                rysowanieStopki();
            ?>
        </main>

        <script type="text/javascript" src="scripts/currencyConverter.js" async></script>
        <script type="text/javascript">
                    var counter = 1;
                    setInterval(function(){
                        document.getElementById('radio' + counter).checked = true;
                        counter++;
                        if(counter > 4) {
                            counter = 1;
                        }
                    }, 5000);
        </script>

    </body>
</html>