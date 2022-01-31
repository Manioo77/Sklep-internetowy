
<?php include('../dodatki/db.php'); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>insert_product</title>
    <style>


    

       
    </style>
</head>
<body>
    
<div class="form_box">

<form action="" method="post" enctype="multipart/form-data">

<table class="tabela">
    <tr>
        <td colspan="7"><h2>Add Category</h2>
    <div class="border_bottom"></div>
    </td>
    </tr>

    <tr>
        <td><b>Add New Category: </b></td>
        <td><input type="text" name="product_cat" size="60" required></td>
    </tr>

    <tr>
        <td colspan="8"><input type="submit" name="insert_cat" value="Dodaj nową kategorie" class="przycisk1"></td>
    </tr>
</table>

</form>

</div>

</body>
</html>

<?php 

if(isset($_POST['insert_cat'])){

    $product_cat = mysqli_real_escape_string($con, $_POST['product_cat']);

    $insert_cat = mysqli_query($con, "insert into kategorie (cat_title) values ('$product_cat') ");
   
     if($insert_cat) {
         echo "<script>alert('Product Category has been inserted successfully!')</script>";

         echo "<script>window.open(window.location.href, '_self')</script>";
     }

    }

?>