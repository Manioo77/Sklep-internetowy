<div class="login_box">

    <form method = "post" action="">

    <table class="tab_login">
        <tr>
            <td colspan="4">
                <h2>Login</h2>
                <span>
                    Nie posiadasz konta? <a href="rejestracja.php">Zarejestruj się</a><br><br>
                </span>
            </td>
        </tr>

        <tr>
            <td><b>Email: </b></td>
            <td colspan="3"><input type="text" name="email" required placeholder="Email"></td>
        </tr>

        <tr>
            <td><b>Hasło: </b></td>
            <td colspan="3"><input type="password" name="password" required placeholder="password"></td>
        </tr>

        <tr>
            <td></td>
            <td colspan="4">
                <a href="checkout.php?forgot_pass">Przypomnij hasło</a>
        </td>
        </tr>

        <tr>
            <td></td>
            <td colspan="4">
                <input type="submit" name="login" value="Login">
        </td>
        </tr>

    </table>
    </form>
</div>

<?php 
if(isset($_POST['login'])) {
    
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $password = md5($password);

    $run_login = mysqli_query($con, "select * from uzytkownicy where password ='$password' AND 	email='$email' ");

    $check_login = mysqli_num_rows($run_login);

    $row_login = mysqli_fetch_array($run_login);

    $ip = get_ip();

    $run_cart = mysqli_query($con, "select * from karta_zakupow where ip_address='$ip' ");

    $check_cart = mysqli_num_rows($run_cart);

    if($check_login == 0 AND $check_cart==0) {

        $_SESSION['user_id'] = $row_login['id'];

        $_SESSION['role'] = $row_login['role'];
        
    $_SESSION['email'] = $email;
    echo "<script>alert('You has logged in successfully !')</script>";
    echo "<script>window.open('my_account.php','_self')</script>";

    }else{
       $_SESSION['user_id'] = $row_login['id'];

       $_SESSION['role'] = $row_login['role'];
        
        $_SESSION['email'] = $email;
        echo "<script>alert('You has logged in successfully !')</script>";
        echo "<script>window.open('checkout.php','_self')</script>";
    }

}

?>

