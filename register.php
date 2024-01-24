<?php
require_once 'connection.php';

// Initialize registration error
$registrationError = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $age = $_POST["age"];
    $termsAndConditions = isset($_POST["terms"]) ? true : false;

    // Validate form data
    if (strlen($username) < 6) {
        $registrationError = "Username should have at least 6 characters.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $registrationError = "Invalid email format.";
    } elseif (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/", $password)) {
        $registrationError = "Password should have at least one uppercase letter, one lowercase letter, and a number.";
    } elseif (!$termsAndConditions) {
        $registrationError = "Please accept the terms and conditions.";
    } else {
        $hashedpassword = md5($password);
        // Insert data into the database
        $sql = "INSERT INTO users (username, email, password, age) VALUES ('$username', '$email', '$hashedpassword', '$age')";
        if (mysqli_query($conn, $sql)) {
            header("Location: login.php?registration=success");
        } else {
            $registrationError = "Registration failed: " . mysqli_error($conn);
        }
    }
}

// Close the connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <?php include_once('header.php');
    ?>
    <style>
        #register-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 400px;
            text-align: left;
            margin-left: 40%;
            margin-top: 8%;
            margin-bottom: 5%;
        }

        #register-container h2 {
            color: #333;
        }

        #register-container form {
            margin-top: 5px;
        }

        #register-container label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        #register-container input[type="text"],
        #register-container input[type="email"],
        #register-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        #register-container select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        #register-container input[type="checkbox"] {
            margin-bottom: 10px;
            display: inline-block;
        }
        #register-container label[for="terms"] {
            display: inline-block; 
            margin-bottom: 10px;
        }

        #register-container input[type="submit"] {
            background-color: #000;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 100px;
        }

        #register-container input[type="submit"]:hover {
            background-color: #333;
        }

        #register-container p {
            color: #ff0000;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div id="register-container">
        <h2>Register</h2>
        <?php if (!empty($registrationError)) { ?>
            <p><?php echo $registrationError; ?></p>
        <?php } ?>
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <label for="username">Username:</label>
            <input type="text" name="username" required><br><br>
            <label for="email">Email:</label>
            <input type="email" name="email" required><br><br>
            <label for="password">Password:</label>
            <input id="password" type="password" name="password" required>
            <input type="checkbox" onclick="togglePasswordVisibility()">Show Password<br><br>
            <label for="age">Age:</label>
            <select id="age" name="age">
                <?php
                for ($i = 18; $i <= 150; $i++) {
                    echo "<option value=\"$i\">$i</option>";
                }
                ?>
            </select><br><br>
            <input type="checkbox" name="terms">
            <label for="terms">I accept the terms and conditions</label><br><br>
            <input type="submit" value="Register">
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
