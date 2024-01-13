<?php
    session_start();
    if(!isset($_SESSION['logged']))
    {
        header('location: index.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8"> <link rel="stylesheet" href="style.css">
  <title>strona główna</title>
</head> 
<body>

<p>Witamy na stronie przychodnia Gdańsk!</p>
<ol>
    <li><a href="wizyta.php">umówienie wizyty</a>
    </li>

    <li><a href="profil.php">profil</a></li>

    <li><a>opcje</a>
        <ul>
            <li><a href="profil_edit.php">edytuj profil</a></li>
            <li><a href="delete.php">usuń konto</a></li>
            <li><a href="wylogowanie.php">wyloguj</a></li>
        </ul>
    </li>
</ol>
</body>
</html>