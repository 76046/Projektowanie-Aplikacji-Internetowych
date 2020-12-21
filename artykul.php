<?php
session_start();

?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>KANT-MEN</title>
        <link href="CSS/styleGlowne.css" rel="stylesheet" type="text/css">
        <link href="CSS/styleArtykul.css" rel="stylesheet" type="text/css">
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
                    echo "Error: ".$polaczenie->connect_errno;
                }
                else
                {
                    $rezultat = $polaczenie->query("SELECT * FROM artykul WHERE ID_ARTYKULU=" . $_GET['id']);
                    
                    if(!$rezultat)
                    {
                      throw new Exception($polaczenie->error);
                    }
                    else
                    {
                        $row = mysqli_fetch_assoc($rezultat); ?>
                        <div class="kontener">
                        <div class="zdjecie_artykulu">
                            <?php echo '<img src="img/artykuly/'.$row['ZDJECIE_ARTYKUL'].'" alt="zdjecie"/>' ?>
                        </div>

                        <div class="temat_artykulu">
                            <?php echo $row['TEMAT'] ?>
                        </div>

                        <div class="tresc">
                            <?php echo $row['TRESC'] ?>
                        </div>

                        <div class="dane">
                            <div class="autor">
                                <?php $row_autor = mysqli_fetch_array($wyciagniecie_danych_autora = $polaczenie->query("SELECT * FROM user WHERE ID_USER=" . $row['ID_AUTOR'])); ?>
                                Autor: <?php echo $row_autor['LOGIN'] ?>
                            </div>
                            <div class="data">
                                <?php echo $row['DATA'] ?>
                            </div>
                        </div>
                    </div>
                    
                    <?php
                    
                }
                }
                $rezultat->close();
                
                $polaczenie->close();

            ?>



        </main>
    <?php
    include_once('rysowanieStopki.php');
    rysowanieStopki();
    ?>

    </body>
</html>