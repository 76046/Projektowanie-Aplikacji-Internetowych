<?php
session_start();

require_once "polaczeniezMySQL.php";

$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);

if($polaczenie->connect_errno!=0)
{
    echo "Error: ".$polaczenie->connect_errno;//." Opis ".$polaczenie->connect_error;
}
else
{
$rezultat = $polaczenie->query("SELECT * FROM user WHERE ID_USER=" . $_GET['user']);

if (!$rezultat)
{
    throw new Exception($polaczenie->error);
}
else
{

$row = mysqli_fetch_array($rezultat);

?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Kantman</title>
    <meta charset="UTF-8">
    <link href="CSS/styleGlowne.css" rel="stylesheet" type="text/css">
    <link href="CSS/styleProfilowe.css" rel="stylesheet" type="text/css">
</head>

<body>

<?php
include_once('rysowanieMenu.php');
rysowanieGlownegoMenu();
?>

<main>
    <article class="artykol">
    <form method="post" enctype="multipart/form-data">
        <div class="lewybaner">
            <div class="pro_avatar">
                <?php
                if ($row['ZDJECIE'] != NULL) {
                    echo '<div class="p_avatar" style="background-image:url("data:image/jpeg;base64,' . base64_decode($row['ZDJECIE']) . '");" alt="zdjecie profilowe" />';
                } else {
                    echo '<div class="p_avatar" alt="zmienilo" />';
                }
                ?>
            </div>
            <div class="pro_statystyki">
                <div class="staty2" id="zdjecie"><input type="file" name="zdjecie" accept=".jpg, .jpeg, .png"></div>
                <div class="staty2">Statystyki</div>
                <div class="staty2">Liczba utworzonych wątków</div>
                <div class="staty2"><?php echo $row['STW_WATKI']; ?></div>
                <div class="staty2">Liczba</br>komentarzy</div>
                <div class="staty2"><?php echo $row['LICZ_KOMENTARZY']; ?></div>
            </div>
        </div>
        </div>
        <div class="prawybaner">
            <div class="pro_nicname">
            </div>
            <div class="pro_szczegolowe">
                <div class="lewy_szcz">
                    <div class="staty">Imie:</div>
                    <div class="staty">Nazwisko:</div>
                    <div class="staty">Email:</div>
                    <div class="staty">Miasto:</div>
                    <div class="staty">Wiek:</div>
                    <div class="staty">Kraj:</div>
                </div>
                <div class="prawy_szcz">
                <?php $id = $row['ID_USER'];
                echo '<input type="hidden" name="id" value="'.$id.'">' ?>
                <div class="staty" id="imie">
                    <?php $imie = $row['IMIE'];
                    echo '<input type="text" name="imie" value="'.$imie.'">'; ?>
                </div>
                <div class="staty" id="nazwisko">
                    <?php $nazwisko = $row['NAZWISKO'];
                    echo '<input type="text" name="nazwisko" value="'.$nazwisko.'">'; ?>
                </div>
                <div class="staty" id="email">
                    <?php $email = $row['EMAIL'];
                    echo '<input type="text" name="email" value="'.$email.'">'; ?>
                </div>
                <div class="staty" id="miasto">
                    <?php $miasto = $row['MIASTO'];
                    echo '<input type="text" name="miasto" value="'.$miasto.'">'; ?>
                </div>
                <div class="staty" id="wiek">
                    <?php $wiek = $row['WIEK'];
                    echo '<input type="text" name="wiek" value="'.$wiek.'">'; ?>
                </div>
                <div class="staty" id="kraj">
                    <?php $kraj = $row['KRAJ'];
                    echo '<input type="text" name="kraj" value="'.$kraj.'">'; ?>
                </div>
                </div>
                <div class="o_sobie">Coś o sobie:</div>
                <div class="staty-opis" id="opis">
                    <?php $opisProfilu = $row['OPIS_PROFILU'];
                    echo '<input type="textarea" name="opis" value="'.$opisProfilu.'">'; ?>
                </div>
            </div>
            <div class="edycjaProfilu"><input type="submit" value="Zapisz i wróć" name="edytuj_profil"></div>
        </div>
        <div class="koniec"></div>
    </form>
    </article>
    <?php
    }
    
    }
    ?>


</main>

<?php
include_once('rysowanieStopki.php');
rysowanieStopki();
?>

</body>
</html>
<?php
      if(isset($_POST['edytuj_profil'])){
        $id = $_POST['id'];
        //$zdjecie = $_POST['zdjecie'];
        $imie = $_POST['imie'];
        $nazwisko = $_POST['nazwisko'];
        $email = $_POST['email'];
        $miasto = $_POST['miasto'];
        $wiek = $_POST['wiek'];
        $kraj = $_POST['kraj'];
        $opis = $_POST['opis'];
        //$query = "UPDATE user SET IMIE='$imie',NAZWISKO='$nazwisko', EMAIL='$email', MIASTO='$miasto', WIEK=$wiek, KRAJ='$kraj', OPIS='$opis' WHERE USER_ID=".$_GET['user'];
        // $result = mysqli_query($db, $query) or die(mysqli_error($db));
        if($polaczenie->query("UPDATE user SET IMIE='$imie',NAZWISKO='$nazwisko', EMAIL='$email', MIASTO='$miasto', WIEK=$wiek, KRAJ='$kraj', OPIS_PROFILU='$opis' WHERE ID_USER='$id'")){
            $polaczenie->close();
            echo("<script>document.location.href = 'profilowe.php?user=".$row['ID_USER']."';</script>");
        }
        else{
            echo $polaczenie->error;
        }

       }
$polaczenie->close();
?>