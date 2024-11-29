
<?php 

$fetch_all_resident = $db->fetch_all_resident();

if ($fetch_all_resident): ?>
    <?php foreach ($fetch_all_resident as $resident):
        $profile = "<img src='../upload_resident/{$resident['r_profile']}' alt='Profile Picture' class='w-10 h-10 object-cover rounded-full'>";



        $Address = $resident['r_street'] . ' ' . $resident['r_barangay'] . ' ' . $resident['r_province'] . ' ' . $resident['r_municipality'];

        // Check if the address is longer than 50 characters
        if (strlen($Address) > 50) {
            $Address = substr($Address, 0, 50) . '...'; // Truncate and add ellipsis
        }
        
        $resident['r_barangay'] . ', ' . 
        $resident['r_municipality'] . ', ' . 
        $resident['r_province'];


        $fullname = $resident['r_fname'] . 
        ($resident['r_mname'] ? ' ' . $resident['r_mname'] : '') . 
        ' ' . $resident['r_lname'] . 
        ($resident['r_suffix'] ? ' ' . $resident['r_suffix'] : '');

        if($resident['r_status'] =='1'){
            $status_color = "text-yellow-500";
            $status= "Not Verified";
        }else if($resident['r_status'] =='2'){
            $status= "Verified";
            $status_color = "text-green-500";
        }
      
        ?>
      <tr>
    <td class="p-2"><?= htmlspecialchars($resident['r_id']); ?></td>
    <td class="p-2"><?= $profile; ?></td>
    <td class="p-2"><?= htmlspecialchars($fullname); ?></td>
    <td class="p-2"><?= htmlspecialchars($resident['r_email']); ?></td>
    <td class="p-2"><?= htmlspecialchars($Address); ?></td>
    <td class="p-2 <?= $status_color; ?>"><?= $status; ?></td>
    <td class="p-2">
        <!-- Wrapper for horizontal scroll -->
        <div class="overflow-x-auto whitespace-nowrap">
            <div class="inline-flex gap-2">
                <!-- Verify Button -->
                <button class="bg-green-500 text-white py-0.5 px-3 rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75">
                    Verify
                </button>
                <!-- Decline Button -->
                <button class="bg-red-500 text-white py-0.5 px-3 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75">
                    Decline
                </button>
                <!-- View More Button -->
                <button class="bg-gray-500 text-white py-0.5 px-3 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-75">
                    View More
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
