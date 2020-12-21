<?php
session_start();

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
    <article class="artykol">

        <div class="tytul_artykulu">
            Tworzenie wątku
        </div>

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

        <section class="sekcja">
            <form method="post">
                <input type="text" name="temat" id="temat"/>
                <input type="textarea" name="tresc" id="tresc"/>
                <input type="submit" name="dodaj_watek"/>
            </form>
        </section>
    </article>
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
    $tresc = $_POST['tresc'];
    if($polaczenie->query("INSERT INTO watek VALUES (NULL, '$user', '$temat', NULL, '$tresc', 0, 0, 0, 'OCZEKUJACE', 0)")){
        $polaczenie->close();
        echo("<script>document.location.href = 'forum.php';</script>");
    }
    else{
        echo $polaczenie->error;
    }

   }
?>