<?php
include '../model/admin_viewquestion.php';

class QuestionController {
    private $db;
    private $message;
    private $selectedQuiz;

    public function __construct() {
        $this->db = new Database();
        $this->message = "";
        $this->selectedQuiz = isset($_POST['quiz']) ? $_POST['quiz'] : 'q2';
    }

    public function handleRequest() {
        if (isset($_POST["truncate"])) {
            $this->deleteQuestions();
        }
    }

    private function deleteQuestions() {
        // Xóa câu hỏi
        if ($this->db->truncateTable($this->selectedQuiz)) {
            $this->message = "All questions from the selected quiz have been deleted.";
        } else {
            $this->message = "Error deleting questions.";
        }

        // Xóa bảng code và time tương ứng
        $codeTable = '';
        $timeTable = '';

        switch ($this->selectedQuiz) {
            case 'q2':
                $codeTable = 'code1';
                $timeTable = 'time1';
                break;
            case 'q3':
                $codeTable = 'code2';
                $timeTable = 'time2';
                break;
            case 'q4':
                $codeTable = 'code3';
                $timeTable = 'time3';
                break;
        }

        if ($codeTable && $timeTable) {
            if ($this->db->truncateTable($codeTable) && $this->db->truncateTable($timeTable)) {
                $this->message .= " Code and time data for the selected quiz have also been deleted.";
            } else {
                $this->message .= " Error deleting code and time data.";
            }
        }
    }

    public function getQuestions() {
        return $this->db->fetchQuestions($this->selectedQuiz);
    }

    public function getMessage() {
        return $this->message;
    }

    public function getSelectedQuiz() {
        return $this->selectedQuiz;
    }
}
?>
