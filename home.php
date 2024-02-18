<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include_once 'config.php';
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-color: <?php echo BACKGROUND_COLOR; ?>;
            color: <?php echo COLOR; ?>;
            background-image: url(<?php echo BACKGROUND_IMAGE_URL; ?>);
            
        }
    </style>
</head>
<body class="">
    <div class="container mx-auto">
        <h2 class="text-2xl font-bold">Willkommen, <?php echo $_SESSION['username']; ?> auf <?php echo COMPANY_NAME; ?>!</h2>
        <p class="mt-4">Dies ist die geschützte Startseite.</p>
        <a href="logout.php" class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Ausloggen</a>
    </div>
</body>
</html>
