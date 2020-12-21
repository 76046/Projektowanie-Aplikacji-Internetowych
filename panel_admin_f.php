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
                        if((isset($_SESSION['admin']))&&($_SESSION['admin']==true)){
                            $rezultat = $polaczenie->query("SELECT * FROM watek ORDER BY `DATA` DESC");
                        }  else{
                            $rezultat = $polaczenie->query("SELECT * FROM watek WHERE ID_MODERACJA=".$_SESSION['id_usera_zalog']." ORDER BY `DATA` DESC");
                        }


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
                    <form method="post" action="#">
                    <tr>
                        <th class="uzytkownik_wst">Temat</th>
                        <th class="liczba_odwiedzin">Autor</th>
                        <th class="liczba_odwiedzin">Data wstawienia</th>
                        <th class="liczba_odwiedzin">STAN</th>
                        <th class="panel_admin">Panel</th>
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
                            <?php
                            if((isset($_SESSION['admin']))&&($_SESSION['admin']==true)) {
                                ?>
                                <select name=<?php echo $row['ID_WATEK']; ?>>
                                    <?php
                                    if ($rezultat_watku['ID_MODERACJA'] == 0) {
                                        echo '<option value="Brak" selected>Nie wybrano</option>';
                                    } else {
                                        echo '<option value="Brak">Nie wybrano</option>';
                                    }
                                    $rezultat_modow = $polaczenie->query("SELECT * FROM user WHERE UPRAWNIENIA='MOD'");
                                    while ($mody = mysqli_fetch_assoc($rezultat_modow)) {
                                        echo '<option value="' . $mody['ID_USER'] . '"';

                                        if ($row['ID_MODERACJA'] == $mody['ID_USER']) {
                                            echo 'selected';
                                        }

                                        echo '>';
                                        echo $mody['LOGIN'];
                                        echo '</option>';
                                    }
                                    ?>
                                </select>
                                <?php
                            }else{
                                if ($row['STATUS']=='OCZEKUJACE'){
                                    echo'<a href="admin.php?panel=forum&akcja=akceptuj&idwatku='.$row['ID_WATEK'].'"><button type="button" class="mute_button" name="butt_ban" title="Zakceptuj temat" method="post">✅</button></a>';
                                    echo'<a href="admin.php?panel=forum&akcja=odrzuc&idwatku='.$row['ID_WATEK'].'"><button type="button" class="ban_button" name="butt_ban" title="Odrzuć temat" method="post">❌</button></a>';

                                }else if($row['STATUS']=='POTWIERDZONE') {
                                    echo '<a href="admin.php?panel=forum&akcja=odrzuc&idwatku=' . $row['ID_WATEK'] . '"><button type="button" class="ban_button" name="butt_ban" title="Odrzuć temat" method="post">❌</button></a>';
                                }else{
                                    echo'<a href="admin.php?panel=forum&akcja=akceptuj&idwatku='.$row['ID_WATEK'].'"><button type="button" class="mute_button" name="butt_ban" title="Zakceptuj temat" method="post">✅</button></a>';
                                }
                            }

                                ?>
                        </td>
                    </tr>
                        <?php
                            $wyciagniecie_oczekujacych_komentarzy = $polaczenie->query("SELECT * FROM komentarz WHERE ID_WATEK=".$row['ID_WATEK']." AND STATUS='OCZEKUJACY'");

                            if(!($wyciagniecie_oczekujacych_komentarzy==NULL)){

                            echo '<tr><td colspan="5">Niezakceptowane komentarze</td></tr>';

                            ?>
                            <tr>
                                <td class="uzytkownik_wst"></td>
                                <td class="liczba_odwiedzin"><?php echo '<a href="profilowe.php?user='.$rezultat_usera_watku['ID_USER'].'" target=" blank">ID'.$rezultat_usera_watku['ID_USER'].' '.$rezultat_usera_watku['LOGIN']; ?></td>
                                <td class="uzytkownik_wst"><?php  echo $rezultat_watku['DATA'];?></td>
                                <td class="uzytkownik_wst"><?php  echo $rezultat_watku['STATUS'];?></td>
                                <td class="panel_admin">
                                    <?php


                                    ?>
                                </td>
                            </tr>










                            <?php
                            }
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
                            <?php
                            if((isset($_SESSION['admin']))&&($_SESSION['admin']==true)) {
                                ?>
                            <select name=<?php echo $row['ID_WATEK'];?> >
                                <?php
                                if($rezultat_watku['ID_MODERACJA']==0){
                                    echo '<option value="Brak" selected>Nie wybrano</option>';
                                }else{
                                    echo '<option value="Brak">Nie wybrano</option>';
                                }
                                $rezultat_modow = $polaczenie->query("SELECT * FROM user WHERE UPRAWNIENIA='MOD'");
                                while ($mody = mysqli_fetch_assoc($rezultat_modow)) {
                                    echo '<option value="'.$mody['ID_USER'].'"';

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
                            <?php
                            }else{
                                if ($row['STATUS']=='OCZEKUJACE'){
                                    echo'<a href="admin.php?panel=forum&akcja=akceptuj&idwatku='.$row['ID_WATEK'].'"><button type="button" class="mute_button" name="butt_ban" title="Zakceptuj temat" method="post">✅</button></a>';
                                    echo'<a href="admin.php?panel=forum&akcja=odrzuc&idwatku='.$row['ID_WATEK'].'"><button type="button" class="ban_button" name="butt_ban" title="Odrzuć temat" method="post">❌</button></a>';

                                }else if($row['STATUS']=='POTWIERDZONE') {
                                    echo '<a href="admin.php?panel=forum&akcja=odrzuc&idwatku=' . $row['ID_WATEK'] . '"><button type="button" class="ban_button" name="butt_ban" title="Odrzuć temat" method="post">❌</button></a>';
                                }else{
                                    echo'<a href="admin.php?panel=forum&akcja=akceptuj&idwatku='.$row['ID_WATEK'].'"><button type="button" class="mute_button" name="butt_ban" title="Zakceptuj temat" method="post">✅</button></a>';
                                }
                            }
                            ?>
                        </td>
                    </tr>
                                        <?php
                                            }
                                            $iterator++;
                                        }
                                            if((isset($_SESSION['admin']))&&($_SESSION['admin']==true)){
                                                echo '<tr><td colspan="5"><a href="panel_admin_f.php"><input type="submit" name="Zaktualizuj" value="Zaktualizuj"/></a></td></tr>';
                                            }
                                        }
                                        $rezultat->close();
                                        }
                                        ?>
                    </form>
                    <?php
                    if (isset($_POST['Zaktualizuj'])) {
                        $wczytanie = $polaczenie->query("SELECT * FROM watek");

                    while($row = mysqli_fetch_array($wczytanie))
                    {
                        //echo 'IDWatku:'.$row['ID_WATEK'].'</br>';
                        $zmienna = $row['ID_WATEK'];
                        //echo 'IDAdmina:'.$_POST[$zmienna].'</br>';
                        $rezultat = $polaczenie->query("UPDATE `watek` SET `ID_MODERACJA` = '.$_POST[$zmienna].' WHERE `ID_WATEK`=".$row['ID_WATEK']);
                    }
                        $polaczenie->close();
                        echo("<script>document.location.href = 'panel_admin_f.php';</script>");
                    }
                    ?>
                </table>
            </div>
        </section>
    </article>
</main>
</body>
</html>
<?php
$polaczenie->close();
?>
