<?php

class StudentModel
{
    private $conn;

    public function __construct($dbConnection)
    {
        $this->conn = $dbConnection;
    }

    public function updateStudentStatus($usn, $status)
    {
        $query = "UPDATE student SET status='$status' WHERE usn='$usn'";
        return mysqli_query($this->conn, $query);
    }
}
?>
