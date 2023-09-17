<?php
    require_once "init.php";
    $page_name = "Reservations";
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
        $car = $_POST['plate1'] . $_POST['plate2'];
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
        $duration = $_POST['duration'];
        $startTime =  strtotime("$start");
        $endTime = strtotime("+$duration hours",$startTime);
        $startTimeF = date("Y-m-d H:i:s", $startTime);
        $endTimeF = date("Y-m-d H:i:s", $endTime);
        // get the number of seat for shop from database
        $seat = $db -> prepare("SELECT seat FROM shops where shopname = :shop");
        $seat -> bindParam("shop", $mainShop);
        $seat -> execute();
        $seat = $seat -> fetchColumn();
        // set variable by default has value on
        $availableSeat = "on"; // this variable will used to know if available or no
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
            // cheack available seats
            if ($seat - $busy === 0):
                $availableSeat = "off"; // this variable will used to know if available or no
                header('refresh:5;url=inquiry');
                break;
            endif; // end cheack available seats
        endfor; // end check if duration is valid or no
        // check if there is variable called $availableSeat or no and has value on to insert data to database
        if (isset($availableSeat) && $availableSeat === "on"):
            // generate unique id
            $id = uniqid("", true);
            // get all ids from databases
            $ids = $db -> prepare("SELECT id FROM orders");
            $ids -> execute();
            $ids = $ids -> fetchAll(PDO::FETCH_COLUMN);
            // check if id is unique and regenered unique id
            while(in_array($id, $ids, true)):
                $id = uniqid("", true);
            endwhile; // end check if id is unique and regenered unique id
            // check if money is enough or no
            $money = $db -> prepare("SELECT money FROM users WHERE email = :email");
            $money -> bindParam("email", $_SESSION['username']);
            $money -> execute();
            $money = $money -> fetchColumn();
            $price = 4 * $duration; // cost of one hour is 4 pound
            $rest = $money - $price;
            if ($rest >= 0):
                // insert data to database
                $makeOrder = $db -> prepare("INSERT INTO orders (user, shop, id, start, end, duration, price, car_plate) Values (:user, :shop, :id, :start, :end, :duration, :price, :car)");
                $makeOrder -> bindParam("user", $_SESSION['username']);
                $makeOrder -> bindParam("shop", $mainShop);
                $makeOrder -> bindParam("id", $id);
                $makeOrder -> bindParam("start", $startTimeF);
                $makeOrder -> bindParam("end", $endTimeF);
                $makeOrder -> bindParam("duration", $duration);
                $makeOrder -> bindParam("price", $price);
                $makeOrder -> bindParam("car", $car);
                $makeOrder -> execute();
                // update money for user
                $newMoney = $db -> prepare("UPDATE users SET money = :money WHERE email = :email");
                $newMoney -> bindParam("money", $rest);
                $newMoney -> bindParam("email", $_SESSION['username']);
                $newMoney -> execute();
                // make session for order
                $_SESSION['orderid'] = $id;
                header("Location: mytrips");
                exit;
            else:
                $haveMoney = "off";
                header('refresh:5;url=balance');
            endif; // end check if money is enough or no
        endif; // end check if there is variable called $availableSeat or no and has value on to insert data to database
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

        <link rel="stylesheet" href="<?php echo $css_dir;?>/reservations.css" />
        <div class=container>
            <div class="periodoff">
                <?php
                    if (isset($availableSeat) && $availableSeat === "off"):
                        echo lang("reservationsm1") . lang("reservationsm2") . lang("reservationsm3");
                    elseif (isset($haveMoney) && $haveMoney === "off"):
                        echo lang("reservationsm4") . lang("reservationsm5") . lang("reservationsm6");
                    endif;
                ?>
            </div>
            <form action="reservations" method="post" class="reservationsform">
                <select name="shop" id="shop">
                    <option selected disabled value="choose location"><?php echo lang("reservationschoose");?></option>
                    <?php
                        foreach ($shops as $shop):
                            echo "<option value= '" . $shop . "'>" . $shop ."</option>";
                        endforeach;
                    ?>
                </select>
                <input 
                    type            = "datetime-local" 
                    name            = "start"
                    required
                    autocomplete    = "off"
                    id              = "start"
                    step            = "3600"
                />
                <input
                    type            = "number"
                    name            = "duration" 
                    id              = "duration"
                    min             = "1" 
                    max             = "6"
                    step            = "1"
                    placeholder    = "<?php echo lang('reservationsduration') ;?>"
                    required
                    autocomplete    = "off"
                />
                <label for="plate1"><?php echo lang('reservationscarplate') ;?></label>
                <input 
                    type            = "text"
                    name            = "plate1"
                    id              = "plate1"
                    class           = "plate1"
                    required
                    pattern         = "[1-9]{1,4}"
                    title           = "<?php echo lang('reservationsplate1title') ;?>"
                    autocomplete    = "off"
                    placeholder    = "Ex:1234"
                />
                <input 
                    type            = "text"
                    name            = "plate2"
                    class           = "plate2"
                    required
                    pattern         = "[أ-يء]{1,3}"
                    title           = "<?php echo lang('reservationsplate2title') ;?>"
                    autocomplete    = "off"
                    placeholder    = "Ex:سبب"
                />
                <div class="conditions">
                    <input type="checkbox" required />
                    <label><a id="conditions"><?php echo lang("reservationsconditions")?></a></label>
                </div>
                <input type="submit" value="<?php echo lang('reservationsbook')?>" id="book">
            </form>
        </div>

<?php require_once $templates . "/footer.inc" ?>
<script>
    var // variables
        book = document.getElementById('book'),
        shop = document.getElementById('shop'),
        start = document.getElementById('start'),
        duration = document.getElementById('duration'),
        conditions = document.getElementById('conditions')
    // functions
    function shopValidation() {
        "use stict";
        if (shop.value === "choose location") {
            shop.setCustomValidity("<?php echo lang("reservationschoosevalidate");?>");
        } else {
            shop.setCustomValidity("");
        }
    }
    function datetimeValidate() {
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
            start.setCustomValidity("<?php echo lang("reservationsdatetimevalidate");?>");
        }       
    }
    function durationValidate() {
        "use strict";
        console.log(duration);
        if (duration.value > 6 || duration.value < 1) {
            duration.setCustomValidity("<?php echo lang("reservationsdurationvalidate");?>");
        } else {
            duration.setCustomValidity('');
        }
    }
    function conditionsClick() {
        "use strict";
        open("conditions_<?php echo $main_lang?>", "", "width=400, height=400");
    }
    // events
    book.addEventListener("click", shopValidation);
    start.onchange = datetimeValidate;
    duration.onchange = durationValidate;
    conditions.onclick = conditionsClick;
</script>