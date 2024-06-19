<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        session_start();
        require_once 'App/Review.php';

        if(!isset($_GET)) header("Location: index.php");
        $products = $Review->getHistoryDetail($_GET['pid']);
        
        // var_dump($Review->getHistoryList(1));
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>History Detail</title>
</head>
<body>
    <?php include_once "nav.php" ?>
    <main class="grid flex-row w-full p-5 justify-items-center">
        <header class="flex mb-5 justify-between w-9/12">
            <h1 class="page-title capitalize font-bold text-2xl">history purchase ID : <?= $_GET['pid'] ?></h1>
        </header>

        <section id="payment-detail w-full flex">
            <div class="flex justify-end border-b border-gray-100 pb-4 my-5">
                <div class="w-screen max-w-lg space-y-4">
                    <dl class="space-y-0.5 text-sm text-gray-700">
                        <div class="flex justify-between">
                            <dt>total price</dt>
                            <dd>Rp. <?= $products[0]["total_price"] ?>,00</dd>
                        </div>

                        <div class="flex justify-between">
                            <dt>amount</dt>
                            <dd>Rp. <?= $products[0]["payment_amount"] ?>,00</dd>
                        </div>

                        <div class="flex justify-between">
                            <dt>method</dt>
                            <dd><?= $products[0]["payment_method"] ?></dd>
                        </div>

                        <div class="flex justify-between !text-base font-medium">
                            <dt>status</dt>
                            <dd><?= $products[0]["payment_status"] ?></dd>
                        </div>
                    </dl>
                </div>
            </div>
        </section>

        <?php foreach($products as $x) : 
            $purchase_date = DateTime::createFromFormat('Y-m-d H:i:s', $x["purchase_date"]);
            $new_date = $purchase_date->format('Y-m-d');
            $review_status = $Review->checkReview($_SESSION['user_id'], $x['product_id']);
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
                    <?php if($review_status < 1) : ?>
                    <a href="form_review.php?pid=<?= $x["product_id"] ?>" 
                    class="bg-yellow-500 rounded px-4 py-2 capitalize tracking-wider">
                        make review
                    </a>
                    <?php else : ?>
                    <a href="product_review.php?pid=<?= $x["product_id"] ?>" 
                    class="bg-yellow-500 rounded px-4 py-2 capitalize tracking-wider">
                        see review
                    </a>
                    <?php endif ?>
                </div>
            </div>
        </section>
        <?php endforeach ?>
    </main>
</body>
</html>