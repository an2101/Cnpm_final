<?php
class AdminModel {
    private $con;

    public function __construct($dbConnection) {
        $this->con = $dbConnection;
    }

    public function authenticate($name, $pass) {
        $query = "SELECT * FROM admin WHERE user_id = ? AND password = ?";
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("ss", $name, $pass);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function getUserDetails($name) {
        $query = "SELECT * FROM admin WHERE user_id = ?";
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_array();
    }
}
