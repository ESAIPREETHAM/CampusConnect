<!DOCTYPE html>
<html>
<head>
	<title>Job Application Form</title>
	<style>
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
		

		input[type="email"] {
			margin-top: 10px;
			padding: 10px;
			border: none;
			border-radius: 5px;
			box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
			width: 300px;
			max-width: 100%;
			font-size: 16px;
			font-family: Arial, sans-serif;
			outline: none;
		}

		input[type="submit"] {
			margin-top: 20px;
			padding: 10px;
			border: none;
			border-radius: 5px;
			background-color: #4CAF50;
			color: white;
			font-size: 16px;
			font-family: Arial, sans-serif;
			cursor: pointer;
			outline: none;
		}

		input[type="submit"]:hover {
			background-color: #3e8e41;
		}
        
	</style>
</head>
<!-- <div class="navigation">
    <h2>Navigation</h2>
    <a href="#" class="active">Update</a>
    <a href="Profile.php">About</a>
    <a href="#">Services</a>
    <a href="#">Contact</a>
    <a href="#">Update</a>
  </div> -->

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#myButton').click(function() {
        $.ajax({
            type: "POST",
            url: "your_php_script.php",
            data: { name: "John", location: "Boston" }
        }).done(function( msg ) {
            alert( "Data Saved: " + msg );
        });
    });
});
</script>






<?php
ini_set('display_errors','On');
session_start();    
// Retrieve the company email from the form
$comp_email = $_GET['Comp_email'];
$email = $_GET['email'];    


// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'CampusConnect');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve the company information from the database
$sql = "SELECT * FROM Companies WHERE Comp_email = '$comp_email'";
$result = mysqli_query($conn, $sql);
$sql = "SELECT RollNo FROM Student WHERE Email = '$email'";
$result_roll = mysqli_query($conn, $sql);

  $row1=mysqli_fetch_assoc($result_roll);
  $RollNo=$row1['RollNo'];

  $sql = "SELECT Company_ID FROM Companies WHERE Comp_email = '$comp_email'";
$result_comp_id = mysqli_query($conn, $sql);

  $row2=mysqli_fetch_assoc($result_comp_id);
  $Company_ID=$row2['Company_ID'];
 
  $cpi_taken = $_SESSION['cpi'];  
  $ctc = $_SESSION['ctc'];


if (mysqli_num_rows($result) > 0) {
    echo "<div class='container'style='margin-left:230px; padding:20px;'>";
    // Output the company information
    $row = mysqli_fetch_assoc($result);
    echo "<h1>{$row['Comp_Name']}</h1>";
    echo "<p>Email: {$row['Comp_email']}</p>";

    // Retrieve the job listings for the company
    $sql = "SELECT * FROM Job_Roles WHERE company_id = '{$row['Company_ID']}' AND Min_CPI <= $cpi_taken AND Job_Package >= $ctc";
    $result1 = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result1) > 0) {
        // Output the job listings
        echo "<ul>";
        while ($row = mysqli_fetch_assoc($result1)) {
            echo "<li>";
            echo "<h2>{$row['Role_Name']}</h2>";
            echo "<p>{$row['Job_Desc']}</p>";
            echo "<p>Requirements for minimum CPI: {$row['Min_CPI']}</p>";
            echo "<p>CTC: {$row['Job_Package']}</p>";
            echo "<p>Location: {$row['Job_MOI']},{$row['Job_DOI']}</p>";
            echo '
            <form method="POST" action="Processing_Stud_reg.php">
              <button name="submit" style="background-color: #ffffff;
                        color: #000000;
                        border: none;
                        border-radius: 20px;
                        padding: 15px 30px;
                        cursor: pointer;
                        transition: all 0.3s ease-in-out;
                        box-shadow: 0px 0px 10px rgba(154, 145, 136, 1);
                        margin_top:20px">Apply Now</button>
              <input type="hidden" name="RollNo" value="' . $RollNo . '">
              <input type="hidden" name="Company_ID" value="' . $Company_ID . '">
              <input type="hidden" name="Role_Name" value="' . $row['Role_Name'] . '">
              <input type="hidden" name="Job_DOI" value="' . $row['Job_DOI'] . '">
            </form>
            ';
            
            echo "</li>";
        }
        echo "</ul>";
        echo "</div>";

    } else {
        echo "<p>No job listings found.</p>";
    }
} else {
    echo "<p>Company not found.</p>";
    }
    
    mysqli_close($conn);
    ?>

<body>

	
</body>
</html>
