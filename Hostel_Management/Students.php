<?php 


//Variable assignment and the query processing

$errors = [ 'submit' => '' ,'id' => '','First name' => '','Last name' => '','Room' => '' ,'Block' => '','type' => '' ];
$id = $type = $first_name = $last_name = $room = $block ="";

if (isset($_GET['submit'])){

//Error Checking

$id = $type = $first_name = $last_name = $room = $block ="";
$id = htmlspecialchars($_GET['Student_ID']);
$first_name = htmlspecialchars($_GET['First_name']);
$last_name = htmlspecialchars($_GET['Last_name']);
$room =  htmlspecialchars($_GET['room']);
$block =   htmlspecialchars($_GET['Block']);  
$type =   htmlspecialchars($_GET['type']);  



	$flag = true;
	if(empty($_GET['Student_ID']))
	{
		$errors['id'] = "Please enter the nessary details"; 
		$flag = false;
	}

	if(!preg_match('/[0-9][0-9][a-zA-Z][a-zA-Z][a-zA-Z][0-9][0-9][0-9][0-9]/' ,$_GET['Student_ID']))
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



	if(empty($_GET['type']))
	{
		$errors['type'] = "Please enter the nessary details";
		$flag = false;
	}


	if(!preg_match('/[0-9][aAnN][aAcC]+/' ,$_GET['type']))
	{
		$errors['type'] = "You have entered an invalid Room type format please enter in the followling format <br> 4AC  or 3NAC";
		$flag = false;
	}



if($flag == true ){

$id = htmlspecialchars($_GET['Student_ID']);
$first_name = htmlspecialchars($_GET['First_name']);
$last_name = htmlspecialchars($_GET['Last_name']);
$room =  htmlspecialchars($_GET['room']);
$block =   htmlspecialchars($_GET['Block']);  
$type =   htmlspecialchars($_GET['type']);  
	
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

$sql = "INSERT INTO student values ('$id','$first_name','$last_name','$room','$block','$type'); ";


if (mysqli_query($conn, $sql)) { 
    $errors['submit'] = "New record created successfully"; 
} 
else 
{ 
	$errors['submit'] = "Error: " . $sql . "<br>" . mysqli_error($conn); 
}
	
//header('Location: /Hostel_Management/Students.php');

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
<title>Student regestration</title>


<?php require('Templets\header.php') ?>

<section class="container grey-text darken-5 " >
	
	<h4 class="center">Students regestration</h4>

	<form class="light-green lighten-4 stripped" action="/Hostel_Management/Students.php/" meathod="POST">
		
	<?php Error($errors['submit']); ?>
		
		<label>Student ID:</label>
		<?php Error($errors['id']); ?>
		<input onkeyup="this.value = this.value.toUpperCase()" type="text" name="Student_ID" placeholder="19BCE1234" maxlength="9" value='<?PHP echo  $id ;?>'>

		<label>First Name:</label>
		<?php Error($errors['First name']); ?>
		<input type="text" name="First_name" placeholder="First name" value='<?PHP echo  $first_name ;?>' onkeyup="this.value = this.value.toUpperCase()">

		<label>Last Name:</label>
		<?php Error($errors['Last name']); ?>
		<input type="text" name="Last_name" placeholder="Last name" value='<?PHP echo  $last_name ;?>' onkeyup="this.value = this.value.toUpperCase()">

		<label>Room Number:</label>
		<?php Error($errors['Room']); ?>
		<input type="text" name="room" placeholder="1415" maxlength="4" value='<?PHP echo  $room ;?>' onkeyup="this.value = this.value.toUpperCase()">

		<label>Hostle Block:</label>
		<?php Error($errors['Block']); ?>
		<input type="text" name="Block" maxlength="1" placeholder="B" value='<?PHP echo  $block ;?>' onkeyup="this.value = this.value.toUpperCase()">


		<label>Room Type:</label>
		<?php Error($errors['type']); ?>
		<input type="text" name="type" maxlength="4" placeholder="3AC // 2NAC" value='<?PHP echo  $type ;?>' onkeyup="this.value = this.value.toUpperCase()">




			<div class="center">
				
				<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">

			</div>
	</form>
</section>




<?php require('Templets/Footer.php'); ?> 
</html>
