<!DOCTYPE html>
<html>
<head>
    <title>Student Profile</title>
    <style>
   body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }





   /* Styling for the container */
   .container {
        width: 85%;
        margin: 20px auto;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        background-image: url("pexels-matheus-viana-2414036.jpg");
        background-size: cover;
        background-repeat: no-repeat;
        background-color: rgba(202, 202, 202, 0.5);
    }

    .container:hover {
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4);
        transition: box-shadow 0.3s ease-in-out;
    }

    /* Styling for the table */
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




/* Error message */

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
        

    .label {
font-size: 20px; /* decrease font size /
line-height: 30px; / increase line height */
}

.value {
font-size: 20px; /* decrease font size /
line-height: 30px; / increase line height */
}


        .error {
            color: red;
            margin-bottom: 10px;
        }

        .link {
            color: blue;
            text-decoration: none;
        }

        .link:hover {
            color: red;
        }
    </style>
</head>
<body>
<div class="navigation" >
    <h2>Navigation</h2>
    <a href="stud_profile.php?email=<?php echo $email; ?>" class="active">Profile</a>
    <a href="StudentUpdate.php?email=<?php echo $email; ?>">Update</a>
    
    <a href="Company_To_Apply.php?email=<?php echo $email; ?>">Companies</a>
    <a href="Alumni_Stud.php?email=<?php echo $email; ?>">Alumni</a>
    
    <a href="AboutUs.php">About Us</a>
    <a href="logout.php">Log-Out</a>
  </div>
    <div class="container" style = "margin-left: 230px;
  padding: 20px;">
        <?php 
            //Start session
            session_start();
            ini_set('display_errors', 'On');
            //Check if student is logged in
            if (isset($_SESSION['Email'])||isset($_GET['email'])) {
                $email = $_SESSION['Email'];
                if($email==null){
                  $email = $_GET['email'];
                }
                //Connect to database
                $conn=new mysqli('localhost','root','','CampusConnect');

                //Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                //Query database to retrieve student details based on email
                $sql = "SELECT * FROM Student WHERE Email='$email'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) == 1) {
                    $student = mysqli_fetch_assoc($result);
                    // $batch_year = int(substr($student['RollNo'],0,2));
                    //Retrieve current year
                    $current_year = date("Y");
                    $alpha = "20". substr($student['RollNo'], 0, 2);
                    //Retrieve first two characters of RollNo from $student array and convert to integer
                    $rollno_year = intval($alpha);
                    //Calculate difference between $rollno_year and $current_year
                    $year_diff = $current_year - $rollno_year+1;
                    $sql = "SELECT RollNo FROM Student WHERE Email = '$email'";
                    $result_roll = mysqli_query($conn, $sql);
                    $_SESSION['cpi']=$student['CPI'];
                    $_SESSION['ctc']=$student['CTC'];
                     $row1=mysqli_fetch_assoc($result_roll);
                    $RollNo=$row1['RollNo'];
                    $hemlo = "'";
                                  //Display year difference as string
                    echo "<h1>Welcome, <i>".$student['Name']."</i></h1>";
                    echo "<div>";
                    echo "<span class='label'><b>Roll No : </b></span><span class='value'>".$student['RollNo']."</span>";
                    echo "</div>";
                    echo "<div>";
                    echo "<span class='label'><b>Name :</b> </span><span class='value'>".$student['Name']."</span>";
                    echo "</div>";
                    echo "<div>";
                    echo "<span class='label'><b>10th Class Marks(in %) :</b> </span><span class='value'>".$student['10th']."</span>";
                    echo "</div>";
                    echo "<div>";
                    echo "<span class='label'><b>12th Class Marks(in %): </b></span><span class='value'>".$student['12th']."</span>";
                    echo "</div>";
                    echo "<div>";
                    echo "<span class='label'><b>CPI : </b></span><span class='value'>".$student['CPI']."</span>";
                    echo "</div>";
                    echo "<div>";
                    echo "<span class='label'><b>Date of Birth :</b> </span><span class='value'>".$student['DOB']."</span>";
                    echo "</div>";
                    echo "<div>";
                    if($student['CTC']){
                    echo "<span class='label'><b>Already Placed</b> <br><b>Current CTC :</b> </span><span class='value'>".$student['CTC']."</span>";}
                    else{
                      echo "<span class='label'><b>Not Placed</b></span><span class='value'></span>";}
                    echo "</div>";
                    echo "<div>";
                    echo "<span class='label'></span><span class='value'><a href ='".$student['resume']."'>Resume Link</a></span>";
                    echo "</div>";
                    echo "<div>";
                    echo "<span class='label'></span><span class='value'><a href ='".$student['transcript']."'>Transcript Link</a></span>";
                    echo "</div>";

                    if($year_diff==1){echo "<div><span class='label'>Batch Year:</span><span class='value'>".$year_diff."st year</span></div>";}}
                    else if($year_diff==2)  
                    {echo "<div><span class='label'>Batch Year:</span><span class='value'>".$year_diff."nd year</span></div>";}
                    $rollno = $student['RollNo'];


                    $query = "SELECT Company_id,job_roles_name FROM Student_Registrations WHERE Email = '$email'";
                    $result = mysqli_query($conn, $query);
                    

                    if (mysqli_num_rows($result) > 0) {
                      echo "<table>";
                      echo "<tr><th>Job Role</th><th>Company Name</th><th>Job Description</th><th>Minimum CPI</th><th>Job Specification</th><th>Job Department</th><th>Mode of Interview</th><th>Date of Interview</th><th>Job Package</th></tr>";
                  
                      while ($row = mysqli_fetch_assoc($result)) {
                          $company_id = $row['Company_id'];
                          $query1 = "SELECT Comp_Name FROM Companies WHERE Company_ID = '$company_id'";
                          $result1 = mysqli_query($conn, $query1);
                          $row2 = mysqli_fetch_assoc($result1);
                  
                          $job_role = $row['job_roles_name'];
                          $query2 = "SELECT Job_Desc,Min_CPI,Job_Spec,Job_Dept,Job_MOI,Job_DOI,Job_Package FROM Job_Roles WHERE Company_id = '$company_id' and Role_Name = '$job_role' ";
                          $result2 = mysqli_query($conn, $query2);
                          $row3 = mysqli_fetch_assoc($result2);
                  
                          echo "<tr>";
                          echo "<td>".$job_role."</td>";
                          echo "<td>".$row2['Comp_Name']."</td>";
                          echo "<td>".$row3['Job_Desc']."</td>";
                          echo "<td>".$row3['Min_CPI']."</td>";
                          echo "<td>".$row3['Job_Spec']."</td>";
                          echo "<td>".$row3['Job_Dept']."</td>";
                          echo "<td>".$row3['Job_MOI']."</td>";
                          echo "<td>".$row3['Job_DOI']."</td>";
                          echo "<td>".$row3['Job_Package']."</td>";
                          echo "</tr>";
                      }
                  
                      echo "</table>";
                  }
                    

                }
                    ?>
                    </div>
                </body>
                </html>                