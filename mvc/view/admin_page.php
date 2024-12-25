<?php 
session_start();
if(!isset($_SESSION['admin'])){
    header('location:admin_login.php');
}
include('admin_header.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style type="text/css">
		html, body {
			height: 100%;
			margin: 0;
			background-color: #e0e0e0; /* Màu nền xám cho toàn bộ trang */
		}
		body {
			font-family: 'Arial', sans-serif;
		}
		input[type=text] {
			padding: 12px 7rem;
			margin: 8px 0;
			box-sizing: border-box;
			border: 2px solid #770DAB;
			border-radius: 8px;
		}
		.button {
			background-color: #770DAB; 
			color: white; 
			border: 2px solid #770DAB; 
			width: 20%;
			height: 2rem;
			padding: 1px 32px;
			border-radius: 8px;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			cursor: pointer;
		}
		.button2 {
			background-color: #C079E4; 
			color: black; 
			border: none; 
			width: 100%;
			height: 2.5rem; 
			padding: 1px 32px;
			border-radius: 8px; 
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			margin: 4px 0; 
			cursor: pointer;
			transition: background-color 0.3s, transform 0.2s; 
		}
		.button2:hover {
			background-color: #AC4FDA; 
			color: white;
			transform: scale(1.05); 
		}
		.button2.active {
			background-color: #AC4FDA; /* Màu khi nút được chọn */
			color: white;
			transform: scale(1.05); /* Giữ hiệu ứng phóng to */
		}
		.split {
			width: 20%;
			position: fixed;
			top: 48px; 
			bottom: 0;
			background-color: #BD93D2;
			overflow-y: auto; 
			padding: 20px; 
		}
		.main-content {
			margin-left: 20%; 
			padding-top: 60px; 
		}
	</style>
	<title>Admin Page</title>
</head>
<body onload="onload();">

<div class="split left">
	<div class="centered">
		<div style="text-align: center; margin-bottom: 10px;">
			<img src="../../assets/images/exam_page.png" alt="Logo" style="height: 90px;">
		</div>
		<button class="button2" id="button-upload" onclick="handleButtonClick('upload', this)">Upload Questions</button>
		<button class="button2" id="button-view" onclick="handleButtonClick('view', this)">View Questions</button>
		<button class="button2" id="button-result" onclick="handleButtonClick('result', this)">Result</button>
		<button class="button2" id="button-upload-student" onclick="handleButtonClick('upload_student', this)">Upload Student Details</button>
		<button class="button2" id="button-update-student" onclick="handleButtonClick('update_student', this)">Update Student Details</button>
		<button class="button2" id="button-student" onclick="handleButtonClick('student', this)">Student Details</button>
		<button class="button2" id="button-logout" onclick="handleButtonClick('logout', this)">Login Out</button>
	</div>
</div>

<div class="main-content">
    <center>
        <div id="iframeDisplay" style="padding-top: 1rem;"></div>
    </center>
</div>

<script>
	function handleButtonClick(action, button) {
		const buttons = document.querySelectorAll('.button2');
		buttons.forEach(btn => btn.classList.remove('active'));
		button.classList.add('active');

		switch (action) {
			case 'upload':
				displayIframe();
				break;
			case 'view':
				viewquestion();
				break;
			case 'result':
				result();
				break;
			case 'upload_student':
				upload();
				break;
			case 'update_student':
				updatestudent();
				break;
			case 'student':
				student();
				break;
			case 'logout':
				logout();
				break;
			default:
				break;
		}
	}
</script>

<?php 
include('../controller/admin_nav.php'); 
include('footer.php'); 
?>
</body>
</html>
