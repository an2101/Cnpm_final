<?php
session_start();
include '../../config.php';

class Quiz {
    private $con;
    private $name;
    private $quiz_code;
    private $rows;

    public function __construct($con, $name, $quiz_code) {
        $this->con = $con;
        $this->name = $name;
        $this->quiz_code = $quiz_code;
        $this->rows = $this->getUserData();
    }

    // Lấy thông tin người dùng
    private function getUserData() {
        $query = "SELECT * FROM student WHERE usn = '$this->name'";
        $result = mysqli_query($this->con, $query);
        return mysqli_fetch_array($result);
    }

    // Kiểm tra người dùng có tồn tại và có trạng thái 'present'
    private function isUserValid() {
        $query = "SELECT * FROM student WHERE usn = '$this->name' AND status = 'present'";
        $result = mysqli_query($this->con, $query);
        return mysqli_num_rows($result) == 1;
    }

    // Kiểm tra mã quiz có hợp lệ
    private function isQuizValid() {
        $quiz_query = "SELECT * FROM code1 WHERE code = '$this->quiz_code' 
                       UNION 
                       SELECT * FROM code2 WHERE code = '$this->quiz_code' 
                       UNION 
                       SELECT * FROM code3 WHERE code = '$this->quiz_code'";
        $quiz_result = mysqli_query($this->con, $quiz_query);
        return mysqli_num_rows($quiz_result) == 1;
    }

    // Kiểm tra người dùng đã làm bài kiểm tra chưa
    private function isExamTaken($table) {
        $query = "SELECT * FROM $table WHERE usn = '$this->name'";
        $result = mysqli_query($this->con, $query);
        return mysqli_num_rows($result) == 1;
    }

    // Lấy thời gian từ bảng thời gian tương ứng
    private function getTimeValue($time_table) {
        $query = "SELECT times FROM $time_table LIMIT 1";
        $result = mysqli_query($this->con, $query);
        $row = mysqli_fetch_assoc($result);
        return $row['times'];
    }

    // Lưu thông tin vào session
    private function setSession($quiz, $time_table) {
        $_SESSION['uname'] = $this->rows['name'];
        $_SESSION['usn'] = $this->name;
        $_SESSION['quiz'] = $quiz;
        $_SESSION['time'] = $time_table;
        $_SESSION['time_value'] = $this->getTimeValue($time_table);
    }

    // Xử lý logic để xác thực người dùng và chuyển hướng
    public function handleQuiz() {
        if ($this->isUserValid() && $this->isQuizValid()) {
            if (mysqli_num_rows(mysqli_query($this->con, "SELECT * FROM code1 WHERE code = '$this->quiz_code'")) > 0) {
                $this->setSession('q2', 'time1');
                if ($this->isExamTaken('result')) {
                    $this->showAlertAndRedirect('You have already given the exam');
                } else {
                    header('location:../view/student_beforexam.php');
                }
            } elseif (mysqli_num_rows(mysqli_query($this->con, "SELECT * FROM code2 WHERE code = '$this->quiz_code'")) > 0) {
                $this->setSession('q3', 'time2');
                if ($this->isExamTaken('result2')) {
                    $this->showAlertAndRedirect('You have already given the exam');
                } else {
                    header('location:../view/student_beforexam.php');
                }
            } elseif (mysqli_num_rows(mysqli_query($this->con, "SELECT * FROM code3 WHERE code = '$this->quiz_code'")) > 0) {
                $this->setSession('q4', 'time3');
                if ($this->isExamTaken('result3')) {
                    $this->showAlertAndRedirect('You have already given the exam');
                } else {
                    header('location:../view/student_beforexam.php');
                }
            }
        } else {
            $this->showAlertAndRedirect('You are not eligible or quiz code is invalid');
        }
    }

    // Hiển thị thông báo và chuyển hướng
    private function showAlertAndRedirect($message) {
        echo ("<script LANGUAGE='JavaScript'>
                window.alert('$message');
                window.location.href='../../index.php';
              </script>");
    }
}

$quiz = new Quiz($con, $_POST['user'], $_POST['quiz_code']);
$quiz->handleQuiz();
?>
