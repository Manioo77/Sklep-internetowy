<?php 

session_start();

include("funkcje/functions.php");
include("dodatki/db.php");
?>


<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>it_STELA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="style_sklepu277/style_sklepu11.css">
    <script src="js/jquery-3.4.1.js"></script>

    <script type="text/javascript">

        var dzisiaj = new Date();

        var dzien = dzisiaj.getDate();
        if(dzien<10) dzien = "0" +dzien;
        var miesiac = dzisiaj.getMonth()+1;
        if(miesiac<10) miesiac = "0" +miesiac;
        var rok = dzisiaj.getFullYear();
        if(rok<10) rok = "0" +rok;

        var godzina = dzisiaj.getHours();
        if(godzina<10) godzina = "0" +godzina;
        var minuta = dzisiaj.getMinutes();
        if(minuta<10) minuta = "0" +minuta;
        var sekunda = dzisiaj.getSeconds();
        if(sekunda<10) sekunda = "0" +sekunda;
    </script>

</head>

<body>


    <!-- baner -->
    <div class="banner">
        <div class="fixed">
            <div class="menu">
                
                <a href="index.html"><img src="style123/img/biale.png" class="logo" alt=""></a>
                <a href="" class="hamburger"><img src="style/img/hamburger.png" alt="" width="15px"></a> <!-- hamburger zrobic-------------------->
                <ul>
                    <li><a href="index.html">Start</a></li>
                    <li><a href="wszystkie_pro.php">Produkty</a></li>
                    <li><a href="karta_klienta.php">Moje konto</a></li>
                    <li><a href="portfolio/marek.html">Kontakt</a></li>
                    <a href="karta_klienta.php"><img class="koszyk" src="style123/img/koszyk1.png" alt=""></a>
                    <div class="numer_nad_koszykiem">

                    <?php 
                    koszyk();                
                    ?>
                    
                    </div>

                </ul>

             
                <?php if(!isset($_SESSION['user_id'])) { ?>
                
                <div class="rejestracja_login">
                    <div class="logowanie"><a href="checkout.php?action=login">Logowanie</a></div>
                    <div class="rejestracja"><a href="rejestracja.php">Rejestracja</a></div>
                </div>
                <?php }else{ ?>
                    <?php
                    $select_user = mysqli_query($con, "select * from uzytkownicy where id='$_SESSION[user_id] '");
                    $data_user = mysqli_fetch_array($select_user);
                    ?>

                    <div id="profil">

                    <ul>
                        <li class="dropdown_header">
                            <a href="">

                            <?php if($data_user['image'] !=''){ ?>
                                <span><img src="pobrane_pliki/<?php echo $data_user['image']; ?> "></span>

                                <?php }else{ ?>
                                <span><img src="style123/img/awatar.png" alt=""></span>
                                <?php } ?>

                            </a>
                            </li>
                    </ul>

                    <div class="rejestracja_login">
                        <div class="logowanie"><a href="my_account.php?action=edit_account">Ustawienia konta</a></div>
                        <div class="rejestracja">  <a href="wyloguj.php">Wyloguj</a></div>
                    </div>

                     
                    </div>

                <?php } ?>
                    </div>
           

        </div>
        