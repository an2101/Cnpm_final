
<?php
session_start();
include '../model/student_checklogin.php';

class Controller {
    private $model;

    public function __construct() {
        $this->model = new Model();
    }

    // Xử lý đăng nhập và kiểm tra mã quiz
    public function handleLogin($name, $quiz_code) {
        // Kiểm tra người dùng có hợp lệ không
        $userCheck = $this->model->checkUserStatus($name);
        $userRow = mysqli_fetch_array($userCheck);

        // Kiểm tra mã quiz
        $quizCheck = $this->model->checkQuizCode($quiz_code);
        
        if (mysqli_num_rows($userCheck) == 1 && mysqli_num_rows($quizCheck) == 1) {
            $_SESSION['uname'] = $userRow['name'];
            $_SESSION['usn'] = $name;
            
            // Xử lý từng mã quiz và kiểm tra đã làm bài hay chưa
            if (mysqli_num_rows(mysqli_query($con, "SELECT * FROM code1 WHERE code = '$quiz_code'")) > 0) {
                $_SESSION['quiz'] = 'q2';
                $_SESSION['time'] = 'time1';
                $timeResult = $this->model->getTime('time1');
                $timeRow = mysqli_fetch_assoc($timeResult);
                $_SESSION['time_value'] = $timeRow['times'];
                $resultCheck = $this->model->checkResult($name, 'result');
            } elseif (mysqli_num_rows(mysqli_query($con, "SELECT * FROM code2 WHERE code = '$quiz_code'")) > 0) {
                $_SESSION['quiz'] = 'q3';
                $_SESSION['time'] = 'time2';
                $timeResult = $this->model->getTime('time2');
                $timeRow = mysqli_fetch_assoc($timeResult);
                $_SESSION['time_value'] = $timeRow['times'];
                $resultCheck = $this->model->checkResult($name, 'result2');
            } elseif (mysqli_num_rows(mysqli_query($con, "SELECT * FROM code3 WHERE code = '$quiz_code'")) > 0) {
                $_SESSION['quiz'] = 'q4';
                $_SESSION['time'] = 'time3';
                $timeResult = $this->model->getTime('time3');
                $timeRow = mysqli_fetch_assoc($timeResult);
                $_SESSION['time_value'] = $timeRow['times'];
                $resultCheck = $this->model->checkResult($name, 'result3');
            }

            if (mysqli_num_rows($resultCheck) > 0) {
                echo ("<script LANGUAGE='JavaScript'>
                    window.alert('You have already given the exam');
                    window.location.href='../../index.php';
                </script>");
            } else {
                header('location:../view/student_beforexam.php');
            }
        } else {
            echo ("<script LANGUAGE='JavaScript'>
                window.alert('You are not eligible or quiz code is invalid');
                window.location.href='../../index.php';
            </script>");
        }
    }
}
?>
