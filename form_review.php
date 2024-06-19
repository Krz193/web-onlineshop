<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        session_start();
        require_once 'App/Review.php';
        require_once 'App/Product.php';
        
        if(isset($_GET['pid'])) {
            $product_id = $_GET['pid'];
            $x = $Product->getProduct($_GET['pid']);
        }

        if(isset($_POST['add_review'])) {
            $product_id = $_POST['product_id'];
            if($Review->addReview($_SESSION['user_id'], $_POST)) echo "<script>alert('data berhasil ditambahkan'); location.href='product_review.php?pid=$product_id';</script>";
            else echo "<script>alert('gagal menambah data')</script>";
        }
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Review</title>
</head>
<body>
    <?php include_once "nav.php" ?>
    <main class="grid flex-row w-full p-5 justify-items-center">
        <header class="flex mb-5 justify-between w-7/12">
            <h1 class="page-title capitalize font-bold text-2xl">review product</h1>
            <button
            class="py-1 px-4 rounded bg-blue-500 font-bold tracking-wider capitalize text-white shadow-md bg-blue-500 hover:bg-blue-700 transition-all"
            onclick="history.go(-1)">
                back
            </button>
        </header>

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
                <p><?= $x["date_created"] ?></p>
            </div>
        </section>

        <section class="item p-4 mb-6 rounded-lg flex-row w-7/12 bg-gray-100 shadow-md">
            <form action="form_review.php" method="post" class="">
                <input type="hidden" name="product_id" value="<?= $product_id ?>">
                <div class="form-item flex flex-col p-2">
                    <div class="left-item flex flex-col w-3/12 mb-5">
                        <span class="uppercase text-xs text-gray-500 tracking-wider">rating</span>
                        <select name="rating" class="py-1 px-2 rounded shadow-md">
                            <option hidden>-- select rating --</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="right-item flex flex-col w-full">
                        <span class="uppercase text-xs text-gray-500 tracking-wider">comment</span>
                        <textarea type="text" name="comment" class="py-1 px-2 rounded shadow-md"></textarea> 
                    </div>
                </div>
                <div class="form-item text-right p-2">
                    <input type="submit" name="add_review" 
                    class=" py-2 px-5 rounded shadow-md bg-blue-500 hover:bg-blue-700 transition-all text-white font-medium capitalize" value="submit">
                </div>
            </form>
        </section>
    </main>
</body>
</html>