<?php
include('../class.php');

$db = new global_class();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


        if ($_POST['requestType'] == 'RequestClearance') {

            $shippingFee = $_POST['shippingFee'];
            $documentPrice = $_POST['documentPrice'];
            $totalPrice = $_POST['totalPrice'];
            
            $purpose = $_POST['purpose'];
            $address = $_POST['addressForm'];
            $payment = $_POST['payment'];
            $r_id = $_POST['r_id'];
            $validId = $_FILES['validId'];
            $proofResidency = $_FILES['proofResidency'];
            
            // Initialize response array
            $response = [
                'status' => 'error',
                'message' => 'Unknown error occurred',
            ];
            
            try {
                // Define upload directory
                $uploadDir = '../../../upload_clearance/';
            
                // Generate unique filenames (excluding directory path)
                $validIdFilename = uniqid('validId_') . '.' . pathinfo($validId['name'], PATHINFO_EXTENSION);
                $proofResidencyFilename = uniqid('proofResidency_') . '.' . pathinfo($proofResidency['name'], PATHINFO_EXTENSION);
            
                // Full paths for file uploads
                $fullValidIdPath = $uploadDir . $validIdFilename;
                $fullProofResidencyPath = $uploadDir . $proofResidencyFilename;
            
                // Move uploaded files
                if (move_uploaded_file($validId['tmp_name'], $fullValidIdPath) &&
                    move_uploaded_file($proofResidency['tmp_name'], $fullProofResidencyPath)) {
                    
                    // Pass unique filenames (without path) to RequestClearance
                    $response['message'] = $db->RequestClearance(
                        $purpose, 
                        $address, 
                        $payment, 
                        $validIdFilename, // Pass only the filename
                        $proofResidencyFilename, // Pass only the filename
                        $r_id,
                        $documentPrice,
                        $shippingFee,
                        $totalPrice
                    );
            
                    // Update response on success
                    $response['status'] = 'success';
                } else {
                    $response['message'] = 'Failed to upload one or more files.';
                }
            } catch (Exception $e) {
                $response['message'] = 'Error: ' . $e->getMessage();
            }
            
            // Return JSON response
            echo json_encode($response);
           


        }else if ($_POST['requestType'] == 'RequestBarangayID') {


            $shippingFee = $_POST['shippingFee'];
            $documentPrice = $_POST['documentPrice'];
            $totalPrice = $_POST['totalPrice'];
            
            $purpose = $_POST['purpose_BrgyId'];
            $address = $_POST['addressForm_BrgyId'];
            $payment = $_POST['payment_BrgyId'];
            $r_id = $_POST['r_id'];
            
            $pic_BrgyId = $_FILES['1x1pic_BrgyId'];
            $signature_BrgyId = $_FILES['signature_BrgyId'];
            $validId = $_FILES['validId_BrgyId'];
            $proofResidency = $_FILES['proofResidency_BrgyId'];
            
            // Initialize response array
            $response = [
                'status' => 'error',
                'message' => 'Unknown error occurred',
            ];
            
            try {
                // Define upload directory
                $uploadDir = '../../../upload_id/';
            
                // Generate unique filenames for all uploaded files (excluding directory path)
                $validIdFilename = uniqid('validId_') . '.' . pathinfo($validId['name'], PATHINFO_EXTENSION);
                $proofResidencyFilename = uniqid('proofResidency_') . '.' . pathinfo($proofResidency['name'], PATHINFO_EXTENSION);
                $picFilename = uniqid('pic_') . '.' . pathinfo($pic_BrgyId['name'], PATHINFO_EXTENSION);
                $signatureFilename = uniqid('signature_') . '.' . pathinfo($signature_BrgyId['name'], PATHINFO_EXTENSION);
            
                // Full paths for file uploads
                $fullValidIdPath = $uploadDir . $validIdFilename;
                $fullProofResidencyPath = $uploadDir . $proofResidencyFilename;
                $fullPicPath = $uploadDir . $picFilename;
                $fullSignaturePath = $uploadDir . $signatureFilename;
            
                // Move uploaded files
                if (move_uploaded_file($validId['tmp_name'], $fullValidIdPath) &&
                    move_uploaded_file($proofResidency['tmp_name'], $fullProofResidencyPath) &&
                    move_uploaded_file($pic_BrgyId['tmp_name'], $fullPicPath) &&
                    move_uploaded_file($signature_BrgyId['tmp_name'], $fullSignaturePath)) {
            
                    // Pass unique filenames (without path) to RequestClearance
                    $response['message'] = $db->RequestBarangayID(
                        $purpose, 
                        $address, 
                        $payment, 
                        $validIdFilename, // Pass only the filename
                        $proofResidencyFilename, // Pass only the filename
                        $picFilename, // Pass the filename of 1x1 picture
                        $signatureFilename, // Pass the filename of signature
                        $r_id,
                        $documentPrice,
                        $shippingFee,
                        $totalPrice
                    );
            
                    // Update response on success
                    $response['status'] = 'success';
                } else {
                    $response['message'] = 'Failed to upload one or more files.';
                }
            } catch (Exception $e) {
                $response['message'] = 'Error: ' . $e->getMessage();
            }
            
            // Return JSON response
            echo json_encode($response);
           
            

        } else if ($_POST['requestType'] == 'RequestResidency') {


            $shippingFee = $_POST['shippingFee'];
            $documentPrice = $_POST['documentPrice'];
            $totalPrice = $_POST['totalPrice'];
            
            $purpose = $_POST['purpose'];
            $address = $_POST['addressForm'];
            $payment = $_POST['payment'];
            $r_id = $_POST['r_id'];
            
            $validId = $_FILES['validId'];
            
            // Initialize response array
            $response = [
                'status' => 'error',
                'message' => 'Unknown error occurred',
            ];
            
            try {
                // Define upload directory
                $uploadDir = '../../../upload_residency/';
            
                // Generate unique filenames for all uploaded files (excluding directory path)
                $validIdFilename = uniqid('validId_') . '.' . pathinfo($validId['name'], PATHINFO_EXTENSION);
               
                // Full paths for file uploads
                $fullValidIdPath = $uploadDir . $validIdFilename;
              
            
                // Move uploaded files
                if (move_uploaded_file($validId['tmp_name'], $fullValidIdPath)) {
            
                    // Pass unique filenames (without path) to RequestClearance
                    $response['message'] = $db->RequestResidency(
                        $purpose, 
                        $address, 
                        $payment, 
                        $validIdFilename,
                        $r_id,
                        $documentPrice,
                        $shippingFee,
                        $totalPrice
                    );
            
                    $response['status'] = 'success';
                } else {
                    $response['message'] = 'Failed to upload one or more files.';
                }
            } catch (Exception $e) {
                $response['message'] = 'Error: ' . $e->getMessage();
            }
            
            // Return JSON response
            echo json_encode($response);
           
            

        }else if ($_POST['requestType'] == 'RequestIndigency') {


            $shippingFee = $_POST['shippingFee'];
            $documentPrice = $_POST['documentPrice'];
            $totalPrice = $_POST['totalPrice'];
            
            $purpose = $_POST['purpose'];
            $address = $_POST['addressForm'];
            $payment = $_POST['payment'];
            $r_id = $_POST['r_id'];
            
            $validId = $_FILES['validId'];
            
            // Initialize response array
            $response = [
                'status' => 'error',
                'message' => 'Unknown error occurred',
            ];
            
            try {
                // Define upload directory
                $uploadDir = '../../../upload_residency/';
            
                // Generate unique filenames for all uploaded files (excluding directory path)
                $validIdFilename = uniqid('validId_') . '.' . pathinfo($validId['name'], PATHINFO_EXTENSION);
               
                // Full paths for file uploads
                $fullValidIdPath = $uploadDir . $validIdFilename;
              
            
                // Move uploaded files
                if (move_uploaded_file($validId['tmp_name'], $fullValidIdPath)) {
            
                    // Pass unique filenames (without path) to RequestClearance
                    $response['message'] = $db->RequestIndigency(
                        $purpose, 
                        $address, 
                        $payment, 
                        $validIdFilename,
                        $r_id,
                        $documentPrice,
                        $shippingFee,
                        $totalPrice
                    );
            
                    $response['status'] = 'success';
                } else {
                    $response['message'] = 'Failed to upload one or more files.';
                }
            } catch (Exception $e) {
                $response['message'] = 'Error: ' . $e->getMessage();
            }
            
            // Return JSON response
            echo json_encode($response);
           
            

        }else if ($_POST['requestType'] == 'UpdateAccountSetting') {

            // Validate and sanitize POST data
$r_id = filter_input(INPUT_POST, 'r_id', FILTER_SANITIZE_STRING);
$fname = filter_input(INPUT_POST, 'r_fname', FILTER_SANITIZE_STRING);
$mname = filter_input(INPUT_POST, 'r_mname', FILTER_SANITIZE_STRING);
$lname = filter_input(INPUT_POST, 'r_lname', FILTER_SANITIZE_STRING);
$r_suffix = filter_input(INPUT_POST, 'r_suffix', FILTER_SANITIZE_STRING);
$r_gender = filter_input(INPUT_POST, 'r_gender', FILTER_SANITIZE_STRING);
$r_civil_status = filter_input(INPUT_POST, 'r_civil_status', FILTER_SANITIZE_STRING);
$r_bday = filter_input(INPUT_POST, 'r_bday', FILTER_SANITIZE_STRING);
$r_contact_number = filter_input(INPUT_POST, 'r_contact_number', FILTER_SANITIZE_STRING);
$regionId = filter_input(INPUT_POST, 'r_region', FILTER_SANITIZE_STRING);
$provinceId = filter_input(INPUT_POST, 'r_province', FILTER_SANITIZE_STRING);
$cityId = filter_input(INPUT_POST, 'r_municipality', FILTER_SANITIZE_STRING);
$barangayId = filter_input(INPUT_POST, 'r_barangay', FILTER_SANITIZE_STRING);
$r_street = filter_input(INPUT_POST, 'r_street', FILTER_SANITIZE_STRING);
$r_email = filter_input(INPUT_POST, 'r_email', FILTER_SANITIZE_EMAIL);
$newPassword = filter_input(INPUT_POST, 'newPassword', FILTER_SANITIZE_STRING);
$profileImgPathDb = null;



// Handle Profile Image Upload
if (isset($_FILES['r_profile']) && $_FILES['r_profile']['error'] === UPLOAD_ERR_OK) {


    $uploadDirForResident = "../../../upload_resident/";


    $currentProfileImg = $db->check_account($r_id);

    // Check if the account exists and contains profile image
    if (count($currentProfileImg) > 0) {
        $currentProfileImg = $currentProfileImg[0]['r_profile']; // Access the first row's profile image
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Account not found or profile image missing.'
        ]);
        exit;  // Stop further execution if no account is found
    }

    // Unlink the old profile image if it exists
    if ($currentProfileImg && file_exists($uploadDirForResident . $currentProfileImg)) {
        unlink($uploadDirForResident . $currentProfileImg);  // Delete the old image
    }


    $profileImg = $_FILES['r_profile'];
    $profileImgName = generateUniqueFilename($profileImg['name']);  // Assuming this function generates a unique filename
    $profileImgPath = $uploadDirForResident . $profileImgName;

    // Check file upload success
    if (move_uploaded_file($profileImg['tmp_name'], $profileImgPath)) {
        // Successfully uploaded the profile image
        $profileImgPathDb = $profileImgName;  // Store only the filename (not the path)
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Error uploading profile image.'
        ]);
        exit;  // Stop further execution if the profile image upload fails
    }
}

