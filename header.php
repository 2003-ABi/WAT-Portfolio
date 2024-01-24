<link rel="stylesheet" href="./styles.css"/>
<link rel="stylesheet" href="./mediaqueries.css"/>
<script src="./script.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">

<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<div id="header-content">
<header>
    <nav id = "desktop-nav">
        <div class="logo"><a id="blogerz" href="index.php">WAT-PORTFOLIO</a></div>
    <div>
<ul class="nav-links">
<li><a href="index.php">Home</a></li>
<!-- <li><a href="portfolio.php">Portfolio</a></li> -->
<?php
if (isset($_SESSION['username']) && $_SESSION['role'] == 'admin') {
    echo '<li ><a href="dashboard.php">Dashboard</a></li>';
}
?>
<?php
if (isset($_SESSION['username']) && $_SESSION['role'] != 'admin'){
    echo '<li><a href="viewproducts.php">View Product</a></li>';
}
if (isset($_SESSION['username'])) {
    echo'<li><a style="color:Red; text-decoration:none;" href="logout.php">Logout</a></li>';
}
else{
echo'<li><a href="login.php">Login</a></li>';
echo'<li><a href="register.php">Register</a></li>';
}
?>
<li><form method="POST" action="search.php">
    <input type="text" class="search" placeholder="Search product" name="search">
    <button class="ri-search-line nav__search" type="submit" name="submit" id="search-btn"></button></li></a>
</form></li>
</ul>
</div>
</header>
</div>