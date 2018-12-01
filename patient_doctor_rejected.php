
<?php
session_start();
{
  $servername = "127.0.0.1";
  $username = "root";
  $password = "";
  $dbname="assign6";
$u=$_SESSION['user'];

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $e=-1;
  $sql = "SELECT * FROM patient_doctor where patient_username='$u' and valid='$e'";
  $result = $conn->query($sql);

   if ($result->num_rows > 0) {

       // output data of each row
ECHO"<html><head><style>body{color:black;}
th{
  border:0.5px solid;
  padding:10px;
}
tr{
  border:0.5px solid;
  padding:10px;
}
table{
  background-color:#e8bebe8f;
  border:0.5px solid;

}
table,tr,th{
  border-collapse:collapse;
}

</style><body><H2>APPOINTMENT REJECTED BY DOCTOR</H2><BR><ul>";
?>
<TABLE style=''>
  <tr>
    <th>
      Doctor Name
    </th>
    <th>
      licence_no
    </th>
    <th>
      Date </th>
      <th>
        Time </th>
  </tr>

<?php
       while($row = $result->fetch_assoc()) {

        ?>
        <TR>
          <TH>
      <?php
      $m1=$row['doctor_username'];
      $sql="select * from doctor where licence_no='$m1'";
      $result2=$conn->query($sql);
      $doctor='';
      if($result2->num_rows>0)
      {
        while($row1=$result2->fetch_assoc())
        {
          $doctor=$row1['fname'];
          $doctor=$doctor.' ';
          $doctor=$doctor.$row1['lname'];
          $doctor=$doctor.' ';
        }
      }
      ?>
    <button style='background-color:transparent;'>  <?php
      echo($doctor);
      ?></button>
    </th>
      <th>
        <?php
      echo($row['doctor_username'])?>
    </th>
    <th>
      <?php echo($row['date'])?>
    </th>

    <th>
      <?php echo($row['time'])?>
    </th>

</TR>
         <?php

       }
       ?>
</TABLE>

       <?php
     }






}




?>
