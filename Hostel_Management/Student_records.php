
<?php 


//Function for ordered sorting

function Sql_sort ($var,$toggle = true){
 
    $order_state = "";
    $order_state =  $toggle ? "asc":"desc";
    $toggle = ($toggle == true) ? false:true;
    $sql = "select * from student order by $var asc; ";
    
    return $sql ;
    
}





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
if (!empty($_GET)){
  if(!empty($_GET['Group'])){
$sql = Sql_sort($_GET['Group']);
  }
  else{
    $sql = "select * from student; ";
  }
}
else{
  $sql = "select * from student; ";
}
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



</script>


    <h4 class="blue-grey-text darken-2 form">Student Records</h4>




    <div class="contanier">
<div class="col 10 offset-s1">
<table class=" brand-text  striped highlight light-green lighten-3">
<thead>
<tr class="centered">
  <form method="GET" class=" brand-text  " action="/tuts/Student_records.php/" >
    
    <th><label class=" brand-text  "><input class="with-gap" type="radio" name="Group" value="Student_ID" > <span> Student Id </span> </label></th>
    
    <th><label class=" brand-text  "><input class="with-gap" type="radio" name="Group" value="First_Name"> <span>First Name </span></label></th>
    
    <th><label class=" brand-text  "><input class="with-gap" type="radio" name="Group" value="Last_Name"> <span>Last Name </span></label></th>
    
    <th><label class=" brand-text  "><input class="with-gap" type="radio" name="Group"value="Room_Number" > <span>Room Number </span></label></th>
    
    <th><label class=" brand-text  "><input class="with-gap" type="radio" name="Group"value="Block" > <span >Hostel Block </span></label></th>
    <input type="submit" name="sort" value="sort" class="btn  brand z-depth-0">
  </form>
</tr>
</thead>
<tbody></tbody>
<?php foreach($students as $stud){ 
        echo "<tr> 
        <td>".$stud['Student_ID']."</td>
        <td>".$stud['First_Name']."</td>
        <td>".$stud['Last_Name']."</td>
        <td>".$stud['Room_Number']."</td>
        <td>".$stud['Block']."</td>
        </tr>";}?> 
</tbody>
    </table>
    </div>
</div>




    <?php require('Templets\Footer.php'); ?>

</html>


