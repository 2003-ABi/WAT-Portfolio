<?php 
    session_start();
    if (isset($_SESSION['username']) && $_SESSION['role'] != 'admin'){
        header("Location: viewproducts.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php 
    
    include("header.php");
    

    if (isset($_SESSION['username']) && $_SESSION['role'] == 'admin') {
        include('vnav.php');
    }
    ?>
</head>
<style>
   
   .upload-form {
    max-width: 400px;
    margin: 0 auto;
    margin-top:130px;
    margin-bottom:200px;
}

.form-input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.file-upload {
    display: none;
}

.custom-file-upload {
    background-color: #161A30;
    color: #fff;
    text-align: center;
    padding: 10px;
    border-radius: 5px;
    cursor: pointer;
    display: inline-block;
}

.submit-button {
    background-color: #829460;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-left:180px;
}

.submit-button:hover {
    background-color: #218838;
}
 .up-title{
    position: relative;
    text-align:center;
    top:70px;
}
</style>
<body>
    <?php 
    include("connection.php");
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $temp_name = $_FILES["upload"]["name"];
        $type = $_FILES["upload"]["type"];
        $cid = $_POST["cid"];
        $description = $_POST["description"];
        $price = $_POST["price"];
        $name = $_POST["name"]; 
        $sql = "INSERT INTO product (cid, name, description, price, filename) VALUES ('$cid', '$name', '$description', '$price', '$temp_name')";
        
        if(mysqli_query($conn, $sql)) {
            echo "Data inserted successfully!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        
        if ($type == "image/png" || $type == "image/jpg" || $type == "image/jpeg") {
            $tmpname = $_FILES["upload"]["tmp_name"];
        } else {
            echo "<script>
                    alert('Please upload an image');
                    window.location.href='dashboard.php';
                  </script>";
            exit;
        }    
        $uploadlocation = "upload/".$temp_name;

        if(move_uploaded_file($tmpname, $uploadlocation)){
            echo "File uploaded successfully!";
        } else {
            echo "Unable to upload file";
        }
    }
    ?>
    <div class="up-title"><h1>Upload A Product!!</h1></div>
    
    <form method="post" name="imgupload" enctype="multipart/form-data" class="upload-form">
    <input type="text" name="cid" placeholder="Category ID" class="form-input">
    <input type="text" name="name" placeholder="Name" class="form-input">
    <input type="text" name="description" placeholder="Description" class="form-input">
    <input type="text" name="price" placeholder="Price" class="form-input">
    <label for="file-upload" class="custom-file-upload">
        <i class="ri-upload-line"></i> Choose File
    </label>
    <input id="file-upload" type="file" name="upload" class="file-upload">
    <input type="submit" name="submit" value="Upload" class="submit-button"> 
</form>
</body>
<?php include("footer.php")?>
</html>