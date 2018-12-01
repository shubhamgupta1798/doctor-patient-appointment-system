<?php
   session_start();
   $errors = 0;
   $error = "";
   if (isset($_SESSION['user'])) {
      header('Location: home.php');
   }

   if (isset($_POST['submit'])) {
      $user = $_POST['licence'];
      $pwd = ($_POST['pwd']);
      include 'database_connection.php';
      $sql = "SELECT * FROM `doctor` where `licence_no` = '$user' ";//table name is DB_FOR_OTP
      $res = $conn->query($sql);
      $result = $res->fetch_assoc();
      if ($res->num_rows == 1) {
         if (password_verify($pwd, $result['pwd'])) {
            $_SESSION['user'] = $user;
            header('Location: home.php');
         }
         else{
            $error =  "Invalid Licence No. / Password";
            $errors++;           
         }
      }
      else{
         $error =  "Invalid Licence No. or Password";
         $errors++;
      }
   }
?>
<!DOCTYPE html>
<html>
<head>
   <title>
      Log In
   </title>
   <link rel="stylesheet" type="text/css" href="style.css">
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <style>
         body{
            background-image: url("doctor_patient2.jpg");
            background-position: center;
            background-size: cover;
         }
          .error {
            color: #FF0000;
          }
    </style>
</head>
   <body>
      <div style="margin-top: 150px;"></div>
      <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
         <h3 style="text-align: center;color: #0048ff; font-weight: 900; text-decoration: underline;">LOGIN HERE</h3>
         <div class="login">
            <input type="number" name="licence" class="form-control" value="<?php echo (isset($_SESSION['licence']) ? $_SESSION['licence'] : ''); ?>" placeholder="Enter your Licence No." required="">
            <input type="password" name="pwd" placeholder="password" id="password" class="form-control" required="">  
            <!-- <a href="#" class="forgot">forgot password?</a> -->
            <span class="error" style="margin-left: 35px;"><?php echo $error;?></span>
            <input type="submit" name="submit" class="btn btn-success btn-block" style="width: 250px;" value="Sign In"><br>
            <h6 style="text-align: center;"><a href="register.php" style="color: #50505e; text-decoration: none;">Still not registered ?</a></h6>
         </div>
      </form>
      <div class="shadow"></div>
   </body>
</html>