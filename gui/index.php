<!DOCTYPE html>
<?php
session_start();
include('functions.php');
?>
<html lang="pl">

<head>
	<title>BlueShop</title>
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
</head>

<body>
	<?php
	if (!isset($_SESSION['loggedin'])) {
		include('navbar.php');
	} else include('navbar2.php');
	?>

	<div class="jumbotron text-center">
		<h1>BlueShop<img src="img/logo.png" width="50px"></h1>
		<p>Najlepszy sprzęt, najniższe ceny</p>
	</div>

	<div class="jumbotron2 text-center mx-0">
		
		
			<div class="row" id="list"><?php getProdukt(); ?></div>
			</br></br>
		
		
	</div>
	<?php

	
	if (isset($_GET['add_cart'])) {
		if (isset($_SESSION['loggedin'])) {
			echo '<script language="JavaScript">
				{alert("Dodano do koszyka");}
				window.location.href = "index.php";
			</script>';

			$_SESSION['id_produktu'] = $_GET['add_cart'];
			global $conn;
			$stid = oci_parse($conn,"select * from produkt INNER JOIN producenci ON produkt.id_producenta = producenci.id_producenta where id_produktu=" . $_GET['add_cart']);
			oci_execute($stid);			
			while ($row = oci_fetch_array($stid)) {
				$_SESSION['model'] = $row['MODEL'];
				$_SESSION['nazwaRodzaju'] = $row['NAZWARODZAJU'];
				$_SESSION['cena'] = $row['CENA'];
				$_SESSION['img'] = $row['IMG'];
				$_SESSION['id_produktu'] = $row['ID_PRODUKTU'];

				$_SESSION['cart'][] = array(
					$_SESSION['model'],
					$_SESSION['nazwaRodzaju'],
					$_SESSION['cena'],
					$_SESSION['img'],
					$_SESSION['id_produktu']
				);
			}
			echo "<script> refresh () </script>";
		} else {
			echo '<script language="JavaScript">
 
{alert("Proszę się zalogować");}
 
</script>'; 
		}
		
	}
	
	/*
	if (isset($_POST['add'])){
		if(isset($_SESSION['cart'])){
	
			$item_array_id = array_column($_SESSION['cart'], "product_id");
	
			if(in_array($_POST['product_id'], $item_array_id)){
				echo "<script>alert('Produkt znajduje się już w koszyku! :)')</script>";
				echo "<script>window.location = 'index.php'</script>";
			}else{
	
				$count = count($_SESSION['cart']);
				$item_array = array(
					'product_id' => $_POST['product_id']
				);
	
				$_SESSION['cart'][$count] = $item_array;
			}
	
		}else{
	
			$item_array = array(
					'product_id' => $_POST['product_id']
			);
	
			$_SESSION['cart'][0] = $item_array;
			print_r($_SESSION['cart']);
		}
	}
	*/


	?>

	<?php include('footer.php'); ?>
	<script src="filter.js">
		
	</script>
</body>

</html>