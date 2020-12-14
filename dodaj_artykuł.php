<?php
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>KANT-MEN</title>
    <link href="CSS/styleGlowne.css" rel="stylesheet" type="text/css">
    <link href="CSS/styleDodaj_artykul.css" rel="stylesheet" type="text/css">

</head>
<body>
<?php
include_once('rysowanieMenu.php');
rysowanieGlownegoMenu();
?>


<main>
    <section>
        <div class="pas-tytulowy">
            Dodanie nowego wątku
        </div>
        <br class="pas-tytulowy">
        <p>Temat :</p>
        <center><input type="text" required="required"></center>
        </br>
        <hr>
        </br>
        <p>Treść :</p>
        <center><textarea required="required"></textarea></center>
        </div>
        </br>
        <hr>
        </br>
        <div class="pas-tytulowy">
            Dodaj
        </div>
    </section>
</main>

<?php
include_once('rysowanieStopki.php');
rysowanieStopki();
?>
</body>
</html>
