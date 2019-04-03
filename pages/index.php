<?php
//=====================================================START====================//

/*
 *  Base Code   : BangAchil
 *  Email       : kesumaerlangga@gmail.com
 *  Telegram    : @bangachil
 *
 *  Name        : Mikrotik bot telegram - php
 *  Function    : Mikortik api
 *  Manufacture : November 2018
 *  Last Edited : 26 Desember 2019
 *
 *  Please do not change this code
 *  All damage caused by editing we will not be responsible please think carefully,
 *
 */

//=====================================================START SCRIPT====================//                            
    session_start();
     error_reporting(0);
   $_SESSION['MikbotamUrl'] = $_SERVER['REQUEST_URI'];
    if (!isset($_SESSION["Mikbotamuser"])) {
    	
        header("Location:../admin/login.php");
        
    } else {
     
        include '../include/header.php';
        include '../include/Home.php';

		echo '<div class="sl-mainpanel">';

        if ($_GET["Mikbotam"] == "Record") {
           
            include "recordcounter.php";
        } else

        if ($_GET["Mikbotam"] == "sendVoc") {
            
            include "sendvoc.php";
        } else

        if ($_GET["Mikbotam"] == "Settings") {
            
            include "settings.php";
        } else
        if ($_GET["Mikbotam"] == "addprofile") {
            
            include "addprofile.php";
        }else
        if ($_GET["Mikbotam"] == "comingsoon") {
            include "comingson.php";
        } else

        if ($_GET["Mikbotam"] == "sendMessage") {
            include "sendmess.php";
        } else

        if ($_GET["Mikbotam"] == "SettingsVoc") {
            include "settingsvoc.php";
        } else

        if ($_GET["Mikbotam"] == "NewUser") {
            include "nusercounter.php";
        } else
        if ($_GET["Mikbotam"] == "topupsaldo") {
            include "topup.php";
        }else
        if ($_GET["Mikbotam"] == "topdownsaldo") {
            include "topdown.php";
        } else
        if ($_GET["Mikbotam"] == "monitortraffic") {
            include "graphmikbotam.php";
        } else

        if ($_GET["Mikbotam"] == "logout") {
            session_destroy();
            echo "<script>sessionStorage.clear();</script>";
            echo "<script>window.location='../index.php'</script>";
        } else

        if ($_GET["Mikbotam"] == "userlist") {
            include "userlist.php";
        }else

        if ($_GET["Mikbotam"] == "about") {
            include "about.php";
        } else {
    
            include "dashboard.php";
        }

   		include '../include/footer.php';
}
?>

