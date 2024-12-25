<?php 
include '../controller/admin_session.php';
include '../../config.php';

// Lấy quiz type từ GET (nếu có)
$quiz_type = isset($_GET['quiz_type']) ? $_GET['quiz_type'] : 'result'; // Mặc định là bảng result

// Truy vấn kết quả từ bảng tương ứng và kết hợp với bảng student để lấy tên
$q = "
    SELECT 
        r.si_no AS ID,
        s.name AS Name,
        r.attempted AS 'Questions Attempted',
        r.correct_answers AS 'Correct Answers',
        CONCAT(r.correct_answers, '/', r.attempted) AS 'Correct/Total',
        ROUND((r.correct_answers / r.attempted) * 10, 2) AS ResultOutOf10
    FROM `$quiz_type` r
    JOIN student s ON r.usn = s.usn
";
$result = mysqli_query($con, $q);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Results Management</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #770DAB;
            text-align: center;
            margin-bottom: 20px;
        }
        .button {
            background-color: #770DAB; 
            color: white; 
            border: none; 
            width: 15rem;
            height: 2.5rem;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin: 10px 0;
        }
        .button:hover {
            background-color: #C37BE7;
        }
        .container {
            width: 90%;
            max-width: 800px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 15px;
            text-align: center;
        }
        th {
            background-color: #770DAB;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .confirmation {
            color: #d9534f;
            font-weight: bold;
        }

        /* Thêm khoảng cách giữa form select và container */
        form {
            margin-bottom: 0.5cm; /* Khoảng cách dưới form chọn quiz type */
        }
    </style>
</head>
<body>

<h1>Results Management</h1>

<!-- Form để chọn quiz và tự động thay đổi kết quả khi chọn -->
<form action="" method="GET" onchange="this.submit()">
    <label for="quiz_type">Select Quiz Type:</label>
    <input type="radio" name="quiz_type" value="result" id="quiz2" <?= ($quiz_type == 'result') ? 'checked' : ''; ?>>
    <label for="quiz2">Quiz 1</label>
    <input type="radio" name="quiz_type" value="result2" id="quiz3" <?= ($quiz_type == 'result2') ? 'checked' : ''; ?>>
    <label for="quiz3">Quiz 2</label>
    <input type="radio" name="quiz_type" value="result3" id="quiz4" <?= ($quiz_type == 'result3') ? 'checked' : ''; ?>>
    <label for="quiz4">Quiz 3</label>
</form>

<div class="container">
    <center>
        <a href="../model/download.php?quiz_type=<?= $quiz_type ?>"> <!-- Chuyển quiz_type vào link download -->
            <button class="button">Download Results</button>
        </a>
        <a href="../controller/delete_nav.php?quiz_type=<?= $quiz_type ?>" onclick="return confirm('Are you sure you want to delete all results?');">
            <button class="button">Delete All Results</button>
        </a>
    </center>

    <table>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Correct/Total</th>
            <th>Result/10.00</th>
        </tr>
        <?php while ($rows = mysqli_fetch_array($result)): ?>
            <tr>
                <td><?= $rows['ID'] ?></td>
                <td><?= $rows['Name'] ?></td>
                <td><?= $rows['Correct/Total'] ?></td>
                <td><?= number_format($rows['ResultOutOf10'], 2) ?>/10.00</td> <!-- Hiển thị điểm với định dạng "X.00/10.00" -->
            </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>
