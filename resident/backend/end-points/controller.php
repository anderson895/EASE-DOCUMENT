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

?>
