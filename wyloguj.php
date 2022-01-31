<?php 

session_start();

session_destroy();

echo"<script>window.open('sklep.php','_self')</script>";

?>