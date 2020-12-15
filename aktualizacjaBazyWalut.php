<?php
session_start();

require_once "polaczeniezMySQL.php";

$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);

if($polaczenie->connect_errno!=0)
{
    echo "Error: ".$polaczenie->connect_errno;
}
else
{
    header("refresh: 300");

    $request = Requests::get('https://api.exchangeratesapi.io/latest?base=PLN', array('Accept' => 
    'application/json'));

    if ($request->status_code == 200){
        $response = json_decode($request->body);

        $CAD = $response->rates->CAD;
        $kupnoCAD = 1/$CAD;
        $sprzedazCAD = $kupnoCAD + 0.05;
        $polaczenie->query("UPDATE waluta SET KUPNO='$kupnoCAD', SPRZEDAZ='$sprzedazCAD' WHERE 'KOD_WALUTA'='CAD'");

        $HKD = $response->rates->HKD;
        $kupnoHKD = 1/$HKD;
        $sprzedazHKD = $kupnoHKD + 0.05;
        $polaczenie->query("UPDATE waluta SET KUPNO='$kupnoHKD', SPRZEDAZ='$sprzedazHKD' WHERE 'KOD_WALUTA'='HKD'");

        $ISK = $response->rates->ISK;
        $kupnoISK = 1/$ISK;
        $sprzedazISK = $kupnoISK + 0.05;
        $polaczenie->query("UPDATE waluta SET KUPNO='$kupnoISK', SPRZEDAZ='$sprzedazISK' WHERE 'KOD_WALUTA'='ISK'");

        $PHP = $response->rates->PHP;
        $kupnoPHP = 1/$PHP;
        $sprzedazPHP = $kupnoPHP + 0.05;
        $polaczenie->query("UPDATE waluta SET KUPNO='$kupnoPHP', SPRZEDAZ='$sprzedazPHP' WHERE 'KOD_WALUTA'='PHP'");

        $DKK = $response->rates->DKK;
        $kupnoDKK = 1/$DKK;
        $sprzedazDKK = $kupnoDKK + 0.05;
        $polaczenie->query("UPDATE waluta SET KUPNO='$kupnoDKK', SPRZEDAZ='$sprzedazDKK' WHERE 'KOD_WALUTA'='DKK'");

        $HUF = $response->rates->HUF;
        $kupnoHUF = 1/$HUF;
        $sprzedazHUF = $kupnoHUF + 0.05;
        $polaczenie->query("UPDATE waluta SET KUPNO='$kupnoHUF', SPRZEDAZ='$sprzedazHUF' WHERE 'KOD_WALUTA'='HUF'");

        $CZK = $response->rates->CZK;
        $kupnoCZK = 1/$CZK;
        $sprzedazCZK = $kupnoCZK + 0.05;
        $polaczenie->query("UPDATE waluta SET KUPNO='$kupnoCZK', SPRZEDAZ='$sprzedazCZK' WHERE 'KOD_WALUTA'='CZK'");

        $AUD = $response->rates->AUD;
        $kupnoAUD = 1/$AUD;
        $sprzedazAUD = $kupnoAUD + 0.05;
        $polaczenie->query("UPDATE waluta SET KUPNO='$kupnoAUD', SPRZEDAZ='$sprzedazAUD' WHERE 'KOD_WALUTA'='AUD'");

        $RON = $response->rates->RON;
        $kupnoRON = 1/$RON;
        $sprzedazRON = $kupnoRON + 0.05;
        $polaczenie->query("UPDATE waluta SET KUPNO='$kupnoRON', SPRZEDAZ='$sprzedazRON' WHERE 'KOD_WALUTA'='RON'");

        $SEK = $response->rates->SEK;
        $kupnoSEK = 1/$SEK;
        $sprzedazSEK = $kupnoSEK + 0.05;
        $polaczenie->query("UPDATE waluta SET KUPNO='$kupnoSEK', SPRZEDAZ='$sprzedazSEK' WHERE 'KOD_WALUTA'='SEK'");

        $IDR = $response->rates->IDR;
        $kupnoIDR = 1/$IDR;
        $sprzedazIDR = $kupnoIDR + 0.05;
        $polaczenie->query("UPDATE waluta SET KUPNO='$kupnoIDR', SPRZEDAZ='$sprzedazIDR' WHERE 'KOD_WALUTA'='IDR'");

        $INR = $response->rates->INR;
        $kupnoINR = 1/$INR;
        $sprzedazINR = $kupnoINR + 0.05;
        $polaczenie->query("UPDATE waluta SET KUPNO='$kupnoINR', SPRZEDAZ='$sprzedazINR' WHERE 'KOD_WALUTA'='INR'");

        $BRL = $response->rates->BRL;
        $kupnoBRL = 1/$BRL;
        $sprzedazBRL = $kupnoBRL + 0.05;
        $polaczenie->query("UPDATE waluta SET KUPNO='$kupnoBRL', SPRZEDAZ='$sprzedazBRL' WHERE 'KOD_WALUTA'='BRL'");

        $RUB = $response->rates->RUB;
        $kupnoRUB = 1/$RUB;
        $sprzedazRUB = $kupnoRUB + 0.05;
        $polaczenie->query("UPDATE waluta SET KUPNO='$kupnoRUB', SPRZEDAZ='$sprzedazRUB' WHERE 'KOD_WALUTA'='RUB'");

        $HRK = $response->rates->HRK;
        $kupnoHRK = 1/$HRK;
        $sprzedazHRK = $kupnoHRK + 0.05;
        $polaczenie->query("UPDATE waluta SET KUPNO='$kupnoHRK', SPRZEDAZ='$sprzedazHRK' WHERE 'KOD_WALUTA'='HRK'");

        $JPY = $response->rates->JPY;
        $kupnoJPY = 1/$JPY;
        $sprzedazJPY = $kupnoJPY + 0.05;
        $polaczenie->query("UPDATE waluta SET KUPNO='$kupnoJPY', SPRZEDAZ='$sprzedazJPY' WHERE 'KOD_WALUTA'='JPY'");

        $THB = $response->rates->THB;
        $kupnoTHB = 1/$THB;
        $sprzedazTHB = $kupnoTHB + 0.05;
        $polaczenie->query("UPDATE waluta SET KUPNO='$kupnoTHB', SPRZEDAZ='$sprzedazTHB' WHERE 'KOD_WALUTA'='THB'");

        $CHF = $response->rates->CHF;
        $kupnoCHF = 1/$CHF;
        $sprzedazCHF = $kupnoCHF + 0.05;
        $polaczenie->query("UPDATE waluta SET KUPNO='$kupnoCHF', SPRZEDAZ='$sprzedazCHF' WHERE 'KOD_WALUTA'='CHF'");

        $EUR = $response->rates->EUR;
        $kupnoEUR = 1/$EUR;
        $sprzedazEUR = $kupnoEUR + 0.05;
        $polaczenie->query("UPDATE waluta SET KUPNO='$kupnoEUR', SPRZEDAZ='$sprzedazEUR' WHERE 'KOD_WALUTA'='EUR'");

        $SGD = $response->rates->SGD;
        $kupnoSGD = 1/$SGD;
        $sprzedazSGD = $kupnoSGD + 0.05;
        $polaczenie->query("UPDATE waluta SET KUPNO='$kupnoSGD', SPRZEDAZ='$sprzedazSGD' WHERE 'KOD_WALUTA'='SGD'");

        $BGN = $response->rates->BGN;
        $kupnoBGN = 1/$BGN;
        $sprzedazBGN = $kupnoBGN + 0.05;
        $polaczenie->query("UPDATE waluta SET KUPNO='$kupnoBGN', SPRZEDAZ='$sprzedazBGN' WHERE 'KOD_WALUTA'='BGN'");

        $TRY = $response->rates->TRY;
        $kupnoTRY = 1/$TRY;
        $sprzedazTRY = $kupnoTRY + 0.05;
        $polaczenie->query("UPDATE waluta SET KUPNO='$kupnoTRY', SPRZEDAZ='$sprzedazTRY' WHERE 'KOD_WALUTA'='TRY'");

        $CNY = $response->rates->CNY;
        $kupnoCNY = 1/$CNY;
        $sprzedazCNY = $kupnoCNY + 0.05;
        $polaczenie->query("UPDATE waluta SET KUPNO='$kupnoCNY', SPRZEDAZ='$sprzedazCNY' WHERE 'KOD_WALUTA'='CNY'");

        $NOK = $response->rates->NOK;
        $kupnoNOK = 1/$NOK;
        $sprzedazNOK = $kupnoNOK + 0.05;
        $polaczenie->query("UPDATE waluta SET KUPNO='$kupnoNOK', SPRZEDAZ='$sprzedazNOK' WHERE 'KOD_WALUTA'='NOK'");

        $NZD = $response->rates->NZD;
        $kupnoNZD = 1/$NZD;
        $sprzedazNZD = $kupnoNZD + 0.05;
        $polaczenie->query("UPDATE waluta SET KUPNO='$kupnoNZD', SPRZEDAZ='$sprzedazNZD' WHERE 'KOD_WALUTA'='NZD'");

        $ZAR = $response->rates->ZAR;
        $kupnoZAR = 1/$ZAR;
        $sprzedazZAR = $kupnoZAR + 0.05;
        $polaczenie->query("UPDATE waluta SET KUPNO='$kupnoZAR', SPRZEDAZ='$sprzedazZAR' WHERE 'KOD_WALUTA'='ZAR'");

        $USD = $response->rates->USD;
        $kupnoUSD = 1/$USD;
        $sprzedazUSD = $kupnoUSD + 0.05;
        $polaczenie->query("UPDATE waluta SET KUPNO='$kupnoUSD', SPRZEDAZ='$sprzedazUSD' WHERE 'KOD_WALUTA'='USD'");

        $MXN = $response->rates->MXN;
        $kupnoMXN = 1/$MXN;
        $sprzedazMXN = $kupnoMXN + 0.05;
        $polaczenie->query("UPDATE waluta SET KUPNO='$kupnoMXN', SPRZEDAZ='$sprzedazMXN' WHERE 'KOD_WALUTA'='MXN'");

        $ILS = $response->rates->ILS;
        $kupnoILS = 1/$ILS;
        $sprzedazILS = $kupnoILS + 0.05;
        $polaczenie->query("UPDATE waluta SET KUPNO='$kupnoILS', SPRZEDAZ='$sprzedazILS' WHERE 'KOD_WALUTA'='ILS'");

        $GBP = $response->rates->GBP;
        $kupnoGBP = 1/$GBP;
        $sprzedazGBP = $kupnoGBP + 0.05;
        $polaczenie->query("UPDATE waluta SET KUPNO='$kupnoGBP', SPRZEDAZ='$sprzedazGBP' WHERE 'KOD_WALUTA'='GBP'");

        $KRW = $response->rates->KRW;
        $kupnoKRW = 1/$KRW;
        $sprzedazKRW = $kupnoKRW + 0.05;
        $polaczenie->query("UPDATE waluta SET KUPNO='$kupnoKRW', SPRZEDAZ='$sprzedazKRW' WHERE 'KOD_WALUTA'='KRW'");

        $MYR = $response->rates->MYR;
        $kupnoMYR = 1/$MYR;
        $sprzedazMYR = $kupnoMYR + 0.05;
        $polaczenie->query("UPDATE waluta SET KUPNO='$kupnoMYR', SPRZEDAZ='$sprzedazMYR' WHERE 'KOD_WALUTA'='MYR'");
    }
}
$polaczenie->close();
?>