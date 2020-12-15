$(document).ready(function(){
    setInterval(function(){
        $(".co-drugi").load("tabelaWalut.php");
    },300000);
});