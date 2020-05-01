<?php 


//Variable assignment and the query processing

$errors = [ 'submit' => '' ,'id' => '','First name' => '','Last name' => '','Room' => '' ,'Block' => '' ];


if (isset($_GET['submit'])){

//Error Checking

	$flag = true;
	if(empty($_GET['Student_ID']))
	{
		$errors['id'] = "Please enter the nessary details"; 
		$flag = false;
	}

	if(!preg_match('/[1-9][1-9][a-zA-Z][a-zA-Z][a-zA-Z][1-9][1-9][1-9][1-9]/' ,$_GET['Student_ID']))
	{
		$errors['id'] = "You have entered an invalid student roll number please enter in the followling format <br> 19BCE1111";
		$flag = false;
	}

	if(!preg_match('/^[A-Za-z1-9]+$/' ,$_GET['First_name']))
	{
		$errors['First name'] = "Please Enter a valid Input Nospecial characters are allowed.";
		$flag = false;
	}

	if(!preg_match('/^[A-Za-z1-9]+$/' ,$_GET['Last_name']))
	{
		$errors['Last name'] = "Please Enter a valid Input Nospecial characters are allowed.";
		$flag = false;
	}


	if(empty($_GET['room']))
	{
		$errors['Room'] = "Please enter the nessary details";
		$flag = false;
	}

	if(!preg_match('/[0-9]{2,4}/' ,$_GET['room']))
	{
		$errors['Room'] = "Please Enter a valid Input Nospecial characters are allowed.";
		$flag = false;
	}

	if(empty($_GET['Block']))
	{
		$errors['Block'] = "Please enter the nessary details";
		$flag = false;
	}
	if(!preg_match('/[a-zA-Z]/' ,$_GET['Block']))
	{
		$errors['Block'] = "You have entered an invalid student roll number please enter in the followling format <br> 19BCE1111";
		$flag = false;
	}

if($flag == true ){

$id = htmlspecialchars($_GET['Student_ID']);
$first_name = htmlspecialchars($_GET['First_name']);
$last_name = htmlspecialchars($_GET['Last_name']);
$room =  htmlspecialchars($_GET['room']);
$block =   htmlspecialchars($_GET['Block']);  

//if(!empty($id) || !empty($first_name) ||  !empty($last_name) ||  !empty($room)  ||   !empty($block)  ){
	
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

$sql = "INSERT INTO student values ('$id','$first_name','$last_name','$room','$block'); ";


if (mysqli_query($conn, $sql)) { 
    $errors['submit'] = "New record created successfully"; 
} 
else 
{ 
	$errors['submit'] = "Error: " . $sql . "<br>" . mysqli_error($conn); 
}
	
	//header("Location: http://localhost/tuts/Visitors.php/");

}
}
?>



<?php
//Error display Function
function Error($var )
{	if(!empty($var)){
	echo "<div class=' red-text' > '$var' </div>" ;
}
else{echo " ";}
} 
?>


<!DOCTYPE html>
 <html>
<title>Visitors</title>


<?php require('Templets\header.php') ?>

<section class="container grey-text" >
	
	<h4 class="center">Students regestration</h4>

	<form class="white" action="/tuts/Students.php/" meathod="POST">
		
		
		<label>Student ID:</label>
		<?php Error($errors['id']); ?>
		<input type="text" name="Student_ID" placeholder="19BCE1234" maxlength="9">

		<label>First Name:</label>
		<?php Error($errors['First name']); ?>
		<input type="text" name="First_name" placeholder="First name">

		<label>Last Name:</label>
		<?php Error($errors['Last name']); ?>
		<input type="text" name="Last_name" placeholder="Last name">

		<label>Room Number:</label>
		<?php Error($errors['Room']); ?>
		<input type="text" name="room" placeholder="1415" maxlength="4">

		<label>Hostle Block:</label>
		<?php Error($errors['Block']); ?>
		<input type="text" name="Block" maxlength="1" placeholder="Why are you here!!!!">

			<div class="center">
				
				<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">

			</div>
	</form>
</section>




<?php require('Templets/Footer.php'); ?> 
</html>
