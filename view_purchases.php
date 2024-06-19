<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        session_start();
        require_once 'App/Purchase.php';
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable({order: [[2, 'desc']]});
        } );
    </script>
    <title>Purchase</title>
</head>
<body>
    <?php include_once "nav.php" ?>
    <main class="grid flex-row w-full p-5 justify-items-center">
        <header class="flex mb-5 justify-between w-9/12">
            <h1 class="page-title capitalize font-bold text-2xl">data purchase</h1>
        </header>

        
        <div class="overflow-x-auto w-9/12">
            <table id="myTable" class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                <thead class="ltr:text-left rtl:text-right">
                    <tr>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">purchase id</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">user id</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">purchase date</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">total price</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    <?php foreach($Purchase->getAllPurchase() as $data) : ?>
                    <tr>
                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"><?= $data['purchase_id'] ?></td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?= $data['user_id'] ?></td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?= $data['purchase_date'] ?></td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?= $data['total_price'] ?></td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700 text-center">
                            <a
                                class="group relative inline-flex items-center overflow-hidden rounded bg-indigo-600 px-8 py-3 text-white focus:outline-none focus:ring active:bg-indigo-500"
                                href="history_detail.php?pid=<?= $data['purchase_id'] ?>">
                                <span class="absolute -end-full transition-all group-hover:end-4">
                                    <svg
                                        class="size-5 rtl:rotate-180"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </span>

                                <span class="text-sm font-medium transition-all group-hover:me-4">
                                    View Detail
                                </span>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>