<?php
session_start();
include("connection.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = md5($_POST["password"]);

    // Query to fetch user details based on username and plain text password
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) === 1) {
        
        // If credentials match, set session variable and redirect
        $user = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $user['role']; // Assuming the role column name is 'role'
        header("Location: dashboard.php");
        exit();
    } else {
        // If credentials don't match, show an error
        $error = "Invalid username or password";
    }
}
if (isset($_GET['registration']) && $_GET['registration'] === 'success') {
    echo "<p class=reg-succ>Registration successful! Please login.</p>";
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php
    include("header.php");
    ?>
    <style>
        #login-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 45px;
            width: 300px;
            text-align: left;
            margin-left:40%;
            margin-top:8%;
            margin-bottom:5%;
            
        }
        #login-container h2 {
            color: #333;
        }

        #login-container form {
            margin-top: 20px;
        }

        #login-container label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        #login-container input[type="text"],
        #login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        #login-container input[type="submit"] {
            background-color: #000;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-left:100px;
            
        }

        #login-container input[type="submit"]:hover {
            background-color: #333;
        }

        #login-container p {
            color: #ff0000;
            margin-top: 10px;
        }
        .reg-succ{
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
            color: #4CAF50;
            position:absolute;
            top:25%;
            right:42%;
        }
    </style>
</head>
<body>
<div id="login-container">
    <h2>Login</h2>
    <?php if (isset($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>
    <form method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <input type="checkbox" onclick="togglePasswordVisibility()">Show Password<br><br>
        <p style="color:Black;">Not Registered? <a style="color:Blue; text-decoration: none; " href="register.php">Register here</a> </p><br><br>
        <input type="submit" value="Login">
    </form>
    </div>
</body>
<script>
        function togglePasswordVisibility() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
<?php
include("footer.php");
?>
</html>
