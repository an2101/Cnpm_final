<?php

class QuizUploader {
    private $con;
    private $message;

    public function __construct($con) {
        $this->con = $con;
        $this->message;
    }

    public function upload() {
        if (isset($_POST["upload"])) {
            if ($_FILES['question_file']['name']) {
                $filename = explode(".", $_FILES['question_file']['name']);
                if (end($filename) == "csv") {
                    // Lấy tên bảng từ form
                    $table_choice = isset($_POST['table_choice']) ? $_POST['table_choice'] : 'q2';
                    $quiz_code = mysqli_real_escape_string($this->con, $_POST['quiz_code']);
                    $quiz_time = (int) $_POST['quiz_time']; // Đảm bảo thời gian là kiểu số

                    // Xác định bảng code và time tương ứng với lựa chọn quiz
                    $code_table = "";
                    $time_table = "";
                    if ($table_choice == 'q2') {
                        $code_table = "code1";
                        $time_table = "time1";
                    } elseif ($table_choice == 'q3') {
                        $code_table = "code2";
                        $time_table = "time2";
                    } elseif ($table_choice == 'q4') {
                        $code_table = "code3";
                        $time_table = "time3";
                    }

                    // Lưu mã code và thời gian vào bảng tương ứng
                    mysqli_query($this->con, "INSERT INTO $code_table (code) VALUES ('$quiz_code')");
                    mysqli_query($this->con, "INSERT INTO $time_table (times) VALUES ('$quiz_time')");

                    // Xử lý file CSV và lưu vào bảng câu hỏi tương ứng
                    $handle = fopen($_FILES['question_file']['tmp_name'], "r");
                    while ($data = fgetcsv($handle)) {
                        $qno = mysqli_real_escape_string($this->con, $data[0]);
                        $ques = mysqli_real_escape_string($this->con, $data[1]);
                        $a = mysqli_real_escape_string($this->con, $data[2]);
                        $b = mysqli_real_escape_string($this->con, $data[3]);
                        $c = mysqli_real_escape_string($this->con, $data[4]);
                        $d = mysqli_real_escape_string($this->con, $data[5]);
                        $correct = mysqli_real_escape_string($this->con, $data[6]);

                        // Dùng biến $table_choice để chọn bảng câu hỏi
                        $query = "
                        INSERT INTO $table_choice
                        (question_no, question, a, b, c, d, correct_answer) VALUES ('$qno', '$ques', '$a', '$b', '$c', '$d', '$correct')";

                        if (!mysqli_query($this->con, $query)) {
                            $this->message = "Error: " . mysqli_error($this->con);
                        }
                    }
                    fclose($handle);
                    $this->message = "Complete uploaded";
                } else {
                    $this->message = "Select CSV files only";
                }
            } else {
                $this->message = "Select a file";
            }
        }
    }

    public function getMessage() {
        return $this->message;
    }
}

// Sử dụng class QuizUploader
$quizUploader = new QuizUploader($con);
$quizUploader->upload();
$message = $quizUploader->getMessage();

?>
