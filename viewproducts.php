<?php
 session_start();
if(!isset($_SESSION["username"])){
    header("Location: login.php");
}
?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include('header.php');
    if (isset($_SESSION['username']) && $_SESSION['role'] == 'admin') {
      include('vnav.php');
  }

?>
  
  <meta charset="UTF-8">
  <title>View Products</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0px;
      background-color: #f4f4f4;
    }
    
    h1 {
      text-align: center;
    }

    .search-sort-container {
      float: left;
      margin-left: 30px;
      margin-bottom: 10px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      padding: 20px;
      box-sizing: border-box;
    }

    .search-sort-container label {
      display: block;
      margin-bottom: 10px;
      font-weight: bold;
    }

    .search-sort-container .checkbox-group {
      display: flex;
      align-items: center;
     
    }
    .search-sort-container input[type="radio"] {
  margin: 0 5px 0 0; 
}

.search-sort-container label {
  margin-bottom: 0; 
}

    .search-sort-container input[type="text"],
    .search-sort-container input[type="radio"],
    .search-sort-container input[type="submit"] {
      width: calc(100% - 22px);
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .search-sort-container input[type="radio"] {
      width: auto;
      margin-bottom: 0;
    }

    .search-sort-container input[type="submit"] {
      background-color: #000;
      color: #fff;
      cursor: pointer;
    }

    .search-sort-container input[type="submit"]:hover {
      background-color: #333;
    }

    .products-container {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 20px;
      margin:0 auto; 
      max-width: 1200px;
      position:relative;
      right:90px;
      left:-90px;
      margin-bottom:5%;
    }
    
    .product {
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      padding: 20px;
      box-sizing: border-box;
    }
    
    .product img {
      width: 100%;
      height: auto;
      border-radius: 5px;
      margin-bottom: 15px;
    }
    
    .product p {
      margin: 0;
      font-size: 18px;
      text-align: center;
    }
    
    .product .price {
      color: grey; 
      font-weight: bold;
      margin-top: 10px;
    }
    #category {
  width: 100%;
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  background-color: #fff;
  color: #333;
  cursor: pointer;
}

#category:hover {
  background-color: #f9f9f9;
}

#category:focus {
  outline: none;
  border-color: #007bff;
  box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}
#search_item {
  width: 100%;
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

#search_item:hover {
  border-color: #007bff;
}

#search_item:focus {
  outline: none;
  border-color: #007bff;
  box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}
    
  </style>
</head>
<body>
    <br>
  <h1>Products</h1>
  <br>

  <div class="search-sort-container">
    <form method="GET" action="">
      <label for="search_item">Search:</label><br>
      <input type="text" name="search_item" id="search_item" placeholder="Enter search keyword">
      <br><br>
      <label>Sort By:</label>
      <br>
      <div class="checkbox-group">
        <input type="radio" name="sort_by" id="sort_by_name" value="name">
        <label for="sort_by_name">Name</label>
      </div>
      <br>
      <div class="checkbox-group">
        <input type="radio" name="sort_by" id="sort_by_price" value="price">
        <label for="sort_by_price">Price</label>
      </div><br>
  
      <input type="submit" value="Search">
      <label for="category">Category</label>
      <br>
      <select name="cid" id="category">
        <option value="">Select category</option>
        <option value="Nike">Nike</option>
        <option value="Adidas">Adidas</option>
        <option value="NewBalance">NewBalance</option>
        <option value="Skechers">Skechers</option>
      </select>
      <br><br>
      <input type="submit" name="category_submit" value="Category-Filter">
    
    </form>
  </div>

  <div class="products-container">
    <?php
      // Include the connection file
      include 'connection.php';
      $search_item = $_GET['search_item'] ?? '';
      $sort_by = $_GET['sort_by'] ?? '';
      $category = $_GET['cid'] ?? '';
    
      if (!empty($search_item)) {
        $sql = "SELECT filename, name, price FROM product WHERE name LIKE ?";
        $stmt = $conn->prepare($sql);
  
        if ($stmt) {
          $search_param = "%{$search_item}%";
          $stmt->bind_param("s", $search_param);
          $stmt->execute();
          $result = $stmt->get_result();
          $stmt->close();
        } else {
          echo "Error in the prepared statement";
        }
      } elseif (!empty($category)) {
        $sql = "SELECT filename, name, price FROM product WHERE cid = ?";
        $stmt = $conn->prepare($sql);
  
        if ($stmt) {
          $stmt->bind_param("s", $category);
          $stmt->execute();
          $result = $stmt->get_result();
          $stmt->close();
        } else {
          echo "Error in the prepared statement";
        }
      } else {
        // Modify the SQL query based on the sort criteria
        $sql = "SELECT filename, name, price FROM product";
        if ($sort_by === 'name') {
          $sql .= " ORDER BY name";
        } elseif ($sort_by === 'price') {
          $sql .= " ORDER BY price";
        }
      
        $result = $conn->query($sql);
      }
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<div class='product'>";
          echo "<img src='upload/" . $row["filename"] . "' alt='Product Image'>";
          echo "<p> " . $row["name"] . "</p>";
          echo "<p class='price'>Price: $" . $row["price"] . "</p>";
          echo "</div>";
        }
      } else {
        echo "<h3 style='text-align:center;margin-top:254px;position:relative;left:450px;color:#E6A4B4;font-size:20px;'>No Products Found!!</h3>";
      }
      $conn->close();
    ?>
  </div>
</body>
<?php include("footer.php")?>
</html>
