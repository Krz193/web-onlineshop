<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require_once 'App/Product.php';
        $x = $Product->getProduct($_GET['pid']);
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body>
    <?php include_once "nav.php" ?>
    <main class="grid flex-row w-full p-5 justify-items-center">
        <section class="card-container p-4 mb-10 rounded-lg flex-row w-5/12 bg-gray-100 shadow-md">
            <div class="card-head flex">
                <div class="left w-4/12">
                    <p><?= $x["product_image"] ?></p>
                </div>
                <div class="right grow p-3">
                    <h1 class="text-3xl font-bold"><?= $x["product_name"] ?></h1>
                    <p><?= $x["category_name"] ?></p>
                    <p><?= $x["product_price"] ?></p>
                </div>
            </div>
            <div class="card-body p-2">
                <p><?= $x["product_description"] ?></p>
            </div>
            <div class="card-foot flex flex-row w-full p-2 justify-between">
                <p class="me-2"><?= ($x["product_status"]) ? "Active" : "Non-active" ?></p>
                <p><?= $x["date_created"] ?></p>
            </div>
        </section>

        <?php foreach($Product->getProductReviews($_GET['pid']) as $review) { ?>
        <section class="card-container review p-4 mb-4 rounded-lg w-10/12 bg-sky-100 shadow-md">
            <div class="card-head">
                <p class="text-xl font-bold"><?= $review['username'] ?></p>
                <p><?= $review['rating'] ?></p>
            </div>
            <div class="card-body">
                <p><?= $review['comment'] ?></p>
            </div>
            <div class="card-foot mt-4">
                <p><?= $review['review_date'] ?></p>
            </div>
        </section>
        <?php } ?>
        
    </main>
</body>
</html>