<?php 

$fetch_all_clearance_request = $db->fetch_all_clearance_request($r_id);

if ($fetch_all_clearance_request): ?>
    <?php foreach ($fetch_all_clearance_request as $request):
       if($request['cr_status']=='Pending'){
        $editFunction = "";
        $tailwindclassEdit = "bg-gray-500 text-white py-1 px-2 text-sm rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-75";
        $tailwindclassCancel = "bg-red-500 text-white py-1 px-2 text-sm rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75";
      
        } else {
        $requestStatus = "Declined";
        $editFunction = "disabled"; 
        $tailwindclassEdit = "bg-gray-300 text-white py-1 px-2 text-sm rounded-md";
        $tailwindclassCancel = "bg-red-300 text-white py-1 px-2 text-sm rounded-md";
       }
        ?>
      <tr>
        <td class="p-2"><?= $request['cr_id']; ?></td>
        <td class="p-2"><?= $request['cr_formtype']; ?></td>
        <td class="p-2"><?= $request['cr_purpose']; ?></td>
        <td class="p-2"><?= $request['cr_address']; ?></td>
        <td class="p-2"><?= $request['cr_payment']; ?></td>
        <td class="p-2">
            <?= (new DateTime($request['cr_request_date']))->format('F j, Y, g:i A'); ?>
        </td>

        <td class="p-2"><?= $request['cr_status']; ?></td>
        <td class="p-2">
            <div class="overflow-x-auto whitespace-nowrap">
                <div class="inline-flex gap-2">
                    <!-- View More Button -->
                    <button class="viewResidentModal bg-green-500 text-white py-1 px-2 text-sm rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75">
                        <span class="material-icons text-sm">visibility</span> 
                    </button>
                    <button <?=$editFunction?> class="<?=$tailwindclassEdit?>" data-id="<?= $request['cr_id']; ?>" id="editBtn">
                        <span class="material-icons text-sm">edit</span> 
                    </button>
                    
                    <button <?=$editFunction?> class="<?=$tailwindclassCancel?>">
                        <span class="material-icons text-sm">delete</span> 
                    </button>
                </div>
            </div>
        </td>
    </tr>

    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="5" class="p-2">No record found.</td>
    </tr>
<?php endif; ?>

<!-- Modal for Editing -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-md p-6 w-96">
        <h2 class="text-lg font-semibold mb-4">Edit Clearance Request</h2>
        <form id="editForm">
            <label for="cr_id" class="block mb-2">Request ID:</label>
            <input type="text" id="cr_id" name="cr_id" class="border border-gray-300 p-2 w-full mb-4" readonly>
            <label for="cr_status" class="block mb-2">Status:</label>
            <select id="cr_status" name="cr_status" class="border border-gray-300 p-2 w-full mb-4">
                <option value="Pending">Pending</option>
                <option value="Approved">Approved</option>
                <option value="Declined">Declined</option>
            </select>
            <div class="flex justify-end gap-2">
                <button type="button" class="bg-gray-500 text-white py-1 px-4 rounded-md" id="cancelEdit">Cancel</button>
                <button type="submit" class="bg-blue-500 text-white py-1 px-4 rounded-md">Save</button>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Show modal when edit button is clicked
    $('#editBtn').on('click', function() {
        var cr_id = $(this).data('id');
        $('#editModal').removeClass('hidden');
        $('#cr_id').val(cr_id);
    });

    // Hide modal when cancel button is clicked
    $('#cancelEdit').on('click', function() {
        $('#editModal').addClass('hidden');
    });

    // Handle form submission (you can send an AJAX request here)
    $('#editForm').on('submit', function(e) {
        e.preventDefault();
        var cr_id = $('#cr_id').val();
        var cr_status = $('#cr_status').val();
        
        // Example AJAX request to update the record
        $.ajax({
            url: 'update_request.php', // Replace with your update script
            method: 'POST',
            data: { cr_id: cr_id, cr_status: cr_status },
            success: function(response) {
                console.log(response);
                $('#editModal').addClass('hidden');
                // Optionally, reload the page or update the table row
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
});
</script>
