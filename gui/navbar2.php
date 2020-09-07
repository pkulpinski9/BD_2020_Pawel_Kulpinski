<nav class="navbar navbar-expand-lg justify-content-end fixed-top px-0 py-0 mx-0 my-0 w-100">

<a class="navbar-brand logo pl-3 py-2" href="index.php"><img src="img/logo.png" alt="LOGO" width="40px"></a>
<?php 
echo "<b>Witaj &nbsp </b>".$_SESSION['nazwa_uzytkownika'];
?>
<button class="navbar-toggler ml-auto mr-1" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
    <i class="fas fa-bars fa-2x" style="color:white;"></i>
</button>
<style>
    .dot {
			height: 20px;
			width: 20px;
			background-color: white;
			border-radius: 50%;
			display: inline-block;
            color:black;
            margin-right: 3px;
            text-align: center;
            line-height: 20px;
            padding-left: 2px;
		  }
</style>

<div class="collapse navbar-collapse flex-grow-0 ml-auto" id="navbarSupportedContent">
    <ul class="navbar-nav text-right">
    <?php 
            if($_SESSION['nazwa_uzytkownika']=='admin'){
                echo "<li class='nav-item'>
                <a href='adminpane.php' class='nav-link text-center px-3 py-3 w-100 h-100 mx-auto' style='text-decoration: none;'>PANEL</a>
                </li>";
            }
        ?>
        <li class="nav-item">
            <a href="index.php" class="nav-link text-center px-3 py-3 w-100 h-100 mx-auto" style="text-decoration: none;">STRONA GŁÓWNA</a>
        </li>       			

        <li class="nav-item">
            <a href="onas.php" class="nav-link text-center px-3 py-3 w-100 h-100 mx-auto" style="text-decoration: none;">O NAS</a>
        </li>
        <li class="nav-item">
            <a href="logout.php" class="nav-link text-center px-3 py-3 w-100 h-100 mx-auto" style="text-decoration: none;">WYLOGUJ</a>
            </li>
        <li class="nav-item">
            <a href="cart.php" class="nav-link text-center px-3 py-3 w-100 h-100 mx-auto" style="text-decoration: none;"><span class="dot"><?php 
            if(empty($_SESSION['cart'])) $_SESSION['total']=0;
            else $_SESSION['total']=count($_SESSION['cart']);
            echo $_SESSION['total'];?></span>KOSZYK</a>
        </li>					
    </ul>
</div>

</nav>