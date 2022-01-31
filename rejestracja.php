<?php include ('dodatki/sekcja_gorna.php'); ?>


        <script>
            $(document) .ready(function() {

                $("#password_confirm2") .on('keyup' ,function() {

                 var password_confirm1 = $("#password_confirm1") .val();
                 var password_confirm2 = $("#password_confirm2") .val();

                 //alert(password_confirm2);

                    if(password_confirm1 == password_confirm2){

                        $("#status_for_confirm_password") .html('<strong>Hasła zgodne</strong>');
                    }else{
                        $("#status_for_confirm_password") .html('<strong>Hasła nie są zgodne</strong>');
                    }

                });
            });

            </script>

        <div class="register_box">

<form method = "post" action="" enctype="multipart/form-data">

<table class="tab_login">
    <tr>
        <td colspan="4">
            <h2>Rejestracja</h2>
            <span>
                Masz już konto? <a href="index.php?action=logowanie">Zaloguj się</a><br><br>
            </span>
        </td>
    </tr>

    <tr>
        <td><b>Name: </b></td>
        <td colspan="3"><input type="text" name="name" placeholder="Name" required></td>
    </tr>

    <tr>
        <td><b>Email: </b></td>
        <td colspan="3"><input type="text" name="email" placeholder="Email" required ></td>
    </tr>

    <tr>
        <td><b>Hasło: </b></td>
        <td colspan="3"><input type="password" id="password_confirm1" name="password" placeholder="password" required></td>
    </tr>

    <tr>
        <td><b>Potwierdź hasło: </b></td>
        <td colspan="3"><input type="password" id="password_confirm2" name="confirm_password" placeholder="Confirm_password" required >
        <p id="status_for_confirm_password"></p>
        </td>
    </tr>

    <tr>
        <td class="awatar"><b>Image: </b></td>
        <td colspan="3"><input type="file" name="image" ></td>
    </tr>

    <tr>
        <td class="awatar"><b>Country: </b></td>
        <td colspan="3">
            <?php include('dodatki/lista_krajow.php'); ?>
        </td>
    </tr>

    <tr>
        <td><b>City: </b></td>
        <td colspan="3"><input type="text" name="city" placeholder="City" required ></td>
    </tr>

    <tr>
        <td><b>Contact: </b></td>
        <td colspan="3"><input type="text" name="contact" placeholder="Contact" required></td>
    </tr>

    <tr>
        <td><b>Address: </b></td>
        <td colspan="3"><input type="text" name="address" placeholder="address" required></td>
    </tr>

    

    <tr>
        <td></td>
        <td colspan="4">
            <input type="submit" name="register" value="Register">
    </td>
    </tr>

</table>
</form>
</div>

<?php 

if(isset($_POST['register'])) {

    if(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password']) && !empty($_POST['name'])) {
        $ip = get_ip();
        $name = $_POST['name'];
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $hash_password = md5($password);
        $confirm_password = trim($_POST['confirm_password']);

        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $country = $_POST['country'];
        $city = $_POST['city'];
        $contact = $_POST['contact'];
        $address = $_POST['address'];

        $check_exist = mysqli_query($con, "select * from uzytkownicy where email = '$email' ");

        $email_count = mysqli_num_rows($check_exist);

        $row_register = mysqli_fetch_array($check_exist);

        if($email_count > 0) {
            echo "<script>alert('Twój adres email $email jest już w bazie danych! ')</script>";
        }elseif($row_register['email'] != $email && $password == $confirm_password){
            
            move_uploaded_file($image_tmp, "pobrane_pliki/$image");

            $run_insert = mysqli_query($con, "insert into uzytkownicy (ip_address,name,email,password,country,city,contact,user_address,image) values ('$ip','$name','$email','$hash_password','$country','$city','$contact','$address','$image') ");
            if($run_insert) {
                $sel_user = mysqli_query($con,"select * from uzytkownicy where email='$email' ");
                $row_user = mysqli_fetch_array($sel_user);

               $_SESSION['user_id'] = $row_user['id'] ."<br>";
               $_SESSION['role'] = $row_user['role'];
            }
            $run_cart = mysqli_query($con, "select * from karta_zakupow where ip_address='$ip' ");

            $check_cart = mysqli_num_rows($run_cart);

            if($check_cart == 0) {

                $_SESSION['email'] = $email;
                echo "<script>alert('Konto zostało pomyślnie utworzone')</script>";

                echo "<script>window.open('my_account.php','_self')</script>";

            }else{

                $_SESSION['email'] = $email;
                echo "<script>alert('Konto zostało pomyślnie utworzone!')</script>";

                echo "<script>window.open('checkout.php','_self')</script>";
            }
        }

    }
}


?>
