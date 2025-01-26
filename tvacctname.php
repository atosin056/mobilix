<?php
// Check if the POST request contains the required parameters
if (isset($_POST['cardNumber']) && isset($_POST['service'])) {
    $cardNumber = $_POST['cardNumber'];
    $service = $_POST['service'];

    // Set the service_id based on the selected service
    $service_id = '';
    if ($service == 'GOTV') {
        $service_id = 'AKA'; // GOTV
    } elseif ($service == 'DSTV') {
        $service_id = 'AKC';  // Replace with actual service_id for DSTV
    }

    // Set the API URL and your authorization token
    $url = 'https://enterprise.mobilenig.com/api/v2/services/proxy';
    $token = 'pk_live_6ZCZ1O8E9xK+1CTf8rtAS5ex+rfKzxDi+3jenFyYTp8=';  // Replace with your actual Bearer token

    // Prepare the data to send in the request
    $data = [
        'service_id' => $service_id,
        'customerAccountId' => $cardNumber
    ];

    // Initialize cURL session
    $ch = curl_init($url);

    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $token
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    // Execute the cURL request and get the response
    $response = curl_exec($ch);

    // Check for errors
    if ($response === false) {
        echo json_encode([
            'success' => false,
            'message' => 'Error occurred while making API request'
        ]);
    } else {
        // Decode the API response
        $responseData = json_decode($response, true);

        // Check if the response was successful
        if ($responseData['statusCode'] == '200' && isset($responseData['details'])) {
            // Extract first name, last name, and other details
            $firstName = $responseData['details']['firstName'];
            $lastName = $responseData['details']['lastName'];

            // Return success with the account details
            echo json_encode([
                'success' => true,
                'first_name' => $firstName,
                'last_name' => $lastName
            ]);
        } else {
            // Handle case where customer data is not found or request failed
            echo json_encode([
                'success' => false,
                'message' => 'Customer not found or API request failed'
            ]);
        }
    }

    // Close the cURL session
    curl_close($ch);
} else {
    // Invalid request
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request'
    ]);
}
?>
