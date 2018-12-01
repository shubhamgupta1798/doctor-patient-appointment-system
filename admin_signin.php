
<html>

<head>
 <link rel="stylesheet" href="stylesheet.css">
  <style>
  input.c5{
    width:30%;

    margin-left: 20px;
       border-radius: 5px;
      outline:0;
      line-height:25px;
  }
  div.c1{
    border-style: ridge;
     border-radius: 5px;

     line-height:30px;
  }
  textarea{
    width:80%;
    float:right;
    border-style: inset;
    border-width: medium;

       border-radius: 5px;
      outline:0;
  }
  div.c2{
    padding-left: 10px;
  }
  input.c6{
      width:25%;
      float:right;
      margin-right:50%;
      border-radius: 5px;
     outline:0;
     line-height:25px;

  }

  div.heading1{
  width:100%;
  text-align:center;

  padding-top: 15px;
  line-height:wrapText;

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

  a.c2 {
    background-color: red;
    color: white;
    padding: 14px 20px;
    font-size: 12;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
    height:30px;
    width:120px;

    text-decoration: none;
}


  button.c7:hover{
  	background-color:#1f441b;
  	color:black;
  	}
    a.c2:hover{
      background-color:#581818;
      color:black;
      }
      img.c3{
        height:100px;
        width:100px;
      }
  div.heading{
  width:100%;
  padding-left: 20px;
  line-height:wrapText;
   background-color:#abb7cc;
  }
  div.heading2{
  width:100%;

  line-height:wrapText;
   background-color:#abb7cc;
   text-align:right;
  }
  div.part1{
    width:17%;
    height:50%;
    float:left;

  }
  div.part2{
    width:75%;
    float:right;
    height:50%;

  }
  div.part3{
    width:100%;
    height:20%;

    position: fixed;

  bottom: 0;

  }
  div.c3 {
    border-style: groove;
    width: 70%;
    color: #080808;
    background-color: #4b84a75e;
    background-size: 100%;
}
body{
    background-image: url("images/8.jpg");
    background-repeat: no-repeat;
   background-size: 100%;
}

  div.c3{
  border-style: groove;
  width: 70%;

 background-size: 100%;

  }
  </style>
  <script type="text/javascript">
  function setURL(url){

    window.location.href=(url);
  }
  </script>
</head>
<body>
  <div class="heading1" STYLE="color: #080808;"><h1>ADMIN SIGNIN</h1></div>

  <br>
  <br>


  <form method="POST">

      <div>
        <center>
        <div class="c3" >
          <br>
          USERNAME: <input class="c5" placeholder="Enter Username" type="text" name="uname" id="uid">
          <br>
          <br>
          PASSWORD: <input class="c5" placeholder="Enter Password" type="password" name="pass" id="pass">
          <br>
          <br>
          <a href="user.php" class="c2">BACK</a>
          <button class="c7" type="submit" name="submit">SUBMIT</button>


<br>
<br>
  </DIV>


</center>

</div>
</form>

</body>
</html>
<?php
session_start();
if(isset($_POST['submit'])){
$con=mysqli_connect("localhost","root","") or die("can't connect");
if(!mysqli_select_db($con,"assign6")){
  mysqli_query($con,"CREATE DATABASE assign6");
  mysqli_select_db($con,"assign6");
}
$u=$_POST['uname'];
	$p=$_POST['pass'];
$_SESSION['admin']=1;
  if($u=='ADMIN')
  {
    if($p=='thisispass')
    {
      header('Location:admin.php');
    }
  }






}

?>
