
<?php

include("dodatki/sekcja_gorna.php");
?>

<?php


function clean_trolley($con): void
{
    //polecenie
    $ip = get_ip();
    $mysql_query = "delete from karta_zakupow where ip_address='$ip'";

    mysqli_query($con, $mysql_query);
}
function debug_to_console($data)
{
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

function alert_and_redirect($data, $webpage)
{
    echo "
    <script>
    alert('$data');
    window.location.href='$webpage';
    </script>
    ";
}


//zmienna na przechowanie adresu email
$email_firmowy = 'it.stelaaa@gmail.com';

//zmienna na przechowanie numeru produktu
$i = 1;
//tablica na przechowanie wszystkich produktów
$tablica_na_produkty = array();

//odczytanie każdego produktu i zapisanie go do tablicy $tablica_na_produkty
do {

    //sprawdzamy czy istnieje taka zmienna(z pobranego wczesniej formularza)
    if (isset($_POST['produkty_faktura' . $i])) {
        #dodaj zmnieną do tablicy (pusznij)

        array_push($tablica_na_produkty, $_POST['produkty_faktura' . $i]);
        $i = $i + 1;
    } else {
        break;
    }
} while (TRUE);


//tablica wyglada tak: rower, laptop, komputer, czyszczenie 
// 0      1      2           3

//zmienna tekstowa na przechowanie nazw wszystkich produktow
$produkty_faktura = "";

//iterowanie po kazdym produkcie z tablicy $tablica na produkty i dodanie go 
//na koniec zmiennej tekstowej $produkty_faktura
foreach ($tablica_na_produkty as $produkt) {

    //dodawanie tekstu do $produkty_faktura
    $produkty_faktura = $produkty_faktura . $produkt . "\n";
}


$name    = $_POST['name'];
$email   = $_POST['email'];
$phone = $_POST['contact'];
$country = $_POST['country'];
$city = $_POST['city'];
$address = $_POST['address'];
$liczba_prod = $_POST['ilosc_prod'];
$cena_prod = $_POST['cena_prod'];


$to      =      $email;

$subject = 'Nowy e-mail od ' . " " . $email;
$message = "Użytkownik $name zakupił $liczba_prod produktów na stronie it_STELA \n" .
    " $produkty_faktura \n" .
    "CENA: $cena_prod \n" .
    "DANE KUPUJĄCEGO: \n" .
    "Imię: $name \n" .
    "Adres e-mail: $email \n" .
    "Telefon: $phone \n" .
    "Kraj: $country \n" .
    "Miasto: $city \n" .
    "Adres: $address \n" .
    "DANE Firmy: \n" .
    "Nazwa: it_STELA \n" .
    "Adres e-mail: it.stelaaa@gmail.com \n" .
    "Telefon: 533 214 241 \n" .
    "Kraj: Polska \n" .
    "Miasto: Kraków \n" .
    "Numer konta: PL KK AAAAAAAA BBBBBBBBBBBBBBBB \n" .
    "Tytuł: W tytule proszę wpisać imię, nazwisko, nazwę produktu lub usługi \n" .
    "Adres: Opolska 45/19 ";



$subject2 = "Nowe zamówienie";
$strona_html = "";

//weryfikacja przebiegu wysłania faktury ... 
//Wysyłanie faktury do klienta
try {
    //Wysłanie faktury do klienta
    $rezultat = mail($to, $subject, $message);

    if (!$rezultat) {
        throw new Exception("Nie powiodło się wysłanie emaila do klienta");
    }

    //Wysłanie faktury do firmy
    $rezultat2 = mail($email_firmowy, $subject, $message);

    if (!$rezultat2) {
        throw new Exception("Nie powiodło się wysłanie emaila do firmy");
    }

    clean_trolley($con);
    alert_and_redirect("Zamówienie w realizacji", 'sklep.php');
} catch (Exception $e) {
    echo 'Message' . $e->getMessage();
    alert_and_redirect("Nie udało sie zrealizować zamówienie, błąd techniczny", 'zaplac.php');
}

?>