<?php
// setnetwork.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $network = $_POST['network'] ?? 'Unknown'; // Default to 'Unknown' if no network is provided

    // Process the network (e.g., save it to the session, database, etc.)
    session_start();
    $_SESSION['network'] = $network;

    echo "Network set to: $network";
} else {
    echo "Invalid request method";
}
?>
