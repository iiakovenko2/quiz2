<?php
session_start();
$name = $_POST['name'];
$score = 0;

// Check answers
if ($_POST['q1'] == 'Paris') {
    $score++;
}

// More answer checks here (you can continue adding conditions for other questions)

// Display the score to the student
echo "Thank you, $name! Your score is $score.";

// Database connection details
try {
    // Replace these with your actual database connection details
    $pdo = new PDO('pgsql:host=dpg-csjiiqjtq21c73dde410-a;dbname=quiz2_postgresql_imeda', 'quiz2_postgresql_imeda_user', 'Dw1EoJQz0wQUIW1UTFuYpC4lKotXDZH3');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare an SQL statement for inserting the score
    $stmt = $pdo->prepare('INSERT INTO quiz_results (name, score) VALUES (:name, :score)');

    // Bind parameters
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':score', $score);

    // Execute the prepared statement
    $stmt->execute();

    echo "Your score has been recorded in the database.";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>



