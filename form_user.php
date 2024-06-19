<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        session_start();
        require_once 'App/User.php';

        if(isset($_POST['add_user'])) {
            if($User->regist($_POST)) echo "<script>alert('data berhasil ditambahkan'); location.href='view_user.php';</script>";
            else echo "<script>alert('gagal menambah data')</script>";
        }

        if(isset($_GET['update'])) $unedited = $User->getUser($_GET['update']); 
        if(isset($_POST['edit_user'])) {
            if($User->updateUser($_POST)) echo "<script>alert('data berhasil diubah'); location.href='view_user.php';</script>";
            else echo "<script>alert('gagal mengubah data')</script>";
        }

    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Users</title>
</head>
<body>
    <?php include_once "nav.php" ?>
    <main class="grid flex-row w-full p-5 justify-items-center">
        <section class="item p-6 mb-6 rounded-lg flex-row w-5/12 bg-gray-100 shadow-lg">
            <form action="form_user.php" method="post">
                <header class="flex mb-5 justify-between w-full">
                    <h1 class="page-title capitalize font-bold text-2xl">add user</h1>
                    <a href="view_user.php" class="py-1 px-4 rounded bg-blue-500 font-bold tracking-wider uppercase text-white hover:bg-blue-700 transition-all">back</a>
                </header>

                <div class="form-item flex flex-col py-2">
                    <span class="uppercase text-xs text-gray-500 tracking-wider">username</span>
                    <input type="hidden" name="user_id" value="<?= $unedited['user_id'] ?>">
                    <input type="text" name="username" class="py-1 px-2 rounded shadow-md" value="<?= (isset($_GET['update'])) ? $unedited['username'] : "" ?>">
                </div>
                <div class="form-item flex flex-col py-2">
                    <span class="uppercase text-xs text-gray-500 tracking-wider">role</span>
                    <select name="role" class="py-1 px-2 rounded shadow-md">
                        <option disabled selected class="text-center">-- select role --</option>
                        <option value="admin" <?= (isset($_GET['update'])) ? (($unedited['roles']=='admin') ? 'selected' : '') :'' ?> >admin</option>
                        <option value="user" <?= (isset($_GET['update'])) ? (($unedited['roles']=='user') ? 'selected' : '') :'' ?> >user</option>
                    </select>
                </div>
                <div class="form-item flex flex-col py-2">
                    <span class="uppercase text-xs text-gray-500 tracking-wider">password</span>
                    <input type="password" name="pass" class="py-1 px-2 rounded shadow-md" value="<?= (isset($_GET['update'])) ? $unedited['password'] : "" ?>">
                </div>
                <div class="form-item flex flex-col py-2">
                    <span class="uppercase text-xs text-gray-500 tracking-wider">email</span>
                    <input type="text" name="email" class="py-1 px-2 rounded shadow-md" value="<?= (isset($_GET['update'])) ? $unedited['email'] : "" ?>">
                </div>
                <div class="form-item flex flex-col py-2">
                    <span class="uppercase text-xs text-gray-500 tracking-wider">fullname</span>
                    <input type="text" name="fullname" class="py-1 px-2 rounded shadow-md" value="<?= (isset($_GET['update'])) ? $unedited['full_name'] : "" ?>">
                </div>
                <div class="form-item flex flex-col py-2">
                    <span class="uppercase text-xs text-gray-500 tracking-wider">no telp</span>
                    <input type="text" name="no_telp" class="py-1 px-2 rounded shadow-md" value="<?= (isset($_GET['update'])) ? $unedited['no_telp'] : "" ?>">
                </div>
                <div class="form-item flex flex-col py-2">
                    <span class="uppercase text-xs text-gray-500 tracking-wider">address</span>
                    <textarea type="text" name="address" class="py-1 px-2 rounded shadow-md"><?= (isset($_GET['update'])) ? $unedited['address'] : "" ?></textarea>
                </div>
                <div class="form-item flex flex-col py-2">
                    <input type="submit" name="<?= (isset($_GET['update'])) ? 'edit_user' : 'add_user'; ?>"
                    class="bg-blue-500 py-1 px-2 rounded shadow-md capitalize font-medium tracking-wide text-white cursor-pointer hover:bg-blue-700 transition-all" 
                    value="submit" id="btn-submit">
                </div>
            </form>
        </section>
    </main>
</body>
</html>