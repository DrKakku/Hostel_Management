<?php 


//Variable assignment and the query processin

$errors = [ 'submit' => '' ,'id' => '','First name' => '','Last name' => '','Mobile' => '' ,'Type' => '' ];
$id = $first_name = $last_name = $Mobile = $Type ="";

if (isset($_GET['submit'])){

//Error Checking

$id = $first_name = $last_name = $Mobile = $Type ="";
$id = htmlspecialchars($_GET['Student_ID']);
$first_name = htmlspecialchars($_GET['First_name']);
$last_name = htmlspecialchars($_GET['Last_name']);
$Mobile =  htmlspecialchars($_GET['Mobile']);
$Type =   htmlspecialchars($_GET['Type']);  



	$flag = true;
	if(empty($_GET['Student_ID']))
	{
		$errors['id'] = "Please enter the nessary details"; 
		$flag = false;
	}

	if(!preg_match('/[0-9]{9}/' ,$_GET['Student_ID']))
	{
		$errors['id'] = "You have entered an invalid staff Id number please enter in the followling format <br> 19011111";
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


	if(empty($_GET['Mobile']))
	{
		$errors['Mobile'] = "Please enter the nessary details";
		$flag = false;
	}



	if(empty($_GET['Type']))
	{
		$errors['Type'] = "Please enter the nessary details";
		$flag = false;
	}
	if(!preg_match('/^[a-zA-Z]+$/' ,$_GET['Type']))
	{
		$errors['Type'] = "You have entered an invalid stff type please enter in the followling format <br> cleaner";
		$flag = false;
	}

if($flag == true ){

$id = htmlspecialchars($_GET['Student_ID']);
$first_name = htmlspecialchars($_GET['First_name']);
$last_name = htmlspecialchars($_GET['Last_name']);
$Mobile =  htmlspecialchars($_GET['Mobile']);
$Type =   htmlspecialchars($_GET['Type']);  

//if(!empty($id) || !empty($first_name) ||  !empty($last_name) ||  !empty($Mobile)  ||   !empty($Type)  ){
	
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

$sql = "INSERT INTO `staff`(`Staff_ID`, `First_Name`, `Last_Name`, `Mobile_number`, `Type`) VALUES ('$id','$first_name','$last_name','$Mobile','$Type') ";


if (mysqli_query($conn, $sql)) { 
    $errors['submit'] = "New record created successfully"; 
} 
else 
{ 
	$errors['submit'] = "Error: " . $sql . "<br>" . mysqli_error($conn); 
}
	
//header('Location: \Hostel_Management\Staff.php');

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
	
	<h4 class="center">Staff regestration</h4>

    <P>
 <h4 class="brand-text">
 Staff ID format 
 </h4>
 <div class="brand-text" >
    19 010 1212
    <br>
<ol>
<li>
 First 2 digits represent the current year so, <i class="under">20</i>0102121 is the current year.
 </li>
 <br>
 <li>
 The 3rd 4th and the 5th are the code for the job descreption, so 20<i class="under">010</i>1212 will be the job code of that perticular employee.
 </li>
 <li>
The last digits are the code given for the employes of that batch, so 20010<i class="under">1212</i> will be the code for that employe of that batch.
 </li>
 </div>
 </p>

    <?php Error($errors['submit']); ?>

	<form class="light-green lighten-4 stripped" action="\Hostel_Management\Staff.php" meathod="POST">
		
		
		<label>Worker ID:</label>
		<?php Error($errors['id']); ?>
		<input onkeyup="this.value = this.value.toUpperCase()" type="text" name="Student_ID" placeholder="19BCE1234" maxlength="9" value='<?PHP echo  $id ;?>'>

		<label>First Name:</label>
		<?php Error($errors['First name']); ?>
		<input type="text" name="First_name" placeholder="First name" value='<?PHP echo  $first_name ;?>' onkeyup="this.value = this.value.toUpperCase()">

		<label>Last Name:</label>
		<?php Error($errors['Last name']); ?>
		<input type="text" name="Last_name" placeholder="Last name" value='<?PHP echo  $last_name ;?>' onkeyup="this.value = this.value.toUpperCase()">

		<label>Mobile Number:</label>
		<?php Error($errors['Mobile']); ?>
		<input type="tel" name="Mobile" pattern="[0-9]{10}" placeholder="9123456789" maxlength="10" value='<?PHP echo  $Mobile ;?>' onkeyup="this.value = this.value.toUpperCase()">

		<label>Worker  Type:</label>
		<?php Error($errors['Type']); ?>
		<input type="text" name="Type" placeholder="cleaner" value='<?PHP echo  $Type ;?>' onkeyup="this.value = this.value.toUpperCase()">

			<div class="center">
				
				<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">

			</div>
	</form>


 <!-- <P>
 <h4 class="brand-text">
 Staff id format 
 </h4>
 <div class="brand-text" >
    19 010 1212
    <br>
<ol>
<li>
 First 2 digits represent the current year so, <i class="under">20</i>0102121 is the current year.
 </li>
 <br>
 <li>
 The 3rd 4th and the 5th are the code for the job descreption, so 20<i class="under">010</i>1212 will be the job code of that perticular employee.
 </li>
 <li>
The last digits are the code given for the employes of that batch, so 20010<i class="under">1212</i> will be the code for that employe of that batch.
 </li>
 </div>
 </p> -->
</section>
<?php require('Templets/Footer.php'); ?> 
</html>
