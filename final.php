<?php
	include 'includes/dbhandler.inc.php';
?>

<?php session_start(); ?>

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
			<h2>You're done</h2>
			<p>Congrats ! You have completed the test</p>
			<p>Final score : <?php echo $_SESSION['score']; ?></p>
			<a href="question.php?n=1" class="start">Take again</a>
		</div>
	</main>

	<footer>
		<div class="container">
			Copyright &copy; 2019, Quizzer
		</div>
	</footer>

</body>
</html>