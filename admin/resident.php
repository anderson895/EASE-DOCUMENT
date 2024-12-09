<?php 
include "components/header.php";
?>

<div class="flex justify-between items-center bg-white p-4 mb-6 rounded-md shadow-md">
    <h2 class="text-lg font-semibold text-gray-700">Resident List</h2>
    <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-lg font-bold text-white">
        <?php
        echo substr(ucfirst($_SESSION['user_type']), 0, 1);
        ?>
    </div>
</div>

<!-- Card for Table -->
<div class="bg-white rounded-lg shadow-lg p-6">
   
   <!-- Add Resident Button -->
   <div class="mb-4 flex items-center space-x-4">
       <button id="addResidentButton" class="bg-blue-500 text-white py-1 px-3 text-xs rounded-md flex items-center hover:bg-blue-600 transition duration-300">
           <span class="material-icons mr-1 text-sm">person_add</span>
           Add Resident
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
                    <th class="p-2">Profile</th>
                    <th class="p-2">Fullname</th>
                    <th class="p-2">Email</th>
                    <th class="p-2">Address</th>
                    <th class="p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php include "backend/end-points/resident_list.php"; ?>
            </tbody>
        </table>
    </div>
</div>










<div id="addResidentModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50" style="display:none;">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-4xl max-h-screen overflow-y-auto space-y-6">
        <h3 class="text-2xl font-semibold text-gray-800 text-center">Add Resident</h3>

 <!-- Spinner -->
        <div id="loadingSpinner" style="display:none;">
                <div class=" absolute inset-0 bg-white bg-opacity-75 flex items-center justify-center">
                <div class="w-10 h-10 border-4 border-indigo-500 border-t-transparent rounded-full animate-spin"></div>
                </div>
            </div>


        <form id="frmAddResident" class="space-y-6">
            
            <!-- Resident Details -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label for="fname" class="block text-sm font-medium text-gray-700">First Name</label>
                    <input type="text" id="fname" name="fname" class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                </div>

                <div class="mb-4">
                    <label for="mname" class="block text-sm font-medium text-gray-700">Middle Name</label>
                    <input type="text" id="mname" name="mname" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                </div>

                <div class="mb-4">
                    <label for="lname" class="block text-sm font-medium text-gray-700">Last Name</label>
                    <input type="text" id="lname" name="lname" class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                </div>

                <div class="mb-4">
                    <label for="suffix" class="block text-sm font-medium text-gray-700">Suffix</label>
                    <input type="text" id="suffix" name="r_suffix" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                </div>
            </div>

            <!-- Contact & Profile -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label for="profileImg" class="block text-sm font-medium text-gray-700">Profile Image</label>
                    <input type="file" id="profileImg" name="profileImg" class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                    <div id="profileImgPreview" class="mt-4"></div> <!-- Space for displaying the image -->
                </div>

                <div class="mb-4">
                    <label for="validId" class="block text-sm font-medium text-gray-700">Valid ID</label>
                    <input type="file" id="validId" name="validId" class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                    <div id="validIdPreview" class="mt-4"></div> <!-- Space for displaying the image -->
                </div>
            </div>


            <!-- Personal Info -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label for="Gender" class="block text-sm font-medium text-gray-700">Gender</label>
                    <select id="Gender" name="Gender" class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>


                <div class="mb-4">
                    <label for="civil_status" class="block text-sm font-medium text-gray-700">Civil Status</label>
                    <select id="civil_status" name="r_civil_status" class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                        <option value="">Select Civil Status</option>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Divorced">Divorced</option>
                        <option value="Widowed">Widowed</option>
                    </select>
                </div>


                <div class="mb-4">
                    <label for="bday" class="block text-sm font-medium text-gray-700">Birthday</label>
                    <input type="date" id="bday" name="r_bday" class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                </div>

                <div class="mb-4">
                    <label for="contact_number" class="block text-sm font-medium text-gray-700">Contact Number</label>
                    <input 
                        type="text" 
                        id="contact_number" 
                        name="r_contact_number" 
                        class="mt-1 p-2 border border-gray-300 rounded-md w-full" 
                        pattern="\d{11}" 
                        title="Please enter an 11-digit number." 
                        required>
                </div>

            </div>

           <!-- Address -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">
               

                <div class="mb-4">
                    <label for="region" class="block text-sm font-medium text-gray-700">Region</label>
                    <select id="region" name="r_region" class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="province" class="block text-sm font-medium text-gray-700">Province</label>
                    <select id="province" name="r_province" class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="city" class="block text-sm font-medium text-gray-700">Municipality</label>
                    <select id="city" name="r_city" class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="barangay" class="block text-sm font-medium text-gray-700">Barangay</label>
                    <select id="barangay" name="r_barangay" class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                    </select>
                </div>


                
               


                <div class="mb-4">
                    <label for="street" class="block text-sm font-medium text-gray-700">Street</label>
                    <input type="text" id="street" name="r_street" class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                </div>
            </div>


            <!-- Additional Fields -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="text" id="email" name="r_email" class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="r_password" class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                </div>

                <div class="mb-4">
                    <label for="confirm_Password" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input type="password" id="confirm_Password" name="c_Password" class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex space-x-4">
                <button id="AddResident" type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Save Resident</button>
                <button type="button" class="addResidentCloseModal bg-gray-400 text-white py-2 px-4 rounded-md hover:bg-gray-500">Cancel</button>
            </div>

        </form>
    </div>
</div>
















