<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        session_start();
        require_once 'App/Product.php';

        if(isset($_GET['update'])) $unedited = $Product->getProduct($_GET['update']); 
        if(isset($_POST['edit_product'])) {
            if($Product->updateProduct($_POST)) echo "<script>alert('data berhasil diubah'); location.href='view_product.php';</script>";
            else echo "<script>alert('gagal mengubah data')</script>";
        }

        if(isset($_POST['add_product'])) {
            if($Product->addProduct($_POST)) echo "<script>alert('data berhasil ditambahkan'); location.href='view_product.php';</script>";
            else echo "<script>alert('gagal menambah data')</script>";
        }
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
            <a href="view_product.php" class="py-1 px-4 rounded bg-blue-500 font-bold tracking-wider capitalize text-white shadow-md bg-blue-500 hover:bg-blue-700 transition-all">back</a>
        </header>

        <section class="item p-4 mb-6 rounded-lg flex-row w-9/12 bg-gray-100 shadow-md">
            <form action="" method="post" class="" enctype="multipart/form-data">

                <?php if(isset($_GET['update'])) : ?>
                <input type="hidden" name="category_id" value="<?= $unedited['category_id'] ?>">
                <input type="hidden" name="product_id" value="<?= $unedited['product_id'] ?>">
                <input type="hidden" name="old_img" value="<?= $unedited['product_image'] ?>">
                <?php endif ?>

                <div class="form-item flex flex-col p-2">
                    <span class="uppercase text-xs text-gray-500 tracking-wider">product name</span>
                    <input type="text" name="product_name" class="py-1 px-2 rounded shadow-md" value="<?= (isset($_GET['update'])) ? $unedited['product_name'] : '' ?>">
                </div>
                <div class="form-item flex flex-col p-2">
                    <span class="uppercase text-xs text-gray-500 tracking-wider">category name</span>
                    <select name="category_id" class="py-1 px-2 rounded shadow-md">
                        <option disabled selected class="text-center">-- select category --</option>
                        <?php foreach($Product->getAllCategories() as $cat) : ?>
                            <option 
                            value="<?= $cat['category_id'] ?>" <?= (isset($_GET['update'])) ? (($unedited['category_id']==$cat['category_id']) ? 'selected' : '') :'' ?> >
                                <?= $cat['category_name'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-item flex flex-col p-2">
                    <span class="uppercase text-xs text-gray-500 tracking-wider">product price</span>
                    <input type="text" name="product_price" class="py-1 px-2 rounded shadow-md" value="<?= (isset($_GET['update'])) ? $unedited['product_price'] : '' ?>">
                </div>
                <div class="form-item flex flex-col p-2">
                    <span class="uppercase text-xs text-gray-500 tracking-wider">product description</span>
                    <textarea type="text" name="product_description" class="py-1 px-2 rounded shadow-md"><?= (isset($_GET['update'])) ? $unedited['product_description'] : "" ?></textarea>
                </div>
                <div class="form-item flex flex-col p-2">
                    <span class="uppercase text-xs text-gray-500 tracking-wider">product image</span>
                    <div class="img flex">
                        <span class="preview w-4/12 min-h-36 bg-cover bg-center bg-no-repeat rounded-lg shadow-md"
                        style="background-image: url('uploads/<?= (isset($_GET['update'])) ? $unedited['product_image'] : 'placeholder.jpg' ?>');" id="preview"></span>
                        <div class="file-upload-btn grow flex items-end">
                            <input type="file" name="product_image" class="py-1 px-2 w-full" id="upload" onchange="prevImage()" 
                            value="<?= (isset($_GET['update'])) ? $unedited['product_image'] : '' ?>">
                        </div>
                    </div>
                </div>
                <div class="form-item flex flex-col p-2">
                    <span class="uppercase text-xs text-gray-500 tracking-wider">product status</span>
                    <select name="product_status" class="py-1 px-2 rounded shadow-md capitalize">
                        <option disabled selected class="text-center">-- select product status --</option>
                        <option value="1" class="capitalize" <?= (isset($_GET['update'])) ? (($unedited['product_status']==1) ? 'selected' : '') :'' ?> >active</option>
                        <option value="0" class="capitalize" <?= (isset($_GET['update'])) ? (($unedited['product_status']==0) ? 'selected' : '') :'' ?> >non-active</option>
                    </select>
                </div>

                <div class="form-item text-right p-2">
                    <input type="submit" name="<?= (isset($_GET['update'])) ? 'edit_product' : 'add_product'; ?>" 
                    class=" py-2 px-5 rounded shadow-md bg-blue-500 hover:bg-blue-700 transition-all text-white font-medium capitalize" value="submit">
                </div>
            </form>
        </section>
    </main>

    <script>
        function prevImage() {
            const formFile = document.getElementById('upload');
            const [file] = formFile.files;
            console.table(file)
            if (file) {
                document.getElementById('preview').style.backgroundImage = `url(${URL.createObjectURL(file)})`;
            }
        }
    </script>
</body>
</html>