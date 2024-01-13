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
    if(isset($_POST['pesel']))
    {
        $login = $_POST['login'];

        $pesel = $_POST['pesel'];

        $recover = "SELECT * FROM użytkownicy  INNER JOIN pacjenci ON użytkownicy.id_użytkownika = pacjenci.id_użytkownika WHERE login='$login' AND pesel='$pesel'";
        if ($ending = @$connectbase->query($recover))
        {
            $num_users = $ending->num_rows;
            if ($num_users > 0) {
                $_SESSION['clogin'] = $_POST['login'];
                $ending->free_result();
                header('Location:passrecover2.php');
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
    Podaj login:<input type="text" name="login" />
    <br/> 
    Podaj pesel<input type="text" name="pesel"/>
    <br/>
    <button type="submit">prześlij</button>
  </form>

</div>
</body>
</html>