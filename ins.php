<?php

include 'connect.php'; // Your database connection file

// Array of networks and prices
$networks = ['Mtn', 'Airtel', 'Glo'];
$prices = [50, 100, 200, 500, 1000, 2000];

// Loop through each network
foreach ($networks as $network) {
    // Loop through each price
    foreach ($prices as $price) {
        // Prepare the SQL query
        $sql = "INSERT INTO airtimePrices (network, price) VALUES ('$network', $price)";

        // Execute the query
        if (mysqli_query($conn, $sql)) {
            echo "Record inserted successfully for $network - ₦$price<br>";
        } else {
            echo "Error inserting record for $network - ₦$price: " . mysqli_error($conn) . "<br>";
        }
    }
}

mysqli_close($conn); // Close the database connection

?>