<?php

session_start();

require_once 'functions.php';

if (!isset($_SESSION["nickname"])) {
    
    header('location: login.php');

}


$carrier = getCarrier($_SESSION["phone"]);

// $publicKey = 'pk_live_6ZCZ1O8E9xK+1CTf8rtAS5ex+rfKzxDi+3jenFyYTp8=';

// $balance = checkBalance($publicKey);




// if (isset($_GET["transaction"])) {
    
//     if ($_GET["transaction"] == 'successfuldata') {
        
//         if (isset($_POST['action']) && $_POST['action'] === 'check_notifications') {
//             header('Content-Type: application/json');
//             echo json_encode(checkForNewNotifications());
//             exit;
//         }

//     }

// }
// function checkForNewNotifications() {
//     // This could be a database query or any other source
//     // For demonstration, we'll return a simple array
//     return [
//         'hasNotification' => true,
//         'title' => 'Mobilix',
//         'message' => 'Your Transaction was successful',
//         'timestamp' => time()
//     ];
// }

?>

<html>

<head>

	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Mobilix | Your One stop Platform for Airtime and Data | Dashboard</title>

	<link rel="preconnect" href="https://fonts.googleapis.com">

	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="icon" type="image/png" href="images/favicon.png">

	<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="css/main.css">

	<link rel="icon" type="image/png" href="images/logo.png">

</head>

<body style="background: #111;">

    <div style="position: absolute; background: rgba(0, 0, 0, 0.8); backdrop-filter: blur(10px); width: 100%; height: 100%;display: flex;align-items: flex-end;" class="wholes" id="success-message">
  <div class="error" style="border-top: 7px solid #99ff97 !important;">
        <div style="display: flex;width: 100% !important;height: 100% !important;justify-content: center;align-items: center;">
            
            <div style="display: flex;width: 100% !important;height: 100% !important;justify-content: center;align-items: center;flex-direction: column;gap: 30px;padding-left: 28px !important;padding-right: 28px !important;">
                
                <div style="width: 60px !important;height: 40px !important;">
                    
                    <img src="images/tick.png" style="width: 100% !important;">

                </div>

                <div style="flex-direction: column;display: flex;gap: 10px;">

                    <div style="text-align: center;">
                        
<font class="insufficient">Transaction Successful</font>
                        
                    </div>

                    <p style="color: wheat;line-height: 30px;text-align: center;">
                        
                        🎉 Success! Your transaction was completed successfully. Thank you for choosing our service. You can check your dashboard for updated details. Have a great day!

                    </p>

                    <div>
                        
                        <div id="closes">Close</div>

                    </div>

                    <script type="text/javascript">const errorDivs = document.querySelector('.wholes');
const closeButtons = document.getElementById('closes');

closeButtons.addEventListener('click', () => {
  // Add a class for the transition
  errorDivs.classList.add('closing');

  // After the transition duration, hide the element
  errorDivs.addEventListener('transitionend', () => {
    errorDivs.style.display = 'none';
    // Remove the class to allow the transition to happen again if the error reappears
    errorDivs.classList.remove('closing');
  }, { once: true }); // Ensure the event listener is only triggered once

});</script>

                </div>

            </div>

        </div>

  </div>
</div>

<div style="position: absolute; background: rgba(0, 0, 0, 0.8); backdrop-filter: blur(10px); width: 100%; height: 100%;display: flex;align-items: flex-end;" class="whole">
  <div class="error">
        <div style="display: flex;width: 100% !important;height: 100% !important;justify-content: center;align-items: center;">
            
            <div style="display: flex;width: 100% !important;height: 100% !important;justify-content: center;align-items: center;flex-direction: column;gap: 30px;padding-left: 28px !important;padding-right: 28px !important;">
                
                <div style="width: 60px !important;height: 40px !important;">
                    
                    <img src="images/errorx.png" style="width: 100% !important;">

                </div>

                <div style="flex-direction: column;display: flex;gap: 10px;">

                    <div style="text-align: center;">
                        
                        <font class="insufficient">Insufficient Balance</font>

                    </div>

                    <p style="color: wheat;line-height: 30px;text-align: center;">
                        
                        Oops! It seems like your current balance is insufficient to proceed with this transaction. Please fund your wallet and try again. Thank you!

                    </p>

                    <div>
                        
                        <div id="close">Close</div>

                    </div>

                    <script type="text/javascript">const errorDiv = document.querySelector('.whole');
