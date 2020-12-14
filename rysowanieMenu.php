<?php
function rysowanieGlownegoMenu()
{

    ?>
    <header>
        <nav class="nawigacja-menu">
            <div class="nawigacja-czesc-gorna">
                <div class="logo"><a href="index.php"><img id="logo" src="img/logo/logo-duze.png" alt="logo"></a></div>
                <div class="logowanie-rejestracja"><a href="logowanie.php">Logowanie</a>/ <a href="rejestracja.php">Rejestracja</a></div>
                <div style="clear: both;"></div>
            </div>
            <div class="nawigacja-czesc-dolna">
                <div class="strona-glowna"> <a href="index.php"  >Strona główna</a></div>
                <div class="kurs-walut"> <a href="waluty.php">Kursy Walut</a></div>
                <div class="kurs-kruszcow"> <a href="kruszce.php">Kursy Kruszców</a></div>
                <div class="forum"> <a href="forum.php">Forum</a></div>
                <div style="clear: both;"></div>
            </div>
        </nav>
    </header>

    <?php
}
?>


