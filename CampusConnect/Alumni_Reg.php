<?php
    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    // print_r($_SESSION['Email']);
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $name = $_POST['name'];
        $rollno = $_POST['rollno'];
        $email = $_SESSION['Email'];
        $batch = $_POST['batch'];
        $branch = $_POST['branch'];
        // $password = $_POST['password'];
        // $confirm_password = $_POST['password_confirmation'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];


        $_SESSION['rollno'] = $rollno;
        $_SESSION['batch'] = $batch;

        $conn = new mysqli('localhost', 'root', '', 'CampusConnect');

        if ($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }

    //     // if ($password != $confirm_password){
    //     //     die("Password and confirm password mismatched");
    //     // }

    //     // $password_hash = password_hash($password, PASSWORD_DEFAULT);


        $sql = "UPDATE Alumni SET Name = '$name', RollNo = '$rollno', branch = '$branch',batch = $batch, Dob = '$dob' WHERE Email = '$email'";
        $stmt = $conn->prepare($sql);

        if ($stmt->execute() === TRUE){
            header("Location: placementInfo.php");
            exit;
        } else{
            "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <title>Work Experience</title>
    <style>
    body {
    background-image: url('');
    background-size: cover;
    }
    /* CSS for the navigation bar */
    .navigation {
      position: fixed;
      top: 0;
      left: 0;
      height: 100%;
      width: 220px;
      background-color: #f2f2f2;
      overflow-x: hidden;
      padding-top: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .navigation a {
      display: block;
      padding: 16px;
      color: #333;
      text-decoration: none;
      transition: 0.3s;
      font-size: 18px;
      font-weight: bold;
      border-left: 5px solid transparent;
    }

    .navigation a:hover {
      background-color: #ddd;
      border-left: 5px solid #4caf50;
    }

    .navigation a.active {
      background-color: #4caf50;
      color: #fff;
      border-left: 5px solid #fff;
    }

    .navigation h2 {
      font-size: 24px;
      font-weight: bold;
      color: #333;
      text-align: center;
      margin-bottom: 20px;
    }
    </style>
</head>
<body>
    <div class="navigation">
        <h2>Navigation</h2>
        <a href="Alumni_profile.php">Profile</a>
        <a href="Alumni_Reg.php" class="active">Update Profile</a>
        <a href="updateInfo.php">Update Info</a>
        <a href="logout.php">Log Out</a>
    </div>
    <h1>Update Profile</h1>
	<form method="post" action="">
		<div>
			<label for="name">Name</label>
			<input type="text" id="name" name="name">
		</div>
        <div>
			<label for="rollno">Roll No</label>
			<input type="text" id="rollno" name="rollno">
		</div>
		<div>
			<label for="branch">Branch</label>
			<input type="text" id="branch" name="branch">
		</div>
        <div>
			<label for="batch">Batch</label>
            <select id="batch" name="batch" required>
                <option value="">Select an option</option>
                <option value="20">20</option>
                <option value="20">19</option>
                <option value="20">18</option>
                <option value="20">17</option>
                <option value="20">16</option>
            </select>
		</div>
        <div>
            <label for="dob">Date of Birth</label>
            <input type="date" id="dob" name="dob">
		</div>
        <div>
            <label for="gender">Gender</label>
            <select id="gender" name="gender" required>
                <option value="">Select an option</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
		</div>
		<button>Next</button>
	</form>
</body>
</html>