
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
        <div class="produkty">


        <?php 
        if(isset($_GET['pro_id'])) {
            $produkt_id = $_GET['pro_id'];

            $run_query_by_pro_id = mysqli_query($con, "select * from produkty where produkt_id='$produkt_id' ");

            while($row_pro = mysqli_fetch_array($run_query_by_pro_id)){
            $pro_id = $row_pro['produkt_id'];
            $pro_kat = $row_pro['produkt_kat'];
            $pro_title = $row_pro['produkt_title'];
            $pro_opis = $row_pro['produkt_opis'];
            $pro_kat1 = $row_pro['produkt_kat1'];
            $pro_kat2 = $row_pro['produkt_kat2'];
            $pro_cena = $row_pro['produkt_cena'];
            $pro_obrazek = $row_pro['produkt_obrazek'];

        echo "
        <div id='tlo'>
                <div class='product'>
                <img src='panel_admina/obrazy_produktow/$pro_obrazek' class='obrazek_szczegoly'>
             </div>    
      </div>   
      <div class='opis'>
            <h1 class='naglowek_nazwa'>$pro_title</h1>  
            <p class='cena_szczegoly'><b>$pro_cena zł</b></p>  
                  <a href='index.php?dodaj_karte=$pro_id' class='btn btn-primary przycisk_opis'>
                    <i class='fa fa-shopping-cart'>
                    Dodaj do koszyka
                    </i>
                    </a>
                    <h2>Opis</h2>
            <p class='opis_produktu'><b>$pro_opis</b></p>
            <div class='wysylka'>
                <h2>Dostawa i płatność</h2>
                <p>Po dokonaniu zakupu ze strony it_STELA klient dostaje fakturę na adres e-mail.</p>
                <p>Na fakturze podany jest numer konta bankowego na który do 3 dni trzeba zapłacić za zamówienie.</p>
                <p>Zamówienia wysyłamy po otrzymaniu pieniędzy na konto bankowe.</p>
                <p>14 dni na zwrot, bądź wymianę towaru.</p>
                <br>

                <h2 class='zakup_uslugi'>W przypadku zakupu usługi:</h2>
                <p>* naprawa sprzętu - proszę wysłać sprzęt elektroniczny na adres firmy,</p>
                <p> * stworzenie strony internetowej - proszę skontaktować się z firmą telefonicznie lub poprzez adres e-mail,</p>
                <p>* aktualizacja strony internetowej - proszę skontaktować się z firmą telefonicznie lub poprzez adres e-mail.</p>
                
            </div>
             
           
      </div>
            
            
        ";

            }
        }
        ?>

  

    </div>


</div>

</div>

</div>







