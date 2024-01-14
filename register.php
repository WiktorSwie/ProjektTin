<?php
    session_start();

    if(isset($_POST['pesel']))
    {
        $goodform=true;

        $login = $_POST['login'];
        if((strlen($login)<5) || (strlen($login)>15))
        {
            $goodform=false;
            $_SESSION['e_login']="Login musi mieć od 5 do 15 znaków";

        }

        if(ctype_alnum($login)==false)
        {
            $goodform=false;
            $_SESSION['e_login']="Login może zawierać tylko litery i cyfry";
        }

        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];
        if((strlen($pass1)<8) || (strlen($pass1)>20))
        {
            $goodform=false;
            $_SESSION['e_pass']="hasło musi mieć od 8 do 20 znaków";

        }

        if(ctype_alnum($pass1)==false)
        {
            $goodform=false;
            $_SESSION['e_pass']="hasło może zawierać tylko litery i cyfry";
        }

        if($pass1 != $pass2)
        {
            $goodform=false;
            $_SESSION['e_pss2']="hasła muszą być identyczne";

        }

        $name = $_POST['Imie'];
        if(ctype_alnum($name)==false)
        {
            $goodform=false;
            $_SESSION['e_name']="Imię nie może zawierać polskich znaków";

        }
        $surname = $_POST['surname'];

        $phone_nr = $_POST['phone_nr'];

        $pesel = $_POST['pesel'];



        require_once "łączeniedobazy.php";

        $connectbase = @new mysqli($host, $db_user, $db_password, $db_name);

        if($connectbase->connect_errno!=0)
        {
            echo "Error:".$connectbase->connect_errno;
        }
        else
        {

            $ending = $connectbase->query("SELECT id_użytkownika FROM użytkownicy WHERE login='$login'");

            $num_login = $ending->num_rows;
            if($num_login>0) {
                $goodform = false;
                $_SESSION['e_login'] = "taki login już istnieje";
            }

            if ($goodform==true)
            {

                if($connectbase->query("INSERT INTO użytkownicy(login,hasło,rola) VALUES ('$login','$pass1',1)") && $connectbase->query("INSERT INTO pacjenci(imie,nazwisko,numer_telefonu,pesel,id_użytkownika) SELECT '$name','$surname','$phone_nr','$pesel', max(id_użytkownika) from użytkownicy"));
                {
                    $_SESSION['succes']=true;
                    header('Location: index.php');
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
    Login:<br/><input type="text" name="login" /><br/>
      <?php
      if (isset($_SESSION['e_login']))
          {
              echo '<div class="error">'.$_SESSION['e_login'].'</div>';
              unset($_SESSION['e_login']);
          }
      ?>

    Hasło:<br/><input type="password" name="pass1"><br/>
      <?php
      if (isset($_SESSION['e_pass']))
      {
          echo '<div class="error">'.$_SESSION['e_pass'].'</div>';
          unset($_SESSION['e_pass']);
      }
      ?>

    Powtórz hasło:<br/><input type="password" name="pass2"><br/>
      <?php
      if (isset($_SESSION['e_pass2']))
      {
          echo '<div class="error">'.$_SESSION['e_pass2'].'</div>';
          unset($_SESSION['e_pass2']);
      }
      ?>

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

    <button type="submit">zarejestruj</button><br/>
  </form>

</body>
</html>
