<?php 
include "components/header.php";


?>
<div class="flex justify-between items-center bg-white p-4 mb-6 rounded-md shadow-md">
    <h2 class="text-lg font-semibold text-gray-700">Barangay Clearance</h2>
    <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-lg font-bold text-white">
        <?php
        echo substr(ucfirst($_SESSION['r_fname']), 0, 1);
        ?>
    </div>
</div>

<div class="bg-white rounded-lg shadow-lg p-6">
   <!-- Add Resident Button -->
   <div class="mb-4 flex items-center space-x-4">
       <button id="requestClearanceModal" class="bg-blue-500 text-white py-1 px-3 text-xs rounded-md flex items-center hover:bg-blue-600 transition duration-300">
           <span class="material-icons mr-1 text-sm">post_add</span>
           Request Clearance
       </button>
   </div>


    <!-- Search Input -->
    <div class="mb-4">
       <label for="searchInput" class="block text-xs text-gray-700 mb-1">Search</label>
       <input type="text" id="searchInput" class="p-2 border rounded-sm text-xs w-60" placeholder="Search resident...">
   </div>

    <!-- Table Wrapper for Responsiveness -->
    <div class="overflow-x-auto">
        <table id="userTable" class="display table-auto w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="p-2">ID</th>
                    <th class="p-2">Purpose</th>
                    <th class="p-2">Address</th>
                    <th class="p-2">Payment</th>
                    <th class="p-2">Request Date</th>
                    <th class="p-2">Status</th>
                    <th class="p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php include "backend/end-points/clearance_request_list.php"; ?>
            </tbody>
        </table>
    </div>
</div>



<!-- Modal HTML -->
<div id="clearanceModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center z-50 overflow-auto" style="display:none;">
    <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-2xl mx-4 max-h-screen overflow-y-auto">
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Request Clearance</h3>
        <p class="text-sm text-gray-600 mb-6">Please fill out the form to request your clearance.</p>
        

        <div id="loadingSpinner" style="display:none;">
                <div class=" absolute inset-0 bg-white bg-opacity-75 flex items-center justify-center">
                <div class="w-10 h-10 border-4 border-indigo-500 border-t-transparent rounded-full animate-spin"></div>
                </div>
            </div>

        <!-- Form -->
        <form id="frmRequestClearance">
            <input hidden type="text" value="<?=$_SESSION['r_id']?>" name="r_id">
            <!-- Valid ID -->
            <div class="mb-6">
                <label for="validId" class="block text-sm font-medium text-gray-700 mb-2">ID (Valid ID/School ID)</label>
                <input type="file" id="validId" name="validId" accept="image/*" class="mt-1 p-3 border border-gray-300 rounded-md w-full focus:ring-indigo-500 focus:border-indigo-500">
                <div id="validIdPreview" class="mt-3"></div>
            </div>

            <!-- Proof of Residency -->
            <div class="mb-6">
                <label for="proofResidency" class="block text-sm font-medium text-gray-700 mb-2">Proof of Residency</label>
                <input type="file" id="proofResidency" name="proofResidency" accept="image/*" class="mt-1 p-3 border border-gray-300 rounded-md w-full focus:ring-indigo-500 focus:border-indigo-500">
                <div id="proofResidencyPreview" class="mt-3"></div>
            </div>

            <!-- Purpose -->
            <div class="mb-6">
                <label for="purpose" class="block text-sm font-medium text-gray-700 mb-2">Purpose</label>
                <textarea id="purpose" name="purpose" class="mt-1 p-3 border border-gray-300 rounded-md w-full focus:ring-indigo-500 focus:border-indigo-500" required></textarea>
            </div>

            <!-- Address -->
            <div class="mb-6">
                <label for="addressForm" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                <textarea id="addressForm" name="addressForm" class="mt-1 p-3 border border-gray-300 rounded-md w-full focus:ring-indigo-500 focus:border-indigo-500" required><?=$address?></textarea>
            </div>

            <!-- Payment -->
            <div class="mb-6">
                <label for="payment" class="block text-sm font-medium text-gray-700 mb-2">Payment</label>
                <select name="payment" id="payment" class="mt-1 p-3 border border-gray-300 rounded-md w-full focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="cod">Cash on Delivery</option>
                </select>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end space-x-4">
                <button id="AddResident" type="submit" class="bg-blue-500 text-white py-2 px-6 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">Send Request</button>
                <button type="button" id="closeModal" class="bg-gray-400 text-white py-2 px-6 rounded-md hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50">Cancel</button>
            </div>
        </form>
    </div>
</div>




<?php include "components/footer.php";?>
<script src='js/app.js'></script>