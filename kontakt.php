<?php

$to      = 'it.stelaaa@gmail.com';
$name    = $_POST['imie'];
$surname    = $_POST['nazwisko'];
$email   = $_POST['email'];
$phone = $_POST['kontakt'];
$date = $_POST['date'];
$hours = $_POST['czas'];
$subject = 'Nowy e-mail od ' . " " . $email . " ," . 'Telefon' . " " .$phone . " " . " ," . " " . 'Data wizyty:' . " " . $date . " ," . 'Czas wizyty:' . " " . $hours;
$message = $_POST['wiadomosc'];
$headers = 'From: ' . $name . " " . $surname . ' (' . $email . ')';

mail($to, $subject, $message, $headers);

header("Location: index.html");
?>