<!--Łączenie sklepu z bazą danych--->

<?php 
$con = mysqli_connect("localhost", "root", "", "sklep");

if(mysqli_connect_errno()) {
    echo "Problem z połączeniem z bazą danych MySQL: " . mysqli_connect_error();
}
?>