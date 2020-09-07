<?php

$conn = oci_connect('student', 'student', '//localhost/kosmos');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}


//function getAlbums()
function getProdukt()
{
	global $conn;	
	$stid = oci_parse($conn, 'select * from produkt INNER JOIN producenci ON produkt.id_producenta = producenci.id_producenta INNER JOIN rodzaje ON produkt.id_rodzaju = rodzaje.id_rodzaju  order by model asc');
	oci_execute($stid);	
	while ($row = oci_fetch_array($stid)) {		
		$id_produktu = $row['ID_PRODUKTU'];
		$model = $row['MODEL'];
		$id_producenta = $row['ID_PRODUCENTA'];
		$id_rodzaju = $row['ID_RODZAJU'];
		$rok = $row['ROK'];
		$cena = $row['CENA'];
		$img = $row['IMG'];
		$nazwaProducenta = $row['NAZWAPRODUCENTA'];
		$nazwaRodzaju = $row['NAZWARODZAJU'];
		
		echo "
				<div class='col-sm-12 col-md-12 col-lg-6 col-xl-4' id='inside' data-name='$model' data-rodzaje='$nazwaRodzaju' data-cena='$cena' data-nazwa='$nazwaProducenta'>
							<div class='productinfo text-center '>
								<img src='img/$img' style='width:250px;height:250px'  class='img-fluid round' />
								<h2 style='font-size:20px'><br><b>$model</b></h2><br>
								<h2 style='font-size: medium'><b>$nazwaProducenta</b></h2><br>
								<p><b>$cena zł</b></p><br>
								<a href='index.php?add_cart=$id_produktu' class='btn add-to-cart' name='add_to_cart'>Dodaj do koszyka</a>
							</div>

			</div>
				";
	}

}

function createCheckbox()
{
	global $conn;
	$stid = oci_parse($conn,'select nazwaRodzaju from rodzaje order by nazwaRodzaju asc');
	oci_execute($stid);
	while ($row = oci_fetch_array($stid)) {
		$nazwaRodzaju = $row['NAZWARODZAJU'];
		echo "
		<div class='list-group-item checkbox' style='background-color:#2378ba;color:#fff'>
            <label><input type='checkbox' name='rodzaje' value='$nazwaRodzaju' id='checkbox' > $nazwaRodzaju</label>
        </div>
		";
	}
}

function cartDelete(){
	
	if (!empty($_SESSION["cart"])) {
		foreach ($_SESSION["cart"] as $product => $val) {
			if($val["id_produktu"] == $_SESSION['id_produktu'])
			{
				unset($_SESSION["cart"][$product]);
			}
		}
	}
}

function cartElement($productimg, $productname, $productprice, $productid){
    $element = "
    
    <form action=\"cart.php?action=remove&id=$productid\" method=\"post\" class=\"cart-items\">
                    <div class=\"border rounded\">
                        <div class=\"row bg-white\">
                            <div class=\"col-md-3 pl-0\">
                                <img src=$productimg alt=\"Image1\" class=\"img-fluid\">
                            </div>
                            <div class=\"col-md-6\">
                                <h5 class=\"pt-2\">$productname</h5>
                                <small class=\"text-secondary\">Wyprodukowano: Polska</small>
                                <h5 class=\"pt-2\">$productprice zł</h5>
                                <button type=\"submit\" class=\"btn btn-danger mx-2\"name=\"remove\">Usuń</button>
                                
                            </div>
                            <div class=\"col-md-3 py-5\">
                                <div>
                                    <button type=\"button\" class=\"btn bg-light border rounded-circle\"><i class=\"fas fa-minus\"></i></button>
                                    <input type=\"text\" value=\"1\" class=\"form-control w-25 d-inline\">
                                    <button type=\"button\" class=\"btn bg-light border rounded-circle\"><i class=\"fas fa-plus\"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
    
    ";
    echo  $element;
}