const closeButton = document.getElementById('close');

closeButton.addEventListener('click', () => {
  // Add a class for the transition
  errorDiv.classList.add('closing');

  // After the transition duration, hide the element
  errorDiv.addEventListener('transitionend', () => {
    errorDiv.style.display = 'none';
    // Remove the class to allow the transition to happen again if the error reappears
    errorDiv.classList.remove('closing');
  }, { once: true }); // Ensure the event listener is only triggered once

});</script>

                </div>

            </div>

        </div>

  </div>
</div>

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
            
            <div style="display: flex;align-items: center;gap: 8px !important;width: 100% !important;">
                
                <div class="dashboard-profile-holder">
                    
                    <img src="images/profile.png" style="width: 100% !important;height: 100% !important;border-radius: inherit !important;">

                </div>

                <div style="display: flex;flex-direction: column;align-items: flex-start;">
                    
                    <font class="hi" style="display: inline-block;width: auto;">Hi <?php echo $_SESSION['nickname']; ?>!</font>

                    <font class="welcome">Welcome, Lets Topup!</font>

                </div>

            </div>
 
            <div class="dey">
                        
                <div class="balance">
                    
                    <div style="display: flex;flex-direction: column;gap: 6px;">
                        
                        <div style="display: flex;width: 100% !important;align-items: center;gap: 3px !important;">
                            
                            <div style="width: 10px !important;height: 10px !important;">
                                
                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
                                  <g clip-path="url(#clip0_4_44)">

                                    <path d="M9.16671 4.61668V5.00001C9.1662 5.89852 8.87525 6.7728 8.33726 7.49244C7.79928 8.21209 7.04308 8.73855 6.18144 8.99331C5.3198 9.24807 4.3989 9.21747 3.55607 8.90609C2.71324 8.59471 1.99365 8.01922 1.50461 7.26546C1.01557 6.5117 0.783287 5.62004 0.842406 4.72348C0.901525 3.82692 1.24888 2.97348 1.83266 2.29046C2.41644 1.60744 3.20537 1.13142 4.08179 0.933409C4.9582 0.735394 5.87515 0.825988 6.69588 1.19168" fill="#008000"/>

                                    <path d="M9.16671 4.61668V5.00001C9.1662 5.89852 8.87525 6.7728 8.33726 7.49244C7.79928 8.21209 7.04308 8.73855 6.18144 8.99331C5.3198 9.24807 4.3989 9.21747 3.55607 8.90609C2.71324 8.59471 1.99365 8.01922 1.50461 7.26546C1.01557 6.5117 0.783287 5.62004 0.842406 4.72348C0.901525 3.82692 1.24888 2.97348 1.83266 2.29046C2.41644 1.60744 3.20537 1.13142 4.08179 0.933409C4.9582 0.735394 5.87515 0.825988 6.69588 1.19168" stroke="#008000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>

                                    <path d="M9.16667 1.66666L5 5.83749L3.75 4.58749" stroke="#532AC7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>

                                  </g>

                                  <defs>

                                    <clipPath id="clip0_4_44">

                                      <rect width="20" height="20" fill="white"/>

                                    </clipPath>

                                  </defs>

                                </svg>


                            </div>

                            <div>
                                
                                <font style="font-family: Montserrat !important;color: white;font-size: 10px !important;">Available Balance</font>

                            </div>

                        </div>

                        <div>
                            
                            <div>
                                
                                <font style="font-family: Montserrat;font-weight: 600;line-height: normal;font-size: 17px !important;">₦ <font id="balance"><?php echo $_SESSION["balance"]; ?></font></font>

                            </div>

                        </div>

                    </div>

                    <!-- End -->

                    <div onclick="window.location.href='fundwallet.php';">
                        
                        <div class="fund-wallet">Fund Wallet</div>

                    </div>

                </div>

                <div style="width: 100% !important;">
                    
                    <div style="width: 100% !important">
                        
                        <div class="lastnotification">
                            
                            <div>
                                
                                <div style="display: flex;flex-direction: column;gap: 2px;">
                                    
                                    <font style="font-size: 10px !important;font-weight: 500;font-family: Montserrat;">Welcome Message!</font>

                                    <font style="color: #787B80;font-family: Montserrat;font-size: 10px !important;font-weight: 500;line-height: normal;">Tosin from Mobilix says welcome!!</font>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- End -->

                <div style="width: 100% !important">
                    
                    <div class="money-transfer">
                        
                        <div style="display: flex;flex-direction: column;gap: 13px;">
                            
                            <div>
                                
                                <font style="font-size: 12px !important;font-family: montserrat;font-weight: 600;color: #fff;line-height: normal;">Money Transfer</font>

                            </div>

                            <div style="width: 100% !important">
                                
                                <div style="width: 100% !important;display: flex;justify-content: center;gap: 35px !important;">
                                    
                                    <div style="display: flex;flex-direction: column;justify-content: center;align-items: center;width: 100px !important;gap: 9px;cursor: pointer;" onclick="window.location.href='bank.php';">
                                        
                                        <div style="width: 30px;height: 30px;">
                                                
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 20 20" fill="none">
                                              <path d="M10 0L18.2623 3.75H19.3748C19.5406 3.75 19.6995 3.81585 19.8167 3.93306C19.9339 4.05027 19.9998 4.20924 19.9998 4.375V6.875C19.9998 7.04076 19.9339 7.19973 19.8167 7.31694C19.6995 7.43415 19.5406 7.5 19.3748 7.5H18.7498V16.25C18.8894 16.2501 19.0249 16.2969 19.1348 16.383C19.2447 16.4691 19.3225 16.5895 19.356 16.725L19.981 19.225C20.0043 19.3171 20.0062 19.4132 19.9866 19.5061C19.9669 19.5991 19.9263 19.6862 19.8678 19.761C19.8093 19.8358 19.7345 19.8963 19.649 19.9377C19.5635 19.9791 19.4698 20.0004 19.3748 20H0.625206C0.530247 20.0004 0.436451 19.9791 0.350998 19.9377C0.265545 19.8963 0.1907 19.8358 0.132192 19.761C0.0736832 19.6862 0.0330622 19.5991 0.0134377 19.5061C-0.00618677 19.4132 -0.00429446 19.3171 0.0189698 19.225L0.643956 16.725C0.677455 16.5895 0.755347 16.4691 0.865218 16.383C0.975089 16.2969 1.11061 16.2501 1.25019 16.25V7.5H0.625206C0.45945 7.5 0.300482 7.43415 0.183274 7.31694C0.0660668 7.19973 0.000220227 7.04076 0.000220227 6.875V4.375C0.000220227 4.20924 0.0660668 4.05027 0.183274 3.93306C0.300482 3.81585 0.45945 3.75 0.625206 3.75H1.73768L10 0ZM4.72137 3.75H15.2799L10 1.25L4.72137 3.75ZM2.50017 7.5V16.25H3.75014V7.5H2.50017ZM5.00011 7.5V16.25H8.12504V7.5H5.00011ZM9.37501 7.5V16.25H10.625V7.5H9.37501ZM11.875 7.5V16.25H14.9999V7.5H11.875ZM16.2499 7.5V16.25H17.4998V7.5H16.2499ZM18.7498 6.25V5H1.25019V6.25H18.7498ZM18.2623 17.5H1.73768L1.42519 18.75H18.5748L18.2623 17.5Z" fill="#532AC7"/>
                                            </svg>

                                        </div>

                                        <div>
                                            
                                            <font style="font-family: montserrat;color: white;font-size: 9px !important;font-weight: 500 !important;line-height: normal;text-align: center">To&nbsp;Bank</font>

                                        </div>

                                    </div>

                                    <!-- End -->

                                    <div style="display: flex;flex-direction: column;justify-content: center;align-items: center;width: 100px !important;gap: 9px;" onclick="window.location.href='payout.php';">
                                        
                                        <div style="width: 29px;height: 20px;">
                                                
                                            <img src="images/mobilix.png" style="width: 100% !important;height: 100% !important;">

                                        </div>

                                        <div style="width: 100% !important;background: transparent;">
                                            
                                            <font style="font-family: montserrat;color: white;cursor: pointer;font-size: 10px !important;font-weight: 500 !important;line-height: normal;text-align: center">To&nbsp;Mobilix&nbsp;Account</font>

                                        </div>

                                    </div>

                                    <!-- End -->

                                    <div style="display: flex;flex-direction: column;cursor: pointer;justify-content: center;align-items: center;width: 100px !important;gap: 9px;">
                                        
                                        <div style="width: 30px;height: 30px;">
                                                
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 20 20" fill="none">
                                              <path fill-rule="evenodd" clip-rule="evenodd" d="M7.5 0C7.62845 7.28699e-05 7.75376 0.0529129 7.85888 0.15133C7.964 0.249747 8.04383 0.38896 8.0875 0.550027L12.5 16.7275L14.4125 9.71381C14.4566 9.55337 14.5366 9.41487 14.6417 9.31708C14.7468 9.21929 14.8719 9.16694 15 9.16712H19.375C19.5408 9.16712 19.6997 9.25492 19.8169 9.41121C19.9342 9.56749 20 9.77946 20 10.0005C20 10.2215 19.9342 10.4335 19.8169 10.5898C19.6997 10.7461 19.5408 10.8339 19.375 10.8339H15.4375L13.0875 19.451C13.0437 19.6118 12.9638 19.7508 12.8587 19.8491C12.7536 19.9473 12.6284 20 12.5 20C12.3716 20 12.2464 19.9473 12.1413 19.8491C12.0362 19.7508 11.9563 19.6118 11.9125 19.451L7.5 3.27349L5.5875 10.2855C5.54362 10.4463 5.46371 10.5851 5.3586 10.6832C5.2535 10.7813 5.1283 10.8339 5 10.8339H0.625C0.45924 10.8339 0.300269 10.7461 0.183058 10.5898C0.065848 10.4335 0 10.2215 0 10.0005C0 9.77946 0.065848 9.56749 0.183058 9.41121C0.300269 9.25492 0.45924 9.16712 0.625 9.16712H4.5625L6.9125 0.550027C6.95617 0.38896 7.036 0.249747 7.14112 0.15133C7.24624 0.0529129 7.37155 7.28699e-05 7.5 0Z" fill="#5430C4"/>
                                            </svg>

                                        </div>

                                        <div style="width: 100% !important;background: transparent;">
                                            
                                            <font style="font-family: montserrat;color: white;font-size: 10px !important;font-weight: 500 !important;line-height: normal;text-align: center;">To&nbsp;FundMaster</font>

                                        </div>

                                    </div>

                                    <!-- End -->    

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- End -->

                <div style="width: 100% !important">
                    
                    <div class="services">
                        
                        <div style="display: flex;flex-direction: column;gap: 13px;">
                            
                            <div>
                                
                                <font style="font-size: 12px !important;font-family: montserrat;font-weight: 600;color: #fff;line-height: normal;">Services</font>

                            </div>

                            <div style="width: 100% !important;">
                                
                                <div style="width: 100% !important;display: flex;gap: 20px;">
                                    
                                    <div style="display: flex;flex-direction: column;justify-content: center;align-items: center;width: 40px !important;gap: 4px;" onclick="window.location.href='airtime.php';">
                                        
                                        <div style="width: 100% !important;display: flex;align-items: center;justify-content: center;background: transparent;height: 30px;">
                                                
                                            <img src="images/airtime.png" style="width: 30px !important;height:100% !important;">    

                                        </div>

                                        <div style="width: 100% !important;background: transparent;">
                                            
                                            <font style="font-family: montserrat;color: white;font-size: 10px !important;font-weight: 500 !important;line-height: normal;">Airtime</font>

                                        </div>

                                    </div>

                                    <!-- ENd -->

                                    
                                        <div style="display: flex;flex-direction: column;justify-content: center;align-items: center;width: 40px !important;gap: 4px;cursor: pointer !important;" onclick="window.location.href='data.php?network=<?php echo $carrier; ?>';">
                                            
                                            <div style="width: 100% !important;display: flex;align-items: center;justify-content: center;background: transparent;height: 30px;">
                                                    
                                                <img src="images/data.png" style="width: 30px !important;height:100% !important;">    

                                            </div>

                                            <div style="width: 100% !important;background: transparent;text-align: center;">
                                                
                                                <font style="font-family: montserrat;color: white;font-size: 10px !important;font-weight: 500 !important;line-height: normal;text-align: center;">Data</font>

                                            </div>

                                        </div>


                                    <!-- ENd -->

                                    <div style="display: flex;flex-direction: column;justify-content: center;align-items: center;width: 40px !important;gap: 4px;cursor: pointer !important;" onclick="window.location.href='tv.php';">
                                            
                                            <div style="width: 100% !important;display: flex;align-items: center;justify-content: center;background: transparent;height: 30px;">
                                                    
                                                <img src="images/tv.png" style="width: 30px !important;height:100% !important;">    

                                            </div>

                                            <div style="width: 100% !important;background: transparent;text-align: center;">
                                                
                                                <font style="font-family: montserrat;color: white;font-size: 10px !important;font-weight: 500 !important;line-height: normal;text-align: center;">Tv</font>

                                            </div>

                                        </div>


                                    <!-- ENd -->


                                    <!-- End -->    

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- End -->

            </div>
        
            <?php

            include 'contactdev.php';

            ?>

        </div>

    </div>
	
