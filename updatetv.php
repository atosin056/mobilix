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

// Set the service ID (hardcoded for DSTV)
$service_id = 'AKA';
$api_url = 'https://enterprise.mobilenig.com/api/v2/services/packages';

// Set the Bearer Token (replace with your actual public key)
$public_key = 'pk_test_sESbyYhqBwHKGxIylykMqF0GaPQHDGfhTndQogvIrYw=';
$headers = [
    "Authorization: Bearer $public_key",
    "Content-Type: application/json"
];

// Prepare the request body
$data = json_encode([
    'service_id' => $service_id
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

// Check for successful response
if ($response_data['statusCode'] === "200" && isset($response_data['details']) && !empty($response_data['details'])) {
    // Loop through the packages and insert/update in the database
    foreach ($response_data['details'] as $package) {
        $name = $package['name'];
        $price = $package['price'];
        $product_code = $package['productCode'];
        $real_price = $price; // Assuming 'real_price' is the same as 'price'

        // Check if the record already exists
        $sql = "SELECT id FROM tv WHERE product_code = '$product_code' AND service_id = '$service_id'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Update the existing record
            $sql = "UPDATE tv SET name = '$name', price = '$price', real_price = '$real_price' WHERE product_code = '$product_code' AND service_id = '$service_id'";
            mysqli_query($conn, $sql);
        } else {
            // Insert a new record
            $sql = "INSERT INTO tv (name, price, product_code, service_id, real_price) VALUES ('$name', '$price', '$product_code', '$service_id', '$real_price')";
            mysqli_query($conn, $sql);
        }
    }

    echo "TV package details have been updated successfully.";
} else {
    echo "Error fetching data from API.";
}

// Close the database connection
mysqli_close($conn);

?>
