<?php
ini_set('display_errors','On');
session_start();
$email = $_SESSION['Email'];

if(isset($_SESSION['Email']))
{
if (true)
    {     print_r($email); 
$conn=new mysqli('localhost','root','','CampusConnect');
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
print_r($_SESSION);
$name = $_POST['name'];
// $age = $_POST['age'];
$gender = $_POST['gender'];
$tenth_marks = $_POST['tenth_marks'];
$twelfth_marks = $_POST['twelfth_marks'];
$cpi = $_POST['cpi'];
$sex = $_POST['sex'];
$roll = $_POST['roll'];
$specialization = $_POST['specialization'];
$AOF = $_POST['field_to_work'];
$Dob=$_POST['datepicker'];
$RollNo=$_POST['roll'];
$_SESSION['cpi']=$cpi;
$ctc = $_POST['Placed'];
$_SESSION['ctc']=$ctc;
print_r($_POST);
$sql = "UPDATE Student SET Name='$name',10th='$tenth_marks',RollNo='$roll',12th='$twelfth_marks',CPI='$cpi',DOB='$Dob',PhoneNo='$sex',Sex='$gender',Specialization='$specialization', Area_of_interest='$AOF',CTC =$ctc WHERE Email='$email'";
$conn->query($sql);

if (mysqli_query($conn, $sql)) {
   echo "hi";
   print($_SESSION);
} else {
   echo "Error updating user: " . mysqli_error($conn);
}
    }
  }
  else{
    header('Location : temp.php');
  }

?>