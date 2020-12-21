<?php
session_start();

?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>KANT-MEN</title>
        <link href="CSS/styleGlowne.css" rel="stylesheet" type="text/css">
        <link href="CSS/stylePodziekowanie.css" rel="stylesheet" type="text/css">

    </head>
    <body>
    <?php
    include_once('rysowanieMenu.php');
    rysowanieGlownegoMenu();
    ?>


        <main>
            <div class="pas-tytulowy">
                        Transakcja przeprowadzona pomyślnie!</br>
                        Dziękujemy za skorzystanie z naszych usług.</br>
                        Zapraszamy ponownie!
            </div>
        </main>

    <?php
    include_once('rysowanieStopki.php');
    rysowanieStopki();
    ?>
    </body>
</html>