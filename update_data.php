<?php
$server_name = 'localhost';
$username = 'root';
$password = '';
$db_name = 'mobilix';

// Establish connection
$conn = mysqli_connect($server_name, $username, $password, $db_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Mapping service IDs to network names
$network_map = [
    'BCD' => 'Airtel',
    'BCC' => 'Glo',
    'BCA' => 'MTN'
];

// Set the service ID for Airtel Gifting
$service_id = 'BCA';
$request_type = 'AWUF';
$api_url = 'https://enterprise.mobilenig.com/api/v2/services/packages';

// Set the Bearer Token
$public_key = 'pk_live_6ZCZ1O8E9xK+1CTf8rtAS5ex+rfKzxDi+3jenFyYTp8=';
$headers = [
    "Authorization: Bearer $public_key",
    "Content-Type: application/json"
];

// Prepare the request body
$data = json_encode([
    'service_id' => $service_id,
    'requestType' => $request_type
]);

// Initialize cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

// Execute the request and get the response
$response = curl_exec($ch);
curl_close($ch);

// Decode the JSON response
$response_data = json_decode($response, true);

// Track inserted/updated packages
$inserted_packages = [];
$updated_packages = [];

// Check for successful response
if ($response_data['statusCode'] === "200" && isset($response_data['details']) && !empty($response_data['details'])) {
    // Loop through the packages and insert/update in the database
    foreach ($response_data['details'] as $package) {
        $name = mysqli_real_escape_string($conn, $package['name']);
        $price = $package['price'];
        $product_code = $package['productCode'];
        $network = $network_map[$service_id] ?? 'Unknown';

        // Check if the record already exists
        $sql = "SELECT id FROM data_bundles WHERE product_code = '$product_code' AND service_id = '$service_id'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Update the existing record
            $sql = "UPDATE data_bundles SET name = '$name', price = '$price', real_price = '$price', network = '$network' WHERE product_code = '$product_code' AND service_id = '$service_id'";
            mysqli_query($conn, $sql);
            $updated_packages[] = $name;
        } else {
            // Insert a new record
            $sql = "INSERT INTO data_bundles (name, price, real_price, product_code, service_id, network) VALUES ('$name', '$price', '$price', '$product_code', '$service_id', '$network')";
            mysqli_query($conn, $sql);
            $inserted_packages[] = $name;
        }
    }

    // Display results
    echo "Data Bundle Update Report:\n";
    echo "------------------------\n";
    echo "Newly Inserted Packages:\n";
    foreach ($inserted_packages as $package) {
        echo "- $package\n";
    }
    echo "\nUpdated Packages:\n";
    foreach ($updated_packages as $package) {
        echo "- $package\n";
    }
    echo "\nTotal Inserted: " . count($inserted_packages) . "\n";
    echo "Total Updated: " . count($updated_packages) . "\n";
} else {
    echo "Error fetching data from API.";
}

// Close the database connection
mysqli_close($conn);
?>