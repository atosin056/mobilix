<?php
session_start();
include 'connect.php';

if (!isset($_GET["paymentReference"])) {
    header('location: dashboard.php');
    exit();
}

$paymentReference = $_GET["paymentReference"];
$monnifyApiKey = "MK_PROD_81UYBNHUA7";
$monnifySecretKey = "TC81C1SHGCTQKC1FCPUXE7K6WT9E5CXW";

// Get the authentication token
$authUrl = "https://api.monnify.com/api/v1/auth/login";
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
curl_close($authCh);
$decodedAuthResponse = json_decode($authResponse, true);

if (!isset($decodedAuthResponse['responseBody']['accessToken'])) {
    die('Error getting access token');
}

$accessToken = $decodedAuthResponse['responseBody']['accessToken'];

// Verify the transaction status
$verifyUrl = "https://api.monnify.com/api/v1/merchant/transactions/query?paymentReference=$paymentReference";

$verifyCh = curl_init();
curl_setopt($verifyCh, CURLOPT_URL, $verifyUrl);
curl_setopt($verifyCh, CURLOPT_RETURNTRANSFER, true);
curl_setopt($verifyCh, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $accessToken",
    "Content-Type: application/json",
]);

$verifyResponse = curl_exec($verifyCh);
curl_close($verifyCh);

$decodedVerifyResponse = json_decode($verifyResponse, true);

// Check if the transaction was successful
if (isset($decodedVerifyResponse['responseBody']['paymentStatus']) && $decodedVerifyResponse['responseBody']['paymentStatus'] === "PAID") {
    $amountPaid = $decodedVerifyResponse['responseBody']['amountPaid'];
    $nickname = $_GET["nickname"];

    // Fund the user's balance
    $update = "UPDATE `users` SET `balance`=`balance`+'$amountPaid' WHERE `nickname`='$nickname'";
    $updateQuery = mysqli_query($conn, $update);

    if ($updateQuery) {
        // Update session balance
        $_SESSION["balance"] += $amountPaid;

        header('location: dashboard.php?funding=successful');
        exit();
    }
} else {
    header('location: dashboard.php?funding=failed');
    exit();
}
?>
