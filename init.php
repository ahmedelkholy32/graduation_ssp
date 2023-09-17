<?php
    SESSION_start();
    // includes directory
    $templates  = "includes/templates";
    $functions  = "includes/functions";
    $libraries  = "includes/libraries";
    $languages  = "includes/languages";
    // layout directory
    $css_dir        = "layout/css";
    $js_dir         = "layout/js";
    $images_layout  = "layout/images";
    // langauges
    if(isset($_COOKIE['language'])){
        $main_lang = $_COOKIE['language'];
    } else{
        $main_lang = "en";
        $main_direction = "ltr";
    }
    switch($main_lang){
        case "en":
            $main_direction = "ltr";
            $anthor_lang = "ar";
            $anthor_lang_label = "عربي";
            break;
        case "ar":
            $main_direction = "rtl";
            $anthor_lang = "en";
            $anthor_lang_label = "English";
            break;
    }
    require_once $languages . "/" . $main_lang . ".inc";
    // insert functions
    require_once $functions . "/dbconnect.inc";
    require_once $functions . "/mailserver.inc";