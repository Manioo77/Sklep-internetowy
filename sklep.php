
<?php  include('dodatki/sekcja_gorna.php'); ?>        


        <div class="form">
            <form action="results.php" method="get" enctype="multipart/form-data">
                <input type="text" name="user_query" class="szukac" placeholder="Czego szukasz?">
                <input type="submit" name="search" class="szukac_przycisk" value="Szukaj">
            </form>
        </div>

        <div class="wrapper">
            <div class="boczny">

            <?php if(!isset($_GET['action'])) { ?>

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
            <div class="clear"></div>


            <div class="zawartosc">

                <?php 
                dodanie_do_koszyka();         
                ?>

                <div class="produkty">

                <?php
                    getPro();
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
                    <?php }else{ ?>


                    <?php 
                    include('logowanie.php');
                    }
                    ?>

        </div>


        </body>

</html>
        


      
