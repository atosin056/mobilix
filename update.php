<?php
// Database connection
$pdo = new PDO('mysql:host=localhost;dbname=mobilix', 'username', 'Tosin2010*');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function fetchAndUpdatePrices($serviceId, $networkName, $pdo) {
    $apiUrl = 'https://enterprise.mobilenig.com/api/v2/services/packages';
    $publicKey = 'pk_test_sESbyYhqBwHKGxIylykMqF0GaPQHDGfhTndQogvIrYw='; // Replace with your actual public key

    // Request payload
    $data = array(
        "service_id" => $serviceId,
        "requestType" => "SME",
    );

    // Initialize cURL session
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . $publicKey
    ));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    // Execute cURL request and get response
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
        return;
    }
    curl_close($ch);

    if (empty($response)) {
        echo "Error: Empty response from API.";
        return;
    }

    $decodedResponse = json_decode($response, true);
    if (isset($decodedResponse['statusCode']) && $decodedResponse['statusCode'] === "200" && isset($decodedResponse['details'])) {
        $packages = $decodedResponse['details'];

        // Prepare the update statement
        $stmt = $pdo->prepare("UPDATE data_bundles SET real_price = :price WHERE product_code = :product_code AND network = :network");

        foreach ($packages as $package) {
            // Execute update query for each package
            $stmt->execute([
                ':price' => $package['price'],
                ':product_code' => $package['productCode'],
                ':network' => $networkName,
            ]);
        }

        echo "Prices for $networkName updated successfully.<br>";
    } else {
        echo "Error fetching data for $networkName: " . ($decodedResponse['message'] ?? 'Unknown error') . "<br>";
    }
}

// Updated service IDs and network names
$networks = [
    'Airtel' => 'BCD',
    'MTN' => 'BCA',
    'Glo' => 'BCC',
];

// Fetch and update prices for each network
foreach ($networks as $networkName => $serviceId) {
    fetchAndUpdatePrices($serviceId, $networkName, $pdo);
}
