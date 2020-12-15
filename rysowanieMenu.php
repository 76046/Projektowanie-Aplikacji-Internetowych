<?php
function rysowanieGlownegoMenu()
{

    ?>
    <header>
        <nav class="nawigacja-menu">
            <div class="nawigacja-czesc-gorna">
                <div class="logo"><a href="index.php"><img src="img/logo/logo-duze.png" alt="logo"></a></div>
                <div class="logowanie-rejestracja">
                    <?php
                    if((isset($_SESSION['zalogowany']))&&($_SESSION['zalogowany']==true))
                    {
                        echo '<a href="profilowe.php?user='.$_SESSION['id_usera_zalog'].'">'.$_SESSION['login_wyswietlanie'].'</a>';
                        echo '<br>';
                        echo '<a href="wylogowanie.php">Wyloguj</a>';
                        if((isset($_SESSION['admin']))&&($_SESSION['admin']==true)){
                            echo '<a href="panel_admin_a.php" ><input type="submit" value="PANEL ADMINA"
                                          style="background-color: #4CAF50;
                                          border: none;
                                          color: white;
                                          padding: 5px 5px;
                                          text-align: center;
                                          text-decoration: none;
                                          display: inline-block;
                                          font-size: 13px;
                                          "></a>';
                        }
                    }
                    else
                    {
                        echo '<a href="logowanie.php">Logowanie</a> / <a href="rejestracja.php">Rejestracja</a>';
                    }
                    ?>
                </div>

                <div style="clear: both;"></div>
            </div>
            <div class="nawigacja-czesc-dolna">
                <div class="strona-glowna"> <a href="index.php" >Strona główna</a></div>
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


