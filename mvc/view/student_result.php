<?php
session_start();

if (!isset($_SESSION['usn']) || !isset($_SESSION['quiz_result'])) {
    header('location:../../index.php');
}

// Lấy kết quả từ session
$totalQuestions = $_SESSION['quiz_result']['totalQuestions'];
$correctAnswers = $_SESSION['quiz_result']['correctAnswers'];
$score = $_SESSION['quiz_result']['score'];

// Xóa dữ liệu kết quả để tránh hiện lại khi refresh
unset($_SESSION['quiz_result']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .result-container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 90%;
            max-width: 400px;
        }
        .result-container h3 {
            color: #770DAB;
            margin-bottom: 20px;
        }
        .result-container p {
            font-size: 1.2rem;
            color: #333;
            margin: 10px 0;
        }
        .exit-button {
            background-color: #770DAB;
            color: white;
            padding: 10px 20px;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .exit-button:hover {
            background-color: #C079E4;
        }
    </style>
</head>
<body>
    <div class='result-container'>
        <h3>Your Quiz Results</h3>
        <p>Total Questions: <?= $totalQuestions ?></p>
        <p>Correct Answers: <?= $correctAnswers ?></p>
        <p>Score: <?= $score ?>/10</p>
        <form method="post" action="../controller/destroy.php">
            <button type="submit" class="exit-button">Exit</button>
        </form>
    </div>
</body>
</html>
