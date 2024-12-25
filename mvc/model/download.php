<?php
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

    public function numFields($result) {
        return mysqli_num_fields($result);
    }

    public function fetchRow($result) {
        return mysqli_fetch_row($result);
    }

    public function close() {
        mysqli_close($this->conn);
    }
}

class CSVExporter {
    private $database;
    private $quiz_type;

    public function __construct($database, $quiz_type = 'result') {
        $this->database = $database;
        $this->quiz_type = $quiz_type;
    }

    public function generateCSV() {
        $query = "SELECT 
                    r.si_no AS ID,
                    s.name AS Name,
                    r.correct_answers AS 'Correct',
                    r.attempted AS 'Total',
                    ROUND((r.correct_answers / r.attempted) * 10, 2) AS ResultOutOf10
                  FROM `$this->quiz_type` r
                  JOIN student s ON r.usn = s.usn";
        $result = $this->database->query($query);

        $num_column = $this->database->numFields($result);

        // Tạo tiêu đề CSV
        $csv_header = '"No","Name","Correct","Total","Result/10.00"' . "\n";
        
        // Tạo các hàng dữ liệu CSV
        $csv_row = '';
        while ($row = $this->database->fetchRow($result)) {
            for ($i = 0; $i < $num_column; $i++) {
                $csv_row .= '"' . str_replace('"', '""', $row[$i]) . '",';
            }
            $csv_row = rtrim($csv_row, ',') . "\n";
        }

        return $csv_header . $csv_row;
    }
}

// Kết nối cơ sở dữ liệu
$db = new Database("localhost", "root", "", "exam_onl3");

// Lấy giá trị quiz_type từ GET (nếu không có, mặc định là 'result')
$quiz_type = isset($_GET['quiz_type']) ? $_GET['quiz_type'] : 'result';

// Khởi tạo đối tượng CSVExporter
$csvExporter = new CSVExporter($db, $quiz_type);

// Thiết lập header để tải file CSV
header('Content-type: text/csv');
header('Content-Disposition: attachment; filename="' . $quiz_type . '_results.csv"');

// Xuất dữ liệu CSV
echo $csvExporter->generateCSV();

// Đóng kết nối
$db->close();
exit;
?>
