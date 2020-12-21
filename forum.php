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
                        $iterator =0;


                ?>
                <div class="tabliczki">
                    <table>
                        <form method="post">
                            <tr>
                                <th class="uzytkownik_wst">Temat</th>
                                <th class="liczba_odwiedzin">Wyswietlenia</th>
                                <th class="liczba_odwiedzin">Autor</th>
                                <th class="liczba_odwiedzin">Data Wstawienia</th>
                            </tr>
                            <?php
                            while($row = mysqli_fetch_array($rezultat))
                            {
                                if(($iterator%2)==0)
                                {
                                    ?>
                                    <tr>
                                        <article>
                                            <td class="uzytkownik_wst"><?php echo '<a href="watek.php?id='.$row['ID_WATEK'].'">'.$row['TEMAT'].'</a>'; ?></td>
                                            <td class="liczba_odwiedzin"><?php echo $row['ILOSC_ODWIEDZIN']; ?></td>
                                            <td class="uzytkownik_wst">
                                                <?php
                                                $row_autor = mysqli_fetch_array($wyciagniecie_nicku_autora = $polaczenie->query("SELECT * FROM user WHERE ID_USER=".$row['ID_USER']));
                                                echo '<a href="profilowe.php?user='.$row['ID_USER'].'">'.$row_autor['LOGIN'].'</a>';
                                                ?>
                                            </td>
                                            <td class="uzytkownik_wst"><?php echo $row['DATA']; ?></td>
                                        </article>
                                    </tr>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <tr class="codrugi">
                                        <article>
                                        <td class="uzytkownik_wst"><?php echo '<a href="watek.php?id='.$row['ID_WATEK'].'">'.$row['TEMAT'].'</a>'; ?></td>
                                        <td class="liczba_odwiedzin"><?php echo $row['ILOSC_ODWIEDZIN']; ?></td>
                                        <td class="uzytkownik_wst">
                                            <?php
                                            $row_autor = mysqli_fetch_array($wyciagniecie_nicku_autora = $polaczenie->query("SELECT * FROM user WHERE ID_USER=".$row['ID_USER']));
                                            echo '<a href="profilowe.php?user='.$row['ID_USER'].'">'.$row_autor['LOGIN'].'</a>';
                                            ?>
                                        </td>
                                        <td class="uzytkownik_wst"><?php echo $row['DATA']; ?></td>
                                        </article>
                                    </tr>
                                    <?php
                                }
                                $iterator++;
                            }
                            echo '<tr>
                                              <td colspan="5"><center><a href="stworz_watek.php"><input type="submit" name="stworz_watek" value="Stworz wątek"/></a></center></td>
                                              </tr>';
                            }
                            $rezultat->close();
                            }
                            $polaczenie->close();
                            ?>
                        </form>
                    </table>
                </div>
            </section>
        </main>

    <?php
    include_once('rysowanieStopki.php');
    rysowanieStopki();
    ?>
    </body>
</html>