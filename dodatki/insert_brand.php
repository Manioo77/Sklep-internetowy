
<?php include('../includes/db.php'); ?>


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
        <td colspan="7"><h2>Add Brand</h2>
    <div class="border_bottom"></div>
    </td>
    </tr>

    <tr>
        <td><b>Add New Brand: </b></td>
        <td><input type="text" name="product_brand" size="60" required></td>
    </tr>

    <tr>
        <td colspan="8"><input type="submit" name="insert_brand" value="Dodaj nową markę" class="przycisk1"></td>
    </tr>
</table>

</form>

</div>

</body>
</html>

<?php 

if(isset($_POST['insert_brand'])){

    $product_brand = mysqli_real_escape_string($con, $_POST['product_brand']);

    $insert_brand = mysqli_query($con, "insert into modele (brand_title) values ('$product_brand') ");
   
     if($insert_brand) {
         echo "<script>alert('Product brand has been inserted successfully!')</script>";

         echo "<script>window.open(window.location.href, '_self')</script>";
     }

    }

?>