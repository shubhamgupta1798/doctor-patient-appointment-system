<!DOCTYPE html>
<html>
<head>
	<title>
		Email Verification
	</title>

	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <style>
		.error {
			color: #FF0000;
		}
    </style>
</head>
<body>
	<?php
		session_start();
		$msg = "";
		// echo "asli value = " . $asli_value_kya_hai . " usne kya enter kiya = " . $usne_kya_enter_kiya ;
		if (isset($_POST['otpenter'])) {
			$comparision = $_SESSION['email'];
			$usne_kya_enter_kiya = $_POST['otp'];

			$servername = "localhost";
			$username = "root";
			$password = "";

			$dbname = 'assign6';
			$conn = new mysqli($servername, $username, $password, $dbname);

			if($conn->connect_error){
				die("Connection failed, try again :" . $conn->connect_error);
			}

			$sql = "SELECT * from DB_FOR_OTP where email = '$comparision' ";
			$res = $conn->query($sql);
			$result = $res->fetch_assoc();
			$asli_value_kya_hai = $result["confirm_code"];

			if($asli_value_kya_hai == $usne_kya_enter_kiya){
				// ageka dekhna baaki hai!
				$degree = $_SESSION['degree'];

				$licence = $_SESSION['licence'];
				$fname = $_SESSION['fname'];
				$lname = $_SESSION['lname'];
				$specialization = $_SESSION['specialization'];
				$email = $_SESSION['email'];
				$pwd = password_hash($_SESSION['pwd'], PASSWORD_DEFAULT);
				$mobile = $_SESSION['mobile'];
				$city = $_SESSION['city'];
				$starttimeWeeks = $_SESSION['starttimeWeeks'];
				$endtimeWeeks = $_SESSION['endtimeWeeks'];
				$starttimeWeekend = $_SESSION['starttimeWeekend'];
				$endtimeWeekend = $_SESSION['endtimeWeekend'];

				$query = "
				INSERT into `doctor` (`licence_no`, `fname`, `lname`, `specialization`, `degree`, `email`, `pwd`, `mobile`, `city`, `startweek`, `endweek`, `startweekend`, `endweekend`, `blocked`, `rating`)
				values
				('$licence', '$fname', '$lname', '$specialization', '$degree', '$email', '$pwd', '$mobile', '$city', '$starttimeWeeks', '$endtimeWeeks', '$starttimeWeekend', '$endtimeWeekend', 1, 5)";

				if($conn->query($query) === TRUE){
					echo "new record has been recorded!";
					// set confirmed to 1
					$que = "UPDATE DB_FOR_OTP SET confirmed = 1 where email = '$comparision' ";
					if ($conn->query($que) === TRUE) {
						echo "Updated confirmed successfully!";
					}
					header('Location: registered.php');
				}
				else{
					echo "Couldn't make any changes! Please try again<br>" ;
					echo "error occured = ". $query . "<br>" . $conn->error;
				}
				$conn->close();
			}

			else{
				$msg = "Please Enter a Valid OTP";
			}
		}
	?>
	<form method="POST">
		<div class="container">
			<div style="margin-top: 200px"></div>

			<div class="row" style="margin-left: 200px">
				<div class="panel">
					<div class="panel-heading">
						<h3>Enter the OTP sent to <?php echo $_SESSION['email']; ?> </h3>
					</div>
					<div class="error" style="text-align: center;">
						<?php
							echo $msg . "<br>";
						?>
					</div>
					<div class="panel-heading form-group">
						<input type="text" name="otp" style="text-align: center;" class="form-control" placeholder="Enter OTP here!">
					</div>
				</div>
			</div>
			<div class="row">
				<input type="submit" style="margin-left: 475px" name="otpenter" class="btn btn-success" value = "SUBMIT">
			</div>
		</div>
	</form>
</body>
</html>
