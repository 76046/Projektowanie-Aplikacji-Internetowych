<?php
session_start();

?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>KANT-MEN</title>
        <link href="CSS/styleGlowne.css" rel="stylesheet" type="text/css">
    </head>
    <body>
    <?php
    include_once('rysowanieMenu.php');
    rysowanieGlownegoMenu();
    ?>
        <main>
            <div class="calculator">
                <h2 class="calculator-header">Kalkulator walutowy</h2>
                <div class="calculator-from">
                    <input id="fromAmount" type="number">
                    <select id="from">
                        <option value="currency">Wybierz walutę</option>
                    </select>
                </div>
                <div class="calculator-span">
                    <span> = </span>
                </div>
                <div class="calculator-to">
                    <input id="toAmount" type="number" disabled>
                    <select id="to">
                        <option value="currency">Wybierz walutę</option>
                    </select>
                </div>
            </div>

            <div class="informacje">
                <div class="transakcja">
                    <div class="transakcja-lewa">
                        <div class="transakcja-lewa-naglowek">
                            <h2>Nadzorujemy każdą transakcję</h2>
                        </div>
                        <div class="transakcja-lewa-tresc">
                            <p>W naszym zespole pracuje 100 doświadczonych specjalistów w dziedzinie wymiany walut. 
                            Nadzorujemy każdą transakcję, by zredukować ryzyko utraty pieniędzy do zera.</p>
                        </div>
                    </div>
                    <div class="transakcja-prawa">
                        <img src="img/waluty/waluty.jpg" alt="zdjęcie">
                    </div>
                    <div style="clear: both;"></div>
                </div>
                <div class="benefity">
                    <div class="benefit1">
                        <div class="benefit1-img">
                            <img src="img/benefity/hands.png" alt="ikonka1">
                        </div>
                        <div class="benefit1-naglowek">
                            <h3>Zaufanie</h3>
                        </div>
                        <div class="benefit1-tresc">
                            <p>Do tej pory zaufało nam 100 tysięcy klientów</p>
                        </div>
                    </div> 
                    <div class="benefit2">
                        <div class="benefit2-img">
                            <img src="img/benefity/tarcza.jpg" alt="ikonka2">
                        </div>
                        <div class="benefit2-naglowek">
                            <h3>Bezpieczeństwo</h3>
                        </div>
                        <div class="benefit2-tresc">
                            <p>Nasza firma posiada zaawansowane systemy zabezpieczające przed utratą pieniędzy</p>
                        </div>
                    </div>
                    <div class="benefit3">
                        <div class="benefit3-img">
                            <img src="img/benefity/star.png" alt="ikonka3">
                        </div>
                        <div class="benefit3-naglowek">
                            <h3>Najlepsza jakość obsługi</h3>
                        </div>
                        <div class="benefit3-tresc">
                            <p>Jakość naszej obsługi została pozytywnie oceniona przez klientów</p>
                        </div>
                    </div>
                    <div style="clear: both;"></div>
                </div>
            </div>

            <div class="slider">
                <div class="slides">

                    <input type="radio" name="radio-btn" id="radio1">
                    <input type="radio" name="radio-btn" id="radio2">
                    <input type="radio" name="radio-btn" id="radio3">
                    <input type="radio" name="radio-btn" id="radio4">

                    <?php
                require_once "polaczeniezMySQL.php";

                $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
                
                if($polaczenie->connect_errno!=0)
                {
                    echo "Error: ".$polaczenie->connect_errno;
                }
                else
                {
                    //status POKAZANY aby sie wyswietlal na głownej WHERE `STATUS` = 'POKAZANY' AND ID_ARTYKULU=
                    //$rezultat1 = $polaczenie->query("SELECT * FROM artykul WHERE ID_ARTYKULU='1' OR `STATUS`='POKAZANY'");
                    //$rezultat = $polaczenie->query("SELECT * FROM artykul WHERE ID_ARTYKULU>'1' OR `STATUS`='POKAZANY'");
                    //$minIndex = $polaczenie->query("SELECT MIN(ID_ARTYKULU) FROM artykul WHERE `STATUS`='POKAZANY'");
                    $rezultat1 = $polaczenie->query("SELECT * FROM artykul WHERE `STATUS`='POKAZANY'");
                    $row1 = mysqli_fetch_assoc($rezultat1);
                    $rezultat = $polaczenie->query("SELECT * FROM artykul WHERE ID_ARTYKULU >".$row1['ID_ARTYKULU']." AND `STATUS`='POKAZANY'");
                    
                    if(!$rezultat)
                    {
                      throw new Exception($polaczenie->error);
                    }
                    else
                    {
                         ?>

                        <div class="slide first">
                            <div class="slide-img">
                                <?php echo '<a href="artykul.php?id='.$row1['ID_ARTYKULU'].'"><img src="img/artykuly/'.$row1['ZDJECIE_ARTYKUL'].'" alt="zdjecie1"/></a>' ?>
                                <!-- <img src="" alt="zdjęcie1"> -->
                            </div>                       
                            <div class="slide-naglowek">
                                <?php echo '<a href="artykul.php?id='.$row1['ID_ARTYKULU'].'">'.$row1['TEMAT'].'</a>'; ?>
                                <!-- <h2>Nagłówek artykułu 1</h2> -->
                            </div>
                        </div>

                    <?php $counter=2; 
                    while($row = mysqli_fetch_assoc($rezultat)){?>
                    
                    <div class="slide">
                        <div class="slide-img">
                            <?php echo '<a href="artykul.php?id='.$row['ID_ARTYKULU'].'"><img src="img/artykuly/'.$row['ZDJECIE_ARTYKUL'].'" alt="zdjecie'.$counter.'"/></a>' ?>
                            <!-- <img src="" alt="zdjęcie2"> -->
                        </div> 
                        <div class="slide-naglowek">
                            <?php echo '<a href="artykul.php?id='.$row['ID_ARTYKULU'].'">'.$row['TEMAT'].'</a>'; ?>
                            <!-- <h2>Nagłówek artykułu 2</h2> -->
                        </div>
                    </div>
                    
                    <?php
                    $counter++;
                }
                }
                $rezultat->close();
                $rezultat1->close();
                }
                $polaczenie->close();

            ?>

                    <div class="navigation-auto">
                        <div class="auto-btn1"></div>
                        <div class="auto-btn2"></div>
                        <div class="auto-btn3"></div>
                        <div class="auto-btn4"></div>
                    </div>

                </div>

                <div class="navigation-manual">
                    <label for="radio1" class="manual-btn"></label>
                    <label for="radio2" class="manual-btn"></label>
                    <label for="radio3" class="manual-btn"></label>
                    <label for="radio4" class="manual-btn"></label>
                </div>

            </div>

            <div class="nagrody">
                <div class="nagrody-tytul">
                    <h2>Nagrody i wyróżnienia</h2>
                </div>
                <div class="nagrody-dolne">
                    <div class="nagroda1">
                        <div class="nagroda1-img">
                            <img src="img/nagrody/laur-konsumenta.png" alt="obrazek1">
                        </div>
                        <div class="nagroda1-info">
                            <p>Laur Konsumenta 2021</p> 
                        </div>
                    </div>
                    <div class="nagroda2">
                        <div class="nagroda2-img">
                            <img src="img/nagrody/puchar.jpg" alt="obrazek2">
                        </div>
                        <div class="nagroda2-info">
                            <p>Nagroda za najlepszą obsługę</p> 
                        </div>
                    </div>
                    <div class="nagroda3">
                        <div class="nagroda3-img">
                            <img src="img/nagrody/medal.jpg" alt="obrazek3">
                        </div>
                        <div class="nagroda3-info">
                            <p>Otrzymanie tytułu kantora roku</p> 
                        </div>
                    </div>
                    <div style="clear: both;"></div> 
                </div>
            </div>


        </main>
    <?php
    include_once('rysowanieStopki.php');
    rysowanieStopki();
    ?>
        <script type="text/javascript" src="scripts/currencyConverter.js"></script>

        <script type="text/javascript" src="scripts/slider.js"></script>

    </body>
</html>