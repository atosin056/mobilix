<?php

  require_once __DIR__ . '/vendor/autoload.php';
// use libphonenumber\PhoneNumberUtil;

//     use libphonenumber\NumberParseException;


    use libphonenumber\PhoneNumberUtil;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberToCarrierMapper;


$monnifyApiKey = 'MK_PROD_81UYBNHUA7'; // Replace with your actual API Key
$monnifySecretKey = 'TC81C1SHGCTQKC1FCPUXE7K6WT9E5CXW'; // Replace with your actual Secret Key
$monnifyContractCode = '726510003240'; // Replace with your contract code

function initiateMonnifyCheckout($amount, $nickname, $mymoney) {
    global $monnifyApiKey, $monnifySecretKey, $monnifyContractCode;

    // Ensure the keys and contract code are set
    if (empty($monnifyApiKey) || empty($monnifySecretKey) || empty($monnifyContractCode)) {
        die('Error: Monnify API Key, Secret Key, or Contract Code is not set.');
    }

    // Authentication URL
    $authUrl = "https://api.monnify.com/api/v1/auth/login"; // Use production URL in live environment
    $authCredentials = base64_encode("$monnifyApiKey:$monnifySecretKey");

    // Initialize cURL for authentication
    $authCh = curl_init();
    curl_setopt($authCh, CURLOPT_URL, $authUrl);
    curl_setopt($authCh, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($authCh, CURLOPT_HTTPHEADER, [
        "Authorization: Basic $authCredentials",
        "Content-Type: application/json",
    ]);
    // Explicitly set the request method to POST
    curl_setopt($authCh, CURLOPT_POST, true);

    // Execute cURL and capture response
    $authResponse = curl_exec($authCh);

    // Handle cURL errors
    if (curl_errno($authCh)) {
        die('Curl error during authentication: ' . curl_error($authCh));
    }
    curl_close($authCh);

    // Log raw response (for debugging purposes)
    error_log("Auth Response: " . $authResponse);

    // Decode the authentication response
    $decodedAuthResponse = json_decode($authResponse, true);

    // Check if the access token exists
    if (!isset($decodedAuthResponse['responseBody']['accessToken'])) {
        die('Error: ' . ($decodedAuthResponse['responseMessage'] ?? 'Unknown error'));
    }

    // Get the access token
    $accessToken = $decodedAuthResponse['responseBody']['accessToken'];
    echo "Access Token: " . $accessToken;

    // Continue to initiate payment (if needed)
    // Example: Create transaction payload and interact with the transaction endpoint
    $transactionUrl = "https://api.monnify.com/api/v1/merchant/transactions/init-transaction";

    $paymentReference = uniqid(); // Generate a unique reference

    $transactionData = [
        'amount' => $mymoney, // Amount in Naira
        'customerName' => $nickname,
        'paymentReference' => $paymentReference, // Use the pre-defined variable
        'paymentDescription' => 'Transaction for ' . $nickname,
        'customerEmail' => $_SESSION["customeremail"],
        'currencyCode' => 'NGN',
        'contractCode' => $monnifyContractCode,
        'redirectUrl' => 'https://mobilix.com.ng/callback.php?amount=' . $amount . '&nickname=' . urlencode($nickname) . '&paymentReference=' . $paymentReference,
    ];



    // Initialize cURL for transaction initialization
    $transactionCh = curl_init();
    curl_setopt($transactionCh, CURLOPT_URL, $transactionUrl);
    curl_setopt($transactionCh, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($transactionCh, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $accessToken",
        "Content-Type: application/json",
    ]);
    curl_setopt($transactionCh, CURLOPT_POST, true);
    curl_setopt($transactionCh, CURLOPT_POSTFIELDS, json_encode($transactionData));

    // Execute cURL request and handle response
    $transactionResponse = curl_exec($transactionCh);

    // Handle cURL errors
    if (curl_errno($transactionCh)) {
        die('Curl error during transaction: ' . curl_error($transactionCh));
    }
    curl_close($transactionCh);

    // Log raw transaction response (for debugging)
    error_log("Transaction Response: " . $transactionResponse);

    // Decode the transaction response
    $decodedTransactionResponse = json_decode($transactionResponse, true);

    // Check for successful response
    if (isset($decodedTransactionResponse['responseCode']) && $decodedTransactionResponse['responseCode'] === '0') {
        // Get the payment URL and redirect
        $paymentUrl = $decodedTransactionResponse['responseBody']['checkoutUrl'];
        header("Location: $paymentUrl");
        exit();
    } else {
        echo "Error: " . ($decodedTransactionResponse['responseMessage'] ?? 'Unknown error');
    }
}

function checkPin($pin) {
    include 'connect.php';
    $select = "SELECT * FROM `users` WHERE `pin`='".$pin."'";
    $select_query = mysqli_query($conn, $select);
    if (mysqli_num_rows($select_query) > 0) {
        return true;
    }
}

function sendVtuRequest($phoneNumber, $amount, $network) {
    $serviceIds = [
        'Airtel' => 'BAA',
        'Glo' => 'BAB',
        'Mtn' => 'BAD'
    ];

    // Ensure proper case for the network
    $network = ucfirst(strtolower(trim($network)));  // First letter uppercase

    // Debug: Check the network value
    var_dump($network);

    $serviceId = $serviceIds[$network] ?? null;

    if (!$serviceId) {
        return ["error" => "Invalid network type provided: " . $network];
    }

    $url = 'https://enterprise.mobilenig.com/api/v2/services/';
    $secretKey = 'sk_live_KPKjVO1C4FrOI/Plh4zNspagPQ+NonNILjINI+U7Xec='; // Replace with your actual secret key.

    $postData = [
        "service_id" => $serviceId,
        "trans_id" => time(), // Use a timestamp or another method to generate a unique transaction ID.
        "service_type" => "PREMIUM",
        "phoneNumber" => $phoneNumber,
        "amount" => $amount
    ];

    $headers = [
        "Content-Type: application/json",
        "Authorization: Bearer $secretKey"
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    if ($httpCode === 200) {
        return json_decode($response, true);
    } else {
        return ["error" => "Request failed with status code $httpCode", "response" => $response];
    }
}

function fil($string) {
   // Extract text after hyphen
   preg_match('/\s*-\s*(.+)/', $string, $matches);
   
   if (!isset($matches[1])) return null;
   
   $duration = $matches[1];
   
   // Normalize duration text
   $duration = strtolower(trim($duration));
   
   // Direct mappings
   $mappings = [
       '1 day' => '1 day',
       '3 days' => '3 days',
       '2 days' => '2 days',
       '7 days' => '7 days',
       'monthly' => '30 days',
       '14 days' => '14 days',
       '4 days' => '4 days',
       '30 days' => '30 days',
       '30days validity' => '30 days',
       '90 days' => '90 days',
       '3 months' => '90 days',
       '4 months' => '120 days',
       '2 months' => '60 days',
       '1 year' => '365 days',
       'monthly' => '30 days'
   ];
   
   // Perform case-insensitive matching
   $duration_lower = strtolower($duration);
   
   // Check for direct matches (using stripos for case-insensitive matching)
   foreach ($mappings as $key => $value) {
       if (stripos($duration_lower, strtolower($key)) !== false) {
           return $value;
       }
   }
   
   // Handle weeks conversion
   if (preg_match('/(\d+)\s*(?:weeks?)/i', $duration, $week_matches)) {
       $weeks = intval($week_matches[1]);
       return ($weeks * 7) . ' days';
   }
   
   // Explicit handling for months
   if (preg_match('/(\d+)\s*(?:months?)/i', $duration, $month_matches)) {
       $months = intval($month_matches[1]);
       return ($months * 30) . ' days';
   }
   
   return '30 days'; // Default fallback
}
// $phoneNumber = "09115197167";
// $amount = 100;
// $network = "Airtel";

// $response = sendVtuRequest($phoneNumber, $amount, $network);

// if (isset($response['error'])) {
//     echo "Error: " . $response['error'] . "\n";
//     if (isset($response['response'])) {
//         echo "Response: " . $response['response'] . "\n";
//     }
// } else {
//     echo "Transaction Successful:\n";
//     print_r($response);
// }

function checkForNewNotifications() {
    // This could be a database query or any other source
    // For demonstration, we'll return a simple array
    return [
        'hasNotification' => true,
        'title' => 'Mobilix',
        'message' => 'Your Transaction was successful',
        'timestamp' => time()
    ];
}

function insertTransaction($serviceId, $network, $serviceType, $price, $transId, $phone) {
    include 'connect.php';
    global $conn; // Assuming you're using MySQLi connection from 'connect.php'

    $stmt = $conn->prepare("INSERT INTO airtime (service_id, Network, service_type, price, trans_id, phone) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die('MySQL error: ' . $conn->error);
    }

    $stmt->bind_param("ssssss", $serviceId, $network, $serviceType, $price, $transId, $phone);

    if ($stmt->execute()) {
        return true;
    } else {
        // Capture the MySQL error here
        echo "Error executing statement: " . $stmt->error; // Debugging
        return false;
    }
}

function checkSenderBalance($amt, $username) {
    include 'connect.php';
    $select = "SELECT * FROM `users` WHERE `nickname`='".$username."'";
    $select_query = mysqli_query($conn, $select);
    if (mysqli_num_rows($select_query) > 0) {
        while ($row = mysqli_fetch_assoc($select_query)) {
            $balance = $row["balance"];
        }
        if ($balance >= $amt) {
            return true;
        }
        else{
            return false;
        }
    }
}

function sendmail($to, $subject, $message) {

    include 'connect.php';

    // Initialize Sendinblue API
    
    $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');

    $apiInstance = new TransactionalEmailsApi(

        new Client(),

        $config

    );

    $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail([

        'subject' => $subject,

        'sender' => ['name' => 'Mobilix', 'email' => 'atosin056@gmail.com'],

        'to' => [['email' => $to, 'name' => 'User']],

        'htmlContent' => $message

    ]);



    try {

        $response = $apiInstance->sendTransacEmail($sendSmtpEmail);
        
        if ($insert_query) {
            
            return true;

        }   

    } 

    catch (Exception $e) {

        echo 'Exception when calling TransactionalEmailsApi->sendTransacEmail: ', $e->getMessage(), PHP_EOL;

    }

}

function disburseFundsMonnify($amount, $reference, $accountNumber, $bankCode, $sourceAccountNumber, $narration = "Fund Transfer") {

    $monnifyApiKey = 'MK_PROD_81UYBNHUA7'; 
    
    $monnifySecretKey = 'TC81C1SHGCTQKC1FCPUXE7K6WT9E5CXW'; 

    // Step 1: Authenticate
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
    $disbursementUrl = "https://api.monnify.com/api/v2/disbursements/single";
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
       return true;
    } else {
       return false;
    }
}

function registerUser($fname, $lname, $email, $phone, $nickname, $pin) {
    include 'connect.php';
    $check = "SELECT * FROM `users` WHERE `pin`='".$pin."'";

    $check_query = mysqli_query($conn, $check);

    if (mysqli_num_rows($check_query) > 0) {}
        else{
$insert ="INSERT INTO `users` (`firstname`, `lastname`, `email`, `phone`, `nickname`, `pin`, `balance`) 
              VALUES ('$fname', '$lname', '$email', '$phone', '$nickname', '$pin', 1.00)";
    $insert_query = mysqli_query($conn, $insert);
    if ($insert_query) {
        return true;
    }
    else{
        return false;
    }
}
}

function checkBalance($publicKey) {
    $url = 'https://enterprise.mobilenig.com/api/v2/control/balance';
    
    // Initialize cURL session
    $ch = curl_init($url);

    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return response as a string
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $publicKey
    ]);

    // Execute cURL request
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        echo 'cURL Error: ' . curl_error($ch);
        curl_close($ch);
        return null;
    }

    // Close cURL session
    curl_close($ch);

    // Decode the JSON response
    $responseData = json_decode($response, true);

    // Check if the API returned success
    if ($responseData['statusCode'] === "200") {
        $balance = $responseData['details']['balance'];
        
        // Alert if balance is lower or equal to ₦1000
        if ($balance <= 1000) {
            echo "<script>alert('Warning: Please do not make any Transaction on our platform, we wouldnt be responsible for what happens to your money if you do! Contact customer support Immediately. Thank you');</script>";
        }

        return $balance;
    } else {
        echo 'Error: ' . $responseData['message'];
        return null;
    }
}

