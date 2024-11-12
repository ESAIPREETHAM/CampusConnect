<?php
session_start();
ini_set('display_errors','On');
// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'CampusConnect');

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Check if the form has been submitted
if (isset($_POST['submit'])) {
  
  $RollNo = $_SESSION['Email'];
  $Company_ID = $_POST['Company_ID'];
  $Role_Name = $_POST['Role_Name'];
  $Job_DOI = $_POST['Job_DOI'];


  $sql1 = "SELECT * FROM Student_Registrations where Email = '$RollNo' AND Company_id = '$Company_ID' AND job_roles_name = '$Role_Name' AND Job_DOI = '$Job_DOI' ";

  // Execute the query and store the results
  $result1 = mysqli_query($conn, $sql1);


if (mysqli_num_rows($result1) > 0) {
header("Location: stud_profile.php?email=<?php echo $RollNo; ?>");
echo "Duplicate Entry Found!! <br>";
}
else{

  // Insert the values into the database
  $sql = "INSERT INTO Student_Registrations (Email, Company_id, job_roles_name, Job_DOI) 
          VALUES ('$RollNo', '$Company_ID', '$Role_Name', '$Job_DOI')";
  if (mysqli_query($conn, $sql)) {
    // Redirect the user to a different page
    header("Location: stud_profile.php?email=<?php echo $RollNo; ?>");
    exit();
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
}
// Close the database connection
mysqli_close($conn);
?>