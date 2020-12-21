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

            <table>
                <tr>
                    <th class="panel_artykuly">
                        <a href="panel_admin_z_k.php">Komentarze</a>
                    </th>
                    <th class="panel_uzytkownicy">
                        <a href="panel_admin_z_w.php">Wątki</a>
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
                        $rezultat = $polaczenie->query("SELECT * FROM zgloszenie WHERE watek_czy_kom='KOM'");

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
                    <tr>
                        <th class="uzytkownik_wst">Temat Watku</th>
                        <th class="czas_wstawienia">Komentarz</th>
                        <th class="liczba_odwiedzin">Zgłaszający</th>
                        <th class="liczba_odwiedzin">Powod</th>
                        <th class="panel_admin">Panel Administratora</th>
                    </tr>
                        <?php
                        while($row = mysqli_fetch_array($rezultat))
                        {

                            $rezultat_usera = mysqli_fetch_array($polaczenie->query("SELECT * FROM `user` WHERE ID_USER=".$row['ID_ZGLASZAJACEGO']));
                            $rezultat_watku = mysqli_fetch_array($polaczenie->query("SELECT * FROM `watek` WHERE ID_WATEK=".$row['ID_WATEK']));
                            $rezultat_komentarza = mysqli_fetch_array($polaczenie->query("SELECT * FROM `komentarz` WHERE ID_KOMENTARZ=".$row['ID_KOMENTARZ']));

                            if(($iterator%2)==0)
                            {
                                ?>
                    <tr>
                        <td class="uzytkownik_wst"><?php  echo '<a href="watek.php?id=' . $row['ID_WATEK'] . '">' . $rezultat_watku['TEMAT'] . '</a>';?></td>
                        <td class="czas_wstawienia"><?php echo '<a title="Osoba komentujaca" href="profilowe.php?user='.$rezultat_komentarza['ID_USER'].'">' .$rezultat_komentarza['TRESC_KOMENTARZA'].'</a>'; ?></td>
                        <td class="liczba_odwiedzin"><?php echo '<a href="profilowe.php?user='.$row['ID_ZGLASZAJACEGO'].'" target=" blank">ID'.$row['ID_ZGLASZAJACEGO'].' '.$rezultat_usera['LOGIN']; ?></td>
                        <td class="liczba_odwiedzin"><?php echo $row['POWOD']; ?></td>
                        <td class="panel_admin">
<?php
if(!($rezultat_usera['UPRAWNIENIA']=='MUTE')){
echo'<a href="admin.php?panel=zgloszenie1&akcja=zmutuj&idusera='.$rezultat_usera['ID_USER'].'"><button type="button" class="mute_glowna" name="butt_glowna" title="Zmutuj użytkownika, który to napisał" method="post">ZU</button></a> ';
}
echo'<a href="admin.php?panel=zgloszenie1&akcja=usunzgloszenie&idzgloszenia='.$row['ID_ZGLOSZENIE'].'"><button type="button" class="del_zgloszenie" name="butt_glowna" title="Usuń zgłoszenie" method="post">UZ</button></a>';

echo'<a href="admin.php?panel=zgloszenie1&akcja=usunkomentarz&idkomentarza='.$rezultat_komentarza['ID_KOMENTARZ'].'"><button type="button" class="del_button" name="butt_del" title="Usuń komentarz" method="post">UK</button></a>';

?>
                        </td>
                    </tr>
                                <?php
                            }
                            else
                            {
                                ?>
                    <tr class="codrugi">
                        <td class="uzytkownik_wst"><?php  echo '<a href="watek.php?id=' . $row['ID_WATEK'] . '">' . $rezultat_watku['TEMAT'] . '</a>';?></td>
                        <td class="czas_wstawienia"><?php echo '<a title="Osoba komentujaca" href="profilowe.php?user='.$rezultat_komentarza['ID_USER'].'">' .$rezultat_komentarza['TRESC_KOMENTARZA'].'</a>'; ?></td>
                        <td class="liczba_odwiedzin"><?php echo '<a href="profilowe.php?user='.$row['ID_ZGLASZAJACEGO'].'" target=" blank">ID'.$row['ID_ZGLASZAJACEGO'].' '.$rezultat_usera['LOGIN']; ?></td>
                        <td class="liczba_odwiedzin"><?php echo $row['POWOD']; ?></td>
                        <td class="panel_admin">
                            <?php
                            if(!($rezultat_usera['UPRAWNIENIA']=='MUTE')){
                            echo'<a href="admin.php?panel=zgloszenie1&akcja=zmutuj&idusera='.$rezultat_usera['ID_USER'].'"><button type="button" class="mute_glowna" name="butt_glowna" title="Zmutuj użytkownika, który to napisał" method="post">ZU</button></a> ';
                            }
                            echo'<a href="admin.php?panel=zgloszenie1&akcja=usunzgloszenie&idzgloszenia='.$row['ID_ZGLOSZENIE'].'"><button type="button" class="del_zgloszenie" name="butt_glowna" title="Usuń zgłoszenie" method="post">UZ</button></a>';

                            echo'<a href="admin.php?panel=zgloszenie1&akcja=usunkomentarz&idzgloszenia='.$row['ID_ZGLOSZENIE'].'"><button type="button" class="del_button" name="butt_del" title="Usuń komentarz" method="post">UK</button></a>';

                            ?>
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
            </div>



        </section>



    </article>


</main>
</body>
</html>