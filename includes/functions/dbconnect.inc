<?php
    // this page for connect to database
    $dsn = "mysql: host=business26.web-hosting.com; dbname=secuomfs_ssp";
    $db_user = "secuomfs_ahmedelkholy";
    $db_pass = "n;j^v3g#EG29";
    $db_opt = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
    $db = new PDO($dsn, $db_user, $db_pass, $db_opt);
