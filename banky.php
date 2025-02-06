<?php
    
    session_start();

    include 'functions.php';

    include 'connect.php';

    if (isset($_POST["submit"])) {

    $bank_code = $_POST["bank"];

    $accountNumber = $_POST["acct"];

    $amt = $_POST["amt"];

    $remaining = $_POST["remaining"];

     $select = "SELECT * FROM `users` WHERE `nickname`='".$_SESSION["nickname"]."'";
    $select_query = mysqli_query($conn, $select);
    if (mysqli_num_rows($select_query) > 0) {
        while ($row = mysqli_fetch_assoc($select_query)) {
            $balance = $row["balance"];
        }
        if ($balance >= $amt) {
            
            $send = disburseFundsMonnify($remaining, time(), $accountNumber, $bank_code, '1419191769', $narration = "Fund Transfer");

            if ($send) {
                
                $deduct = deduct($amt, $_SESSION["nickname"]);

                if ($deduct) {

                    $_SESSION["balance"] = $_SESSION["balance"] - $amt;
                    
                    header('location: dashboard.php?transaction=successfuldata');

                }

                else{

                    header('location: dashboard.php?transaction=faileddata');

                }

             }

        }

        else{

        header('location: dashboard.php?transaction=faileddata');

        }

    }

}

?>