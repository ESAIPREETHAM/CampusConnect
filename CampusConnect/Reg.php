<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Signup Page</title>
    <link rel="stylesheet" href="Reg.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<?php
ini_set('display_errors', 'On');
if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $form = $_POST['form'];
  
  if ($form === 'form1') {
    $radioValue = $_POST['user-type'];
    if($radioValue=="student")
    {
        $age = $_POST['Email'];
        $password = $_POST['Password'];
        if ( empty($age) || empty($password)) {
            echo 'Please fill all fields.';
          }
          else{
                $conn=new mysqli('localhost','root','','CampusConnect');
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            $sql = "SELECT * FROM Student WHERE Email='$age' AND Password='$password'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    session_start();
    session_regenerate_id();
    $_SESSION['Email']= $_POST['Email'];
    // Login successful, redirect to dashboard
    header('Location: StudentUpdate.php');
    exit;
  } else {
    // Login failed, display error message
    echo 'Invalid username or password.';
  }
  $conn->close();

          }


    }
    if($radioValue=="company")
    {
        $age = $_POST['Email'];
        $password = $_POST['Password'];
        if ( empty($age) || empty($password)) {
            echo 'Please fill all fields.';
          }
          else{
                $conn=new mysqli('localhost','root','','CampusConnect');
            if ($conn->connect_error) {
                die("Connection failed: " . mysqli_connect_error());
            }
            $sql = "SELECT * FROM Companies WHERE Comp_email='$age' AND Comp_password='$password'";
  $result = $conn->query($sql);
  $id_sql = "SELECT Company_ID FROM Companies WHERE Comp_email='$age' AND Comp_password='$password'";
  $id_result = $conn->query($id_sql);
  $ans = $id_result->fetch_assoc();

  if ($result->num_rows > 0) {
    session_start();
              
              session_regenerate_id();
              
              $_SESSION["company_email"] = $age;
              $_SESSION["Company_ID"] = $ans["Company_ID"];

              
              header("Location: company.php");
              exit;
    
    
  } else {
    // Login failed, display error message
    echo 'Invalid username or password.';
  }
  $conn->close();

          }
}
    if($radioValue=="alumni")
    {
        $age = $_POST['Email'];
        $password = $_POST['Password'];
        if ( empty($age) || empty($password)) {
            echo 'Please fill all fields.';
          }
          else{
                $conn=new mysqli('localhost','root','','CampusConnect');
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            $sql = "SELECT * FROM Alumni WHERE Email='$age' AND Password='$password'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    session_start();
    session_regenerate_id();
    $_SESSION['Email']= $_POST['Email'];
    // Login successful, redirect to dashboard
    header('Location: Alumni_Reg.php');
    exit;
  } else {
    // Login failed, display error message
    echo 'Invalid username or password.';
  }
  $conn->close();

          }
        
    }


    if($radioValue=="admin")
    {
        $age = $_POST['Email'];
        $password = $_POST['Password'];
        if ( empty($age) || empty($password)) {
            echo 'Please fill all fields.';
          }
          else{
                $conn=new mysqli('localhost','root','','CampusConnect');
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            $sql = "SELECT * FROM admin WHERE Email='$age' AND Password='$password'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    session_start();
    session_regenerate_id();
    $_SESSION['Email']= $_POST['Email'];
    // Login successful, redirect to dashboard
    header('Location: home.php');
    exit;
  } else {
    // Login failed, display error message
    echo 'Invalid username or password.';
  }
  $conn->close();

          }
        
    }

     
  } elseif ($form === 'form2') {
    $radioValue = $_POST['user-type'];
    if($radioValue=="student")
    {
        
        $age = $_POST['Email'];
        $password = $_POST['Password'];
        $conf_pass = $_POST['Conf'];
        if ( empty($age) || empty($password) || empty($conf_pass)) {
            echo 'Please fill all fields.';
          }
          elseif ($password !== $conf_pass) {
            echo 'Passwords do not match.';
          }
          elseif (!is_password_strong($password)) {
            echo 'Password is not strong enough.';
          }
          else {
                $conn=new mysqli('localhost','root','','CampusConnect');
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $sql = "INSERT INTO Student ( Email, Password) VALUES ( '$age', '$password')";
            if ($conn->query($sql) === TRUE) {
              echo 'User created successfully.';
            } else {
              echo 'Error creating user: ' . $conn->error;
            }
            $conn->close();
          }
    }
    if($radioValue=="company")
    {
       
        $age = $_POST['Email'];
        $password = $_POST['Password'];
        $conf_pass = $_POST['Conf'];
        if ( empty($age) || empty($password) || empty($conf_pass)) {
            echo 'Please fill all fields.';
          }
          elseif ($password !== $conf_pass) {
            echo 'Passwords do not match.';
          }
          elseif (!is_password_strong($password)) {
            echo 'Password is not strong enough.';
          }
          else {
                $conn=new mysqli('localhost','root','','CampusConnect');
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $sql = "INSERT INTO Companies ( Comp_email, Comp_password) VALUES ( '$age', '$password')";
            if ($conn->query($sql) === TRUE) {
              echo 'User created successfully.';
            } else {
              echo 'Error creating user: ' . $conn->error;
            }
            $conn->close();
          }
    }
    if($radioValue=="alumni")
    {
        
        $age = $_POST['Email'];
        $password = $_POST['Password'];
        $conf_pass = $_POST['Conf'];
        if ( empty($age) || empty($password) || empty($conf_pass)) {
            echo 'Please fill all fields.';
          }
          elseif ($password !== $conf_pass) {
            echo 'Passwords do not match.';
          }
          elseif (!is_password_strong($password)) {
            echo 'Password is not strong enough.';
          }
          else {
                $conn=new mysqli('localhost','root','','CampusConnect');
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $sql = "INSERT INTO Alumni ( Email, Password) VALUES ( '$age', '$password')";
            if ($conn->query($sql) === TRUE) {
              echo 'User created successfully.';
            } else {
              echo 'Error creating user: ' . $conn->error;
            }
            $conn->close();
          }
    }


   } else {
    // Error: Unknown form submitted
  }
}

