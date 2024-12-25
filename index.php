<?php 
include('mvc/view/student_header.php');
session_destroy(); 
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style type="text/css">
		body {
			font-family: 'Arial', sans-serif;
			background-color: #f4f4f9;
			margin: 0;
			padding: 0;
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100vh;
		}
		input[type=text], input[type=password] {
			padding: 12px 20px;
			margin: 8px 0;
			box-sizing: border-box;
			border: 2px solid #770DAB;
			border-radius: 8px;
			width: 100%;
			max-width: 300px;
			transition: border-color 0.3s;
		}
		input[type=text]:focus, input[type=password]:focus {
			border-color: #ff6f61;
			outline: none;
		}
		.main {
			padding: 16px;
		}
		.button {
			background-color: #770DAB;
			color: white;
			border: 2px solid #770DAB;
			width: 9rem;
			height: 2.5rem;
			padding: 10px;
			border-radius: 8px;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			margin: 10px 2px;
			cursor: pointer;
			transition: background-color 0.3s, transform 0.2s;
		}
		.button:hover {
			background-color: #ff6f61;
			transform: scale(1.05);
		}
		.container {
			background: white;
			padding: 2rem;
			border-radius: 10px;
			box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
			text-align: center;
		}
		.logo {
			margin-bottom: 20px;
		}
	</style>
	<title>Login</title>
</head>
<body>
	<div class="container">
		<img src="assets/images/exam.png" class="logo" style="height: 9rem;">
		<form action="mvc/model/student_checklogin.php" id="submited" method="post">
			<div><span id="display" style="color:#FF0000;font-size:15px"></span></div>
			<div>
				<input type="text" name="user" placeholder="Enter Your ID" required>
			</div>
			<div>
				<input type="text" name="quiz_code" placeholder="Enter Quiz Code" required>
			</div>
			<button type="submit" id="btn1" class="button">Login</button>
		</form>
	</div>
</body>
</html>
<?php 
include 'mvc/view/footer.php'; 
?>
