<?php
    require_once "init.php";
    $page_name = "Validate email";
    // check if there is session called frompage
    if (!isset($_SESSION['frompage'])):
        header("location: login");
        exit;
    else:
        // check if come out from sinup page or forgetpassword
        if ($_SESSION['frompage'] !== 'signup' && $_SESSION['frompage'] !== 'forgettenpassword'):
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
                #--------------- start check if POST ---------------#
                if ($_SERVER['REQUEST_METHOD'] === "POST"):
                    // check if id = idconfirm
                    if ($_SESSION['id'] === filter_var(trim($_POST['idconfirm']), FILTER_SANITIZE_STRING)):
                        // check page from is
                        if ($_SESSION['frompage'] === 'signup'):
                            $stat = $db -> prepare("INSERT INTO users (email, name, gender, birthday, phone, password) 
                                VALUES (:email, :name, :gender, :birthday, :phone, :password)");
                            $stat -> bindparam("email", $_SESSION['email']);
                            $stat -> bindparam("name", $_SESSION['name']);
                            $stat -> bindparam("gender", $_SESSION['gender']);
                            $stat -> bindparam("birthday", $_SESSION['birthday']);
                            $stat -> bindparam("phone", $_SESSION['phone']);
                            $stat -> bindparam("password", $_SESSION['password']);
                            $stat -> execute();
                            // distory session
                            session_unset();
                            session_destroy ();
                            $correctvalidate = "on";
                            header( "refresh:5;url=login" );
                        else:
                            $_SESSION['frompage']   = "validateemail";
                            $_SESSION['pageexpire'] = time() + (60 * 10); // expire will be finsh after 10 minutes
                            header("location: changepassword");
                            exit;
                        endif;
                    else:
                        $correctvalidate = "off";
                    endif; // end check if id = idconfirm
                endif; // end check if is post
                #--------------- end check if POST ---------------#
                #--------------- start email ---------------#
                //Recipients
                $mail->setFrom('ahmedelkholy@secureparking.website', 'SSP');
                $mail->addAddress($_SESSION['email']);     //Add a recipient Name is optional
                $mail->addReplyTo('ahmedelkholy@secureparking.website', 'SSP');
                //Content
                $mail->Subject = 'Confirm your Account';
                $message = lang("validateemailmessage1") . $_SESSION['name'] . lang("validateemailmessage2") . 
                        lang("validateemailmessage3") . lang("validateemailmessage4") . 
                        "<p><span style='color:#00F;font-weight:bolder;'>" . $_SESSION['id'] . "</span></p>" . 
                        lang("validateemailmessage5");
                $mail->Body    = $message;
                //Send message
                if($_SESSION['resend'] === "on"):
                    $mail->send();
                    $_SESSION['resend'] = "off";
                endif;
                #--------------- end email ---------------#
            endif; // end check of expire
        endif;// end check if come out from sinup page or forgetpassword
    endif; // check if there is session called frompage
?>
<?php require_once $templates . "/header.inc" ?>
        <link rel="stylesheet" href="<?php echo $css_dir;?>/validate_email.css" />
        <div class="container">
            <form action="validate_email" method="post" class="content">
                <p><?php echo lang("emailspam1");?></p>
                <p><?php echo lang("emailspam2");?></p>
                <input 
                    type="text" 
                    name="idconfirm"
                    placeholder = "<?php echo lang('validateemailcode');?>"
                />
                <input
                    type = "submit"
                    value = "<?php echo lang('validateemailconfirm');?>"
                />
                <?php
                    // check if correct validate
                    if(isset($correctvalidate)):
                        if($correctvalidate === "on"):
                            echo lang("validateemailcorrect1");
                            echo lang("validateemailcorrect2");
                            echo lang("validateemailcorrect3");
                        else:
                            echo lang("validateemailincorrect");
                        endif;
                    endif; // not check if correct validate
                ?>
            </form>   
        </div>

<?php require_once $templates . "/footer.inc" ?>
<script src="<?php echo $js_dir;?>/validate_email.js"></script>