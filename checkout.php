
<?php  include('dodatki/sekcja_gorna.php'); ?>        

</div>




<div class="wyloguj">

<?php

    if(!isset($_SESSION['email'])) {
        include('logowanie.php');
    }else{
        include('platnosc.php');
    }

?>





</div>
</div>


    <?php include ('dodatki/footer.php');?>

    </div>






</body>

</html>




