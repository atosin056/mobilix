<?php

include 'connect.php';

require_once 'functions.php';

if (isset($_POST["submit"])) {

    $fname = mysqli_real_escape_string($conn, $_POST["fname"]);

    $lname = mysqli_real_escape_string($conn, $_POST["lname"]);

    $email = $_POST["email"];

    $phone = mysqli_real_escape_string($conn, $_POST["phone"]);

    $nickname = mysqli_real_escape_string($conn, $_POST["nickname"]);

    $pin = mysqli_real_escape_string($conn, $_POST["pin"]);

    $checkPin = checkPin($pin);

    if ($checkPin == "next") {
        
        $registerUser = registerUser($fname, $lname, $email, $phone, $nickname, $pin);

    }

    $message = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Mobilix</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #121212;
            font-family: Arial, sans-serif;
            color: #ffffff;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #1e1e1e;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .header {
            background-color: #007bff;
            text-align: center;
            padding: 20px;
        }
        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 20px;
        }
        .content p {
            font-size: 16px;
            line-height: 1.6;
            margin: 0 0 10px;
        }
        .cta {
            text-align: center;
            margin: 20px 0;
        }
        .cta a {
            text-decoration: none;
            color: #ffffff;
            background-color: #007bff;
            padding: 12px 20px;
            border-radius: 6px;
            font-size: 16px;
            display: inline-block;
            transition: background-color 0.3s ease;
        }
        .cta a:hover {
            background-color: #0056b3;
        }
        .footer {
            background-color: #333333;
            text-align: center;
            padding: 10px;
            font-size: 14px;
            color: #b0b0b0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Welcome to Mobilix</h1>
        </div>
        <div class="content">
            <p>Hi there,</p>
            <p>Thank you for joining Mobilix! We are thrilled to have you on board. Mobilix is your go-to platform for easy and affordable mobile services, designed to keep you connected.</p>
            <p>Start exploring all the features we’ve crafted just for you. If you ever need help, our support team is here 24/7.</p>
            <div class="cta">
                <a href="#">Get Started</a>
            </div>
            <p>Thank you for choosing Mobilix!</p>
            <p>- The Mobilix Team</p>
        </div>
        <div class="footer">
            <p>&copy; 2025 Mobilix. All rights reserved.</p>
            <p><a href="#" style="color: #007bff; text-decoration: none;">Unsubscribe</a></p>
        </div>
    </div>
</body>
</html>
';

    if ($registerUser) {
        
        header('location: login.php');

    }

}

?>

<html>

<head>

	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Mobilix | Your One stop Platform for Airtime and Data | Airtime</title>

    <link rel="icon" type="image/png" href="images/favicon.png">

	<link rel="preconnect" href="https://fonts.googleapis.com">

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
            		
            		<font class="airt">Create an Account👍</font>

            	</div>

            </div>

            <div style="width: 100% !important;display: flex;flex-direction: column;gap: 50px !important;">
            	
            	<form method="POST" style="width: 100% !important;display: flex;flex-direction: column;gap: 10px !important;">

                    <div>
                        
                        <div style="display: flex;flex-direction: column;gap: 10px;">
                            
                            <div>
                                
                                <input type="text" name="fname" class="reg-input form-control" placeholder="Firstname">

                            </div>

                            <div>
                                
                                <input type="text" name="lname" class="reg-input form-control" placeholder="Lastname">

                            </div>

                            <div>
                                
                                <input type="email" name="email" class="reg-input form-control" placeholder="Email Address">

                            </div>

                            <div>
                                
                                <input type="tel" name="phone" class="reg-input form-control" placeholder="Phone Number">

                            </div>

                            <div>
                                
                                <input type="number" name="pin" class="reg-input form-control" placeholder="4 Digit Pin (For login)" minlength ="4" maxlength ="4">

                            </div>

                            <div>
                                
                                <input type="text" name="nickname" class="reg-input form-control" placeholder="Nickname">

                            </div>

                            <div>
                                
                                <input type="submit" name="submit" class="reg-submit form-control" value="Register now!">    

                            </div>

                        </div>

                    </div>

                </form>

                <?php

                include 'contact.php';

                ?>

            </div>

        </div>

    </div>

</div>

</body>

</html>
            		