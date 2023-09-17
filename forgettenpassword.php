<?php
    require_once "init.php";
    $page_name = "Forgetten password";
    // check if there is cookie for username or no
    if (isset($_COOKIE['username']) || isset($_SESSION['username'])):
        header("Location: .");
        exit;
    endif; // check if there is cookie for username or no
    // Check request method
    if ($_SERVER['REQUEST_METHOD'] === "POST") :
        $emails = $db -> prepare("SELECT email FROM users");
        $emails -> execute();
        $emails = $emails -> fetchAll(PDO::FETCH_COLUMN);
        // check if email is exist
        $email = filter_var(strtolower(trim($_POST['email'])), FILTER_SANITIZE_EMAIL); // sanitize
        if (in_array($email, $emails, TRUE)):
            $_SESSION['email']      = $email;
            $_SESSION['resend']     = "on";
            $_SESSION['id']         = uniqid();
            $_SESSION['frompage']   = "forgettenpassword";
            $_SESSION['pageexpire'] = time() + (60 * 10); // expire will be finsh after 10 minutes
            header("location: validate_email");
            exit;
        else:
            $emailnotexist = "on";
        endif; // end check if email is exist
    endif; // end check request method
?>
<?php require_once $templates . "/header.inc" ?>

        <link rel="stylesheet" href="<?php echo $css_dir;?>/forgettenpassword.css" />
        <div class="container">
            <form action="forgettenpassword" method="POST" class="content m-5 m-lg-0">                    
                <div class="email">
                    <label for="email"><?php echo lang("email");?></label>
                    <input type="email" name="email" id="email" required autocomplete="off" />
                    <?php
                        // check if email exist or no
                        if(isset($emailnotexist)):
                            echo lang("loginemailnotexist");
                        endif; // end check if email exist or no
                    ?>
                </div>
                <div>
                    <input type="submit" value="<?php echo lang('foregettenpasswordnext');?>" id="submit" />
                </div>
            </form>
            <figure class="d-none d-lg-block">
                <img src="<?php echo $images_layout;?>/parkinglogo.png" alt="parking logo">
            </figure>
            <div class="fixed"></div>
        </div>

<?php require_once $templates . "/footer.inc" ?>
<script>
    var // variables
        email = document.getElementById("email"),
        submit = document.getElementById("submit");

    // functions
    function validateEmail() {
        "use strict";
        if (email.validity.typeMismatch) {
            email.setCustomValidity("<?php echo lang("emailtitle");?>");
        } else {
            email.setCustomValidity('');
        }
    }
    // events
    submit.addEventListener("click", validateEmail)
</script>
<script src="<?php echo $js_dir;?>/forgettenpassword.js"></script>