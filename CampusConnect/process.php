<?php
 session_start();
 ini_set('display_errors', 'On');
  $host = "localhost";
  $username = "root";
  $password = "";
  $dbname = "CampusConnect";

  $conn = new mysqli(hostname : $host,
  username : $username,
  password : $password,
  database : $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
print_r($_POST);

// Prepare SQL statements for inserting data into Companies table and Job_Roles table
$insert_company_sql = 'UPDATE Companies SET Comp_Name = ?, Comp_Desc = ?, Comp_Loc = ?, Comp_Info = ? WHERE Company_ID =' . $_SESSION['Company_ID'];
$insert_job_sql = "INSERT INTO Job_Roles (Company_id, Role_Name, Job_Desc, Min_CPI, Job_Spec, Job_Dept, Job_MOI, Job_DOI, Job_Package)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Prepare and bind parameters for Companies table insert statement
$insert_company_stmt = $conn->prepare($insert_company_sql);
$insert_company_stmt->bind_param("sssi", $name, $description, $location, $info);

// Set parameter values from POST data
$name = $_POST['company_name'];
$email = $_POST['company_email'];
$password = "hi";
$description = $_POST['company_desc'];
$location = $_POST['company_address'];
$info = $_POST['company_phone'];

// Prepare and bind parameters for Job_Roles table insert statement
$insert_job_stmt = $conn->prepare($insert_job_sql);
$insert_job_stmt->bind_param("isssiisss", $company_id, $role_name, $job_description, $min_cpi, $job_spec, $job_department, $job_mode_of_interview, $job_date_of_interview, $job_package);
$role_name_str = 'role_name_';

// Insert data into Companies table
if ($insert_company_stmt->execute() === FALSE) {
    echo "Error inserting data into Companies table: " . $insert_company_stmt->error;
    exit();
  }
  
for ($x = 0; $x >= 0; $x++) {
    $temp = $role_name_str . (string)$x;
    if($_POST[$temp]==null){  
        break;
    }
$role_name = $_POST['role_name_'. (string)$x];
$job_description = $_POST['job_description_'. (string)$x];
$min_cpi = $_POST['min_cpi_'. (string)$x];
$job_spec = $_POST['job_spec_'. (string)$x];
$job_department = $_POST['job_department_'. (string)$x];
$job_mode_of_interview = $_POST['job_mode_of_interview_'. (string)$x];
$job_date_of_interview = $_POST['job_date_of_interview_'. (string)$x];
$job_package = $_POST['job_package_'. (string)$x];


  
  // Get ID of last inserted row in Companies table
  $company_id = $_SESSION['Company_ID'];
  
  // Insert data into Job_Roles table
  if ($insert_job_stmt->execute() === FALSE) {
    if($insert_company_stmt->execute()){
      echo "Updated the Company Information";
    }
    else{
    echo "Error inserting data into Job_Roles table: " . $insert_job_stmt->error;}
    header("Location : Profile.php");
    exit();
  }

  echo "The number is: $x <br>";
}




// Close database connection
$conn->close();

?> 