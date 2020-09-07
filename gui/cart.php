<?php

include('functions.php');
session_start();


//$db = new CreateDb("Productdb", "Producttb");



?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script src="https://kit.fontawesome.com/a79ff52c1c.js" crossorigin="anonymous"></script>
	<script src="https://use.fontawesome.com/9a538e0042.js"></script>

    <link rel="stylesheet" href="style.css">
</head>
<body class="cart">

<?php
    require_once ('navbar2.php');
    
?>
<br><br><br><br>
<div class="container-fluid">
    <div class="row px-5">
        <div class="col-md-7">
            <div class="shopping-cart">
                <h6>Mój koszyk</h6>
                <hr>

                <?php
        
        $cenaRazem = 0;
       
        if (isset($_SESSION['loggedin'])) {
            if (!empty($_SESSION['cart'])) {
                echo "
                <table class='table' style='color:white'>
                <thead>
                    <tr>
                        <th scope='col'></th>
                        <th scope='col' style='text-align:center'>Model</th>
                        <th scope='col' style='text-align:center'>Producent</th>
                        <th scope='col' style='text-align:center'>Cena</th>
                        <th scope='col' style='text-align:center;'>Usuń</th>
                        
                    </tr>
                </thead>
                ";
                $cenaRazem = 0;
                foreach ($_SESSION['cart'] as $key => $product) {
                    $cenaRazem = $cenaRazem + $product[2];
                    
                    echo "
                    <div class='table-responsive-sm'>




                        <tbody>
                            <tr>
                                <td scope='row'><img src='img/$product[3]' style='width:70px;'></td>
                                <td><p style='font-size:1.5vw;text-align:center'>$product[0]</p></td>
                                <td><p style='font-size:1.5vw;text-align:center'>$product[1]</p></td>
                                <td><p style='font-size:1.5vw;text-align:center;'>$product[2] zł</p></td>
                                <td><p style='font-size:1.5vw;text-align:center;'><a href='cart.php?delete_cart=$key'><i class='far fa-trash-alt' id='kosz'></i></a></p></td>
                                
                            </tr>
                        </tbody>
                
                ";
                }
                echo "
                
                    </table>  
                    


   </form>
                                     
                ";
        ?>

        <?php
                if (isset($_GET['delete_cart'])) {

                    foreach ($_SESSION['cart'] as $key => $value) {
                        if ($key == $_GET['delete_cart']) {
                            unset($_SESSION["cart"][$key]);
                            echo '<script language="JavaScript">
				
				window.location.href = "cart.php";
			</script>';
                        }
                    }
                    
                }
            } ;
        } else header('Location: index.php');

        ?>

            </div>
        </div>
        <div class="podsumowanie col-md-4 offset-md-1 border rounded mt-5 h-25">

            <div class="podsumowanie pt-4">
                <h6>PODSUMOWANIE</h6>
                <hr>
                <div class="row price-details">
                    <div class="col-md-6">
                        <?php
                            if (isset($_SESSION['cart'])){
                                $count  = count($_SESSION['cart']);
                                echo "<h6>Cena ($count rzeczy)</h6>";
                            }else{
                                echo "<h6>Cena (0 rzeczy)</h6>";
                            }
                        ?>
                        <h6>Dostawa:</h6>
                        <hr>
                        <h6>Łączna cena:</h6>
                        
                    </div>
                    <div class="col-md-6">
                        <h6><?php echo $cenaRazem; ?> zł</h6>
                        <h6 class="text-success"><b>GRATIS</b></h6>
                        <hr>
                        <h6><?php
                            echo $cenaRazem;
                            ?> zł</h6>
                        
                    </div>
                    <hr>
                        
                        <a href="final.php" class="btn btn-warning my-2 ml-3">Zamów <i class="fas fa-shopping-bag"></i></a>
                </div>
            </div>
                    
        </div>
        
        
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<br>
<?php include('footer2.php'); ?>
	<script src="filter.js">
		
	</script>

</body>
</html>
