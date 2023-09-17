<?php
    function lang($pharse) {
        static $lang = array (
            // start of global
                # start navigation
                "globalhome"            => "Home",
                "globalreservations"    => "Reservations",
                "globalinquiry"         => "Inquiry",
                "globalmytrips"         => "My Trips",
                "globalcontactus"       => "Contact Us",
                "globalaboutus"         => "About Us",
                # end navigation
            // end of global
            // Start page sign up
                "firstname"     => "First Name",
                "lastname"      => "Last Name",
                "nametitle"     => "Allow only to use arabic and english alphabet",
                "gender"        => "Gender",
                "male"          => "Male",
                "female"        => "Female",
                "birthday"      => "Birth Day",
                "phone"         => "Phone",
                "phonetitle"    => "Enter your phone that combine from 11 number",
                "phoneexistm"   => "<p>This phone number is exist before</p>",
                "email"         => "Email",
                "emailtitle"    => "Enter correct email",
                "emailnotvalidm"=> "<p>This email is not valid</p>",
                "emailexistm"   => "<p>This email is exist before</p>", 
                "password"      => "Password",
                "passwordtitle" => "Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters",
                "confirm"       => "Confirm password",
                "confirmtitle"  => "Password Don't Match",
                "create"        => "Create Account",
                "backtologin"   => "I have already account",
            // End page sign up
            // start page validate_email
                "emailspam1"            => "A message has been sent to your email containing a confirmation code.",
                "emailspam2"            => "If the message is not in inbox or primary, it may be in spam or junk.",
                "validateemailcode"     => "Your code",
                "validateemailconfirm"  => "Confirm",
                "validateemailcorrect1" => "<p>Email is created</p>",
                "validateemailcorrect2" => "<p>You'll be redirected in about 5 secs to login page.</p>",
                "validateemailcorrect3" => "<p>If not, click <a href='login'>here</a>.</p>",
                "validateemailincorrect"=> "<p>Wrong, please enter correct code.</p>",
                "validateemailmessage1" => "<h1>hi, <bdi>",
                "validateemailmessage2" => "</bdi></h1>",
                "validateemailmessage3" => "<p>You try to create account in SSP.</p>",
                "validateemailmessage4" => "<p>Use this code for confirm your account:</p>",
                "validateemailmessage5" => "<p>Thank you.</p>",
            // end page validate_email
            // start page login [it take some variables of sign up]
                "loginrememberme"           => "Remember me",
                "loginlogin"                => "Login",
                "loginforgettenpasswort"    => "Forgetten password?",
                "logincreatenewaccount"     => "Create new Account",
                "loginemailnotexist"        => "<p>This email is not exist</p>",
                "loginpasswordnotcorrect"   => "<p>This password is incorrect</p>",
            // end page login
            // start page change password
                "changepasswordcorrect1"        => "<p>Password is changed</p>",
                "changepasswordcorrect2"        => "<p>You'll be redirected in about 5 secs to login page.</p>",
                "changepasswordcorrect3"        => "<p>If not, click <a href='login'>here</a>.</p>",
                "changepasswordpassword"        => "New password",
                "changepasswordconfirm"         => "Confirm password",
                "changepasswordchange"          => "Change",
                "changepasswordconfirmtitle"    => "Password Don't Match",
                "changepasswordpasswordtitle"   => "Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters",
            // end page change password
            // start page forgetten password
                "foregettenpasswordnext" => "Next",
            // end page forgetten password
            // start reservations page
                "reservationschoose"            => "Choose location",
                "reservationschoosevalidate"    => "Must choose location",
                "reservationsdatetimevalidate"  => "It is possible to book at least 30 minutes before the appointment",
                "reservationsdurationvalidate"  => "min 1 hour and max 3 hours",
                "reservationsplate1title"       => "min 1 number max 4 number",
                "reservationsplate2title"       => "min 1 arabic letter max 4 arabic letter",
                "reservationscarplate"          => "Car plate",
                "reservationsconditions"        => "I agree to all the conditions",
                "reservationsbook"              => "Book Now",
                "reservationsm1"                => "<p>This period is not available.</p>",
                "reservationsm2"                => "<p>You'll be redirected in about 5 secs to inquiry page.</p>",
                "reservationsm3"                => "<p>If not, click <a href='inquiry'>here</a>.</p>",
                "reservationsm4"                => "<p>You don't have enough balance.</p>",
                "reservationsm5"                => "<p>You'll be redirected in about 5 secs to balance page.</p>",
                "reservationsm6"                => "<p>If not, click <a href='balance'>here</a>.</p>",
                "reservationsduration"          => "Duration",
            // end reservations page
            // start mytrips page
                "mytripscaption1"       => "reservation is done",
                "mytripslocation"       => "Location",
                "mytripsid"             => "ID",
                "mytripsstart"          => "Start",
                "mytripsend"            => "End",
                "mytripsprice"          => "Price",
                "mytripsduration"       => "Duration",
                "mytripscarplate"       => "Car plate",
                "mytripsstatus"         => "Status",
                "mytripsall"            => "All Trips",
                "mytripscoming"         => "Coming Trips",
                "mytripsseeorders1"     => "You have",
                "mytripsseeorders2"     => "orders",
                "mytripsstatuscoming"   => "Coming",
                "mytripsstatusrunning"  => "Running",
                "mytripsstatusdone"     => "Done",
            // end mytrips page
            // start home page
                "homebalancem"          => "Your balance",
                "homebalancelink"       => "Charge",
                "homeaiprop"            => "You must activate face recognition property to can use our parking service.",
                "homeactive"            => "Active Now",
                "homefopenwarn"         => "You must stand at gate directly to use this property.",
                "homefopen"             => "Forced opening of the gate",
            // end home page
            // start balance page
                "balanceamount"             => "Amount",
                "balanceowner"              => "Card Owner",
                "balancenumber"             => "Card Number",
                "balancemonth"              => "Month",
                "balanceyear"               => "Year",
                "balancesignature"          => "Signature",
                "balancepay"                => "Pay",
            // end balance page
            // start inquiry page
                "inquirychoose"                 => "Choose location",
                "inquiryinquiry"                => "Inquiry Now",
                "inquirychoosevalidate"         => "Must choose location",
                "inquirydatetimevalidatestart"  => "It is possible to inquiry at least 30 minutes before the appointment",
                "inquirydatetimevalidateend"    => "Duration must be at least one hour",
                "inquirystart"                  => "Start of Duration",
                "inquiryend"                    => "End of Duration",
                "inquiryfrom"                   => "From",
                "inquiryto"                     => "To",
                "inquiryavailableslots"         => "Available Slots",
            // end inquiry
            // start contactus page
                "contactustitle"    => "Title",
                "contactusmessage"  => "Your Message",
                "contactussend"     => "Send",
            // end contactus page
            // start mysettings page
                "mysettingsactive"          => "Active Now",
                "mysettingsfaceactive"      => "Face recognition property is active",
                "mysettingsmodifyai"        => "Modify Now",
            // end mysettings page
        );
        return $lang[$pharse];
    }