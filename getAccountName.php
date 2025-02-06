<?php
// Include your database connection
include 'db_connection.php'; // Adjust the path to your connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accountNumber = $_POST['account_number'];
    $bankCode = $_POST['bank_code'];

    $monnifyApiKey = 'MK_TEST_TYKDWRWU64'; 
    $monnifySecretKey = 'Y01XFKC036187NTNNYSZ0V1VD72QGQT5'; 

    // Step 1: Authenticate with Monnify
    $authUrl = "https://sandbox.monnify.com/api/v1/auth/login";
    $authCredentials = base64_encode("$monnifyApiKey:$monnifySecretKey");
    $authCh = curl_init();
    curl_setopt($authCh, CURLOPT_URL, $authUrl);
    curl_setopt($authCh, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($authCh, CURLOPT_HTTPHEADER, [
        "Authorization: Basic $authCredentials",
        "Content-Type: application/json",
    ]);
    curl_setopt($authCh, CURLOPT_POST, true);
    $authResponse = curl_exec($authCh);
    if (curl_errno($authCh)) {
        die('Authentication Error: ' . curl_error($authCh));
    }
    curl_close($authCh);
    $decodedAuthResponse = json_decode($authResponse, true);
    if (!isset($decodedAuthResponse['responseBody']['accessToken'])) {
        die('Error: ' . ($decodedAuthResponse['responseMessage'] ?? 'Unknown authentication error.'));
    }
    $accessToken = $decodedAuthResponse['responseBody']['accessToken'];

    // Step 2: Fetch account name using Monnify API
    $accountInfoUrl = "https://sandbox.monnify.com/api/v1/settlement/accounts/lookup";
    $accountInfoData = [
        "accountNumber" => $accountNumber,
        "bankCode" => $bankCode
    ];
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $accountInfoUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $accessToken",
        "Content-Type: application/json",
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($accountInfoData));
    $accountInfoResponse = curl_exec($ch);
    
    if (curl_errno($ch)) {
        die('Error fetching account info: ' . curl_error($ch));
    }
    curl_close($ch);

    $decodedAccountInfoResponse = json_decode($accountInfoResponse, true);

    // Check if account name is available in the response
    if (isset($decodedAccountInfoResponse['responseBody']['accountName'])) {
        echo $decodedAccountInfoResponse['responseBody']['accountName']; // Return account name
    } else {
        echo "Account name not found";
    }
}
?>
