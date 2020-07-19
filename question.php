<?php session_start(); ?>

<?php
	include 'includes/dbhandler.inc.php';
?>

<?php  //results coming directly from the database

	// question table
	// get the question number
	$number = (int) $_GET['n'];


	// get the total questions

	$query = "SELECT * FROM questions;";
	$results = mysqli_query($conn, $query); /* or die(mysqli_error()); */
	$total = mysqli_num_rows($results);


	// get the question

	$query = "SELECT * FROM questions WHERE question_number = $number;";

	// get result

	$resultQuestion = mysqli_query($conn, $query);
	$rowQuestion = mysqli_fetch_assoc($resultQuestion);


	// choices table
	// get the choices
	$query = "SELECT * FROM choices WHERE question_number = $number;";

	// get results

	$resultChoices = mysqli_query($conn, $query);
/* not using here  $rowChoices = mysqli_fetch_assoc($resultChoices);*/
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
			<div class="current">

				Question <?php echo $rowQuestion['question_number']; ?>
				of <?php echo $total; ?></div>

			<p class="question">
				<?php echo $rowQuestion['text']; ?>
			</p>

			<form method="POST" action="includes/process.inc.php">

				<ul class="choices">

					<?php while($row = mysqli_fetch_assoc($resultChoices)) 
						  {
					?>

					<li><input type="radio" name="choice"
						value="<?php echo $row['id'];?>">
						<?php echo $row['text']; ?> <!-- choices -->
					</li>

					<?php } ?>

				</ul>

				<button type="submit">submit</button>

				<!-- create hidden input -->

				<input type="hidden" name="number" value="<?php echo$number; ?>">

			</form>

		</div>
	</main>

	<footer>
		<div class="container">
			Copyright &copy; 2019, Quizzer
		</div>
	</footer>

</body>
</html>