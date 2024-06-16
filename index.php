<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        require_once 'App/User.php';

        if(isset($_POST['login'])) {
            if($User->login($_POST)) {
                header('Location: dashboard.php');
            } else echo "gagal login";
        }
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login</title>
</head>
<body>
    <form action="index.php" method="post">
        <input type="text" name="username" id="" placeholder="username">
        <input type="password" name="pass" id="" placeholder="Password">
        <input type="submit" name="login" value="login">
    </form>
</body>
</html>