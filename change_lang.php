<?PHP
    $lang = $_POST['lang'];
    $from = $_SERVER['HTTP_REFERER'];
    if($_SERVER['REQUEST_METHOD'] === "POST"):
        // this cookie for 1 month
        setcookie("language", $lang, time() + 2592000, "/", "", TRUE, FALSE);
        header("Location: $from");
        exit;
    else:
        header('Location: .');
        exit;
    endif;