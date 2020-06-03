 <?php 


//Variable assignment and the query processing

     
$errors = [ 'submit' => '' ,'start' => '','end' => '','purpose' => '','place' => '',  "roll" => '' ];
$start = $place = $end = $roll= $purpose = '';

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


	$start = htmlspecialchars($_GET['start']);
	$end =  htmlspecialchars($_GET['end']);
	$purpose =  htmlspecialchars($_GET['Purpose']);
	$roll =  htmlspecialchars($_GET['Student_ID']);
	$place =  htmlspecialchars($_GET['place']);

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

	if(empty($_GET['start']))
	{
	$errors['start'] = "Please enter the nessary details";
	$flag = 2;
	}


	if(empty($_GET['end']))
	{
	$errors['end'] = "Please enter the nessary details";
	$flag = 2;
	}



	if(empty($_GET['place']))
	{
	$errors['place'] = "Please enter the nessary details";
	$flag = 2;
	}

	
	// if(empty($_GET['visitor_name']))
	// {
	// 	$errors['visitor'] = "Please enter the nessary details"; 
	// 	$flag = 2;
	// }
	// if(!preg_match('/^[A-Za-z1-9 ]+$/' ,$_GET['visitor_name']))
	// {
	// 	$errors['visitor'] = "Please Enter a valid Input Nospecial characters are allowed.";
	// 	$flag = 2;
	// }



if($flag == 1 ){

$roll = htmlspecialchars($_GET['Student_ID']);
$purpose =  htmlspecialchars($_GET['Purpose']);
$end =  htmlspecialchars($_GET['end']);
$start =  htmlspecialchars($_GET['start']);
$place =  htmlspecialchars($_GET['place']);

if ( !$conn ) 
{ 
    die("Connection failed: " . mysqli_connect_error()); 
} 
// Sql query for entring the values to the database

// entring values into visitor table

$sql = "INSERT INTO `student_leave`( `Student_ID`, `Leave_Date`, `Return_Date`, `Reason`, `destination`) VALUES ('$roll','$start','$end','$purpose','$place')";
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
<title>Leave</title>


<?php require('D:\Work\softwares\Xampp\htdocs\Hostel_Management\Templets\header.php') ?>

<section class="container grey-text">

	<h4 class="center">Leave application</h4>
	<?php Error($errors['submit']); ?>

	<form class="light-green lighten-4   " action="/Hostel_Management/Leave/Leave.php/" meathod="POST">


			<?php Error($errors['roll']); ?>
        <label>Student roll number:</label>
		<input type="text" name="Student_ID" placeholder="19BCE1234" value="<?PHP echo $roll;?>"
			onkeyup="this.value = this.value.toUpperCase()">
		

			<br>
          
		<label>Date of leaving</label>   
		<?php Error($errors['start']); ?>           
               <input type = "text" name = "start" class = "datepicker1" />    
         
		<br>

           
		<label>date of getting back</label>
		<?php Error($errors['end']); ?>              
               <input type = "text" name="end" class = "datepicker2" />    
            

		<br>
		<label>Purpose of visit:</label>
		<?php Error($errors['purpose']); ?>
		<input type="text" name="Purpose" maxlength="200" placeholder="Why are you here!!!!"
			value="<?PHP echo $purpose;?>">
		
		<br>


		<label>Place of visit:</label>
		<?php Error($errors['place']); ?>
		<input type="text" name="place" maxlength="200" placeholder="Why are you here!!!!"
			value="<?PHP echo $place;?>" onkeyup="this.value = this.value.toUpperCase()">
		
			<br>


		<div class="center">

			<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">

		</div>

	</form>
</section>

<script>
	const claender1 = document.querySelector('.datepicker1');
	M.Datepicker.init(claender1,{
		format:'yyyy-mm-dd',
		
	});
</script>

<script>
	const claender2 = document.querySelector('.datepicker2');
	M.Datepicker.init(claender2,{
		format:'yyyy-mm-dd' ,
		
	});
</script>


<?php require('D:\Work\softwares\Xampp\htdocs\Hostel_Management\Templets\Footer.php'); ?>

</html>