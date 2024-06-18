<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require_once 'App/Product.php';

        if(isset($_GET['delete'])) {
            if($Product->deleteProduct($_GET['delete'])) echo "<script>alert('data berhasil dihapus'); location.href='view_product.php';</script>";
            else echo "<script>alert('gagal menghapus data')</script>";
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
            <h1 class="page-title capitalize font-bold text-2xl">checkout products</h1>
        </header>

        <section class="w-full flex flex-col items-center" id="cards-container"></section>
        <section class="w-9/12 flex flex-col items-end">
            <button 
            class="px-6 py-2 bg-blue-500 rounded-lg shadow-md capitalize text-white font-medium tracking-wider"
            onclick="beli()">
                beli bang
            </button>
        </section>
        <pre id="demo"></pre>
    </main>

    <script>
        function showCard() {
            let products = JSON.parse(localStorage.getItem("products"));
            let html = "";
            for(let product in products){
                html+= 
                `<section class="item p-5 mb-6 rounded-lg flex-row w-9/12 bg-gray-100 shadow-md">
                    <div class="card-head flex min-h-36">
                        <span class="left w-4/12 bg-cover bg-center bg-no-repeat"
                        style="background-image: url('uploads/${products[product].img}');">
                        </span>
                        <div class="right grow p-3">
                            <h1 class="text-3xl font-bold">${products[product].name}</h1>
                            <p>${products[product].cat}</p>
                            <p>Rp. ${products[product].price},00</p>
                        </div>
                    </div>
                    <div class="action-btn w-full flex justify-end items-end">
                        <div class="quantity flex items-center justify-end pe-5">
                            <span class="capitalize text-sm me-2">quantity :</span>
                            <input type="number" name="" class="shadow-md w-2/12 rounded px-2" 
                            value="${products[product].qty}">
                        </div>
                        <button id="deleteCard" onclick="deleteCard(${products[product].id})" class="px-4 py-2 bg-blue-500 capitalize text-sm rounded-full text-white">delete item</button>
                    </div>
                </section>`
            }
            document.getElementById("cards-container").innerHTML = html;
        }

        showCard();

        function deleteCard(id) {
            let products = JSON.parse(localStorage.getItem("products"));
            delete products[id];
            localStorage.setItem("products", JSON.stringify(products));
            showCard();
        }

        function beli() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document
                        .getElementById("demo")
                        .innerHTML = this.responseText;
                }
            };
            xhttp.open("POST", "App/coba.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send(localStorage.getItem("products"));
        }
    </script>
</body>
</html>