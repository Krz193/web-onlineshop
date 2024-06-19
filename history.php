<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require_once 'App/Review.php';

        
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
            <h1 class="page-title capitalize font-bold text-2xl">history purchases</h1>
        </header>

        <?php foreach($Review->getHistoryList(1) as $x) : 
            $purchase_date = DateTime::createFromFormat('Y-m-d H:i:s', $x["purchase_date"]);
            $new_date = $purchase_date->format('Y-m-d');
        ?>
        <section class="item p-5 mb-6 rounded-lg flex-col w-9/12 bg-gray-100 shadow-md">
            <div class="card-head flex flex-row w-full grow mb-3">
                <h1 class="title font-bold text-2xl tracking-wider"><?= $new_date ?></h1>
            </div>
            <div class="card-body flex flex-row">
                <div class="product-data grow">
                    <div class="card-item mb-2 flex items-center">
                        <span class="text-xs tracking-wider text-gray-400 uppercase">purchase id : <?= $x["purchase_id"] ?></span>
                    </div>
                    <div class="card-item mb-2">
                        <span class="text-xs tracking-wider text-gray-400 uppercase">total price</span>
                        <p>Rp. <?= $x["total_price"] ?>,00</p>
                    </div>
                    <div class="card-item">
                        <span class="text-xs tracking-wider text-gray-400 uppercase">jumlah barang</span>
                        <p><?= $x["jumlah_barang"] ?> buah</p>
                    </div>
                </div>
                <div class="action-btn flex items-end">
                    <a href="history_detail.php?pid=<?= $x["purchase_id"] ?>" 
                    class="bg-yellow-500 rounded px-4 py-2 capitalize tracking-wider">
                        detail transaksi
                    </a>
                </div>
            </div>
        </section>
        <?php endforeach ?>
    </main>
</body>
</html>