<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        session_start();
        require_once 'App/User.php';

        if(isset($_POST['login'])) {
            if($User->login($_POST)) {
                header('Location: view_product.php');
            } else echo "gagal login";
        }
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login</title>
</head>
<body>
    <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-lg text-center">
            <h1 class="text-2xl font-bold sm:text-3xl">Login</h1>
        </div>
        <form action="index.php" method="post" class="mx-auto mb-0 mt-8 max-w-md space-y-4">
            <div>
                <label for="username" class="sr-only">Email</label>
                <div class="relative">
                    <input
                        type="text"
                        name="username"
                        class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-md"
                        placeholder="Enter username"/>
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
            <div class="flex items-center justify-between">
                <p class="text-sm text-gray-500">
                    No account?
                    <a class="underline" href="regist.php">Sign up</a>
                </p>
                <input
                    type="submit"
                    name="login"
                    class="inline-block rounded-lg bg-blue-500 px-5 py-3 text-sm font-medium text-white"
                    value="Sign In">
            </div>
        </form>
    </div>
</body>
</html>