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
                        <a href="panel_admin_z.php">Zgłoszenia</a>
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
                        <th class="ID">ID</th>
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
                        <td class="ID"><?php echo $row['ID_USER'];?></td>
                        <td class="uzytkownik_wst"><?php echo'<a href="profilowe.php?user='.$row['ID_USER'].'">'.$row['LOGIN'].'</a>';?></td>
                        <td class="uzytkownik_wst"><?php echo $row['IMIE'];?></td>
                        <td class="uzytkownik_wst"><?php echo $row['NAZWISKO'];?></td>
                        <td class="uzytkownik_wst"><?php echo $row['EMAIL'];?></td>
                        <td class="czas_wstawienia"><?php echo $row['STW_WATKI'];?></td>
                        <td class="liczba_odwiedzin"><?php echo $row['LICZ_KOMENTARZY'];?></td>
                        <td class="panel_admin">

                            <a><button type="button" class="mute_glowna" name="butt_glowna" method="post">G</button></a>

                            <a><button type="button" class="mute_glowna" name="butt_glowna" method="post">P</button></a>


                            <a><button type="button" class="ban_button" name="butt_ban" method="post">B</button></a>

                            <a ><button type="button" class="del_button" name="butt_del" method="post">X</button></a>
                        </td>

                    </tr>
                    <?php
                    }else{


                        ?>
                    <tr class="codrugi">
                        <td class="ID"><?php echo $row['ID_USER'];?></td>
                        <td class="uzytkownik_wst"><?php echo'<a href="profilowe.php?user='.$row['ID_USER'].'">'.$row['LOGIN'].'</a>';?></td>
                        <td class="uzytkownik_wst"><?php echo $row['IMIE'];?></td>
                        <td class="uzytkownik_wst"><?php echo $row['NAZWISKO'];?></td>
                        <td class="uzytkownik_wst"><?php echo $row['EMAIL'];?></td>
                        <td class="czas_wstawienia"><?php echo $row['STW_WATKI'];?></td>
                        <td class="liczba_odwiedzin"><?php echo $row['LICZ_KOMENTARZY'];?></td>
                        <td class="panel_admin">

                            <a><button type="button" class="mute_glowna" name="butt_glowna" method="post">G</button></a>

                            <a><button type="button" class="mute_glowna" name="butt_glowna" method="post">P</button></a>


                            <a><button type="button" class="ban_button" name="butt_ban" method="post">B</button></a>

                            <a ><button type="button" class="del_button" name="butt_del" method="post">X</button></a>

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