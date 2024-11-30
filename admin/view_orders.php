<?php 
include "components/header.php";
date_default_timezone_set('Asia/Manila');
$dateToday = new DateTime(); 
$formattedDate = $dateToday->format('F j, Y'); 
$day = $dateToday->format('d'); 
$month = $dateToday->format('F');
$year = $dateToday->format('Y'); 

function getOrdinalSuffix($number) {
    if (!in_array(($number % 100), [11, 12, 13])) {
        switch ($number % 10) {
            case 1: return 'st';
            case 2: return 'nd';
            case 3: return 'rd';
        }
    }
    return 'th';
}

$ordinalDay = $day . getOrdinalSuffix($day);

function getAge($birthday) {
    $birthDate = new DateTime($birthday);
    $today = new DateTime();
    return $today->diff($birthDate)->y;
}

$GetAllOrders = $db->GetAllOrders();
foreach ($GetAllOrders as $order):

    $cr_code=$order['cr_code'];
    $age = getAge($order['r_bday']);
    $fullName = ucfirst($order['r_fname']) . ' ' . $order['r_mname'] . ' ' . $order['r_lname'];

    if($order['cr_formtype']=="Barangay Clearance"){
        include "backend/end-points/barangay_clearance.php";
    }
?>


<!-- Print Button -->
<div class="text-center mt-8">
    <button id="printButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
      Print
    </button>
</div>


<script>
  $(document).ready(function () {
    $('#printButton').on('click', function () {
      const printableContent = $('#printableArea').html();
      const printWindow = window.open('', '_blank');
      printWindow.document.open();
      printWindow.document.write(`
        <html>
          <head>
            <title>Print Barangay Clearance</title>
            <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
            <style>
              @media print {
                body {
                  width: 8.5in;
                  height: 11in;
                  margin: 0.5in; /* Adjusted margin size for print */
                  font-size: 12pt;
                }
                .max-w-4xl {
                  max-width: none;
                  width: 100%;
                }
                .p-8 {
                  padding: 1in; /* Adjusted padding for print */
                }
                .text-center {
                  text-align: center;
                }
                .underline {
                  text-decoration: underline;
                }
                .font-bold {
                  font-weight: bold;
                }
                .font-semibold {
                  font-weight: 600;
                }
                .font-extrabold {
                  font-weight: 800;
                }
                /* Additional styles for print */
                .mt-8 {
                  margin-top: 0.5in; /* Adjusted margin-top for print */
                }
                .mt-12 {
                  margin-top: 1in; /* Adjusted margin-top for print */
                }
                .mt-16 {
                  margin-top: 1.5in; /* Adjusted margin-top for print */
                }
                .border-t {
                  border-top: 1px solid black; /* Added border styling for print */
                }
              }
            </style>
          </head>
          <body>
            ${printableContent}
          </body>
        </html>
      `);
      printWindow.document.close();
      printWindow.print();
    });
  });
</script>


<?php
endforeach;
include "components/footer.php";
?>
