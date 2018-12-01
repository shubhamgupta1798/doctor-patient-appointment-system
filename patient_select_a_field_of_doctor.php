
<html>
<body>
  <form method='post'>
    <B>
<center><label style='font-size:20px;' for ="specialization" style="font-weight: bolder" >Specialization in :</label></b>
										<select style='height:25px;' name="specialization" class="form-control" required>
											<option value="Ophthalmologist">Ophthalmologist</option>
											<option value="Dentist">Dentist</option>
											<option value="Cardiologist">Cardiologist</option>
											<option value="Physician">Physician</option>
											<option value="Nephrologist">Nephrologist</option>
											<option value="Hepatologist">Hepatologist</option>
											<option value="Vascularigist">Vascularigist</option>
											<option value="Neurologist">Neurologist</option>
											<option value="Other">Other</option>
                    </select>
                    <center>
                    <br>
<br>

                    <button style='height:25px;width:150px;border-radius:5px;' type='submit' name='submit'>
                      SELECT THIS FIELD
                    </button>
</body>
</html>
<?php
  if(isset($_POST['submit']))
  {
    $v=$_POST['specialization'];
    session_start();
    $_SESSION['specialization']=$v;

    header('Location:patient_doctor_of_given_field.php');
  }
 ?>
