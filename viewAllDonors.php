<?php
  session_start();
  if (!isset($_SESSION['admin'])) {
    header('Location: user.php');
  }
?>
 <!DOCTYPE html>
 <html>
 <head>
  <title>Cancelled Appointments</title>
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
      font-size: 100%;
  }

  td, th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
      text-align: center;
      font-size: 100%;
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
    <!-- <div id="wrapper"> -->
        <!-- <div class="overlay"></div> -->
        <!-- /#sidebar-wrapper -->
        <!-- Page Content -->
        <!-- <div id="page-content-wrapper"> -->
            <!-- <button type="button" class="hamburger is-closed" data-toggle="offcanvas"> -->
                <!-- <span class="hamb-top"></span> -->
          <!-- <span class="hamb-middle"></span> -->
        <!-- <span class="hamb-bottom"></span> -->
            <!-- </button> -->
            <div style="margin-top: 120px"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <h1 style="text-align: center;">View All Donors</h1><br>
                        <form method="POST">
                          <?php
                              include 'database_connection.php';
                              // $user_name = $_SESSION['user'];
                              $sql = "SELECT * from blood_request where accepted = 1"; //it has been approved by the doctor in the past. Now the action needs to be taken
                              $result = $conn->query($sql);
                              if ($result->num_rows == 0) {
                                echo "<h3 style='color:red; text-align:center;'>No Records Found !</h3>";
                              }
                              else{
                                echo "<table style='width:100%'>";
                                echo "<tr>";
                                echo "<th>Patient Username</th><th>Blood Group</th>";
                                echo "</tr>";
                                while($row = $result->fetch_assoc()){
                                  echo "<tr>";
                                  $user_name = $row['patient_username'];
                                  $date = $row['blood_group'];
                                  echo "<td>$user_name</td><td>$date</td>";
                                  echo "</tr>";
                                }
                              }
                          ?>
                      </form>
                    </div>
                </div>
            </div>
        <!-- </div> -->
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
 </body>
 </html>
