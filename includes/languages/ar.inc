<?php
    function lang($pharse) {
        static $lang = array (
            // start of global
                # start navigation
                "globalhome"            => "الرئيسية",
                "globalreservations"    => "الحجز",
                "globalinquiry"         => "استعلام",
                "globalmytrips"         => "رحلاتي",
                "globalcontactus"       => "تواصل معنا",
                "globalaboutus"         => "نحن",
                # end navigation
            // end of global
            // Start page sign up
                "firstname"     => "الاسم الاول",
                "lastname"      => "اسم العائلة",
                "nametitle"     => "السماح فقط باستخدام الحروف العربية والإنجليزية.",
                "gender"        => "النوع",
                "male"          => "ذكر",
                "female"        => "انثي",
                "birthday"      => "تاريخ الميلاد",
                "phone"         => "رقم الهاتف",
                "phonetitle"    => "ادخل رقم هتفك ممكون من 11 رقم",
                "phoneexistm"   => "<p>رقم الهاتف هذا موجود من قبل</p>",
                "email"         => "البريد الالكتروني",
                "emailtitle"    => "ادخل البريد الالكتروني الصحيح",
                "emailnotvalidm"=> "<p>هذا البريد الإلكتروني غير صالح</p>",
                "emailexistm"   => "<p>هذا البريد الإلكتروني موجود من قبل</p>",
                "password"      => "كلمة السر",
                "passwordtitle" => "يجب ان تحتوي علي ارقام وحروف انجليزية كبيره وصغيره ولا تقل عن 8 احرف",
                "confirm"       => "تاكيد كلمة السر",
                "confirmtitle"  => "كلمة المرور غير متطابقة",
                "create"        => "انشاء حساب",
                "backtologin"   => "لدي حساب بالفعل",
            // End page sign up
            // start page validate_email
                "emailspam1"            => "تم ارسال رسالة الي بريدك الالكتروني تحتوي علي رمز التاكيد.",
                "emailspam2"            => "لو الرسالة مش موجود في صندوق الوارد او الاساسي، من المكن ان تكون في الرسال الغير مرغوب فيها.",
                "validateemailcode"     => "رمز التاكيد",
                "validateemailconfirm"  => "تاكيد",
                "validateemailcorrect1" => "<p>تم إنشاء البريد الإلكتروني.</p>",
                "validateemailcorrect2" => "<p>ستتم إعادة توجيهك في حوالي 5 ثوانٍ إلى صفحة تسجيل الدخول.</p>",
                "validateemailcorrect3" => "<p>اذا لم يكن كذلك، اضغط <a href='login'>هنا</a>.</p>",
                "validateemailincorrect"=> "<p>خطأ ، الرجاء إدخال الرمز الصحيح.</p>",
                "validateemailmessage1" => "<div style='direction:rtl;'><h1>مرحبا، <bdi>",
                "validateemailmessage2" => "</bdi></h1>",
                "validateemailmessage3" => "<p>انت تحاول إنشاء حساب علي SSP.</p>",
                "validateemailmessage4" => "<p>استخدم هذا الرمز لتأكيد حسابك:</p>",
                "validateemailmessage5" => "<p>شكرا لك.</p></div>",
            // end page validate_email
            // start page login [it take some variables of sign up]
                "loginrememberme"           => "تذكرني",
                "loginlogin"                => "تسجيل الدخول",
                "loginforgettenpasswort"    => "نسيت كلمة السر؟",
                "logincreatenewaccount"     => "انشاء حساب جديد",
                "loginemailnotexist"        => "<p>هذا البريد الالكتروني غير موجود</p>",
                "loginpasswordnotcorrect"   => "<p>كلمة السر غير صحيحه</p>",
            // end page login
            // start page change password
                "changepasswordcorrect1"        => "<p>تم تغيير كلمة السر</p>",
                "changepasswordcorrect2"        => "<p>ستتم إعادة توجيهك في حوالي 5 ثوانٍ إلى صفحة تسجيل الدخول.</p>",
                "changepasswordcorrect3"        => "<p>اذا لم يكن كذلك، اضغط <a href='login'>هنا</a>.</p>",
                "changepasswordpassword"        => "كلمة سر جديده",
                "changepasswordconfirm"         => "تاكيد كلمة السر",
                "changepasswordchange"          => "تغيير",
                "changepasswordconfirmtitle"    => "كلمة المرور غير متطابقة",
                "changepasswordpasswordtitle"   => "يجب ان تحتوي علي ارقام وحروف انجليزية كبيره وصغيره ولا تقل عن 8 احرف",
            // end page change password
            // start page forgetten password
                "foregettenpasswordnext" => "التالي",
            // end page forgetten password
            // start reservations page
                "reservationschoose"            => "اختار موقع",
                "reservationschoosevalidate"    => "لازم تختار موقع",
                "reservationsdatetimevalidate"  => "يمكن الحجز قبل الموعد علي الاقل ب 30 دقيقة",
                "reservationsdurationvalidate"  => "1 ساعة كحد أدنى و 3 ساعات كحد أقصى",
                "reservationsplate1title"       => "رقم كحد أدني و 4 ارقام كحد اقصي",
                "reservationsplate2title"       => "حرف عربي كحد ادني و 3 حروف كحد اقصي",
                "reservationscarplate"          => "رقم العربية",
                "reservationsconditions"        => "اوافق علي كل الشروط.",
                "reservationsbook"              => "احجز الان",
                "reservationsm1"                => "<p>هذه الفترة غير متوفرة.</p>",
                "reservationsm2"                => "<p>ستتم إعادة توجيهك في حوالي 5 ثوانٍ إلى صفحة الاستعلام.</p>",
                "reservationsm3"                => "<p>اذا لم يكن كذلك، اضغط <a href='inquiry'>هنا</a>.</p>",
                "reservationsm4"                => "<p>ليس لديك رصيد كافي.</p>",
                "reservationsm5"                => "<p>ستتم إعادة توجيهك في حوالي 5 ثوانٍ إلى صفحة الرصيد.</p>",
                "reservationsm6"                => "<p>اذا لم يكن كذلك، اضغط <a href='balance'>هنا</a>.</p>",
                "reservationsduration"          => "المدة",
            // end reservations page
            // start mytrips page
                "mytripscaption1"       => "تم الحجز",
                "mytripslocation"       => "الموقع",
                "mytripsid"             => "الرقم التعريفي",
                "mytripsstart"          => "من",
                "mytripsend"            => "الي",
                "mytripsduration"       => "المدة",
                "mytripsprice"          => "السعر",
                "mytripscarplate"       => "رقم العربية",
                "mytripsstatus"         => "الحالة",
                "mytripsall"            => "كل الرحلات",
                "mytripscoming"         => "الرحلات القادمة",
                "mytripsseeorders1"     => "انت تمتلك",
                "mytripsseeorders2"     => "طلب",
                "mytripsstatuscoming"   => "الاتي",
                "mytripsstatusrunning"  => "شغاله",
                "mytripsstatusdone"     => "تمت",
            // end mytrips page
            // start home page
                "homebalancem"          => "رصيدك",
                "homebalancelink"       => "اشحن",
                "homeaiprop"            => "يجب عليك تنشيط خاصية التعرف على الوجوه لتتمكن من استخدام خدمة وقوف السيارات الخاصة بنا.",
                "homeactive"            => "نشط الان",
                "homefopenwarn"         => "يجب أن تقف عند البوابة مباشرة لاستخدام هذه الخاصية.",
                "homefopen"             => "فتح اجباري للبوابة",
            // end home page
            // start balance page
                "balanceamount"             => "المبلغ",
                "balanceowner"              => "صاحب الكارت",
                "balancenumber"             => "رقم الكارت",
                "balancemonth"              => "شهر",
                "balanceyear"               => "سنة",
                "balancesignature"          => "التوقيع",
                "balancepay"                => "الدفع",
            // end balance page
            // start inquiry page
                "inquirychoose"                 => "اختار موقع",
                "inquiryinquiry"                => "استعلم الان",
                "inquirychoosevalidate"         => "لازم تختار موقع",
                "inquirydatetimevalidatestart"  => "يمكن الاستعلام قبل الموعد علي الاقل ب 30 دقيقة",
                "inquirydatetimevalidateend"    => "يجب أن تكون المدة ساعة واحدة على الأقل",
                "inquirystart"                  => "بداية المدة",
                "inquiryend"                    => "نهاية المدة",
                "inquiryfrom"                   => "من",
                "inquiryto"                     => "الي",
                "inquiryavailableslots"         => "اماكن متاحة",
            // end inquiry
            // start contactus page
                "contactustitle"    => "العنوان",
                "contactusmessage"  => "رسالتك",
                "contactussend"     => "ارسال",
            // end contactus page
            // start mysettings page
                "mysettingsactive"          => "نشط الان",
                "mysettingsfaceactive"      => "خاصية التعرف علي الوجه مفعلة",
                "mysettingsmodifyai"        => "عدل الان",
            // end mysettings page
        );
        return $lang[$pharse];
    }