</div>



</body>

<script type="text/javascript">


	
	

    
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
    //     // Check if browser supports notifications
    // if (!("Notification" in window)) {
    //     alert("This browser does not support desktop notifications");
    // }

    // // Request permission
    // async function requestNotificationPermission() {
    //     try {
    //         const permission = await Notification.requestPermission();
    //         if (permission === "granted") {
    //             startCheckingNotifications();
    //         }
    //     } catch (error) {
    //         console.error("Error requesting permission:", error);
    //     }
    // }

    // // Send notification
    // function showNotification(title, message) {
    //     if (Notification.permission === "granted") {
    //         const notification = new Notification(title, {
    //             body: message,
    //             icon: '/path/to/icon.png' // Optional
    //         });

    //         notification.onclick = function() {
    //             window.focus();
    //             notification.close();
    //         };
    //     }
    // }

    // // Check for new notifications
    // function checkNotifications() {
    //     fetch('functions.php', {
    //         method: 'POST',
    //         headers: {
    //             'Content-Type': 'application/x-www-form-urlencoded',
    //         },
    //         body: 'action=check_notifications'
    //     })
    //     .then(response => response.json())
    //     .then(data => {
    //         if (data.hasNotification) {
    //             showNotification(data.title, data.message);
    //         }
    //     })
    //     .catch(error => console.error('Error:', error));
    // }

    // // Start periodic checking
    // function startCheckingNotifications() {
    //     // Check every 30 seconds
    //     setInterval(checkNotifications, 30000);
    //     // Also check immediately
    //     checkNotifications();
    // }
