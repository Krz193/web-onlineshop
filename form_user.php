<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require_once 'App/User.php';

        if(isset($_POST['add_user'])) {
            if($User->regist($_POST)) {
                echo "<script>alert('data berhasil ditambahkan')</script>";
                header("Location: view_user.php");
            } else echo "<script>alert('gagal menambah data')</script>";
        }

    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Product</title>
</head>
<body>
    <?php include_once "nav.html" ?>
    <main class="grid flex-row w-full p-5 justify-items-center">
        <section class="item p-6 mb-6 rounded-lg flex-row w-5/12 bg-gray-100 shadow-lg">
            <form action="form_user.php" method="post">
                <header class="flex mb-5 justify-between w-full">
                    <h1 class="page-title capitalize font-bold text-2xl">add user</h1>
                    <a href="view_user.php" class="py-1 px-4 rounded bg-blue-500 font-bold tracking-wider uppercase text-white hover:bg-blue-700 transition-all">back</a>
                </header>

                <div class="form-item flex flex-col py-2">
                    <span class="uppercase text-xs text-gray-500 tracking-wider">username</span>
                    <input type="text" name="username" class="py-1 px-2 rounded shadow-md">
                </div>
                <div class="form-item flex flex-col py-2">
                    <span class="uppercase text-xs text-gray-500 tracking-wider">role</span>
                    <select name="role" class="py-1 px-2 rounded shadow-md capitalize">
                        <option disabled selected class="text-center">-- select role --</option>
                        <option value="admin">admin</option>
                        <option value="user">user</option>
                    </select>
                </div>
                <div class="form-item flex flex-col py-2">
                    <span class="uppercase text-xs text-gray-500 tracking-wider">password</span>
                    <input type="password" name="pass" class="py-1 px-2 rounded shadow-md">
                </div>
                <div class="form-item flex flex-col py-2">
                    <span class="uppercase text-xs text-gray-500 tracking-wider">email</span>
                    <input type="text" name="email" class="py-1 px-2 rounded shadow-md">
                </div>
                <div class="form-item flex flex-col py-2">
                    <span class="uppercase text-xs text-gray-500 tracking-wider">fullname</span>
                    <input type="text" name="fullname" class="py-1 px-2 rounded shadow-md">
                </div>
                <div class="form-item flex flex-col py-2">
                    <span class="uppercase text-xs text-gray-500 tracking-wider">no telp</span>
                    <input type="text" name="no_telp" class="py-1 px-2 rounded shadow-md">
                </div>
                <div class="form-item flex flex-col py-2">
                    <span class="uppercase text-xs text-gray-500 tracking-wider">address</span>
                    <textarea type="text" name="address" class="py-1 px-2 rounded shadow-md"></textarea>
                </div>
                <div class="form-item flex flex-col py-2">
                    <input type="submit" name="add_user" 
                    class="bg-blue-500 py-1 px-2 rounded shadow-md capitalize font-medium tracking-wide text-white cursor-pointer hover:bg-blue-700 transition-all" 
                    value="submit">
                </div>
            </form>
        </section>
    </main>
</body>
</html>