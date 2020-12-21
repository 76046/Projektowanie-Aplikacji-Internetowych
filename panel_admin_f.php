<?php
session_start();

?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>KANT-MEN</title>
    <link href="CSS/styleGlowne.css" rel="stylesheet" type="text/css">
    <link href="CSS/stylePanelAdmina.css" rel="stylesheet" type="text/css">

</head>
<body>
<?php
include_once('rysowanieMenu.php');
rysowanieGlownegoMenu();
?>

<main>
    <article class="artykol">

        <div class="tytul_artykulu">
            Panel Administracyjny
        </div>


        <section class="sekcja">

            <table>
                <tr>
                    <th class="panel_artykuly">
                        <a href="panel_admin_a.php">Artykuly</a>
                    </th>
                    <th class="panel_uzytkownicy">
                        <a href="panel_admin_u.php">Użytkownicy</a>
                    </th>
                    <th class="panel_forum">
                        <a href="panel_admin_f.php">Forum</a>
                    </th>
                    <th class="panel_zgloszenia">
                        <a href="panel_admin_z_k.php">Zgłoszenia</a>
                    </th>
                </tr>
            </table>
                        <?php

                        require_once "polaczeniezMySQL.php";

                        $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);

                        if($polaczenie->connect_errno!=0)
                        {
                            echo "Error: ".$polaczenie->connect_errno;//." Opis ".$polaczenie->connect_error;
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
                        $iterator = 0;
                        ?>
            <div class="tabliczki">
                <table>
                    <form method="post">
                    <tr>
                        <th class="uzytkownik_wst">Temat</th>
                        <th class="liczba_odwiedzin">Autor</th>
                        <th class="liczba_odwiedzin">Data wstawienia</th>
                        <th class="liczba_odwiedzin">STAN</th>
                        <th class="panel_admin">Panel Administratora</th>
                    </tr>
                    <?php
                    while($row = mysqli_fetch_array($rezultat))
                    {


                        $rezultat_watku = mysqli_fetch_array($polaczenie->query("SELECT * FROM `watek` WHERE ID_WATEK=".$row['ID_WATEK']));
                        $rezultat_usera_watku = mysqli_fetch_array($polaczenie->query("SELECT * FROM `user` WHERE ID_USER=".$rezultat_watku['ID_USER']));

                        //var_dump($rezultat_loginu);

                        if(($iterator%2)==0)
                        {
                    ?>
                    <tr>
                        <td class="uzytkownik_wst"><?php  echo '<a href="watek.php?id=' . $row['ID_WATEK'] . '">' . $rezultat_watku['TEMAT'] . '</a>';?></td>
                        <td class="liczba_odwiedzin"><?php echo '<a href="profilowe.php?user='.$rezultat_usera_watku['ID_USER'].'" target=" blank">ID'.$rezultat_usera_watku['ID_USER'].' '.$rezultat_usera_watku['LOGIN']; ?></td>
                        <td class="uzytkownik_wst"><?php  echo $rezultat_watku['DATA'];?></td>
                        <td class="uzytkownik_wst"><?php  echo $rezultat_watku['STATUS'];?></td>
                        <td class="panel_admin">
                            <select name=<?php echo $row['ID_WATEK'];?> >
                                <?php
                                if($rezultat_watku['ID_MODERACJA']==0){
                                    echo '<option value="Brak" selected>Nie wybrano</option>';
                                }else{
                                    echo '<option value="Brak">Nie wybrano</option>';
                                }
                                $rezultat_modow = $polaczenie->query("SELECT * FROM user WHERE UPRAWNIENIA='MOD'");
                            while ($mody = mysqli_fetch_assoc($rezultat_modow)) {
                                echo '<option value="'.$row['LOGIN'].'"';

                                if($row['ID_MODERACJA'] == $mody['ID_USER'])
                                {
                                    echo 'selected';
                                }
                                echo '>';
                                echo $mody['LOGIN'];
                                echo '</option>';
                                }
                                ?>
                            </select>
                        </td>

                    </tr>
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                    <tr class="codrugi">
                        <td class="uzytkownik_wst"><?php  echo '<a href="watek.php?id=' . $row['ID_WATEK'] . '">' . $rezultat_watku['TEMAT'] . '</a>';?></td>
                        <td class="liczba_odwiedzin"><?php echo '<a href="profilowe.php?user='.$rezultat_usera_watku['ID_USER'].'" target=" blank">ID'.$rezultat_usera_watku['ID_USER'].' '.$rezultat_usera_watku['LOGIN']; ?></td>
                        <td class="uzytkownik_wst"><?php  echo $rezultat_watku['DATA'];?></td>
                        <td class="uzytkownik_wst"><?php  echo $rezultat_watku['STATUS'];?></td>
                        <td class="panel_admin">
                            <select name=<?php echo $row['ID_WATEK'];?> >
                                <?php
                                if($rezultat_watku['ID_MODERACJA']==0){
                                    echo '<option value="Brak" selected>Nie wybrano</option>';
                                }else{
                                    echo '<option value="Brak">Nie wybrano</option>';
                                }
                                $rezultat_modow = $polaczenie->query("SELECT * FROM user WHERE UPRAWNIENIA='MOD'");
                                while ($mody = mysqli_fetch_assoc($rezultat_modow)) {
                                    echo '<option value="'.$row['LOGIN'].'"';

                                    if($row['ID_MODERACJA'] == $mody['ID_USER'])
                                    {
                                        echo 'selected';
                                    }

                                    echo '>';
                                    echo $mody['LOGIN'];
                                    echo '</option>';
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                                        <?php
                                            }
                                            $iterator++;
                                        }
                                        echo '<tr>
                                              <td colspan="5"><input type="submit" name="Zaktualizuj" value="Zaktualizuj"/></td>
                                              </tr>';
                                        }
                                        $rezultat->close();
                                        }
                                        $polaczenie->close();
                                        ?>
                    </form>
                    <?php
                    if (isset($_POST['wybor_kontynentu'])) {}



                    ?>
                </table>
            </div>
        </section>
    </article>
</main>
</body>
</html>