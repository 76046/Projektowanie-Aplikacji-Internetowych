<?php
    require_once "polaczeniezMySQL.php";

    $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);

    if($polaczenie->connect_errno!=0){
        echo "Error: ".$polaczenie->connect_errno;
    }
    else{
        $rezultat = $polaczenie->query("SELECT * FROM waluta");

        if(!$rezultat){
            throw new Exception($polaczenie->error);
        }
        else{
            while($row = mysqli_fetch_assoc($rezultat)){
?>
                <tr class="co-drugi">
                        <td class="nazwa-waluty">
                            <div class="flaga">
                                <?php echo '<img src="data:image/jpeg;base64,'.base64_decode($row['FLAGA']).'" alt="flaga"/>;' ?>
                            </div>
                            <div class="nazwa-skrocona">
                                <?php echo $row['KOD_WALUTA']; ?>
                                <!-- USD -->
                            </div>
                            <div class="nazwa-calkowita">
                                <?php echo $row['NAZWA']; ?>
                                <!-- Dolar Amerykański -->
                            </div>
                        </td>
                        <td class="kupno-waluty">
                            <?php echo $row['KUPNO']; ?>
                            <!-- 200 PLN -->
                        </td>
                        <td class="sprzedaz-waluty">
                            <?php echo $row['SPRZEDAZ']; ?>
                            <!-- 100PLN -->
                        </td>
                        <td class="operacje-waluty">

                        </td>
                    </tr>
<?php
            }
        }
        $rezultat->close();
    }
    $polaczenie->close();                   
?>