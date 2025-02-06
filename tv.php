<?php

session_start();

include 'functions.php';

include 'connect.php';



if (isset($_POST["check"])) {

    $service = $_POST["service"];

    if ($service == 'GOTV') {
        
        $service = 'AKA';

    }

    if ($service == 'DSTV') {
        
        $service = 'AKC';

    }

    $cardNumber = trim($_POST["cardNumber"]);

    $url = "https://enterprise.mobilenig.com/api/v2/services/proxy";

    $headers = [
       
        "Content-Type: application/json",
       
        "Authorization: Bearer pk_live_6ZCZ1O8E9xK+1CTf8rtAS5ex+rfKzxDi+3jenFyYTp8=" // Replace {{public_key}} with your actual public key
    
    ];

    // Prepare the request body

    $data = [

        "service_id" => $service, 

        "customerAccountId" => $cardNumber

    ];

    // Use cURL to make the request

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    curl_setopt($ch, CURLOPT_POST, true);

    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    // Execute the cURL request and get the response

    $response = curl_exec($ch);

    curl_close($ch);

    // Decode the JSON response

    $responseData = json_decode($response, true);

    // Check if the response is successful and if the data is available

    if ($responseData['statusCode'] == "200" && isset($responseData['details'])) {

        // Store the customer's name in the session

        $customerName = $responseData['details']['firstName'] . ' ' . $responseData['details']['lastName'];
        
        $customerNumber = $responseData['details']['customerNumber']; // Assuming this is the correct field name

        $_SESSION["cardNumber"] = $cardNumber;

        $_SESSION["customerName"] = $customerName;

        $_SESSION["customerNumber"] = $customerNumber;



    } else {

        // Handle failure

        echo "Account name";

    }

}

if (isset($_POST["pay"])) {

    $packageProductCode = $_POST["package"];

    $sel = "SELECT * FROM `tv` WHERE `product_code`='".$packageProductCode."'";

    $sel_query = mysqli_query($conn, $sel);

    if (mysqli_num_rows($sel_query) > 0) {
        
       while ($rows = mysqli_fetch_assoc($sel_query)) {

           $priceIsell = $rows["price"];

           $real_price = $rows["real_price"]; 

           $service_Id = $rows["service_id"]; 

       }     

    }
     
    $check = checkSenderBalance($priceIsell, $_SESSION["nickname"]);

    if ($check) {

        $transId = time(); // You can generate a unique transaction ID, here I'm using the current timestamp

        $amount = $real_price; // You can get the amount dynamically from the form or other source

        $url = "https://enterprise.mobilenig.com/api/v2/services/";

        $headers = [
        
            "Content-Type: application/json",
        
            "Authorization: Bearer sk_test_9GSi0mR+W/bufqFKCKRMaPlG4GoUZ/2avq2pXYTg478=" // Replace {{secret_key}} with your actual secret key
        
        ];

        // Prepare the request body
        
        $data = [
        
            "service_id" => $service_Id,
        
            "trans_id" => $transId,
        
            "productCode" => $packageProductCode,
        
            "customerNumber" => $_SESSION["customerNumber"],
        
            "smartcardNumber" => $_SESSION["cardNumber"],
        
            "customerName" => $_SESSION["customerName"],
        
            "amount" => $amount
        
        ];

        // Use cURL to make the request

        $ch = curl_init($url);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        curl_setopt($ch, CURLOPT_POST, true);
        
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));



        // Execute the cURL request and get the response

        $response = curl_exec($ch);

        curl_close($ch);

        // Decode the JSON response

        $responseData = json_decode($response, true);

        // Check if the response is successful and handle accordingly

        if ($responseData['statusCode'] == "200") {

            $deduct = deduct($priceIsell, $_SESSION["nickname"]);

            $_SESSION["balance"] = $_SESSION["balance"] - $priceIsell;

            if ($deduct) {
                        
                header('location: dashboard.php?transaction=successfuldata');

            }

        }

    }

    else {

        header('location: dashboard.php?transaction=faileddata  ');

    }

}

?>

<html>

<head>

	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Mobilix | Your One stop Platform for Airtime and Data | TV</title>

	<link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="icon" type="image/png" href="images/favicon.png">

	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="css/main.css">
    <script type="text/javascript">

      window.onload = () => {
            showLoader();
            // Simulate loading process with a timeout (replace with actual logic)
            setTimeout(hideLoader, 2000); // Hide after 2 seconds
        };

    
        function showLoader() {
            const loader = document.getElementById('ajax-loader');
            if (loader) {
                loader.style.opacity = '1'; // Ensure the loader is fully visible
                loader.style.visibility = 'visible';
            }
        }

        function hideLoader() {
            const loader = document.getElementById('ajax-loader');
            if (loader) {
                loader.style.opacity = '0'; // Trigger the fade-out animation
                loader.style.transition = 'opacity 0.5s ease';
                setTimeout(() => {
                    loader.style.visibility = 'hidden'; // Hide the loader after the animation
                }, 500); // Match the transition duration
            }
        }

    </script>

	<link rel="icon" type="image/png" href="images/logo.png">

</head>

<body style="background: #111;">

<!-- Loader -->

<div id="ajax-loader">
	
	<div style="width: 150px;">
		
		<img src="images/loader.svg" style="width: 100% !important">

	</div>

</div>

<!-- Main Content -->

