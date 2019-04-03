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
if (!isset($_SESSION["Mikbotamuser"])) {
    header("Location:../admin/login.php");
} else {
    include '../config/system.conn.php';
    include '../Api/routeros_api.class.php';
    include '../config/system.generate.php';
    if (isset($_GET['numid']) && isset($_GET['VocNum'])) {
        $id        = $_SESSION['Mikbotamid'];
        $iduser    = $_GET['numid'];
        $idvoucher = $_GET['VocNum'];
        $getvoc    = getvoc($id);
        $datajson  = json_decode($getvoc, true);
        $length    = $datajson[$idvoucher]['length'];
        $type      = $datajson[$idvoucher]['type'];
        $server    = $datajson[$idvoucher]['server'];

        $username = Crusername($length);
        $password = Crpas($length);

        if ($type == 'up') {
            $usernamemirotik  = $username;
            $passwordmikrotik = $password;
        } else {
            $usernamemirotik  = $username;
            $passwordmikrotik = $username;
        }

        $API = new routeros_api();
        if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
            $add_user_api = $API->comm("/ip/hotspot/user/add", [
                "server" => $server,
                "profile" => $datajson[$idvoucher]['profile'],
                "name" => $usernamemirotik,
                "password" => $passwordmikrotik,
                "limit-uptime" => $datajson[$idvoucher]['Limit'],
                "comment" => "Mikhbotam-Rp-" . $datajson[$idvoucher]['price'] . "-" . date('d-m-Y'),
            ]);

            $caption .= "<code>=========================</code>\n";
            $caption .= "<code>  ID         : $add_user_api</code>\n";
            if (strpos(strtolower($datajson[$idvoucher]['Limit']), 'h') !== false) {
                $uptime = str_replace('h', ' Jam', $datajson[$idvoucher]['Limit']);
            } elseif (strpos(strtolower($datajson[$idvoucher]['Limit']), 'd') !== false) {
                $uptime = str_replace('d', ' Hari', $datajson[$idvoucher]['Limit']);
            }
            $caption .= "<code>  Expe       :</code> <code>" . $uptime . "</code>\n";
            $caption .= "<code>  Name       :</code> <code>$usernamemirotik</code>\n";
            $caption .= "<code>  Password   :</code> <code>$passwordmikrotik</code>\n";
            $caption .= "<code>=========================</code>\n";
            $caption .= "<code>GUNAKAN INTERNET DGN BIJAK</code>\n";
            $caption .= "<code>=========================</code>\n";
            $qrcode = 'http://qrickit.com/api/qr.php?d=' . urlencode("$dnsname/login?username=$usernamemirotik&password=$passwordmikrotik") . '&addtext=' . urlencode($Name_router) . '&txtcolor=000000&fgdcolor=000000&bgdcolor=FFFFFF&qrsize=500';

            $result = sendPhoto($iduser, $qrcode, $caption, $token);

            $wel = json_decode($result, true);
            if ($wel['ok']) {
                $maketable = '

                                <div class="row">
    <div class="col-xl-5 ">
        <img class="card-img " src=' . $qrcode . ' alt="Image"></div>
    <div class="col-xl-7">
        <div class="alert alert-success " role="alert">
            <div class="d-flex align-items-center justify-content-start">
                <pre>Successful Send Voucher to<br>ID         : ' . $add_user_api . '<br>Expe       : ' . $uptime . '<br>Name       : ' . $usernamemirotik . '<br>Password   : ' . $passwordmikrotik . '</pre>
            </div>
        </div>
    </div>
</div>';
            } else {
                if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
                    $add_user_apis = $API->comm("/ip/hotspot/user/remove", [
                        "numbers" => $add_user_api,
                    ]);
                }
                $maketable = '<div class="alert alert-success py-2" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">X</span>
              </button>
              <strong class="d-block d-sm-inline-block-force">⛔  Warning!</strong> <p>
                Failed Send Voucher to ' . $iduser . '</p> Maybe bots are blocked by users <br>user ' . $usernamemirotik . ' is automatically deleted from the router</div>';
            }
        } else {
            $maketable = '<div class="alert alert-success py-2" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">X</span>
              </button>
              <strong class="d-block d-sm-inline-block-force">⛔  Warning!</strong> <p>
                Failed Conect Mikrotik </p> Please check the connection to  </div>';
        }

        echo $maketable;
    } else {
        echo "<meta http-equiv='refresh' content='0;url=../pages/index.php' />";
    }
}
