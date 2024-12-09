
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

                <button class="editResidentButton bg-green-500 text-white py-1 px-2 text-sm rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75"
                data-r_id="<?=$resident['r_id'];?>"
                data-r_fname="<?=$resident['r_fname'];?>"
                data-r_mname="<?=$resident['r_mname'];?>"
                data-r_lname="<?=$resident['r_lname'];?>"
                data-r_profile="../upload_resident/<?=$resident['r_profile'];?>"
                data-r_valid_ids="../upload_resident_id/<?=$resident['r_valid_ids'];?>"
                data-r_suffix="<?=$resident['r_suffix'];?>"
                data-r_gender="<?=$resident['r_gender'];?>"
                data-r_civil_status="<?=$resident['r_civil_status'];?>"
                data-r_citizenship="<?=$resident['r_citizenship'];?>"
                data-r_bday="<?=$resident['r_bday'];?>"
                data-r_street="<?=$resident['r_street'];?>"
                data-r_region="<?=$resident['r_region'];?>"
                data-r_province="<?=$resident['r_province'];?>"
                data-r_municipality="<?=$resident['r_municipality'];?>"
                data-r_barangay="<?=$resident['r_barangay'];?>"
                data-r_contact_number="<?=$resident['r_contact_number'];?>"
                data-r_email="<?=$resident['r_email'];?>"
                
                >
                    <span class="material-icons text-sm">edit</span> 
                </button>
              
                <button class="deleteResidentButton bg-red-500 text-white py-1 px-2 text-sm rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75" 
                    data-r_id="<?= $resident['r_id']; ?>">
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




