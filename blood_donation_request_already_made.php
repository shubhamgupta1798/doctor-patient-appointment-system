<?php
session_start();
$u=$_SESSION['user'];
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
$sql = "SELECT * FROM blood_request where patient_username='$u'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    // output data of each row
  while($row = $result->fetch_assoc()) {
    if($row['doctor_username']=='')
    {
?>      <CENTER><h2 STYLE='padding-top:100px;'>YOU HAVE ALREADY MADE BLOOD DONATION REQUEST</H2>
<?php
    }
    else{
    ?>  <CENTER><h2 STYLE='padding-top:100px;'>YOU REQUEST HAS ALREADY BEEN ACCEPTED BY <?php echo($row['doctor_username']);?></H2>
<?
    }
}}


 ?>
