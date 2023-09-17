<?php
    require_once "init.php";
    $page_name = "My Trips";
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
    // start check if there is request for cancel
    if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['cancel'])):
        $cancelOrder = $db -> prepare("DELETE FROM orders WHERE id = :id");
        $cancelOrder -> bindParam("id", $_POST['cancel']);
        $cancelOrder -> execute();
        if(isset($_POST['newprice'])):
            $price = $db -> prepare("UPDATE users SET money = money + :money WHERE email = :email");
            $price -> bindParam("money", $_POST['newprice']);
            $price -> bindParam("email", $_SESSION['username']);
            $price -> execute();
        endif;
        header("Location: mytrips");
        exit;
    endif; // end check if there is request for cancel
    $orderDone = "off"; // used for show if resernation is done or not care 
    // check if there session called orderid
    if (isset($_SESSION['orderid'])):
        $order = $db -> prepare("SELECT shop, start, end, duration, price, car_plate FROM orders WHERE id = :id");
        $order -> bindParam("id", $_SESSION['orderid']);
        $order -> execute();
        $order = $order -> fetch(PDO::FETCH_ASSOC);
        $orderDone = "on";
        $orderId = $_SESSION['orderid'];
        unset($_SESSION['orderid']);
    endif;
    $seeOrders = "off"; // this variable to check if user want to show his trips
    // check if request method is post to get data
    if($_SERVER['REQUEST_METHOD'] === "POST"):
        // check if he want to show all or coming only
        if($_POST['orders'] === "all"): // if all
            $allOrders = $db -> prepare("SELECT shop, id, start, end, duration, price, car_plate FROM orders WHERE user = :user");
            $allOrders -> bindParam("user", $_SESSION['username']);
            $allOrders -> execute();
            $ordersNumber = $allOrders -> rowCount();
            $allOrders = $allOrders -> fetchAll(PDO::FETCH_ASSOC);
            $seeOrders = "on";
            $seeCaption = lang("mytripsall");
        else:
            $allOrders = $db -> prepare("SELECT shop, id, start, end, duration, price, car_plate FROM orders WHERE user = :user && start >= :currentTime");
            $allOrders -> bindParam("user", $_SESSION['username']);
            $allOrders -> bindParam("currentTime", date("Y-m-d H:i:s"));
            $allOrders -> execute();
            $ordersNumber = $allOrders -> rowCount();
            $allOrders = $allOrders -> fetchAll(PDO::FETCH_ASSOC);
            $seeOrders = "on";
            $seeCaption = lang("mytripscoming");
        endif;// end check if he want to show all or coming only
    endif;
