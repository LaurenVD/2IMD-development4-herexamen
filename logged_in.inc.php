<?php
    session_start();
    if(!$_SESSION["loggedIn"]) {
        header("Location: login.php");
        die;
    }
?>