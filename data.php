<?php

session_start();

include 'connect.php';

include 'functions.php';

require_once __DIR__ . '/vendor/autoload.php';


if (!isset($_GET["network"])) {
    
    $network = '';

}



if (isset($_GET["network"])) {
    
    $network = $_GET["network"];

}

if (isset($_POST["submit"])) {

    echo '<script>window.onload = () => {
            showLoader();
            // Simulate loading process with a timeout (replace with actual logic)
            setTimeout(hideLoader, 2000); // Hide after 2 seconds
        };</script>';

    $phone = $_POST["phone"];
    
    $product_code = $_POST["submit"];


    $select1 = "SELECT * FROM `data_bundles` WHERE `product_code`='".$product_code."'";

    $select1_query = mysqli_query($conn, $select1);

    if (mysqli_num_rows($select1_query) > 0) {
        
        while ($validate = mysqli_fetch_assoc($select1_query)) {

            $serviceId = $validate["service_id"];

            $myPrice = $validate["price"];

            $real_price = $validate["real_price"];


        }

        $deduct = "SELECT * FROM `users` WHERE `nickname`='".$_SESSION["nickname"]."'";

        $deduct_query = mysqli_query($conn, $deduct);

        if (mysqli_num_rows($deduct_query) > 0) {
            
            while ($yeah = mysqli_fetch_assoc($deduct_query)){

                $balance = $yeah["balance"];

            }

            if ($balance >= $myPrice) {
                
                $dedu = deduct($myPrice, $_SESSION["nickname"]);

                if ($dedu) {

                    $find = "SELECT * FROM `users` WHERE `nickname`='".$_SESSION["nickname"]."'";

                    $find_query = mysqli_query($conn, $find);

                    if (mysqli_num_rows($find_query) > 0) {
        
                        while ($rows = mysqli_fetch_assoc($find_query)) {

                            $balances = $rows["balance"];

                        }

                        $_SESSION["balance"] = $balances;

                    }
                                    
                    $trans_id = time();

                    $buy = recharge($serviceId, $phone, $trans_id, $product_code, $real_price);

                    if ($buy) {
                        
                        header('location: dashboard.php?transaction=successfuldata');

                    }

                }

            }

            else{

                header('location: dashboard.php?transaction=faileddata');

            }

        }

       

    }

}

?>

<html>

<head>

	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="images/favicon.png">

	<title>Mobilix | Your One stop Platform for Airtime and Data | Dashboard</title>

	<link rel="preconnect" href="https://fonts.googleapis.com">

	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="css/main.css">

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
        
        <div style="width: 100% !important;display: flex;flex-direction: column;gap: 35px !important;padding-bottom: 30px !important;">

            <div style="display: flex;align-items: center;gap: 10px !important;width: 100% !important;color: white;">
                
                <div onclick="window.history.back();">
                    
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M20 10C20 10.3788 19.8683 10.7421 19.6339 11.01C19.3995 11.2778 19.0816 11.4283 18.7501 11.4283H4.26926L9.63616 17.5586C9.75237 17.6914 9.84455 17.8491 9.90744 18.0226C9.97033 18.1961 10.0027 18.3821 10.0027 18.5699C10.0027 18.7577 9.97033 18.9437 9.90744 19.1172C9.84455 19.2907 9.75237 19.4483 9.63616 19.5811C9.51995 19.7139 9.38199 19.8193 9.23016 19.8911C9.07833 19.963 8.9156 20 8.75126 20C8.58692 20 8.42418 19.963 8.27235 19.8911C8.12052 19.8193 7.98256 19.7139 7.86636 19.5811L0.367193 11.0112C0.250798 10.8786 0.158451 10.721 0.095442 10.5474C0.0324329 10.3739 0 10.1879 0 10C0 9.81213 0.0324329 9.6261 0.095442 9.45257C0.158451 9.27905 0.250798 9.12143 0.367193 8.98875L7.86636 0.418872C8.10105 0.150673 8.41935 0 8.75126 0C9.08316 0 9.40147 0.150673 9.63616 0.418872C9.87085 0.687071 10.0027 1.05083 10.0027 1.43012C10.0027 1.80941 9.87085 2.17317 9.63616 2.44136L4.26926 8.57169H18.7501C19.0816 8.57169 19.3995 8.72217 19.6339 8.99003C19.8683 9.25789 20 9.62119 20 10Z" fill="white"/>
                    </svg>

                </div>

                <div>
                    
                    <font class="airt">Data</font>

                </div>

            </div>

            
            </div>

            <div style="width: 100% !important;display: flex;flex-direction: column;gap: 30px;">
            	
            	<form method="POST" style="width: 100% !important;display: flex;flex-direction: column;">
            		
            		<div style="display: flex;width: 100% !important;border-bottom: 1px solid #1E1E1E;padding-bottom: 20px !important;gap: 8px !important;">
            			
            			<div>
            				
            				<img src="images/mtn.png" id="carrierImage">

            			</div>

            			<div>
            				
            				<input type="number" name="phone" id="phoneNumber" style="height: 100% !important;width: 100% !important;background: transparent;border: none;color: white;font-size: 20px !important;font-weight: 500;font-family: montserrat;" class="all" value="<?php echo $_SESSION["phone"]; ?>">

            			</div>


            		</div>

            		<div style="width: 100% !important;text-align: center;margin-top: 10px !important;">
            			
            			<font class="enjoy">Enjoy amazing rewards daily when you top up your airtime with Mobilix</font>

            		</div>

            		<div class="data-hold" style="margin-top: 20px !important;">
            			
            			<div>
            				
            				<div style="display: flex;justify-content: space-between;width: 100% !important;flex-wrap: wrap;row-gap: 20px;" id="data_bundles_list">

                                <?php

                                if (isset($network)) {
                                    
                                    $select = "SELECT * FROM `data_bundles` WHERE `network`='".$network."'";

                                    $select_query = mysqli_query($conn, $select);

                                    if (mysqli_num_rows($select_query) > 0) {
                                        
                                        while ($fetch = mysqli_fetch_assoc($select_query)){

                                            $price = $fetch["price"];

                                            $product_code = $fetch["product_code"];

                                            $name = shortens($fetch["name"]);

                                            $validity = fil($fetch["name"]);


                                ?>
            					
            					<button type="submit" name="submit" value="<?php echo $product_code; ?>" style="border: none;background: transparent;">
            						
            						<div class="plan-hold">
            							
            							<div>
            								
            								<font class="month"><?php echo $validity ?></font>

                                            <div style="margin-top: 10px !important;display: flex;flex-direction: column;gap: 2px;">

                								<font class="price"><?php echo formatDataSize($name); ?></font>

                								<font class="real-price">₦ <?php echo $price; ?></font>

                                            </div>

            							</div>

            						</div>

            					</button>

                                <?php

                                }}}

                                ?>

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