function transferMoneyToMobilix($amt, $phone, $sender) {
    include 'connect.php';
    $update = "UPDATE `users` SET `balance`=`balance`+$amt WHERE `phone`='".$phone."'";
    $update_query = mysqli_query($conn, $update);
    if ($update_query) {
        $deduct = "UPDATE `users` SET `balance`=`balance`-$amt WHERE `nickname`='".$sender."'";
        $deduct_query = mysqli_query($conn, $deduct);
        if ($deduct_query) {
            return true;
        }
        else{
            return false;
        }
    }
}

function recharge($service_id,$beneficiary, $trans_id, $code, $amount) {
    $apiUrl = 'https://enterprise.mobilenig.com/api/v2/services/';
    $secretKey = 'sk_live_KPKjVO1C4FrOI/Plh4zNspagPQ+NonNILjINI+U7Xec='; // secret key

    // Request payload
    $data = [
        "service_id" => $service_id, // Hard-coded as per the API requirements
        "service_type" => "SME",
        "beneficiary" => $beneficiary,
        "trans_id" => $trans_id,
        "code" => $code,
        "amount" => $amount,
    ];

    // Initialize cURL session
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $secretKey,
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    // Execute cURL request and get response
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
        return null;
    }
    curl_close($ch);

    // Decode the response
    $decodedResponse = json_decode($response, true);

    // Handle the API response
    if (isset($decodedResponse['message']) == '200') {
        return true;
    } else {
        echo "Error: " . ($decodedResponse['message'] ?? 'Unknown error') . "\n";
        return false;
    }
}

