<?php
    session_start();

    if(isset($_POST['time']))
    {
        $goodform=true;

        require_once "łączeniedobazy.php";

        $connectbase = @new mysqli($host, $db_user, $db_password, $db_name);

        if($connectbase->connect_errno!=0)
        {
            echo "Error:".$connectbase->connect_errno;
        }
        else
        {
            if ($goodform==true)
            {
                $id_user=$_SESSION['id_użytkownika'];
                $date = $_POST['date'];
                $time = $_POST['time'];
                $ddoctor = $_POST['nazwisko'];
                $id=$connectbase->query("SELECT id_lekarza FROM lekarze WHERE nazwisko='$ddoctor'");
                $row = $id->fetch_assoc();
                if($connectbase->query("INSERT INTO wizyty (data,id_lekarza,id_pacjenta,godzina) VALUES ('{$date}',{$row['id_lekarza']},'{$id_user}','{$time}')"));
                {
                    $_SESSION['success']=true;
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
  <title>umówienie wizyty</title>
</head>
<body>
  <form method="post">
    Data:<br/><input type="date" name="date" /><br/>

      <p>
          <label for="doctor">
              <span>lekarz:</span>
          </label> <br>
          <select id="doctor" name="lekarz">
              <option value="default">Wybierz specjalizacje:</option>
              <option value="laryngolog">laryngolog</option>
              <option value="okulista">okulista</option>
              <option value="lekarz_rodzinny">lekarz rodzinny</option>
              <option value="pediatra">pediatra</option>
          </select>

      </p>
      <div id="laryngolodzy" style="display:none">
              <input type="radio" value='Olipski' name="nazwisko">Paweł Olipski</input>
              <input type="radio" value='Grechuta' name="nazwisko">Marek Grechuta</input>
              <input type="radio" value='Zamiejski' name="nazwisko">Grzegorz Zamiejski</input>
      </div>
      <div id="okuliści" style="display:none">
          <select id="k_doctor" name="lekarz">
              <input type="radio" value='Pawulon' name="nazwisko">David Pawulon</input>
              <input type="radio" value='Świerczyński' name="nazwisko">Wiktor Świerczyński</input>
              <input type="radio" value='Iksdecki' name="nazwisko">Marcin Iksdecki</input>
          </select>
      </div>
      <div id="lekarze_rodzinni" style="display:none">
          <select id="k_doctor" name="lekarz">
              <input type="radio" value='Molecki' name="nazwisko">Damian Molecki</input>
              <input type="radio" value='Kobieta' name="nazwisko">Marta Kobieta</input>
              <input type="radio" value='Splatter'  name="nazwisko">Oliwia Splatter</input>
          </select>
      </div>
      <div id="pediatrzy" style="display:none">
          <select id="k_doctor" name="lekarz">
              <option name="Ołęcka">Kasia Ołęcka</option>
              <option name="Pieczarek">Marek Pieczarek</option>
              <option name="Morawicki">Mateusz Morawicki</option>
          </select>
      </div>

    Godzina:<br/><input type="time" name="time"><br/>


    <button type="submit">Umów wizytę!</button><br/>
  </form>
  <button onclick="location.href='wróć.php'" type="button">wróć</button><br/>
</body>
</html>
<script src="wizyta-skrypt.js"></script>