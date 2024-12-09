<?php

include('../class.php');
$db = new global_class();

$result = $db->totalRequestbarangayID();

$result = $conn->query($sql);

// Prepare the response
$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[$row['cr_formtype']] = $row['total'];
    }
}

echo json_encode($data);
?>