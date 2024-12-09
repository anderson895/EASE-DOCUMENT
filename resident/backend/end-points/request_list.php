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
        <!-- Wrapper for horizontal scroll -->
        <div class="overflow-x-auto whitespace-nowrap">
            <div class="inline-flex gap-2">
                <!-- Decline Button -->
                
             
                
                <button <?=$editFunction?> class="cancelOrder <?=$tailwindclassCancel?>">
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
