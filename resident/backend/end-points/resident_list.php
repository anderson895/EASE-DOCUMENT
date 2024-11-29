
<?php 

$fetch_all_resident = $db->fetch_all_resident();

if ($fetch_all_resident): ?>
    <?php foreach ($fetch_all_resident as $resident):
        $profile = "<img src='../upload_resident/{$resident['r_profile']}' alt='Profile Picture' class='w-10 h-10 object-cover rounded-full'>";



        $Address =$resident['r_region'].' '. $resident['r_street'] . ' ' . $resident['r_barangay'] . ' ' . $resident['r_province'] . ' ' . $resident['r_municipality'];

        if (strlen($Address) > 80) {
            $Address = substr($Address, 0, 80) . '...';
        }
        $resident['r_region'] . ', ' . 
        $resident['r_barangay'] . ', ' . 
        $resident['r_municipality'] . ', ' . 
        $resident['r_province'];
        

        $fullname = $resident['r_fname'] . 
        ($resident['r_mname'] ? ' ' . $resident['r_mname'] : '') . 
        ' ' . $resident['r_lname'] . 
        ($resident['r_suffix'] ? ' ' . $resident['r_suffix'] : '');

       
        $valid_id=$resident['r_valid_ids'];
        ?>
      <tr>
    <td class="p-2"><?= $resident['r_id']; ?></td>
    <td class="p-2"><?= $profile; ?></td>
    <td class="p-2"><?= $fullname; ?></td>
    <td class="p-2"><?= $resident['r_email']; ?></td>
    <td class="p-2"><?= $Address; ?></td>
    <td class="p-2">
        <!-- Wrapper for horizontal scroll -->
        <div class="overflow-x-auto whitespace-nowrap">
            <div class="inline-flex gap-2">
                <!-- Decline Button -->
                
                <!-- View More Button -->

                <button class="bg-green-500 text-white py-1 px-2 text-sm rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75">
                    <span class="material-icons text-sm">edit</span> 
                </button>
                <button class="viewResidentModal bg-gray-500 text-white py-1 px-2 text-sm rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-75">
                    <span class="material-icons text-sm">visibility</span> 
                </button>
                <button class="bg-red-500 text-white py-1 px-2 text-sm rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75">
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
