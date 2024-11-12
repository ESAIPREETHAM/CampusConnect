<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start();
    $year = $_SESSION['year'];

    $conn = new mysqli('localhost', 'root', '', 'CampusConnect');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql1 = "SELECT branch, AVG(ctc) as avg_ctc FROM alumni_placement Natural Join Alumni
            where batch = $year 
            GROUP BY Alumni.branch";
    $result1 = $conn->query($sql1);

    $branches = [];
    $average_ctc1 = [];

    if ($result1->num_rows > 0) {
        while($row1 = $result1->fetch_assoc()) {
            $branches[] = $row1['branch'];
            $average_ctc1[] = $row1['avg_ctc'];
        }
    } 

    $sql2 = "select company_name as name, avg(ctc) as avg_ctc from alumni_placement
            where batch = $year group by company_name";

    // $sql2 = "SELECT Companies.Comp_Name as name, AVG(Job_Roles.Job_Package) as avg_ctc FROM Job_Roles natural join Companies
    //         where YEAR(Job_Roles.Job_DOI) = $year 
    //         GROUP BY Companies.Comp_Name";
    $result2 = $conn->query($sql2);

    $companies = [];
    $average_ctc2 = [];

    if ($result2->num_rows > 0) {
        while($row2 = $result2->fetch_assoc()) {
            $companies[] = $row2['name'];
            $average_ctc2[] = $row2['avg_ctc'];
        }
    } 

    $sql3 = "SELECT batch as year, avg(ctc) as avg_ctc from alumni_placement group by batch order by batch";
    $result3 = $conn->query($sql3);

    $years = [];
    $average_ctc3 = [];

    if ($result3->num_rows > 0) {
        while($row3 = $result3->fetch_assoc()) {
            $years[] = $row3['year'];
            $average_ctc3[] = $row3['avg_ctc'];
        }
    } 

    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stats</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        #chart-container {
  width: 500px;
  height: 500px;
  display: flex;
  justify-content: center;
  align-items: center;
}
        </style>
</head>
<body>
    <h2>Statistics</h2>

    <?php
            $year = $_SESSION['year'];
            $conn = new mysqli('localhost', 'root', '', 'CampusConnect');

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "select count(*) as total, avg(ctc) as average, max(ctc) as highest 
                    from alumni_placement 
                    where batch = $year";
            $result = $conn->query($sql);

            $row = $result->fetch_assoc();
        ?>
        <div>
            <h3>Branch-Wise Statistics : <?php echo $year ?></h3>
            <p>Total Placements: <?php echo $row['total'] ?></p> 
            <p>Average CTC: <?php echo number_format($row['average'], 2) ?></p>
            <p>Highest CTC: <?php echo number_format($row['highest'], 2) ?></p>
        </div>
        <div id="chart-container">
    <canvas id="barChart"width="1000px" height="1000px" ></canvas></div>
    <script>
        const branches = <?php echo json_encode($branches); ?>;
        const average_ctc1 = <?php echo json_encode($average_ctc1); ?>;
        const colors = ['purple','green', 'red', 'blue', 'orange', 'yellow'];
        const ctx1 = document.getElementById('barChart').getContext('2d');
        const chart1 = new Chart(ctx1, {
            type: 'pie',
            data: {
                labels: branches,
                datasets: [{
                    label: 'Average CTC',
                    data: average_ctc1,
                    backgroundColor:colors.slice(0, average_ctc1.length)
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                responsive: true,
      maintainAspectRatio: false
            }
        });
    </script>

        <?php
            $year = $_SESSION['year'];
            $conn = new mysqli('localhost', 'root', '', 'CampusConnect');

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT count(*) as total, Companies.Comp_Name, AVG(Job_Roles.Job_Package) as avg_ctc, max(Job_Roles.Job_Package) as highest 
                    FROM Job_Roles natural join Companies
                    where YEAR(Job_Roles.Job_DOI) = $year 
                    GROUP BY Comp_Name";
            $result = $conn->query($sql);

            $row = $result->fetch_assoc();
            // print_r($row);
        ?>
        <div>
            <h3>Company Wise Chart : <?php echo $year ?></h3>
            <p>Total Offers: <?php echo $row['total'] ?></p> 
            <p>Average CTC: <?php echo number_format($row['avg_ctc'], 2) ?></p>
            <p>Highest CTC: <?php echo number_format($row['highest'], 2) ?></p>
        </div>

    <canvas id="hello" width = '10' height='2'></canvas>
    <script>
        const companies = <?php echo json_encode($companies); ?>;
        const average_ctc2 = <?php echo json_encode($average_ctc2); ?>;

        const ctx2 = document.getElementById('hello').getContext('2d');
        const chart2 = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: companies,
                datasets: [{
                    label: 'Average CTC',
                    data: average_ctc2,
                    backgroundColor: 'red'
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

        <?php
            $year = $_SESSION['year'];
            $conn = new mysqli('localhost', 'root', '', 'CampusConnect');

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT count(*) as total, avg(Job_Roles.Job_Package) as avg_ctc, max(Job_Roles.Job_Package) as highest
                    FROM Job_Roles";
            $result = $conn->query($sql);

            $row = $result->fetch_assoc();
        ?>
        <div>
            <h3>Year-Wise Statistics </h3>
            <p>Total Offers: <?php echo $row['total'] ?></p> 
            <p>Average CTC: <?php echo number_format($row['avg_ctc'], 2) ?></p>
            <p>Highest CTC: <?php echo number_format($row['highest'], 2) ?></p>
        </div>
        <canvas id="yoco" width="10" height="2"></canvas>
<script>
  const years = <?php echo json_encode($years); ?>;
  const average_ctc3 = <?php echo json_encode($average_ctc3); ?>;


  const ctx3 = document.getElementById('yoco').getContext('2d');
  const chart3 = new Chart(ctx3, {
    type: 'bar',
    data: {
      labels: years,
      datasets: [{
        label: 'Average CTC',
        data: average_ctc3,
        backgroundColor: 'blue'
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
</body>
</html>