<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <title>Placements</title>
    <style>
    body {
    background-image: url('');
    background-size: cover;
    }
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
    </style>
</head>
<body>
    <div class="navigation">
        <h2>Navigation</h2>
        <a href='home.php'>Home</a>;
        <a href="incomingCompany.php">Companies</a>
        <a href="prevCompanies.php">Past Companies</a>
        <a href="LogOut.php">Log Out</a>
    </div>
    <h1>Incoming Companies</h1>
    <table>
        <thead>
            <tr>
                <th>Company</th>
                <th>Job Role</th>
                <th>Job Description</th>
                <th>CTC</th>
            </tr>
        </thead>
        <tbody>
            <?php
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
            session_start();
            $domain = $_SESSION['domain'];
            $l_ctc = $_SESSION['l_ctc'];
            $h_ctc = $_SESSION['h_ctc'];
            $h_batch = $_SESSION['h_batch'];
            $l_batch = $_SESSION['l_batch'];
            $conn = mysqli_connect("localhost", "root", "", "CampusConnect");
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            
            $sql = "select Comp_Name, Role_Name, Job_Desc, Job_Package from Companies natural join Job_Roles where 
            Job_Roles.Job_Package <= $h_ctc
            and Job_Roles.Job_Package>= $l_ctc
            and Job_Roles.Role_Name = '$domain'
            and YEAR(Job_Roles.Job_DOI) <= $h_batch
            and YEAR(Job_Roles.Job_DOI) >= $l_batch
            ";
            $result = mysqli_query($conn, $sql);
            // print_r($result);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["Comp_Name"] . "</td>";
                echo "<td><a href='home.php'>" . $row["Role_Name"] . "</a></td>";
                echo "<td>" . $row["Job_Desc"] . "</td>";
                echo "<td>" . $row["Job_Package"] . "</td>";
                echo "</tr>";
            }

            mysqli_close($conn);
            ?>
        </tbody>
    </table>
</body>
</html>