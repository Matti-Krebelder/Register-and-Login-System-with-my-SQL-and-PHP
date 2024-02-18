<?php
include_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        echo "Passwort und Bestätigung stimmen nicht überein.";
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        die("Verbindung zur Datenbank fehlgeschlagen: " . $conn->connect_error);
    }

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
    if ($conn->query($sql) === TRUE) {
        header("Location: login.php");
        
    } else {
        echo "Fehler: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrierung</title>
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
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
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
        <h2>Registrierung</h2>
        <label for="username">Benutzername:</label>
        <input type="text" id="username" name="username">
        <label for="password">Passwort:</label>
        <input type="password" id="password" name="password">
        <label for="confirm_password">Passwort bestätigen:</label>
        <input type="password" id="confirm_password" name="confirm_password">
        <input type="submit" value="Registrieren">
        <a>Already registered? Login</a><a href="login.php"> here.</a>
    </form>
</body>
</html>

