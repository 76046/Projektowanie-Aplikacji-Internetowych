<?php
session_start();

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


<main id="main">
    <article>
        <div class="pas-tytulowy">
                Kursy Walut
        </div>
        <form method="post" enctype="multipart/form-data">
        <section class="tablica-walut">
            <div class="tabliczki">
                <!-- <input type="submit" value="Aktualizuj kursy walut" name="aktualizuj" id="aktualizuj"> -->
                <table>
                    <tr>
                        <th class="nazwa-waluty">Waluta</th>
                        <th class="kupno-waluty">Kupno</th>
                        <th class="sprzedaz-waluty">Sprzedaż</th>
                        <th class="operacje-waluty">Operacje</th>
                    </tr>
                    <?php
                    require_once "polaczeniezMySQL.php";

                    $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);

                    if($polaczenie->connect_errno!=0)
                    {
                        echo "Error: ".$polaczenie->connect_errno;
                    }
                    else
                    {
                    $rezultat = $polaczenie->query("SELECT * FROM waluta");

                    if(!$rezultat)
                    {
                        throw new Exception($polaczenie->error);
                    }
                    else
                    {
                        $iterator = 0;
                    while($row = mysqli_fetch_assoc($rezultat))
                    {
                        if(($iterator%2)==0)
                        {
                    ?>
                    <tr>
                        <td class="nazwa-waluty">
                            <div class="flaga">
                                <?php echo '<img src="data:image/jpeg;base64,'.base64_decode($row['FLAGA']).'" alt="flaga"/>;' ?>
                            </div>
                            <div class="nazwa-skrocona">
                                <?php echo $row['KOD_WALUTA']; 
                                echo '<input class="kod-input" type="hidden" name="kod" value="'.$row['KOD_WALUTA'].'">' ?>
                            </div>
                            <div class="nazwa-calkowita">
                                <?php echo $row['NAZWA']; ?>
                            </div>
                        </td>
                        <td class="kupno-waluty">
                            <input class="kupno-input" name="kupno-input" id="fromAmount" type="hidden" disabled>
                            
                        </td>
                        <td class="sprzedaz-waluty">
                            <input class="sprzedaz-input" name="sprzedaz-input" id="fromAmount" type="hidden" disabled>
                            
                        </td>
                        <td class="operacje-waluty">
                        </td>
                    </tr>
                        <?php
                        }
                        else
                        {
                        ?>
                    <tr class="co-drugi">
                        <td class="nazwa-waluty">
                            <div class="flaga">
                                <?php echo '<img src="data:image/jpeg;base64,'.base64_decode($row['FLAGA']).'" alt="flaga"/>;' ?>
                            </div>
                            <div class="nazwa-skrocona">
                                <?php echo $row['KOD_WALUTA']; 
                                echo '<input class="kod-input" type="hidden" name="kod" value="'.$row['KOD_WALUTA'].'">' ?>
                            </div>
                            <div class="nazwa-calkowita">
                                <?php echo $row['NAZWA']; ?>
                            </div>
                        </td>
                        <td class="kupno-waluty">
                            <input class="kupno-input" name="kupno-input" id="fromAmount" type="hidden" disabled>
                            
                        </td>
                        <td class="sprzedaz-waluty">
                            <input class="sprzedaz-input" name="sprzedaz-input" id="fromAmount" type="hidden" disabled>
                            
                        </td>
                        <td class="operacje-waluty">
                        </td>
                    </tr>

                        <?php
                            
                        }
                        $iterator++;
                    }
                    }
                        $rezultat->close();
                    }
                    $polaczenie->close();
                    ?>
                </table>
        </section>
        </form>
    </article>
</main>
<?php
include_once('rysowanieStopki.php');
rysowanieStopki();
?>

<script type="text/javascript" src="scripts/rates.js"></script>

</body>
</html>
<?php
    if(isset($_POST['aktualizuj'])){
        $kupno = $_POST['kupno-input'];
        $sprzedaz = $_POST['sprzedaz-input'];
        if($polaczenie->query("UPDATE waluta SET KUPNO='$kupno',SPRZEDAZ='$sprzedaz' WHERE KOD_WALUTA=".$row['KOD_WALUTA'])){
            echo ' ';
        }  
        else{
            echo $polaczenie->error;
        }     
    }
?>