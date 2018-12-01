
<?php

{
  $servername = "127.0.0.1";
  $username = "root";
  $password = "";
  $dbname="assign6";
$city=$_SESSION['city'];
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $sql = "SELECT name FROM doctors where city='$city'";
  $result = $conn->query($sql);

   if ($result->num_rows > 0) {
       // output data of each row
ECHO"<html><head><style>body{color:#e5e5e5;}</style><body><H2>BLOGGERS NAMES</H2><BR><ul>";
       while($row = $result->fetch_assoc()) {
           echo "<li><SPAN STYLE='margin-left:20px;'> " . $row["name"].  " </span></li><br>";
       }
       echo"</ul>";





}}

?>
