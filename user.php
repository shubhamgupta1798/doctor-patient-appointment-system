
<html>

<head>

   <link rel="stylesheet" href="stylesheet.css">
   <style>
   input.c5{
     width:70%;
     float:right;

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
   color:#ffffff;

   padding-top: 15px;
   line-height:wrapText;

   }
   button.c2{
     height:140px;
     width:130px;
    background: transparent;
    border:0px;
     border-radius: 5px;
     border-style:ridge;

     color:white;

   }
   button.c2:hover{
     background-color:#75aec5;
     color:#f3f3f3;
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
     width:20%;
     height:50%;
     float:left;
margin-top: 5%;
   }


   body{

   font color:#ffffff;
   font-family: sans-serif;
    margin-top: 5%;
   }
   body{
     background-image: url("a7.jpg");
     background-repeat: no-repeat;
    background-size: 100%;
   font color:#ffffff;
   font-family: sans-serif;
   }
   img.c3{
     height:100px;
     width:100px;
   }
   body {
     font-family: Arial, Helvetica, sans-serif;
     color:white;
   }

   .flip-box {
     background-color: transparent;
     width: 300px;
     height: 200px;
     border: 1px solid #f1f1f1;
     perspective: 1000px;
   }

   .flip-box-inner {
     position: relative;
     width: 100%;
     height: 100%;
     text-align: center;
     transition: transform 0.8s;
     transform-style: preserve-3d;
   }

   .flip-box:hover .flip-box-inner {
     transform: rotateY(180deg);
   }

   .flip-box-front, .flip-box-back {
     position: absolute;
     width: 100%;
     height: 100%;
     backface-visibility: hidden;
   }

   .flip-box-front {
     background-color: #bbb;
     color: black;
   }

   .flip-box-back {
     background-color: #555;
     color: white;
     transform: rotateY(180deg);
   }
   </style>

  <script type="text/javascript">
  function setURL(url){

    window.location.href=(url);
}
  </script>
</head>
<body>
  <div class="heading1"><h1>WHO ARE YOU?</h1></div>


<hr>  <br>
  <br>


  <form method="POST">

<center>
  <div >
    <div class="part1">
    </div>
  <div class="part1" id="div1" name="div1">

  <button class="c2"  TYPE="BUTTON" onclick="setURL('patient1.php')"><img class="c3" src="user1.png"><h2>PATIENT</button>


  </DIV>
  <div class="part1" id="div2" name="div2">

    <button class="c2" TYPE="BUTTON"  onclick="setURL('doctor_2.php')"><img class="c3" src="doctor.png"><h2>DOCTOR</button>
</DIV>
<div class="part1" id="div3" name="div3">


  <button class="c2" TYPE="BUTTON" onclick="setURL('admin_signin.php')" ><img class="c3" src="admin.png"><h2>ADMIN</BUTTON>
</DIV>

  </div>
</center>
</form>
</body>
</html>
<?php



?>
