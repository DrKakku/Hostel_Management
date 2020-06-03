
<?php 

$error = "";

//Function for ordered sorting

function Sql_sort ($var,$toggle = "of"){
 
    $order_state = "";
    $order_state =  ($toggle == "of" )? "asc":"desc";
    $sql = "select * from Visitors order by $var $order_state; ";
    
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

    $sql = "SELECT * FROM Visitors where Visitor_ID like '$searchq' or  Student_ID like '$searchq' or Visitor_Name like  '$searchq'  or Visit_Date like  '$searchq'  or 'Purpose' like  '$searchq' ";

  }
   else{

    $sql = "select * from Visitors; ";

  }
  
  }
}
else{
  $sql = "select * from Visitors; ";
}


$result = mysqli_query($conn,$sql);

$Visitors = mysqli_fetch_all($result,MYSQLI_ASSOC);
if (empty($Visitors)){

  $error = "Record Not found";


  $sql = "select * from Visitors; ";



  $result = mysqli_query($conn,$sql);

  $Visitors = mysqli_fetch_all($result,MYSQLI_ASSOC);




}

// Releasing variables from memory
mysqli_free_result($result);

//Close Connection
mysqli_close($conn);




?>




<!DOCTYPE html>
<html>
    <head>

        <title>Visitor Records</title>

    </head>
<?php require('Templets\header.php'); ?>

<script>



</script>


    <h4 class="blue-grey-text darken-2 form center">Visitor Records</h4>


<?php Error($error)?>

    <div class="contanier">
<div class="col 10 offset-s1">
<table class=" brand-text  striped highlight light-green lighten-3">
<thead>
<tr class="centered">
  <form method="GET" class=" brand-text  " action="/HOSTEL_MANAGEMENT/visitors_records.php/" >
  <div class="container">
  

  <div class="row">


  <div class="col s5">
    <div class = "input-field">
<label class="class-text" ><span> Search a Visitor</span>
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
    <th><label class=" brand-text  "><input class="with-gap" type="radio" name="Group" value="Visitor_ID" > <span> Visitor Id </span> </label></th>
    </div>

    <div class = "input-field">
    <th><label class=" brand-text  "><input class="with-gap" type="radio" name="Group" value="Student_ID"> <span>Student ID</span></label></th>
    </div>

    <div class = "input-field">
    <th><label class=" brand-text  "><input class="with-gap" type="radio" name="Group" value="Visitor_Name"> <span>Visitor Name</span></label></th>
    </div>
    
    <div class = "input-field">
    <th><label class=" brand-text  "><input class="with-gap" type="radio" name="Group"value="Visit_Date" > <span>Visit Date </span></label></th>
    </div>

    <div class = "input-field">
    <th><label class=" brand-text  "><input class="with-gap" type="radio" name="Group"value="Purpose" > <span >Purpose of Visit </span></label></th>
    </div>
    
    

</div>
  </form>
</tr>
</thead>
<tbody></tbody>
<?php foreach($Visitors as $stud){ 
        echo "<tr> 
        <td>".$stud['Visitor_ID']."</td>
        <td>".$stud['Student_ID']."</td>
        <td>".$stud['Visitor_Name']."</td>
        <td>".$stud['Visit_Date']."</td>
        <td>".$stud['Purpose']."</td>
        </tr>";}?> 
</tbody>
    </table>
    </div>
</div>




    <?php require('Templets\Footer.php'); ?>

</html>


