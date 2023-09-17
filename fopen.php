<?php
    require_once "init.php";
    // start check if there is session for user name
    if(!isset($_SESSION['username'])):
        // start chech if there is cookie for username
        if(!isset($_COOKIE['username'])):
            header("Location: ../../login");
            exit;
        else:
            $_SESSION['username'] = $_COOKIE['username'];
        endif; // end chech if there is cookie for username
    endif; // end check if there is session for user name
    // check if there is session called fopen
    if (!isset($_SESSION['fopen']) && $_SESSION['fopen'] !== 'yes'):
      header('Location: ../../');
      exit;
    endif; //end check if there is session called fopen
    // check if session expire
    if (!isset($_SESSION['pageexpire']) && $_SESSION['pageexpire'] < time()):
      unset($_SESSION['fopen']);
      header('Location: ../../');
      exit;
    endif; //end check if session expire
    $openGate = $db -> prepare("UPDATE orders SET fopen = :fopen WHERE id = :id");
    $openGate -> bindValue("fopen", "open");
    $openGate -> bindParam("id", $_SESSION['id']);
    $openGate -> execute();
    unset($_SESSION['fopen']);
    unset($_SESSION['pageexpire']);
    unset($_SESSION['id']);
    header('Location: ../../');
    exit;