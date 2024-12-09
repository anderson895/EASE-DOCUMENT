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
   <div class="mb-4 flex space-x-4 overflow-x-auto pb-4 justify-center items-center">
       <button id="OpenBrgyIdModal" class="bg-blue-500 text-white py-1 px-3 text-xs rounded-md flex items-center justify-center hover:bg-blue-600 transition duration-300">
            <span class="material-icons mr-1 text-sm">post_add</span>
            Barangay ID
        </button>

        <button id="OpenClearanceModal" class="bg-blue-500 text-white py-1 px-3 text-xs rounded-md flex items-center justify-center hover:bg-blue-600 transition duration-300">
            <span class="material-icons mr-1 text-sm">post_add</span>
            Request Clearance
        </button>
        
        <button id="OpenResidencyModal" class="bg-blue-500 text-white py-1 px-3 text-xs rounded-md flex items-center justify-center hover:bg-blue-600 transition duration-300">
            <span class="material-icons mr-1 text-sm">post_add</span>
            Request Residency
        </button>

        <button id="OpenIndigencyModal" class="bg-blue-500 text-white py-1 px-3 text-xs rounded-md flex items-center justify-center hover:bg-blue-600 transition duration-300">
            <span class="material-icons mr-1 text-sm">post_add</span>
            Request Indigency
        </button>
    </div>
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
                    <th class="p-2">Request Type</th>
                    <th class="p-2">Purpose</th>
                    <th class="p-2">Address</th>
                    <th class="p-2">Payment</th>
                    <th class="p-2">Request Date</th>
                    <th class="p-2">Status</th>
                    <th class="p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php include "backend/end-points/request_list.php"; ?>
            </tbody>
        </table>
    </div>
</div>




<!-- Modal clearanceModal -->
<div id="indigencyModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center z-50 overflow-auto" style="display:none;">
    <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-2xl mx-4 max-h-screen overflow-y-auto">
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Request Certificate of Indigency</h3>
        <p class="text-sm text-gray-600 mb-6">Please fill out the form to request your clearance.</p>
        
        <div id="loadingSpinner_Indigency" style="display:none;">
            <div class="absolute inset-0 bg-white bg-opacity-75 flex items-center justify-center">
                <div class="w-10 h-10 border-4 border-indigo-500 border-t-transparent rounded-full animate-spin"></div>
            </div>
        </div>

        <!-- Form -->
        <form id="frmRequest_Indigency">
            <input hidden type="text" value="<?=$_SESSION['r_id']?>" name="r_id">
            <!-- Valid ID -->
            <div class="mb-6">
                <label for="validId_Indigency" class="block text-sm font-medium text-gray-700 mb-2">ID (Valid ID/School ID)</label>
                <input type="file" id="validId_Indigency" name="validId" accept="image/*" class="mt-1 p-3 border border-gray-300 rounded-md w-full focus:ring-indigo-500 focus:border-indigo-500" required>
                <div id="validIdPreview_Indigency" class="mt-3"></div>
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
            <div class="mb-4">
                <label for="payment" class="block text-sm font-medium text-gray-700 mb-2">Payment</label>
                <select name="payment" id="payment" class="mt-1 p-3 border border-gray-300 rounded-md w-full focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="Cash on Delivery">Cash on Delivery</option>
                </select>
            </div>

            

        <!-- Receipt Section -->
        <div id="receiptSection" class=" border-t pt-6">
            <h4 class="text-lg font-semibold text-gray-800 mb-4">Total</h4>
            <div class="flex justify-between items-center mb-2">
                <span class="text-sm text-gray-600">Document Price:</span>
                <span id="documentPrice_Indigency" class="text-sm text-gray-800" data-documentPrice="50.00" >₱ 50.00</span>
            </div>
            <div class="flex justify-between items-center mb-2">
                <span class="text-sm text-gray-600">Shipping Fee:</span>
                <span id="shippingFee_Indigency" class="text-sm text-gray-800" data-shippingFee="0.00" >₱ 0.00</span>
            </div>
            <div class="flex justify-between items-center font-semibold">
                <span class="text-sm text-gray-600">Total:</span>
                <span id="totalPrice_Indigency" class="text-sm text-gray-800" data-totalPrice="50.00" >₱ 50.00</span>
            </div>
        </div>

             <!-- Buttons -->
              <div class="border-t mt-4"></div>
                <div class="flex justify-end space-x-4 mb-6 mt-6 ">
                    <button type="submit" class="bg-blue-500 text-white py-2 px-6 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">Send Request</button>
                    <button type="button" class="closeModal bg-gray-400 text-white py-2 px-6 rounded-md hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50">Cancel</button>
                </div>
            </form>
    </div>
