<?php
session_start();
$name = $_POST['name'];
$score = 0;

// Check answers
if ($_POST['q1'] == 'Paris') {
    $score++;
}

// More answer checks here

// Display the score to the student
echo "Thank you, $name! Your score is $score.";

// Update database connection details


