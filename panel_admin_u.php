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
                        $rezultat = $polaczenie->query("SELECT * FROM user");

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
                        <th class="uzytkownik_wst">Login</th>
                        <th class="uzytkownik_wst">Imie</th>
                        <th class="uzytkownik_wst">Nazwisko</th>
                        <th class="uzytkownik_wst">Email</th>
                        <th class="czas_wstawienia">Liczba tematów</th>
                        <th class="liczba_odwiedzin">Liczba Komentarzy</th>
                        <th class="panel_admin">Panel Administratora</th>
                    </tr>
                        <?php
                        while($row = mysqli_fetch_array($rezultat))
                        {
                            
                            if(($iterator%2)==0)
                        {
                        ?>
                    <tr>

                        <td class="uzytkownik_wst">
                            <?php
                            //if($row[''])
                            echo'<a href="profilowe.php?user='.$row['ID_USER'].'">ID'.$row['ID_USER'].' '.$row['LOGIN'].'</a>';
                            ?>
                        </td>
                        <td class="uzytkownik_wst"><?php echo $row['IMIE'];?></td>
                        <td class="uzytkownik_wst"><?php echo $row['NAZWISKO'];?></td>
                        <td class="uzytkownik_wst"><?php echo $row['EMAIL'];?></td>
                        <td class="czas_wstawienia"><?php echo $row['STW_WATKI'];?></td>
                        <td class="liczba_odwiedzin"><?php echo $row['LICZ_KOMENTARZY'];?></td>
                        <td class="panel_admin">
                            <?php
                            if(!($_SESSION['id_usera_zalog']==$row['ID_USER'])){
                                if(!($row['UPRAWNIENIA']=='BAN')){
                                    if(!($row['UPRAWNIENIA']=='MUTE')){
                                        echo'<a href="admin.php?panel=uzytkownicy&akcja=zmutuj&idusera='.$row['ID_USER'].'"><button type="button" class="mute_glowna" name="butt_glowna" title="Zmutuj użytkownika" method="post">ZU</button></a> ';
                                    }else{
                                        echo'<a href="admin.php?panel=uzytkownicy&akcja=odmutuj&idusera='.$row['ID_USER'].'"><button type="button" class="mute_glowna" name="butt_glowna" title="Odmutuj użytkownika"method="post">OMU</button></a> ';
                                    }
                                    if($_SESSION['admin'] == 'true'){
                                        if($row['UPRAWNIENIA']=='MOD'){
                                            echo'<a href="admin.php?panel=uzytkownicy&akcja=zabierzmoda&idusera='.$row['ID_USER'].'"><button type="button" class="mod_button" name="butt_ban" title="Zabierz uprawniena Moderatora" method="post">UM</button></a>';
                                        }else{
                                            echo'<a href="admin.php?panel=uzytkownicy&akcja=nadajmoda&idusera='.$row['ID_USER'].'"><button type="button" class="mod_button" name="butt_ban" title="Nadaj uprawniena Moderatora" method="post">NM</button></a>';
                                        }
                                    }
                                }
                                if(!($row['UPRAWNIENIA']=='BAN')){
                                    echo'<a href="admin.php?panel=uzytkownicy&akcja=banuj&idusera='.$row['ID_USER'].'"><button type="button" class="ban_button" name="butt_ban" title="Banuj użytkownika" method="post">BU</button></a>';
                                }else{
                                    echo'<a href="admin.php?panel=uzytkownicy&akcja=odbanuj&idusera='.$row['ID_USER'].'"><button type="button" class="ban_button" name="butt_ban" title="Odbanuj użytkownika" method="post">OBU</button></a>';
                                }

                            }
                            ?>

                        </td>

                    </tr>
                    <?php
                    }else{


                        ?>
                    <tr class="codrugi">
                        <td class="uzytkownik_wst"><?php echo'<a href="profilowe.php?user='.$row['ID_USER'].'">ID'.$row['ID_USER'].' '.$row['LOGIN'].'</a>';?></td>
                        <td class="uzytkownik_wst"><?php echo $row['IMIE'];?></td>
                        <td class="uzytkownik_wst"><?php echo $row['NAZWISKO'];?></td>
                        <td class="uzytkownik_wst"><?php echo $row['EMAIL'];?></td>
                        <td class="czas_wstawienia"><?php echo $row['STW_WATKI'];?></td>
                        <td class="liczba_odwiedzin"><?php echo $row['LICZ_KOMENTARZY'];?></td>
                        <td class="panel_admin">
                            <?php
                            if(!($_SESSION['id_usera_zalog']==$row['ID_USER'])){
                                if(!($row['UPRAWNIENIA']=='BAN')){
                                    if(!($row['UPRAWNIENIA']=='MUTE')){
                                        echo'<a href="admin.php?panel=uzytkownicy&akcja=zmutuj&idusera='.$row['ID_USER'].'"><button type="button" class="mute_glowna" name="butt_glowna" title="Zmutuj użytkownika" method="post">ZU</button></a> ';
                                    }else{
                                        echo'<a href="admin.php?panel=uzytkownicy&akcja=odmutuj&idusera='.$row['ID_USER'].'"><button type="button" class="mute_glowna" name="butt_glowna" title="Odmutuj użytkownika"method="post">OMU</button></a> ';
                                    }
                                    if($_SESSION['admin'] == 'true'){
                                        if($row['UPRAWNIENIA']=='MOD'){
                                            echo'<a href="admin.php?panel=uzytkownicy&akcja=zabierzmoda&idusera='.$row['ID_USER'].'"><button type="button" class="mod_button" name="butt_ban" title="Zabierz uprawniena Moderatora" method="post">UM</button></a>';
                                        }else{
                                            echo'<a href="admin.php?panel=uzytkownicy&akcja=nadajmoda&idusera='.$row['ID_USER'].'"><button type="button" class="mod_button" name="butt_ban" title="Nadaj uprawniena Moderatora" method="post">NM</button></a>';
                                        }
                                    }
                                }
                                if(!($row['UPRAWNIENIA']=='BAN')){
                                    echo'<a href="admin.php?panel=uzytkownicy&akcja=banuj&idusera='.$row['ID_USER'].'"><button type="button" class="ban_button" name="butt_ban" title="Banuj użytkownika" method="post">BU</button></a>';
                                }else{
                                    echo'<a href="admin.php?panel=uzytkownicy&akcja=odbanuj&idusera='.$row['ID_USER'].'"><button type="button" class="ban_button" name="butt_ban" title="Odbanuj użytkownika" method="post">OBU</button></a>';
                                }

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