</div>




<!-- Modal clearanceModal -->
<div id="residencyModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center z-50 overflow-auto" style="display:none;">
    <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-2xl mx-4 max-h-screen overflow-y-auto">
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Request Certificate of Residency</h3>
        <p class="text-sm text-gray-600 mb-6">Please fill out the form to request your clearance.</p>
        
        <div id="loadingSpinner_Residency" style="display:none;">
            <div class="absolute inset-0 bg-white bg-opacity-75 flex items-center justify-center">
                <div class="w-10 h-10 border-4 border-indigo-500 border-t-transparent rounded-full animate-spin"></div>
            </div>
        </div>

        <!-- Form -->
        <form id="frmRequest_Residency">
            <input hidden type="text" value="<?=$_SESSION['r_id']?>" name="r_id">
            <!-- Valid ID -->
            <div class="mb-6">
                <label for="validId_Residency" class="block text-sm font-medium text-gray-700 mb-2">ID (Valid ID/School ID)</label>
                <input type="file" id="validId_Residency" name="validId" accept="image/*" class="mt-1 p-3 border border-gray-300 rounded-md w-full focus:ring-indigo-500 focus:border-indigo-500" required>
                <div id="validIdPreview_Residency" class="mt-3"></div>
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
            <div class="mb-4">
                <label for="payment" class="block text-sm font-medium text-gray-700 mb-2">Payment</label>
                <select name="payment" id="payment" class="mt-1 p-3 border border-gray-300 rounded-md w-full focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="Cash on Delivery">Cash on Delivery</option>
                </select>
            </div>

            

        <!-- Receipt Section -->
        <div id="receiptSection" class=" border-t pt-6">
            <h4 class="text-lg font-semibold text-gray-800 mb-4">Total</h4>
            <div class="flex justify-between items-center mb-2">
                <span class="text-sm text-gray-600">Document Price:</span>
                <span id="documentPrice_Residency" class="text-sm text-gray-800" data-documentPrice="50.00" >₱ 50.00</span>
            </div>
            <div class="flex justify-between items-center mb-2">
                <span class="text-sm text-gray-600">Shipping Fee:</span>
                <span id="shippingFee_Residency" class="text-sm text-gray-800" data-shippingFee="0.00" >₱ 0.00</span>
            </div>
            <div class="flex justify-between items-center font-semibold">
                <span class="text-sm text-gray-600">Total:</span>
                <span id="totalPrice_Residency" class="text-sm text-gray-800" data-totalPrice="50.00" >₱ 50.00</span>
            </div>
        </div>

             <!-- Buttons -->
              <div class="border-t mt-4"></div>
                <div class="flex justify-end space-x-4 mb-6 mt-6 ">
                    <button id="requestClearance" type="submit" class="bg-blue-500 text-white py-2 px-6 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">Send Request</button>
                    <button type="button" class="closeModal bg-gray-400 text-white py-2 px-6 rounded-md hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50">Cancel</button>
                </div>
            </form>
    </div>
</div>







