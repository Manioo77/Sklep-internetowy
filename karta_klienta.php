
<?php  include('dodatki/sekcja_gorna.php'); ?>        


<div class="form">
    <form action="results.php" method="get" enctype="multipart/form-data">
        <input type="text" name="user_query" class="szukac" placeholder="Szukaj produktów">
        <input type="submit" name="search" class="szukac_przycisk" value="Szukaj">
    </form>
</div>

<div class="wrapper">
    <div class="boczny">

        <div class="boczne_napisy">Usługi <i class="fas fa-toolbox"></i> </div>
        <ul class="kategorie">

            <?php
           getKategorie_3();
           ?>

        </ul>

        <div class="boczne_napisy">Elektronika <i class="fas fa-laptop"></i></div>
        <ul class="kategorie">

            <?php
           getKategorie_2();
           ?>

        </ul>

        <div class="boczne_napisy">Odzież firmowa <i class="fas fa-tshirt"></i></div>
        <ul class="kategorie">
            <?php
            getKategorie();
            ?>
        </ul>
    </div>


    <div class="zawartosc">


    <div class="container_karty_sklepu">


    <div id="karta_klienta">
        <?php 
            if(isset($_SESSION['email_klienta'])){

                echo "<strong>Email: </strong>" . $_SESSION['email_klienta'];

            }else{

                echo "";
            }
        ?>

        <strong> Twój koszyk - </strong> Wszystkie przedmioty: <?php  koszyk();?> Cena: <?php koszyk_cena(); ?>
    </div>

            <form action="" method="post" enctype="multipart/form-data">
                <table class="opcje">

                    <tr class="opcje">
                        <th>Usuń</th>
                        <th>Produkty</th>
                        <th>Ilość</th>
                        <th>Cena</th>
                    </tr>

                    <?php
                        $total = 0;

                        $ip = get_ip();
                    
                        $run_cart = mysqli_query($con, "select * from karta_zakupow where ip_address='$ip' ");
                    
                        while($fetch_cart = mysqli_fetch_array($run_cart)) {
                    
                            $produkt_id = $fetch_cart['produkt_id'];
                    
                            $result_produkt = mysqli_query($con, "select * from produkty where produkt_id = '$produkt_id' ");
                    
                            while($fetch_product = mysqli_fetch_array($result_produkt)) {
                    
                                $produkt_cena= array($fetch_product['produkt_cena']);
                    
                                $produkt_title = $fetch_product['produkt_title'];
                    
                                $produkt_image = $fetch_product['produkt_obrazek'];
                    
                                $sing_price = $fetch_product['produkt_cena'];
                    
                                $values = array_sum($produkt_cena);
                    
                                //kilka sztuk
                    
                                $run_qty = mysqli_query($con, "select * from karta_zakupow where produkt_id = '$produkt_id' ");
                    
                                $row_qty = mysqli_fetch_array($run_qty);
                    
                                $qty = $row_qty['ilosc'];
                    
                                $values_qty = $values * $qty;
                    
                                $total += $values_qty;
                                        
                    ?>

                    <tr class="opcje">
                        <td><input type="checkbox" name="remove[]" value="<?php echo $produkt_id; ?>"></td>
                        <td>
                            <?php echo $produkt_title;?>
                        <br>
                        <img src="panel_admina/obrazy_produktow/<?php echo $produkt_image; ?> ">
                        </td>
                        <td><input type="text" size="4" name="qty" value="<?php echo $qty; ?>"></td>
                        <td><?php echo $sing_price . "zl"; ?></td>
                    </tr>

                    <?php } } ?>

                    <tr>
                        <td class="suma"><b>Suma: </b><?php echo koszyk_cena(); ?></td>
                    </tr>

                    <tr class="opcje">
                        <td colspan="2"> <input type="submit" name="aktualizacja" value="Aktualizuj"></td>
                        <td><input type="submit" name="kontynuuj" value="Kontynuuj zakupy"></td>
                        <td><button><a href="zaplac.php" class="check">Kup teraz</a></button></td>
                    </tr>

                </table>
            </form>

            <?php 
            if(isset($_POST['remove'])) {
                
                foreach($_POST['remove'] as $remove_id) {

                    $run_delete = mysqli_query($con, "delete from karta_zakupow where produkt_id = '$remove_id' AND ip_address = '$ip' ");

                    if($run_delete) {
                        echo "<script>window.open('karta_klienta.php','_self')</script>";
                    }

                }
            }

            if(isset($_POST['kontynuuj'])){
                echo "<script>window.open('sklep.php','_self')</script>";
            }

            ?>

    </div>

        <div class="produkty">




    <?php include ('dodatki/footer.php');?>

    </div>


</div>

</div>

</div>


</body>

</html>




