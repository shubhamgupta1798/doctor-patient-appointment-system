<?php

include("search_doctor.php");

if($_SESSION['user']<>'')
{
?>
  <html>
  <head>
     <link rel="stylesheet" href="stylesheet.css"/>
    <style>
    button.c2{
      height:50px;
      width:200px;
      background-color: #f3f3f3;
      border-radius: 5px;
      border-style:ridge;

      color:black;
      font-size:15;

    }
    button.c2:hover{
      background-color:#75aec5;
      color:#f3f3f3;
      }
div.part1{
  height:90%;
  width:15%;
  padding-left: 20px;
  padding-top: 40px;;
  float: left;
}
div.part2{
  height:90%;
  width:79%;
  float: right;
  font-size: 125%;

}
body{
  background: url("images/2.jpg");
  background-attachment: fixed;
 background-size: 100%;
background-repeat: repeat-y;
}
    </style>
    <script type='text/javascript'>
    function setURL(url){
      document.getElementById('iframe_a').src = url;
  }
    </script>

  </head>

  <body>

    <CENTER><h1> PATIENT PORTAL</H1></CENTER>
      <a href="logout1.php" style='float:right;background-color:black;color:white;border:0.5px solid;border-color:black;padding:3px;'>LogOut</a>

      <hr>
    <div class='part1'>
<button class='c2' type="BUTTON" onclick="setURL('patient_doctor_same_city.php')"> Search Doctors in your city</button>
<br>
<button class='c2' type="BUTTON" onclick="setURL('patient_select_a_field_of_doctor.php')">Search Doctors by field </button>
<br>

<button class='c2' type="BUTTON" onclick="setURL('search2.php')">Search by Name</button>
<br>
<button class='c2' type="BUTTON" onclick="setURL('patient_blood_request.php')">Donate Blood</button>
<br>
<button class='c2' type="BUTTON" onclick="setURL('patient_view_past_history.php')">PAST HISTORY</button>
<br>
<button class='c2' type="BUTTON" onclick="setURL('cancel_current_appointment.php')">Cancel Current Appointment</button>
<br>
<button class='c2' type="BUTTON" onclick="setURL('patient_doctor_rejected.php')">Appointment Rejected By Doctor</button>
<br>
<button class='c2' type="BUTTON" onclick="setURL('contact_us.php')">CONTACT US</button>
<br>
</div>
<DIV CLASS='part2'>
  <iframe height="100%" width="100%;font-size:125%;"  name="iframe_a" id="iframe_a" style=" border: 0px solid #9a9a9a;">

</div>
<a href='contact_us.php'>CONTACT US</a>

  </body>
  </html>


<?php




}
 ?>
