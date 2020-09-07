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
    <div class='dwa' style='background-color:#256291;min-height: 86vh;padding-left:15%;color:white; '>
        <h6 style='font-size:4vw;'>O nas</h6>
        <p style='font-size:2vw;'>Lorem ipsum </br>
            Lorem ipsum Lorem ipsum </br></br></br>
            Lorem ipsum Lorem ipsum Lorem ipsum</br>
            Lorem ipsum Lorem ipsum</br></br></br>
            Lorem ipsum Lorem ipsum Lorem ipsum Lorem </br>
            Lorem ipsum Lorem ipsum </br>
            Lorem ipsum Lorem ipsum Lorem ipsum

        </p>

    </div>
    <?php include('footer.php'); ?>
</body>

</html>