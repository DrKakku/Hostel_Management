<?php 


//Variable assignment and the query processing

$errors = [ 'submit' => '' ,'visitor' => '','student name' => '','roll' => '' ,'purpose' => '' ];


if (isset($_GET['submit'])){

//Error Checking

	$flag = 1;
	if(empty($_GET['visitor_name']))
	{
		$errors['visitor'] = "Please enter the nessary details"; 
		$flag = 2;
	}
	if(!preg_match('/^[A-Za-z1-9]+$/' ,$_GET['visitor_name']))
	{
		$errors['visitor'] = "Please Enter a valid Input Nospecial characters are allowed.";
		$flag = 2;
	}

	if(empty($_GET['student_name']))
	{
		$errors['student name'] = "Please enter the nessary details";
		$flag = 2;
	}

	if(!preg_match('/^[A-Za-z1-9]+$/' ,$_GET['student_name']))
	{
		$errors['student name'] = "Please Enter a valid Input Nospecial characters are allowed.";
		$flag = 2;
	}

	if(empty($_GET['Student_ID']))
	{
		$errors['roll'] = "Please enter the nessary details";
		$flag = 2;
	}
	if(!preg_match('/[1-9][1-9][a-zA-Z][a-zA-Z][a-zA-Z][1-9][1-9][1-9][1-9]/' ,$_GET['Student_ID']))
	{
		$errors['roll'] = "You have entered an invalid student roll number please enter in the followling format <br> 19BCE1111";
		$flag = 2;
	}

if($flag == 1 ){

$vis = htmlspecialchars($_GET['visitor_name']);
$stu_nam = htmlspecialchars($_GET['student_name']);
$roll = htmlspecialchars($_GET['Student_ID']);
$purpose =  htmlspecialchars($_GET['Purpose']);
$time =   date("Y-m-d H:i:s");                  //'FROM_UNIXTIME (1231634282) ';
echo $time ;
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

$sql = "INSERT INTO VISITORS (Visitor_Name,Visit_Date,Purpose) values ('$vis','$time','$purpose'); ";


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
	
	<h4 class="center">Visitor Information</h4>
		<!-- <?php //Error($errors['submit']); ?> -->

	<form class="white" action="/tuts/Visitors.php/" meathod="GET">
		
		
		<label>Name:</label>
		<?php Error($errors['visitor']); ?>
		<input type="text" name="visitor_name" placeholder="your name">

		<label>Student Name:</label>
		<?php Error($errors['student name']); ?>
		<input type="text" name="student_name" placeholder="student name">

		<label>Student roll number:</label>
		<?php Error($errors['roll']); ?>
		<input type="text" name="Student_ID" placeholder="19BCE1234">

		<label>Purpose of visit:</label>
		<input type="text" name="Purpose" maxlength="200" placeholder="Why are you here!!!!">

			<div class="center">
				
				<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">

			</div>
	</form>
</section>




<?php require('Templets/Footer.php'); ?> 
</html>
