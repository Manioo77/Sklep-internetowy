

        <script>
            $(document) .ready(function() {

                $("#password_confirm2") .on('keyup' ,function() {

                 var password_confirm1 = $("#password_confirm1") .val();
                 var password_confirm2 = $("#password_confirm2") .val();

                 //alert(password_confirm2);

                    if(password_confirm1 == password_confirm2){

                        $("#status_for_confirm_password") .html('<strong style="color:green">Hasła zgodne</strong>');
                    }else{
                        $("#status_for_confirm_password") .html('<strong style="color:red">Hasła nie są zgodne</strong>');
                    }

                });
            });

            </script>

            <?php 
            $select_user = mysqli_query($con, "select * from uzytkownicy where id='$_SESSION[user_id]'");
            $fetch_user = mysqli_fetch_array($select_user);
            ?>

        <div class="register_box">

<form method = "post" action="" enctype="multipart/form-data">

<table class="tab_login1">
    <tr>
        <td colspan="4">
            <h2>Zmiana adresu e-mail:</h2>
            </td>
    </tr>

    <tr>
        <td><b>Email: </b></td>
        <td colspan="3"><input type="text" name="email" value="<?php echo $fetch_user['email']; ?>" placeholder="Email" required ></td>
    </tr>

    <tr>
        <td><b>Obecne hasło: </b></td>
        <td colspan="3"><input type="password" name="current_password" placeholder="Obecne hasło" required></td>
    </tr>
    

    <tr>
        <td></td>
        <td colspan="4">
            <input type="submit" name="edit_account" value="Zapisz">
    </td>
    </tr>

</table>
</form>
</div>

<?php 

if(isset($_POST['edit_account'])) {

        $email = trim($_POST['email']);
        $current_password = trim($_POST['current_password']);
        $hash_password = md5($current_password);

        $check_exist = mysqli_query($con, "select * from uzytkownicy where email = '$email' ");

        $email_count = mysqli_num_rows($check_exist);

        $row_register = mysqli_fetch_array($check_exist);

        if($email_count > 0) {
            echo "<script>alert('Twój adres email $email jest już w bazie danych! ')</script>";
        }elseif($fetch_user['password'] != $hash_password){
            echo "<script>alert('Twoje hasło jest nieprawidłowe')</script>";
        }else{
            $update_email = mysqli_query($con, "update uzytkownicy set email='$email' where id='$_SESSION[user_id]' ");

            if($update_email) {
                echo "<script>alert('Twój adres e-mail został pomyślnie zaktualizowany!')</script>";

                echo "<script>window.open(window.location.href, '_self')</script>";
            }
        }
    }


?>
