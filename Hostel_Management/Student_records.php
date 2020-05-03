
<?php 
//server settings 
	//make changes acording to your own server cnfiguration

//Host
$host = 'localhost';

//user
$user = 'root';

//Password

$pass = '' ; //as there is no password for my user i will leave an empty string

//dataBase name
$database = 'hostle_management';


//Connection setteing

$conn = mysqli_connect($host,$user,$pass,$database);

if ( !$conn ) 
{ 
    die("Connection failed: " . mysqli_connect_error()); 
} 

//Sql query for entring the values to the database

$sql = "select * from student order by Student_ID desc; ";


$result = mysqli_query($conn,$sql);

$students = mysqli_fetch_all($result,MYSQLI_ASSOC);

// Releasing variables from memory
mysqli_free_result($result);

//Close Connection
mysqli_close($conn);

?>




<!DOCTYPE html>
<html>
    <head>

        <title>Student Records</title>

    </head>
<?php require('Templets\header.php'); ?>

<script>

$(document).ready(function(){
    $('select').formSelect();
  });

</script>


    <h4 class="blue-grey-text darken-2 form">Student Records</h4>




    <div class="contanier">
<div class="col 10 offset-s1">
<table class=" brand-text striped highlight light-green lighten-3 responsive-table">

<tr class="centered">
    <th>Student Id</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Room Number</th>
    <th>Hostel Block</th>
</tr>
<?php foreach($students as $stud){ 
        echo "<tr> 
        <td>".$stud['Student_ID']."</td>
        <td>".$stud['First_Name']."</td>
        <td>".$stud['Last_Name']."</td>
        <td>".$stud['Room_Number']."</td>
        <td>".$stud['Block']."</td>
        </tr>";}?> 

    </table>
    </div>
</div>



<div class="input-field col s12">
    <select>
      <option value="" disabled selected>Choose your option</option>
      <option value="1">Option 1</option>
      <option value="2">Option 2</option>
      <option value="3">Option 3</option>
    </select>
    <label>Materialize Select</label>
  </div>


<!-- <form class="white ignore" action="/tuts/Student_records.php">
  <label for="cars">Choose a car:</label>
  <select id="cars" name="cars">
    <option value="volvo">Volvo</option>
    <option value="saab">Saab</option>
    <option value="fiat">Fiat</option>
    <option value="audi">Audi</option>
  </select>
  <input type="submit">
</form> -->


    <?php require('Templets\Footer.php'); ?>

</html>


