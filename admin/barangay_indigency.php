<?php include "components/header.php"; ?>

<div class="flex justify-between items-center bg-white p-4 mb-6 rounded-md shadow-md">
    <h2 class="text-lg font-semibold text-gray-700">Barangay Clearance</h2>
    <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-lg font-bold text-white">
        <?php
        echo substr(ucfirst($_SESSION['r_fname']), 0, 1);
        ?>
    </div>
</div>

<div class="max-w-4xl mx-auto bg-white p-8 border border-gray-200 rounded-lg shadow-lg">

    <!-- Certificate Header -->
    <div class="text-center mb-8">
        <h1 class="text-2xl font-semibold uppercase text-gray-700">Republic of the Philippines</h1>
        <p class="text-sm text-gray-600">Province of Ilocos Sur</p>
        <p class="text-sm text-gray-600">Municipality of Sinait</p>
        <p class="text-sm text-gray-600">Barangay Sabangan</p>
    </div>

    <!-- Certificate Title -->
    <div class="text-center mb-8">
        <h2 class="text-xl font-bold text-gray-800">OFFICE OF THE PUNONG BARANGAY</h2>
        <h3 class="text-lg font-semibold mt-2 text-gray-700">CERTIFICATE OF INDIGENCY</h3>
    </div>

    <!-- Certificate Body -->
    <div class="mb-8">
        <p class="text-base text-gray-700">
            <span class="font-semibold">TO WHOM IT MAY CONCERN:</span>
        </p>
        <p class="text-base mt-4 text-gray-700">
            This is to certify that <span class="font-semibold">JONEL H. GARCIA</span>, 27 years of age, SINGLE and permanently residing at Brgy. Sabangan, Sinait, Ilocos Sur. She belongs to the ultra-poor families of this Barangay.
        </p>
        <p class="text-base mt-4 text-gray-700">
            This certification is hereby issued upon the request of the above-mentioned name for whatever purposes it may serve.
        </p>
    </div>

    <!-- Issuance Information -->
    <div class="text-center mt-8">
        <p class="text-base text-gray-700">
            Issued this 28<sup>th</sup> day of November, 2019 at the Session Hall Brgy. Sabangan, Sinait, Ilocos Sur.
        </p>
    </div>

    <!-- Signature Section -->
    <div class="mt-8 text-center">
        <p class="font-semibold text-gray-800">MANOLO I. DANGCIL</p>
        <p class="text-gray-600">Punong Barangay</p>
    </div>

</div>

<!-- Request Button -->
<div class="flex justify-center mt-6">
    <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition duration-300 ease-in-out">
        Request Document
    </button>
</div>

<?php include "components/footer.php"; ?>
