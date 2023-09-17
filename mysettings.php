<?php
    require_once "init.php";
    $page_name = "Settings";
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
    // get some information from database to desplay for user
    $userInfo = $db -> prepare("SELECT * FROM users where email = :email");
    $userInfo -> bindParam("email", $_SESSION['username']);
    $userInfo -> execute();
    $userInfo = $userInfo -> fetch(PDO::FETCH_ASSOC);
    if ($_SERVER['REQUEST_METHOD'] === 'POST'):
        // check if user has folder
        $pathUploadedImages = $_SERVER['DOCUMENT_ROOT'] . "/data/uploads/images/" . $_SESSION['username'];
        if (!is_dir($pathUploadedImages)): // if not have
            mkdir($pathUploadedImages);
        endif; // end check if user has folder
        // make array for errors
        $errors = array();
        // count for image
        $imageCount = 1;
        // check if uploades data is images
        foreach($_FILES as $image):
            // check if not empty
            if($image['error'] === 4):
                $errors[] = "<div style='color:#F00;text-align:center'>Image$imageCount : you can't upload empty data</div>";
            endif; // end check if not empty
            // check allowed extension 
            $allowed_extensions = array("jpg", "jpeg", "png", "gif", "tiff", "pjp", "jfif", "bmp");
            $image_extension = strtolower(end(explode(".",$image['name'])));
            if(!in_array($image_extension, $allowed_extensions)):
                $errors[] = "<div style='color:#F00;text-align:center'>Image$imageCount : you can upload images only</div>";
            endif; // end check allowed extension 
            $imageCount++;
        endforeach; // end check if uploades data is images
        // check if there is any error in array
        if (empty($errors)):
            // count for image
            $imageCount = 1;
            foreach($_FILES as $image):
                $image_extension = strtolower(end(explode(".",$image['name'])));
                move_uploaded_file($image['tmp_name'],$pathUploadedImages . "/" . $imageCount . "." . $image_extension);
                $imageCount++;
            endforeach;
            // make ai enable
            $ai_enable = $db -> prepare("UPDATE users SET ai=:aiValue Where email=:user");
            $ai_enable -> bindValue("aiValue", 1);
            $ai_enable -> bindParam("user", $_SESSION['username']);
            $ai_enable -> execute();
        endif;
    endif;
?>
<?php require_once $templates . "/header.inc" ?>

        <link rel="stylesheet" href="<?php echo $css_dir;?>/mysettings.css" />
        <div class="container">
            <?php
                // chech if there is errors in array
                if(!empty($errors)):
                    foreach($errors as $error):
                        echo $error;
                    endforeach;
                endif; // chech if there is errors in array
                // check if user active ai property
                $aiProp = $userInfo['ai'];
                if($aiProp == 1):
                    echo "<div style='text-align:center;font-weight:bolder;margin:50px;'>";
                        echo "<P style='background-color:#0F8;margin:10px;padding:20px;'>";
                            echo lang("mysettingsfaceactive");
                        echo "</p>";
                        echo "<button style='background-color:#00F;padding:20px;color:#FFF;border-radius:20px;width:100%;' id='aiModify'>";
                            echo lang("mysettingsmodifyai");
                        echo "</button>";
                    echo "</div>";
                    echo "<form action='mysettings' method='post' enctype='multipart/form-data' class='activeForm' style='display:none'>";
                        echo "<figure>";
                            echo "<input type='file'  accept='image/*' name='image1' required  onchange='loadFile1(event)'>";
                            echo "<p><img id='output1' width='200' height='200' /></p>";
                        echo "</figure>";
                        echo "<figure>";
                            echo "<input type='file'  accept='image/*' name='image2' required  onchange='loadFile2(event)'>";
                            echo "<p><img id='output2' width='200' height='200'/></p>";
                        echo "</figure>";
                        echo "<figure>";
                            echo "<input type='file'  accept='image/*' name='image3' required  onchange='loadFile3(event)'>";
                            echo "<p><img id='output3' width='200' height='200' /></p>";
                        echo "</figure>";
                        echo "<input type='submit' value='" . lang("mysettingsmodifyai") . "' />";
                    echo "</form>";
                else:
                    echo "<form action='mysettings' method='post' enctype='multipart/form-data' class='activeForm'>";
                        echo "<figure>";
                            echo "<input type='file'  accept='image/*' name='image1' required  onchange='loadFile1(event)'>";
                            echo "<p><img id='output1' width='200' height='200' /></p>";
                        echo "</figure>";
                        echo "<figure>";
                            echo "<input type='file'  accept='image/*' name='image2' required  onchange='loadFile2(event)'>";
                            echo "<p><img id='output2' width='200' height='200'/></p>";
                        echo "</figure>";
                        echo "<figure>";
                            echo "<input type='file'  accept='image/*' name='image3' required  onchange='loadFile3(event)'>";
                            echo "<p><img id='output3' width='200' height='200' /></p>";
                        echo "</figure>";
                        echo "<input type='submit' value='" . lang("mysettingsactive") . "' />";
                    echo "</form>";
                endif;// end check if user active ai property
            ?>
        </div>
        
<?php require_once $templates . "/footer.inc" ?>
<script>
    // functions
    var loadFile1 = function(event) {
        var image = document.getElementById('output1');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
    var loadFile2 = function(event) {
        var image = document.getElementById('output2');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
    var loadFile3 = function(event) {
        var image = document.getElementById('output3');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
    $("#aiModify").click(function(){
        $("form.activeForm").toggle();
    });
</script>