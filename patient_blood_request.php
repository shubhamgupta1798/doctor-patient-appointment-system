<html>
<head>
  <style>
  button.c7{





    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
    height:25px;
    width:130px;
    font-size: 12;


  }
  button.c7:hover{
    background-color:#1f441b;
    color:black;
    }
  </style>

<body>
  <form METHOD='POST'>
<center>  <h2 STYLE='padding-top:100px;'>  IF YOU WANT TO MAKE A BLOOD DONATION CLICK BELOW.</h2>
    <br>
    <button class='c7' type='submit' name='blood_req'>CREATE REQUEST</button>
</form>
</body>
</html>


<?php
if(isset($_POST["blood_req"]))
{
  session_start();
  //echo "<script type='text/javascript'>alert('done');</script>";

$u=$_SESSION['user'];
//echo "<script type='text/javascript'>alert('$u');</script>";
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname="assign6";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


$sql = "SELECT blood_group FROM patient where username='$u'";
$result = $conn->query($sql);

$sql = "SELECT blood_group FROM blood_request where patient_username='$u'";
$result2=$conn->query($sql);
if($result2->num_rows==0){
  //echo "<script type='text/javascript'>alert('done1');</script>";
   if ($result->num_rows > 0) {

//echo "<script type='text/javascript'>alert('done2');</script>";
 while($row = $result->fetch_assoc()) {
   $c=$row["blood_group"];
$sql="INSERT INTO blood_request(patient_username,blood_group) VALUES('$u','$c')";
$result1=$conn->query($sql);
echo "<script type='text/javascript'>alert('done');</script>";


 }}

}
else {

echo "<script type='text/javascript'>alert('YOU HAVE ALREADY MADE A DONATION');</script>";
}
//
}
 ?>