<div id="editResidentModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50" style="display:none;">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-4xl max-h-screen overflow-y-auto space-y-6">
        <h3 class="text-2xl font-semibold text-gray-800 text-center">Update Resident Data</h3>

 <!-- Spinner -->
        <div id="editResidentloadingSpinner" style="display:none;">
                <div class=" absolute inset-0 bg-white bg-opacity-75 flex items-center justify-center">
                <div class="w-10 h-10 border-4 border-indigo-500 border-t-transparent rounded-full animate-spin"></div>
                </div>
            </div>


        <form id="frmEditResident" class="space-y-6">
            
            <!-- Resident Details -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                <input hidden type="text" id="r_id" name="r_id" required>

                <div class="mb-4">
                    <label for="r_fname" class="block text-sm font-medium text-gray-700">First Name</label>
                    <input type="text" id="r_fname" name="fname" class="mt-1 p-2 border border-gray-300 rounded-md w-full" >
                </div>

                <div class="mb-4">
                    <label for="r_mname" class="block text-sm font-medium text-gray-700">Middle Name</label>
                    <input type="text" id="r_mname" name="mname" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                </div>

                <div class="mb-4">
                    <label for="r_lname" class="block text-sm font-medium text-gray-700">Last Name</label>
                    <input type="text" id="r_lname" name="lname" class="mt-1 p-2 border border-gray-300 rounded-md w-full" >
                </div>

                <div class="mb-4">
                    <label for="r_suffix" class="block text-sm font-medium text-gray-700">Suffix</label>
                    <input type="text" id="r_suffix" name="r_suffix" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                </div>
            </div>

            <!-- Contact & Profile -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label for="r_profile" class="block text-sm font-medium text-gray-700">Profile Image</label>
                    <input type="file" id="r_profile" name="profileImg" class="mt-1 p-2 border border-gray-300 rounded-md w-full" >
                    <div id="r_profilePreview" class="mt-4"></div> <!-- Space for displaying the image -->
                </div>

                <div class="mb-4">
                    <label for="r_valid_ids" class="block text-sm font-medium text-gray-700">Valid ID</label>
                    <input type="file" id="r_valid_ids" name="validId" class="mt-1 p-2 border border-gray-300 rounded-md w-full" >
                    <div id="r_valid_idsPreview" class="mt-4"></div> <!-- Space for displaying the image -->
                </div>
            </div>


            <!-- Personal Info -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label for="r_gender" class="block text-sm font-medium text-gray-700">Gender</label>
                    <select id="r_gender" name="Gender" class="mt-1 p-2 border border-gray-300 rounded-md w-full" >
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>


                <div class="mb-4">
                    <label for="r_civil_status" class="block text-sm font-medium text-gray-700">Civil Status</label>
                    <select id="r_civil_status" name="r_civil_status" class="mt-1 p-2 border border-gray-300 rounded-md w-full" >
                        <option value="">Select Civil Status</option>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Divorced">Divorced</option>
                        <option value="Widowed">Widowed</option>
                    </select>
                </div>


                <div class="mb-4">
                    <label for="r_bday" class="block text-sm font-medium text-gray-700">Birthday</label>
                    <input type="date" id="r_bday" name="r_bday" class="mt-1 p-2 border border-gray-300 rounded-md w-full" >
                </div>

                <div class="mb-4">
                    <label for="r_contact_number" class="block text-sm font-medium text-gray-700">Contact Number</label>
                    <input type="text" id="r_contact_number" name="r_contact_number" class="mt-1 p-2 border border-gray-300 rounded-md w-full" >
                </div>
            </div>

           <!-- Address -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">
               

            <div class="mb-4">
                <label for="r_region" class="block text-sm font-medium text-gray-700">Region</label>
                <input id="r_region" name="r_region" type="text" class="mt-1 p-2 border border-gray-300 rounded-md w-full"  />
            </div>

            <div class="mb-4">
                <label for="r_province" class="block text-sm font-medium text-gray-700">Province</label>
                <input id="r_province" name="r_province" type="text" class="mt-1 p-2 border border-gray-300 rounded-md w-full"  />
            </div>

            <div class="mb-4">
                <label for="r_municipality" class="block text-sm font-medium text-gray-700">Municipality</label>
                <input id="r_municipality" name="r_city" type="text" class="mt-1 p-2 border border-gray-300 rounded-md w-full"  />
            </div>



                <div class="mb-4">
                    <label for="r_barangay" class="block text-sm font-medium text-gray-700">Barangay</label>
                    <input id="r_barangay" name="r_barangay" type="text" class="mt-1 p-2 border border-gray-300 rounded-md w-full"  />
                </div>





                <div class="mb-4">
                    <label for="r_street" class="block text-sm font-medium text-gray-700">Street</label>
                    <input type="text" id="r_street" name="r_street" class="mt-1 p-2 border border-gray-300 rounded-md w-full" >
                </div>
            </div>


            <!-- Additional Fields -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                

                <div class="mb-4">
                    <label for="r_email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="text" id="r_email" name="r_email" class="mt-1 p-2 border border-gray-300 rounded-md w-full" >
                </div>

                <div class="mb-4">
                    <label for="r_password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="r_password" name="r_password" class="mt-1 p-2 border border-gray-300 rounded-md w-full" >
                </div>

                <div class="mb-4">
                    <label for="c_Password" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input type="password" id="c_Password" name="c_Password" class="mt-1 p-2 border border-gray-300 rounded-md w-full" >
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex space-x-4">
                <button id="EditResident" type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Save Resident</button>
                <button type="button" id="EditcloseResidentModal" class="bg-gray-400 text-white py-2 px-4 rounded-md hover:bg-gray-500">Cancel</button>
            </div>

        </form>
    </div>
</div>














<?php include "components/footer.php";?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/resident.js"></script>
<script src="js/address_api.js"></script>