// $service_id = "BCA"; // Example service ID
// $beneficiary = "07031272572";
// $trans_id = uniqid(); // Generate a unique transaction ID
// $code = "MS5000"; // Product code
// $amount = 1365;

// $result = recharge($service_id, $beneficiary, $trans_id, $code, $amount);

// if ($result) {
//     echo "Recharge successful!";
// } else {
//     echo "Recharge failed!";
// }


function deduct($amt, $nickname) {

    include 'connect.php';

    $update = "UPDATE `users` SET `balance`=`balance`-'".$amt."' WHERE `nickname`='".$nickname."'";

    $update_query = mysqli_query($conn, $update);

    if ($update_query) {
        
        return true;

    }

}


function formatDataSize($name) {
    // Check if the name ends with digits and a 'MB' or 'GB' part
    if (preg_match('/\d{2,}/', $name, $matches)) {
        $number = $matches[0];
        $unit = strtolower(substr($name, strlen($number))); // Get 'mb' or 'gb'
        return $number . "<font style='font-size: 10px; text-transform: uppercase;'>$unit</font>";
    }

    return $name; // Return the original name if no pattern matches
}

// Usage
// $name = "500mb";  // Example input
// $formattedName = formatDataSize($name);
// echo $formattedName;


function shortens($string){
    // Regular expression to match data size patterns (e.g., 500MB, 1GB)
    $pattern = '/\d+\s*(MB|GB)/i';

    // Perform regex search
    if (preg_match($pattern, $string, $matches)) {
        return strtoupper($matches[0]); // Return the matched size in uppercase (e.g., 500MB, 1GB)
    }

    return null; // Return null if no match is found
}




