<!DOCTYPE html>
<html>
<head>
<style>
		body {
			background-image: url('');
			background-repeat: no-repeat;
			background-size: cover;
		}
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
	</style>
<link rel="stylesheet" type="text/css" href="Student_Update.css">
<meta charset="UTF-8">
  <title>Update Information</title>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
  <!-- <link rel="stylesheet" href="Student_Update_Date.css"> -->
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
  <script>
    $( function() {
      $( "#datepicker" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd/mm/yy'
      });
    } );
  </script>
</head>
<?php
ini_set('display_errors','On');
session_start();
$email = $_SESSION['Email'];

if(isset($_SESSION['Email']))
{
if ($_SERVER["REQUEST_METHOD"] == "POST")
    {

$conn=new mysqli('localhost','root','','CampusConnect');
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
// print_r($_SESSION);
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
$transcript = $_POST['transcript'];
$resume = $_POST['resume1'];
print_r($_POST);
$sql = "UPDATE Student SET resume = '$resume' , transcript = '$transcript',Name='$name',10th='$tenth_marks',RollNo='$roll',12th='$twelfth_marks',CPI='$cpi',DOB='$Dob',PhoneNo='$sex',Sex='$gender',Specialization='$specialization', Area_of_interest='$AOF', CTC =$ctc WHERE Email='$email'";
$conn->query($sql);

if (mysqli_query($conn, $sql)) {
   echo "User Updated Sucessfully.";
  //  print($_SESSION);
} else {
   echo "Error updating user: " . mysqli_error($conn);
}
    }
  }
  else{
    header('Location : temp.php');
  }

?>

<body>
  <title>Update User</title>
  <div class="navigation">
    <h2>Navigation</h2>
    <a href="stud_profile.php?email=<?php echo $email; ?>">Profile</a>
    <a href="StudentUpdate.php?email=<?php echo $email; ?>" class="active">Update</a>
    <a href="Company_To_Apply.php?email=<?php echo $email; ?>">Companies</a>
    <a href="Alumni_Stud.php?email=<?php echo $email; ?>">Alumni</a>
    
    <a href="AboutUs.php">About Us</a>
    <a href="logout.php">Log-Out</a>
  </div>
  <div class="container" style='margin-left:260px; padding:20px;'>
  <form action="" method="POST">

  <input type="text" name="name" placeholder="Name">
  <input type="text" name="roll" placeholder="Roll Number">
  <!-- <input type="number" name="age" placeholder="Age"> -->
  <input type="text" name="gender" placeholder="Gender">
  <input type="number" step="0.01" name="sex" placeholder="Contact Number">
  <!-- <input type="text" step="0.01" name="resume" placeholder="Drive Link to Resume"> -->
	<input type="date" id="datepicker" name="datepicker" placeholder="Date Of Birth">
  <input type="text" name="transcript" placeholder="Enter the link of your transcript">
  <input type="text" name="resume1" placeholder="Enter the link of your Resume">
    <input type="number" step="0.01" name="tenth_marks" placeholder="10th Marks">
  <input type="number" step="0.01" name="twelfth_marks" placeholder="12th Marks">
  <input type="number" step="0.01" name="cpi" placeholder="CPI">
  <input type="text" name="specialization" placeholder="Specialization">
  <input type="number" name="Placed" placeholder="Are you placed? If yes, write your Current CTC ">
  <!-- <input type="text" name="area_of_interest" placeholder="Area of Interest"> -->
  <select name="field_to_work" id = "field_to_work" required>
    <option value="">Select Field to Work In</option>
    <?php
    $conn = new mysqli('localhost', 'root', '', 'CampusConnect');
                    if ($conn->connect_error){
                        die("Connection failed: " . $conn->connect_error);
                    }
                    $sql = "select distinct Role_Name from Job_Roles";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['Role_Name'] . '">' . $row['Role_Name'] . '</option>';
                    }
                ?>
  </select>
  <input type="submit" value="Submit" style="background-color: #000000;
  color: #ffffff;
  border: none;
  border-radius: 30px;
  padding: 15px 30px;
  cursor: pointer;
  transition: all 0.3s ease-in-out;
  box-shadow: 0px 0px 10px rgba(154, 145, 136, 1);
  margin_top:20px">
</form>
</div>
</link>

</body>
</html>
