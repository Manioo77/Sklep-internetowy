<style>
.delete_account_container{
    padding:10px;
}

.delete_account_box{
    width: 50%;
}

.delete_account_box input[type=submit] {
    padding:7px 15px;
    margin: 20px;
    float: right;
    border:none;
}

.delete_account_container_h1 {
    text-align: left;
}

.yes_btn {
    background: rgba(3,169,252,0.9);
    color:white;
}
</style>

<div class="delete_account_container">
    <h1 class="delete_account_container_h1">Confirm Box</h1>
    <hr>

    <div class="delete_account_box">

    <h4>Jesteś pewny, że chcesz usunąć twoje konto?</h4>
    <form action="" method="post">
        <input type="submit" class="yes_btn" name="yes" value="Yes">
        <input type="submit" name="cancel" value="Cancel">
    </form>

    </div>
</div>

<?php 
    if(isset($_POST['yes'])) {
        $delete_account = mysqli_query($con, "delete from uzytkownicy where id='$_SESSION[user_id]'");

        session_destroy();

        echo "<script>alert('Your account has been deleted! ')</script>";

        echo "<script>window.open('sklep.php','_self')</script>";

    }

    if(isset($_POST['cancel'])) {
        echo "<script>window.open(window.location.href, '_self')</script>";
    }
?>