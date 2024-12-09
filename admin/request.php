<?php 

include "components/header.php";

// Set the default step as "Pending" if not set
$defaultStep = 'Pending'; // Default value



if (isset($_GET['step'])) {
    $defaultStep = $_GET['step'];
}else{
    echo "<script>location.href='request.php?step=Pending'</script>";
}
?>

<div class="flex justify-between items-center bg-white p-4 mb-6 rounded-md shadow-md">
    <h2 class="text-lg font-semibold text-gray-700">List of orders</h2>
    <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-lg font-bold text-white">
        <?php
        echo substr(ucfirst($_SESSION['user_type']), 0, 1);
        ?>
    </div>
</div>


  <!-- Tabs -->
  <div class="flex justify-center space-x-4 space-y-2 md:space-y-0 md:space-x-4 border-b mb-6 overflow-x-auto whitespace-nowrap">
      <a href="?step=Pending" class="py-2 px-4 text-gray-600 hover:text-red-500 <?= ($defaultStep == 'Pending' ? 'border-b-2 border-red-500 text-red-500' : '') ?>">Pending</a>
      <a href="?step=Approved" class="py-2 px-4 text-gray-600 hover:text-red-500 <?= ($defaultStep == 'Approved' ? 'border-b-2 border-red-500 text-red-500' : '') ?>">Approved</a>
      <a href="?step=Shipped" class="py-2 px-4 text-gray-600 hover:text-red-500 <?= ($defaultStep == 'Shipped' ? 'border-b-2 border-red-500 text-red-500' : '') ?>">Shipped</a>
      <a href="?step=Delivered" class="py-2 px-4 text-gray-600 hover:text-red-500 <?= ($defaultStep == 'Delivered' ? 'border-b-2 border-red-500 text-red-500' : '') ?>">Delivered</a>
      <a href="?step=Rejected" class="py-2 px-4 text-gray-600 hover:text-red-500 <?= ($defaultStep == 'Rejected' ? 'border-b-2 border-red-500 text-red-500' : '') ?>">Rejected</a>
      <a href="?step=Canceled" class="py-2 px-4 text-gray-600 hover:text-red-500 <?= ($defaultStep == 'Canceled' ? 'border-b-2 border-red-500 text-red-500' : '') ?>">Canceled</a>
    </div>


<div class="overflow-x-auto bg-white shadow-md rounded-lg p-6" id="recordTable">
    <h2 class="text-xl font-semibold text-gray-700 mb-4"></h2>


    <!-- border-b-2 border-red-500 text-red-500 -->
    <!-- Search Box and Table -->
    <div class="flex justify-between items-center mb-4">
        <input type="text" id="searchInput" placeholder="Search..." class="w-1/4 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder-gray-500 text-sm">
    </div>

    <table class="min-w-full table-auto">
        <thead class="bg-gray-100 border-b">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Request ID</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Form Type</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Resident</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Order Date</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Payment</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Price</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Address</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Actions</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<?php include "components/footer.php";?>

<script src="js/table_order.js"></script>