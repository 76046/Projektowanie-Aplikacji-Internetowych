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
            <div class="naglowek-walut">
<div class="nazwa-waluty">
    Waluta
</div>
<div class="kupno-waluty">
    Kupno
</div>
<div class="sprzedaz-waluty">
    Sprzedaż
</div>
            </div>
        </section>
    </article>
</main>

<?php
include_once('rysowanieStopki.php');
rysowanieStopki();
?>
</body>
</html>