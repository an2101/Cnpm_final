<?php
class CSVUploader
{
    private $conn;
    private $file;

    public function __construct($dbConnection, $file)
    {
        $this->conn = $dbConnection;
        $this->file = $file;
    }

    public function handleUpload()
    {
        if ($this->file['name']) {
            $filename = explode(".", $this->file['name']);
            if (end($filename) === "csv") {
                $this->processCSV();
            } else {
                // Logic để xử lý khi file không phải CSV
                // echo "Select CSV only";
            }
        } else {
            // Logic để xử lý khi không có file
            // echo "Select a file";
        }
    }

    private function processCSV()
    {
        $handle = fopen($this->file['tmp_name'], "r");
        while ($data = fgetcsv($handle)) {
            $qno = mysqli_real_escape_string($this->conn, $data[0]);
            $ques = mysqli_real_escape_string($this->conn, $data[1]);
            $a = mysqli_real_escape_string($this->conn, $data[2]);
            $b = mysqli_real_escape_string($this->conn, $data[3]);

            $query = "INSERT INTO student (si_no, usn, name, status) VALUES ('$qno', '$ques', '$a', '$b')";
            mysqli_query($this->conn, $query);
        }
        fclose($handle);
    }
}

// Khởi tạo và xử lý upload
if (isset($_POST["upload"])) {
    include '../../config.php'; // Kết nối cơ sở dữ liệu
    $uploader = new CSVUploader($con, $_FILES['question_file']); // Tạo đối tượng
    $uploader->handleUpload(); // Gọi phương thức xử lý upload
}
?>
