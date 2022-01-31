
<?php include("dodatki/db.php"); ?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodanie produktu</title>

<style>


    .tytul{
        width: 795px;
        border: 2px solid black;
        background-color: orange;
        padding:10px 50px;
        font-weight: bolder;
        font-size: 22px;
        text-transform: uppercase;
    }

    table{
        font-size: 14px;
        text-align: center;
        margin: 20px auto;
        border: 2px solid black;
        background-color: #e0e0e0;
    }

    td{
        border: 1px solid black;
        padding: 10px;
    }

    .nazwa_prod{
        padding:5px;
        color:black;
    }




</style>


</head>
<body>
    <form action="dodanie_produktu.php" method="post" enctype="multipart/form-data">

        <table>
            <tr>
                <td colspan="7"  class="tytul" >Dodanie nowego produktu lub usługi</td>
            </tr>

            <tr>
                <td><b>Nazwa produktu: </b></td>
                <td><input type="text" name="produkt_title" class="nazwa_prod" size="60" required></td>
            </tr>
            
            <tr>
                <td><b>Dodaj nową usługę: </b></td>
                <td>
                    <select name="produkt_kat">
                        <option>Wybierz kategorię</option>

                        <?php 
                       $get_kategorie_3 = "select * from kategorie_3";

                       $run_kategorie_3 = mysqli_query($con, $get_kategorie_3);
    
                       while($row_kategorie_3 = mysqli_fetch_array($run_kategorie_3)) {
                           $kategorie_3_id = $row_kategorie_3['kategorie_3_id'];
    
                           $kategorie_3_title = $row_kategorie_3['kategorie_3_title'];
    
                           echo "<option value='$kategorie_3_id'>$kategorie_3_title</option>";
                       }

                    ?>

                <tr>
                <td><b>Dodaj nowy produkt (elektronika): </b></td>
                <td>
                    <select name="produkt_kat1">
                        <option>Wybierz kategorię</option>

                        <?php 
                        $get_kategorie_2 = "select * from kategorie_2";

                   $run_kategorie_2 = mysqli_query($con, $get_kategorie_2);

                   while($row_kategorie_2 = mysqli_fetch_array($run_kategorie_2)) {
                       $kategorie_2_id = $row_kategorie_2['kategorie_2_id'];

                       $kategorie_2_title = $row_kategorie_2['kategorie_2_title'];

                       echo "<option value='$kategorie_2_id'>$kategorie_2_title</option>";
                   }

                    ?>

                <tr>
                <td><b>Dodaj nowy produkt (odzież firmowa): </b></td>
                <td>
                    <select name="produkt_kat2">
                        <option>Wybierz kategorię</option>

                        <?php 
                        $get_kategories = "select * from kategorie";

                        $run_kategories = mysqli_query($con, $get_kategories);
                    
                        while($row_kategories = mysqli_fetch_array($run_kategories)){
                            $kat_id = $row_kategories['kat_id'];
                    
                            $kat_title = $row_kategories['kat_title'];
                    
                            echo "<option value='$kat_id'>$kat_title</option>";
                        }

                    ?>

                    </select>
                </td>
            </tr>

            <tr>
            <td><b>Obrazek:</b></td>
            <td><input type="file" name="produkt_obrazek"></td>
            </tr>

            <tr>
            <td><b>Cena:</b></td>
            <td><input type="text" name="produkt_cena" required></td>
            </tr>

            <tr>
                <td><b>Opis produktu/usługi: </b></td>
                <td><textarea name="produkt_opis" id="" cols="20" rows="10"></textarea></td>
            </tr>


            <tr>
            <td><b>Słowa klucze:</b></td>
            <td><input type="text" name="produkt_klucz" required></td>
            </tr>

            <tr>
                <td colspan="7"><input type="submit" name="insert_post" value="Dodaj produkt / usługę"></td>
            </tr>

        </table>
        </form>
</body>
</html>


<?php 

if(isset($_POST['insert_post'])) {
    $produkt_title = $_POST['produkt_title'];
    $produkt_kat = $_POST['produkt_kat'];
    $produkt_kat1 = $_POST['produkt_kat1'];
    $produkt_kat2 = $_POST['produkt_kat2'];
    $produkt_cena = $_POST['produkt_cena'];
    $produkt_opis = trim(mysqli_real_escape_string($con, $_POST['produkt_opis']));
    $produkt_klucz = $_POST['produkt_klucz'];

    //obrazek
    $produkt_obrazek = $_FILES['produkt_obrazek']['name'];
    $produkt_obrazek_tmp = $_FILES['produkt_obrazek']['tmp_name'];

    move_uploaded_file($produkt_obrazek_tmp, "obrazy_produktow/$produkt_obrazek");

    $insert_produkt = "insert into produkty(produkt_kat,produkt_kat1,produkt_kat2,produkt_title, produkt_cena, produkt_opis, produkt_klucz, produkt_obrazek) 
    values('$produkt_kat','$produkt_kat1 ','$produkt_kat2','$produkt_title','$produkt_cena','$produkt_opis','$produkt_klucz','$produkt_obrazek')";

    $insert_pro = mysqli_query($con, $insert_produkt);
    
    if($insert_pro) {
        echo "<script>alert('Produkt został poprawnie dodany!')</script>";

        /*echo "<script>window.open('index.php?przycisk_dodaj','_self')</script>";*/
    }
}

?>