<?php
    session_start();
    // start check if there is session for user name
    if(!isset($_SESSION['username'])):
        // start chech if there is cookie for username
        if(!isset($_COOKIE['username'])):
            header("Location: login");
            exit;
        else:
            $_SESSION['username'] = $_COOKIE['username'];
        endif; // end chech if there is cookie for username
    endif; // end check if there is session for user name
    // start chech if there is cookie for username
    if(isset($_COOKIE['username'])):
        setcookie("username", "", time() - 3600, "/");
    endif; // end chech if there is cookie for username
    // distory session
    session_unset();
    session_destroy ();
    header("location: login");
    exit;

