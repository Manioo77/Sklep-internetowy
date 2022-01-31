
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
          $get_pro = "select * from produkty ";
    
          $run_pro = mysqli_query($con, $get_pro);
      
          while($row_pro = mysqli_fetch_array($run_pro)) {
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
                              <a href='index.php?dodaj_karte=$pro_id' class='btn btn-primary'>
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
        ?>

        <?php 
            get_pro_by_kat1_id();
        ?>        
        
        <?php 
            get_pro_by_kat2_id()
        ?>      


        <?php 
            get_pro_by_kat3_id()
        ?>      


    <?php include ('dodatki/footer.php');?>

    </div>


</div>

</div>

</div>


</body>

</html>




