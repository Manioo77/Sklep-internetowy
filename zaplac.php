<?php include('dodatki/sekcja_gorna.php'); ?>

</div>
<div class="1">
    <p>1</p>
</div>


<div class="wyloguj">

    <?php

    if (!isset($_SESSION['email'])) {
        include('logowanie.php');
    } else {
        include('platnosc.php');
    }

    ?>

    <div class="zawartosc">


        <div class="container_karty_sklepu">


            <div id="karta_klienta">

                <?php
                if (isset($_SESSION['email_klienta'])) {

                    echo "<strong>Email: </strong>" . $_SESSION['email_klienta'];
                } else {

                    echo "";
                }
                ?>


                <?php
                $select_user = mysqli_query($con, "select * from uzytkownicy where id='$_SESSION[user_id]'");
                $fetch_user = mysqli_fetch_array($select_user);
                ?>



                <h4><strong> Faktura</strong></h4>
                <p>Wszystkie przedmioty: <?php koszyk(); ?></p>
                <p> Cena: <?php koszyk_cena(); ?></p>
            </div>

            <div class="faktura">
                <form action="wyslij_fakture.php" method="post" enctype="multipart/form-data">



                    <table class="zamowienia">

                        <tr class="opcje">

                            <th class="pierwszy">Produkty</th>
                            <th>Ilość</th>
                            <th>Cena</th>
                        </tr>


                        <?php
                        $total = 0;

                        $ip = get_ip();

                        $run_cart = mysqli_query($con, "select * from karta_zakupow where ip_address='$ip' ");

                        while ($fetch_cart = mysqli_fetch_array($run_cart)) {

                            $produkt_id = $fetch_cart['produkt_id'];

                            $result_produkt = mysqli_query($con, "select * from produkty where produkt_id = '$produkt_id' ");

                            while ($fetch_product = mysqli_fetch_array($result_produkt)) {

                                $produkt_cena = array($fetch_product['produkt_cena']);

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
                                    <td>
                                        <?php echo $produkt_title; ?>
                                        <br>
                                        <img src="panel_admina/obrazy_produktow/<?php echo $produkt_image; ?>">
                                    </td>
                                    <td><input class="ilosc_faktura" type="text" size="4" name="qty" value="<?php echo $qty; ?>"></td>
                                    <td><?php echo $sing_price . "zl"; ?></td>

                                </tr>




                        <?php }
                        } ?>
                        <tr>
                            <td class="przycisk_zakoncz"><input type="submit" class="przycisk_wyslij" value="Zakończ"></td>
                        </tr>


                    </table>



                    <div class="dane_kupujacego">
                        <h4 class="info_h4">Dane kupującego:</h4>
                    </div>

                    <div>
                        <tr>
                            <td><b>Imię i nazwisko: </b></td>
                            <td colspan="3"><input type="text" readonly name="name" value="<?php echo $fetch_user['name']; ?>" placeholder="Name" class="faktura_dane_1" required></td>
                        </tr>
                    </div>

                    <div>
                        <tr>
                            <td><b>Email: </b></td>
                            <td colspan="3"><input type="email" name="email" readonly value="<?php echo $fetch_user['email']; ?>" placeholder="Email" class="faktura_dane_2" required></td>
                        </tr>
                    </div>

                    <div>
                        <tr>
                            <td class="awatar"><b>Country: </b></td>
                            <td colspan="3"><input type="text" readonly name="country" value="<?php echo $fetch_user['country']; ?>" class="faktura_dane_3" required></td>
                            </td>
                        </tr>
                    </div>

                    <div>
                        <tr>
                            <td><b>City: </b></td>
                            <td colspan="3"><input type="text" readonly name="city" value="<?php echo $fetch_user['city']; ?>" class="faktura_dane_4" required></td>
                        </tr>
                    </div>

                    <div>
                        <tr>
                            <td><b>Contact: </b></td>
                            <td colspan="3"><input type="text" readonly name="contact" value="<?php echo $fetch_user['contact']; ?>" class="faktura_dane_5" required></td>
                        </tr>
                    </div>

                    <div>
                        <tr>
                            <td><b>Address: </b></td>
                            <td colspan="3"><input type="text" readonly name="address" value="<?php echo $fetch_user['user_address']; ?>" class="faktura_dane_6" required></td>

                        </tr>

                        <div class="konto_bankowe">
                            <h4 class="info_h4">Płatność: </h4>
                            <tr>
                                <td><b>Odbiorca: </b></td><br>
                                <td colspan="3"><input type="text" readonly name="name_firma" value="Firma it_STELA" placeholder="Name" required></td><br><br>
                            </tr>

                            <tr>
                                <td><b>Adres(opcjonalnie): </b></td><br>
                                <td colspan="3"><input type="text" readonly name="adress_firma" value="Kraków ul. Opolska 45/19" placeholder="Name" required></td><br><br>
                            </tr>

                            <tr>
                                <td><b>Numer konta odbiorcy: </b></td><br>
                                <td colspan="3"><input type="text" readonly name="numer_konta" value="PL KK AAAAAAAA BBBBBBBBBBBBBBBB" required size="40"></td><br><br>
                            </tr>


                            <tr>
                                <td><b>Tytuł: </b></td><br>
                                <td colspan="3"><input type="text" readonly name="tytul" value="W tytule proszę wpisać imię, nazwisko, nazwę produktu lub usługi." placeholder="Name" required size="40"></td><br><br>
                            </tr>


                            <tr>
                                <td><b>Data: </b></td>
                                <div id="dzien" name="data"></div>
                                <script type="text/javascript">
                                    document.getElementById("dzien").innerHTML = dzien + "-" + miesiac + "-" + rok;
                                </script>
                            </tr>

                            <br>

                            <tr>
                                <td><b>Godzina: </b></td>
                                <div id="zegar" name="data"></div>
                                <script type="text/javascript">
                                    document.getElementById("zegar").innerHTML = godzina + ":" + minuta + ":" + sekunda;
                                </script>
                            </tr><br>
                            <tr>
                                <td><b>Ilość produktów: </b></td><br>
                                <td colspan="3"><input type="text" readonly name="ilosc_prod" value="<?php koszyk(); ?>" required></td> <br><br>
                            </tr>

                            <tr>
                                <td><b>Cena produktów: </b></td><br>
                                <td colspan="3"><input type="text" readonly name="cena_prod" value="<?php koszyk_cena(); ?>" required></td> <br><br>
                            </tr>

                            <tr>
                                <td><b>Produkty: </b></td><br>
                            </tr>

                            <?php
                            $numer_produktu_z_kolei = 1;
                            $total = 0;

                            $ip = get_ip();

                            $run_cart = mysqli_query($con, "select * from karta_zakupow where ip_address='$ip' ");

                            while ($fetch_cart = mysqli_fetch_array($run_cart)) {

                                $produkt_id = $fetch_cart['produkt_id'];

                                $result_produkt = mysqli_query($con, "select * from produkty where produkt_id = '$produkt_id' ");

                                while ($fetch_product = mysqli_fetch_array($result_produkt)) {


                                    $produkt_title = $fetch_product['produkt_title'];
                                    $nazwa = "produkty_faktura" . $numer_produktu_z_kolei;
                                    $numer_produktu_z_kolei = $numer_produktu_z_kolei + 1;


                            ?>


                                    <tr>
                                        <td colspan="3"><input type="text" readonly name="<?php echo $nazwa; ?>" value=" <?php echo $produkt_title; ?>" required></td> <br><br>
                                    </tr>
                            <?php }
                            } ?>

                        </div>

                    </div>
                </form>
                <div class="clear"></div>


            </div> <!-- faktura koniec -->





            <?php
            if (isset($_POST['remove'])) {

                foreach ($_POST['remove'] as $remove_id) {

                    $run_delete = mysqli_query($con, "delete from karta_zakupow where produkt_id = '$remove_id' AND ip_address = '$ip' ");

                    if ($run_delete) {
                        echo "<script>window.open('karta_klienta.php','_self')</script>";
                    }
                }
            }

            if (isset($_POST['kontynuuj'])) {
                echo "<script>window.open('sklep.php','_self')</script>";
            }

            ?>

        </div>

        <div class="produkty">


        </div>

    </div>

</div>

</body>

</html>