<?php
include('../class.php');
$db = new global_class();

// Fetch the data
$data = $db->totalRequestbarangayID();

if ($data !== false) {
    // Return the data as JSON
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    // Handle errors
    http_response_code(500); // Internal Server Error
    echo json_encode(['error' => 'Failed to fetch data.']);
}

?>