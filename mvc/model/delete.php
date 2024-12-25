<?php

class QuizModel
{
    private $conn;

    public function __construct($dbConnection)
    {
        $this->conn = $dbConnection;
    }

    public function truncateQuizResults($quizType)
    {
        // Truncate bảng tương ứng với quiz_type
        $query = "TRUNCATE TABLE `$quizType`";
        $result = mysqli_query($this->conn, $query);
        
        return $result;
    }
}
?>
