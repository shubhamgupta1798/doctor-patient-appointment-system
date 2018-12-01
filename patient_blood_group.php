<?php
session_start();

$user=$_SESSION['user'];

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname="assign6";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM patient where name='$user'";
$result = $conn->query($sql);
$u='';
if ($result->num_rows > 0) {
     while($row = $result->fetch_assoc()) {
       $u=$row['blood_group'];
     }
}

$result->free();
if($u<>''){

  $query = mysqli_query($con,"INSERT INTO blogger(username,password,email,number1,name) values('$u','$p','$e','$mn','$n')") or die("ENTER OTHER USERNAME");
  echo('done');
}


 ?>
