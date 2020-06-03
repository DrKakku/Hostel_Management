 <?php 


//Variable assignment and the query processing

     
$errors = [ 'submit' => '' ,'visitor' => '','purpose' => '', "roll" => '' ];
$vis = $roll= $purpose = '';

if (isset($_GET['submit'])){

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


	$vis = htmlspecialchars($_GET['visitor_name']);
	$purpose =  htmlspecialchars($_GET['Purpose']);
	$roll =  htmlspecialchars($_GET['Student_ID']);

	//Error Checking
	$flag = 1;
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

	
	if(empty($_GET['visitor_name']))
	{
		$errors['visitor'] = "Please enter the nessary details"; 
		$flag = 2;
	}
	if(!preg_match('/^[A-Za-z1-9 ]+$/' ,$_GET['visitor_name']))
	{
		$errors['visitor'] = "Please Enter a valid Input Nospecial characters are allowed.";
		$flag = 2;
	}



if($flag == 1 ){

$vis = htmlspecialchars($_GET['visitor_name']);
$roll = htmlspecialchars($_GET['Student_ID']);
$purpose =  htmlspecialchars($_GET['Purpose']);

if ( !$conn ) 
{ 
    die("Connection failed: " . mysqli_connect_error()); 
} 
//Sql query for entring the values to the database

//entring values into visitor table




$sql = "INSERT INTO VISITORS (Visitor_Name,Purpose,Student_ID) values ('$vis','$purpose','$roll'); ";
if (mysqli_query($conn, $sql)) { 
    $errors['submit'] = "New record created successfully"; 
} 
else 
{ 
	$errors['submit'] = "Error: " . $sql . "<br>" . mysqli_error($conn); 
}
}
}

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


<?php require('D:\Work\softwares\Xampp\htdocs\Hostel_Management\Templets\header.php') ?>

<section class="container grey-text">


	<h4 class="center">Visitor Information</h4>
	<?php Error($errors['submit']); ?>

	<form class="light-green lighten-4   " action="/Hostel_Management/Visitors/Visitors.php/" meathod="POST">


    	<label>Name:</label>

		<?php Error($errors['visitor']); ?>
		<input type="text" name="visitor_name" placeholder="your name" value='<?PHP echo  $vis ;?>'
			onkeyup="this.value = this.value.toUpperCase()">


		<br>

		
			<?php Error($errors['roll']); ?>
        <label>Student roll number:</label>
		<input type="text" name="Student_ID" placeholder="19BCE1234" value="<?PHP echo $roll;?>"
			onkeyup="this.value = this.value.toUpperCase()">
		

		
		<br>
		<label>Purpose of visit:</label>
		<input type="text" name="Purpose" maxlength="200" placeholder="Why are you here!!!!"
			value="<?PHP echo $purpose;?>">
		
		<br>
		<div class="center">

			<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">

		</div>
	</form>
</section>




<?php require('D:\Work\softwares\Xampp\htdocs\Hostel_Management\Templets\Footer.php'); ?>

</html>