<?php include "components/header.php";?>
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
</div>



<!-- Modal HTML -->
<div id="clearanceModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center z-50" style="display:none;">
    <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md mx-4">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Request Clearance</h3>
            <p class="text-sm text-gray-600 mb-6">Please fill out the form to request your clearance.</p>
            
            <!-- Form -->
            <form id="frmRequestForm">
                <div class="mb-6">
                    <label for="cedula" class="block text-sm font-medium text-gray-700 mb-2">Cedula</label>
                    <input type="file" id="cedula" name="cedula" class="mt-1 p-3 border border-gray-300 rounded-md w-full focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div class="mb-6">
                    <label for="addressForm" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                    <textarea id="addressForm" name="addressForm" class="mt-1 p-3 border border-gray-300 rounded-md w-full focus:ring-indigo-500 focus:border-indigo-500" required></textarea>
                </div>

                <div class="mb-6">
                    <label for="purpose" class="block text-sm font-medium text-gray-700 mb-2">Purpose</label>
                    <textarea id="purpose" name="purpose" class="mt-1 p-3 border border-gray-300 rounded-md w-full focus:ring-indigo-500 focus:border-indigo-500" required></textarea>
                </div>

                <div class="mb-6">
                    <label for="payment" class="block text-sm font-medium text-gray-700 mb-2">Payment</label>
                    <select name="payment" id="payment" class="mt-1 p-3 border border-gray-300 rounded-md w-full focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="cod">Cash on Delivery</option>
                    </select>
                </div>

                <div class="flex justify-end space-x-4">
                    <button id="AddResident" type="submit" class="bg-blue-500 text-white py-2 px-6 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">Send Request</button>
                    <button type="button" id="closeModal" class="bg-gray-400 text-white py-2 px-6 rounded-md hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50">Cancel</button>
                </div>
            </form>
        </div>
</div>




<?php include "components/footer.php";?>

<script>
    $(document).ready(function() {
        // Open modal when the button is clicked
        $('#requestClearanceModal').click(function() {
            $('#clearanceModal').fadeIn();
        });

        // Close modal when the Cancel button is clicked
        $('#closeModal').click(function() {
            $('#clearanceModal').fadeOut();
        });
    });
</script>