?>
<?php require_once $templates . "/header.inc" ?>

        <link rel="stylesheet" href="<?php echo $css_dir;?>/mytrips.css" />
        <div class="container">
            <form action="mytrips" method="post" class="all">
                <input type="hidden" name="orders" value="all" />
                <input type="submit" value="<?php echo lang('mytripsall')?>">
            </form>
            <form action="mytrips" method="post" class="coming">
                <input type="hidden" name="orders" value="coming" />
                <input type="submit" value="<?php echo lang('mytripscoming')?>">
            </form>
            <?php
                if ($orderDone === "on"):
                    echo "<table>";
                        echo "<caption>" . lang("mytripscaption1") .  "</caption>";
                        echo "<thead>";
                            echo "<tr>";
                                echo "<th>" . lang("mytripslocation") . "</th>";
                                echo "<th>" . lang("mytripsstart") . "</th>";
                                echo "<th>" . lang("mytripsend") . "</th>";
                                echo "<th>" . lang("mytripsduration") . "</th>";
                                echo "<th>" . lang("mytripsprice") . "</th>";
                                echo "<th>" . lang("mytripscarplate") . "</th>";
                                echo "<th>" . lang("mytripsstatus") . "</th>";
                            echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                            echo "<tr>";
                                $currentTime = time();
                                $startTime = strtotime($order['start']);
                                $endTime = strtotime($order['end']);
                                foreach($order as $key => $data):
                                    // check if lang en or ar to make location aribic if ar
                                    if($key === "shop" && $main_lang === "ar"):
                                        $shopname_ar = $db->prepare("SELECT shopname_ar FROM shops WHERE shopname = :shop");
                                        $shopname_ar -> bindParam("shop", $data);
                                        $shopname_ar -> execute();
                                        $data = $shopname_ar -> fetchColumn();
                                    endif;// check if lang en or ar to make location aribic if ar
                                    echo "<td>" . $data . "</td>";
                                endforeach;
                                // check for status
                                if($startTime > $currentTime): // status is coming
                                    echo "<td>"; 
                                        echo lang("mytripsstatuscoming");
                                        echo "<form action='mytrips' method='post' class='cancelStatus'>";
                                            echo "<input type='hidden' name='cancel' value='$orderId' />";
                                            // check for the rest time
                                            if($startTime - $currentTime > 172800): // if time greate than 48 hours, he will take all money
                                                $newPrice = $order['price'];
                                                echo "<input type='hidden' name='newprice' value='$newPrice' />";
                                            elseif($startTime - $currentTime > 86400): // if time greate than 24 hours, he will take 0.75 of money
                                                $newPrice = $order['price'] * 0.75;
                                                echo "<input type='hidden' name='newprice' value='$newPrice' />";
                                            endif; // end check for the rest time
                                            echo "<input type='submit' value='X' />";
                                        echo "</form>";
                                    echo "</td>";
                                elseif($endTime > $currentTime): // status is running
                                    echo "<td>" . lang("mytripsstatusrunning") . "</td>";
                                else: // status is done
                                    echo "<td>" . lang("mytripsstatusdone") . "</td>";
                                endif;// end check for status
                            echo "</tr>";
                        echo "</tbody>";
                    echo "</table>";
                endif;
            ?>
            <?php
                if ($seeOrders === "on"):
                    echo "<p class='message'>". lang("mytripsseeorders1") . " <span>" . $ordersNumber . "</span> " . lang("mytripsseeorders2") ."</p>";
                    echo "<table>";
                        echo "<caption>" . $seeCaption .  "</caption>";
                        echo "<thead>";
                            echo "<tr>";
                                echo "<th>" . lang("mytripslocation") . "</th>";
                                echo "<th>" . lang("mytripsstart") . "</th>";
                                echo "<th>" . lang("mytripsend") . "</th>";
                                echo "<th>" . lang("mytripsduration") . "</th>";
                                echo "<th>" . lang("mytripsprice") . "</th>";
                                echo "<th>" . lang("mytripscarplate") . "</th>";
                                echo "<th>" . lang("mytripsstatus") . "</th>";
                            echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                                foreach($allOrders as $order):
                                    echo "<tr>";
                                        $currentTime = time();
                                        $startTime = strtotime($order['start']);
                                        $endTime = strtotime($order['end']);
                                        $orderId = $order['id'];
                                        foreach($order as $key => $data):
                                            // check if key is id, if is id skip it
                                            if($key === "id"):
                                                continue;
                                            endif; // check if key is id, if is id skip it
                                            // check if lang en or ar to make location aribic if ar
                                            if($key === "shop" && $main_lang === "ar"):
                                                $shopname_ar = $db->prepare("SELECT shopname_ar FROM shops WHERE shopname = :shop");
                                                $shopname_ar -> bindParam("shop", $data);
                                                $shopname_ar -> execute();
                                                $data = $shopname_ar -> fetchColumn();
                                            endif;// check if lang en or ar to make location aribic if ar
                                            echo "<td>" . $data . "</td>";
                                        endforeach;
                                        // check for status
                                        if($startTime > $currentTime): // status is coming
                                            echo "<td>"; 
                                                echo lang("mytripsstatuscoming");
                                                echo "<form action='mytrips' method='post' class='cancelStatus'>";
                                                    echo "<input type='hidden' name='cancel' value='$orderId' />";
                                                    // check for the rest time
                                                    if($startTime - $currentTime > 172800): // if time greate than 48 hours, he will take all money
                                                        $newPrice = $order['price'];
                                                        echo "<input type='hidden' name='newprice' value='$newPrice' />";
                                                    elseif($startTime - $currentTime > 86400): // if time greate than 24 hours, he will take 0.75 of money
                                                        $newPrice = $order['price'] * 0.75;
                                                        echo "<input type='hidden' name='newprice' value='$newPrice' />";
                                                    endif; // end check for the rest time
                                                    echo "<input type='submit' value='X' />";
                                                echo "</form>";
                                            echo "</td>";
                                        elseif($endTime > $currentTime): // status is running
                                            echo "<td>" . lang("mytripsstatusrunning") . "</td>";
                                        else: // status is done
                                            echo "<td>" . lang("mytripsstatusdone") . "</td>";
                                        endif;// end check for status
                                    echo "</tr>";
                                endforeach;
                        echo "</tbody>";
                    echo "</table>";
                endif;
            ?>
        </div>
<?php require_once $templates . "/footer.inc" ?>