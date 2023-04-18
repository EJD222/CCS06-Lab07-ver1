<?php
require "vendor/autoload.php";

// 1. What does this function session_start() do to the application?
/* The session_start() function either creates or restarts an existing session. 
   The session that was created can be used to save and retrieve information from the user. */

session_start();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register</title>
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">

	<style>
		* {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
        }

		body {
			background-color: #F7F7F7;
		}

		.maincontainer {
			display: flex;
            justify-content: center; 
            align-items: center; 
            height: 100vh;
		}

		.registrationcontainer {
			background-color: #fff;
			border-radius: 8px;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.04);
			padding: 32px;
			width: 550px;
		}

		.registrationcontainer h1 {
			font-size: 28px;
			font-weight: 600;
			margin-bottom: 16px;
			text-align: center;
		}

		.instructions {
			margin-bottom: 16px;
			text-align: center;
		}
		
		form {
			display: flex;
			flex-direction: column;
		}

		form label {
			font-size: 15px;
			font-weight: 500;
			color: #374151;
		}

		form input[type="email"], form input[type="text"]{
			border: none;
			border-radius: 4px;
			padding: 12px;
			font-size: 15px;
			margin-bottom: 16px;
			background-color: #F4F5F7;
			color: #374151;
			box-sizing: border-box;
			width: 100%;
			margin-top: 6px;
		}

		form input[type="date"] {
			border: none;
			border-radius: 4px;
			padding: 12px;
			font-size: 15px;
			margin-bottom: 10px;
			background-color: #F4F5F7;
			color: #374151;
			box-sizing: border-box;
			width: 100%;
			margin-top: 6px;
		}

		form button {
			background-color: #4CAF50;
			color: #FFFFFF;
			font-size: 16px;
			font-weight: 500;
			border: none;
			border-radius: 4px;
			padding: 12px;
			box-sizing: border-box;
			width: 100%;
		}

		form button:hover {
			background-color: #3E8E41;
        }
	</style>

</head>
<body>
<div class="maincontainer">
	<div class="registrationcontainer">
		<h1>Analogy Exam Registration</h1>
		<p class="instructions">Kindly register your basic information before starting the exam.</p>

		<form method="POST" action="register.php">
			<p>
				<label>Enter your Full Name:</label>
				<input type="text" name="complete_name" placeholder="Full Name" required />
				<br />
				<label>Email Address:</label>
				<input type="email" name="email" placeholder="Email Address" required/>
				<br />
				<label>Birthdate:</label>
				<input type="date" name="birthdate" value="01-01-01"/> <br />
				<br />  
				<button type="submit" class="registerbtn">Register</button>
			</p>
		</form>
	</div>
</div>
</body>
</html>

<!-- DEBUG MODE
<pre>
<?php
// var_dump($_SESSION);
?>
</pre>
-->