<?php
include_once 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        die("Verbindung zur Datenbank fehlgeschlagen: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header("Location: home.php"); 
            exit();
        } else {
            echo "Ungültige Anmeldeinformationen!";
        }
    } else {
        echo "Ungültige Anmeldeinformationen!";
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            background-color: <?php echo BACKGROUND_COLOR; ?>;
            background-image: url(<?php echo BACKGROUND_IMAGE_URL; ?>);
            background-repeat: no-repeat;
            background-size: cover;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: <?php echo FORM_COLOR; ?>;
            padding: 20px;
            border-radius: 5px;
            box-shadow: <?php echo shadow; ?>;
            width: 300px;
            position: relative;
        }

        h2 {
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"] {
            width: calc(100% - 12px);
            padding: 6px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 8px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            width: 80px; 
            height: auto;
        }
    </style>
</head>
<body>
    <form method="post" action="">
        <div class="logo-container">
            <img src="<?php echo LOGO_URL; ?>" alt="Logo" class="logo">
            <h3><?php echo COMPANY_NAME; ?></h3>
        </div>
        <h2>Login</h2>
        <label for="username">Benutzername:</label>
        <input type="text" id="username" name="username">
        <label for="password">Passwort:</label>
        <input type="password" id="password" name="password">
        <input type="submit" value="Login">
        <a>Dont have a account? Register</a><a href="register.php"> here.</a>
    </form>
</body>
</html>


