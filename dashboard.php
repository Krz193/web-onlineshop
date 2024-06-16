<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require_once 'App/User.php';

        if(isset($_GET['logout'])) $User->logout();
    ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body>
    halo
    <a href="?logout=1">logout</a>

    <a href="view_product.php">view product</a>
</body>
</html>