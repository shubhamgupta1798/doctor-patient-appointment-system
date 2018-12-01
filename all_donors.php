<?php
  session_start();
  $updated = "";
  if (!isset($_SESSION['user'])) {
    header('Location: login.php');
  }
  if (isset($_POST['submit0'])) {
    $vals = $_POST['submit0'];//approves user
    include 'database_connection.php';
    $que = "UPDATE blood_request SET accepted = 1 where patient_username = '$vals'";
    if ($conn->query($que) == TRUE) {
      $updated = "Updated Successfully!";
    }
    $curr = $_SESSION['user'];
    $que = "UPDATE blood_request SET doctor_username = '$curr' where patient_username = '$vals'";
    if ($conn->query($que) == TRUE) {
      $updated = "Updated Successfully";
    }
  }
?>
 <!DOCTYPE html>
 <html>
 <head>
  <title>All Donors</title>
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
                        <h1 style="text-align: center;">All donors</h1><br>
                        <form method="POST">
                          <?php
                              include 'database_connection.php';
                              $user_name = $_SESSION['user'];
                              $sql = "SELECT * from blood_request where accepted = 0";
                              $result = $conn->query($sql);
                              if ($result->num_rows == 0) {
                                echo "<h3 style='color:red; text-align:center;'>No Records Found !</h3>";
                              }
                              else{
                                echo "<table style='width:125%'>";
                                echo "<tr>";
                                echo "<th>Patient Username</th><th>Patient Blood-Group</th><th>Approve</th>";
                                echo "</tr>";
                                while($row = $result->fetch_assoc()){
                                  echo "<tr>";
                                  $user_name = $row['patient_username'];
                                  $blood_group = $row['blood_group'];
                                  echo "<td>$user_name</td><td>$blood_group</td>";
                                  echo "<td>";
                                  echo "<button name='submit0' type='submit' value='$user_name'>Approve</button>";
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