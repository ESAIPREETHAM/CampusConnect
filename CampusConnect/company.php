<?php 
session_start();
if (isset($_SESSION['user_id'])) {
    
    require_once "config.php";
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
    
    $sql = "SELECT * FROM Companies
            WHERE id = {$_SESSION["Comp_email"]}";
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Company Registration Form</title>
  <link rel="stylesheet" type="text/css" href="company.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      var i = 1;
      $("#add_job_role").click(function() {
        $("#job_roles").append('<div id="job_role_' + i + '">' +
          '<h3>Job Role Details</h3>' +
          '<table>' +
          '<tr><td><strong>Role Name:</strong></td><td><input type="text" name="role_name_' + i + '" placeholder="Role Name" required></td></tr>' +
          '<tr><td><strong>Job Description:</strong></td><td><textarea name="job_description_' + i + '" placeholder="Job Description" required></textarea></td></tr>' +
          '<tr><td><strong>Minimum CPI:</strong></td><td><input type="number" name="min_cpi_' + i + '" placeholder="Minimum CPI" required></td></tr>' +
          '<tr><td><strong>Job Specification:</strong></td><td><select name="job_spec_' + i + '" required>' +
          '<option value="" disabled selected>Select Job Specification</option>' +
          '<option value="Web Development">Web Development</option>' +
          '<option value="Android Development">Android Development</option>' +
          '<option value="Block-Chain">Block-Chain</option>' +
          '<option value="Machine Learning">Machine Learning</option>' +
          '<option value="Quant Computing">Quant Computing</option>' +
          '</select></td></tr>' +
          '<tr><td><strong>Job Department:</strong></td><td><input type="text" name="job_department_' + i + '" placeholder="Job Department" required></td></tr>' +
          '<tr><td><strong>Mode of Interview:</strong></td><td><input type="text" name="job_mode_of_interview_' + i + '" placeholder="Mode of Interview" required></td></tr>' +
          '<tr><td><strong>Date of Interview:</strong></td><td><input type="date" name="job_date_of_interview_' + i + '" placeholder="Date of Interview" required></td></tr>' +
          '<tr><td><strong>Job Package:</strong></td><td><input type="number" name="job_package_' + i + '" placeholder="Job Package" required></td></tr>' +
          '</table>' +
          '<button type="button"  class="remove_job_role" data-id="' + i + '">Remove Job Role</button>' +
          '</div>');
        i++;
      });
      $(document).on("click", ".remove_job_role", function() {
        var id = $(this).data("id");
        $("#job_role_" + id).remove();
      });
    });
    const cpiInput = document.getElementById('min_cpi_0');

cpiInput.addEventListener('input', () => {
  if (cpiInput.value < 0) {
    cpiInput.value = 0;
  } else if (cpiInput.value > 10) {
    cpiInput.value = 10;
  }
});
  </script>

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
  

</style>
</head>
<body>
  
<div class="navigation">
  <h2>Navigation</h2>
  <a href="Profile.php?email=<?php echo $email; ?>" >Profile</a>
  <a href="company.php?email=<?php echo $email; ?>"class="active">Update</a>
  <a href="SRC.php?email=<?php echo $email; ?>">Students Registered</a>
  <a href="AboutUs.php">About Us</a>
  <a href="logout.php">Log-Out</a>
</div>
  <div class="conet" style = "  margin-left: 200px;
  padding: 20px;">
  <div class="container">
    <form method="post" action="process.php">
    <label><h1>Company Details </h1><label>
      <label for="company_name"><strong>Company Name:</strong></label>
      <input type="text" name="company_name" placeholder="Sahoo Industries" required>

      <label for="company_email"><strong>Company Email:</strong></label>
      <input type="email" name="company_email" placeholder=  <?= htmlspecialchars($_SESSION["company_email"]) ?> required>

      <label for="company_desc"><strong>Company Description:</strong></label>
      <input type="tel" name="company_desc" placeholder="Company Description" required>

      <label for="company_phone"><strong>Company Phone:</strong></label>
      <input type="tel" name="company_phone" placeholder="Company Phone" required>


      <label for="company_address"><strong>Company Address:</strong></label>
      <textarea name="company_address" placeholder="Company Address" required></textarea>

    
      <label><h1>Job Role Details</h1><label>
      <div id="job_roles">
        <div id="job_role_0">

          <table>
            <tr>
              <td><label for="role_name_0"><strong>Role Name:</strong></label></td>
              <td><input type="text" name="role_name_0" id="role_name_0" placeholder="Role Name" required></td>
            </tr>
            <tr>
              <td><label for="job_description_0"><strong>Job Description:</strong></label></td>
              <td><textarea name="job_description_0" id="job_description_0" placeholder="Job Description" required></textarea></td>
            </tr>
            <tr>
              <td><label for="min_cpi_0"><strong>Minimum CPI:</strong></label></td>
<td><input type="number" name="min_cpi_0" id="min_cpi_0" min="0" max="10" step = "0.5" placeholder="Minimum CPI" required></td>
</tr>
<tr>
<td><label for="job_spec_0"><strong>Job Specification:</strong></label></td>
<td>
<select name="job_spec_0" required>
<option value="" disabled selected>Select Job Specification</option>
<option value="Web Development">Web Development</option>
<option value="Android Development">Android Development</option>
<option value="Block-Chain">Block-Chain</option>
<option value="Machine Learning">Machine Learning</option>
<option value="Quant Computing">Quant Computing</option>
</select>
</td>
</tr>
<tr>
<td><label for="job_department_0"><strong>Job Department:</strong></label></td>
<td><input type="text" name="job_department_0" id="job_department_0" placeholder="Job Department" required></td>
</tr>
<tr>
<td><label for="job_mode_of_interview_0"><strong>Mode of Interview:</strong></label></td>
<td><input type="text" name="job_mode_of_interview_0" id="job_mode_of_interview_0" placeholder="Online/Offline" required></td>
</tr>
<tr>
<td><label for="job_date_of_interview_0"><strong>Date of Interview:</strong></label></td>
<td><input type="date" name="job_date_of_interview_0" id="job_date_of_interview_0" placeholder="Date of Interview" required></td>
</tr>
<tr>
<td><label for="job_package_0"><strong>Job Package:</strong></label></td>
<td><input type="number" name="job_package_0" id="job_package_0" placeholder="Job Package" min="0" max="100000000" step = "1000"  required></td>
</tr>
</table>
</div>
</div>

  <button style="background-color: #ffffff;
  color: #000000;
  border: none;
  border-radius: 20px;
  padding: 15px 30px;
  cursor: pointer;
  transition: all 0.3s ease-in-out;
  box-shadow: 0px 0px 10px rgba(154, 145, 136, 1);
  margin_top:20px" type="button" id="add_job_role">Add Job Role</button>
  <br><br>

  <input style="background-color: #7d7165;
  color: #ffffff;
  border: none;
  border-radius: 20px;
  padding: 15px 30px;
  cursor: pointer;
  transition: all 0.3s ease-in-out;
  box-shadow: 0px 0px 10px rgba(154, 145, 136, 1);" type="submit" name="submit" value="Submit">
</form>
  <hr class="dashed-line">


</div>
  </div>

</body> </html>