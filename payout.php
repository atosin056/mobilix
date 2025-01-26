<html>

<head>

	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Mobilix | Your One stop Platform for Airtime and Data | Airtime</title>

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
            		
            		<font class="airt">Transfer to Mobilix Account</font>

            	</div>

            </div>

            <div style="width: 100% !important;display: flex;flex-direction: column;gap: 50px !important;">
            	
            	<form method="POST" style="width: 100% !important;display: flex;flex-direction: column;gap: 10px !important;" action="pay.php">
            		
                    <div>
                        
                        <div style="width: 100% !important;height: auto;padding: 20px !important;background: #1e1e1e;border-radius: 10px;">
                            
                            <div style="width: 100% !important;display: flex;flex-direction: column;gap: 20px;">
                                
                                <div style="width: 100% !important">
                                    
                                    <input type="number" required name="acct" placeholder="Enter 10 Digit Phone No (Without 0)" minlength ="10" maxlength="10" style="background: transparent;border: none;border-bottom: 0.1px solid #6F7075;width: 100% !important;height: 50px;font-family: montserrat;color: white;" class="oh" id="phoneNumber">

                                </div>

                                <div class="names" id="userName">
                                    
                                    Account name

                                </div>

                            </div>

                        </div>

                    </div>

                    <div>
                        
                        <div style="width: 100% !important;height: auto;padding: 20px !important;background: #1e1e1e;border-radius: 10px;">
                            
                            <div>
                                
                                <font style="font-family: montserrat;font-size: 14px;">Money to be transferred</font>

                            </div>

                            <div>
                                
                                <div>
                                    
                                    <input type="number" name="amt" placeholder="100 - 1000000" id="amt" style="background: transparent;border: none;border-bottom: 0.1px solid #6F7075;width: 100% !important;height: 50px;font-family: montserrat;color: white;" class="ohs" required>

                                </div>
                               
                                <div>
                                    
                                    <input type="submit" name="submit" value="Pay" class="payup">

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

    
    

document.getElementById('phoneNumber').addEventListener('input', function () {
    var phoneNumber = document.getElementById('phoneNumber').value;

    // Check if phone number length is exactly 10 digits
    if (phoneNumber.length === 10) {
        // Add '0' to the beginning if it's not already there
        if (phoneNumber[0] !== '0') {
            phoneNumber = '0' + phoneNumber;
        }

        console.log('Phone number being sent: ' + phoneNumber);  // Debugging line

        // Send the phone number to the backend for checking
        fetch('checkUser.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ phoneNumber: phoneNumber }),
        })
        .then(response => response.text())  // Get the response as text first
        .then(data => {
            console.log('Response received:', data);  // Log the raw response

            try {
                var jsonData = JSON.parse(data);  // Attempt to parse the response as JSON
                if (jsonData.success) {
                    // If user found, update the name
                    const fullName = jsonData.firstName + ' ' + jsonData.lastName;
                    document.getElementById('userName').innerText = fullName;

                    // Log the account name to the console
                    console.log("Account Name: " + fullName);
                } else {
                    alert('User not found');
                }
            } catch (error) {
                console.error('Error parsing JSON:', error);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
});


</script>

</html>