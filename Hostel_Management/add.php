<?php 



?>

<!DOCTYPE html>
 <html>
<title>Visitors</title>

<section class="container grey-text" >
	
	<h4 class="center">Visitor Information</h4>

	<form class="white" action="/tuts/Visitors.php/" meathod="GET">
		
		<label>Name:</label>
		<input type="text" name="visitor_name" placeholder="your name">

		<label>Student Name:</label>
		<input type="text" name="student_name" placeholder="student name">

		<label>Student roll number:</label>
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