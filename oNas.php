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
        <h2 class="o-nas-h2">O nas</h2>
        <div class="o-nas-div">
            <p>Nasza firma powstała w 2020 roku. Nasz zespół składa się z 100 doświadczonych specjalistów.
            Nadzorujemy każdą transakcję, tak, by zredukować ryzyko utraty pieniędzy do zera.</p>
        </div>
        </main>
        
        <?php
    include_once('rysowanieStopki.php');
    rysowanieStopki();
    ?>
    </body>
</html>