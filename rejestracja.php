<?php

  session_start();

  if(isset($_POST['email']))
  {
  // udana walidacja
  $wszystko_ok=true;

//nick----------------------------------------------------------------
  $nick = $_POST['uzytkownik'];
  // sprawdzenie dlugosci
  if(strlen($nick)< 4 || strlen($nick) > 15)
  {
    $wszystko_ok = false;
    $_SESSION['e_nick']="Nick musi posiadać od 4 do 15 znakow!";

  }

  if(ctype_alnum($nick)==false)
  {
    $wszystko_ok = false;
    $_SESSION['e_nick']="Nick musi składać się tylko z liter i cyfr!";

  }

//email----------------------------------------------------------------
  $email=$_POST['email'];
  $emailb = filter_var($email,FILTER_SANITIZE_EMAIL);


  if((filter_var($emailb,FILTER_VALIDATE_EMAIL)==false) || ($email != $emailb))
  {
    $wszystko_ok = false;
    $_SESSION['e_email']="Email nie jest poprawny składniowo !";
  }
//haslo --------------------------------------------------------------
  $haslo1 = $_POST['haslo1'];
  $haslo2 = $_POST['haslo2'];

  if(strlen($haslo1)< 8 || strlen($haslo1) > 40)
  {
    $wszystko_ok = false;
    $_SESSION['e_haslo']="Hasło musi posiadać od 8 do 40 znaków !";

  }

  if($haslo1 != $haslo2)
  {
    $wszystko_ok = false;
    $_SESSION['e_haslo']="Hasła nie są takie same !";
  }

  $haslo_hash = hash("sha512",$haslo1);
  $haslo_hash = password_hash($haslo_hash,PASSWORD_DEFAULT);

//checkbox-regulamin--------------------------------------------------------

  if(!isset($_POST['regulamin']))
  {
    $wszystko_ok = false;
    $_SESSION['e_regulamin']="Potwierdź akceptację regulaminu !";
  }

//rekapcza -----------------------------------------------------------------
  //klucz sekretny
  // $sekret = "6Le3raAUAAAAAABMd-Itb1e5SuUv2-qRviR8BeO4";

  // $sprawdz = file_get_contents('https://google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);

  // $odp = json_decode($sprawdz);

  // if($odp->success==false)
  // {
  //   $wszystko_ok==false;
  //   $_SESSION['e_bot']="Potwierdz ze nie jesteś botem !";
  // }
// zapamietanie wprowadzonych danych

$_SESSION['zap_nick'] = $nick;
$_SESSION['zap_email'] = $email;
$_SESSION['zap_haslo1'] = $haslo1;
$_SESSION['zap_haslo2'] = $haslo2;
//if(isset($_POST['regulamin']))$_SESSION['zap_regulamin']=true;




// polaczenie
  require_once "PolaczeniezMySQL.php";

//sposob raportowanie bledow
mysqli_report(MYSQLI_REPORT_STRICT);

  try {

        $polaczenie = new mysqli($host,$db_user,$db_password,$db_name);

        if($polaczenie->connect_errno!=0)
        {
            throw new Exception(mysqli_connect_errno());
        }else
        {
          //Sprawdzenie emaila ------------------------------------------------
          $rezultat = $polaczenie->query("SELECT ID_USER FROM user WHERE EMAIL = '$email'");

          if(!$rezultat){throw new Exception($polaczenie->error);}

          $liczbatakichemaili = $rezultat->num_rows;

          if($liczbatakichemaili > 0)
          {
            $wszystko_ok = false;
            $_SESSION['e_email']="Istnieje już konto przypisane do tego adresu !";

          }

          //Sprawdzenie loginu ------------------------------------------------
          $rezultat = $polaczenie->query("SELECT ID_USER FROM user WHERE EMAIL = '$nick'");

          if(!$rezultat){throw new Exception($polaczenie->error);}

          $liczbatakichnickow = $rezultat->num_rows;

          if($liczbatakichnickow > 0)
          {
            $wszystko_ok = false;
            $_SESSION['e_nick']="Istnieje już konto z takim Loginem !";

          }

          //jesli wszystko jest ok ---------------------------------------------------

            if($wszystko_ok==true)
            {
              if($polaczenie->query("INSERT INTO user VALUES (NULL,'$nick','$haslo_hash','','','$email','','','',NULL,NULL,0,0,'USER')"))
              {
                $_SESSION['udanarejestracja']=true;
                header('Location: index.php '); //sciezka po udanym logowaniu
              }
              else
              {
                throw new Exception($polaczenie->error);
              }

            }


          $polaczenie->close();
        }


      }
      catch (Exception $e)
      {
        echo 'Błąd serwera Zapraszamy za chwilę !';

        echo 'informacja deweloperska: '.$e;
      }

}



