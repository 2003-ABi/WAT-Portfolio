<?php 
if(isset($_POST['submit'])){
    $search = $_POST['search'];
    header("Location: viewproducts.php?search_item=$search");
}

?>