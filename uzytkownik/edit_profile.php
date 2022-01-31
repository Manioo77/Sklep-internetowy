<?php
$select_user = mysqli_query($con, "select * from uzytkownicy where id='$_SESSION[user_id]'");
$fetch_user = mysqli_fetch_array($select_user);
?>

<div class="register_box">

    <form method="post" action="" enctype="multipart/form-data">

        <table class="tab_login1">
            <tr>
                <td colspan="4">
                    <h2>Edycja profilu:</h2>
                </td>
            </tr>

            <tr>
                <td><b>Zmień nazwę użytkownika: </b></td>
                <td colspan="3"><input type="text" name="name" value="<?php echo $fetch_user['name']; ?>" placeholder="Name" required></td>
            </tr>



            <tr>
                <td class="awatar"><b>Country: </b></td>
                <td colspan="3">
                    <?php include('dodatki/lista_krajow.php'); ?>
                </td>
            </tr>

            <tr>
                <td><b>City: </b></td>
                <td colspan="3"><input type="text" name="city" value="<?php echo $fetch_user['city']; ?>" placeholder="City" required></td>
            </tr>

            <tr>
                <td><b>Contact: </b></td>
                <td colspan="3"><input type="text" name="contact" value="<?php echo $fetch_user['contact']; ?>" placeholder="Contact" required></td>
            </tr>

            <tr>
                <td><b>Address: </b></td>
                <td colspan="3"><input type="text" name="address" value="<?php echo $fetch_user['user_address']; ?>" placeholder="address" required></td>
            </tr>



            <tr>
                <td></td>
                <td colspan="4">
                    <input type="submit" name="edit_profile" value="Zapisz">
                </td>
            </tr>

        </table>
    </form>
</div>

<?php

if (isset($_POST['edit_profile'])) {

    if ($_POST['name'] != '' && $_POST['edit_country'] != '' && $_POST['city'] != '' && $_POST['contact'] != '' && $_POST['address'] != '') {

        $name = $_POST['name'];
        $country = $_POST['edit_country'];
        $city = $_POST['city'];
        $contact = $_POST['contact'];
        $address = $_POST['address'];

        $update_profile = mysqli_query($con, "update uzytkownicy set name='$name', country='$country', city='$city', contact='$contact', user_address='$address' where id='$_SESSION[user_id]'  ");

        if ($update_profile) {
            echo "<script>alert('Twoje dane zostały pomyślnie zaktualizowane')</script>";

            echo "<script>window.open(window.location.href, '_self')</script>";
        }
    }
}
?>