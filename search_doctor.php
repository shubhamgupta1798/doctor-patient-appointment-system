<?php
session_start();

  $servername = "127.0.0.1";
  $username = "root";
  $password = "";
  $dbname="assign6";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }



  $sql= "SELECT fname from doctor where blocked=0";
  $result6=$conn->query($sql);

  $data='';
  if ($result6->num_rows > 0) {


      while($row = $result6->fetch_assoc()) {

        $data1=$row["fname"].',';
        $data=$data.$data1;



      }
    }

?>
<html>
<head>
  <style>
  .autocomplete {
    position: relative;
    display: inline-block;
  }

  input.c11,input.c10 {
    border: 1px solid transparent;
    background-color: #f1f1f1;
    padding: 10px;
    font-size: 16px;
  }

  input.c10 {
    background-color: #f1f1f1;
    width: 100%;
  }

  input.c11 {
    background-color: DodgerBlue;
    color: #fff;
    cursor: pointer;
    margin-right: 100px;
  }

  .autocomplete-items {
    position: absolute;
    border: 1px solid #d4d4d4;
    border-bottom: none;
    border-top: none;
    z-index: 99;
    top: 100%;
    left: 0;
    right: 0;
  }

  .autocomplete-items div {
    padding: 10px;
    cursor: pointer;
    background-color: #fff;
    border-bottom: 1px solid #d4d4d4;
  }

  .autocomplete-items div:hover {

    background-color: #e9e9e9;
  }

  .autocomplete-active {

    background-color: DodgerBlue !important;
    color: #ffffff;
  }
  </style>
  </style>
</head>
<body>
<div style='height:8%;width:100%;position: fixed;'>
<form method='post' autocomplete="off" style='float:right;padding-right=20px;'>
  <div class="autocomplete" style="width:300px;">
    <input  class='c10' id="myInput" type="text" name="myinput" placeholder="Search Doctor">
  </div>
  <input class='c11' type="submit" value='Search' name='search'>
</form>
</div>


<script>
function autocomplete(inp, arr) {
var currentFocus;
inp.addEventListener("input", function(e) {
var a, b, i, val = this.value;
closeAllLists();
if (!val) { return false;}
currentFocus = -1;
a = document.createElement("DIV");
a.setAttribute("id", this.id + "autocomplete-list");
a.setAttribute("class", "autocomplete-items");
this.parentNode.appendChild(a);
for (i = 0; i < arr.length; i++) {
if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
    /*create a DIV element for each matching element:*/
    b = document.createElement("DIV");
    /*make the matching letters bold:*/
    b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
    b.innerHTML += arr[i].substr(val.length);
    /*insert a input field that will hold the current array item's value:*/
    b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
    /*execute a function when someone clicks on the item value (DIV element):*/
    b.addEventListener("click", function(e) {
        /*insert the value for the autocomplete text field:*/
        inp.value = this.getElementsByTagName("input")[0].value;
        /*close the list of autocompleted values,
        (or any other open lists of autocompleted values:*/
        closeAllLists();
    });
    a.appendChild(b);
  }
}
});
/*execute a function presses a key on the keyboard:*/
inp.addEventListener("keydown", function(e) {
var x = document.getElementById(this.id + "autocomplete-list");
if (x) x = x.getElementsByTagName("div");
if (e.keyCode == 40) {
  /*If the arrow DOWN key is pressed,
  increase the currentFocus variable:*/
  currentFocus++;
  /*and and make the current item more visible:*/
  addActive(x);
} else if (e.keyCode == 38) { //up
  /*If the arrow UP key is pressed,
  decrease the currentFocus variable:*/
  currentFocus--;
  /*and and make the current item more visible:*/
  addActive(x);
} else if (e.keyCode == 13) {
  /*If the ENTER key is pressed, prevent the form from being submitted,*/
  e.preventDefault();
  if (currentFocus > -1) {
    /*and simulate a click on the "active" item:*/
    if (x) x[currentFocus].click();
  }
}
});
function addActive(x) {
/*a function to classify an item as "active":*/
if (!x) return false;
/*start by removing the "active" class on all items:*/
removeActive(x);
if (currentFocus >= x.length) currentFocus = 0;
if (currentFocus < 0) currentFocus = (x.length - 1);
/*add class "autocomplete-active":*/
x[currentFocus].classList.add("autocomplete-active");
}
function removeActive(x) {
/*a function to remove the "active" class from all autocomplete items:*/
for (var i = 0; i < x.length; i++) {
x[i].classList.remove("autocomplete-active");
}
}
function closeAllLists(elmnt) {
/*close all autocomplete lists in the document,
except the one passed as an argument:*/
var x = document.getElementsByClassName("autocomplete-items");
for (var i = 0; i < x.length; i++) {
if (elmnt != x[i] && elmnt != inp) {
  x[i].parentNode.removeChild(x[i]);
}
}
}
/*execute a function when someone clicks in the document:*/
document.addEventListener("click", function (e) {
closeAllLists(e.target);
});
}
var str="<?php echo($data);?>";

var res = str.split(",");

/*An array containing all the country names in the world:*/
var countries = res;

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("myInput"), countries);
</script>
<?php

if(isset($_POST['search']))
{
  $c=$_POST['myinput'];
  $_SESSION['myinput']=$c;

  echo "<script type='text/javascript'>window.top.location='view_info.php';</script>"; exit;

}
 ?>
