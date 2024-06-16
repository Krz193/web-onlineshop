<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require_once 'App/Product.php';

        if(isset($_POST['add_category'])) {
            if($Product->addCategory($_POST)) echo "<script>alert('data berhasil ditambahkan'); location.href='view_category.php';</script>";
            else echo "<script>alert('gagal menambah data')</script>";
        }

        if(isset($_GET['update'])) $unedited = $Product->getCategory($_GET['update']); 
        if(isset($_POST['edit_category'])) {
            if($Product->updateCategory($_POST)) echo "<script>alert('data berhasil diubah'); location.href='view_category.php';</script>";
            else echo "<script>alert('gagal mengubah data')</script>";
        }
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Category</title>
</head>
<body>
    <?php include_once "nav.php" ?>
    <main class="grid flex-row w-full p-5 justify-items-center">
        <header class="flex mb-5 justify-between w-9/12">
            <h1 class="page-title capitalize font-bold text-2xl">data category</h1>
            <a href="view_category.php" class="py-1 px-4 rounded bg-blue-500 font-bold tracking-wider capitalize text-white shadow-md bg-blue-500 hover:bg-blue-700 transition-all">back</a>
        </header>

        <section class="item p-4 mb-6 rounded-lg flex-row w-9/12 bg-gray-100 shadow-md">
            <form action="" method="post" class="">

                <?php if(isset($_GET['update'])) : ?>
                <input type="hidden" name="category_id" value="<?= $unedited['category_id'] ?>">
                <?php endif ?>

                <div class="form-item flex flex-col p-2">
                    <span class="uppercase text-xs text-gray-500 tracking-wider">category name</span>
                    <input type="text" name="category_name" class="py-1 px-2 rounded shadow-md" value="<?= (isset($_GET['update'])) ? $unedited['category_name'] : '' ?>">
                </div>
                <div class="form-item text-right p-2">
                    <input type="submit" name="<?= (isset($_GET['update'])) ? 'edit_category' : 'add_category'; ?>" 
                    class=" py-2 px-5 rounded shadow-md bg-blue-500 hover:bg-blue-700 transition-all text-white font-medium capitalize" value="submit">
                </div>
            </form>
        </section>
    </main>
</body>
</html>