<div id="main-content" style="background: #111 !important;display: inline-block !important;padding: 40px 31px !important;color: white;">
	
    <div>
        
        <div style="width: 100% !important;display: flex;flex-direction: column;gap: 35px !important;">
            
            <div style="display: flex;align-items: center;gap: 8px !important;width: 100% !important;color: white;">
                
            	<div onclick="window.history.back();">
            		
            		<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
  <path fill-rule="evenodd" clip-rule="evenodd" d="M20 10C20 10.3788 19.8683 10.7421 19.6339 11.01C19.3995 11.2778 19.0816 11.4283 18.7501 11.4283H4.26926L9.63616 17.5586C9.75237 17.6914 9.84455 17.8491 9.90744 18.0226C9.97033 18.1961 10.0027 18.3821 10.0027 18.5699C10.0027 18.7577 9.97033 18.9437 9.90744 19.1172C9.84455 19.2907 9.75237 19.4483 9.63616 19.5811C9.51995 19.7139 9.38199 19.8193 9.23016 19.8911C9.07833 19.963 8.9156 20 8.75126 20C8.58692 20 8.42418 19.963 8.27235 19.8911C8.12052 19.8193 7.98256 19.7139 7.86636 19.5811L0.367193 11.0112C0.250798 10.8786 0.158451 10.721 0.095442 10.5474C0.0324329 10.3739 0 10.1879 0 10C0 9.81213 0.0324329 9.6261 0.095442 9.45257C0.158451 9.27905 0.250798 9.12143 0.367193 8.98875L7.86636 0.418872C8.10105 0.150673 8.41935 0 8.75126 0C9.08316 0 9.40147 0.150673 9.63616 0.418872C9.87085 0.687071 10.0027 1.05083 10.0027 1.43012C10.0027 1.80941 9.87085 2.17317 9.63616 2.44136L4.26926 8.57169H18.7501C19.0816 8.57169 19.3995 8.72217 19.6339 8.99003C19.8683 9.25789 20 9.62119 20 10Z" fill="white"/>
</svg>

            	</div>

            	<div>
            		
            		<font class="airt">TV</font>

            	</div>

            </div>

            <div style="width: 100% !important;display: flex;flex-direction: column;gap: 50px !important;">
            	
            	<form method="POST" style="width: 100% !important;display: flex;flex-direction: column;gap: 10px !important;">
            		
                    <div>
                        
                        <div style="width: 100% !important;height: auto;padding: 20px !important;background: #1e1e1e;border-radius: 10px;">
                            
                            <div style="width: 100% !important;display: flex;flex-direction: column;gap: 20px;">
                                
                                <div style="width: 100% !important">

                                    <div style="width: 100% !important">
                                    
                                        <select type="number" required name="service" id="service" style="background: transparent;border: none;border-bottom: 0.1px solid #6F7075;width: 100% !important;height: 50px;font-family: montserrat;color: white;" class="oh" id="phoneNumber" placeholder="DSTV Or GOTV">
                                            
                                            <option value="DSTV" style="background: #1e1e1e !important;">DSTV</option>

                                            <option value="GOTV" style="background: #1e1e1e !important;">GOTV</option>

                                        </select>

                                    </div>

                                    <div style="margin-top: 5px !important;display: flex;background: transparent !important;width: 100% !important;border-bottom: 1px solid #6F7075;outline: none !important;">

                                        <div style="width: 100% !important;">
                                        
                                            <input type="number" required name="cardNumber" id="cardNumber" placeholder="Enter Card No" minlength="10" maxlength="10" style="background: transparent; outline: none !important; border: none !important; width: 100% !important; height: 50px; font-family: montserrat; color: white;" class="oh" value="<?php echo isset($_POST["cardNumber"]) ? trim($_POST["cardNumber"]) : ''; ?>">

                                        </div>

                                        <div style="width: 35% !important;">
                                                
                                            <input type="submit" name="check" value="Check" style="width: 100% !important;height: 100% !important;border-radius: 200px;border: none;color: white !important;font-family: Montserrat !important;background: #532AC7;">

                                        </div>

                                    </div>

                                </div>

                                <div class="names" id="userName">
                                    
                                    <?php

                                    if (isset($customerName)) {
                                        
                                        echo $customerName;

                                    }

                                    else{

                                        echo 'Account Name';

                                    }

                                    ?>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div>
                        
                        <div style="width: 100% !important;height: auto;padding: 20px !important;background: #1e1e1e;border-radius: 10px;">
                            
                            <div>
                                
                                <font style="font-family: montserrat;font-size: 14px;">Plan to be bought</font>

                            </div>

                            <div>
                                
                                <div>
                                    
                                   <select name="package" id="package" style="background: transparent;border: none;border-bottom: 0.1px solid #6F7075;width: 100% !important;height: 50px;font-family: montserrat;color: white;" class="oh" id="phoneNumber" placeholder="DSTV Or GOTV">
                                            

                                        <?php

                                        $select = "SELECT * FROM `tv` WHERE `provider`='".$_POST["service"]."'";

                                        $select_query = mysqli_query($conn, $select);

                                        if (mysqli_num_rows($select_query) > 0) {
                                            
                                            while ($row = mysqli_fetch_assoc($select_query)){

                                                $name = $row["name"];

                                                $product_code = $row["product_code"];

                                                $price = $row["price"];

                                            
                                        ?>

                                        <option value="<?php echo $product_code; ?>" style="background: #1e1e1e !important;"><?php echo $name.' - '.$price; ?></option>

                                        <?php

                                        }}

                                        ?>

                                    </select>

                                </div>
                               
                                <div>
                                    
                                    <input type="submit" name="pay" value="Pay" class="payup">

                                </div>

                            </div>

                        </div>

                    </div>

                </form>

                <?php

                include 'contactdev.php';    

                ?>

            </div>

        </div>

    </div>

</div>

</body>

<script type="text/javascript">


</script>

</html>