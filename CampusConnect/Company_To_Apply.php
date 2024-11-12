<!DOCTYPE html>
<html>
<head>
	<title>Companies</title>
	<style>
		* {
			box-sizing: border-box;
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
		}

		body {
  /* display: flex; */
  /* align-items: center; */
  /* justify-content: center; */
  height: 500vh;
}

.container {
  width: 80%;
  margin: 0 auto;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
  background-image: url("pexels-matheus-viana-2414036.jpg");
  background-size: cover;
  background-repeat: no-repeat;
  background-color: rgba(202, 202, 202, 0.5); /* adjust the opacity here */
}

		.company-tabs {
			display: flex;
			flex-direction: column;
			margin-top: 20px;
		}
		.company-tab:hover {
  background-color: #f2f2f2;
}
.company-tab:hover {
  cursor: pointer;
}
.active-tab {
  background-color: #e0e0e0;
}
.job-profiles {
  display: none;
  transition: all 0.3s ease-in-out;
}

.active-tab .job-profiles {
  display: flex;
}
.job-profiles {
  display: none;
  transition: all 0.3s ease-in-out;
}

.active-tab .job-profiles {
  display: flex;
}
a.apply-link {
  text-decoration: none; /* removes the underline */
  color: inherit; /* sets the link color to inherit from its parent element */
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

		.company-tab {
			display: flex;
			flex-direction: row;
			align-items: center;
			padding: 10px;
			margin-bottom: 10px;
			background-color: #fff;
			box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
			cursor: pointer;
			transition: box-shadow 0.2s ease-in-out;
			position: relative;
		}

		.company-tab:hover {
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
		}

		.company-logo {
			width: 50px;
			height: 50px;
			margin-right: 10px;
			object-fit: contain;
		}

		.company-name {
			font-size: 20px;
			font-weight: bold;
			margin-right: 20px;
		}

		.job-profiles {
			display: none;
			flex-direction: column;
			padding: 10px;
			position: absolute;
			top: 60px;
			left: 0;
			background-color: #fff;
			box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
			z-index: 1;
		}

		.job-profile {
			font-size: 16px;
			margin-bottom: 5px;
		}

		.active-tab {
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
		}

		.active-tab .job-profiles {
			display: flex;
		}

		.apply-button {
  position: absolute;
  margin-top: 0px; /* adjust this value to move the button down or up */
  background-color: #4CAF50;
  color: #fff;
  border: none;
  padding: 8px;
  font-size: 16px;
  font-weight: bold;
  cursor: pointer;
  right: 10px;
  transition: background-color 0.2s ease-in-out;
  border-radius: 5px;
}


		.apply-button:hover {
			background-color: #3E8E41;
		}
	</style>
</head>
<body>
	<?php
	ini_set('display_errors','On');
		// Define the companies array
		session_start();
		
		$email = $_SESSION['Email']; 

		$conn = new mysqli('localhost', 'root', '', 'CampusConnect');

		$companies = array();
		$sql = "SELECT * FROM Companies";

		// Execute the query and store the results
		$result = mysqli_query($conn, $sql);

	
if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {


		$company_id = $row["Company_ID"];
		$company_email=$row["Comp_email"];
		$company_name=$row["Comp_Name"]; // Replace with actual company ID
	

$query = "SELECT c.Company_ID, c.Comp_Name, j.Role_Name
          FROM Companies c
          JOIN Job_Roles j ON c.Company_ID = j.company_id
          WHERE c.Company_ID = $company_id";

 $result2 = mysqli_query($conn, $query);

if (mysqli_num_rows($result2) > 0) {
    $jobs = array();
    while ($row = mysqli_fetch_assoc($result2)) {
        $jobs[] = $row["Role_Name"];
    }
    // Do something with the $jobs array
} else {
    $jobs=array();


}
        $company = array(
             "name" => $company_name,
            "email"=> $company_email,

			

             "jobs" => $jobs,
            //"website" => $row["website"]
        );
        array_push($companies, $company);
    }
}


		$search = isset($_GET['search']) ? $_GET['search'] : '';
		$roles = isset($_GET['roles']) ? $_GET['roles'] : [];

