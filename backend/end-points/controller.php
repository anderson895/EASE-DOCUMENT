<?php
include('../class.php');

$db = new global_class();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['requestType'])) {
        if ($_POST['requestType'] == 'LoginResident') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $response = $db->LoginResident($email, $password);
            
            echo $response;
            
        } else if ($_POST['requestType'] == 'LoginAdmin') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $response = $db->LoginAdmin($email, $password);
            
            echo $response;
            
        }else{
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
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode([
        'status' => 'error',
        'message' => 'GET requests are not supported for login.'
    ]);
}
?>