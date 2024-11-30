<?php
include('../class.php');

$db = new global_class();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['requestType'])) {


        if ($_POST['requestType'] == 'UpdateOrderStatus') {

            $orderId = $_POST['orderId'];
            $orderStatus = $_POST['orderStatus'];

           
                $order = $db->updateOrderStatus($orderId, $orderStatus);

                if ($order) {
                    echo 200; 
                } else {
                    echo 'Failed to update order in the database.';
                }
                
        }else if ($_POST['requestType'] == 'UpdateAdminInfo') {

            $user_fname = $_POST['user_fname'];
            $user_mname = $_POST['user_mname'];
            $user_lname = $_POST['user_lname'];
            $email = $_POST['email'];
            $user_id = $_POST['user_id'];

           
                $order = $db->UpdateAdminInfo($user_fname, $user_mname, $user_lname, $email, $user_id);

                if ($order) {
                    echo 200; 
                } else {
                    echo 'Failed to update order in the database.';
                }
                
        }else if ($_POST['requestType'] == 'UpdatePassword') {

            $current_password = $_POST['current_password'];
            $new_password = $_POST['new_password'];
            $user_id = $_POST['user_id'];
            
            // Call the function to update the password
            $order = $db->UpdateAdminPassword($current_password, $new_password, $user_id);
            
            // Check if the update was successful and return the response as JSON
            if ($order === "Password updated successfully.") {
                echo json_encode([
                    'status' => 200,
                    'message' => 'Password updated successfully.'
                ]);
            } else {
                echo json_encode([
                    'status' => 400,
                    'message' => $order  // Return the error message from the UpdateAdminPassword function
                ]);
            }
            
                
        }else if ($_POST['requestType'] == 'addResident') {

            // Validate and sanitize POST data
            $fname = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING);
            $mname = filter_input(INPUT_POST, 'mname', FILTER_SANITIZE_STRING);
            $lname = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING);
            $r_suffix = filter_input(INPUT_POST, 'r_suffix', FILTER_SANITIZE_STRING);
            $Gender = filter_input(INPUT_POST, 'Gender', FILTER_SANITIZE_STRING);
            $r_civil_status = filter_input(INPUT_POST, 'r_civil_status', FILTER_SANITIZE_STRING);
            $r_bday = filter_input(INPUT_POST, 'r_bday', FILTER_SANITIZE_STRING);
            $r_contact_number = filter_input(INPUT_POST, 'r_contact_number', FILTER_SANITIZE_STRING);
            $regionId = filter_input(INPUT_POST, 'r_region', FILTER_SANITIZE_STRING);
            $provinceId = filter_input(INPUT_POST, 'r_province', FILTER_SANITIZE_STRING);
            $cityId = filter_input(INPUT_POST, 'r_city', FILTER_SANITIZE_STRING);
            $barangayId = filter_input(INPUT_POST, 'r_barangay', FILTER_SANITIZE_STRING);
            $r_street = filter_input(INPUT_POST, 'r_street', FILTER_SANITIZE_STRING);
            $r_email = filter_input(INPUT_POST, 'r_email', FILTER_SANITIZE_EMAIL);

            $r_longlive = filter_input(INPUT_POST, 'longlive', FILTER_SANITIZE_EMAIL);

            
            $r_password = $_POST['r_password'];

            // Fetch the JSON data from the API endpoints
            $regionData = file_get_contents('../../../ph-json/region.json');
            $provinceData = file_get_contents('../../../ph-json/province.json');
            $cityData = file_get_contents('../../../ph-json/city.json');
            $barangayData = file_get_contents('../../../ph-json/barangay.json');

            // Decode the JSON data
            $regionData = json_decode($regionData, true);
            $provinceData = json_decode($provinceData, true);
            $cityData = json_decode($cityData, true);
            $barangayData = json_decode($barangayData, true);


       
            // Find the names based on the selected IDs
            foreach ($regionData['data'] as $item) {
                if ($item['region_code'] === $regionId) {
                    $region_code=$item['region_code'] ;
                    $region = $item['region_name'];
                }
            }
            foreach ($provinceData['data'] as $item) {
                if ($item['province_code'] === $provinceId) {
                    $province_code=$item['province_code'] ;
                    $province = $item['province_name'];
                }
            }
            foreach ($cityData['data'] as $item) {
                if ($item['city_code'] === $cityId) {
                    $city_code=$item['city_code'] ;
                    $city = $item['city_name'];
                }
            }
            foreach ($barangayData['data'] as $item) {
                if ($item['brgy_code'] === $barangayId) {
                    $brgy_code=$item['brgy_code'] ;
                    $barangay = $item['brgy_name'];
                }
            }


            // Ensure all required fields are present
            if (empty($fname) || empty($lname) || empty($r_email) || empty($r_password)) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Missing required fields.'
                ]);
                exit;
            }

            // Directory to save the uploaded files
            $uploadDirForResident = "../../../upload_resident/";
            $uploadDirForId = "../../../upload_resident_id/";

            // Ensure the directory exists
            if (!is_dir($uploadDirForResident)) {
                mkdir($uploadDirForResident, 0777, true);
            }

            if (!is_dir($uploadDirForId)) {
                mkdir($uploadDirForId, 0777, true);
            }

            // Initialize variables for file paths
            $profileImgPathDb = null;
            $validIdPathDb = null;

            // Handle Profile Image Upload
            if (isset($_FILES['profileImg']) && $_FILES['profileImg']['error'] === UPLOAD_ERR_OK) {
                $profileImg = $_FILES['profileImg'];
                $profileImgName = generateUniqueFilename($profileImg['name']);
                $profileImgPath = $uploadDirForResident . $profileImgName;

                if (move_uploaded_file($profileImg['tmp_name'], $profileImgPath)) {
                    // Successfully uploaded the profile image
                    $profileImgPathDb = $profileImgName;  // Store only the filename
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Error uploading profile image.'
                    ]);
                    exit;  // Stop further execution if the profile image upload fails
                }
            }

            // Handle Valid ID Upload
            if (isset($_FILES['validId']) && $_FILES['validId']['error'] === UPLOAD_ERR_OK) {
                $validId = $_FILES['validId'];
                $validIdName = generateUniqueFilename($validId['name']);
                $validIdPath = $uploadDirForId . $validIdName;

                if (move_uploaded_file($validId['tmp_name'], $validIdPath)) {
                    // Successfully uploaded the valid ID
                    $validIdPathDb = $validIdName;  // Store only the filename
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Error uploading valid ID.'
                    ]);
                    exit;  // Stop further execution if the valid ID upload fails
                }
            }

            // Pass all variables to the addResident method
            try {
                $response = $db->addResident(
                    $fname, $mname, $lname, $r_suffix, $Gender, $r_civil_status, 
                    $r_bday, $r_contact_number,$region, $province, $city, $barangay, 
                    $r_street, $r_email, $r_password, $profileImgName, $validIdName,$r_longlive
                );
                echo json_encode([
                    'status' => 'success',
                    'message' => $response
                ]);
            } catch (Exception $e) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Error adding resident: ' . $e->getMessage()
                ]);
            }

        }else if ($_POST['requestType'] == 'updateResident') {

        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid request type'
            ]);
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Access Denied! No Request Type.'
        ]);
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    if ($_GET['requestType'] == 'GetAllOrders') {
        $orders = $db->GetAllOrders();
        if ($orders !== false) {
            echo json_encode(['status' => 'success', 'data' => $orders]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No cars found or error retrieving data.']);
        }
    }
}

// Function to generate a unique filename
function generateUniqueFilename($filename) {
    $fileExtension = pathinfo($filename, PATHINFO_EXTENSION);
    $uniqueName = uniqid('file_', true) . '.' . $fileExtension;
    return $uniqueName;
}
?>
