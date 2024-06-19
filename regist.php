<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        session_start();
        require_once 'App/User.php';

        if(isset($_POST['regist'])) {
            if($User->regist($_POST)) {
                echo "<script>alert('regist berhasil, silahkan login'); location.href='index.php';</script>";
            } else echo "gagal regist";
        }
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Regist</title>
</head>
<body>
    <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-lg text-center">
            <h1 class="text-2xl font-bold sm:text-3xl">Register</h1>
        </div>
        <form action="regist.php" method="post" class="mx-auto mb-0 mt-8 max-w-md space-y-4">
            <input type="hidden" name="role" value="user">
            <div>
                <label for="username" class="sr-only">Username</label>
                <div class="relative">
                    <input
                        type="text"
                        name="username"
                        class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-md"
                        placeholder="Enter username"/>
                </div>
            </div>
            <div>
                <label for="fullname" class="sr-only">Fullname</label>
                <div class="relative">
                    <input
                        type="text"
                        name="fullname"
                        class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-md"
                        placeholder="Enter fullname"/>
                </div>
            </div>
            <div>
                <label for="email" class="sr-only">Email</label>
                <div class="relative">
                    <input
                        type="email"
                        name="email"
                        class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-md"
                        placeholder="Enter email"/>
                </div>
            </div>
            <div>
                <label for="no_telp" class="sr-only">No Telp</label>
                <div class="relative">
                    <input
                        type="text"
                        name="no_telp"
                        class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-md"
                        placeholder="Enter phone number"/>
                </div>
            </div>
            <div>
                <label for="pass" class="sr-only">Password</label>
                <div class="relative">
                    <input
                        type="password"
                        name="pass"
                        class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-md"
                        placeholder="Enter password"/>
                </div>
            </div>
            <div>
                <label for="pass" class="sr-only">Password</label>
                <div class="relative">
                    <textarea name="address" placeholder="Enter address" 
                    class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-md"></textarea>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <p class="text-sm text-gray-500">
                    Already have an account?
                    <a class="underline" href="index.php">Sign in</a>
                </p>
                <input
                    type="submit"
                    name="regist"
                    class="inline-block rounded-lg bg-blue-500 px-5 py-3 text-sm font-medium text-white"
                    value="Sign Up">
            </div>
        </form>
    </div>
</body>
</html>