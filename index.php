<?php

   
   // Connect database
   include('includes/dbconnect.php');

   // Take data from Form and insert into database
   try{
        if(isset($_POST['submit'])){

           $ipaddress  = $_POST['ipaddress'];
            $website    =$_POST['website'];

            foreach($website as $webs) {

                $stmt=$db_con->prepare("INSERT INTO ipblock (ip, website, status) VALUES(:ip, :website, 'disallow')");
                $stmt->bindParam(":ip", $ipaddress);
                $stmt->bindParam(":website", $webs);
                $stmt->execute();

                if ($stmt == 1) {
                    $success = "IP has been blocked.";
                } else {
                    // echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }
        }
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
    
?>



    <!DOCTYPE html>
    <html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="robots" content="noindex, nofollow">
        <title>Block IP</title>
        <!-- Latest compiled and minified CSS -->
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
        <style>
        body,
        html {
            height: 100%;
            background-repeat: no-repeat;
            background-image: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));
        }

        .card-container.card {
            max-width: 450px;
            padding: 40px 40px;
        }

        .btn {
            font-weight: 700;
            height: 36px;
            -moz-user-select: none;
            -webkit-user-select: none;
            user-select: none;
            cursor: default;
        }
        /*
 * Card component
 */

        .card {
            background-color: #F7F7F7;
            /* just in case there no content*/
            padding: 20px 25px 30px;
            margin: 0 auto 25px;
            margin-top: 50px;
            /* shadows and rounded borders */
            -moz-border-radius: 2px;
            -webkit-border-radius: 2px;
            border-radius: 2px;
            -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.2);
        }

        .profile-img-card {
            width: 96px;
            height: 96px;
            margin: 0 auto 10px;
            display: block;
            -moz-border-radius: 50%;
            -webkit-border-radius: 50%;
            border-radius: 50%;
        }
        /*
 * Form styles
 */

        .profile-name-card {
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            margin: 10px 0 0;
            min-height: 1em;
        }

        .reauth-email {
            display: block;
            color: #404040;
            line-height: 2;
            margin-bottom: 10px;
            font-size: 14px;
            text-align: center;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        .form-signin #inputEmail,
        .form-signin #inputPassword {
            direction: ltr;
            height: 44px;
            font-size: 16px;
        }

        .form-signin input[type=email],
        .form-signin input[type=password],
        .form-signin input[type=text],
        .form-signin button {
            width: 100%;
            display: block;
            margin-bottom: 10px;
            z-index: 1;
            position: relative;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        .form-signin .form-control:focus {
            border-color: rgb(104, 145, 162);
            outline: 0;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgb(104, 145, 162);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgb(104, 145, 162);
        }

        .btn.btn-signin {
            /*background-color: #4d90fe; */
            background-color: rgb(104, 145, 162);
            /* background-color: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));*/
            padding: 0px;
            font-weight: 700;
            font-size: 14px;
            height: 36px;
            -moz-border-radius: 3px;
            -webkit-border-radius: 3px;
            border-radius: 3px;
            border: none;
            -o-transition: all 0.218s;
            -moz-transition: all 0.218s;
            -webkit-transition: all 0.218s;
            transition: all 0.218s;
        }

        .btn.btn-signin:hover,
        .btn.btn-signin:active,
        .btn.btn-signin:focus {
            background-color: rgb(12, 97, 33);
        }

        .forgot-password {
            color: rgb(104, 145, 162);
        }

        .forgot-password:hover,
        .forgot-password:active,
        .forgot-password:focus {
            color: rgb(12, 97, 33);
        }
        
        .open>.dropdown-menu {
        	display: block;
    		max-height: 250px;
    		overflow: auto;
        }
        </style>
    </head>
    <!-- Bootstrap core CSS -->
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->

    <body>
        <div class="container">
            <div class="card card-container">
                <h3 class="text-center" style="text-transform:uppercase;font-weight: bold;">Enter User IP To Block </h3>
                <p style="color:#060; font-weight:bold; text-align:center">
                    <?php  echo $success; ?>
                </p>
                <img id="profile-img" class="profile-img-card" src="includes/ip.png" />
                <p id="profile-name" class="profile-name-card"></p>
                <form class="form-signin" method="post" id="framework_form">
                    <!-- <span id="reauth-email" class="reauth-email"></span> -->
                    <div class="form-group">
                        <input type="text" id="inputEmail" name="ipaddress" class="form-control" placeholder="Enter IP Address" required autofocus maxlength="15">
                    </div>
                    <div class="form-group">
                        <select name="website[]" class="form-control" multiple id="websites" required size="4">
                            <option value="all" id="all">Select All</option>
                            <option value="supportnumbers">supportnumbers.com</option>
                            <option value="babasupportorg">babasupport.org</option>
                            <option value="mapsupdates">mapsupdates.org</option>
                            <option value="printersrepairnearme">printersrepairnearme.com</option>
                            <option value="emailsupportnumber">emailsupportnumber.org</option>
                            <option value="appletechsupportnumbernet">appletechsupportnumber.net</option>
                            <option value="antivirussupportnumberorg">antivirussupportnumber.org</option>
                            <option value="msofficesupportnumberorg">msofficesupportnumber.org</option>
                            <option value="routertechsupportnet">routertechsupport.net</option>
                            <option value="browsersupportnumberscom">browsersupportnumbers.com</option>
                            <option value="hptechnicalsupportnumbercouk">hptechnicalsupportnumber.co.uk</option>
                            <option value="applemactechnicalsupportnumbercouk">applemactechnicalsupportnumber.co.uk</option>
                            <option value="hpprintersupportnumberscouk">hpprintersupportnumbers.co.uk</option>
                            <option value="brotherprintersupportnumbercouk">brotherprintersupportnumber.co.uk</option>
                            <option value="canonprintersupportnumbercouk">canonprintersupportnumber.co.uk</option>
                            <option value="antivirussupportphonenumbercouk">antivirussupportphonenumber.co.uk</option>
                            <option value="appletechnicalsupportnumberscom">appletechnicalsupportnumbers.com</option>
                            <option value="avgantivirussupportnumbercom">avgantivirussupportnumber.com</option>
                            <option value="belkinroutersupportnumbercom">belkinroutersupportnumber.com</option>
                            <option value="bitdefenderantivirussupportnumbercom">bitdefenderantivirussupportnumber.com</option>
                            <option value="applemacsupportnumberscom">applemacsupportnumbers.com</option>
                            <option value="browsertechnicalsupportnumberscom">browsertechnicalsupportnumbers.com</option>
                            <option value="canonprintersupportnumberscom">canonprintersupportnumbers.com</option>
                            <option value="hpetechnicalsupportnumbercom">hpetechnicalsupportnumber.com</option>
                            <option value="hptechsupportnumberscom">hptechsupportnumbers.com</option>
                            <option value="kasperskyantivirussupportnumbercom">kasperskyantivirussupportnumber.com</option>
                            <option value="linksysroutersupportnumbercom">linksysroutersupportnumber.com</option>
                            <option value="mactechnicalsupportnumberscom">mactechnicalsupportnumbers.com</option>
                            <option value="msofficetechnicalsupportnumberscom">msofficetechnicalsupportnumbers.com</option>
                            <option value="mcafeeantivirussupportnumberscom">mcafeeantivirussupportnumbers.com</option>
                            <option value="netgearroutersupportnumbercom">netgearroutersupportnumber.com</option>
                            <option value="outlooktechnicalsupportnumberscom">outlooktechnicalsupportnumbers.com</option>
                            <option value="windowstechnicalsupportnumberscom">windowstechnicalsupportnumbers.com</option>
                            <option value="hptechnicalsupportphonenumbersusacom">hptechnicalsupportphonenumbersusa.com</option>
                            <option value="gmailtechnicalsupportnumberscom">gmailtechnicalsupportnumbers.com</option>
                            <option value="routertechnicalsupportnumberscom">routertechnicalsupportnumbers.com</option>
                            <option value="nortonantivirustechsupportnumberscom">nortonantivirustechsupportnumbers.com</option>
                            <option value="aoltechsupportnumbercom">aoltechsupportnumber.com</option>
                            <option value="ipadsupportnumbercom">ipadsupportnumber.com</option>
                            <option value="acersupportnumbercom">acersupportnumber.com</option>
                            <option value="iphonesupportnumbercom">iphonesupportnumber.com</option>
                            <option value="lenovosupportphonenumbercom">lenovosupportphonenumber.com</option>
                            <option value="asussupportnumbercom">asussupportnumber.com</option>
                            <option value="toshibasupportphonenumbercom">toshibasupportphonenumber.com</option>
                            <option value="adobesupportphonenumbercom">adobesupportphonenumber.com</option>
                            <option value="supportphonenumberaustraliacom">supportphonenumberaustralia.com</option>
                            <option value="emailcustomercareservicecom">emailcustomercareservice.com</option>
                            <option value="delltechsupportnumberscom">delltechsupportnumbers.com</option>
                            <option value="printertechsupportnumberscom">printertechsupportnumbers.com</option>
                            <option value="1800customercarenumbercom">1800customercarenumber.com</option>
                            <option value="epsonsupport247com">epsonsupport247.com</option>
                            <option value="emailsupportnumberscom">emailsupportnumbers.com</option>
                            <option value="acercustomerservicecom">acercustomerservice.com</option>
                            <option value="adobephonenumbercom">adobephonenumber.com</option>
                            <option value="amazonkindlesupportnumberscom">amazonkindlesupportnumbers.com</option>
                            <option value="amazonprimesupportnumbercom">amazonprimesupportnumber.com</option>
                            <option value="aolmailsupportnumberscom">aolmailsupportnumbers.com</option>
                            <option value="applesupportphonenumberscom">applesupportphonenumbers.com</option>
                            <option value="asussupportphonenumbercom">asussupportphonenumber.com</option>
                            <option value="belkinsupportphonenumbercom">belkinsupportphonenumber.com</option>
                            <option value="bitdefendersupportnumberscom">bitdefendersupportnumbers.com</option>
                            <option value="brotherprintersupportnumberscom">brotherprintersupportnumbers.com</option>
                            <option value="canonprintercustomerservicecom">canonprintercustomerservice.com</option>
                            <option value="avastantivirussupportnumbercom">avastantivirussupportnumber.com</option>
                            <option value="avgsupportphonenumberscom">avgsupportphonenumbers.com</option>
                            <option value="aviraantivirussupportcom">aviraantivirussupport.com</option>
                            <option value="bigpondsupportnumberscom">bigpondsupportnumbers.com</option>
                            <option value="chromebrowsersupportcom">chromebrowsersupport.com</option>
                            <option value="chromebooksupportnumbercom">chromebooksupportnumber.com</option>
                            <option value="ciscosupportnumbercom">ciscosupportnumber.com</option>
                            <option value="comcastsupportnumbercom">comcastsupportnumber.com</option>
                            <option value="compaqsupportnumbercom">compaqsupportnumber.com</option>
                            <option value="dlinkroutersupportnumbercom">dlinkroutersupportnumber.com</option>
                            <option value="dellcustomersupportnumberscom">dellcustomersupportnumbers.com</option>
                            <option value="emailcustomersupportservicecom">emailcustomersupportservice.com</option>
                            <option value="facebooksupportphonenumberscom">facebooksupportphonenumbers.com</option>
                            <option value="fujitsusupportnumbercom">fujitsusupportnumber.com</option>
                            <option value="gaminglaptoprepaircom">gaminglaptoprepair.com</option>
                            <option value="gamingpcrepaircom">gamingpcrepair.com</option>
                            <option value="garminsupportnumberscom">garminsupportnumbers.com</option>
                            <option value="gatwaysupportnumbercom">gatwaysupportnumber.com</option>
                            <option value="gmailsupportphonenumbercom">gmailsupportphonenumber.com</option>
                            <option value="googlesupportnumbercom">gmailsupportphonenumber.com</option>
                            <option value="hotmailsupportphonenumberscom">hotmailsupportphonenumbers.com</option>
                            <option value="huaweisupportnumbercom">huaweisupportnumber.com</option>
                            <option value="iballsupportnumbercom">iballsupportnumber.com</option>
                            <option value="ibmsupportnumbercom">ibmsupportnumber.com</option>
                            <option value="internetexplorerbrowsersupportcom">internetexplorerbrowsersupport.com</option>
                            <option value="instagramsupportnumbercom">instagramsupportnumber.com</option>
                            <option value="iolosupportnumberscom">iolosupportnumbers.com</option>
                            <option value="kasperskyantivirussupportcom">kasperskyantivirussupport.com</option>
                            <option value="kodaksupportnumbercom">kodaksupportnumber.com</option>
                            <option value="lenovosupportphonenumberscom">lenovosupportphonenumbers.com</option>
                            <option value="lexmarkprintersupportnumbercom">lexmarkprintersupportnumber.com</option>
                            <option value="linkedinsupportnumbercom">linkedinsupportnumber.com</option>
                            <option value="linksyssupportnumbercom">linksyssupportnumber.com</option>
                            <option value="logitechsupportnumbercom">logitechsupportnumber.com</option>
                            <option value="macbookcustomerservicecom">macbookcustomerservice.com</option>
                            <option value="mssurfacesupportnumbercom">mssurfacesupportnumber.com</option>
                            <option value="mozillasupportnumbercom">mozillasupportnumber.com</option>
                            <option value="msilaptopsupportcom">msilaptopsupport.com</option>
                            <option value="netflixsupportnumberscom">netflixsupportnumbers.com</option>
                            <option value="netgearphonenumbercom">netgearphonenumber.com</option>
                            <option value="nortonantiviruscustomersupportcom">nortonantiviruscustomersupport.com</option>
                            <option value="nvidiasupportnumbercom">nvidiasupportnumber.com</option>
                            <option value="okiprintersupportcom">okiprintersupport.com</option>
                            <option value="operabrowsersupportcom">operabrowsersupport.com</option>
                            <option value="originpcsupportcom">originpcsupport.com</option>
                            <option value="outlooksupportphonenumberscom">outlooksupportphonenumbers.com</option>
                            <option value="panasonicsupportnumbercom">panasonicsupportnumber.com</option>
                            <option value="paypalsupportnumbercom">paypalsupportnumber.com</option>
                            <option value="pogogamesupportnumbercom">pogogamesupportnumber.com</option>
                            <option value="quickhealantivirussupportcom">quickhealantivirussupport.com</option>
                            <option value="quickbookscustomersupportservicecom">quickbookscustomersupportservice.com</option>
                            <option value="ransomwareremovalsupportcom">ransomwareremovalsupport.com</option>
                            <option value="razerbladelaptopsupportcom">razerbladelaptopsupport.com</option>
                            <option value="ricohprintersupportcom">ricohprintersupport.com</option>
                            <option value="roadrunneremailsupportcom">roadrunneremailsupport.com</option>
                            <option value="safaribrowsersupportcom">safaribrowsersupport.com</option>
                            <option value="sagesupportnumberscom">sagesupportnumbers.com</option>
                            <option value="samsungsupportnumbercom">samsungsupportnumber.com</option>
                            <option value="sbcglobalsupportnumbercom">sbcglobalsupportnumber.com</option>
                            <option value="sharpprintersupportcom">sharpprintersupport.com</option>
                            <option value="skypesupportphonenumbercom">skypesupportphonenumber.com</option>
                            <option value="snapchatsupportnumbercom">snapchatsupportnumber.com</option>
                            <option value="sprintsupportnumbercom">sprintsupportnumber.com</option>
                            <option value="synologysupportnumbercom">synologysupportnumber.com</option>
                            <option value="tindersupportnumbercom">tindersupportnumber.com</option>
                            <option value="suddenlinksupportnumbercom">suddenlinksupportnumber.com</option>
                            <option value="tomtomsupportnumberscom">tomtomsupportnumbers.com</option>
                            <option value="toshibasupportnumberscom">toshibasupportnumbers.com</option>
                            <option value="tplinkroutersupportcom">tplinkroutersupport.com</option>
                            <option value="trendmicroantivirussupportcom">trendmicroantivirussupport.com</option>
                            <option value="trendnetroutersupportcom">trendnetroutersupport.com</option>
                            <option value="twittersupportnumbercom">twittersupportnumber.com</option>
                            <option value="verizonsupportnumberscom">verizonsupportnumbers.com</option>
                            <option value="vlcmediaplayersupportcom">vlcmediaplayersupport.com</option>
                            <option value="webrootsupportnumberscom">webrootsupportnumbers.com</option>
                            <option value="windowssupportphonenumberscom">windowssupportphonenumbers.com</option>
                            <option value="windows10customerservicescom">windows10customerservices.com</option>
                            <option value="windows7customersupportcom">windows7customersupport.com</option>
                            <option value="windowsmediaplayersupportnumbercom">windowsmediaplayersupportnumber.com</option>
                            <option value="xboxlivesupportnumbercom">xboxlivesupportnumber.com</option>
                            <option value="xeroxsupportnumbercom">xeroxsupportnumber.com</option>
                            <option value="yahoosupportphonenumbercom">yahoosupportphonenumber.com</option>
                            <option value="zyxelsupportnumbercom">zyxelsupportnumber.com</option>
                            <option value="attemailsupportnumberscom">attemailsupportnumbers.com</option>
                            <option value="hpcustomercarenumbercom">hpcustomercarenumber.com</option>
                            <option value="mcafeesupportphonenumberscom">mcafeesupportphonenumbers.com</option>
                            <option value="routersupportnumberscom">routersupportnumbers.com</option>
                            <option value="rokusupportphonenumberscom">rokusupportphonenumbers.com</option>
                            <option value="epsonprinterrepaircom">epsonprinterrepair.com</option>
                            <option value="chathelporg">chathelp.org</option>
                            <option value="chatsupportscom">chatsupports.com</option>
                            <option value="onlinechathelporg">onlinechathelp.org</option>
                            <option value="printerchatsupportcom">printerchatsupport.com</option>
                            <option value="emailchatsupportnet">emailchatsupport.net</option>
                            <option value="routerchatsupportcom">routerchatsupport.com</option>
                            <option value="emailchatsupportorg">emailchatsupport.org</option>
                            <option value="callsupportorg">callsupport.org</option>
                            <option value="mailhelpnet">mailhelp.net</option>
                            <option value="gpsupdatesnet">gpsupdates.net</option>
                            <option value="assignmenthelpproscom">assignmenthelppros.com</option>
                            <option value="browsersupportco">browsersupport.co</option>
                            <option value="printersupportsco">printersupports.co</option>
                            <option value="emailsupportsnet">emailsupports.net</option>
                            <option value="antivirussupportorg">antivirussupport.org</option>
                            <option value="cobragpsupdatesnet">cobra.gpsupdates.net</option>
                            <option value="cargpsupdatesnet">car.gpsupdates.net</option>
                            <option value="printerssupportorg">printerssupport.org</option>
                            <option value="printerssupportco">printerssupport.co</option>
                            <option value="antivirussupportsinfo">antivirussupports.info</option>
                            <option value="browsersupportsco">browsersupports.co</option>
                            <option value="browsersupportsnet">browsersupports.net</option>
                            <option value="emailssupportscom">emailssupports.com</option>
                            <option value="browsersupportsorg">browsersupports.org</option>
                            <option value="supportantivirusorg">supportantivirus.com</option>
                            <option value="routersupportco">routersupport.co</option>
                            <option value="routersupportorg">routersupport.org</option>
                            <option value="routersupportsorg">routersupports.org</option>
                            <option value="supportantivirusco">supportantivirus.co</option>
                            <option value="microsoftsupportco">microsoftsupport.co</option>
                            <option value="hpsupportsco">hpsupports.co</option>
                            <option value="skypesupportorg">skypesupport.org</option>
                            <option value="lenovosupportnet">lenovosupport.net</option>
                            <option value="applesupportnumbernet">applesupportnumber.net</option>
                            <option value="xboxsupportorg">xboxsupport.org</option>
                            <option value="epsonsupportsnet">epsonsupports.net</option>
                            <option value="quickbooksupportsco">quickbooksupports.co</option>
                            <option value="netgearssupport">netgears.support</option>
                            <option value="driversupport">driver.support</option>
                            <option value="aolsupportsorg">aolsupports.org</option>
                            <option value="iphonesupportco">iphonesupport.co</option>
                            <option value="googlesupportco">googlesupport.co</option>
                            <option value="itunessupportorg">itunessupport.org</option>
                            <option value="justaboutco">justabout.co</option>
                            <option value="emailchatsupportcouk">emailchatsupport.co.uk</option>
                            <option value="printerchatsupportcouk">printerchatsupport.co.uk</option>
                            <option value="routerchatsupportcouk">routerchatsupport.co.uk</option>
                            <option value="garmingpsupdatesnet">garmin.gpsupdates.net</option>
                            <option value="magellangpsupdatesnet">magellan.gpsupdates.net</option>
                            <option value="supportprop58com">supportprop58.com</option>
                            <option value="tomtomgpsupdatesnet">tomtom.gpsupdates.net</option>
                            <option value="uaetechnicianae">uaetechnician.ae</option>
                            <option value="techsupportdubaicom">techsupportdubai.com</option>
                            <option value="supportnumbernewzealandconz">supportnumbernewzealand.co.nz</option>
                            <option value="acersupportnumbernewzealandconz">acer.supportnumbernewzealand.co.nz</option>
                            <option value="hotmailsupportnumbernewzealandconz">hotmail.supportnumbernewzealand.co.nz</option>
                            <option value="dellsupportnumbernewzealandconz">dell.supportnumbernewzealand.co.nz</option>
                            <option value="macbookrepairdubainet">macbookrepairdubai.net</option>
                            <option value="techiesforumdubaicom">techiesforumdubai.com</option>
                            <option value="uaewebsitedevelopmentcom">uaewebsitedevelopment.com</option>
                            <option value="mobilerepairsdubainet">mobilerepairsdubai.net</option>
                            <option value="macbookrepairdubaicom">macbookrepairdubai.com</option>
                            <option value="uaebabasupportorg">uae.babasupport.org</option>
                            <option value="techportsolutions">techport.solutions</option>
                            <option value="techstopsolutions">techstop.solutions</option>
                            <option value="securemyserverorg">securemyserver.org</option>
                            <option value="itsolutionshousecom">itsolutionshouse.com</option>
                            <option value="technologysquadcom">technology-squad.com</option>
                            <option value="intrasofttechnologycom">intrasofttechnology.com</option>
                            <option value="uaedatarecoverycom">uaedatarecovery.com</option>
                            <option value="indiapropertycliniccom">indiapropertyclinic.com</option>
                            <option value="mcafeesupportnet">mcafeesupport.net</option>
                            <option value="f2helpcom">f2help.com</option>
                            <option value="gennexttechnologycom">gennexttechnology.com</option>
                            <option value="macsupportnumbercom">macsupportnumber.com</option>
                            <option value="quickbooksupportcouk">quickbooksupport.co.uk</option>
                            <option value="quickbookssupportnumbercouk">quickbookssupportnumber.co.uk</option>
                            <option value="gennexttechnologycom">gennexttechnology.com</option>
                            <option value="routersupportnumbercouk">routersupportnumber.co.uk</option>
                            <option value="pcsupportnumbercouk">pcsupportnumber.co.uk</option>
                            <option value="dellsupportnumbercouk">dellsupportnumber.co.uk</option>
                            <option value="laptopsupportnumbercouk">laptopsupportnumber.co.uk</option>
                            <option value="quickbookstechnicalsupportcouk">quickbookstechnicalsupport.co.uk</option>
                            <option value="kasperskysupportnumbercouk">kasperskysupportnumber.co.uk</option>
                            <option value="avastsupportnumbercouk">avastsupportnumber.co.uk</option>
                            <option value="boboafricatourscom">boboafricatours.com</option>
                            <option value="capetownsouthafricatourismcom">capetownsouthafricatourism.com</option>
                            <option value="exploresouthafricatourcom">exploresouthafricatour.com</option>
                            <option value="southernafricatourismcom">southernafricatourism.com</option>
                            <option value="transafricatourscom">transafricatours.com</option>
                            <option value="africatourplannercom">africatourplanner.com</option>
                            <option value="southafricatourisminfo">southafricatourism.info</option>
                            <option value="africatourpackagesinfo">africatourpackages.info</option>
                            <option value="topassignmentshelpcom">topassignmentshelp.com</option>
                            <option value="computerrepairdelawarecom">computerrepairdelaware.com</option>
                            <option value="urbanclapae">urbanclap.ae</option>
                            <option value="worldpodcastforumcom">worldpodcastforum.com</option>
                            <option value="myancestrytreescom">myancestrytrees.com</option>
                            <option value="discoverfamilyhistoryorg">discoverfamilyhistory.org</option>
                            <option value="myhistoryarchivesorg">myhistoryarchives.org</option>
                            <option value="mycybercareae">mycybercare.ae</option>
                            <option value="compsecureinccom">compsecureinc.com</option>
                            <option value="onlinegrocerynowcom">onlinegrocerynow.com</option>
                            <option value="tourtravelservicescom">tourtravelservices.com</option>
                            <option value="digitalpraisecom">digitalpraise.com</option>
                            <option value="supersecurewebcom">supersecureweb.com</option>
                            <option value="skylinewebtechcom">skylinewebtech.com</option>
                            <option value="hpsupporthelplinecom">hpsupporthelpline.com</option>
                            <option value="ncevirtualconsultingcom">ncevirtualconsulting.com</option>
                            <option value="mcafeesupportsorg">mcafeesupports.org</option>
                            <option value="nortoncustomerservicenet">nortoncustomerservice.net</option>
                            <option value="canonsupportnumberorg">canonsupportnumber.org</option>
                            <option value="acersupportorg">acersupport.org</option>
                            <option value="windowstechsupportorg">windowstechsupport.org</option>
                            <option value="iphonesupportnet">iphonesupport.net</option>
                            <option value="chromesupportnet">chromesupport.net</option>
                            <option value="outlooktechsupportorg">outlooktechsupport.org</option>
                            <option value="aolcustomerserviceco">aolcustomerservice.co</option>
                            <option value="firefoxsupportcom">firefoxsupport.com</option>
                        </select>
                    </div>
                    <br>
                    <br>
                    <input type="submit" name="submit" class="btn btn-lg btn-primary btn-block btn-signin" required value="SUBMIT">
                </form>
                <!-- /form -->
                <hr>
                <small>Please remove special characters. <br>Must be in the [101.00.11.22] Format</small>
            </div>
            <!-- /card-container -->
        </div>
        <!-- /container -->
    </body>

    </html>
    <script>
    $(document).ready(function() {
        $('#websites').multiselect({
            nonSelectedText: 'Select Website',
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            buttonWidth: '370px'
        });
    });

    $(document).ready(function(){

        $('#websites').change(function() {
            if($(this).val() == 'all')
            {
                $('#websites option').attr('selected', 'selected');
                $('#websites').trigger('chosen:updated');
            } else {
                $('#websites option:selected').removeAttr('selected');
                $('#websites').trigger('chosen:updated');
            }
        });

    });

    </script>
