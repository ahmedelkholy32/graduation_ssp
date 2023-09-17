<?php
    require_once "init.php";
    // check if there is cookie for username or no
    if (isset($_COOKIE['username']) || isset($_SESSION['username'])):
        header("Location: .");
        exit;
    endif; // check if there is cookie for username or no
    // Check request method    
    if ($_SERVER['REQUEST_METHOD'] === "POST"):
        ############################################
        #---------------- Sanitize ----------------#
        ############################################
        // [1] name => Strip tags
        $name       = filter_var(ucwords(trim($_POST['firstname']) . " " . trim($_POST['lastname'])), FILTER_SANITIZE_STRING);
        // [2] gender => Strip tags
        $gender     = filter_var($_POST['gender'], FILTER_SANITIZE_STRING);
        // [3] date => Strip tags
        $birthday   = filter_var($_POST['birthday'], FILTER_SANITIZE_STRING);
        // [4] phone => Remove all characters except digits, plus and minus sign.
        $phone      = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
        // [5] email => Remove all characters except letters, digits and !#$%&'*+-=?^_`{|}~@.[].
        $email      = filter_var(strtolower(trim($_POST['email'])), FILTER_SANITIZE_EMAIL);   
        // [6] password => Strip tags
        $password   = password_hash(filter_var(ucfirst($_POST['password']), FILTER_SANITIZE_STRING), PASSWORD_DEFAULT);
        ############################################
        #--------------- Validation ---------------#
        ############################################
        // i validates in email only as its very important and it is primary
        if(filter_var($email, FILTER_VALIDATE_EMAIL) !== FALSE):
            // check if this email and phone is exists before or not
            $emails = $db -> prepare("SELECT email FROM users");
            $emails -> execute();
            $emails = $emails -> fetchAll(PDO::FETCH_COLUMN);
            $phones = $db -> prepare("SELECT phone FROM users");
            $phones -> execute();
            $phones = $phones -> fetchAll(PDO::FETCH_COLUMN);
            if (in_array($email, $emails) || in_array($phone, $phones)):
                // check for email
                if (in_array($email, $emails)):
                    $emailexist = "on";
                endif; // end check for email
                // check for phone
                if (in_array($phone, $phones)):
                    $phoneexist = "on";
                endif; // end check for phone
            else:
                $_SESSION['name']       = $name;
                $_SESSION['gender']     = $gender;
                $_SESSION['birthday']   = $birthday;
                $_SESSION['phone']      = $phone;
                $_SESSION['email']      = $email;
                $_SESSION['password']   = $password;
                $_SESSION['resend']     = "on";
                $_SESSION['id']         = uniqid();
                $_SESSION['frompage']   = "signup";
                $_SESSION['pageexpire'] = time() + (60 * 10); // expire will be finsh after 10 minutes
                header("location: validate_email");
                exit;
            endif; // end check if this email and phone is exists before or not  
        else:
            $emailnotvalid = "on";
        endif; // end of check email
    endif; // end of check request method
    $page_name = "Sign up";
?>
<?php require_once $templates . "/header.inc" ?>

        <link rel="stylesheet" href="<?php echo $css_dir;?>/signup.css" />
        <div class="container">
            <form action="signup" method="POST" class="content m-5 m-lg-0">
                <div class="fullname">
                    <div class="firstname">
                        <label for="firstname"><?php echo lang("firstname");?></label>
                        <input
                            type        = "text"
                            id          = "firstname"
                            name        = "firstname"
                            maxlength   = "15" 
                            required 
                            autofocus   = "on" 
                            autocomplete= "off" 
                            pattern     = "[a-zA-Zأ-يء]+"
                            title       = "<?php echo lang("nametitle");?>" 
                        />
                    </div>
                    <span></span>
                    <div class="lastname">
                        <label for="lastname"><?php echo lang("lastname");?></label>
                        <input 
                            type="text" 
                            id="lastname" 
                            name="lastname" 
                            maxlength="15" 
                            required 
                            autocomplete="off"
                            pattern     = "[a-zA-Zأ-يء]+"
                            title       = "<?php echo lang("nametitle");?>" 
                        />
                    </div>
                    <div class="fixed"></div>
                </div>
                <div class="gender">
                    <span><?php echo lang("gender");?>:</span>
                    <input type="radio" name="gender" id="male" value="male" checked />
                    <label for="male"><?php echo lang("male");?></label>
                    <input type="radio" name="gender" id="female" value="female" />
                    <label for="female"><?php echo lang("female");?></label>
                </div>
                <div class="birthday">
                    <label for="birthday" ><?php echo lang("birthday");?></label>
                    <input type="date" name="birthday" id="birthday" required />
                </div>
                <div class="phone">
                    <label for="phone" ><?php echo lang("phone");?></label>
                    <input 
                        type        = "tel" 
                        name        = "phone" 
                        id          = "phone" 
                        required 
                        autocomplete= "off" 
                        pattern     = "[0-9]{11}" 
                        title       = "<?php echo lang("phonetitle");?>"
                    />
                    <?php
                        // check if phone is exist no
                        if(isset($phoneexist)):
                            echo $phone . ": " . lang("phoneexistm");
                        endif; // not check if phone is exist no
                    ?>
                </div>
                <div class="email">
                    <label for="email"><?php echo lang("email");?></label>
                    <input type="email" name="email" id="email" required autocomplete="off" />
                    <?php
                        // check if email is valid or no
                        if(isset($emailnotvalid)):
                            echo $email . ": " . lang("emailnotvalidm");
                        endif; // end check if email is valid or no
                        // check if email is exist no
                        if(isset($emailexist)):
                            echo $email . ": " . lang("emailexistm");
                        endif; // not check if email is exist no
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
                        pattern     = "(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                        title       = "<?php echo lang("passwordtitle");?>"
                    />
                    <i class="fa fa-eye" id="passwordshow"></i>
                    <p id="passwordnote"></p>
                </div>
                <div class="confirm">
                    <label for="confirm"><?php echo lang("confirm");?></label>
                    <input 
                        type        = "password"  
                        id          = "confirm" 
                        required 
                        autocomplete= "off"
                    />
                </div>
                <div>
                    <input type="submit" value="<?php echo lang('create');?>" id="submit" />
                </div>
                <div>
                    <a href="login"><?php echo lang("backtologin");?></a>
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
            confirm.setCustomValidity("<?php echo lang("confirmtitle");?>");
        } else {
            confirm.setCustomValidity("");
        }
    }
    function validateEmail() {
        "use strict";
        if (email.validity.typeMismatch) {
            email.setCustomValidity("<?php echo lang("emailtitle");?>");
        } else {
            email.setCustomValidity('');
        }
    }
    function showPasswordNote() {
        "use strict";
        passwordNote.textContent = "<?php echo lang('passwordtitle');?>";
    }
    function hidePasswordNote() {
        "use strict";
        passwordNote.textContent = "";
    }
    // events showPasswordNote
    confirm.onkeyup = validatePassword;
    password.onchange = validatePassword;
    submit.addEventListener("click", validateEmail);
    password.onfocus = showPasswordNote;
    password.onblur = hidePasswordNote;
</script>
<script src="<?php echo $js_dir;?>/signup.js"></script>