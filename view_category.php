<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        session_start();
        require_once 'App/Product.php';

        if(isset($_GET['delete'])) {
            if($Product->deleteCategory($_GET['delete'])) echo "<script>alert('data berhasil dihapus'); location.href='view_category.php';</script>";
            else echo "<script>alert('gagal menghapus data')</script>";
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
            <a href="form_category.php" class="py-1 px-4 rounded bg-blue-500 font-bold tracking-wider uppercase text-white">add category</a>
        </header>

        <?php foreach($Product->getAllCategories() as $x) : 
                $product_count = $Product->countProducts($x['category_id']);
            ?>
        <section class="item p-4 mb-6 rounded-lg flex-row w-9/12 bg-gray-100 shadow-md">
            <div class="card-body p-2 flex">
                <p class="grow font-medium"><?= $x["category_id"] ?> - <?= $x['category_name'] ?></p>
                <div class="action-btn flex justify-end">
                    <a href="form_category.php?update=<?= $x['category_id'] ?>" class="px-4 py-2 bg-yellow-500 rounded-full capitalize text-white text-sm me-2">update</a>

                    <?php if($product_count==0) : ?>
                    <a href="?delete=<?= $x['category_id'] ?>" class="px-4 py-2 bg-red-500 rounded-full capitalize text-white text-sm" 
                        onclick="return confirm('Yakin ingin delete category <?= $x['category_name'] ?> dengan ID : <?= $x['category_id'] ?>?')">
                        delete
                    </a>
                    <?php endif ?>
                </div>
            </div>
            <div class="card-foot flex justify-between mt-3">
                <p class="text-xs capitalize text-gray-400 inline">product count : <?= $product_count ?></p>

                <?php if($product_count>0) : ?>
                <p class="text-xs text-red-400 inline tracking-wide">*cannot delete category with one or more product</p>
                <?php endif ?>
            </div>
        </section>
        <?php endforeach ?>
    </main>
</body>
</html>