?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>KANT-MEN</title>
    <link href="CSS/styleGlowne.css" rel="stylesheet" type="text/css">
    <link href="CSS/styleRejestracja.css" rel="stylesheet" type="text/css">

</head>
<body>
<?php
include_once('rysowanieMenu.php');
rysowanieGlownegoMenu();
?>


<main>
    <article class="artykol-rejestracji">

        <div class="tytul-artykulu-rejestracji">
            Rejestracja
        </div>

        <section class="sekcja">
            <form method="post">
                <div class="rejestracja">

                    <input class="form_rejestracja" type="text" name="uzytkownik"

                           value="<?php
                           if(isset($_SESSION['zap_nick']))
                           {
                               echo $_SESSION['zap_nick'];
                               unset($_SESSION['zap_nick']);
                           }

                           ?>"

                           placeholder="Login" size="20" maxlength="15" >

                    <?php if(isset($_SESSION['e_nick']))
                    {
                        echo '<div class="error_f">'.$_SESSION['e_nick'].'<div>';
                        unset($_SESSION['e_nick']);
                    }

                    ?>

                    <input class="form_rejestracja" type="email" name="email"

                           value="<?php
                           if(isset($_SESSION['zap_email']))
                           {
                               echo $_SESSION['zap_email'];
                               unset($_SESSION['zap_email']);
                           }

                           ?>"

                           placeholder="Email" size="20" maxlength="40" >

                    <?php if(isset($_SESSION['e_email']))
                    {
                        echo '<div class="error_f">'.$_SESSION['e_email'].'<div>';
                        unset($_SESSION['e_email']);
                    }

                    ?>
                    <input class="form_rejestracja" type="password" name="haslo1"

                           value="<?php
                           if(isset($_SESSION['zap_haslo1']))
                           {
                               echo $_SESSION['zap_haslo1'];
                               unset($_SESSION['zap_haslo1']);
                           }

                           ?>"

                           placeholder="Haslo" size="20" maxlength="40">
                    <?php if(isset($_SESSION['e_haslo']))
                    {
                        echo '<div class="error_f">'.$_SESSION['e_haslo'].'<div>';
                        unset($_SESSION['e_haslo']);
                    }

                    ?>
                    <input class="form_rejestracja" type="password" name="haslo2"

                           value="<?php
                           if(isset($_SESSION['zap_haslo2']))
                           {
                               echo $_SESSION['zap_haslo2'];
                               unset($_SESSION['zap_haslo2']);
                           }

                           ?>"

                           placeholder="Powtórz haslo" size="20" maxlength="40" >

                    <h6>Podaj datę urodzenia</h6>

                    <?php
                    //pobieranie aktualnej daty
                    $rok = date("Y");
                    //$miesiac = date("m");
                    //$dzien = date("d");

                    ?>

                    <select id="data_rok" class="form_rejestracja-rozsuwane" name="rok">
                        <option value="1950">1950</option>
                        <option value="1951">1951</option>
                        <option value="1952">1952</option>
                        <option value="1953">1953</option>
                        <option value="1954">1954</option>
                        <option value="1955">1955</option>
                        <option value="1956">1956</option>
                        <option value="1957">1957</option>
                        <option value="1958">1958</option>
                        <option value="1959">1959</option>
                        <option value="1960">1960</option>
                        <option value="1961">1961</option>
                        <option value="1962">1962</option>
                        <option value="1963">1963</option>
                        <option value="1964">1964</option>
                        <option value="1965">1965</option>
                        <option value="1966">1966</option>
                        <option value="1967">1967</option>
                        <option value="1968">1968</option>
                        <option value="1969">1969</option>
                        <option value="1970">1970</option>
                        <option value="1971">1971</option>
                        <option value="1972">1972</option>
                        <option value="1973">1973</option>
                        <option value="1974">1974</option>
                        <option value="1975">1975</option>
                        <option value="1976">1976</option>
                        <option value="1977">1977</option>
                        <option value="1978">1978</option>
                        <option value="1979">1979</option>
                        <option value="1980">1980</option>
                        <option value="1981">1981</option>
                        <option value="1982">1982</option>
                        <option value="1983">1983</option>
                        <option value="1984">1984</option>
                        <option value="1985">1985</option>
                        <option value="1986">1986</option>
                        <option value="1987">1987</option>
                        <option value="1988">1988</option>
                        <option value="1989">1989</option>
                        <option value="1990">1990</option>
                        <option value="1991">1991</option>
                        <option value="1992">1992</option>
                        <option value="1993">1993</option>
                        <option value="1994">1994</option>
                        <option value="1995">1995</option>
                        <option value="1996">1996</option>
                        <option value="1997">1997</option>
                        <option value="1998">1998</option>
                        <option value="1999">1999</option>
                        <option value="2000">2000</option>
                        <option value="2001">2001</option>
                        <option value="2002">2002</option>
                        <option value="2003">2003</option>
                        <option value="2004">2004</option>
                        <option value="2005">2005</option>
                        <option value="2006">2006</option>
                        <option value="2007">2007</option>
                        <option value="2008">2008</option>
                        <option value="2009">2009</option>
                        <option value="2010">2010</option>
                        <option value="2011">2011</option>
                        <option value="2012">2012</option>
                        <option value="2013">2013</option>
                        <option value="2014">2014</option>
                        <option value="2015">2015</option>
                        <option value="2016">2016</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                    </select>

                    <?php
                    if(isset($_POST['rok']))
                    {
                        $wybrany_rok = $_POST['rok'];
                    }
                    ?>

                    <select class="form_rejestracja-rozsuwane" name="miesiac">
                        <option value="1" selected>1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                    <?php
                    if(isset($_POST['miesiac']))
                    {
                        $wybrany_miesiac = $_POST['miesiac'];
                    }
                    ?>

                    <select class="form_rejestracja-rozsuwane" name="dzien">

                        <option value="1" selected>1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                    </select>
                    <?php
                    if(isset($_POST['dzien']))
                    {
                        $wybrany_dzien = $_POST['dzien'];
                    }

                    ?>
                    <br>



                    <label><input  type="checkbox" name="regulamin"
                            <?php
                            if(isset($_SESSION['zap_regulamin']))
                            {
                                echo "checked";
                                unset($_SESSION['zap_regulamin']);
                            }
                            ?>
                        > Akceptuje</label> Regulamin.

                    <?php if(isset($_SESSION['e_regulamin']))
                    {
                        echo '<div class="error_f">'.$_SESSION['e_regulamin'].'<div>';
                        unset($_SESSION['e_regulamin']);
                    }

                    ?>


                    <!-- <div class="g-recaptcha" data-sitekey="6Le3raAUAAAAADj0QEZJp9AyLQTQlT8wdgaqi_3n"></div> -->
                    <?php if(isset($_SESSION['e_bot']))
                    {
                        echo '<div class="error_f">'.$_SESSION['e_bot'].'<div>';
                        unset($_SESSION['e_bot']);
                    }

                    ?>



                    <input type="submit" value="Załóż Konto" name="zaloz_konto">

                </div>
            </form>
        </section>


    </article>
</main>

<?php
include_once('rysowanieStopki.php');
rysowanieStopki();
?>
</body>
</html>
