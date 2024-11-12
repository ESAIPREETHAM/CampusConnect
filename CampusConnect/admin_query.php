<html>
<head>
    <title>Admin Page</title>
    <style>
/* Style the form */
body{
    padding-left : 220px;
}
form {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 20px;
}

label {
    font-size: 18px;
    margin-bottom: 10px;
}

input[type="text"] {
    padding: 8px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    width: 500px;
    max-width: 100%;
}

input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 8px 16px;
    font-size: 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #3e8e41;
}

/* Style the table */
table {
    border-collapse: collapse;
    width: 100%;
    margin-top: 20px;
}

th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #4CAF50;
    color: white;
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
    
    </style>
</head>
<body>
<div class="navigation">
        <h2>Navigation</h2>
        <a href="home.php" class="active">Home</a>
        <a href="searchStudent.php">Search Student</a>
        <a href="incomingCompany.php">Search Company</a>
        <a href="currentStudents.php">Students</a>
        <a href="incomingCompany.php">Company</a>
        <a href="alumniExperience.php">Alumni</a>
        <!-- <a href="companyStats.php">Statistics</a> -->
        <a href="placing.php">Place Students</a>
        <a href="admin_query.php">Sql Terminal</a>
        <!-- <a href="endPlacements.php">End Placements</a> -->
        <a href="logout.php">Log Out</a>
    </div>
<form method="post" action="">
    <label for="query">Enter MySQL query:</label>
    <input type="text" name="query" id="query">
    <hr style="border-top: 1px dashed #ccc; width: 100%;">
    <input type="submit" name="submit" value="Execute">
</form>
</body>
</html>
<?php
// Check if the form has been submitted
if (isset($_POST['submit'])) {
    // Get the MySQL query from the text box
    $query = $_POST['query'];

    // Connect to the MySQL database
    $conn = mysqli_connect('localhost', 'root', '', 'CampusConnect');

    // Execute the MySQL query
    $result = mysqli_query($conn, $query);

    // Display the results in a table
    if ($result) {
        $num_fields = mysqli_num_fields($result);
        echo "<table>";
        echo "<tr>";
        for ($i = 0; $i < $num_fields; $i++) {
            $field_name = mysqli_fetch_field_direct($result, $i)->name;
            echo "<th>" . $field_name . "</th>";
        }
        echo "</tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>" . $value . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Error executing query: " . mysqli_error($conn);
    }

    // Close the MySQL connection
    mysqli_close($conn);
}
?>