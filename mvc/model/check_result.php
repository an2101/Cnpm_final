<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
class Auth {
    public static function checkSession() {
        if (!isset($_SESSION['usn'])) {
            header('location:../../index.php');
            exit();
        }

        if (!isset($_SESSION['name'])) {
            header('location:../controller/default.php');
            exit();
        }
    }
}

// Kết nối cơ sở dữ liệu
class Database {
    private $conn;

    public function __construct($host, $username, $password, $dbname) {
        $this->conn = mysqli_connect($host, $username, $password, $dbname);
        if (mysqli_connect_errno()) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function query($query) {
        return mysqli_query($this->conn, $query);
    }

    public function fetchAssoc($result) {
        return mysqli_fetch_assoc($result);
    }

    public function close() {
        mysqli_close($this->conn);
    }
}

// Xử lý quiz và điểm số
class Quiz {
    private $db;
    private $usn;
    private $quiz_table;
    private $answers;
    private $totalQuestions;
    private $correctAnswers = 0;

    public function __construct($db, $usn, $quiz_table, $answers) {
        $this->db = $db;
        $this->usn = $usn;
        $this->quiz_table = $quiz_table;
        $this->answers = $answers;
    }

    public function calculateScore() {
        // Truy vấn số lượng câu hỏi trong bảng câu hỏi
        $query = "SELECT COUNT(*) AS total FROM $this->quiz_table";
        $result = $this->db->query($query);
        $row = $this->db->fetchAssoc($result);

        $this->totalQuestions = $row['total'];

        // Duyệt qua các câu hỏi và kiểm tra đáp án
        foreach ($_SESSION['name'] as $questionNo) {
            $query = "SELECT correct_answer FROM $this->quiz_table WHERE question_no='$questionNo'";
            $result = $this->db->query($query);
            $row = $this->db->fetchAssoc($result);

            if (isset($this->answers[$questionNo]) && $row['correct_answer'] === $this->answers[$questionNo]) {
                $this->correctAnswers++;
            }
        }
    }

    public function saveResults() {
        // Lưu kết quả vào bảng tương ứng
        $results = "";
        if ($_SESSION['quiz'] == 'q2') {
            $results = "INSERT INTO result (usn, attempted, correct_answers) VALUES ('$this->usn', '$this->totalQuestions', '$this->correctAnswers')";
        } elseif ($_SESSION['quiz'] == 'q3') {
            $results = "INSERT INTO result2 (usn, attempted, correct_answers) VALUES ('$this->usn', '$this->totalQuestions', '$this->correctAnswers')";
        } elseif ($_SESSION['quiz'] == 'q4') {
            $results = "INSERT INTO result3 (usn, attempted, correct_answers) VALUES ('$this->usn', '$this->totalQuestions', '$this->correctAnswers')";
        }

        $this->db->query($results);
    }

    public function calculateScoreOutOf10() {
        if ($this->totalQuestions == 0) {
            return 0;  // Nếu không có câu trả lời, điểm = 0
        } else {
            return round(($this->correctAnswers / $this->totalQuestions) * 10, 2);
        }
    }

    public function saveSessionResult($score_out_of_10) {
        $_SESSION['quiz_result'] = [
            'totalQuestions' => $this->totalQuestions,
            'correctAnswers' => $this->correctAnswers,
            'score' => number_format($score_out_of_10, 2), // Định dạng điểm thành "X.00"
        ];
    }
}

// Kiểm tra phiên đăng nhập
Auth::checkSession();

// Lấy thông tin từ session và form
$usn = $_SESSION['usn'];
include('../../config.php');

$answers = isset($_POST['anscheck']) && !empty($_POST['anscheck']) ? $_POST['anscheck'] : [];

// Lấy bảng quiz từ session
$quiz_table = $_SESSION['quiz'];

// Khởi tạo đối tượng Database
$db = new Database("localhost", "root", "", "exam_onl3");

// Khởi tạo đối tượng Quiz và tính điểm
$quiz = new Quiz($db, $usn, $quiz_table, $answers);
$quiz->calculateScore();
$quiz->saveResults();
$score_out_of_10 = $quiz->calculateScoreOutOf10();

// Lưu kết quả vào session
$quiz->saveSessionResult($score_out_of_10);

// Đóng kết nối cơ sở dữ liệu
$db->close();

// Chuyển hướng đến giao diện kết quả
header('location:../view/student_result.php');
exit();
?>
