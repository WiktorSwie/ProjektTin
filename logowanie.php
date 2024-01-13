<?php

    session_start();

    if((!isset($_POST['login'])) && (!isset($_POST['hasło'])))
    {
        header('Location:index.php');
        exit();
    }
    require_once "łączeniedobazy.php";

    $connectbase = @new mysqli($host, $db_user, $db_password, $db_name);

    if($connectbase->connect_errno!=0)
    {
        echo "Error:".$connectbase->connect_errno;
    }
    else
    {
        $login = $_POST['login'];
        $password = $_POST['hasło'];


        $logowanie = "SELECT * FROM użytkownicy WHERE login='$login' AND hasło='$password'";
        if ($ending = @$connectbase->query($logowanie))
        {
            $num_users = $ending->num_rows;
            if($num_users>0)
            {
                $_SESSION['logged'] = true;
                $row = $ending->fetch_assoc();
                $_SESSION['id_użytkownika'] = $row['id_użytkownika'];
                $_SESSION['user'] = $row['login'];
                $_SESSION['name'] = $row['imie'];
                $_SESSION['surname'] = $row['nazwisko'];
                $_SESSION['phone_nr'] = $row['numer_telefonu'];
                $_SESSION['pesel'] = $row['pesel'];

                unset($_SESSION['error']);
                $ending->free_result();
                header('Location:główna.php');
            } else {

                $_SESSION['error'] = '<span style="color:red">Błędne hasło lub login</span>';
                header('Location: index.php');

            }

        }
        $connectbase->close();
    }

?>