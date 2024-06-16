<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require_once 'App/Product.php';
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Product</title>
</head>
<body>
    <?php include_once "nav.php" ?>
    <main class="grid flex-row w-full p-5 justify-items-center">
        <header class="flex mb-5 justify-between w-9/12">
            <h1 class="page-title capitalize font-bold text-2xl">data product</h1>
            <a href="" class="py-1 px-4 rounded bg-blue-500 font-bold tracking-wider uppercase text-white">add product</a>
            <a href="view_category.php" class="py-1 px-4 rounded bg-blue-500 font-bold tracking-wider uppercase text-white">view category list</a>
        </header>

        <?php foreach($Product->getAllProducts() as $x) { ?>
        <section class="item p-4 mb-6 rounded-lg flex-row w-9/12 bg-gray-100 shadow-md">
            <div class="card-head flex">
                <div class="left w-4/12">
                    <p><?= $x["product_image"] ?></p>
                </div>
                <div class="right grow p-3">
                    <h1 class="text-3xl font-bold"><?= $x["product_name"] ?></h1>
                    <p><?= $x["category_name"] ?></p>
                    <p>Rp. <?= $x["product_price"] ?>,00</p>
                </div>
            </div>
            <div class="card-body p-2">
                <p><?= $x["product_description"] ?></p>
            </div>
            <div class="card-foot flex flex-row w-full p-2 justify-between">
                <span class="text-xs tracking-wider text-gray-400"><?= $x["date_created"] ?></span>
            </div>
            <div class="action-btn w-full flex justify-end">
                <a href="product_review.php?pid=<?= $x["product_id"] ?>" class="px-4 py-2 bg-blue-500 rounded-full capitalize text-white text-sm me-2">check review</a>
                <a href="?update=<?= $x['product_id'] ?>" class="px-4 py-2 bg-yellow-500 rounded-full capitalize text-white text-sm me-2">update</a>
                <a href="?delete=<?= $x['product_id'] ?>" class="px-4 py-2 bg-red-500 rounded-full capitalize text-white text-sm">delete</a>
            </div>
        </section>
        <?php } ?>
    </main>
</body>
</html>