<?php include 'dbhandler.inc.php'; ?>

<?php session_start(); ?>

<?php

	// check if the score is set

	if(!isset($_SESSION['score']))
	{
		// set the score if score is not set
		
		$_SESSION['score']=0;
	}
 

	if($_POST)
	{
		// we want question no and selected choice

		$number = $_POST['number'];
		$selected_choice = $_POST['choice'];


		// get the next question number
		$next = $number + 1; // problem : ++ making number = 2


		// get the total questions

		$query = "SELECT * FROM questions;";
		$results = mysqli_query($conn, $query); /*or die(mysqli_error());*/
		$total = mysqli_num_rows($results);


		// get the correct choice
		$query = "SELECT * FROM choices WHERE question_number = $number AND is_correct = 1;";
		$result = mysqli_query($conn, $query); /*or die(mysqli_error());*/
		$row = mysqli_fetch_assoc($result);


		//set correct choice
		$correct_choice = $row['id'];


		// compare

		if($correct_choice == $selected_choice)
		{
			// answer is correct

			$_SESSION['score']+1;
		}

		
		// check if its the last question then we have to go to the final page

		if($number == $total)
		{
			header("Location: ../final.php?test=complete");
			exit();
		}

		else
		{
			// if its not the last question, redirect to the next question
			header("Location: ../question.php?n=".$next);			
		}

	}