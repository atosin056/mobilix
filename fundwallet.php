<?php

session_start();

include 'connect.php';

include 'functions.php';

require_once __DIR__ . '/vendor/autoload.php';

if (isset($_POST["submit"])) {
    
    $remaining = $_POST["remaining"];

    $amount = $_POST["amt"];

    $nickname = $_SESSION["nickname"];

    initiateMonnifyCheckout($remaining,$nickname, $amount);

}

?>

<html lang="en">

<head>
    
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="css/main.css">

    <link rel="icon" type="image/png" href="images/logo.png">
    <title>FundWallet | Mobilix</title>
</head>

<body style="background: #000 !important;">

    <div id="ajax-loader">
    
    <div style="width: 150px;">
        
        <img src="images/loader.svg" style="width: 100% !important">

    </div>

</div>

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
                    
                    <font class="airt">Fund Wallet</font>

                </div>

            </div>

    <form method="POST" style="width: 100% !important;padding: 24px !important;background: #1e1e1e;border-radius: 10px;display: flex;flex-direction: column;gap: 20px;">
        <div>
            <input type="number" id="amt" name="amt" placeholder="How much do you want to add" class="amt">
        </div>

        <div>
            <input type="number" id="charge" readonly name="charge" value="" placeholder="How much we are charging" class="amt">
        </div>

        <div>
            <input type="number" id="remaining" readonly name="remaining" value="" class="amt" placeholder="How much you would Get">
        </div>

        <div>
            
            <input type="submit" name="submit" value="Pay" class="pay">

        </div>
    </form>

    <?php

    include 'contactdev.php';

    ?>

    <script>

        // Show the loader on page load
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

        // Get input elements
        const amtInput = document.getElementById('amt');
        const chargeInput = document.getElementById('charge');
        const remainingInput = document.getElementById('remaining');

        // Add an event listener to calculate the charge and remaining amount dynamically
        amtInput.addEventListener('input', function () {
            const amt = parseFloat(amtInput.value);

            // Validate and calculate
            if (!isNaN(amt) && amt > 0) {
                const charge = (amt * 0.02).toFixed(2); // Calculate 1% charge
                const remaining = (amt - charge).toFixed(2); // Remaining amount after charge

                chargeInput.value = charge; // Display the charge
                remainingInput.value = remaining; // Display the remaining amount
            } else {
                chargeInput.value = ''; // Clear fields if input is invalid
                remainingInput.value = '';
            }
        });

        
    </script>
</body>
</html>
