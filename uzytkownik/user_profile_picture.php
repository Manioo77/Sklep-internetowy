
            <?php 
            $select_user = mysqli_query($con, "select * from uzytkownicy where id='$_SESSION[user_id]'");
            $fetch_user = mysqli_fetch_array($select_user);
            ?>

        <div class="register_box">

<form method = "post" action="" enctype="multipart/form-data">

<table class="tab_login123">
    <tr>
        <td colspan="4">
            <h2>Awatar profilu</h2>
            </td>
    </tr>

    <tr>
        <td class="awatar123"><b>Image: </b></td>
    <td colspan="3">
            <input type="file" name="image" >
            <div>
                <img src="pobrane_pliki/<?php echo $fetch_user['image']; ?>" class="zdjecie_awataru"> 
            </div>
        </td>
    </tr>  

    
    </div>
    <tr>
<td></td>
<td colspan="4">
    <input type="submit" name="user_profile_picture" value="Save">
</td>
</tr>

</table>
</form>

</div>

<?php 

if(isset($_POST['user_profile_picture'])) {

//check if file not empty
    if(!empty($_FILES['image']['name'])){

$image = $_FILES['image']['name'];
$image_tmp = $_FILES['image']['tmp_name'];
$target_file = "pobrane_pliki/" . $image;
$uploadOK = 1;
$message = '';

//check if the file size more than 5 MB.
if($_FILES["image"]["size"] < 5098888 ) {

//check if file already exists
if(file_exists($target_file)){

    $uploadOK = 0;
    $message .= "Sorry, file already exists.";

         }if($uploadOK == 0) { //Check if uploadOK is set to 0 by an error

            $message .= "Sorry, your file was not uploaded. ";

         }else{
             if(move_uploaded_file($image_tmp, $target_file)) {

                $update_image = mysqli_query($con, "update uzytkownicy set image='$image' where id='$_SESSION[user_id]' ");

                 $message .= "The file" . "" . basename($image) . "" . "has been uploaded. ";
             }else{
                 $message .= "Sorry, there was an error uploading your file";
             }
         }
        } //end if the file size more than 5 mb
        else{
            $message .= "File size max 5MB.";
        }
    }
}   


?>

<p class="error">
    <?php if(isset($message)) {echo $message;} ?>
</p>
