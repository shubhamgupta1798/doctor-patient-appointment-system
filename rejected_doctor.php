
<?php
$v1=0;
{
  $servername = "127.0.0.1";
  $username = "root";
  $password = "";
  $dbname="assign6";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $sql = "SELECT licence_no FROM doctor where blocked=-1";
  $result = $conn->query($sql);

$v2=100;
   if ($result->num_rows > 0) {


ECHO"<html><head><style>body{}</style><script type='text/javascript'>
function fn(clicked_id){
    document.getElementById('fix').innerHTML = clicked_id;
    return;
}
</script>
<body><H2>REJECTED DOCTORS</H2><BR><form method='POST'><Ol><input type='hidden'  name='fix' id='fix'><table>";
       while($row = $result->fetch_assoc()) {
         $v1=$v1+1;
         $v2=$v2+1;

           echo "<tr><td><li><SPAN STYLE='margin-left:20px;'> " . $row["licence_no"].  " </td><td><input type='hidden' name=".$v2." value=".$row["licence_no"]." id=".$v2."></td><td><button type='submit' style='background-color:green;color:white' name='id' value=".$v1.">APPROVE</button></td></tr></span></li>";
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
  $sql = "SELECT licence_no FROM doctor where blocked=-1";
  $result = $conn->query($sql);


   while ($row = $result->fetch_assoc()) {
     if($c1==1)
     {

       $d=$row["licence_no"];
       echo($d);
       $sql = "UPDATE doctor SET blocked='0' WHERE licence_no='$d'";
       $result1 = $conn->query($sql);
       echo($result1);

  header('Location:rejected_doctor.php');
     }
$c1=$c1-1;
   }
}

?>