window.onload = function() {
    // requestNotificationPermission();
  // Show the loader on page load
  console.log("Page is loading...");
  showLoader();
  
  // Simulate loading process with a timeout (replace with actual logic)
  setTimeout(() => {
    hideLoader();
    console.log("Loader hidden, checking transaction parameter...");

    // Check if the "transaction" parameter exists
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('transaction')) {
      const transactionValue = urlParams.get('transaction');
      console.log(`Transaction parameter found: ${transactionValue}`);

      // Check if the transaction value is "successfuldata"
      if (transactionValue === 'successfuldata') {
        console.log("Transaction successful, showing success message.");
        document.getElementById('success-message').style.display = 'flex';
        const wholeElement = document.querySelector('.whole');
        if (wholeElement) {
          wholeElement.style.display = 'none'; // Hide the error message
        } else {
          console.error(".whole element not found in the DOM.");
        }
      } else {
        console.log("Transaction failed, showing error message.");
        const wholeElement = document.querySelector('.whole');
        document.getElementById('success-message').style.display = 'none';
        if (wholeElement) {
          wholeElement.style.display = 'flex'; // Show the error message
        } else {
          console.error(".whole element not found in the DOM.");
        }
      }
    } else {
      console.log("No transaction parameter, showing error message.");
      document.getElementById('success-message').style.display = 'none';
      const wholeElement = document.querySelector('.whole');
      if (wholeElement) {
        wholeElement.style.display = 'none';
      } else {
        console.error(".whole element not found in the DOM.");
      }
    }
  }, 2000); // Perform the transaction check after the loader finishes



};

   // Get the element by id (for example, 'balance')
    let balanceElement = document.getElementById("balance");
    
       let balanceText = balanceElement.textContent.trim();

    // Convert it into a float
    let balance = parseFloat(balanceText);

    // Format the balance to 2 decimal places
    let formattedBalance = balance.toFixed(2);

    // Add comma formatting to the number
    formattedBalance = parseFloat(formattedBalance).toLocaleString('en-NG'); // 'en-NG' format for Nigerian style

    // Update the element's content
    balanceElement.textContent = formattedBalance;

</script>

</html>
