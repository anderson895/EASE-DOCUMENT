<?php
include('../class.php');

$db = new global_class();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


        if ($_POST['requestType'] == 'RequestClearance') {


            
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
                        $r_id
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
           


        }else if ($_POST['requestType'] == 'updateResident') {

        } else {
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
