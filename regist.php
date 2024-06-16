<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        require_once 'App/User.php';

        if(isset($_POST['regist'])) {
            if($User->regist($_POST)) {
                echo "<script>alert('regist berhasil, silahkan login')</script>";
                header('Location: index.php');
            } else echo "gagal regist";
        }
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Regist</title>
</head>
<body>
    <form action="regist.php" method="post">
        <input type="text" name="username" id="" placeholder="username">
        <input type="text" name="fullname" id="" placeholder="full name">
        <input type="text" name="email" id="" placeholder="email">
        <input type="password" name="pass" id="" placeholder="Password">
        <input type="text" name="no_telp" id="" placeholder="no telp">
        <input type="hidden" name="role" value="user">
        <textarea name="address" id="" placeholder="address"></textarea>
        <input type="submit" name="regist" value="register">
    </form>
</body>
</html>