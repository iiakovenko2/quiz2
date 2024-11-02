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
try {
    $pdo = new PDO('mysql:host=localhost;dbname=quiz2_db', 'root', ''); // Ensure these details are correct
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Store the results in a database
    $stmt = $pdo->prepare('INSERT INTO quiz_results (name, score) VALUES (:name, :score)');
    $stmt->execute(['name' => $name, 'score' => $score]);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
