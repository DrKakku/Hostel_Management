<?php 


//Variable assignment and the query processing

session_start();



$errors = [ 'submit' => '' ,'roll' => ''  ];
$roll = '';

if (isset($_GET['submit'])){

	$roll =  '';
	$roll = htmlspecialchars($_GET['Student_ID']);
	

//Error Checking

	$flag = 1;
	
	if(empty($_GET['Student_ID']))
	{
		$errors['roll'] = "Please enter the nessary details";
		$flag = 2;
	}
	if(!preg_match('/[0-9][0-9][a-zA-Z][a-zA-Z][a-zA-Z][0-9][0-9][0-9][0-9]/' ,$_GET['Student_ID']))
	{
		$errors['roll'] = "You have entered an invalid student roll number please enter in the followling format <br> 19BCE1111";
		$flag = 2;
	}

if($flag == 1 ){


$roll = htmlspecialchars($_GET['Student_ID']);
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

$sql = "select Student_ID from student where Student_ID =  '$roll' ";

$result = mysqli_query($conn,$sql);

$students = mysqli_fetch_all($result,MYSQLI_ASSOC);


print_r($students);

if (!empty($students)){
if ($students[0]["Student_ID"] == $roll) { 
	setcookie('Student_ID',$roll);
	print_r($GLOBALS);
    header('Location: /Hostel_Management/Leave/Leave.php');
} 
}else 
{ 
    $errors["submit"] = "There is no student with id of '$roll' ";
    
}
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
<title>Leave request</title>


<?php require('D:\Work\softwares\Xampp\htdocs\Hostel_Management\Templets\header.php') ?>

<section class="container grey-text">

	<h4 class="center">Student Information check</h4>
	<?php Error($errors['submit']); ?>

	<form class="light-green lighten-4   " action="/Hostel_Management/Leave/Student_check.php/" meathod="GET">



		
		<?php Error($errors['roll']); ?>
        <label>Student roll number:</label>
		<input type="text" name="Student_ID" placeholder="19BCE1234" value="<?PHP echo $roll;?>"
			onkeyup="this.value = this.value.toUpperCase()">
		
		<br>

		<div class="center">

			<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">

		</div>
	</form>
</section>




<?php require('D:\Work\softwares\Xampp\htdocs\Hostel_Management\Templets\Footer.php'); ?>

</html>