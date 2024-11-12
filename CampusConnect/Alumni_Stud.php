<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
  width: 90%;
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
    </style>
</head>
<body>
<div class="navigation" >
    <h2>Navigation</h2>
    <a href="stud_profile.php?email=<?php echo $email; ?>">Profile</a>
    <a href="StudentUpdate.php?email=<?php echo $email; ?>">Update</a>
    
    <a href="Company_To_Apply.php?email=<?php echo $email; ?>">Companies</a>
    <a href="Alumni_Stud.php?email=<?php echo $email; ?>" class = "active">Alumni</a>
    
    <a href="AboutUs.php">About Us</a>
    <a href="logout.php">Log-Out</a>
  </div>

    <div class= "container" style = "  margin-left: 230px;
  padding: 20px;">
    

<?php
ini_set('display_erros','On');
            session_start();
            $host = "localhost";
            $username = "root";
            $password = "";
            $database = "CampusConnect";
            $conn = mysqli_connect($host, $username, $password, $database);
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

$sql = "SELECT distinct rollno FROM alumni_experience  ";
            $result = mysqli_query($conn, $sql);

            // Display the results in a table
            // while ($row = mysqli_fetch_assoc($result)) {
            //     $beta = $row['rollno'];
            // $sql1 = "SELECT * FROM alumni_experience natural join Alumni where rollno = '$beta' ";
            // $result1 = mysqli_query($conn, $sql1);
            // // print_r($result1);
            // while ($row1 = mysqli_fetch_assoc($result1)) {
            //     echo "<tr>";
            //     echo "<td>" . $row1["company_name"] . "</td>";
            //     echo "<td>" . $row1["job_role"] . "</td>";
            //     echo "<td>" . $row1["job_desc"] . "</td>";
            //     echo "<td>" . $row1["batch"] . "</td>";
            //     echo "<td>" . $row1["gender"] . "</td>";
            //     echo "<td>" . $row1["branch"] . "</td>";
            //     echo "<td>" . $row1["ctc"] . "</td>";
            //     echo "<td>" . $row1["start_date"] . "</td>";
            //     echo "<td>" . $row1["end_date"] . "</td>";          
            //     echo "<td>" . $row1["Email"] . "</td>";                                                                                                                                                                  
            //     echo "</tr>";
            // }
            // }
            echo '<form method="post">';
            echo '<table>';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Student Name</th>';
            echo '<th>Company Placed</th>';
            echo '<th>Job Role</th>';
            echo '<th>Job Description</th>';
            echo '<th>Batch</th>';
            echo '<th>Gender</th>';
            echo '<th>Branch</th>';
            echo '<th>CTC</th>';
            echo '<th>Start Date</th>';
            echo '<th>End Date</th>';
            echo '<th>Contact Info</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            
            while ($row = mysqli_fetch_assoc($result)) {
                $beta = $row['rollno'];
                $sql1 = "SELECT * FROM alumni_experience natural join Alumni where rollno = '$beta' ";
                $result1 = mysqli_query($conn, $sql1);
                while ($row1 = mysqli_fetch_assoc($result1)) {
                    echo '<tr>';
                    echo '<td>' . $row1['Name'] . '</td>';
                    echo '<td>' . $row1['company_name'] . '</td>';
                    echo '<td>' . $row1['job_role'] . '</td>';
                    echo '<td>' . $row1['job_desc'] . '</td>';
                    echo '<td>' . $row1['batch'] . '</td>';
                    echo '<td>' . $row1['gender'] . '</td>';
                    echo '<td>' . $row1['branch'] . '</td>';
                    echo '<td>' . $row1['ctc'] . '</td>';
                    echo '<td>' . $row1['start_date'] . '</td>';
                    echo '<td>' . $row1['end_date'] . '</td>';
                    echo '<td>' . $row1['Email'] . '</td>';
                    echo '</tr>';
                }
            }
            
            echo '</tbody>';
            echo '</table>';
            echo '</form>';




            mysqli_close($conn);
            ?>
            </div>
            
</body>
</html>