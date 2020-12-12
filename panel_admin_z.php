<?php


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
            <!--            --><?php
            //
            //            require_once "polaczeniezMySQL.php";
            //
            //            $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
            //
            //            if($polaczenie->connect_errno!=0)
            //            {
            //                echo "Error: ".$polaczenie->connect_errno;//." Opis ".$polaczenie->connect_error;
            //            }
            //            else
            //            {
            //            $rezultat = $polaczenie->query("SELECT * FROM artykul");
            //
            //            if(!$rezultat)
            //            {
            //                throw new Exception($polaczenie->error);
            //            }
            //            else
            //            {
            //            $iterator = 0;
            //            ?>
            <div class="tabliczki">
                <table>
                    <tr>
                        <th class="ID">ID Artykulu</th>
                        <th class="uzytkownik_wst">Użytkownik wstawiajacy</th>
                        <th class="czas_wstawienia">Czas wstawienia</th>
                        <th class="liczba_odwiedzin">Liczba odwiedzin</th>
                        <th class="panel_admin">Panel Administratora</th>
                    </tr>
                    <!--                    --><?php
                    //                    while($row = mysqli_fetch_array($rezultat))
                    //                    {
                    //
                    //                        $rezultat_loginu = mysqli_fetch_array($polaczenie->query();
                    //                        //var_dump($rezultat_loginu);
                    //
                    //                        if(($iterator%2)==0)
                    //                        {
                    //                            ?>
                    <tr>
                        <td class="ID"></td>
                        <td class="uzytkownik_wst"></td>
                        <td class="czas_wstawienia"></td>
                        <td class="liczba_odwiedzin"></td>
                        <td class="panel_admin">

                            <a><button type="button" class="mute_glowna" name="butt_glowna" method="post">Glow</button></a>

                            <a><button type="button" class="mute_glowna" name="butt_glowna" method="post">Pocz</button></a>

                            <a><button type="button" class="ban_button" name="butt_ban" method="post">UiB</button></a>

                            <a ><button type="button" class="del_button" name="butt_del" method="post">Usu</button></a>
                        </td>

                    </tr>
                    <tr class="codrugi">
                        <td class="ID"></td>
                        <td class="uzytkownik_wst"></td>
                        <td class="miejsce_mema"></td>
                        <td class="Lkom"></td>
                        <td class="Padmin">

                            <a><button type="button" class="mute_glowna" name="butt_glowna" method="post">Glow</button></a>

                            <a><button type="button" class="mute_glowna" name="butt_glowna" method="post">Pocz</button></a>


                            <a><button type="button" class="ban_button" name="butt_ban" method="post">UiB</button></a>

                            <a ><button type="button" class="del_button" name="butt_del" method="post">Usu</button></a>

                        </td>
                    </tr>
                    <!--                            --><?php
                    //                        }
                    //                        $iterator++;
                    //                    }
                    //                    }
                    //                    $rezultat->close();
                    //                    }
                    //                    $polaczenie->close();
                    //
                    //                    ?>



                </table>
            </div>



        </section>



    </article>


</main>
</body>
</html>