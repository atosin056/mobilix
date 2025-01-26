<?php

include 'functions.php';

include 'connect.php';

if (isset($_POST["submitbtn"])) {
    
    $pin = $_POST["submitbtn"];

    $verifyCredentials = verifyCredentials($pin);

    if ($verifyCredentials) {
        
        header('location: dashboard.php');

    }

}


?>

<html>

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mobilix | Your One stop Platform for Airtime and Data | Oluwatosin Lloyd Akinfenwa</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="icon" type="image/png" href="images/favicon.png">

    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="css/main.css">

    <link rel="icon" type="image/png" href="images/logo.png">

</head>

<body style="background: #1e1e1e;">

<!-- Loader -->

<div id="ajax-loader">
    
    <div style="width: 150px;">
        
        <img src="images/loader.svg" style="width: 100% !important">

    </div>

</div>

<!-- Main Content -->

<div id="main-content">
    
    <div style="width: 100% !important;height: 100% !important;display: flex;justify-content: center;align-items: center;">
        
        <div style="width: 100% !important;height: 100% !important;display: flex;justify-content: center;align-items: center;">
            
            <div style="display: flex;flex-direction: column;align-items: center;gap: 30px;">
                
                <div>
                    
                    <div>
                        
                        <img src="images/loginlogo.png">

                    </div>

                </div>

                <div>
                    
                    <font style="font-size: 26px !important;font-weight: 600 !important;font-family: montserrat !important;color: white;">Mobilix | Login</font>

                </div>

                <div>
                    
                    <form style="display: flex;gap: 8px;" method="POST" id="pinForm" action="login.php">
                        
                        <div class="form-group">
                            
                            <input maxlength="1" type="password" name="pin1" class="pin-input" value="<?php echo isset($_POST['pin1']) ? $_POST['pin1'] : ''; ?>">

                        </div>

                        <div class="form-group">
                            
                            <input maxlength="1" type="password" name="pin2" class="pin-input" value="<?php echo isset($_POST['pin2']) ? $_POST['pin2'] : ''; ?>">

                        </div>

                        <div class="form-group">
                            
                            <input maxlength="1" type="password" name="pin3" class="pin-input" value="<?php echo isset($_POST['pin3']) ? $_POST['pin3'] : ''; ?>">

                        </div>

                        <div class="form-group">
                            
                            <input maxlength="1" type="password" name="pin4" class="pin-input" value="<?php echo isset($_POST['pin4']) ? $_POST['pin4'] : ''; ?>">

                        </div>

                        <div>
                            
                            <input type="submit" name="submitbtn" id="submitbtn" style="display: none !important;">

                        </div>

                    </form>

                </div>

                <div>
                    
                    <font style="font-family: Inter !important;color: #CCCCCC;font-size: 17px !important;font-weight: 200 !important;">Enter PIN to login</font>

                </div>

                <div>
                    
                    <a href="#" style="text-decoration: none !important;color: #775EC6;font-size: 12px !important;font-weight: 300;">
                        
                        <font>Forgot Pin</font>

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

<script type="text/javascript">
    
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

        function ajaxNavigate(url) {
            showLoader();  // Show loader when the request starts
            const xhr = new XMLHttpRequest();
            xhr.open('GET', url, true);  // Create GET request to the specified URL

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {  // When the request is completed
                    hideLoader();  // Hide the loader after the request finishes
                    if (xhr.status === 200) {
                        // Replace the body content with the response
                        document.body.innerHTML = xhr.responseText;
                    } else {
                        alert('An error occurred: ' + xhr.statusText);  // Show error if any
                    }
                }
            };
            xhr.send();  // Send the request
        }
document.addEventListener("DOMContentLoaded", function () {
    const pinInputs = document.querySelectorAll(".pin-input");
    const form = document.getElementById("pinForm");

    if (form) {
        console.log('maxLength');
    }

    pinInputs.forEach((input, index) => {
        // Handle input event for moving to the next field
        input.addEventListener("input", () => {
            // Move to the next input if a value is entered
            if (input.value.length === input.maxLength && index < pinInputs.length - 1) {
                pinInputs[index + 1].focus();
            }
            // Submit form when last input is filled
            if (index === pinInputs.length - 1 && input.value.length === input.maxLength) {
                handleCompletePin();
            }
        });

        // Handle keydown event for backspacing
        input.addEventListener("keydown", (event) => {
            if (event.key === "Backspace" && input.value === "" && index > 0) {
                pinInputs[index - 1].focus();
            }
        });
    });

    function handleCompletePin() {
        // Retrieve all PIN values
        const pin = Array.from(pinInputs).map((input) => input.value).join('');

        // Set a value to the hidden submit input
        document.getElementById("submitbtn").value = pin;

        
    }

});




</script>

</html>
