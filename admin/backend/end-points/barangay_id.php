<div id="printableArea" class="max-w-4xl mx-auto bg-white p-8 mt-12 shadow-lg rounded-lg">
    



<div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden mt-10">
    <!-- Card Header -->
    <div class="bg-blue-500 text-white p-4 flex justify-between items-center">
        <div class="flex items-center">
            <span class="ml-4 text-lg font-bold">REPUBLIC OF THE PHILIPPINES</span>
        </div>
        <span class="text-lg">Barangay Resident Identification Card</span>
    </div>

    <!-- Card Content -->
    <div class="p-6 grid grid-cols-3 gap-4">
        <!-- Image Section -->
        <div class="col-span-1 flex justify-center items-center -mt-6">
            <div class="w-32 h-32 border-2 border-gray-300 rounded-md overflow-hidden">
                <!-- Replace with the actual image or a placeholder -->
                <img src="../upload_id/<?=$cr_1X1_pic?>" alt="Resident Photo" class="w-full h-full object-cover">
            </div>
        </div>

        <!-- Personal Information -->
        <div class="col-span-2">
            <div class="grid grid-cols-2 gap-x-4">
                <div>
                    <p><strong>LAST NAME, FIRST NAME, M.I.</strong></p>
                    <p class="text-xl"><?=$order['r_lname'];?>, <?=$order['r_fname'];?> <?=$order['r_mname'][0];?>.</p>
                </div>
                <div>
                    <p><strong>DATE OF BIRTH</strong></p>
                    <p class="text-xl"><?=$formatted_birthday?></p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-x-4 mt-4">
                <div>
                    <p><strong>CIVIL STATUS</strong></p>
                    <p class="text-xl"><?=$order['r_civil_status']?></p>
                </div>
                <div>
                    <p><strong>SEX</strong></p>
                    <p class="text-xl"><?=$order['r_gender']?></p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-x-4 mt-4">
                <div>
                    <p><strong>ADDRESS</strong></p>
                    <p class="text-xl"><?=$address?></p>
                </div>
                <div>
                    <p><strong>RESIDENT ID NUMBER</strong></p>
                    <p class="text-xl">XXX-0<?=$r_id?>-0000<?=$r_id?></p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-x-4 mt-4">
                <div>
                    <p><strong>DATE ISSUED</strong></p>
                    <p class="text-xl"><?=$formattedDate?></p>
                </div>
                <div>
                    <p><strong>VALID UNTIL</strong></p>
                    <p class="text-xl">_______________</p>
                </div>
            </div>

           <!-- Signature Section -->
            <div class="mt-6 border-t pt-4 text-center">
                <div class="w-48 h-16 mx-auto border-2 border-dashed overflow-hidden">
                    <img src="../upload_id/<?=$cr_Signature?>" alt="Resident Signature" class="w-full h-full object-contain">
                </div>
                <p class="mt-2 text-sm font-semibold">SIGNATURE</p>
            </div>


        </div>
    </div>
</div>








</div>