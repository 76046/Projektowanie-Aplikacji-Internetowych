<?php
$api="your api key here";   ///// Provide your fixer.io api key here
$string = file_get_contents("http://data.fixer.io/api/latest?access_key=$api&format=1");
  $json = json_decode($string, true);
  
  
  $i=0;
  foreach ($json['rates'] as $key => $value) {
    $currency[$i]=$key;
    $rate[$i]=$value;
    $i=$i+1;
        
  }
  
?>