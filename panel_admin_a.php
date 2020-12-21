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
            $rezultat = $polaczenie->query("SELECT * FROM artykul");

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
                        <th class="uzytkownik_wst">Temat</th>
                        <th class="czas_wstawienia">Autor</th>
                        <th class="liczba_odwiedzin">Czas wstawienia</th>
                        <th class="panel_admin">Panel Administratora</th>
                    </tr>
                    <?php
                    while($row = mysqli_fetch_array($rezultat))
                    {

                        $rezultat_loginu = mysqli_fetch_array($polaczenie->query("SELECT * FROM user WHERE ID_USER=".$row['ID_AUTOR']));
                        //var_dump($rezultat_loginu);

                        if(($iterator%2)==0)
                        {
                            ?>
                            <tr>
                            <td class="uzytkownik_wst"><?php echo '<a href="artykul.php?id='.$row['ID_ARTYKULU'].'">'.$row['TEMAT'].'</a>' ;?></td>
                            <td class="czas_wstawienia"><?php echo'<a href="profilowe.php?user='.$rezultat_loginu['ID_USER'].'">'.$rezultat_loginu['LOGIN'].'</a>';?></td>
                            <td class="liczba_odwiedzin"><?php echo $row['DATA'];?></td>
                            <td class="panel_admin">
                            <?php

                            if($row['STATUS']=='POKAZANY'){
                                echo'<a href="admin.php?panel=artykuly&akcja=ukryj&idartykul='.$row['ID_ARTYKULU'].'"><button type="button" class="mod_button" name="butt_ban" title="Ukryj Artykuł" method="post">Ukryj</button></a>';
                            }else{
                                echo'<a href="admin.php?panel=artykuly&akcja=stronaglowna&idartykul='.$row['ID_ARTYKULU'].'"><button type="button" class="mod_button" name="butt_ban" title="Ustaw artykul jako jeden z czterech na stronie głownej" method="post">Wstaw</button></a>';
                            }
                                ?>
                            </td>

                            </tr>
                            <?php
                            }
                            else
                            {
                            ?>
                            <tr class="codrugi">
                                <td class="uzytkownik_wst"><?php echo '<a href="artykul.php?id='.$row['ID_ARTYKULU'].'">'.$row['TEMAT'].'</a>' ;?></td>
                                <td class="czas_wstawienia"><?php echo'<a href="profilowe.php?user='.$rezultat_loginu['ID_USER'].'">'.$rezultat_loginu['LOGIN'].'</a>';?></td>
                                <td class="liczba_odwiedzin"><?php echo $row['DATA'];?></td>
                                <td class="panel_admin">

                                    <?php

                                    if($row['STATUS']=='POKAZANY'){
                                        echo'<a href="admin.php?panel=artykuly&akcja=ukryj&idartykul='.$row['ID_ARTYKULU'].'"><button type="button" class="mod_button" name="butt_ban" title="Ukryj Artykuł" method="post">Ukryj</button></a>';
                                    }else{
                                        echo'<a href="admin.php?panel=artykuly&akcja=stronaglowna&idartykul='.$row['ID_ARTYKULU'].'"><button type="button" class="mod_button" name="butt_ban" title="Ustaw artykul jako jeden z czterech na stronie głownej" method="post">Wstaw</button></a>';
                                    }
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