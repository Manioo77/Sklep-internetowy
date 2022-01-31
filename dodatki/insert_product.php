
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
        <td colspan="7"><h2>Add Product</h2>
    <div class="border_bottom"></div>
    </td>
    </tr>

    <tr>
        <td><b>Product title: </b></td>
        <td><input type="text" name="product_title" size="60" required></td>
    </tr>

    <tr>
        <td><b>Product Category:</b></td>
        <td>
            <select name="product_cat">
                <option>Select a Category</option>

                <?php 
                 $get_cats = "select * from kategorie";

                 $run_cats = mysqli_query($con, $get_cats);
             
                 while($row_cats=mysqli_fetch_array($run_cats)){
                     $cat_id = $row_cats['cat_id'];
             
                     $cat_title = $row_cats['cat_title'];
             
                     echo "<option value='$cat_id'>$cat_title</option>";
                 }

                 ?>
            </select>
        </td>
    </tr>

    <tr>
        <td><b>Product Brand:</b></td>
        <td>
            <select name="product_brand">
                <option>Select a Brand</option>

                <?php 
                 $get_brands = "select * from modele";

                 $run_brands = mysqli_query($con, $get_brands);

                 while($row_brands = mysqli_fetch_array($run_brands)){
                     $brand_id = $row_brands['brand_id'];

                     $brand_title = $row_brands['brand_title'];

                     echo "<option value='$brand_id'>$brand_title</option>";
                     
                 }

                 ?>
            </select>
        </td>
    </tr>

    <tr>
        <td><b>Product Image: </b></td>
        <td><input type="file" name="product_image"></td>
    </tr>

    <tr>
        <td><b>Product Price: </b></td>
        <td><input type="text" name="product_price" required></td>
    </tr>

    <tr>
        <td class="pro_desc"><b>Product Description: </b></td>
        <td><textarea name="product_desc" rows="10"></textarea></td>
    </tr>

    <tr>
        <td><b>Product Keywords: </b></td>
        <td><input type="text" name="product_keywords" required></td>
    </tr>

    <tr>
        <td colspan="8"><input type="submit" name="insert_post" value="DODAJ PRODUKT" class="przycisk"></td>
    </tr>
</table>

</form>

</div>

</body>
</html>

<?php 

if(isset($_POST['insert_post'])){
    $product_title = $_POST['product_title'];
    $product_cat = $_POST['product_cat'];
    $product_brand = $_POST['product_brand'];
    $product_price = $_POST['product_price'];
    $product_desc = trim(mysqli_real_escape_string($con,$_POST['product_desc']));
    $product_keywords = $_POST['product_keywords'];


    //Image from the field
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp = $_FILES['product_image']['tmp_name'];

    move_uploaded_file($product_image_tmp,"product_images/$product_image");

    $insert_product = "insert into products (product_cat,product_brand,product_title,product_price,product_desc,product_image,product_keywords)
     values('$product_cat','$product_brand','$product_title','$product_price','$product_desc','$product_image','$product_keywords') ";

     $insert_pro = mysqli_query($con, $insert_product);

     if($insert_pro) {
         echo "<script>alert('Product Has Been inserted successfully!')</script>";

         echo "<script>window.open('index.php?insert_product','_self')</script>";
     }

    }

?>