<?php
$con = mysqli_connect("localhost", "root", "", "sklep");

if (mysqli_connect_errno()) {
    echo "The connection was not established: " . mysqli_connect_error();
}

function get_ip()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}


function dodanie_do_koszyka()
{

    global $con;
    if (isset($_GET['dodaj_karte'])) {

        $produkt_id = $_GET['dodaj_karte'];

        $ip = get_ip();

        $run_check_pro = mysqli_query($con, "select * from karta_zakupow where produkt_id='produkt_id'");

        if (mysqli_num_rows($run_check_pro) > 0) {
            echo "";
        } else {

            $fetch_pro = mysqli_query($con, "select * from produkty where produkt_id='$produkt_id'");

            $fetch_pro = mysqli_fetch_array($fetch_pro);

            $pro_title = $fetch_pro['produkt_opis'];

            $run_insert_pro = mysqli_query($con, "insert into karta_zakupow (produkt_id, produkt_opis, ip_address) values('$produkt_id','$pro_title','$ip') ");

            echo "<script>window.open('sklep.php','_self')</script>";
        }
    }
}


function koszyk_cena()
{

    global $con;

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
        }
    }

    echo  $total .  "" . 'zł';
}

function koszyk()
{

    global $con;

    $ip = get_ip();

    $run_items = mysqli_query($con, "select * from karta_zakupow where ip_address='$ip'");

    echo $count_items = mysqli_num_rows($run_items);
}


function getKategorie()
{

    global $con;

    $get_kategorie = "select * from kategorie";

    $run_kategorie = mysqli_query($con, $get_kategorie);

    while ($row_kategorie = mysqli_fetch_array($run_kategorie)) {
        $kat_id = $row_kategorie['kat_id'];

        $kat_title = $row_kategorie['kat_title'];

        echo "<li><a href='sklep.php?kat=$kat_id'>$kat_title</a></li>";
    }
}

function getKategorie_2()
{

    global $con;

    $get_kategorie_2 = "select * from kategorie_2";

    $run_kategorie_2 = mysqli_query($con, $get_kategorie_2);

    while ($row_kategorie_2 = mysqli_fetch_array($run_kategorie_2)) {
        $kategorie_2_id = $row_kategorie_2['kategorie_2_id'];

        $kategorie_2_title = $row_kategorie_2['kategorie_2_title'];

        echo "<li><a href='sklep.php?kat_2=$kategorie_2_id'>$kategorie_2_title</a></li>";
    }
}

function getKategorie_3()
{

    global $con;

    $get_kategorie_3 = "select * from kategorie_3";

    $run_kategorie_3 = mysqli_query($con, $get_kategorie_3);

    while ($row_kategorie_3 = mysqli_fetch_array($run_kategorie_3)) {
        $kategorie_3_id = $row_kategorie_3['kategorie_3_id'];

        $kategorie_3_title = $row_kategorie_3['kategorie_3_title'];

        echo "<li><a href='sklep.php?kat_3=$kategorie_3_id'>$kategorie_3_title</a></li>";
    }
}




function getPro()
{

    if (!isset($_GET['kat'])) {
        if (!isset($_GET['kat_2'])) {
            if (!isset($_GET['kat_3'])) {

                global $con;

                $get_pro = "select * from produkty order by RAND() LIMIT 0,6";

                $run_pro = mysqli_query($con, $get_pro);

                while ($row_pro = mysqli_fetch_array($run_pro)) {
                    $pro_id = $row_pro['produkt_id'];
                    $pro_kat = $row_pro['produkt_kat'];
                    $pro_title = $row_pro['produkt_title'];
                    $pro_kat1 = $row_pro['produkt_kat1'];
                    $pro_kat2 = $row_pro['produkt_kat2'];
                    $pro_cena = $row_pro['produkt_cena'];
                    $pro_obrazek = $row_pro['produkt_obrazek'];

                    echo "
        <div id='tlo'>
            <div id='content' class='container'>
                <div class='product'>
                     <a href='szczegoly.php?pro_id=$pro_id'>
                         <img src='panel_admina/obrazy_produktow/$pro_obrazek' >
                     

                  <h3>$pro_title</h3>
                  </a>
                  <div class='text'>
                      <p class='price'><b> Cena:  $pro_cena zł</b></p>
                        <a href='sklep.php?dodaj_karte=$pro_id' class='btn btn-primary'>
                             <i class='fa fa-shopping-cart'>
                             Dodaj do koszyka
                             </i>
                         </a>
                  </div>      
             </div>  
         </div>   
      </div>   
            
            
        ";
                }
            }
        }
    }
}

