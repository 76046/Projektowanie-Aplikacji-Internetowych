<?php
session_start();

?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>KANT-MEN</title>
        <link href="CSS/styleGlowne.css" rel="stylesheet" type="text/css">
        <link href="CSS/styleForum.css" rel="stylesheet" type="text/css">

    </head>
    <body>
    <?php
    include_once('rysowanieMenu.php');
    rysowanieGlownegoMenu();
    ?>

        <main>
            <section>
                <div class="pas-tytulowy">
                    Forum
                </div>
                <?php
                    require_once "polaczeniezMySQL.php";

                    $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
                    
                    if($polaczenie->connect_errno!=0)
                    {
                        echo "Error: ".$polaczenie->connect_errno;
                    }
                    else
                    {
                        $rezultat = $polaczenie->query("SELECT * FROM watek");

                        if(!$rezultat)
                        {
                        throw new Exception($polaczenie->error);
                        }
                        else
                        {
                        while($row = mysqli_fetch_array($rezultat))
                        {
                ?>
                <article class="artykul">
                    <div class="glowny-kontener-artykulu">
                        <div class="tytul-watku">
                            <?php echo '<a href="watek.php?id='.$row['ID_WATEK'].'">'.$row['TEMAT'].'</a>'; ?>

                        </div>
                        <div class="ilosc-odwiedzin">
                            <?php echo "Wyświetlenia:</br>";
                            echo $row['ILOSC_ODWIEDZIN']; ?>

                        </div>
                        <div class="autor">
                            <?php 
                                $row_autor = mysqli_fetch_array($wyciagniecie_nicku_autora = $polaczenie->query("SELECT * FROM user WHERE ID_USER=".$row['ID_USER']));
                                echo '<a href="profilowe.php?user='.$row['ID_USER'].'"><k style=" font-weight: 700;">Autor:</br>'.$row_autor['LOGIN'].'</k></a>';
                            ?>

                        </div>
                        <div class="czas-wstawienia">
                            <?php echo $row['DATA']; ?>

                        </div>
                        <div class="admin-mini-panel">
                            X
                        </div>
                    </div>
                </article>
                <?php
                    }
                    }

                    $rezultat->close();
                    }
                    $polaczenie->close();
                ?>



            </section>
        </main>

    <?php
    include_once('rysowanieStopki.php');
    rysowanieStopki();
    ?>
    </body>
</html>