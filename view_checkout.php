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
        <section class="w-9/12 flex flex-col my-4 p-5 bg-gray-100 rounded shadow-md items-center" id="items_data">
            <div class="card-items w-8/12 mb-3 flex flex-col">
                <span class="text-xs text-gray-400 uppercase tracking-wider">total price</span>
                <span id="total_price">Rp. 4000,00</span>
            </div>
            <div class="card-items w-8/12 mb-3">
                <span class="text-xs text-gray-400 uppercase tracking-wider">payment method</span>
                <select name="payment_method" id="payment_method" class="w-full py-2 px-4 shadow-md bg-white rounded">
                    <option value="" selected disabled class="text-center">-- select payment method --</option>
                    <option value="cash" class="">cash</option>
                    <option value="transfer" class="">transfer</option>
                </select>           
            </div>
            <div class="card-items w-8/12 mb-3">
                <span class="text-xs text-gray-400 uppercase tracking-wider">payment amount</span>
                <input type="text" name="payment_amount" id="payment_amount"
                class="shadow-md rounded self-end w-full px-3 py-1">                
            </div>
            <button 
            class="px-6 py-2 mt-2 bg-blue-500 rounded-lg shadow-md capitalize text-white font-medium tracking-wider self-end"
            onclick="beli()">
                beli bang
            </button>
        </section>
        <pre id="demo"></pre>
    </main>

    <script>
        let idBarang;
        let total_price = 0;
        function showCard() {
            let products = JSON.parse(localStorage.getItem("products"));
            let html = "";
            total_price = 0;
            for(let product in products){
                idBarang = products[product].id;
                total_price+= products[product].price*products[product].qty;
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
                            <input type="number" name="" min="1" class="shadow-md w-2/12 rounded px-2" 
                            value="${products[product].qty}" id="qty" onchange="qty(${idBarang}, this)">
                        </div>
                        <button id="deleteCard" onclick="deleteCard(${products[product].id})" class="px-4 py-2 bg-blue-500 capitalize text-sm rounded-full text-white">delete item</button>
                    </div>
                </section>`
            }
            document.getElementById("cards-container").innerHTML = html;
            document.getElementById("total_price").innerHTML = `Rp. ${total_price},00`;
        }

        function qty(id, input) {
            let products = JSON.parse(localStorage.getItem("products"));
            products[id].qty = input.value;
            localStorage.setItem("products", JSON.stringify(products));
            showCard();
            console.log(`jumlah ${products[id].name} sekarang adalah ${input.value}`);
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
            let payment_amount = document.getElementById("payment_amount").value;
            let payment_method = document.getElementById("payment_method").value;
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    alert("Pembelian berhasil");
                    location.href="history.php";
                }
            };
            let jsonData = {
                total_price : total_price,
                payment_method : payment_method,
                payment_amount : payment_amount,
                products : localStorage.getItem("products")
            }
            console.table(jsonData);
            xhttp.open("POST", "App/transaction.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            var params = 'jsonData=' + encodeURIComponent(JSON.stringify(jsonData));
            xhttp.send(JSON.stringify(jsonData));
        }
    </script>
</body>
</html>