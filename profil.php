<?php
session_start();
require_once "łączeniedobazy.php";

$connectbase = @new mysqli($host, $db_user, $db_password, $db_name);

if($connectbase->connect_errno!=0)
{
    echo "Error:".$connectbase->connect_errno;
}
else
{
    $login = $_SESSION['user'];
    $użytkownik ="SELECT * FROM pacjenci INNER JOIN użytkownicy ON pacjenci.id_użytkownika = użytkownicy.id_użytkownika WHERE login='$login'";
    if ($ending = @$connectbase->query($użytkownik)) {
        $num_users = $ending->num_rows;
        if ($num_users > 0) {
            $_SESSION['logged'] = true;
            $row = $ending->fetch_assoc();
            $_SESSION['name'] = $row['imie'];
            $_SESSION['surname'] = $row['nazwisko'];
            $_SESSION['phone_nr'] = $row['numer_telefonu'];
            $_SESSION['pesel'] = $row['pesel'];
        }
    }

    $connectbase->close();
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8"><link rel="stylesheet" href="log.css">
    <title>strona główna</title>
</head>
<body>
<div>
    <?php
    echo 'imie:'.$_SESSION['name'].'<br>';
    echo 'nazwisko:'.$_SESSION['surname'].'<br>';
    echo 'numer telefonu:'.$_SESSION['phone_nr'].'<br>';
    echo 'pesel:'.$_SESSION['pesel'].'<br>';
    ?>
</div>
<button onclick="location.href='wróć.php'" type="button">wróć</button><br/>
</body>
</html>