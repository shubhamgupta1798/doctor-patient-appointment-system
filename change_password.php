<?php
  session_start();
  $error_curr = $error_new = $updated = "";
  if (!isset($_SESSION['user'])) {
    header('Location: login.php');
  }
  if (isset($_POST['submit'])) {
  	$curr = $_POST['curr'];
  	$curr_user = $_SESSION['user'];
  	$neww = $_POST['new'];
  	$conff = $_POST['confirm'];
  	include 'database_connection.php';
  	$sql = "SELECT pwd from doctor where licence_no = '$curr_user'";
  	$res = $conn->query($sql);
  	$result = $res->fetch_assoc();
  	$hasshh = $result['pwd'];
  	if ($conn->query($sql)) {
	  	if (!password_verify($curr, $hasshh)) {
	  		$error_curr = "Doesn't match with current Password";
  		}
  		elseif($neww != $conff) {
  			$error_new = "Password don't match<br>";
  		}
  		else{
			$pwdd = password_hash($neww, PASSWORD_DEFAULT);
			$sql = "UPDATE doctor set pwd = '$pwdd' where licence_no = '$curr_user' ";
			if ($conn->query($sql)) {
				$updated = "Updated Password Successfully!";
			}
			else{
				$updated = "Please try Again!";
			}
		}
  	}
  }
?>
 <!DOCTYPE html>
 <html>
 <head>
  <title>Accepted Donors</title>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<link rel="stylesheet" type="text/css" href="dashboard_style.css">
<style type="text/css">
	.error {
		color: #FF0000;
	}
</style>
<script type="text/javascript" src="dashboard_js.js"></script>
 </head>
<!------ Include the above in your HEAD tag ---------->
 <body>
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
					
					<div class="col-md-4">
    <h3 style="text-align: center;"><?php echo $updated; ?></h3>
						<div style="margin-top: 100px;"></div>
						<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
							<div class="form-group">
								<label for ="curr" style="font-weight: bolder; font-size: 125%;" >Current Password :</label>
								<input type="password" name="curr" class="form-control" placeholder="Enter your Current Password" required="">
							</div>
							<span class="error"><?php echo $error_curr; ?></span>
							<div class="form-group">
								<label for ="new_pass" style="font-weight: bolder; font-size: 125%;" >New Password :</label>
								<input type="password" name="new" class="form-control" minlength="6" placeholder="Enter your New Password" required="">
							</div>
							<div class="form-group">
								<label for ="conf" style="font-weight: bolder; font-size: 125%;" >Confirm Password :</label>
								<input type="password" name="confirm" class="form-control" placeholder="Confirm your Password" required="">
							</div>
							<span class="error"><?php echo $error_new; ?></span>
							<input type="submit" name="submit" class="btn btn-success btn-block" value = "SUBMIT">
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