$(document).ready(function () {
    function getCarrierInfo() {
        const phoneNumber = $('#phoneNumber').val();

        if (!phoneNumber) {
            $('#carrierImage').hide(); // Hide the image if the input is empty
            return;
        }

        $.ajax({
            url: 'getcarrier.php',
            method: 'POST',
            data: { phoneNumber: phoneNumber },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    const carrier = response.carrier.toLowerCase();
                    $('#carrierResult').text(`Carrier: ${response.carrier}`);

                    let imageUrl = '';
                    let network = '';

                    if (carrier.includes('mtn')) {
                        imageUrl = 'images/mtn.png';
                        network = 'MTN';
                    } else if (carrier.includes('airtel')) {
                        imageUrl = 'images/airtel.png';
                        network = 'Airtel';
                    } else if (carrier.includes('glo')) {
                        imageUrl = 'images/glo.png';
                        network = 'Glo';
                    } else if (carrier.includes('9mobile')) {
                        imageUrl = 'images/9mobile.png';
                        network = '9mobile';
                    } else {
                        imageUrl = 'images/profile.png'; // Default image
                        network = 'Unknown';
                    }

                    if (imageUrl) {
                        $('#carrierImage').attr('src', imageUrl).show();
                    } else {
                        $('#carrierImage').hide();
                    }

                    // Directly send the network value to setnetwork.php without using localStorage
                    $.ajax({
                        url: 'setnetwork.php',
                        method: 'POST',
                        data: { network: network },
                        success: function (response) {
                            console.log('Network sent to PHP:', response);
                        }
                    });

                    // // Update the browser URL (without reloading the page)
                    window.history.pushState(null, '', '?network=' + encodeURIComponent(network));

                    // Send network to the current page (data.php) with the GET method
                    $.ajax({
                        url: 'data.php',
                        method: 'GET',
                        data: { network: network }, // Send the network data as query parameters
                        success: function(response) {
                            console.log('Raw Response from data.php:', network);
                            const trimmedResponse = response.trim();
                            console.log('Trimmed Response:', network);

                            // Display the response (e.g., network info) in a div with id #networkResult
                            $('#networkResult').text(trimmedResponse);
                        }
                    });

                } else {
                    $('#carrierResult').text(`Error: ${response.message}`);
                    $('#carrierImage').hide();
                }
            },
            error: function () {
                $('#carrierResult').text("An error occurred while processing the request.");
                $('#carrierImage').hide();
            }
        });
    }

    // Call the function on page load and whenever input changes
    getCarrierInfo();
    $('#phoneNumber').on('input change', getCarrierInfo);
});

   




</script>

</html>

