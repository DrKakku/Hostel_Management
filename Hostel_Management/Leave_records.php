
<?php 

$error = "";

//Function for ordered sorting

function Sql_sort ($var,$toggle = "of"){
 
    $order_state = "";
    $order_state =  ($toggle == "of" )? "asc":"desc";
    $sql = "select * from student_leave order by $var $order_state; ";
    
    return $sql ;
    
}


//Error display Function
function Error($var )
{	if(!empty($var)){
	echo "<div class=' red-text' > '$var' </div>" ;
}
else{echo " ";}
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
if (isset($_GET))
{

  if(!empty($_GET['Group'])){



    $state = (empty($_GET['type'])) ? "of":"on" ;
    $sql = Sql_sort($_GET['Group'],$state);

  }
 
  else{
  if(!empty($_GET['search'])){

    $searchq = $_GET['search'];
    $searchq = preg_replace("#[^0-9A-Z]#i","",$searchq);

    $sql = "SELECT * FROM student_leave where Leave_ID like '$searchq' or  Student_ID like '$searchq' or Leave_Date like  '$searchq'  or Return_Date like  '$searchq'  or 'Reason' like  '$searchq'  or destination like  '$searchq' ";

  }
   else{

    $sql = "select * from student_leave; ";

  }
  }
  
}
else{
  $sql = "select * from student_leave; ";
}


$result = mysqli_query($conn,$sql);

$Leaves = mysqli_fetch_all($result,MYSQLI_ASSOC);
if (empty($Leaves)){

  $error = "Not found";

  $sql = "select * from student_leave; ";

  $result = mysqli_query($conn,$sql);

  $Leaves = mysqli_fetch_all($result,MYSQLI_ASSOC);

}

// Releasing variables from memory
mysqli_free_result($result);

//Close Connection
mysqli_close($conn);



?>



<!DOCTYPE html>
<html>
    <head>

        <title>Leave Records</title>

    </head>
<?php require('Templets\header.php'); ?>

<script>



</script>


    <h4 class="blue-grey-text darken-2 form center">Leave Records</h4>


<?php Error($error)?>

    <div class="contanier">
<div class="col 10 offset-s1">
<table class=" brand-text  striped highlight light-green lighten-3">
<thead>
<tr class="centered">
  <form method="GET" class=" brand-text  " action="/HOSTEL_MANAGEMENT/Leave_records.php/" >
  <div class="container">
  

  <div class="row">


  <div class="col s5">
    <div class = "input-field">
<label class="class-text" ><span> Search a Leave</span>
  <input type="text" name="search" placeholder="Registration number ">
</label>
</div>
</div>

<div class="col s5">
  <div class="switch brand-text">
    <label class = 'brand-text'>
      
      <div class="input-field">Ascending
      <input type="checkbox" name="type">
     
      <span class="lever"></span> Descending
</div>
</div>
     
    </label>
  </div>
  <br>

  <div class="col s2">
    <div class="input-field">
    <input type="submit" name="sort" value="sort" class="btn  brand z-depth-0">
    </div>
    </div>
</div>
    <div class = "input-field">
    <th><label class=" brand-text  "><input class="with-gap" type="radio" name="Group" value="Leave_ID" > <span> Leave Id </span> </label></th>
    </div>

    <div class = "input-field">
    <th><label class=" brand-text  "><input class="with-gap" type="radio" name="Group" value="Student_ID"> <span>Student ID </span></label></th>
    </div>

    <div class = "input-field">
    <th><label class=" brand-text  "><input class="with-gap" type="radio" name="Group" value="Leave_Date"> <span>Leave Date</span></label></th>
    </div>
    
    <div class = "input-field">
    <th><label class=" brand-text  "><input class="with-gap" type="radio" name="Group"value="Return_Date" > <span>Return Date</span></label></th>
    </div>

    <div class = "input-field">
    <th><label class=" brand-text  "><input class="with-gap" type="radio" name="Group"value="Reason" > <span >Reason of Leave </span></label></th>
    </div>
    
    
    <div class = "input-field">
    <th><label class=" brand-text  "><input class="with-gap" type="radio" name="Group"value="destination" > <span >Destination </span></label></th>
    </div>

</div>
  </form>
</tr>
</thead>
<tbody></tbody>
<?php foreach($Leaves as $stud){ 
        echo "<tr> 
        <td>".$stud['Leave_ID']."</td>
        <td>".$stud['Student_ID']."</td>
        <td>".$stud['Leave_Date']."</td>
        <td>".$stud['Return_Date']."</td>
        <td>".$stud['Reason']."</td>
        <td>".$stud['destination']."</td>
        </tr>";}?> 
</tbody>
    </table>
    </div>
</div>




    <?php require('Templets\Footer.php'); ?>

</html>


