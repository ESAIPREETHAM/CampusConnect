// Company listing JS

// Get all job tabs
var jobTabs = document.querySelectorAll('.job-tab');

// Loop through all job tabs
for (var i = 0; i < jobTabs.length; i++) {

	// Add click event listener to job tab
	jobTabs[i].previousElementSibling.addEventListener('click', function() {

		// Toggle active class on job tab
		this.classList.toggle('active');

		// Toggle job details visibility
		var jobDetails = this.nextElementSibling;
		if (jobDetails.style.display === 'block') {
			jobDetails.style.display = 'none';
		} else {
			jobDetails.style.display = 'block';
		}
	});

}

// Get all company tabs
var companyTabs = document.querySelectorAll('.company-tab');

// Loop through all company tabs
for (var i = 0; i < companyTabs.length; i++) {

	// Add click event listener to company tab
	companyTabs[i].querySelector('.company-name').addEventListener('click', function() {

		// Toggle active class on company tab
		this.classList.toggle('active');

		// Toggle job tabs visibility
		var jobTabs = this.nextElementSibling.querySelectorAll('.job-tab');
		for (var j = 0; j < jobTabs.length; j++) {
			if (jobTabs[j].style.display === 'block') {
				jobTabs[j].style.display = 'none';
			} else {
				jobTabs[j].style.display = 'block';
			}
		}

		// Toggle company details visibility
		var companyDetails = this.parentElement.querySelector('.company-details');
		if (companyDetails.style.display === 'block') {
			companyDetails.style.display = 'none';
		} else {
			companyDetails.style.display = 'block';
		}
	});

}
