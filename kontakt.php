<?php

?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>KANT-MEN</title>
        <link href="CSS/styleGlowne.css" rel="stylesheet" type="text/css">
    </head>
    <body>
    <?php
    include_once('rysowanieMenu.php');
    rysowanieGlownegoMenu();
    ?>
        <main>
        <h2 class="kontakt-h2">Kontakt</h2>
        <div class="kontakt-div">
            Białystok </br> ul. Lipowa 12 lok. 23 </br> Telefon: 123456789 </br> Email: kant-men@wp.pl
        </div>
        </main>
        
        <?php
    include_once('rysowanieStopki.php');
    rysowanieStopki();
    ?>
    </body>
</html>