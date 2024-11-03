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
    // Use the JawsDB URL for the database connection
    $url = getenv("JAWSDB_URL");

    if ($url) {
        $dbparts = parse_url($url);

        $host = $dbparts["host"];
        $dbname = ltrim($dbparts["path"], '/');
        $username = $dbparts["user"];
        $password = $dbparts["pass"];

        // Create a new PDO instance
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Store the results in the database
        $stmt = $pdo->prepare('INSERT INTO quiz_results (name, score) VALUES (:name, :score)');
        $stmt->execute(['name' => $name, 'score' => $score]);
    } else {
        echo "JawsDB URL not found.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