$filteredCompanies = array_filter($companies, function($company) use ($search, $roles) {
    // Check if the company name matches the search query
    $nameMatch = stripos($company['name'], $search) !== false;

    // Check if any of the company jobs match the selected roles
    $jobsMatch = false;
    foreach ($company['jobs'] as $job) {
        $jobSlug = strtolower(str_replace(' ', '-', $job));
        if (in_array($jobSlug, $roles)) {
            $jobsMatch = true;
            break;
        }
    }

    return $nameMatch && (!$roles || $jobsMatch);
});
		// Loop through the companies and create the tabs
		echo '<div class="container" style = "  margin-left: 300px;margin-top: 20px;
		padding: 20px;">';
		echo '<h1>Companies</h1>';
		echo '<div class="navigation">';
echo '<h2>Navigation</h2>';
echo '<a href="stud_profile.php?email=<?php echo $email; ?>">Profile</a>';
echo '<a href="StudentUpdate.php?email=<?php echo $email; ?>">Update</a>';
echo '<a href="Company_To_Apply.php?email=<?php echo $email; ?>" class="active">Companies</a>';
echo '    <a href="Alumni_Stud.php?email=<?php echo $email; ?>">Alumni</a>';
echo '<a href="#">About Us</a>';
echo '<a href="logout.php">Log-Out</a>';
echo '</div>';
		echo '<form>';
echo '<input type="text" name="search" placeholder="Search...">';

// Create the roles checkboxes
echo '<div class="roles">';
echo '<label>Roles:</label>';
$jobTitles = [];

// Loop through the companies and add all job titles to $jobTitles array
foreach ($companies as $company) {
    foreach ($company['jobs'] as $job) {
        $jobSlug = strtolower(str_replace(' ', '-', $job));
        $jobTitles[] = $job;
    }
}

// Remove duplicates using array_unique function
$uniqueJobTitles = array_unique($jobTitles);

// Loop through unique job titles and display as checkboxes
foreach ($uniqueJobTitles as $job) {
    $jobSlug = strtolower(str_replace(' ', '-', $job));
    echo '<div class="role">';
    echo "<input type='checkbox' name='roles[]' value='$jobSlug' id='$jobSlug' " . (in_array($jobSlug, $_GET['roles'] ?? []) ? 'checked' : '') . ">";
    echo "<label for='$jobSlug'>$job</label>";
    echo '</div>';
}

echo '</div>';

echo '<button style="background-color: #7d7165;
color: #ffffff;
border: none;
border-radius: 20px;
padding: 15px 30px;
cursor: pointer;
transition: all 0.3s ease-in-out;
box-shadow: 0px 0px 10px rgba(154, 145, 136, 1);" type="submit">Search</button>';
echo '</form>';

	echo '<div class="company-tabs">';
	foreach ($filteredCompanies as $company) {
		echo '<div class="company-tab">';
		// echo '<img src="' . $company["logo"] . '" alt="' . $company["name"] . ' logo" class="company-logo">';
		echo '<span class="company-name">' . $company["name"] . '</span>';
		echo '<div class="job-profiles">';
		foreach ($company["jobs"] as $job) {
			echo '<div class="job-profile">' . $job . '</div>';
			
		}
		echo '</div>';
		echo '<button class="apply-button"><a class="apply-link" href="Company_Selected.php?Comp_email=' . $company["email"] . '&email=' . urlencode($email) . '">Apply Now</a></button>';

		
		echo '</div>';
	}
	
	echo '</div>';

	echo '</div>';
		
	?>
	
	<script>
		// Add click event listeners to the tabs
		const tabs = document.querySelectorAll('.company-tab');
		tabs.forEach(tab => {
			tab.addEventListener('click', () => {
				// Remove active class from all tabs
				tabs.forEach(tab => {
					tab.classList.remove('active-tab');
				});
	
				// Add active class to clicked tab
				tab.classList.add('active-tab');
			});
		});
	</script>
	</body>
</html>
	
