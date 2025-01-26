<?php

// Example Usage
$phoneNumber = "08000000000";
$amount = 100;
$network = "MTN";

$response = sendVtuRequest($phoneNumber, $amount, $network);

if (isset($response['error'])) {
    echo "Error: " . $response['error'] . "\n";
    if (isset($response['response'])) {
        echo "Response: " . $response['response'] . "\n";
    }
} else {
    echo "Transaction Successful:\n";
    print_r($response);

    $serviceId = $response['details']['service_id'] ?? 'BAD'; // Default to MTN's service_id as a fallback
    $transId = $response['details']['trans_id'] ?? time(); // Use the generated transaction ID

    insertTransaction($serviceId, $network, "STANDARD", $amount, $transId);
}

?>