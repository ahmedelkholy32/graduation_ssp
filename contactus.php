<?php
    require_once "init.php";
    $page_name = "Contact Us";
    // start check if there is session for user name
    if(!isset($_SESSION['username'])):
        // start chech if there is cookie for username
        if(!isset($_COOKIE['username'])):
            header("Location: login");
            exit;
        else:
            $_SESSION['username'] = $_COOKIE['username'];
        endif; // end chech if there is cookie for username
    endif; // end check if there is session for user 
    // check if request method is post to send mail
    if ($_SERVER['REQUEST_METHOD'] === "POST"):
        // get name of user from database
        $name = $db -> prepare("SELECT name FROM users WHERE email = :email");
        $name -> bindParam("email", $_SESSION['username']);
        $name -> execute();
        $name = $name -> fetchColumn();
        #--------------- start email ---------------#
        //Recipients
        $mail->setFrom('ahmedelkholy@secureparking.website', $name);
        $mail->addAddress('ahmedelkholy@secureparking.website', "SSP");     //Add a recipient Name is optional
        $mail->addReplyTo($_SESSION['username'], $name);
        $mail->addCC($_SESSION['username']);
        //Content
        $mail->Subject = $_POST['title'];
        $mail->Body    = $_POST['message'];
        //Send message
        $mail->send();
        header("Location: contactus");
        #--------------- end email ---------------#
        // make request post not equail post
        
    endif;// end check if request method is post to send mail
?>
<?php require_once $templates . "/header.inc" ?>

        <link rel="stylesheet" href="<?php echo $css_dir;?>/contactus.css" />
        <div class="container">
            <form action="contactus" method="post" class="contactusform">
                <p><i class="fa fa-envelope fa-lg fa-fw"></i> ahmedelkholy@secureparking.website</p>
                <p><i class="fa fa-phone-square fa-lg fa-fw"></i> 01128278235</p>
                <input 
                    type            = "text" 
                    name            = "title"
                    required
                    autocomplete    = "off"
                    placeholder     = "<?php echo lang('contactustitle');?>"
                />
                <textarea name="message" required placeholder="<?php echo lang('contactusmessage');?>"></textarea>
                <input type="submit" value="<?php echo lang('contactussend');?>"/>
            </form>
        </div>
        
<?php require_once $templates . "/footer.inc" ?>