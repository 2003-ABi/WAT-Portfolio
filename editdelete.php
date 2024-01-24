<?php
include("session.php");
include("connection.php");
include('header.php');
if (isset($_SESSION['username']) && $_SESSION['role'] == 'admin') {
    include('vnav.php');
}
if (isset($_POST['update'])) {
    $productId = $_POST['productId'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $query = "UPDATE product SET name = '$name', description = '$description', price = '$price' WHERE id = $productId";
    mysqli_query($conn, $query);
    $updateSuccess = true;
}
if (isset($_POST['confirmDelete'])) {
    $productId = $_POST['productId'];
    $query = "DELETE FROM product WHERE id = $productId";
    mysqli_query($conn, $query);
    $deleteSuccess = true;
}
$query = "SELECT * FROM product";
$result = mysqli_query($conn, $query);
?>
<style>
    #product-table {
        margin-top:20px;
        margin-left: 200px;
        margin-right: 10px;
        border-collapse: collapse;
        width: 70%;
    }

    #product-table th,
    #product-table td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ddd;
    }

    #product-table th {
        background-color: #f2f2f2;
    }

    #product-table img {
        max-width: 100px;
        height: auto;
    }

    .edit-delete-links a {
        margin-right: 10px;
        text-decoration: none;
        color: #333;
        padding: 5px 10px;
        border-radius: 4px;
        border: 1px solid #ccc;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .edit-delete-links a:hover {
        background-color: #f2f2f2;
    }

    .form-container {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        width: 300px;
        text-align: left;
        margin-top: 20px;
    }

    .form-container h2 {
        color: #333;
        margin-bottom: 20px;
    }

    .form-container form {
        margin-top: 20px;
    }

    .form-container label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
    }

    .form-container input[type="text"],
    .form-container input[type="textarea"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .form-container input[type="submit"] {
        background-color: #000;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .form-container input[type="submit"]:hover {
        background-color: #333;
    }

    .form-container p {
        color: #ff0000;
        margin-top: 10px;
    }
    #edit-form {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        width: 300px;
        text-align: left;
        margin-left: 40%; /* Add margin-left property */
        margin-top: 3%;
    }
    .message-container {
        text-align: center;
        margin-top: 20px;
        font-weight: bold;
        color: #4CAF50; /* Green color for success messages */
    }
</style>
<?php
if (isset($updateSuccess) && $updateSuccess) {
    echo '<div class="message-container">Product updated successfully.</div>';
}

if (isset($deleteSuccess) && $deleteSuccess) {
    echo '<div class="message-container">Product deleted successfully.</div>';
}
echo "<table id='product-table' border=1>";
echo '<tr>';
echo '<th>Image</th>';
echo '<th>Name</th>';
echo '<th>Description</th>';
echo '<th>Price</th>';
echo '<th>Actions</th>';
echo '</tr>';

while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td><img src="upload/' . $row['filename'] . '" alt="' . $row['name'] . '"></td>';
    echo '<td>' . $row['name'] . '</td>';
    echo '<td>' . $row['description'] . '</td>';
    echo '<td>' . $row['price'] . '</td>';
    echo '<td class="edit-delete-links">';
    echo '<a href="?edit=' . $row['id'] . '">Edit</a>';
    echo '<a href="?delete=' . $row['id'] . '">Delete</a>';
    echo '</td>';
    echo '</tr>';
}
echo '</table>';
if (isset($_GET['edit'])) {
    $productId = $_GET['edit'];
    $query = "SELECT * FROM product WHERE id = $productId";
    $result = mysqli_query($conn, $query);
    $product = mysqli_fetch_assoc($result);
    echo '<div id="edit-form" class="form-container">';
    echo '<h2>Edit Product</h2>';
    echo '<form action="" method="POST">';
    echo '<input type="hidden" name="productId" value="' . ($product ? $product['id'] : '') . '">';
    echo 'Name: <input type="text" name="name" value="' . ($product ? $product['name'] : '') . '"><br>';
    echo 'Description: <textarea name="description">' . ($product ? $product['description'] : '') . '</textarea><br>';
    echo 'Price: <input type="text" name="price" value="' . ($product ? $product['price'] : '') . '"><br>';
    echo '<input type="submit" name="update" value="Update">';
    echo '</form>';
    echo '</div>';
}
if (isset($_GET['delete'])) {
    $productId = $_GET['delete'];
    $query = "DELETE FROM product WHERE id = $productId";
    mysqli_query($conn, $query);
    $deleteSuccess = true;
}
?>
<?php
include("footer.php");
?>