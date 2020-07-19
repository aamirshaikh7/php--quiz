<?php
	include 'includes/dbhandler.inc.php';
?>

<?php

// check if submit button is iset ?

	if(isset($_POST['submit']))
	{
		// get POST variables

		$question_number = $_POST['question_number'];
		$question_text = $_POST['question_text'];
		$correct_choice = $_POST['correct_choice'];

		// create an array for choices

		$choices = array(); // initializing array
		$choices[1] = $_POST['choice1'];
		$choices[2] = $_POST['choice2'];
		$choices[3] = $_POST['choice3'];
		$choices[4] = $_POST['choice4'];
		$choices[5] = $_POST['choice5'];

		// questions table query


		$query = "INSERT INTO questions (question_number, text) 
					VALUES ('$question_number', '$question_text');";
		$questionResult = mysqli_query($conn, $query);

		// validate insert

		if($questionResult) // if $questionResult is successful
		{	
			//                  key[?]  value : whatever user submits
			foreach($choices as $choice => $value)
			{
				// check for empty field

				if(!empty($value))
				{
					// check if its the right answer ?

					if($correct_choice == $choice)
					{
						$is_correct = 1;
					}

					else
					{
						$is_correct = 0;
					}

					// choice table query

					$query = "INSERT INTO choices (question_number, is_correct, text)
						VALUES ('$question_number', '$is_correct', 
								'$value');";
					$choiceResult = mysqli_query($conn, $query);

					// validate insert

					if($choiceResult) // if $choiceResult is successful
					{
						continue;
					}

					else // if theres a problem
					{
						header("Location: admin.php?choiceResult=failed");
						exit();
					}

				}

			}

			$msg = "Your questions have been added successfully !";
			header("Location: admin.php?questions=success");
			exit();

		}

	}	

	// automatically adding question number on admin page ny $totalQues + 1

	$query = "SELECT * FROM questions;";
	$resultQues = mysqli_query($conn, $query);
	$totalQues = mysqli_num_rows($resultQues);
	$nextQues = $totalQues + 1;

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
			<h2>Add a question</h2>

			<!-- if $msg variable is set then output that "success" message -->

			<?php

				if(isset($msg))
				{
					echo '<p>.$msg.</p>';
				}

			?>

			<form method="POST" action="admin.php">

				<p>
					<label>Question number : </label>
					<input type="number" name="question_number"
					value="<?php echo $nextQues ?>">
				</p>

				<p>
					<label>Question Text : </label>
					<input type="text" name="question_text">
				</p>

				<!-- 5 choices -->

				<p>
					<label>Choice #1 : </label>
					<input type="text" name="choice1">
				</p>

				<p>
					<label>Choice #2 : </label>
					<input type="text" name="choice2">
				</p>

				<p>
					<label>Choice #3 : </label>
					<input type="text" name="choice3">
				</p>

				<p>
					<label>Choice #4 : </label>
					<input type="text" name="choice4">
				</p>

				<p>
					<label>Choice #5 : </label>
					<input type="text" name="choice5">
				</p>

				<!-- correct choice -->

				<p>
					<label>Correct choice number : </label>
					<input type="number" name="correct_choice">
				</p>

				<p>
					<button type="submit" name="submit">Submit</button>
				</p>

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