<!-- Modal HTML -->
<div id="BrgyIdModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center z-50 overflow-auto" style="display:none;">
    <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-2xl mx-4 max-h-screen overflow-y-auto">
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Request Barangay ID</h3>
        <p class="text-sm text-gray-600 mb-6">Please fill out the form to request your clearance.</p>
        
        <div id="loadingSpinner_BrgyId" style="display:none;">
            <div class="absolute inset-0 bg-white bg-opacity-75 flex items-center justify-center">
                <div class="w-10 h-10 border-4 border-indigo-500 border-t-transparent rounded-full animate-spin"></div>
            </div>
        </div>

        <!-- Form -->
        <form id="frmRequestBrgyId">
            <input hidden type="text" value="<?=$_SESSION['r_id']?>" name="r_id">

            <!-- 1x1 Picture -->
            <div class="mb-6">
                <label for="1x1pic_BrgyId" class="block text-sm font-medium text-gray-700 mb-2">1x1 Picture</label>
                <input type="file" id="1x1pic_BrgyId" name="1x1pic_BrgyId" accept="image/*" class="mt-1 p-3 border border-gray-300 rounded-md w-full focus:ring-indigo-500 focus:border-indigo-500" required>
                <div id="1x1picPreview_BrgyId" class="mt-3"></div>
            </div>

             <!-- Signature -->
             <div class="mb-6">
                <label for="signature_BrgyId" class="block text-sm font-medium text-gray-700 mb-2">Signature</label>
                <input type="file" id="signature_BrgyId" name="signature_BrgyId" accept="image/*" class="mt-1 p-3 border border-gray-300 rounded-md w-full focus:ring-indigo-500 focus:border-indigo-500" required>
                <div id="signaturePreview_BrgyId" class="mt-3"></div>
            </div>

            <!-- Valid ID -->
            <div class="mb-6">
                <label for="validId_BrgyId" class="block text-sm font-medium text-gray-700 mb-2">ID (Valid ID/School ID)</label>
                <input type="file" id="validId_BrgyId" name="validId_BrgyId" accept="image/*" class="mt-1 p-3 border border-gray-300 rounded-md w-full focus:ring-indigo-500 focus:border-indigo-500" required>
                <div id="validIdPreview_BrgyId" class="mt-3"></div>
            </div>

            <!-- Proof of Residency -->
            <div class="mb-6">
                <label for="proofResidency_BrgyId" class="block text-sm font-medium text-gray-700 mb-2">Proof of Residency</label>
                <input type="file" id="proofResidency_BrgyId" name="proofResidency_BrgyId" accept="image/*" class="mt-1 p-3 border border-gray-300 rounded-md w-full focus:ring-indigo-500 focus:border-indigo-500" required>
                <div id="proofResidencyPreview_BrgyId" class="mt-3"></div>
            </div>

            <!-- Purpose -->
            <div class="mb-6">
                <label for="purpose_BrgyId" class="block text-sm font-medium text-gray-700 mb-2">Purpose</label>
                <textarea id="purpose_BrgyId" name="purpose_BrgyId" class="mt-1 p-3 border border-gray-300 rounded-md w-full focus:ring-indigo-500 focus:border-indigo-500" required></textarea>
            </div>



            <!-- Address -->
            <div class="mb-6">
                <label for="addressForm_BrgyId" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                <textarea id="addressForm_BrgyId" name="addressForm_BrgyId" class="mt-1 p-3 border border-gray-300 rounded-md w-full focus:ring-indigo-500 focus:border-indigo-500" required><?=$address?></textarea>
            </div>

            <!-- Payment -->
            <div class="mb-4">
                <label for="payment_BrgyId" class="block text-sm font-medium text-gray-700 mb-2">Payment</label>
                <select name="payment_BrgyId" id="payment_BrgyId" class="mt-1 p-3 border border-gray-300 rounded-md w-full focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="Cash on Delivery">Cash on Delivery</option>
                </select>
            </div>

            

        <!-- Receipt Section -->
        <div class=" border-t pt-6">
            <h4 class="text-lg font-semibold text-gray-800 mb-4">Total</h4>
            <div class="flex justify-between items-center mb-2">
                <span class="text-sm text-gray-600">Document Price:</span>
                <span id="documentPrice_BrgyId" class="text-sm text-gray-800" data-documentPrice="50.00" >₱ 50.00</span>
            </div>
            <div class="flex justify-between items-center mb-2">
                <span class="text-sm text-gray-600">Shipping Fee:</span>
                <span id="shippingFee_BrgyId" class="text-sm text-gray-800" data-shippingFee="0.00" >₱ 0.00</span>
            </div>
            <div class="flex justify-between items-center font-semibold">
                <span class="text-sm text-gray-600">Total:</span>
                <span id="totalPrice_BrgyId" class="text-sm text-gray-800" data-totalPrice="50.00" >₱ 50.00</span>
            </div>
        </div>

             <!-- Buttons -->
              <div class="border-t mt-4"></div>
                <div class="flex justify-end space-x-4 mb-6 mt-6 ">
                    <button id="request_BrgyId" type="submit" class="bg-blue-500 text-white py-2 px-6 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">Send Request</button>
                    <button type="button" id="closeModal" class="bg-gray-400 text-white py-2 px-6 rounded-md hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50">Cancel</button>
                </div>
            </form>
    </div>
</div>




