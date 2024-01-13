<?php
$connectbase = @new mysqli($host, $db_user, $db_password, $db_name);

if($connectbase->connect_errno!=0)
{
    echo "Error:".$connectbase->connect_errno;
}
else
  $id_user = $_SESSION['id_użytkownika'];
{
    $remove1="DELETE FROM wizyty WHERE id_pacjenta='$id_user'";
    $remove2="DELETE FROM pacjenci WHERE id_użytkownika='$id_user'";
    $remove3="DELETE FROM użytkownicy WHERE id_użytkownika='$id_user'";
    header('Location: index.php');
}
?>
