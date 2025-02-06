<?php

function disburseFundsMonnify($amount, $reference, $accountNumber, $bankCode, $sourceAccountNumber, $narration = "Fund Transfer") {
    $monnifyApiKey = 'MK_TEST_TYKDWRWU64'; 
    $monnifySecretKey = 'Y01XFKC036187NTNNYSZ0V1VD72QGQT5'; 

    // Step 1: Authenticate
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

    // Step 2: Disburse funds
    $disbursementUrl = "https://sandbox.monnify.com/api/v2/disbursements/single";
    $data = [
        "amount" => $amount,
        "reference" => $reference,
        "narration" => $narration,
        "sourceAccountNumber" => $sourceAccountNumber,
        "destinationAccountNumber" => $accountNumber,
        "destinationBankCode" => $bankCode,
        "currency" => "NGN"
    ];
    $disburseCh = curl_init();
    curl_setopt($disburseCh, CURLOPT_URL, $disbursementUrl);
    curl_setopt($disburseCh, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($disburseCh, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $accessToken",
        "Content-Type: application/json",
    ]);
    curl_setopt($disburseCh, CURLOPT_POST, true);
    curl_setopt($disburseCh, CURLOPT_POSTFIELDS, json_encode($data));
    $disburseResponse = curl_exec($disburseCh);
    if (curl_errno($disburseCh)) {
        die('Disbursement Error: ' . curl_error($disburseCh));
    }
    curl_close($disburseCh);

    // Handle response
    $decodedDisburseResponse = json_decode($disburseResponse, true);
    if (!$decodedDisburseResponse) {
        die("Error: Unable to decode JSON response from Monnify.");
    }
    if (isset($decodedDisburseResponse['responseCode']) && $decodedDisburseResponse['responseCode'] === "0") {
        return "Disbursement successful: " . $decodedDisburseResponse['responseMessage'];
    } else {
        die("Error: " . ($decodedDisburseResponse['responseMessage'] ?? "Unknown error occurred."));
    }
}

// Example usage
echo disburseFundsMonnify(
    10000,                  // Amount to disburse (in Naira)
    time(),        // Unique transaction reference
    "0123456789",          // Destination account number
    "100033",                 // Destination bank code (e.g., GTB = 058)
    "1419191769", // Source account number
    "Payment for services" // Narration
);

?>
