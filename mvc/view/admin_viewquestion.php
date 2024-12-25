<?php
include '../controller/admin_viewquestion_nav.php';

$controller = new QuestionController();
$controller->handleRequest();

$message = $controller->getMessage();
$selectedQuiz = $controller->getSelectedQuiz();
$questions = $controller->getQuestions();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Question Management</title>
    <style type="text/css">
        /* CSS styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            height: 100vh;
            overflow: hidden;
        }
        h1 {
            color: #770DAB;
            text-align: center;
            margin-bottom: 20px;
        }
        .container {
            max-width: 800px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            overflow-y: auto;
            max-height: 70vh;
        }
        .question {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #CE92EC;
            border-radius: 8px;
            background-color: #E0CBEB;
        }
        .answer-options {
            margin: 10px 0;
            padding-left: 20px;
        }
        .div1 {
            margin: 10px 0;
            font-weight: bold;
        }
        .button {
            background-color: #770DAB;
            color: white;
            border: none;
            width: 100%;
            height: 2.5rem;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 20px;
        }
        .button:hover {
            background-color: #C079E4;
        }
        .message {
            color: red;
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .select-container {
            margin-bottom: 20px;
            text-align: center;
        }
        .select-container select {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Question Management</h1>

    <?php if ($message): ?>
        <div class="message"><?= $message ?></div>
    <?php endif; ?>

    <form action="#" method="post">
        <div class="select-container">
            <label for="quiz">Select Quiz:</label>
            <select id="quiz" name="quiz" onchange="this.form.submit()">
                <option value="q2" <?= $selectedQuiz == 'q2' ? 'selected' : '' ?>>Quiz 1</option>
                <option value="q3" <?= $selectedQuiz == 'q3' ? 'selected' : '' ?>>Quiz 2</option>
                <option value="q4" <?= $selectedQuiz == 'q4' ? 'selected' : '' ?>>Quiz 3</option>
            </select>
        </div>

        <?php 
        $i = 1;
        while ($rows = mysqli_fetch_array($questions)): 
        ?>
            <div class="question">
                <div class="div1">Q. (<?= $i ?>) <?= $rows['question'] ?></div>
                <div class="answer-options">
                    <input type="radio" value="a" name="anscheck[<?= $rows['question_no']; ?>]"><?= $rows['a'] ?><br>
                    <input type="radio" value="b" name="anscheck[<?= $rows['question_no']; ?>]"><?= $rows['b'] ?><br>
                    <input type="radio" value="c" name="anscheck[<?= $rows['question_no']; ?>]"><?= $rows['c'] ?><br>
                    <input type="radio" value="d" name="anscheck[<?= $rows['question_no']; ?>]"><?= $rows['d'] ?>
                </div>
                <div class="div1">Correct Answer: <?= $rows['correct_answer'] ?></div>
            </div>
        <?php 
            $i++;
        endwhile; 
        ?>
        
        <button name="truncate" class="button">Delete All Questions in Selected Quiz</button>
    </form>
</div>

</body>
</html>
