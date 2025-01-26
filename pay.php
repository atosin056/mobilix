<?php

session_start();

include 'connect.php';

require_once 'functions.php';

if (isset($_POST["submit"])) {

    $amt = $_POST["amt"];

    $reciever = '0'.$_POST["acct"];


    //check sender balance

    if ($amt <= $_SESSION["balance"]) {
        
        $check = true;

    }

    if ($check) {
        
        $transfer = transferMoneyToMobilix($amt, $reciever, $_SESSION["nickname"]);

        if ($transfer) {

            $_SESSION["balance"] = $_SESSION["balance"] - $amt;
            
            header('location: dashboard.php?transaction=successfuldata');

        }

        else{

            header('location: dashboard.php?transaction=faileddata');

        }

    }

    else{

        header('location: dashboard.php?transaction=faileddata');
    
    }

}

?>