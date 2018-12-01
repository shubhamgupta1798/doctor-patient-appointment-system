<?php
	session_start();
	session_destroy();
	session_start();
	$specializationError = $degreeError = $passwordMismatchError = $mobileLenError = $time1 = $time2 = $emailRegistered = "";
	$error = 0;
?>
<!DOCTYPE html>
<html>

	<head>
		<title>
			Registration Sign Up	
		</title>

		<meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

	    <style type="text/css">
			.bg {
				background-image: url("background.jpg");
				background-position: center;
				background-size: cover;
			}

			.submit{
				background-color: red;

			}
		    .error {
		    	color: #FF0000;
		    }

	    </style>

	</head>

	<body>
		<?php
			if (isset($_POST['submit'])) {
				$_SESSION['starttimeWeeks'] = $_POST['starttimeWeeks'];
				$_SESSION['endtimeWeeks'] = $_POST['endtimeWeeks'];
				$_SESSION['starttimeWeekend'] = $_POST['starttimeWeekend'];
				$_SESSION['endtimeWeekend'] = $_POST['endtimeWeekend'];

				$_SESSION['fname'] = $_POST['fname'];
				$_SESSION['lname'] = $_POST['lname'];
				$_SESSION['licence'] = $_POST['licence'];

				$_SESSION['eye'] = (isset($_POST['eye'])) ? 1 : 0;
				$_SESSION['heart'] = (isset($_POST['heart'])) ? 1 : 0;
				$_SESSION['bone'] = (isset($_POST['bone'])) ? 1 : 0;
				$_SESSION['kidney'] = (isset($_POST['kidney'])) ? 1 : 0;
				$_SESSION['liver'] = (isset($_POST['liver'])) ? 1 : 0;
				$_SESSION['blood'] = (isset($_POST['blood'])) ? 1 : 0;
				$_SESSION['brain'] = (isset($_POST['brain'])) ? 1 : 0;
				$_SESSION['other'] = (isset($_POST['other'])) ? 1 : 0;

				$_SESSION['degree'] = $_POST['degree'];

				$_SESSION['email'] = $_POST['email'];
				$_SESSION['pwd'] = $_POST['pwd'];
				$_SESSION['cpwd'] = $_POST['cpwd'];
				$_SESSION['mobile'] = $_POST['mobile'];
				$_SESSION['city'] = $_POST['city'];

				$error = 0;
				$specializationError = $degreeError = $passwordMismatchError = $mobileLenError =  $emailRegistered ="";

				if ($_SESSION['starttimeWeeks'] > $_SESSION['endtimeWeeks']) {
					$time1 = "* Error, start time can't be ahead of end time";
					$error++;
				}

				if ($_SESSION['starttimeWeekend'] > $_SESSION['endtimeWeekend']) {
					$time2 = "* Error, start time can't be ahead of end time";
					$error++;
				}

				if(!$_SESSION['eye'] &&
					!$_SESSION['heart'] &&
					!$_SESSION['bone'] &&
					!$_SESSION['kidney'] &&
					!$_SESSION['liver'] &&
					!$_SESSION['blood'] &&
					!$_SESSION['brain'] &&
					!$_SESSION['other'] ){
					$specializationError = "* Select atleast one of the checkbox";
					$error++;
				}

				if($_SESSION['degree'] == "select"){
					$degreeError = "* Select any of the given degree";
					$error++;
				}

				if($_SESSION['pwd'] != $_SESSION['cpwd']){
					$passwordMismatchError = "* Password don't match";
					$error++;
				}

				if (strlen($_SESSION['mobile']) != 10) {
					$mobileLenError = "* Enter a valid Mobile no.";
					$error++;
				}

				if($error == 0){
					include 'database_connection.php';
					include 'mailer_connection.php';

					$user_email = $_SESSION['email'];
					$user_pwd = $_SESSION['pwd'];

					$mail->addAddress($user_email);     // Add a recipient

					$random = rand(10000,99999);
					$_SESSION['random'] = $random;

					$mail->Subject = 'OTP for doctor registration';
					$mail->Body = 'Your OTP for email Verification is ' . $random;

					$sql = "SELECT * FROM DB_FOR_OTP where email = '$user_email'";//table name is DB_FOR_OTP
					$res = $conn->query($sql);
					$result = $res->fetch_assoc();
					if($res->num_rows > 0){
						if($result['confirmed'] == 1){
							$emailRegistered = "<br>EMAIL ID already registered :(";
							$error++;
							$conn->close();
							echo "<div style='margin-top:200px;'></div>";
							echo "<h4 style='color:#FF0000;text-align: center;'>$emailRegistered</h4>";
							echo "<a href='http://localhost/DoctorAppointment/register.php' style='text-align: center;display:block;font-size: 162.5%;'>Return back to Register Page</a>";
							exit();
						}
					}

					if(!$mail->send()) {
					    echo 'Message could not be sent.';
					    echo 'Mailer Error: ' . $mail->ErrorInfo;
					} else {
						// $query = mysql_query("INSERT INTO 'USERS' VALUES('','','') ")
						// throw error when the email is already registered else if email is there is random values, update the value of OTP.

						// update otp of curr user
						$sql = "SELECT * FROM DB_FOR_OTP where email = '$user_email'";//table name is DB_FOR_OTP
						$res = $conn->query($sql);
						echo $res->num_rows . "is number of rows"."<br>";
						if($res->num_rows > 0){
							$que = "UPDATE DB_FOR_OTP SET confirm_code = '$random' where email = '$user_email'";
							if ($conn->query($que) === TRUE) {
								echo "Updated OTP successfully!";
							}
							else{
								echo "Couldn't update OTP! Please try again";
								$conn->close();
								exit();
							}
						}

						else{
							echo "email := " . $user_email . "<br>" ;
							$sql = "INSERT INTO DB_FOR_OTP (email, confirm_code, confirmed) VALUES ('$user_email', '$random', 0)";
							if($conn->query($sql) === TRUE){
								echo "new record has been recorded!";
							}
							else{
								echo "error occured = ". $sql . "<br>" . $conn->error;
							}
							$conn->close();
						    echo 'Message has been sent';
						}
					}
					header('Location: sendEmail.php');
				}
			}
		?>
    <div class="bg">
		<div class="container">
			<div class="row">
				
				<div class="col-md-4">
						
					<div style="margin-top: 25px"></div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h3>Create Doctor Register ID</h3>
						</div>

						<div class="panel-body">
							<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">

								<div class="form-group">
									<label for ="fname" style="font-weight: bolder" >First Name :</label>
									<input type="text" name="fname" class="form-control" value="<?php echo $_SESSION['fname'] ?>" placeholder="Enter your First Name" required="">
								</div>

								<div class="form-group">
									<label for ="lname" style="font-weight: bolder" >Last Name :</label>
									<input type="text" name="lname" class="form-control" value="<?php echo $_SESSION['lname'] ?>" placeholder="Enter your Last Name" required="">
								</div>

								<div class="form-group">
									<label for ="licence" style="font-weight: bolder" >Unqiue Licence No. :</label>
									<input type="number" name="licence" class="form-control" value="<?php echo $_SESSION['licence'] ?>" placeholder="Enter your Licence No." required="">
								</div>

								<!-- Check boxes are here ;) -->
							<div class="form-group">
								<label for ="specialization" style="font-weight: bolder" >Specialization in :</label>
								<div class="form-check">
									<div class="checkbox">
										<label><input type="checkbox" name="eye" > Ophthalmologist </label>
									</div>
									<div class="checkbox">
										<label><input type="checkbox" name="heart"> Cardiologist </label>
									</div>
									<div class="checkbox">
										<label><input type="checkbox" name="bone"> Physician </label>
									</div>								
									<div class="checkbox">
										<label><input type="checkbox" name="kidney"> Nephrologist </label>
									</div>
									<div class="checkbox">
										<label><input type="checkbox" name="liver"> Hepatologist </label>
									</div>
									<div class="checkbox">
										<label><input type="checkbox" name="blood"> Vascularigist </label>
									</div>

									<div class="checkbox">
										<label><input type="checkbox" name="brain"> Neurologist </label>
									</div>

									<div class="checkbox">
										<label><input type="checkbox" name="other"> Other </label>
									</div>

								</div>
							</div>
							<span class="error"><?php echo $specializationError;?></span>
							<!-- checkboxes end here ;) -->

								<div class="form-group">
									<label for ="degree" style="font-weight: bolder" >Degree :</label>
									<select name="degree" class="form-control">
										<option value="select" name="SelectADegree">Select Degree</option>
										<option value="mbbs" name="mbbs">MBBS</option>
										<option value="md" name="md">MD</option>
										<option value="dm" name="dm">DM</option>
									</select>
									<span class="error"><?php echo $degreeError;?></span>
								</div>

								<div class="form-group">
									<label for ="email" style="font-weight: bolder" >Email ID :</label>
									<input type="email" name="email" class="form-control" value="<?php echo $_SESSION['email'] ?> " placeholder="Enter your Email ID" required="">
									<span class="error"><?php echo $emailRegistered;?></span>
								</div>

								<div class="form-group">
									<label for ="pwd" style="font-weight: bolder" >Password :</label>
									<input type="password" name="pwd" class="form-control" value="<?php echo $_SESSION['pwd'] ?> " placeholder="Enter Password" required="">
								</div>

								<div class="form-group">
									<label for ="cpwd" style="font-weight: bolder" >Confirm Password :</label>
									<input type="password" name="cpwd" class="form-control" value="<?php echo $_SESSION['cpwd'] ?> " placeholder="Confirm Password" required="">
									<span class="error"><?php echo $passwordMismatchError;?></span>
								</div>

								<div class="form-group">
									<label for ="mobile" style="font-weight: bolder" >Mobile No. :</label>
									<input type="text" name="mobile" maxlength="10" pattern="[6789][0-9]{9}" class="form-control" value="<?php echo $_SESSION['mobile'] ?>" placeholder="Enter your Mobile No." required="">
									<span class="error"><?php echo $mobileLenError;?></span>
								</div>

								<div class="form-group">
									<label for ="city" style="font-weight: bolder" >City :</label>
									<input type="text" name="city" class="form-control" value="<?php echo $_SESSION['city'] ?> " placeholder="Enter your current City" required="">
								</div>

								<div>
									<p style="font-weight: bolder" >Week Days Timing</p>
									<div class="form-group">
										<label for ="starttime">Start Time :</label><br>
										<input type="time" name="starttimeWeeks" step="1" value="<?php echo $_SESSION['starttimeWeeks']?>" class="form-control" required="">
									</div>

									<div class="form-group">
										<label for ="endtime">End Time :</label><br>
										<input type="time" name="endtimeWeeks" step="1" value="<?php echo $_SESSION['endtimeWeeks']?>" class="form-control" required="">
									</div>
									<span class="error"><?php echo $time1;?></span>
								</div>

								<div>
									<p style="font-weight: bolder" >Weekends Timing</p>
									<div class="form-group">
										<label for ="starttime">Start Time :</label><br>
										<input type="time" name="starttimeWeekend" step="1" value="<?php echo $_SESSION['starttimeWeekend']?>" class="form-control" required="">
									</div>

									<div class="form-group">
										<label for ="endtime">End Time :</label><br>
										<input type="time" name="endtimeWeekend" step="1" value="<?php echo $_SESSION['endtimeWeekend']?>" class="form-control" required="">
									</div>
									<span class="error"><?php echo $time2;?></span>
								</div>

								<input type="submit" name="submit" class="btn btn-success btn-block" value = "SUBMIT">
								<span class="error" style="margin-left: 100px;">
									<?php
										if ($error > 0) {
											echo "total error = " . $error;
										}
									?>
								</span>
								<div style="margin-bottom: 50px"></div>
							</form>
						</div>

					</div>

				</div>

			</div>
	
		</div> <!-- ending container  -->
	</div><!-- ending bg -->

	</body>
</html>