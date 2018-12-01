<?php
  session_start();
  $updated = "";
  if (!isset($_SESSION['user'])) {
    header('Location: login.php');
  }
  if (isset($_POST['submit0'])) {
    $vals = $_POST['submit0'];//approves user
    include 'database_connection.php';
    $que = "UPDATE patient_doctor SET valid = 1 where patient_username = '$vals'";
    if ($conn->query($que) == TRUE) {
      $updated = "Updated Successfully!";
    }
    else{
      echo "Couldn't make any changes!";
    }
  }
  elseif (isset($_POST['submit1'])) {
    $vals = $_POST['submit1'];//approves user
    include 'database_connection.php';
    $que = "UPDATE patient_doctor SET valid = -1 where patient_username = '$vals'";
    if ($conn->query($que) == TRUE) {
      $updated = "Updated Successfully!";
    }
    else{
      echo "Couldn't make any changes!";
    }
  }
?>
 <!DOCTYPE html>
 <html>
 <head>
  <title>New Appointments</title>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="dashboard_style.css">
<style type="text/css">
  table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
      text-align: center;
      font-size: 125%;
  }

  td, th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
      text-align: center;
      font-size: 125%;
  }

  tr:nth-child(even) {
      background-color: #dddddd;
  }

  th{
      background-color: black;
      color: white;
  }
</style>
<script type="text/javascript" src="dashboard_js.js"></script>

 </head>
<!------ Include the above in your HEAD tag ---------->
 <body>
    <h3 style="text-align: center;"><?php echo $updated; ?></h3>
    <div id="wrapper">
        <div class="overlay"></div>
    
        <!-- Sidebar -->
        <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
            <ul class="nav sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                       Welcome!
                    </a>
                </li>
                <li>
                    <a href="home.php">Home</a>
                </li>
                <li>
                    <a href="about.php">New Appointmnets</a>
                </li>
                <li>
                    <a href="appointments_action.php">My Appointments</a>
                </li>
                <li>
                    <a href="completed_appointments.php">Completed Appointments</a>
                </li>
                <li>
                    <a href="cancelled_appointments.php">Cancelled Appointments</a>
                </li>
                <li>
                    <a href="approve_rejeceted_appointment.php">Approve Rejeceted Appointments</a>
                </li>
                <li>
                    <a href="all_donors.php">All Donors</a>
                </li>
                <li>
                    <a href="accepted_donors.php">Accepted Donors</a>
                </li>
                <li>
                    <a href="change_password.php">Change Password</a>
                </li>
                <li>
                    <a href="logout.php">Log Out</a>
                </li>
            </ul>
        </nav>
        <!-- /#sidebar-wrapper -->
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <button type="button" class="hamburger is-closed" data-toggle="offcanvas">
                <span class="hamb-top"></span>
          <span class="hamb-middle"></span>
        <span class="hamb-bottom"></span>
            </button>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <h1 style="text-align: center;">New Appointments</h1><br>
                        <form method="POST">
                          <?php
                              include 'database_connection.php';
                              $user_name = $_SESSION['user'];
                              $sql = "SELECT * from patient_doctor where doctor_username = '$user_name' and valid = 0 "; 
                              $result = $conn->query($sql);
                              if ($result->num_rows == 0) {
                                echo "<h3 style='color:red; text-align:center;'>No Records Found !</h3>";
                              }
                              else{
                                echo "<table style='width:125%'>";
                                echo "<tr>";
                                echo "<th>Patient Username</th><th>Patient Email-ID</th><th>Date of Appointment</th><th>Time of Appointment</th><th>Approve</th><th>Reject</th>";
                                echo "</tr>";
                                while($row = $result->fetch_assoc()){
                                  echo "<tr>";
                                  $user_name = $row['patient_username'];
                                  $date = $row['date'];
                                  $time = $row['time'];
                                  $email = $row['patient_email'];
                                  echo "<td>$user_name</td><td>$email</td><td>$date</td><td>$time</td>";
                                  echo "<td>";
                                  echo "<button name='submit0' type='submit' value='$user_name'>Approve</button>";
                                  echo "</td>";
                                  echo "<td>";
                                  echo "<button name='submit1' type='submit' value='$user_name'>Reject</button>";
                                  echo "</td>";
                                  echo "</tr>";
                                }
                              }
                          ?>
                      </form>                 
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
 </body>
 </html>

 <!--                         <p>Bacon ipsum dolor sit amet tri-tip shoulder tenderloin shankle. Bresaola tail pancetta ball tip doner meatloaf corned beef. Kevin pastrami tri-tip prosciutto ham hock pork belly bacon pork loin salami pork chop shank corned beef tenderloin meatball cow. Pork bresaola meatloaf tongue, landjaeger tail andouille strip steak tenderloin sausage chicken tri-tip. Pastrami tri-tip kielbasa sausage porchetta pig sirloin boudin rump meatball andouille chuck tenderloin biltong shank </p>
                        <p>Pig meatloaf bresaola, spare ribs venison short loin rump pork loin drumstick jowl meatball brisket. Landjaeger chicken fatback pork loin doner sirloin cow short ribs hamburger shoulder salami pastrami. Pork swine beef ribs t-bone flank filet mignon, ground round tongue. Tri-tip cow turducken shank beef shoulder bresaola tongue flank leberkas ball tip.</p>
                        <p>Filet mignon brisket pancetta fatback short ribs short loin prosciutto jowl turducken biltong kevin pork chop pork beef ribs bresaola. Tongue beef ribs pastrami boudin. Chicken bresaola kielbasa strip steak biltong. Corned beef pork loin cow pig short ribs boudin bacon pork belly chicken andouille. Filet mignon flank turkey tongue. Turkey ball tip kielbasa pastrami flank tri-tip t-bone kevin landjaeger capicola tail fatback pork loin beef jerky.</p>
                        <p>Chicken ham hock shankle, strip steak ground round meatball pork belly jowl pancetta sausage spare ribs. Pork loin cow salami pork belly. Tri-tip pork loin sausage jerky prosciutto t-bone bresaola frankfurter sirloin pork chop ribeye corned beef chuck. Short loin hamburger tenderloin, landjaeger venison porchetta strip steak turducken pancetta beef cow leberkas sausage beef ribs. Shoulder ham jerky kielbasa. Pig doner short loin pork chop. Short ribs frankfurter rump meatloaf.</p>
                        <p>Filet mignon biltong chuck pork belly, corned beef ground round ribeye short loin rump swine. Hamburger drumstick turkey, shank rump biltong pork loin jowl sausage chicken. Rump pork belly fatback ball tip swine doner pig. Salami jerky cow, boudin pork chop sausage tongue andouille turkey.</p>      -->   