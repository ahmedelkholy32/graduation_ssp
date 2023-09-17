<?php
    require_once "init.php";
    $page_name = "Balance";
    // start check if there is session for user name
    if(!isset($_SESSION['username'])):
        // start chech if there is cookie for username
        if(!isset($_COOKIE['username'])):
            header("Location: login");
            exit;
        else:
            $_SESSION['username'] = $_COOKIE['username'];
        endif; // end chech if there is cookie for username
    endif; // end check if there is session for user name
    // check if request method is post
    if ($_SERVER['REQUEST_METHOD'] === "POST"):
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        $money = $db -> prepare("UPDATE users SET money = money + :money WHERE email = :email");
        $money -> bindParam("money", $_POST['money']);
        $money -> bindParam("email", $_SESSION['username']);
        $money -> execute();
        header("Location: .");
        exit;
    endif;// end check if request method is post
?>
<?php require_once $templates . "/header.inc" ?>

        <link rel="stylesheet" href="<?php echo $css_dir;?>/balance.css" />
        <div class="container">
            <form action="balance" method="post" class="balanceform">
                <div>
                    <input 
                        type            = "number"
                        name            = "money"
                        required
                        autocomplete    = "off"
                        placeholder     = "<?php echo lang('balanceamount');?>"
                    />
                </div>
                <div>
                    <input 
                        type    = "radio" 
                        name    = "type"
                        id      = "visa"
                        value   = "visa" 
                        checked
                    />
                    <label for="visa"><i class="fa fa-cc-visa fa-2x"></i></label>
                    <input 
                        type    = "radio"
                        name    = "type"
                        id      = "mastercard"
                        value   = "mastercard" 
                    />
                    <label for="mastercard"><i class="fa fa-cc-mastercard fa-2x" aria-hidden="true"></i></label>
                </div>
                <div>
                    <input
                        type            = "text"
                        name            = "owner"
                        required
                        autocomplete    = "off"
                        placeholder     = "<?php echo lang('balanceowner');?>"
                        pattern         = "[A-Za-z ]+"
                    />
                </div>
                <div>
                    <input 
                        type            = "text"
                        name            = "number"
                        required
                        autocomplete    = "off"
                        pattern         = "[0-9]{16}"
                        placeholder     = "<?php echo lang('balancenumber');?>"
                    />
                </div>
                <div>
                    <input 
                        type            = "number"
                        name            = "month"
                        min             = "1"
                        max             = "12"
                        required
                        autocomplete    = "off"
                        placeholder     = "<?php echo lang('balancemonth');?>"
                    />
                    <input 
                        type            = "number"
                        name            = "year"
                        min             = "23"
                        max             = "99"
                        required
                        autocomplete    = "off"
                        placeholder     = "<?php echo lang('balanceyear');?>"
                    />
                </div>
                <div>
                    <input 
                        type            = "text"
                        name            = "Signature"
                        pattern         = "[0-9]{3}"
                        required
                        autocomplete    = "off"
                        placeholder     = "<?php echo lang('balancesignature');?>"
                    />
                </div>
                <div>
                    <input type="submit" value="<?php echo lang('balancepay');?>" />
                </div>
            </form>
        </div>
        
<?php require_once $templates . "/footer.inc" ?>