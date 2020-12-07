<?php


?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>KANT-MEN</title>
        <link href="CSS/styleGlowne.css" rel="stylesheet" type="text/css">
        <link href="CSS/styleForum.css" rel="stylesheet" type="text/css">

    </head>
    <body>
    <?php
    include_once('rysowanieMenu.php');
    rysowanieGlownegoMenu();
    ?>

        <main>
            <section>
                <div class="pas-tytulowy">
                    Forum
                </div>
                <article class="artykul">
                    <div class="glowny-kontener-artykulu">
                        <div class="tytul-watku">
                            Tytuł Tytuł Tytuł Tytuł Tytuł Tytuł
                        </div>
                        <div class="ilosc-odwiedzin">
270
                        </div>
                        <div class="autor">
Adam777
                        </div>
                        <div class="czas-wstawienia">
2020-12-05 12:30
                        </div>
                        <div class="admin-mini-panel">
X
                        </div>
                    </div>
                </article>
                <article class="artykul">
                    <div class="glowny-kontener-artykulu">
                        <div class="tytul-watku">
                            Tytuł Tytuł Tytuł Tytuł Tytuł Tytuł
                        </div>
                        <div class="ilosc-odwiedzin">
                            270
                        </div>
                        <div class="autor">
                            Adam777
                        </div>
                        <div class="czas-wstawienia">
                            2020-12-05 12:30
                        </div>
                        <div class="admin-mini-panel">
                            X
                        </div>
                    </div>
                </article>
                <article class="artykul">
                    <div class="glowny-kontener-artykulu">
                        <div class="tytul-watku">
                            Tytuł Tytuł Tytuł Tytuł Tytuł Tytuł
                        </div>
                        <div class="ilosc-odwiedzin">
                            270
                        </div>
                        <div class="autor">
                            Adam777
                        </div>
                        <div class="czas-wstawienia">
                            2020-12-05 12:30
                        </div>
                        <div class="admin-mini-panel">
                            X
                        </div>
                    </div>
                </article>

            </section>
        </main>

    <?php
    include_once('rysowanieStopki.php');
    rysowanieStopki();
    ?>
    </body>
</html>