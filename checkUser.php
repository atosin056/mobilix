<?php

include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the raw POST data
    $data = json_decode(file_get_contents('php://input'), true);
    
    // Get the phone number from the received data
    $phoneNumber = $data['phoneNumber'];
    
    // Sanitize phone number to prevent SQL injection
    $phoneNumber = mysqli_real_escape_string($conn, $phoneNumber);
    
    // Query to check if the user exists by phone number
    $sql = "SELECT firstname, lastname FROM users WHERE phone = '$phoneNumber' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    // Check if the user was found
    if (mysqli_num_rows($result) > 0) {
        // Fetch the user's details
        $user = mysqli_fetch_assoc($result);

        // Return the user's full name
        echo json_encode([
            'success' => true,
            'firstName' => $user['firstname'],
            'lastName' => $user['lastname'],
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'User not found',
        ]);
    }

    // Close the connection
    mysqli_close($conn);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method',
    ]);
}

?>