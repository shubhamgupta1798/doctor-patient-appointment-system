<?php
session_start();
$msg='';
?>
<html>

<head>
  <style>
  input.c5{
    width:30%;

    float:right;
    margin-right: 70px;
       border-radius: 5px;
      outline:0;
      line-height:25px;
  }
  input.c9{
    width:30%;

    float:right;
    margin-right: 5px;
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

div.c3 {
  border-style: groove;
  width: 70%;
  color: #080808;
  background-color: #4b84a75e;
  background-size: 100%;
}

button.c7:hover{
  	background-color:#1f441b;
  	color:black;
  	}
    a.c2:hover{
      background-color:#581818;
      color:black;
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
  button.c2{
    height:30px;
  	width:100px;
    border-radius: 5px;
    border-style:ridge;
    margin-left: 10px;

    margin-top: 5px;

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


  div.c3{
  border-style: groove;
  width: 50%;
  margin-left: 25%;
  }
  button.c0{
    width:55px;
    height:22px;
    margin-right:  10px;
    background-color:red;
    border-radius: 12px;
  }
  .error{
    color: #FF0000;
  }
  </style>
  <script type="text/javascript">
  function setURL(url){

    window.location.href=(url);
  }
  function fn() {

    cap = Math.floor((Math.random()*1000000) +1);
  document.getElementById("var1").value = cap;


  }
  </script>
</head>
<body onload="fn()">
  <?php


  if(isset($_POST['submit'])){

    include 'database_connection.php';
    include 'mailer_connection.php';

  include 'pass.php';
    $user_email = EMAIL;
    $user_pwd = PASS;

    $mail->addAddress('guptashubham1798@gmail.com');     // Add a recipient
    $mail->Subject = 'Contact Us';
    $mail->Body = $_POST['name'].'sent from<br>'.$_POST['email1'];


    if(!$mail->send()) {
      $msg= 'Message could not be sent.';

      //  echo 'Mailer Error: ' . $mail->ErrorInfo;
    }

      else{
        $msg= 'Message has been sent';

      }





  }
  ?>
  <div class="heading1"><h1>CONTACT US</h1></div>

<hr>
 <br>
  <br>


  <form method="POST">

      <div>

        <div class="c3">
          <br>
          <span style="margin-left:30px;">

                        <div id="d1" name="d1">
                            <span style="margin-left:30px;">
                    EMAIL <input class="c5" placeholder="Enter Email" type="email" name="email1" id="email1">

                    </div>
          <br>
          <br>

            <span style="margin-left:30px;">
        MESSAGE: <input class="c5" placeholder="Enter Name" type="text" name="name" id="name">
          <br>
          <br>


          <br>

            <span style="margin-left:30px;">
          MOBILE NUMBER <input class="c5" placeholder="Enter Number" type="number" name="mno" id="mno">
          <br>
          <br>
<input type="hidden" id="var1" name="var1">
        <center>  <a href="user.php" class="c2">BACK</a>
          <button class="c7" type="submit"  name="submit">SUBMIT</button>
          <br>
          <span class='error'><?php echo ($msg);?></span>
</center>
<br>
<br>
  </DIV>
</div>
</form>

</body>
</html>
