<?php
    require_once "init.php";
    $page_name = "About Us";
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
?>
<?php require_once $templates . "/header.inc" ?>

        <link rel="stylesheet" href="<?php echo $css_dir;?>/aboutus.css" />
        
        
<?php require_once $templates . "/footer.inc" ?>