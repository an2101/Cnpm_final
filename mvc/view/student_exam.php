<?php 
session_start(); 

if(!isset($_SESSION['usn'])){
    header('location:../../index.php');
}
?>

<?php 
include('student_header2.php'); 
include '../../config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Quiz</title>
    <style>
        /* General styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #f4f4f9;
            color: #333;
        }
        h3, h4 {
            color: #770DAB;
        }

        /* Sticky warning bar */
        .warning-bar {
            width: 100%;
            background-color: #DBAEF1;
            padding: 10px 0;
            text-align: center;
            position: sticky;
            top: 0;
            border-bottom: 2px solid #8C5EA4;
        }
        
        /* Countdown Timer */
        #display {
            color: #FF0000;
            font-size: 1.5rem;
            position: fixed;
            top: 60px;
            right: 10px;
        }

        /* Quiz container */
        .quiz-container {
            width: 90%;
            max-width: 800px;
            background-color: #fff;
            margin-top: 20px;
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Question and options */
        .question {
            font-size: 1.2rem;
            margin-bottom: 1rem;
            color: #333;
        }
        .options {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .options input[type="radio"] {
            margin-right: 10px;
        }

        /* Button styling */
        .button {
            background-color: #770DAB;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
        }
        .button:hover {
            background-color: #C079E4;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.6);
        }
        .modal-content {
            background-color: #fff;
            margin: auto;
            padding: 20px;
            border-radius: 8px;
            width: 90%;
            max-width: 500px;
            text-align: center;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover, .close:focus {
            color: black;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="warning-bar">
    <marquee><h3>Warning: Do not switch tabs or windows; doing so will submit the quiz immediately.</h3></marquee>
</div>

<div id="display"></div>

<script>
    // Countdown timer script
    const display = document.getElementById('display');
    // Get the countdown duration from session (PHP)
    let countdownDuration = <?php echo isset($_SESSION['time_value']) ? $_SESSION['time_value'] : 1800; ?>; // Default 30 minutes
    function CountDown(duration) {
        let timer = duration, minutes, seconds;
        const interval = setInterval(() => {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);
            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;
            display.innerHTML = `<b>${minutes}m : ${seconds}s</b>`;
            if (--timer < 0) {
                clearInterval(interval);
                document.getElementById('btnSubmit').click();
            }
        }, 1000);
    }
    CountDown(countdownDuration*60);
</script>

<center>
    <form action="../model/check_result.php" method="post" id="quizForm" class="quiz-container">
        <?php 
        // Get the quiz type from session (q2, q3, or q4)
        $quizType = isset($_SESSION['quiz']) ? $_SESSION['quiz'] : 'q2';
        $q = "SELECT * FROM `$quizType` ORDER BY RAND() LIMIT 50";
            $result = mysqli_query($con, $q);
            $i = 1;
            $questions = [];

            while ($rows = mysqli_fetch_array($result)) {
                $questions[] = $rows[0];
                echo "<div class='question'><b>Q{$i}. {$rows[1]}</b></div>";
                echo "<div class='options'>";
                echo "<label><input type='radio' name='anscheck[{$rows[0]}]' value='a'> {$rows[2]}</label>";
                echo "<label><input type='radio' name='anscheck[{$rows[0]}]' value='b'> {$rows[3]}</label>";
                echo "<label><input type='radio' name='anscheck[{$rows[0]}]' value='c'> {$rows[4]}</label>";
                echo "<label><input type='radio' name='anscheck[{$rows[0]}]' value='d'> {$rows[5]}</label>";
                echo "</div><hr>";
                $i++;
            }

            $_SESSION['name'] = $questions;
        ?>
        <button type="submit" id="btnSubmit" name="submit" class="button">Submit Quiz</button>
    </form>
</center>

<!-- Modal for quiz instructions -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h4>Welcome to the Quiz</h4>
        <p>Please do not navigate away from this window during the quiz.</p>
        <button class="button" onclick="closeModal()">Proceed to Quiz</button>
    </div>
</div>

<script>
    // Modal control
    const modal = document.getElementById("myModal");
    const span = document.getElementsByClassName("close")[0];
    window.onload = () => { modal.style.display = "block"; };
    span.onclick = () => { modal.style.display = "none"; };
    function closeModal() { modal.style.display = "none"; }
</script>

<?php include('../controller/autosubmit.php'); ?>
</body>
</html>
