<?php
session_start();
include 'sdb.php';

if(isset($_SESSION['unique_id'])){
    $unique_id = $_SESSION['unique_id'];
} else {
    // Redirect to the login page or display an error message
    header("location: http://localhost/connectex/html/student.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Student Dashboard</title>
	<style>
		/* Add your CSS styles here */
		.top-bar {
			display: flex;
			justify-content: space-between;
			align-items: center;
			padding: 10px;
			background-color: #333;
			color: #fff;
		}

		.alumni-list {
			display: flex;
			flex-wrap: wrap;
			justify-content: flex-start;
			align-items: center;
			padding: 10px;
			background-color: #f2f2f2;
		}

		.alumni-card {
			margin: 10px;
			padding: 10px;
			background-color: #fff;
			box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
			border-radius: 5px;
			min-width: 200px;
		}

		.alumni-card h2 {
			margin-top: 0;
		}

		.sort-bar {
			display: flex;
			align-items: center;
			padding: 10px;
			background-color: #f2f2f2;
		}

		.sort-bar select {
			margin-left: 10px;
			padding: 6px;
			border-radius: 4px;
			border: 1px solid #ccc;
		}

		.question-bar {
			display: flex;
			align-items: center;
			padding: 10px;
			background-color: #f2f2f2;
		}

		.question-bar input {
			flex-grow: 1;
			margin-right: 10px;
			padding: 6px;
			border-radius: 4px;
			border: 1px solid #ccc;
		}

		.question-bar button {
			background-color: #333;
			color: #fff;
			border: none;
			padding: 6px 12px;
			margin: 0;
			cursor: pointer;
			border-radius: 4px;
		}
	</style>
</head>
<body>
	<div class="top-bar">
		<h1>Student Dashboard</h1>
		<div>
        <a href="http://localhost/connectex/php/logout.php?logout_id=<?php echo $unique_id; ?>"><button class="logout_btn">LOGOUT</button></a>
		</div>
	</div>
	<div class="container">
		<div class="sort-bar">
			<label for="domain-filter">Filter by Domain:</label>
			<select id="domain-filter">
				<option value="">All</option>
				<option value="tech">Tech</option>
				<option value="finance">Finance</option>
				<option value="marketing">Marketing</option>
			</select>
		</div>
		<div class="alumni-list">
			<div class="alumni-card" data-domain="tech" data-company="ExampleTech">
				<h2>John Doe</h2>
				<p>ExampleTech</p>
				<p>Tech</p>
				<button>Ask a Question</button>
			</div>
			<div class="alumni-card" data-domain="finance" data-company="ExampleFinance">
				<h2>Jane Smith</h2>
				<p>ExampleFinance</p>
				<p>Finance</p>
				<button>Ask a Question</button>
			</div>
			<div class="alumni-card" data-domain="marketing" data-company="ExampleMarketing">
				<h2>Bob Johnson</h2>
				<p>ExampleMarketing</p>
			<p>Marketing</p>
			<button>Ask a Question</button>
		</div>
		<div class="alumni-card" data-domain="tech" data-company="AnotherExampleTech">
			<h2>Samantha Lee</h2>
			<p>AnotherExampleTech</p>
			<p>Tech</p>
			<button>Ask a Question</button>
		</div>
		<div class="alumni-card" data-domain="finance" data-company="AnotherExampleFinance">
			<h2>Michael Brown</h2>
			<p>AnotherExampleFinance</p>
			<p>Finance</p>
			<button>Ask a Question</button>
		</div>
		<div class="alumni-card" data-domain="marketing" data-company="AnotherExampleMarketing">
			<h2>Amy Chen</h2>
			<p>AnotherExampleMarketing</p>
			<p>Marketing</p>
			<button>Ask a Question</button>
		</div>
	</div>
	<div class="question-bar">
		<input type="text" placeholder="Ask a question...">
		<button>Submit</button>
	</div>
</div>
<script>
	// Add your JavaScript code here
	const domainFilter = document.querySelector('#domain-filter');
	const alumniCards = document.querySelectorAll('.alumni-card');

	domainFilter.addEventListener('change', (event) => {
		const selectedDomain = event.target.value;

		alumniCards.forEach((card) => {
			if (selectedDomain === '' || card.dataset.domain === selectedDomain) {
				card.style.display = 'block';
			} else {
				card.style.display = 'none';
			}
		});
	});
</script>
</body>
</html>
