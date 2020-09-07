<!DOCTYPE html>
<?php
include('functions.php');
session_start();
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
include('navbar2.php');
 ?>
  </br>
  <div class="container text-center" style="background-color:#256291; min-height:100vh; min-width:100%;color:white;">
    <h1 style="color:white; font-size:4vw;padding:20px">Panel administracyjny </h1><a href="index.php"><img src="img/logo.png" alt="LOGO" width="100px"></a>

    <div class="btn-group-vertical" style="width:100%;margin-top:50px;">

      <a style='margin: 0 auto; width:25%' href='adminpane.php?producent'><button class='btn btn-lg w-100 mb-4' style='color:white;background-color:#2378ba;margin: 0 auto;' type='submit'>Dodaj producenta</button></a>
      <a style='margin: 0 auto; width:25%' href='adminpane.php?rodzaj'><button class='btn btn-lg w-100 mb-4' style='color:white;background-color:#2378ba;margin: 0 auto;' type='submit'>Dodaj rodzaj</button></a>
      <a style='margin: 0 auto; width:25%' href='adminpane.php?addProdukt'><button class='btn btn-lg w-100 mb-4' style='color:white;background-color:#2378ba;margin: 0 auto;' type='submit'>Dodaj produkt</button></a>
      <a style='margin: 0 auto; width:25%' href='adminpane.php?deleteProdukt'><button class='btn btn-lg w-100 mb-4' style='color:white;background-color:#2378ba;margin: 0 auto;' type='submit'>Usuń produkt</button></a>
      <div class="form-group " style="width:25%; margin: 0 auto;">


        <?php
        if (isset($_SESSION['admin']) && isset($_SESSION['loggedin'])) {
          if (isset($_GET['producent'])) {
            echo "
            <form method='POST' style='margin 0 auto;padding-top:30px'>
            <input class='form-control' type='text' placeholder='Nazwa producenta' name='producent' required>
            <button class='btn btn-lg w-100' style='color:white;background-color:#2378ba;' type='submit'>Dodaj</button>
            </form>
            
            ";
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
              global $conn;
              $nazwa = $_POST['producent'];
              $stid = oci_parse($conn, "begin dodajproducenta(:nazwaProducenta); end;");
              oci_bind_by_name($stid, ":nazwaProducenta", $nazwa);

              if (oci_execute($stid) === TRUE) {
                echo "Dodano nowy rekord";
              } else {
                echo "Błąd w dodawaniu rekordu <br> Sprawdź czy podałeś poprawne dane";
              }
            }
          }
          if (isset($_GET['rodzaj'])) {
            echo "
            <form method='POST' style='margin 0 auto;padding-top:30px'>
            <input class='form-control' type='text' placeholder='Nazwa rodzaju' name='rodzaj' required>
            <button class='btn btn-lg w-100' style='color:white;background-color:#2378ba;' type='submit'>Dodaj</button>
            </form>
            
            ";
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
              global $conn;
              $rodzaj = $_POST['rodzaj'];
              $stid = oci_parse($conn, "begin dodajrodzaj(:nazwaRodzaju); end;");
              oci_bind_by_name($stid, ":nazwaRodzaju", $rodzaj);
              
              if (oci_execute($stid) === TRUE) {
                echo "Dodano nowy rekord";
              } else {
                echo "Błąd w dodawaniu rekordu <br> Sprawdź czy podałeś poprawne dane";
              }
            }
          }
          if (isset($_GET['addProdukt'])) {
            echo "
            <form method='POST' style='margin 0 auto;padding-top:30px'>
            <input class='form-control' type='text' placeholder='Nazwa produktu' name='model' required>
            <input class='form-control' type='text' placeholder='Id producenta' name='id_producenta' required>
            <input class='form-control' type='text' placeholder='Id rodzaju' name='id_rodzaju' required>
            <input class='form-control' type='text' placeholder='Rok wydania produktu' name='rok' required>
            <input class='form-control' type='text' placeholder='Cena' name='cena' required>
            <input class='form-control' type='text' placeholder='Nazwa zdjęcia (np. obraz.png)' name='img' required>
            <small class='text-muted'>*zdjęcia powinny znajdować się w folderze ../img</small>
            <button class='btn btn-lg w-100' style='color:white;background-color:#2378ba;' type='submit'>Dodaj</button>
            </form>
            
            ";
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
              global $conn;
              $model = $_POST['model'];
              $id_producenta = $_POST['id_producenta'];
              $id_rodzaju = $_POST['id_rodzaju'];
              $rok = $_POST['rok'];
              $cena = $_POST['cena'];
              $img = $_POST['img'];
              $stid = oci_parse($conn, "begin dodajprodukt(:model, :id_producenta, :id_rodzaju, :rok, :cena, :img); end;");
              oci_bind_by_name($stid, ":model", $model);
              oci_bind_by_name($stid, ":id_producenta", $id_producenta);
              oci_bind_by_name($stid, ":id_rodzaju", $id_rodzaju);
              oci_bind_by_name($stid, ":rok", $rok);
              oci_bind_by_name($stid, ":cena", $cena);
              oci_bind_by_name($stid, ":img", $img);
              if (oci_execute($stid) === TRUE) {
                echo "Dodano nowy rekord";
              } else {
                echo "Błąd w dodawaniu rekordu <br> Sprawdź czy podałeś poprawne dane";
              }
            }
          }






          if (isset($_GET['deleteProdukt'])) {
            echo "
            <form method='POST' style='margin 0 auto;padding-top:30px'>
            <input class='form-control' type='text' placeholder='Id produktu który chcesz usunąć' name='id' required>
            <button class='btn btn-lg w-100' style='color:white;background-color:#2378ba;' type='submit'>Usuń</button>
            </form>
            
            ";
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
              global $conn;
              $id = $_POST['id'];
              $stid = oci_parse($conn, "begin usunprodukt(:id_produktu_in); end;");
              oci_bind_by_name($stid, ":id_produktu_in", $id);

              if (oci_execute($stid) === TRUE) {
                echo "Pomyślnie usunięto";
              } else {
                echo "Nie ma takiego id w bazie";
              }
            }
          }

        } else header('Location: index.php');
        ?>




      </div>
    </div>


  </div>






</body>

</html>