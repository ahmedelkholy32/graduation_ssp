<?php
    require_once "init.php";
    // check if there is session called frompage
    if (!isset($_SESSION['frompage'])):
        header("location: login");
        exit;
    else:
        // check if come out from validate email
        if ($_SESSION['frompage'] !== 'validateemail'):
            header("location: login");
            exit;
        else:
            // check expire
            if ($_SESSION['pageexpire'] <= time()):
                // distory session
                session_unset();
                session_destroy ();
                header("location: login");
                exit;
            else:
                if ($_SERVER['REQUEST_METHOD'] === "POST"):
                    $password   = password_hash(filter_var(ucfirst($_POST['password']), FILTER_SANITIZE_STRING), PASSWORD_DEFAULT);
                    $updatepassword = $db -> prepare("UPDATE users SET password = :password WHERE email = :email");
                    $updatepassword -> bindparam("password", $password);
                    $updatepassword -> bindparam("email", $_SESSION['email']);
                    $updatepassword -> execute();
                    // distory session
                    session_unset();
                    session_destroy ();
                    $passwordupdate = "on";
                    header( "refresh:5;url=login" );
                endif; // end of check request method
            endif; // end check expire
        endif; // check if come out from validate email
    endif;  // end check if there is session called frompage  
    $page_name = "Sign up";
?>
<?php require_once $templates . "/header.inc" ?>

        <link rel="stylesheet" href="<?php echo $css_dir;?>/changepassword.css" />
        <div class="container">
            <form action="changepassword" method="POST" class="content m-5 m-lg-0">
                <div class="password">
                    <label for="password"><?php echo lang("changepasswordpassword");?></label>
                    <input 
                        type        = "password" 
                        name        = "password" 
                        id          = "password" 
                        required 
                        autocomplete= "off"
                        pattern     = "(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                        title       = "<?php echo lang("changepasswordpasswordtitle");?>"
                    />
                    <i class="fa fa-eye" id="passwordshow"></i>
                    <p id="passwordnote"></p>
                </div>
                <div class="confirm">
                    <label for="confirm"><?php echo lang("changepasswordconfirm");?></label>
                    <input 
                        type        = "password"  
                        id          = "confirm" 
                        required 
                        autocomplete= "off"
                    />
                </div>
                <div>
                    <input type="submit" value="<?php echo lang('changepasswordchange');?>" id="submit" />
                </div>
                <div>
                    <?php
                        // check if correct validate
                        if(isset($passwordupdate)):
                            if($passwordupdate === "on"):
                                echo lang("changepasswordcorrect1");
                                echo lang("changepasswordcorrect2");
                                echo lang("changepasswordcorrect3");
                            endif;
                        endif; // not check if correct validate
                    ?>
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
        password = document.getElementById("password"),
        confirm = document.getElementById("confirm"),
        email = document.getElementById("email"),
        submit = document.getElementById("submit"),
        passwordNote = document.getElementById("passwordnote");
    // functions
    function validatePassword() {
        "use strict";
        if (password.value !== confirm.value) {
            confirm.setCustomValidity("<?php echo lang("changepasswordconfirmtitle");?>");
        } else {
            confirm.setCustomValidity("");
        }
    }
    function showPasswordNote() {
        "use strict";
        passwordNote.textContent = "<?php echo lang('changepasswordpasswordtitle');?>";
    }
    function hidePasswordNote() {
        "use strict";
        passwordNote.textContent = "";
    }
    // events showPasswordNote
    confirm.onkeyup = validatePassword;
    password.onchange = validatePassword;
    password.onfocus = showPasswordNote;
    password.onblur = hidePasswordNote;
</script>
<script src="<?php echo $js_dir;?>/changepassword.js"></script>