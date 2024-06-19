<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require_once 'App/Review.php';

        $products = $Review->getHistoryDetail($_GET['pid']);
        // var_dump($Review->getHistoryList(1));
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
            <h1 class="page-title capitalize font-bold text-2xl">history purchase ID : <?= $_GET['pid'] ?></h1>
        </header>

        <?php foreach($products as $x) : 
            $purchase_date = DateTime::createFromFormat('Y-m-d H:i:s', $x["purchase_date"]);
            $new_date = $purchase_date->format('Y-m-d');
        ?>
        <section class="item p-5 mb-6 rounded-lg flex-col w-9/12 bg-gray-100 shadow-md">
            <div class="card-head flex flex-row w-full grow mb-3">
                <span class="left w-4/12 bg-cover bg-center bg-no-repeat min-h-36"
                    style="background-image: url('uploads/<?= (file_exists('uploads/'.$x['product_image'])) ? $x['product_image'] : 'placeholder.jpg' ?>');">
                </span>
                <div class="item-detail flex flex-col">
                    <h1 class="title font-bold text-2xl tracking-wider px-3 capitalize">(<?= $x['product_id'] ?>) <?= $x['product_name'] ?></h1>
                    <span class="tracking-wider px-3 capitalize"><?= $x['category_name'] ?></span>
                    <span class="tracking-wider px-3"><?= $new_date ?></span>
                </div>
            </div>
            <div class="card-body flex flex-row">
                <div class="product-data grow">
                    <div class="card-item mb-2">
                        <span class="text-xs tracking-wider text-gray-400 uppercase">price per item</span>
                        <p>Rp. <?= $x["price"] ?>,00</p>
                    </div>
                    <div class="card-item">
                        <span class="text-xs tracking-wider text-gray-400 uppercase">jumlah barang</span>
                        <p><?= $x["quantity"] ?> buah</p>
                    </div>
                </div>
                <div class="action-btn flex items-end">
                    <a href="form_review.php?pid=<?= $x["product_id"] ?>" 
                    class="bg-yellow-500 rounded px-4 py-2 capitalize tracking-wider">
                        make review
                    </a>
                </div>
            </div>
        </section>
        <?php endforeach ?>
        <section id="payment-detail">
            <p>
                total price Rp. <?= $products[0]["total_price"] ?>,00
            </p>
            <p>
                amount Rp. <?= $products[0]["payment_amount"] ?>,00
            </p>
            <p>
                method <?= $products[0]["payment_method"] ?>
            </p>
            <p>
                status <?= $products[0]["payment_status"] ?>
            </p>
        </section>
    </main>
</body>
</html>