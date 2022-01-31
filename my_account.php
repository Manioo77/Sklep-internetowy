
<?php  include('dodatki/sekcja_gorna.php'); ?>        
<div class="clear"> </div>

    <div class="main_wrapper">

        <?php if(isset($_SESSION['user_id'])) { ?>


             <div class="user_container">
                <div class="user_content">
                <?php 
                if(isset($_GET['action'])) {
                    $action = $_GET['action'];    
                }else{
                    $action = '';
                }

                switch($action) {

                case "edit_account";
                include('uzytkownik/edit_account.php');
                break;   
                
                case "edit_profile";
                include('uzytkownik/edit_profile.php');
                break;   

                case "user_profile_picture";
                include('uzytkownik/user_profile_picture.php');
                break;   

                case "change_password";
                include('uzytkownik/change_password.php');
                break;   
                
                case "delete_account";
                include('uzytkownik/delete_account.php');
                break; 

                default;
                echo "Do something";
                break;

            }
               ?>

                 </div>


                 <div class="user_sidebar">

                 <?php 
                    $run_image = mysqli_query($con, "select * from uzytkownicy where id='$_SESSION[user_id]' ");

                    $row_image = mysqli_fetch_array($run_image);

                    if($row_image['image'] !='') {
                 ?>

                 <div class="user_image">
                     <img src="pobrane_pliki/<?php echo $row_image['image']; ?>">
                 </div>
                 <?php }else{ ?>
                    
                 <div class="user_image">
                     <img src="style123/img/awatar.png">
                 </div>

                 <?php } ?>

                    <ul>
                        <li><a href="zaplac.php">Moje zamówienie</a></li>
                        <li><a href="my_account.php?action=edit_account">Edytuj e-mail</a></li>
                        <li><a href="my_account.php?action=edit_profile">Edytuj profil</a></li>
                        <li><a href="my_account.php?action=user_profile_picture">Zmień zdjęcie</a></li>
                        <li><a href="my_account.php?action=change_password">Zmień hasło</a></li>
                        <li><a href="my_account.php?action=delete_account">Usuń konto</a></li>
                        <li><a href="wyloguj.php">Wyloguj</a></li>
                   </ul>
                 </div>
             </div>

                    <?php }else{ ?>

                    <h1>Account Setting Page</h1>

                    <h5><a href="sklep.php?action=login">Zaloguj się</a>na swoje konto</h5>

                    <?php } ?>
    </div>


             </body>

</html>
        


      
