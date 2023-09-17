<?php
    require_once "init.php";
    $page_name = "Home";
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
    // check if there any submit for use fopen
    if($_SERVER['REQUEST_METHOD'] === 'POST'):
        $_SESSION['fopen'] = "yes";
        $_SESSION['id'] = $_POST['id'];
        $_SESSION['pageexpire'] = time() + (60 * 10); // expire for 10 mint
        header('Location: ai/demo');
        exit;
    endif; // end check if there any submit for use fopen
    // get some information from database to desplay for user
    $userInfo = $db -> prepare("SELECT * FROM users where email = :email");
    $userInfo -> bindParam("email", $_SESSION['username']);
    $userInfo -> execute();
    $userInfo = $userInfo -> fetch(PDO::FETCH_ASSOC);
    // chech if there current orders for user to use force open method
    $currentOrders = $db -> prepare("SELECT * FROM orders WHERE user = :user && start <= :current && end > :current && fopen = :fopen");
    $currentOrders -> bindParam("user", $_SESSION['username']);
    $currentOrders -> bindParam("current", date("Y-m-d H:i:s"));
    $currentOrders -> bindValue("fopen", "closed");
    $currentOrders -> execute();
    $currentOrdersCount = $currentOrders -> rowCount();
    $currentOrders = $currentOrders -> fetchAll(PDO::FETCH_ASSOC);
    // end chech if there current orders order for user to use force open method
?>
<?php require_once $templates . "/header.inc" ?>

        <link rel="stylesheet" href="<?php echo $css_dir;?>/home.css" />
        <main>
            <div class="container">
                <?php
                    // check if user active ai property
                    $aiProp = $userInfo['ai'];
                    if($aiProp == 1):
                        // check if there are any current orders or no
                        if ($currentOrdersCount > 0):
                            // generate div for each order
                            foreach ($currentOrders as $currentOrder):
                                $currentShopName = $currentOrder['shop'];
                                if($main_lang === "ar"):
                                    $shopname_ar = $db->prepare("SELECT shopname_ar FROM shops WHERE shopname = :shop");
                                    $shopname_ar -> bindParam("shop", $currentShopName);
                                    $shopname_ar -> execute();
                                    $currentShopName = $shopname_ar -> fetchColumn();
                                endif;// check if lang en or ar to make location aribic if ar
                                echo "<form action='.' method='POST' class='fopen'>";
                                    echo "<p>". lang('homefopenwarn') ."</p>";
                                    echo "<p>" . $currentShopName . "</p>";
                                    echo "<p>" . $currentOrder['start'] . " >> " . $currentOrder['end'] . "</p>";
                                    echo "<p>" . $currentOrder['car_plate'] . "</p>";
                                    echo "<input type='hidden' name='id' value='" . $currentOrder['id'] . "'/>";
                                    echo "<input type='submit' value='" . lang("homefopen") . "' />";
                                echo "</form>";
                            endforeach; // end generate div for each order
                        endif; // end check if there are any current orders or no
                    else:
                        echo "<div class='ai'>";   
                            echo "<p>" . lang("homeaiprop") . "</p>";
                            echo "<a href='mysettings'>" . lang("homeactive") . "</a>";
                        echo "</div>";      
                    endif;// end check if user active ai property
                ?>
                <div class="info">
                    <p><i class="fa fa-user fa-lg fa-fw"></i> <?php echo $userInfo['name'] ;?></p>
                    <p><i class="fa fa-envelope fa-lg fa-fw"></i> <?php echo $userInfo['email'] ;?></p>
                    <p><i class="fa fa-birthday-cake fa-lg fa-fw"></i>  <?php echo $userInfo['birthday'] ;?></p>
                    <p><i class="fa fa-phone-square fa-lg fa-fw"></i> <?php echo $userInfo['phone'] ;?></p>
                </div>
                <div class="balance">
                    <div class="border">
                        <p class="one"><?php echo lang("homebalancem") ;?></p>
                        <p class="two"><?php echo $userInfo['money'];?> EGP</p>
                        <a href="balance"><?php echo lang("homebalancelink") ;?></a>
                    </div>
                </div>
            </div>
        </main>
        
<?php require_once $templates . "/footer.inc" ?>