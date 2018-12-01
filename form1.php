
<html>
<form method='POST'>
  <select name="cars">
    <option value="volvo">Volvo</option>
    <option value="saab">Saab</option>
    <option value="fiat">Fiat</option>
    <option value="audi">Audi</option>
  </select>
  <br><br>
  <input type="submit" name='submit'>
</form>
</html>
<?php


if(isset($_POST['submit']))
{
  echo($_POST['cars']);


    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname="assign6";
  $city=$_POST['cars'];
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $sql = "INSERT INTO doctors(NAME) values('$city')";
    $result = $conn->query($sql);
}
?>
