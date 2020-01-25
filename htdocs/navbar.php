<?php
  session_start();
  require_once "database.php";
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		
		<?php
			if(isset($_SESSION['id'])&& !empty($_SESSION['id']) && isset($_SESSION['username'])&& !empty($_SESSION['username'])){
				//TODO LOGOUT
				echo '<nav class="navbar navbar-light bg-light">
					<span class="navbar-brand mb-0 h1">PHP Chat Project</span>
						<form class="form-inline"  method="POST" action="logout.php">
							<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Logout</button>
						</form>
					</nav>';
			}else{
					echo '<nav class="navbar navbar-light bg-light">
				<span class="navbar-brand mb-0 h1">PHP Chat Project</span>
				<form class="form-inline"  method="POST" action="login.php">
					<input class="form-control mr-sm-2" type="text" placeholder="Username" name="username">
					<input class="form-control mr-sm-2" type="password" placeholder="Password" name="password">
					<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Login</button>
					<button class="btn btn-success my-2 my-sm-0" id="register" style="margin-left:10px;">Register</button>
				</form>
			</nav>';
			}
			?>

		<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
		<script src="js/script.js"></script>
	</head>
</html>