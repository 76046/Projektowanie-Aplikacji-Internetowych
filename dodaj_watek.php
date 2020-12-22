<?php
session_start();
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
    <?php
        require_once "polaczeniezMySQL.php";

        $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);

        if($polaczenie->connect_errno!=0)
        {
            echo "Error: ".$polaczenie->connect_errno;//." Opis ".$polaczenie->connect_error;
        }
        else
        {
        ?>
        <section>
            <form method="post">
            <div class="pas-tytulowy">
                Dodanie nowego wątku
            </div>
            <br class="pas-tytulowy">
            <p>Temat :</p>
            <center><input type="text" name="temat"></center>
            </br>
            <hr>
            </br>
            <p>Treść :</p>
            <center><textarea name="tresc"></textarea></center>
            </div>
            </br>
            <hr>
            </br>
            <div class="pas-tytulowy">
                <input type="submit" name="dodaj_watek" id="dodaj" value="Dodaj"/>
            </div>
            </form>
        </section>
    </main>

    <?php
        }
    include_once('rysowanieStopki.php');
    rysowanieStopki();
    ?>
    </body>
    </html>
    <?php
if(isset($_POST['dodaj_watek'])){
    $user = $_SESSION['id_usera_zalog'];
    $temat = $_POST['temat'];
    $temat = htmlentities($temat,ENT_QUOTES,"UTF-8");
    $tresc = $_POST['tresc'];
    $tresc = htmlentities($tresc,ENT_QUOTES,"UTF-8");
    if($polaczenie->query("INSERT INTO watek VALUES (NULL, '$user', '$temat', NULL, '$tresc', 0, 0, 0, 'OCZEKUJACE', 0)")){
        $row_usera = mysqli_fetch_array($polaczenie->query("SELECT * FROM user WHERE ID_USER=".$_SESSION['id_usera_zalog']));
        $liczba_komentarzy = $row_usera['LICZ_KOMENTARZY'];
        $liczba_komentarzy++;
        if($polaczenie->query("UPDATE `user` SET `LICZ_KOMENTARZY`= $liczba_komentarzy WHERE `ID_USER`=".$_SESSION['id_usera_zalog']))
        $polaczenie->close();
        echo("<script>document.location.href = 'forum.php';</script>");
    }
    else{
        echo $polaczenie->error;
    }

   }
?>