
<?php
session_start();
{
  $servername = "127.0.0.1";
  $username = "root";
  $password = "";
  $dbname="assign6";
$city=$_SESSION['myinput'];

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $sql = "SELECT * FROM doctor where fname='$city'";
  $result = $conn->query($sql);

   if ($result->num_rows > 0) {

       // output data of each row
ECHO"<html><head><style>body{color:black;}</style><body><H2>DOCTOR INFORMATIONS</H2><BR><ul>";
       while($row = $result->fetch_assoc()) {
         ?>
         <form method='POST'>
         <div style='background-color:#f5dcf478;border:0.5px solid;border-radius:5px;color:#110f13;padding:10px;'>
         <?php
         if($row["blocked"]==0){
        ?>        <BUTTON STYLE='float:right;margin-right:30px;' value='<?php echo($row["licence_no"])?>' type='submit' name='this'>MAKE AN APPOINTMENT</button>
    <span style='padding-bottom:2px;padding-top:1px;'>   NAME:   <?php echo ($row["fname"]);
          ?>

          <?php echo($row["lname"]);?>
</span>
        <BR>
          <span style='padding-bottom:2px;padding-top:1px;'>
          SPECIALIZATION:
          <?php  echo($row['specialization'])?>
</span>
<br>

<span style='padding-bottom:2px;padding-top:1px;'>
          QUALIFICATION:
          <?php if($row["degree"]=='MBBS')
              echo("MBBS ");
              else if($row["degree"]=='MD')
              {
                echo("MBBS ");
                echo("MD ");
              }
              else if($row["degree"]=='DM')
                      {
                        echo("MBBS ");
                        echo("MD ");
                        echo("DM  ");}
          ?>
          </span>
          <BR>
            <span style='padding-bottom:2px;padding-top:1px;'>
            TIMINGS
            <BR>
              ON WEEKDAYS:
          <?php echo($row["startweek"]);?>-

          <?php echo($row["endweek"]);?>
<BR>
  ON WEENENDS:
          <?php echo($row["startweekend"]);?>-
            <?php echo($row["endweekend"]);?>
</span>

          <?php
       }
       ?>

       </div>
            </FORM>
       <br>
       <?php
     }
       echo"</ul>";





}
else {
  echo('no record');
}
}
if(isset($_POST['this']))
{
  $c=$_POST['this'];
  $_SESSION['doctor_for_appointment']=$c;
  $_SESSION['patient_for_appointment']=$_SESSION['user'];
  header('Location:make_appointment.php');
}

?>
