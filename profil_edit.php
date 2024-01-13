<?php
session_start();
if(isset($_POST['pesel'])) {


    require_once "łączeniedobazy.php";

    $connectbase = @new mysqli($host, $db_user, $db_password, $db_name);

    if ($connectbase->connect_errno != 0) {
        echo "Error:" . $connectbase->connect_errno;
    } else {
        $name = $_POST['Imie'];
        if (ctype_alnum($name) == false) {
            $goodform = false;
            $_SESSION['e_name'] = "Imię nie może zawierać polskich znaków";

        }
        $surname = $_POST['surname'];

        $phone_nr = $_POST['phone_nr'];

        $pesel = $_POST['pesel'];


        $użytkownik = "SELECT * FROM pacjenci INNER JOIN użytkownicy ON pacjenci.id_użytkownika = użytkownicy.id_użytkownika";
        if ($ending = @$connectbase->query($użytkownik)) {
            $num_users = $ending->num_rows;
            $row = $ending->fetch_assoc();
            $login = $_SESSION['user'];
            if ($num_users > 0) {
                $connectbase->query("UPDATE pacjenci INNER JOIN użytkownicy ON pacjenci.id_użytkownika = użytkownicy.id_użytkownika SET imie='$name',nazwisko='$surname',numer_telefonu='$phone_nr',pesel='$pesel' WHERE login='$login'");
                $ending->free_result();
                header('Location:profil.php');
            }
        }

        $connectbase->close();
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8"><link rel="stylesheet" href="reg.css">
  <title>rejestracja</title>
</head>
<body>

  <form method="post">

    Imię:<br/><input type="text" name="Imie"><br/>
      <?php
      if (isset($_SESSION['e_name']))
      {
          echo '<div class="error">'.$_SESSION['e_name'].'</div>';
          unset($_SESSION['e_name']);
      }
      ?>

    Nazwisko:<br/><input type="text" name="surname"><br/>

    numer telefonu:<br/><input type="number" name="phone_nr"><br/>
      <?php
      if (isset($_SESSION['e_phone_nr']))
      {
          echo '<div class="error">'.$_SESSION['e_phone_nr'].'</div>';
          unset($_SESSION['e_phone_nr']);
      }
      ?>

    Pesel:<br/><input type="number" name="pesel"><br/>
      <?php
      if (isset($_SESSION['e_pesel']))
      {
          echo '<div class="error">'.$_SESSION['e_pesel'].'</div>';
          unset($_SESSION['e_pesel']);
      }
      ?>

    <button type="submit">edytuj</button><br/>
  </form>
  <button type="button" onclick="location.href='wróć.php'">wróć</button><br/>
</body>
</html>