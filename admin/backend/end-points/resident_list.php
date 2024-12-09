
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





<!-- Modal -->
<div id="deleteConfirmationModal" class="fixed z-10 inset-0 overflow-y-auto" style="display:none;" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        
        <div id="DeleteResidentloadingSpinner" style="display:none;">
                <div class=" absolute inset-0 bg-white bg-opacity-75 flex items-center justify-center">
                <div class="w-10 h-10 border-4 border-indigo-500 border-t-transparent rounded-full animate-spin"></div>
                </div>
            </div>
        <!-- Modal Content -->
        <form id="frmDeleteResident" class="space-y-6">

          
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <input type="text" id="TargetdelResidentId" name="TargetdelResidentId">
            
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Confirm Deletion</h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">Are you sure you want to Remove this resident?</p>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button id="confirmDeleteResident" type="button" class="bg-red-500 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400">Delete</button>
                    <button type="button" class="cancelDeleteResident bg-gray-300 text-gray-700 px-4 py-2 rounded-md text-sm font-medium hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 sm:mr-2">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
