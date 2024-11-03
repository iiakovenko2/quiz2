<?php
session_start();
$name = $_POST['name'];
$score = 0;

// Check answers
if ($_POST['q1'] == 'Paris') {
    $score++;
}

// Database connection
$host = 'dpg-csjiiqjtq21c73dde410-a';
$dbname = 'quiz2_postgresql_imeda';
$username = 'quiz2_postgresql_imeda_user';
$password = 'Dw1EoJQz0wQUIW1UTFuYpC4lKotXDZH3';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare SQL statement
    $stmt = $pdo->prepare('INSERT INTO quiz_results (name, score) VALUES (:name, :score)');
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':score', $score);
    
    // Execute the statement
    if ($stmt->execute()) {
        echo "Thank you, $name! Your score is $score.";
    } else {
        echo "Error saving results.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
