
<?php
$v1=0;
{
  session_start();
  $servername = "127.0.0.1";
  $username = "root";
  $password = "";
  $dbname="assign6";
$user=$_SESSION['user'];
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $sql = "SELECT doctor_username FROM patient_doctor where patient_username='$user' and valid=0";
  $result = $conn->query($sql);

$v2=100;
   if ($result->num_rows > 0) {


ECHO"<html><head><style>body{}</style><script type='text/javascript'>
function fn(clicked_id){
    document.getElementById('fix').innerHTML = clicked_id;
    return;
}
</script>
<body><H2>PATIENT LIST</H2><BR><form method='POST'><Ol><input type='hidden'  name='fix' id='fix'><table>";
       while($row = $result->fetch_assoc()) {
         $v1=$v1+1;
         $v2=$v2+1;
         $c1=$row["doctor_username"];
         $sql2 = "SELECT fname,lname FROM doctor where licence_no='$c1'";
         $result2 = $conn->query($sql2);
         $name='';
         while($row2=$result2->fetch_assoc()){
           $name=$row2["fname"]." ".$row2["lname"];
         }
           echo "<tr><td><li><SPAN STYLE='margin-left:20px;'> " . $name.  " </td><td><input type='hidden' name=".$v2." value=".$row["doctor_username"]." id=".$v2."></td><td><button type='submit' style='background-color:red;color:white' name='id' value=".$v1.">DELETE APPOINTMENT</button></td></tr></span></li>";
       }
       echo"</Ol></FORM></body></html>";





}}

if(isset($_POST["id"]))
{


  $c1=$_POST["id"];
  $servername = "127.0.0.1";
  $username = "root";
  $password = "";
  $dbname="assign6";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $result->free();
  $sql = "SELECT doctor_username FROM patient_doctor where patient_username='$user' and valid=0";
  $result = $conn->query($sql);

//echo($c1);
   while ($row = $result->fetch_assoc()) {

     if($c1==1)
     {

       $d=$row["doctor_username"];
    echo($d);
       $sql = "delete from patient_doctor where  patient_username='$user' and doctor_username='$d'";
       $result1 = $conn->query($sql);


  header('Location:cancel_current_appointment.php');
     }
$c1=$c1-1;
   }
}

?>