function getCarrier($phoneNumber, $countryCode = 'NG') {


    $phoneUtil = PhoneNumberUtil::getInstance();

    $carrierMapper = PhoneNumberToCarrierMapper::getInstance();



    try {

        $numberProto = $phoneUtil->parse($phoneNumber, $countryCode);

        return $carrierMapper->getNameForNumber($numberProto, 'en'); // Language is English ('en')

    } catch (NumberParseException $e) {

        return null; // Invalid number

    }

}


// // Usage

// $phoneNumber = "09115197167"; // Replace with the actual phone number

// $carrier = getCarrier($phoneNumber);


// if ($carrier) {

//     echo "Carrier for $phoneNumber is $carrier";

// } else {

//     echo "Could not determine the carrier for $phoneNumber";

// }


// function getGloPrices() {
//     $apiUrl = 'https://enterprise.mobilenig.com/api/v2/services/packages';
//     $publicKey = 'pk_test_sESbyYhqBwHKGxIylykMqF0GaPQHDGfhTndQogvIrYw='; // Replace with your actual public key

//     // Request payload
//     $data = array(
//         "service_id" => "BCC",
//         "requestType" => "SME", // 'SME' request type for Glo prices
//     );

//     // Initialize cURL session
//     $ch = curl_init();

//     // Set cURL options
//     curl_setopt($ch, CURLOPT_URL, $apiUrl);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//         'Content-Type: application/json',
//         'Authorization: Bearer ' . $publicKey
//     ));
//     curl_setopt($ch, CURLOPT_POST, true);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

