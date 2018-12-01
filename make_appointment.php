<?php

session_start();
$doctor=$_SESSION['doctor_for_appointment'];
$patient=$_SESSION['patient_for_appointment'];


$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname="assign6";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql="SELECT * FROM patient_doctor where patient_username='$patient' and doctor_username='$doctor' and valid=0";
$result3=$conn->query($sql);
if($result3->num_rows>0)
{

  while($row = $result3->fetch_assoc()) {
$date=$row['date'];
  $time=$row['time'];
    }
    echo('<script>alert("YOU HAVE ALREADY MADE AN APPOINTMENT FOR '.$date.' '.$time.'")</script>');
//header('Location:patient_doctor_same_city.php');
}
else{
$sql = "SELECT * FROM doctor where licence_no='$doctor'";
$result = $conn->query($sql);
$start='';
$end='';
 if ($result->num_rows > 0) {

     // output data of each row
 while($row = $result->fetch_assoc()) {
   $start=$row['startweek'];
   $end=$row['endweek'];
   $start1=$row['startweekend'];
   $end1=$row['endweekend'];

}}
 ?>

<html>
<head>
  <script type='text/javascript'>
  function fn()
  {

    var c= document.getElementById("date").value;
    alert(c);
  }

  </script>
</head>
<body>
<form method='POST'>
  SELECT DATE  <input type='date' id='date1' name='date1' required>

<br>
<br>
SELECT THE TIMINGS ON WEEKDAYS IN BETWEEN: <?php ECHO($start);echo("-");echo($end);?>
<br>
<br>SELECT THE TIMINGS ON WEEKENDS IN BETWEEN: <?php ECHO($start1);echo("-");echo($end1);?>

<br><input  name="myTime" type='time' required>
<br>
<button type='submit' name='submit'>Make Appointment
</button>
</form>
</body>
</html>
<?php

if(isset($_POST['submit']))
{
  $c=$_POST['myTime'];

  $str_arr = explode (":", $c);

$v1=$str_arr[0]*60+$str_arr[1];
$str_arr = explode (":", $start);

$v2=$str_arr[0]*60+$str_arr[1];
$str_arr = explode (":", $end);

$v3=$str_arr[0]*60+$str_arr[1];
$str_arr = explode (":", $start1);

$v4=$str_arr[0]*60+$str_arr[1];
$str_arr = explode (":", $end1);

$v5=$str_arr[0]*60+$str_arr[1];
if(($v1>$v2 && $v1<$v3)||($v1>$v4 &&$v1<$v5))
{
  $e=$_POST['date1'];
  $sql="INSERT INTO patient_doctor(patient_username,doctor_username,date,time,patient_email,doctor_email) VALUES('$patient','$doctor','$e','$c','guptashubham1798@gmail.com','jvjv@vjvcjn.com')";
  $result5=$conn->query($sql);
  echo "<script type='text/javascript'>alert('done');</script>";

}
else {
  echo("<script type='text/javascript'>alert('select correct time')</script>");
}

}}

 ?>