function is_password_strong($password) {
    // Define criteria for strong password
    $min_length = 8;
    $contains_uppercase = preg_match('/[A-Z]/', $password);
    $contains_lowercase = preg_match('/[a-z]/', $password);
    $contains_number = preg_match('/\d/', $password);
    $contains_special_char = preg_match('/[^a-zA-Z\d]/', $password);
    
    // Check if password meets criteria
    if (strlen($password) < $min_length || !$contains_uppercase || !$contains_lowercase || !$contains_number || !$contains_special_char) {
      return false;
    }
    return true;
  }
       



?>


<body>

    <div class="header2">
        <h1 class="title">Training and Placement Cell IIT-P</h1>
    </div>
    <!-- Rest of the code goes here -->



<div class="container">
    <header>
        <div class="logo">
            <img src="2.png" alt="Logo">
        </div>
        <nav>
            <ul>
                <li><a href="https://www.iitp.ac.in"><b>IIT Patna Main Page</b></a></li>
                <li><a href="yearStats.php"><b>Statistics</b></a></li>
                <!-- <li><a href="#">Contact</a></li> -->
            </ul>
        </nav>
    </header>

    

    <div class="form-container">
    <div class="form-wrapper">
        <div class="form login-form">
            <h2>Login</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <input type="hidden" name="form" value="form1">
           
                <input name="Email" type="email" placeholder="Email">
                <input name="Password" type="password" placeholder="Password">
                
                <div class="radio-buttons">
                    <label>
                        <input type="radio" name="user-type" value="student" checked>
                    Student
                    </label>
                    <label>
                        <input type="radio" name="user-type" value="company">
                         Company
                    </label>
                    <label>
                        <input type="radio" name="user-type" value="alumni" checked>
                    Alumni
                    </label>
                    <label>
                        <input type="radio" name="user-type" value="admin" checked>
                    Admin
                    </label>
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
            <p>Don't have an account? <span class="switch-form">Sign up</span></p>
        </div>
        <div class="form signup-form">
            <h2>Sign Up</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <input type="hidden" name="form" value="form2">
                
                <input name="Email" type="email" placeholder="Email">
                <input name="Password" type="password" placeholder="Password">
                <input name="Conf" type="password" placeholder="Confirm Password">
                <div class="radio-buttons">
                    <label>
                        <input type="radio" name="user-type" value="student" checked>
                    Student
                    </label>
                    <label>
                        <input type="radio" name="user-type" value="company">
                         Company
                    </label>
                    <label>
                        <input type="radio" name="user-type" value="alumni" checked>
                    Alumni
                    </label>
                </div>
                <button type="submit" class="btn">Sign up</button>
            </form>
            <p>Already have an account? <span class="switch-form">Login</span></p>
        </div>
    </div>
</div>




<script src="Reg.js"></script>


<section class="about-us-container">
  <h4>About Us</h4>
  <b>
  <p>Welcome to the Placement Cell Portal for the Indian Institute of Technology Patna (IITP)!</p>
		<p>We are committed to providing a convenient and effective platform for our students, alumni, and companies to connect and facilitate the recruitment process. Our goal is to help our students and alumni secure rewarding careers and assist companies in finding the best talent to meet their hiring needs.</p></section>
</b>
</body>
</html>