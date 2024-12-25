<?php

class StudentModel
{
    private $conn;

    public function __construct($dbConnection)
    {
        $this->conn = $dbConnection;
    }

    public function truncateStudentTable()
    {
        $query = "TRUNCATE TABLE `student`";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }
}
?>
