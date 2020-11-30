<?php



?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>KANT-MEN</title>
        <link href="CSS/styleGlowne.css" rel="stylesheet" type="text/css">
        <link href="CSS/styleLogowanie.css" rel="stylesheet" type="text/css">

    </head>
    <body>
    <?php
    include_once('rysowanieMenu.php');
    rysowanieGlownegoMenu();
    ?>
        <main>
            <article class="artykol-logowanie">

                <div class="artykulu-tytul-logowanie">
                    Logowanie
                </div>
                <section class="sekcja-logowania">
                    <div id="logowanie">
                        <form action="ZalogowaniePHP.php" method="post">
                            <?php
                            if((isset($_SESSION['BladLogowania'])))
                            {
                                echo '<div class="nie-posiadasz-konta">Login Lub Haslo jest nie poprawne !</div>';
                            }elseif (isset($_SESSION['ban'])) {
                                echo '<div class="nie-posiadasz-konta">Twoje konto zostało zbanowane !</div>';
                            }

                            ?>

                            <input type="text" placeholder="Login" size="15" maxlength="40" name="User">

                            <input type="password" placeholder="Hasło" size="20" maxlength="40" name="Password">

                            <input type="submit" value="Zaloguj się" name="zal">
                        </form>

                        <form action="rejestracja.php" method="post">
                            <div class="nie-posiadasz-konta">Jeśli nie posiadasz konta</div>
                            <input class="przycisk_log" type="submit" value="Zarejestruj się !">
                        </form>




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