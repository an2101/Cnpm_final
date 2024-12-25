<?php

class Database {
    private $con;

    public function __construct($host = 'localhost', $user = 'root', $pass = '', $db = 'exam_onl3') {
        $this->con = mysqli_connect($host, $user, $pass, $db);
        if (mysqli_connect_error()) {
            die('Connection failed: ' . mysqli_connect_error());
        }
    }

    public function truncateTable($table) {
        $query = "TRUNCATE TABLE $table";
        return mysqli_query($this->con, $query);
    }

    public function fetchQuestions($quiz) {
        $query = "SELECT * FROM `$quiz`";
        return mysqli_query($this->con, $query);
    }

    public function getConnection() {
        return $this->con;
    }
}
?>
