<?php include "components/header.php"; ?>

<div class="min-h-screen bg-gray-100 flex items-center justify-center">
    <div class="w-full max-w-4xl bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">Resident Information</h2>

        <form id='frmAccountSetting' class="space-y-6">
            <!-- Profile Picture Section -->
            <div class="flex justify-center mb-6">
                <div class="relative">
                    <!-- Profile Picture Preview -->
                    <img id="image-preview" src="" alt="Profile Picture Preview" class="w-32 h-32 object-cover rounded-full border-4 border-blue-500 shadow-lg" style="display: none;">
                    <!-- Default Image for Profile if no image selected -->
                    <img src="../upload_resident/<?=$result[0]['r_profile']?>" alt="Default Profile Picture" id="default-image" class="w-32 h-32 object-cover rounded-full border-4 border-gray-300 shadow-lg">

                    <!-- Upload New Profile Picture Button with Material Icon -->
                    <label for="r_profile" class="absolute bottom-0 right-0 w-8 h-8 bg-blue-500 text-white rounded-full border-2 border-white cursor-pointer opacity-75 hover:opacity-100 flex items-center justify-center">
                        <i class="material-icons">camera_alt</i>
                    </label>
                    <input type="file" id="r_profile" name="r_profile" class="hidden" accept="image/*" onchange="previewImage(event)">
                </div>
            </div>

            <!-- Personal Information Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-1">
                    <label for="r_fname" class="block text-sm font-medium text-gray-700">First Name</label>
                    <input type="text" id="r_fname" name="r_fname" value="<?= $result[0]['r_fname']?>" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="col-span-1">
                    <label for="r_mname" class="block text-sm font-medium text-gray-700">Middle Name</label>
                    <input type="text" id="r_mname" name="r_mname" value="<?= $result[0]['r_mname']?>" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="col-span-1">
                    <label for="r_lname" class="block text-sm font-medium text-gray-700">Last Name</label>
                    <input type="text" id="r_lname" name="r_lname" value="<?= $result[0]['r_lname']?>" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="col-span-1">
                    <label for="r_suffix" class="block text-sm font-medium text-gray-700">Suffix (Optional)</label>
                    <input type="text" id="r_suffix" value="<?= $result[0]['r_suffix']?>" name="r_suffix" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <!-- Contact Information Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-1">
                    <label for="r_email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" id="r_email" value="<?= $result[0]['r_email']?>" name="r_email" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="col-span-1">
                    <label for="r_contact_number" class="block text-sm font-medium text-gray-700">Contact Number</label>
                    <input type="text" id="r_contact_number" value="<?= $result[0]['r_contact_number']?>" name="r_contact_number" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
            </div>

            <!-- Date of Birth Section -->
            <div class="mb-6">
                <label for="r_bday" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                <input type="date" id="r_bday" name="r_bday" value="<?= $result[0]['r_bday']?>" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Address Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-1">
                    <label for="r_street" class="block text-sm font-medium text-gray-700">Street</label>
                    <input type="text" id="r_street" value="<?= $result[0]['r_street']?>"  name="r_street"  class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="col-span-1">
                    <label for="r_barangay" class="block text-sm font-medium text-gray-700">Barangay</label>
                    <input type="text" id="r_barangay" value="<?= $result[0]['r_barangay']?>"  name="r_barangay" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="col-span-1">
                    <label for="r_region" class="block text-sm font-medium text-gray-700">Region</label>
                    <input type="text" id="r_region" value="<?= $result[0]['r_region']?>" name="r_region" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="col-span-1">
                    <label for="r_province" class="block text-sm font-medium text-gray-700">Province</label>
                    <input type="text" id="r_province" value="<?= $result[0]['r_province']?>" name="r_province" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="col-span-1">
                    <label for="r_municipality" class="block text-sm font-medium text-gray-700">Municipality</label>
                    <input type="text" id="r_municipality" value="<?= $result[0]['r_municipality']?>" name="r_municipality" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
            </div>

            <!-- Civil Status Section -->
            <div class="mb-6">
                <label for="r_civil_status" value="<?= $result[0]['r_civil_status']?>"  class="block text-sm font-medium text-gray-700">Civil Status</label>
                <select id="r_civil_status" name="r_civil_status" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Widowed">Widowed</option>
                    <option value="Divorced">Divorced</option>
                </select>
            </div>

            <!-- Gender Section -->
            <div class="mb-6">
                <label for="r_gender" class="block text-sm font-medium text-gray-700">Gender</label>
                <select id="r_gender" value="<?= $result[0]['r_gender']?>"  name="r_gender" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">Save Information</button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage(event) {
        const preview = document.getElementById('image-preview');
        const defaultImage = document.getElementById('default-image');
        const reader = new FileReader();

        reader.onload = function () {
            preview.src = reader.result;
            preview.style.display = 'block';
            defaultImage.style.display = 'none';
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

<?php include "components/footer.php"; ?>