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
    if(isset($_POST['newpass1']))
    {
        $newpass1 = $_POST['newpass1'];
        $newpass2 = $_POST['newpass2'];
        $goodform= true;
        if((strlen($newpass1)<8) || (strlen($newpass1)>20))
        {
            $goodform=false;
            $_SESSION['e_pass']="hasło musi mieć od 8 do 20 znaków";

         }

        if(ctype_alnum($newpass1)==false)
         {
             $goodform=false;
              $_SESSION['e_pass']="hasło może zawierać tylko litery i cyfry";
         }

        if($newpass1 != $newpass2)
         {
            $goodform=false;
            $_SESSION['e_pss2']="hasła muszą być identyczne";

         }
        if ($goodform==true){
              $clogin = $_SESSION['clogin'];
              if ($connectbase->query("UPDATE użytkownicy INNER JOIN pacjenci ON pacjenci.id_użytkownika = użytkownicy.id_użytkownika SET hasło='newpass1' WHERE login ='$clogin'"));
            {
                header('Location: index.php');
            }

        }
    }
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
  <form method="post">
      Wpisz nowe hasło:<br/><input type="password" name="newpass1"><br/>
      <?php
      if (isset($_SESSION['e_pass']))
      {
          echo '<div class="error">'.$_SESSION['e_pass'].'</div>';
          unset($_SESSION['e_pass']);
      }
      ?>

      Powtórz nowe hasło:<br/><input type="password" name="newpass2"><br/>
      <?php
      if (isset($_SESSION['e_pass2']))
      {
          echo '<div class="error">'.$_SESSION['e_pass2'].'</div>';
          unset($_SESSION['e_pass2']);
      }
      ?>
    <button type="submit">prześlij</button>
  </form>

</div>
</body>
</html>