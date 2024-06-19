<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        session_start();
        require_once 'App/Product.php';
        $x = $Product->getProduct($_GET['pid']);
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Product Review</title>
    <script>console.log("<?= (file_exists('uploads/'.$x['product_image'])) ? 'ada' : 'tidak' ?>")</script>
</head>
<body>
    <?php include_once "nav.php" ?>
    <main class="grid flex-row w-full p-5 justify-items-center">
        <section class="card-container p-4 mb-10 rounded-lg flex-row w-7/12 bg-gray-100 shadow-md">
            <div class="card-head flex">
                <span class="left w-4/12 bg-cover bg-center bg-no-repeat min-h-36" 
                style="background-image: url('uploads/<?= (file_exists('uploads/'.$x['product_image'])) ? $x['product_image'] : 'placeholder.jpg' ?>');">
                </span>
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
                <!-- <p class="me-2"><?= ($x["product_status"]) ? "Active" : "Non-active" ?></p> -->
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