try {
    // Call the updateResident function
    $response = $db->updateResident(
        $r_id, $fname, $mname, $lname, $r_suffix, $r_gender, $r_civil_status, 
        $r_bday, $r_contact_number, $regionId, $provinceId, $cityId, $barangayId, 
        $r_street, $r_email,$newPassword, $profileImgPathDb  
    );

    // Return success message
    echo json_encode([
        'status' => 'success',
        'message' => $response
    ]);
} catch (Exception $e) {
    // Return error message if an exception occurs
    echo json_encode([
        'status' => 'error',
        'message' => 'Error updating resident: ' . $e->getMessage()
    ]);
}



             
        }else if ($_POST['requestType'] == 'CancelRequest') {
            $requestId = $_POST['requestId'];

            $response = $db->CancelRequest($requestId);
            echo json_encode([
                'status' => 'success',
                'message' => $response['message'] 
            ]);

        }else{
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid request type'
            ]);
        }
   
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode([
        'status' => 'error',
        'message' => 'GET requests are not supported for this operation.'
    ]);
}









// Function to generate a unique filename
function generateUniqueFilename($filename) {
    $fileExtension = pathinfo($filename, PATHINFO_EXTENSION);
    $uniqueName = uniqid('file_', true) . '.' . $fileExtension;
    return $uniqueName;
}
?>
