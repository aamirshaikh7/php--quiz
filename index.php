<?php
	include 'includes/dbhandler.inc.php';
?>

<?php // making home page dynamic
	
	// get the total number of questions

	$query = "SELECT * FROM questions;";
	$result = mysqli_query($conn, $query);
	$total = mysqli_num_rows($result);


?>

<!DOCTYPE html>
<html>
<head>
	<title>quiz !</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	
	<header>
		<div class="container">
			<h1>Quizzer</h1>
		</div>
	</header>

	<main>
		<div class="container">
			<h2>Test your web-development skills</h2>
			<p>This is Multiple choice quiz to test your skills</p>

			<ul>
				<li><strong>Number of questions : </strong>
					<?php echo $total; ?> <!-- total no of questions -->
				</li>
				<li><strong>Type : </strong>Multiple choice</li>
				<li><strong>Estimated time : </strong>
					<?php echo $total * .5; ?> Minutes
				</li>
				<!-- 30 seconds/ questions therefore Total questions * .5 -->
			</ul>

			<a href="question.php?n=1" class="start">Start now</a>

		</div>
	</main>

	<footer>
		<div class="container">
			Copyright &copy; 2019, Quizzer
		</div>
	</footer>

</body>
</html>