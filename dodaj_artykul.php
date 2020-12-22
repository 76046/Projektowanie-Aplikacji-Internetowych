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
            Dodanie nowego artykułu
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
        <center><input type="file" name="zdjecie" id="zdjecie" accept=".jpg, .jpeg, .png"></center>
        </br>
        <hr>
        </br>
        <div class="pas-tytulowy">
            <input type="submit" name="dodaj_artykul" id="dodaj" value="Dodaj"/>
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
if(isset($_POST['dodaj_artykul'])){
    $user = $_SESSION['id_usera_zalog'];
    $temat = $_POST['temat'];
    $temat = htmlentities($temat,ENT_QUOTES,"UTF-8");
    $tresc = $_POST['tresc'];
    $tresc = htmlentities($tresc,ENT_QUOTES,"UTF-8");
    $target = "img/artykuly/".basename($_FILES['zdjecie']['name']);
    $zdjecie = $_FILES['zdjecie']['name'];
    move_uploaded_file($_FILES['zdjecie']['tmp_name'], $target);
    if($polaczenie->query("INSERT INTO artykul VALUES (NULL, '$zdjecie', '$temat', '$tresc', NULL, '$user', 'UKRYTY')")){
        $polaczenie->close();
        echo("<script>document.location.href = 'panel_admin_a.php';</script>");
    }
    else{
        echo $polaczenie->error;
    }

   }
?>