<!-- Modal clearanceModal -->
<div id="clearanceModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center z-50 overflow-auto" style="display:none;">
    <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-2xl mx-4 max-h-screen overflow-y-auto">
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Request of Barangay Clearance</h3>
        <p class="text-sm text-gray-600 mb-6">Please fill out the form to request your clearance.</p>
        
        <div id="loadingSpinner_Clearance" style="display:none;">
            <div class="absolute inset-0 bg-white bg-opacity-75 flex items-center justify-center">
                <div class="w-10 h-10 border-4 border-indigo-500 border-t-transparent rounded-full animate-spin"></div>
            </div>
        </div>

        <!-- Form -->
        <form id="frmRequestClearance">
            <input hidden type="text" value="<?=$_SESSION['r_id']?>" name="r_id">
            <!-- Valid ID -->
            <div class="mb-6">
                <label for="validId_Clearance" class="block text-sm font-medium text-gray-700 mb-2">ID (Valid ID/School ID)</label>
                <input type="file" id="validId_Clearance" name="validId" accept="image/*" class="mt-1 p-3 border border-gray-300 rounded-md w-full focus:ring-indigo-500 focus:border-indigo-500" required>
                <div id="validIdPreview_Clearance" class="mt-3"></div>
            </div>

            <!-- Proof of Residency -->
            <div class="mb-6">
                <label for="proofResidency_Clearance" class="block text-sm font-medium text-gray-700 mb-2">Proof of Residency</label>
                <input type="file" id="proofResidency_Clearance" name="proofResidency" accept="image/*" class="mt-1 p-3 border border-gray-300 rounded-md w-full focus:ring-indigo-500 focus:border-indigo-500" required>
                <div id="proofResidencyPreview_Clearance" class="mt-3"></div>
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
            <div class="mb-4">
                <label for="payment" class="block text-sm font-medium text-gray-700 mb-2">Payment</label>
                <select name="payment" id="payment" class="mt-1 p-3 border border-gray-300 rounded-md w-full focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="Cash on Delivery">Cash on Delivery</option>
                </select>
            </div>

            

        <!-- Receipt Section -->
        <div id="receiptSection" class=" border-t pt-6">
            <h4 class="text-lg font-semibold text-gray-800 mb-4">Total</h4>
            <div class="flex justify-between items-center mb-2">
                <span class="text-sm text-gray-600">Document Price:</span>
                <span id="documentPrice_Clearance" class="text-sm text-gray-800" data-documentPrice="50.00" >₱ 50.00</span>
            </div>
            <div class="flex justify-between items-center mb-2">
                <span class="text-sm text-gray-600">Shipping Fee:</span>
                <span id="shippingFee_Clearance" class="text-sm text-gray-800" data-shippingFee="0.00" >₱ 0.00</span>
            </div>
            <div class="flex justify-between items-center font-semibold">
                <span class="text-sm text-gray-600">Total:</span>
                <span id="totalPrice_Clearance" class="text-sm text-gray-800" data-totalPrice="50.00" >₱ 50.00</span>
            </div>
        </div>

             <!-- Buttons -->
              <div class="border-t mt-4"></div>
                <div class="flex justify-end space-x-4 mb-6 mt-6 ">
                    <button id="requestClearance" type="submit" class="bg-blue-500 text-white py-2 px-6 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">Send Request</button>
                    <button type="button" class="closeModal bg-gray-400 text-white py-2 px-6 rounded-md hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50">Cancel</button>
                </div>
            </form>
    </div>
</div>






<!-- Modal -->
<div id="cancelOrderModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex justify-center items-center" style="display:none;">
    <div class="bg-white p-6 rounded-lg w-1/3">
        <h2 class="text-lg font-semibold mb-4">Are you sure you want to cancel this request?</h2>
        <div class="flex justify-end gap-4">
            <button class="closeModal bg-gray-500 text-white py-2 px-4 rounded-md">Cancel</button>
            <button class="bg-red-500 text-white py-2 px-4 rounded-md">Confirm</button>
        </div>
    </div>
</div>


<script>
    
    $('.cancelRequest').click(function() {
        console.log('cancelRequest');
        // $('#cancelOrderModal').fadeIn();
    });

    // Close modal when the Cancel button is clicked
    $('.closeModal').click(function() {
        console.log('closeModal');
        // $('#cancelOrderModal').fadeOut();
    });

</script>



<?php include "components/footer.php";?>
