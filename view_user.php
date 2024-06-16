<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require_once "App/User.php";

        if(isset($_GET['del'])) {
            if($User->deleteUser($_GET['del'])) echo "<script>alert('data berhasil dihapus'); location.href='view_user.php';</script>";
            else echo "<script>alert('gagal menghapus data')</script>";
        }
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body>
    <?php include_once "nav.html" ?>
    <main class="grid flex-row w-full p-5 justify-items-center">
        <header class="flex mb-5 justify-between w-9/12">
            <h1 class="page-title capitalize font-bold text-2xl">data user</h1>
            <a href="form_user.php" class="py-1 px-4 rounded bg-blue-500 font-bold tracking-wider uppercase text-white">add user</a>
        </header>

        <?php foreach($User->getAllUser() as $user) { ?>
        <section class="card-container p-4 mb-10 rounded-lg flex-row w-9/12 bg-gray-100 shadow-md">
            <div class="card-head flex w-full mb-3 justify-between">
                <div class="left grow font-bold">
                    <h1>(<?= $user['user_id'] ?>) <?= $user['roles'] ?> - <?= $user['username'] ?></h1>
                </div>
                <div class="right text-sm uppercase">
                    <a href="form_user.php?update=<?= $user['user_id'] ?>" class="py-1 px-4 rounded bg-yellow-500 font-bold tracking-wide me-2">update</a>
                    <?php if($user['roles'] == 'user') : ?>
                    <a href="?del=<?= $user['user_id'] ?>" class="py-1 px-4 rounded bg-red-500 font-bold tracking-wide" 
                        onclick="return confirm('Yakin ingin delete akun milik <?= $user['username'] ?> dengan ID : <?= $user['user_id'] ?>?')">delete</a>
                    <?php endif ?>
                </div>
            </div>
            <div class="card-body flex w-full">
                <div class="left w-6/12">
                    <div class="card-item py-1">
                        <span class="text-xs uppercase tracking-wider text-gray-500">fullname</span>
                        <p><?= $user['full_name'] ?></p>
                    </div>
                    <div class="card-item py-1">
                        <span class="text-xs uppercase tracking-wider text-gray-500">email</span>
                        <p><?= $user['email'] ?></p>
                    </div>
                </div>
                <div class="right w-6/12">
                    <div class="card-item py-1">
                        <span class="text-xs uppercase tracking-wider text-gray-500">no telp</span>
                        <p><?= $user['no_telp'] ?></p>
                    </div>
                    <div class="card-item py-1">
                        <span class="text-xs uppercase tracking-wider text-gray-500">address</span>
                        <p><?= $user['address'] ?></p>
                    </div>
                </div>
            </div>
        </section>
        <?php } ?>
    </main>
</body>
</html>