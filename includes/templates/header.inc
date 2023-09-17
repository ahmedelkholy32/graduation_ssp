<?php
    function setActiveNav($name = 'default'){
        global $page_name;
        if (isset($page_name) && $page_name == $name):
            echo "class='activenav'";
        endif;
    }
?>
<!DOCTYPE html>
<html lang="<?php echo $main_lang;?>" dir="<?php echo $main_direction;?>">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="Book your secure smart parking and enjoying with easy life and fantastic." />
        <link rel="icon" href="<?php echo $images_layout;?>/logo.png" />
        <title><?php echo $page_name;?></title>
        <link rel="stylesheet" href="<?php echo $css_dir;?>/font-awesome.min.css" />
        <link rel="stylesheet" href="<?php echo $css_dir;?>/normalize.css" />
        <link rel="stylesheet" href="<?php echo $css_dir;?>/general.css" />
    </head>
    <body>
        <header>
            <div class="container">
                <h1><span>Secure</span> Smart Parking</h1>
                <div id="userinformation">
                    <a href="mysettings"><i class="fa fa-user-circle fa-2x"></i></a>
                    <a href="logout">Logout</a>
                </div>
            </div>
        </header>
        <nav>
            <div class="container">
                <ul>
                    <li><a <?php setActiveNav("Home");?> href="."><?php echo lang("globalhome"); ?></a></li>
                    <li><a <?php setActiveNav("Inquiry");?> href="inquiry"><?php echo lang("globalinquiry"); ?></a></li>
                    <li><a <?php setActiveNav("Reservations");?> href="reservations"><?php echo lang("globalreservations"); ?></a></li>
                    <li><a <?php setActiveNav("My Trips");?> href="mytrips"><?php echo lang("globalmytrips"); ?></a></li>
                    <li><a <?php setActiveNav("Contact Us");?> href="contactus"><?php echo lang("globalcontactus"); ?></a></li>
                    <li><a <?php setActiveNav("About Us");?> href="aboutus"><?php echo lang("globalaboutus"); ?></a></li>
                </ul>
                <?php require_once $functions . "/select_lang.inc";?>
            </div>
        </nav>