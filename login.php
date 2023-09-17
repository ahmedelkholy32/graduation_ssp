<?php
    require_once "init.php";
    $page_name = "Login";
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
            $password =  $db -> prepare("SELECT password FROM users WHERE email=:email");
            $password -> bindParam("email", $email);
            $password -> execute();
            $password = $password -> fetchColumn();
            // check if the password is correct
            if(password_verify(filter_var($_POST['password'], FILTER_SANITIZE_STRING), $password)):
                // check if use want to rembremember you
                if (isset($_POST['rememberme'])):
                    // set cookie for 1 week only
                    setcookie("username", $email, time() + 604800, "/", "", true, true);
                    header("Location: .");
                    exit;
                else:
                    $_SESSION['username'] = $email;
                    header("Location: .");
                    exit;
                endif; // end check if use want to rembremember you
            else:
                $passwordnotcorrect = "on";
            endif;// end check if the password is correct
        else:
            $emailnotexist = "on";
        endif; // end check if email is exist
    endif; // end check request method
?>
<?php require_once $templates . "/header.inc" ?>

        <link rel="stylesheet" href="<?php echo $css_dir;?>/login.css" />
        <div class="container">
            <form action="login" method="POST" class="content m-5 m-lg-0">                    
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
                <div class="password">
                    <label for="password"><?php echo lang("password");?></label>
                    <input 
                        type        = "password" 
                        name        = "password" 
                        id          = "password" 
                        required 
                        autocomplete= "off"
                    />
                    <i class="fa fa-eye" id="passwordshow"></i>
                    <?php
                        // check if password is correct or no
                        if(isset($passwordnotcorrect)):
                            echo lang("loginpasswordnotcorrect");
                        endif; // end check if password is correct or no
                    ?>
                </div>
                <div class="rememberme">
                    <input type="checkbox" name="rememberme" id="rememberme" value="rememberme"/>
                    <label for="rememberme"><?php echo lang("loginrememberme");?></label>
                </div>
                <div>
                    <input type="submit" value="<?php echo lang('loginlogin');?>" id="submit" />
                </div>
                <div>
                    <a href="forgettenpassword"><?php echo lang("loginforgettenpasswort");?></a>
                </div>
                <div>
                    <a href="signup"><?php echo lang("logincreatenewaccount");?></a>
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
<script src="<?php echo $js_dir;?>/login.js"></script>