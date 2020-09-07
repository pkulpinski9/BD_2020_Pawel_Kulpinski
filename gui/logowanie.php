<!DOCTYPE html>
<?php
include('functions.php');
session_start();


if ($_SERVER['REQUEST_METHOD'] == "POST") {

	global $conn;
	$username = $_POST["login"];
	$password = $_POST["haslo"];


	if (trim($username) != "" and trim($password) != "") {

		$username = stripcslashes($username);
		$password = stripcslashes($password);
		$username = strip_tags($_POST["login"]);
		$password = strip_tags($_POST["haslo"]);
		// $username = mysqli_real_escape_string($conn, $username);
		// $password = mysqli_real_escape_string($conn, $password);


		$curs1 = oci_new_cursor($conn);

		$stid = oci_parse($conn, "begin loguj(:username, :pasword, :passy); end;");
		oci_bind_by_name($stid, ":passy", $curs1, -1, OCI_B_CURSOR);
		oci_bind_by_name($stid, ":username", $username);
		oci_bind_by_name($stid, ":pasword", $password);

		oci_execute($stid);
		oci_execute($curs1);
		while (($row = oci_fetch_array($curs1, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
			$numrows = $row['ID_KLIENTA'];
		}

		if ($username == 'admin' && $password == 'admin') {
			
			$_SESSION['admin'] = true;
			$_SESSION['loggedin'] = true;
			$_SESSION['nazwa_uzytkownika'] = $username;
			$_SESSION['haslo'] = $password;
			header('Location: adminpane.php');
		} elseif ($numrows > 0) {
			oci_free_statement($stid);
    		oci_free_statement($curs1);
    		oci_free_statement($curs2);
			$_SESSION['loggedin'] = true;
			$_SESSION['nazwa_uzytkownika'] = $username;
			header('Location: index.php');
		} else {
			header('Location: logowanie.php?signin=error');
			exit();
		}
	}
}

?>

<html lang="pl">

<head>
	<title>Logowanie</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script src="https://kit.fontawesome.com/a79ff52c1c.js" crossorigin="anonymous"></script>
	<script src="https://use.fontawesome.com/9a538e0042.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
	<style>
		.btn3 {
			background-color: #2378ba;
			color: white;
			padding: 14px 20px;
			margin: 8px 0;
			border: none;
			cursor: pointer;
			width: 30%;
			overflow: hidden;
			text-overflow: ellipsis;
			white-space: nowrap;
		}

		.btn3:hover {
			background-color: white;
			color: #2378ba;
		}
	</style>
</head>

<body>
	<?php include('navbar.php'); ?>



	<div class="dwa text-center">
		<div class="imgcontainer">
			<img src="img/logo.png" width="100px" alt="LOGO">
		</div>
		<div class="container text-center">
			<label style="color: white;font-size: 30px"><b>Logowanie</b></label>
			<div class="form-group " style="width:30%; margin: 0 auto;">
				<form method="POST">
					<input class="form-control" type="text" placeholder="Nazwa użytkownika:" name="login" required> <br>
					<input class="form-control" type="password" placeholder="Hasło:" name="haslo" required>
					<?php
					$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
					if (strpos($fullUrl, "signin=error") == true) {
						echo "<p class='error'>Nieprawidłowy login lub hasło!</p>";
					}
					?>
					<button class="btn btn3 btn-lg w-100" type="submit">Zaloguj się</button>
				</form>

			</div>

			<label style="display: block;color:white;"><b>Nie masz konta? <a href="rejestracja.php">Zarejestruj się.</a></b></label>
			

		</div>
	</div>
	<?php include('footer.php'); ?>

</body>

</html>