function get_pro_by_kat1_id()
{
    if (isset($_GET['kat'])) {

        global $con;
        $kat_id = $_GET['kat'];

        $get_kat_pro = "select * from produkty where produkt_kat2='$kat_id'";

        $run_kat_pro = mysqli_query($con, $get_kat_pro);

        $count_kats = mysqli_num_rows($run_kat_pro);

        if ($count_kats == 0) {
            echo "<h2> Nie ma produktów w tej kategorii!</h2>";
        }

        while ($row_kat_pro = mysqli_fetch_array($run_kat_pro)) {
            $pro_id = $row_kat_pro['produkt_id'];
            $pro_kat = $row_kat_pro['produkt_kat2'];
            $pro_title = $row_kat_pro['produkt_title'];
            $pro_cena = $row_kat_pro['produkt_cena'];
            $pro_obrazek = $row_kat_pro['produkt_obrazek'];

            echo "
                <div id='tlo'>
                <div id='content' class='container'>
                <div class='product'>
                <a href='szczegoly.php?pro_id=$pro_id'>
                 <img src='panel_admina/obrazy_produktow/$pro_obrazek' >
                  <h3>$pro_title</h3>
                  </a>
                <div class='text'>
                <p class='price'><b> Cena:  $pro_cena zł</b></p>
                <a href='sklep.php?dodaj_karte=$pro_id' class='btn btn-primary'>
                <i class='fa fa-shopping-cart'>
                Dodaj do koszyka
                </i>
                </a>
            </div>      
            </div>  
            </div>   
            </div>   
              
                        
            ";
        }
    }
}

function get_pro_by_kat2_id()
{
    global $con;

    if (isset($_GET['kat_2'])) {
        $kategorie_2_id = $_GET['kat_2'];

        $get_kategorie_2_pro = "select * from produkty where produkt_kat1='$kategorie_2_id'";

        $run_kategorie_2_pro = mysqli_query($con, $get_kategorie_2_pro);

        $count_kategorie_2 = mysqli_num_rows($run_kategorie_2_pro);

        if ($count_kategorie_2 == 0) {
            echo "<h2 class='brak'> Jeszcze nie ma produktów w tej kategorii!</h2>";
        }
        while ($row_kat_2_pro = mysqli_fetch_array($run_kategorie_2_pro)) {
            $pro_id = $row_kat_2_pro['produkt_id'];
            $pro_kat = $row_kat_2_pro['produkt_kat1'];
            $pro_title = $row_kat_2_pro['produkt_title'];
            $pro_cena = $row_kat_2_pro['produkt_cena'];
            $pro_obrazek = $row_kat_2_pro['produkt_obrazek'];

            echo "
                <div id='tlo'>
                <div id='content' class='container'>
                <div class='product'>
                <a href='szczegoly.php?pro_id=$pro_id'>
                <img src='panel_admina/obrazy_produktow/$pro_obrazek' >
                <h3>$pro_title</h3>
                </a>
                <div class='text'>
                <p class='price'><b> Cena:  $pro_cena zł</b></p>
                <a href='sklep.php?dodaj_karte=$pro_id' class='btn btn-primary'>
                <i class='fa fa-shopping-cart'>
                Dodaj do koszyka
                </i>
                </a>
            </div>      
            </div>  
            </div>   
            </div>                         
            ";
        }
    }
}


function get_pro_by_kat3_id()
{
    global $con;
    if (isset($_GET['kat_3'])) {
        $kategorie_3_id = $_GET['kat_3'];

        $get_kategorie_3_pro = "select * from produkty where produkt_kat='$kategorie_3_id'";

        $run_kategorie_3_pro = mysqli_query($con, $get_kategorie_3_pro);

        $count_kategorie_3 = mysqli_num_rows($run_kategorie_3_pro);

        if ($count_kategorie_3 == 0) {
            echo "<h2 class='brak'> Jeszcze nie ma produktów w tej kategorii!</h2>";
        }
        while ($row_kat_3_pro = mysqli_fetch_array($run_kategorie_3_pro)) {
            $pro_id = $row_kat_3_pro['produkt_id'];
            $pro_kat = $row_kat_3_pro['produkt_kat'];
            $pro_title = $row_kat_3_pro['produkt_title'];
            $pro_cena = $row_kat_3_pro['produkt_cena'];
            $pro_obrazek = $row_kat_3_pro['produkt_obrazek'];

            echo "
                <div id='tlo'>
                <div id='content' class='container'>
                <div class='product'>
                <a href='szczegoly.php?pro_id=$pro_id'>
                <img src='panel_admina/obrazy_produktow/$pro_obrazek' >
                <h3>$pro_title</h3>
                </a>
                <div class='text'>
                <p class='price'><b> Cena:  $pro_cena zł</b></p>
                <a href='sklep.php?dodaj_karte=$pro_id' class='btn btn-primary'>
                <i class='fa fa-shopping-cart'>
                Dodaj do koszyka
                </i>
                </a>
            </div>      
            </div>  
            </div>   
            </div>                         
            ";
        }
    }
}
