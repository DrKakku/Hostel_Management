<?php 
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

$sql = "select * from student";


$result = mysqli_query($conn,$sql);

$students = mysqli_fetch_all($result,MYSQLI_ASSOC);



?>



<!DOCTYPE html>
 <html>
<title>Hostel management sys</title>
 <?php require('Templets/header.php'); ?>


<section class="contanier grey-text ">
    <h4 class="center">
        All the current pages we are working on
    </h4>
    <div>
    <br>
    </div>
    <div class=" center z-depth-0 brand-text">
        <ul>
            <li>
        <a class="brand-logo brand-text" href="Visitors/Student_check.php">For Visitors page</a> 
            </li>

            
            <li>
                <a class="brand-logo brand-text" href="Students.php">For Students page</a>
            </li>

            <li>
                <a class="brand-logo brand-text" href="Student_records.php">For Students Records</a>
            </li>

    </div>


</section>

 
 <?php require('Templets/Footer.php'); ?>
 </html>