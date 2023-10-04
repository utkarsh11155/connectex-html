<?php
session_start();
include 'db.php';

if(isset($_SESSION['unique_id'])){
    $unique_id = $_SESSION['unique_id'];
} else {
    // Redirect to the login page or display an error message
    header("location: http://localhost/connectex/html/index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Alumni Dashboard</title>
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

		.query-bar {
			display: flex;
			align-items: center;
			padding: 10px;
			background-color: #f2f2f2;
		}

		.table-container {
			padding: 10px;
		}

		table {
			width: 100%;
			border-collapse: collapse;
		}

		th, td {
			padding: 8px;
			text-align: left;
			border-bottom: 1px solid #ddd;
		}

		th {
			background-color: #333;
			color: #fff;
		}

		.accept-btn, .reject-btn {
			background-color: #4CAF50;
			color: white;
			border: none;
			padding: 6px 12px;
			margin: 4px 2px;
			cursor: pointer;
			border-radius: 4px;
		}

		.reject-btn {
			background-color: #f44336;
		}

		.schedule-meeting-bar {
			display: flex;
			align-items: center;
			padding: 10px;
			background-color: #f2f2f2;
		}
	</style>
</head>
<body>
	<div class="top-bar">
		<h1>Alumni Dashboard</h1>
		<div>
			<button>Profile</button>
			<button>Schedule Meeting</button>
			<a href="http://localhost/connectex/php/logout.php?logout_id=<?php echo $unique_id; ?>"><button class="logout_btn">LOGOUT</button></a>
		</div>
	</div>
	<div class="container">
		<div class="query-bar">
			<input type="text" placeholder="Search Queries...">
			<button>Create New Query</button>
		</div>
		<div class="table-container">
			<table>
				<thead>
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th>Query</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Gaurav Kumar</td>
						<td>gk123@example.com</td>
						<td>How do I update my contact information?</td>
						<td>
						<a href="http://localhost/connectex/html/chat.html#" class="button">Accept</a>
						<a href="http://localhost/connectex/html/chat.html#" class="button">Reject</a>
						</td>
					</tr>
					
					
				</tbody>
			</table>
		</div>
		<div class="schedule-meeting-bar">
<input type="text" placeholder="Search for Alumni...">
<button>Schedule Meeting</button>
</div>
</div>

</body>
</html>
