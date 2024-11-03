<?php
session_start();

// Retrieve user input from the form
$name = $_POST['name'];
$score = 0;

// Check answers (modify these according to your actual question logic)
if ($_POST['q1'] == 'Paris') {
    $score++;
}
// Add more checks for other questions here

// Database connection details
try {
    // Replace these values with your actual database connection details
    $host = 'dpg-csjiiqjtq21c73dde410-a';
    $dbname = 'quiz2_postgresql_imeda';
    $username = 'quiz2_postgresql_imeda_user';
    $password = 'Dw1EoJQz0wQUIW1UTFuYpC4lKotXDZH3';

    // Create a new PDO instance for PostgreSQL
    $pdo = new PDO("pgsql:host=$host;port=5432;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Insert the results into the database
    $stmt = $pdo->prepare('INSERT INTO quiz_results (name, score) VALUES (:name, :score)');
    $stmt->execute(['name' => $name, 'score' => $score]);

    // Display the score to the user
    echo "Thank you, $name! Your score is $score.";
} catch (PDOException $e) {
    // Handle connection errors
    echo "Database error: " . $e->getMessage();
}
?>
