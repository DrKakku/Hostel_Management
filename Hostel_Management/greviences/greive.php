 <?php 


//Variable assignment and the query processing

     
$errors = [ 'submit' => '' ,'grieve' => '',  "roll" => '' ];
$grieve = $roll = '';

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

	$roll =  htmlspecialchars($_GET['Student_ID']);
	$grieve =  htmlspecialchars($_GET['grieve']);

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

	if(empty($_GET['grieve']))
	{
	$errors['grieve'] = "Please enter the nessary details";
	$flag = 2;
	}



if($flag == 1 ){

$roll = htmlspecialchars($_GET['Student_ID']);
$grieve =  htmlspecialchars($_GET['grieve']);

if ( !$conn ) 
{ 
    die("Connection failed: " . mysqli_connect_error()); 
} 
// Sql query for entring the values to the database

// entring values into visitor table

$sql = "INSERT INTO `grievances`(`Student_Student_ID`, `Grievances`) VALUES ('$roll','$grieve')";
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
<title>Grevience</title>


<?php require('D:\Work\softwares\Xampp\htdocs\Hostel_Management\Templets\header.php') ?>

<section class="container grey-text">

	<h4 class="center">Grevience application</h4>
	<?php Error($errors['submit']); ?>

	<form class="light-green lighten-4   " action="greive.php" meathod="POST">


			<?php Error($errors['roll']); ?>
        <label>Student roll number:</label>
		<input type="text" name="Student_ID" placeholder="19BCE1234" value="<?PHP echo $roll;?>"
			onkeyup="this.value = this.value.toUpperCase()">
		

	
		
		<br>


		<label>Grievence:</label>
		<?php Error($errors['grieve']); ?>
		<input type="text" name="grieve" maxlength="200" placeholder="Why is causing you troubble!!!!"
			value="<?PHP echo $grieve;?>" onkeyup="this.value = this.value.toUpperCase()">
		
			<br>


		<div class="center">

			<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">

		</div>

	</form>
</section>


<?php require('D:\Work\softwares\Xampp\htdocs\Hostel_Management\Templets\Footer.php'); ?>

</html>