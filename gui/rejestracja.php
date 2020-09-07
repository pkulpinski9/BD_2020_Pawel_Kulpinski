<!DOCTYPE html>
<?php
include('functions.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$imie = $_POST['imie'];
	$nazwisko = $_POST['nazwisko'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$password2 = $_POST['password2'];
	$mail = $_POST['mail'];
	$adres = $_POST['adres'];
	$noerror = true;


	if (!preg_match("/^[a-zA-Z ]*$/", $imie) || !preg_match("/^[a-zA-Z ]*$/", $nazwisko)) {
		$noerror = false;
		header("Location: rejestracja.php?signup=nameerror&username=$username&mail=$mail&adres=$adres");
		exit();
	}
	if ((strlen($username) < 3) || (strlen($username) > 20)) {
		$noerror = false;
		header("Location: rejestracja.php?signup=usernameerror&imie=$imie&nazwisko=$nazwisko&mail=$mail&adres=$adres");
		exit();
	}
	if (ctype_alnum($username) == false) {
		$noerror = false;
		header("Location: rejestracja.php?signup=usernameerror&imie=$imie&nazwisko=$nazwisko&mail=$mail&adres=$adres");
		exit();
	}

	if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
		$noerror = false;
		header("Location: rejestracja.php?signup=invalidemail&imie=$imie&nazwisko=$nazwisko&username=$username&adres=$adres");
		exit();
	}
	if ((strlen($password) < 6) || (strlen($password) > 20)) {
		$noerror = false;
		header("Location: rejestracja.php?signup=passworderror&imie=$imie&nazwisko=$nazwisko&username=$username&mail=$mail&adres=$adres");
		exit();
	}
	if ($password != $password2) {
		$noerror = false;
		header("Location: rejestracja.php?signup=passwordmatcherror&imie=$imie&nazwisko=$nazwiskousername=$username&mail=$mail&adres=$adres");
		exit();
	}
	global $conn;
	$stid = oci_parse($conn, "SELECT id_klienta FROM klienci WHERE 
			email ='$mail'");
	oci_execute($stid);
	$numrows = oci_num_rows($stid);
	if ($numrows > 0) {
		$noerror = false;
		header("Location: rejestracja.php?signup=emailbusy&imie=$imie&nazwisko=$nazwisko&username=$username&mail=$mail&adres=$adres");
		exit();
	}
	if ($noerror == true) {
		$stid = oci_parse($conn, "begin rejestruj(:nazwa_uzytkownika, :haslo, :imie, :nazwisko, :email, :adres); end;");
		oci_bind_by_name($stid, ":nazwa_uzytkownika", $username);
        oci_bind_by_name($stid, ":haslo", $password);
        oci_bind_by_name($stid, ":imie", $imie);
        oci_bind_by_name($stid, ":nazwisko", $nazwisko);
        oci_bind_by_name($stid, ":email", $mail);
        oci_bind_by_name($stid, ":adres", $adres);
        

        oci_execute($stid);
			header("Location: rejestracja.php?signup=success");
		
	}
}


?>
<html lang="pl">

<head>
	<title>Rejestracja</title>
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
			color: black;
		}
	</style>
</head>

<body>
	<?php include('navbar.php'); ?>


	<div class="jumbotron2 text-center">
		<div class="imgcontainer">
			<img src="img/logo.png" width="100px" alt="LOGO">
		</div>
		<div class="container">
			<label style="font-size: 30px"><b>Rejestracja</b></label>

			<form class="md-form" method="POST" style="width:30%; margin:auto">
				<?php
				if (isset($_GET['imie'])) {
					$imie = $_GET['imie'];
					echo '<input class="form-control" type="text" placeholder="Imie:" name="imie" value="' . $imie . '" required><br>';
				} else {
					echo '<input class="form-control" type="text" placeholder="Imie:" name="imie" required><br>';
				}
				if (isset($_GET['nazwisko'])) {
					$nazwisko = $_GET['nazwisko'];
					echo '<input class="form-control" type="text" placeholder="Nazwisko:" name="nazwisko" value="' . $nazwisko . '" required><br>';
				} else {
					echo '<input class="form-control" type="text" placeholder="Nazwisko:" name="nazwisko" required><br>';
				}
				if (isset($_GET['username'])) {
					$username = $_GET['username'];
					echo '<input class="form-control" type="text" placeholder="Nazwa użytkownika:" name="username" value="' . $username . '" required><br>';
				} else {
					echo '<input class="form-control" type="text" placeholder="Nazwa użytkownika:" name="username" required><br>';
				}

				?>

				<input class="form-control" type="password" placeholder="Hasło:" name="password" required><br>

				<input class="form-control" type="password" placeholder="Powtórz hasło:" name="password2" required><br>
				<input class="form-control" type="text" placeholder="E-mail:" name="mail" required><br>
				<?php
				/*if(isset($_GET['mail'])){
						$mail = $_GET['mail'];
						echo '<input class="form-control" type="text" placeholder="E-mail:" name="mail" value="'.$mail.'" required><br>';
					}else{
						echo '<input class="form-control" type="text" placeholder="E-mail:" name="mail" required><br>';
					}*/

				if (isset($_GET['adres'])) {
					$adres = $_GET['adres'];
					echo '<input class="form-control" type="text" placeholder="Adres:" name="adres" value="' . $adres . '" required> <br>';
				} else {
					echo '<input class="form-control" type="text" placeholder="Adres:" name="adres" required> <br>';
				}
				?>






				<button class="btn btn3 btn-lg w-100" type="submit">Zarejestruj się</button>
				<label style="display: block"><b>Masz już konto? <a href="logowanie.php">Zaloguj się.</a></b></label>
				
				<?php
				if (!isset($_GET['signup'])) {
					
				} else {
					$signupCheck = $_GET['signup'];
					if ($signupCheck == "nameerror") {
						echo "<p class='error'>Imię i nazwisko powinno składać się wyłącznie z liter!</p>";
						exit();
					} elseif ($signupCheck == "usernameerror") {
						echo "<p class='error'>Nazwa użytkownika powinna zawierać od 3 do 20 znaków!</p>";
						exit();
					} elseif ($signupCheck == "invalidemail") {
						echo "<p class='error'>Nieprawidłowy adres e-mail!</p>";
						exit();
					} elseif ($signupCheck == "passworderror") {
						echo "<p class='error'>Hasło powinno zawierać od 8 do 20 znaków!</p>";
						exit();
					} elseif ($signupCheck == "passwordmatcherror") {
						echo "<p class='error'>Hasła nie są takie same!</p>";
						exit();
					} elseif ($signupCheck == "emailbusy") {
						echo "<p class='error'>Istnieje konto o podanym adresie e-mail!</p>";
						exit();
					} elseif ($signupCheck == "success") {
						echo "<p class='error'>Gratulacje, konto stworzone pomyślnie!</p>";
						
					}
				}

				?>
				
			</form>
		</div>
	</div>




	<?php include('footer.php'); ?>
</body>

</html>