//     // Execute cURL request and get response
//     $response = curl_exec($ch);

//     // Check for errors in cURL request
//     if(curl_errno($ch)) {
//         echo 'Curl error: ' . curl_error($ch);
//         return null; // Handle error appropriately
//     }

//     // Close the cURL session
//     curl_close($ch);

//     // Check if response is not empty
//     if (empty($response)) {
//         echo "Error: Empty response from API.";
//         return null;
//     }

//     // Decode the JSON response
//     $decodedResponse = json_decode($response, true);

//     // Debug: output the raw response for inspection
//     // echo "<pre>";
//     // print_r($decodedResponse);
//     // echo "</pre>";

//     // Check if the response is valid
//     if (isset($decodedResponse['statusCode']) && $decodedResponse['statusCode'] === "200" && isset($decodedResponse['details'])) {
//         return $decodedResponse['details']; // Return the details of all available packages
//     } else {
//         echo "Error: " . ($decodedResponse['message'] ?? 'Unknown error');
//         return null;
//     }
// }

// // Usage example:
// $gloPrices = getGloPrices();

// if ($gloPrices) {
//     foreach ($gloPrices as $package) {
//         echo "Package: " . $package['name'] . " | Price: " . $package['price'] . " | Product Code: " . $package['productCode'] . "<br>";
//     }
// } else {
//     echo "Failed to fetch Glo prices.";
// }

function verifyCredentials($pin) {

    session_start();

    include 'connect.php';

    $check = "SELECT * FROM `users` WHERE `pin`='".$pin."'";

    $check_query = mysqli_query($conn, $check);

    if (mysqli_num_rows($check_query) > 0) {
        
        while ($row = mysqli_fetch_assoc($check_query)) {
            
            $nickname = $row["nickname"];

            $phone = $row["phone"];

            $balance = $row["balance"];

            $email = $row["email"];


            $_SESSION["customeremail"] = $email;    

            $_SESSION["balance"] = $balance;

            $_SESSION["nickname"] = $nickname;

            $_SESSION["phone"] = $phone;

            $_SESSION["pin"] = $pin;

        }

        return true;

    }

}

?>
