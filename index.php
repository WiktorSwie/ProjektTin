<?php
    session_start();
    if((isset($_SESSION['logged'])) && ($_SESSION['logged']==true))
    {
        header('location:główna.php');
        exit();
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
  <form action="logowanie.php" method="post">
    Login:<input type="text" name="login" /> 
    <br/> 
    Hasło:<input type="password" name="hasło"/> 
    <br/>
    <button type="submit">zaloguj</button>
  </form>
    <?php
    if(isset($_SESSION['error']))
        echo $_SESSION['error'];
    ?>
    <a href="register.php"> Zarejestruj się</a> <br>
    <a href="passrecover.php"> odzyskaj hasło!</a>

</div>
</body>
</html>
