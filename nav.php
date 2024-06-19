<?php 
    require_once 'App/User.php';
    if(!isset($_SESSION['user_id'])) header("Location: index.php");
    if(isset($_GET['logout'])) $User->logout();
?>
<nav class="w-full px-6 py-3 mx-auto flex justify-between">
    <div class="left">
        <a href="view_product.php" class="capitalize font-bold text-lg text-gray-700 hover:text-gray-950">
            home - <?= $_SESSION['username'] ?> 
        </a>
    </div>
    <div class="center grow flex justify-center">
        <?php if($_SESSION['role'] == 'admin') : ?>
        <a href="view_user.php" class="capitalize font-bold text-lg text-gray-700 hover:text-gray-950 px-3">user</a>
        <a href="view_purchases.php" class="capitalize font-bold text-lg text-gray-700 hover:text-gray-950 px-3">purchase</a>
        <?php else : ?>
        <a href="history.php" class="capitalize font-bold text-lg text-gray-700 hover:text-gray-950 px-3">history</a>
        <?php endif ?>
    </div>
    <div class="right">
        <?php 
            $logout_url = str_contains($_SERVER['REQUEST_URI'], "?") ? $_SERVER['REQUEST_URI'].'&logout' : '?logout';

        ?>
        <a href="<?= $logout_url ?>" 
        class="capitalize font-bold text-lg text-red-700 hover:text-red-900">
            logout
        </a>
    </div>
</nav>