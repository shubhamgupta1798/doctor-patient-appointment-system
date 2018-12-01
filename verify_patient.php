<html>
<head>
  <link rel="stylesheet" href="stylesheet.css">
  <STYLE>
  button.c2{
    height:30px;
    width:100px;
    border-radius: 5px;
    border-style:ridge;
    margin-left: 10px;

    margin-top: 5px;

  }
  button.c7{

    background-color: green;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
    height:42px;
  	width:90px;
    font-size: 12;


  }
  input.c5{
    width:30%;

  margin-left: 20px;
       border-radius: 5px;
      outline:0;
      line-height:25px;
  }
  button.c7:hover{
  	background-color:#1f441b;
  	color:black;
  	}
  </STYLE>
</head>
<body>
<CENTER>  <DIV STYLE="margin-top:20%;border:0.5px solid;width:40%; padding-top:20px;">
  <form method="post">
  <span style="margin-top:30px;">
    ENTER OTP </span><input class="c5" placeholder="Enter OTP" type="number" name="otp1" id="otp1">
    <br>
    <br>
    <button class="c7" type="submit"  name="submit">SUBMIT</button>
</form>
<DIV>
</CENTER>
</html>
<?php
session_start();
if(isset($_POST['submit'])){
$v1=$_SESSION["otp"];
$v2=$_POST["otp1"];
if($v1==$v2)
{
$u=  $_SESSION["user"];
$n=  $_SESSION["n"];
$p=  $_SESSION["p"];
$e=  $_SESSION["e"];
$mn=  $_SESSION["mn"];
$city=  $_SESSION["city"];
$b=  $_SESSION["blood_group"];

$con=mysqli_connect("localhost","root","") or die("can't connect");
if(!mysqli_select_db($con,"assign6")){
  mysqli_query($con,"CREATE DATABASE assign6");

}
$query = mysqli_query($con,"INSERT INTO patient(username,password,email,number1,name,city,blood_group) values('$u','$p','$e','$mn','$n','$city','$b')") or die("ENTER OTHER USERNAME");
$_SESSION["username_signedin"]=$u;
header('Location:patient.php');

}
else{
  echo("ENTER CORRECT OTP");
}
}
