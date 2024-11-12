<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registered</title>
    <link rel="stylesheet" type="text/css" href="SRC.css">
</head>
<style>
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
      border-left: 5px #93a27a;
    }

    .navigation a.active {
      background-color:#555358;
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
        .container {
  width: 85%;
  margin: 0 auto;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
  background-image: url("pexels-matheus-viana-2414036.jpg");
  background-size: cover;
  background-repeat: no-repeat;
  background-color: rgba(202, 202, 202, 0.5); /* adjust the opacity here */
}


/* Hover effect */
.container:hover {
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4);
  transition: box-shadow 0.3s ease-in-out;
}

/* Job role details */
#job_roles {
  margin-top: 20px;
}

/* Remove job role button */
.remove_job_role {
  background-color: #ffffff;
  color: #000000;
  border: none;
  border-radius: 20px;
  padding: 15px 30px;
  cursor: pointer;
  transition: all 0.3s ease-in-out;
  box-shadow: 0px 0px 10px rgba(154, 145, 136, 1);
  
}

/* Remove job role button hover effect */
.remove_job_role:hover {
  background-color: #b71c1c;
  box-shadow: 0px 0px 10px rgb(184, 18, 18);
}

/* Form label */
label {
  display: block;
  font-size: 20px;
  font-weight: bold;
  margin-bottom: 10px;
  color: #000000;
}

/* Form input fields */
input[type="text"],
input[type="email"],
input[type="tel"],
input[type="number"],
input[type="date"],
textarea,
select {
  width: 98%;
  padding: 10px;
  margin-bottom: 20px;
  border: none;
  border-radius: 5px;
  font-size: 17px;
}

/* Form input fields focus */
input[type="text"]:focus,
input[type="email"]:focus,
input[type="tel"]:focus,
input[type="number"]:focus,
input[type="date"],
textarea:focus,
select:focus {
  outline: none;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

button[type="submit"] {
  background-color: #ffffff;
  color: #FFFFFF;
  border: none;
  border-radius: 20px;
  padding: 15px 30px;
  cursor: pointer;
  transition: all 0.3s ease-in-out;
  box-shadow: 0px 0px 10px rgba(255, 193, 7, 0.5);
}

button[type="submit"]:hover {
  background-color: #F44336;
  box-shadow: 0px 0px 20px rgba(244, 67, 54, 0.7);
}


/* Error message */
.error {
  color: #f44336;
  font-size: 14px;
  margin-top: 5px;
}

/* Success message */
.success {
  color: #4caf50;
  font-size: 14px;
  margin-top: 5px;
}
table {
    border-collapse: collapse;
    width: 100%;
    max-width: 1000px;
    margin: 20px auto;
    font-size: 16px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    background-color: rgba(255, 255, 255, 0.8); /* Set opacity to 0.8 */
    border-radius: 10px;
}

th, td {
    text-align: left;
    padding: 12px;
}

th {
    background-color: #5F6062;;
    color: #ffffff;
}

td {
    border-bottom: 1px solid #5F6062;; /* Add 'solid' to specify border style */
}


    /* Styling for form elements */
    label {
        display: block;
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 10px;
        color: #333333;
    }
    .center {
  text-align: center;
}

    </style>
<body>
<h1 class="center">Students Registered</h1>

<?php
  session_start();

  // Check if the user is logged in
  if (isset($_SESSION["Company_ID"])) {
    echo '<div class="navigation">';
  echo '<h2>Navigation</h2>';
  echo ' <a href="Profile.php?email=<?php echo $email; ?>" >Profile</a>';
  echo '<a href="company.php?email=<?php echo $email; ?>">Update</a>';
  echo '    <a href="SRC.php?email=<?php echo $email; ?>"class="active">Students Registered</a>';
  echo '<a href="AboutUs.php">About Us</a>';
  echo '<a href="logout.php">Log-Out</a>';
  echo '</div>';
  echo '<div class="container" style="margin-left: 230px; padding: 20px;">';
  
  // Your content here
  
  

    // Include the database configuration file
    require_once "config.php";

    // Get the Company_ID value from the session
    $company_id = $_SESSION["Company_ID"];

    $sql = "SELECT Student.Name, Student.CPI, Student.Sex,Job_DOI,Student.RollNo,Student.Email
        FROM Student
        INNER JOIN Student_Registrations ON Student.Email = Student_Registrations.Email
        WHERE Student_Registrations.Company_ID = $company_id";
        $result = $conn->query($sql);

        // Display the results in a table
        echo "<table>";
        echo "<thead><tr><th>Student Name</th><th>CPI</th><th>Gender</th><th>Date of Interview</th><th>Profile</th></tr></thead>";
        echo "<tbody>";
        while($row = $result->fetch_assoc()) {
            $beta = $row['Email'];
            echo "<tr><td>". $row["Name"] . "</td><td>" . $row["CPI"] . "</td><td>" . $row["Sex"] . "</td><td>" .$row['Job_DOI'] ."</td><td><a href='stud_profile.php?email=" . $beta . "'>Show Profile</a></td></tr>";        }
        echo "</tbody></table>";
        
        // Close the database connection
        $conn->close();
        echo '</div>';
    }
        ?>

</body>
</html>