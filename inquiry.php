<?php
    require_once "init.php";
    $page_name = "Inquiry";
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
        // check if lang en or ar to make shopname english
        $mainShop = $_POST['shop'];
        if ($main_lang === "ar"):
            $shopname = $db->prepare("SELECT shopname FROM shops WHERE shopname_ar = :shop");
            $shopname -> bindParam("shop", $mainShop);
            $shopname -> execute();
            $mainShop = $shopname -> fetchColumn();
        endif; // check if lang en or ar to make shopname english
        // set initialize time period
        $start = str_replace("T", " ", $_POST['start']);
        $end = str_replace("T", " ", $_POST['end']);
        $startTime =  strtotime("$start");
        $endTime =  strtotime("$end");
        $startTimeF = date("Y-m-d H:i:s", $startTime);
        $endTimeF = date("Y-m-d H:i:s", $endTime);
        // get the number of seat for shop from database
        $seat = $db -> prepare("SELECT seat FROM shops where shopname = :shop");
        $seat -> bindParam("shop", $mainShop);
        $seat -> execute();
        $seat = $seat -> fetchColumn();
        // set variable to show table
        $showTable = "on";
    endif; // end check if request method is post
    // check if lang en or ar to fetch data from table
    if ($main_lang === "en"):
        $shops = $db -> prepare("SELECT shopname FROM shops");
    else:
        $shops = $db -> prepare("SELECT shopname_ar FROM shops");
    endif; // check if lang en or ar to fetch data from table
    $shops -> execute();
    $shops = $shops -> fetchAll(PDO::FETCH_COLUMN);
    sort($shops, SORT_REGULAR);
?>
<?php require_once $templates . "/header.inc" ?>

        <link rel="stylesheet" href="<?php echo $css_dir;?>/inquiry.css" />
        <div class=container>
            <form action="inquiry" method="post" class="inquiryform">
                <select name="shop" id="shop">
                    <option selected disabled value="choose location"><?php echo lang("inquirychoose");?></option>
                    <?php
                        foreach ($shops as $shop):
                            echo "<option value= '" . $shop . "'>" . $shop ."</option>";
                        endforeach;
                    ?>
                </select>
                <label><?php echo lang("inquirystart");?></label>
                <input 
                    type            = "datetime-local" 
                    name            = "start"
                    required
                    autocomplete    = "off"
                    id              = "start"
                    step            = "3600"
                />
                <label><?php echo lang("inquiryend");?></label>
                <input 
                    type            = "datetime-local" 
                    name            = "end"
                    required
                    autocomplete    = "off"
                    id              = "end"
                    step            = "3600"
                />
                <input type="submit" value="<?php echo lang('inquiryinquiry');?>" id="inquiry">
            </form>
            <?php
                // check if there is variable called show table
                if(isset($showTable) && $showTable === "on"):
                    echo "<table>";
                        echo "<caption>" . $startTimeF . " - " . $endTimeF . "</caption>";
                        echo "<thead>";
                            echo "<tr>";
                                echo "<th>". lang("inquiryfrom") ."</th>";
                                echo "<th>". lang("inquiryto") ."</th>";
                                echo "<th>". lang("inquiryavailableslots") ."</th>";;
                            echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                            // start for check if duration is valid or no
                            for($startDTime = $startTime ; $startDTime < $endTime;$startDTime = $endDTime):
                                $endDTime = strtotime("+1 hour",$startDTime);
                                $startDF = date("Y-m-d H:i:s", $startDTime);
                                $endDF = date("Y-m-d H:i:s", $endDTime);
                                // check no of reservation in database through certain period
                                $stat = $db -> prepare("SELECT number FROM orders Where shop = :shop && start <= :startDF && end >= :endDF");
                                $stat -> bindParam("shop", $mainShop);
                                $stat -> bindParam("startDF", $startDF);
                                $stat -> bindParam("endDF", $endDF);
                                $stat -> execute();
                                $busy = $stat -> rowCount();
                                $available = $seat - $busy;
                                if($available === 0):
                                    $zero = "class='zero'";
                                else:
                                    $zero = "";
                                endif;
                                echo "<tr>";
                                    echo "<td $zero>" . $startDF . "</td>";
                                    echo "<td $zero>" . $endDF . "</td>";
                                    echo "<td $zero>" . $available . "</td>";
                                echo "</tr>";
                            endfor; // end check if duration is valid or no
                        echo "</tbody>";
                    echo "</table>";
                endif; //end check if there is variable called show table
            ?>
        </div>
        
<?php require_once $templates . "/footer.inc" ?>
<script>
    var // variables
        inquiry = document.getElementById('inquiry'),
        shop = document.getElementById('shop'),
        start = document.getElementById('start'),
        end = document.getElementById('end')
    // functions
    function shopValidation() {
        "use stict";
        if (shop.value === "choose location") {
            shop.setCustomValidity("<?php echo lang("inquirychoosevalidate");?>");
        } else {
            shop.setCustomValidity("");
        }
    }
    function datetimeValidateStart() {
        "use strict";
        var
            currentDateTime = new Date(),
            startContent = start.value,
            clientDatetime;
        startContent = startContent.replace(/:[0-9][0-9]/, ":00");
        start.value = startContent;
        clientDatetime = new Date(startContent);
        if (clientDatetime.getTime() - currentDateTime.getTime() > 1800000) {
            start.setCustomValidity("");
        } else {
            start.setCustomValidity("<?php echo lang("inquirydatetimevalidatestart");?>");
        }       
    }
    function datetimeValidateEnd() {
        "use strict";
        var
            startContent = start.value,
            endContent = end.value,
            clientDatetimeStart,
            clientDatetimeEnd;
        startContent = startContent.replace(/:[0-9][0-9]/, ":00");
        endContent = endContent.replace(/:[0-9][0-9]/, ":00");
        end.value = endContent;
        clientDatetimeStart = new Date(startContent);
        clientDatetimeEnd = new Date(endContent);
        if (clientDatetimeEnd.getTime() - clientDatetimeStart.getTime() >= 3600000) {
            end.setCustomValidity("");
        } else {
            end.setCustomValidity("<?php echo lang("inquirydatetimevalidateend");?>");
        }       
    }
    // events
    inquiry.addEventListener("click", shopValidation);
    start.onchange = datetimeValidateStart;
    end.onchange = datetimeValidateEnd;
</script>