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
date_default_timezone_set('Asia/Jakarta');
include 'src/FrameBot.php';
require_once '../config/system.conn.php';
$mkbot = new FrameBot($token, $usernamebot);
require_once '../config/system.byte.php';
require_once '../Api/routeros_api.class.php';

$mkbot->cmd('/start|/Start', function () {
        include ('../config/system.conn.php');
    $info         = bot::message();
    $ids          = $info['chat']['id'];
    $msgid        = $info['message_id'];
    $nametelegram = $info['from']['username'];
    $idtelegram   = $info['from']['id'];
    Bot::sendChatAction('typing');

    if (has($idtelegram) == false) {
        Bot::sendChatAction('typing');
        $text = "";
        $text = 'Selamat datang di..(custom text)....';
        $options = [
            'parse_mode' => 'html'
        ];
        return Bot::sendMessage($text, $options);
    } else {
        $text = "";
        $text = "Hai @$nametelegram ada yang bisa kami bantu?\n/help untuk informasi bantuan ";
    }

    $options = [
        'parse_mode' => 'html'
    ];

    return Bot::sendMessage($text, $options);
});
$mkbot->cmd('/cekid|/Cekid', function ($jumlah) {
         include ('../config/system.conn.php');
    $info   = bot::message();
    $id     = $info['chat']['id'];
    $iduser = $info['from']['id'];
    $msgid  = $info['message_id'];
    $name   = $info['from']['username'];
    $id     = $info['from']['id'];

    if (has($id) == false) {
        $text = "<code>    Informasi ID Anda</code>\n";
        $text .= "<code>========================</code>\n";
        $text .= "<code>  ID User  :</code> <code>$id</code>\n";
        $text .= "<code>  Username :</code> @$name\n";
        $text .= "<code>  Status   : - </code>\n";
        $text .= "<code>========================</code>\n";
    } else {
        $text = "<code>    Informasi ID Anda</code>\n";
        $text .= "<code>========================</code>\n";
        $text .= "<code>  ID User  : </code> <code>$id</code>\n";
        $text .= "<code>  Username : </code> @$name\n";
        $text .= "<code>  Status   : Terdaftar </code>\n";
        $text .= "<code>========================</code>\n";
    }

    $options = [
        'parse_mode' => 'html'
    ];
    return Bot::sendMessage($text, $options);
});
$mkbot->cmd('/daftar', function () {
         include ('../config/system.conn.php');
    $info         = bot::message();
    $msgid        = $info['message_id'];
    $nametelegram = $info['from']['username'];
    $idtelegram   = $info['from']['id'];

    Bot::sendChatAction('typing');
    $ids = $info['chat']['id'];

    if (empty($nametelegram)) {
        $text = 'Maaf Akun Telegram anda belum terpasang username silahkan pasang terlebih dahulu username anda';
    } else {
        if (has($idtelegram) == false) {
            $cek = daftar($idtelegram, $nametelegram);
            if (empty($cek)) {
                $text .= "Mohon Maaf system kami mengalami gangguan silahkan hubungi Adminstator untuk reservasi layanan ini\n";
            } else {
                $text .= "<code>   Customer ID $idtelegram   </code>\n";
                $text .= "<code>========================</code>\n";
                $text .= "<code>  ID User  :</code> <code>$idtelegram</code>\n";
                $text .= "<code>  Username :</code> @$nametelegram\n";
                $text .= "<code>  Status   : Terdaftar </code>\n";
                $text .= "<code>========================</code>\n";
                $text .= "Silahkan Isi saldo anda Di outlet kami 😊 \n\n";
                $text .= "Terima kasih atas kepercayaan anda mengunakan layanan kami\n";
            }
        } else {
            $text .= "Maaf Anda sudah terdaftar dalam layanan ini\n\n";
            $text .= "<code>    Informasi ID Anda</code>\n";
            $text .= "<code>========================</code>\n";
            $text .= "<code>  ID User  : </code> <code>$idtelegram</code>\n";
            $text .= "<code>  Username : </code> @$nametelegram\n";
            $text .= "<code>  Status   : Terdaftar </code>\n";
            $text .= "<code>========================</code>\n";
        }
    }

    $options = [
        'parse_mode' => 'html'
    ];
    return Bot::sendMessage($text, $options);
});
$mkbot->cmd('/help', function ($id, $name, $notlp, $saldo) {
          include ('../config/system.conn.php');
    $info         = bot::message();
    $msgid        = $info['message_id'];
    $nametelegram = $info['from']['username'];
    $idtelegram   = $info['from']['id'];
    Bot::sendChatAction('typing');

    if ($idtelegram == $id_own) {
     $text .= "/menu - Menu Voucher\n";
     $text .= "/daftar - daftar layanan\n";
     $text .= "/ceksaldo - ceksaldo layanan\n";
     $text .= "/cek id - Status user\n";
     $text .= "/qrcode - Terjemahkan QRCODE\n";
     $text .= "Admin commands==============\n";
     $text .= "dbg - Debug message\n";
     $text .= "/daftarid - daftar user manual\n";
     $text .= "/topdown - mengurangi jumlah saldo user\n";
     $text .= "/topup - TOP UP SALDO USER\n";
     $text .= "/dbg - debug message\n";
     $text .= "/hotspot - Hotspot monitor\n";
     $text .= "/resource - resource router\n";
     $text .= "/netwatch - netwatch router\n";
     $text .= "/report - report mikhbotam\n";
     $text .= "?user - mencari keberadaan user hotspot\n";
     
     
    } else {
     $text .= "/menu - Menu Voucher\n";
     $text .= "/daftar - daftar layanan\n";
     $text .= "/ceksaldo - ceksaldo layanan\n";
     $text .= "/cek id - Status user\n";
     $text .= "/qrcode - Terjemahkan QRCODE\n";
     
    }
    $optionss = ['parse_mode' => 'html', ];
    Bot::sendMessage($text, $optionss);
});


$mkbot->cmd('/daftarid', function ($id, $name, $notlp, $saldo) {
          include ('../config/system.conn.php');
    $info         = bot::message();
    $msgid        = $info['message_id'];
    $nametelegram = $info['from']['username'];
    $idtelegram   = $info['from']['id'];
    Bot::sendChatAction('typing');

    if ($idtelegram == $id_own) {
        if (empty($id) && empty($name) && empty($notlp) && empty($saldo)) {
            $text = "Maaf Format anda salah \n\nMohon masukan format dengan benar \n/daftar noid namauser notlpn saldo";
        } else {

            $lihat = lihatuser($id);

            if (empty($lihat)) {
                $text = daftarid($id, $name, $notlp, $saldo);
            } else {
                $text = "User sudah terdaftar periksa kembali ";
            }
        }
    } else {

        $text = "Maaf..! Aksess Hanya untuk Administator";
    }
    $options = [
        'parse_mode' => 'html'
    ];
    return Bot::sendMessage($text, $options);
});
$mkbot->cmd('/topdown', function ($id, $jumlahan) {
    $info       = bot::message();
    $msgid      = $info['message_id'];
    $name       = $info['from']['username'];
    $idtelegram = $info['from']['id'];
    include ('../config/system.conn.php');
    if ($idtelegram == $id_own) {
        if (!empty($id) && !empty($jumlahan)) {
            if (has($id) == false) {
                $text = 'Data id tidak terdaftar silahkan periksa kembali';
            } else {

                if (preg_match('/^[0-9]+$/', $jumlahan)) {
                    if (strlen($jumlah) < 7) {
                        $topdown = topdown($id, $jumlahan);
                        $text    = "<code>     Informasi refund</code>\n";
                        $text .= "<code>========================</code>\n";
                        $text .= "<code>  ID User     : $id</code>\n";
                        $text .= "<code>  Saldo akhir : $topdown</code>\n";
                        $text .= "<code>Penarikan saldo berhasil</code>\n";
                    } else {
                        $text = 'Maaf Maksimal refund Rp 1.000.000.00';
                    }
                } else {
                    $text = 'Maaf input saldo hanya berupa angka saja';
                }
            }
        } else {
            $text = "Maaf format anda salah /refund (id) (jumlah)";
        }
    } else {
        $text = "Maaf..! Aksess Hanya untuk Administator";
    }
    $optionss = ['parse_mode' => 'html', ];
    Bot::sendMessage($text, $optionss);
});
$mkbot->cmd('/topup', function ($id, $jumlah) {

    $info       = bot::message();
    $msgid      = $info['message_id'];
    $name       = $info['from']['username'];
    $idtelegram = $info['from']['id'];
    Bot::sendChatAction('typing');
    include ('../config/system.conn.php');
    if ($idtelegram == $id_own) {
        if (!empty($id) && !empty($jumlah)) {
            if (has($id) == false) {
                $text = 'Data id tidak terdaftar silahkan periksa kembali';
            } else {
                if (preg_match('/^[0-9]+$/', $jumlah)) {
                    if (strlen($jumlah) < 7) {
                        $text          = topupresseller($id, $name, $jumlah, $id_own);
                        $kirimpelangan = [
                            'chat_id' => $id,
                            'reply_markup' => json_encode([
                                'inline_keyboard' => [
                                    [
                                        ['text' => '🔎 Beli Voucher', 'callback_data' => 'Menu'],
                                        ['text' => '📛 Promo Hot', 'callback_data' => 'informasi'],
                                    ], ]]),
                            'parse_mode' => 'html'

                        ];
                        Bot::sendMessage($text, $kirimpelangan);
                    } else {
                        $text = 'Maaf Maksimal Top Up Rp 1.000.000.00';
                    }
                } else {
                    $text = 'Maaf input saldo hanya berupa angka saja';
                }
            }
        } else {
            $text = "Maaf format anda salah /topup (id) (jumlah)";
        }
    } else {
        $text = "Maaf..! Aksess Hanya untuk Administator";
    }

    $options = [
        'parse_mode' => 'html'
    ];
    return Bot::sendMessage($text, $options);
});
$mkbot->cmd('/lihatsaldo|/ceksaldo', function ($jumlah) {
            include ('../config/system.conn.php');
    $info   = bot::message();
    $iduser = $info['from']['id'];
    $msgid  = $info['message_id'];
    $name   = $info['from']['username'];
    $id     = $info['from']['id'];
    $lihat  = lihatuser($id);
    $ids    = $info['chat']['id'];

    if (empty($lihat)) {
        $text = 'anda tidak terdaftar silahkan daftar terlebih dahulu ke admin atau klik /daftar';
    } else {
        $angka = lihatsaldo($id);
        $text  = "<code>      Informasi Saldo</code>\n";
        $text .= "<code>========================</code>\n";
        $text .= "<code>  ID User : $id</code>\n";
        $text .= "<code>  Name    : $name</code>\n";
        $text .= "<code>  Saldo   : " . rupiah($angka) . "</code>\n";
        $text .= "<code>========================</code>\n";
    }

    $options = [
        'parse_mode' => 'html'
    ];
    return Bot::sendMessage($text, $options);
});
$mkbot->cmd('/resource|/Resource', function () {

    $info         = bot::message();
    $msgid        = $info['message_id'];
    $nametelegram = $info['from']['username'];
    $idtelegram   = $info['from']['id'];
    Bot::sendChatAction('typing');

    include ('../config/system.conn.php');
    if ($idtelegram == $id_own) {
        $API = new routeros_api();
        if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
            $jambu   = $API->comm("/system/health/print");
            $dhealth = $jambu['0'];
            $ARRAY   = $API->comm("/system/resource/print");
            $jeruk   = $ARRAY['0'];
            $memperc = ($jeruk['free-memory'] / $jeruk['total-memory']);
            $hddperc = ($jeruk['free-hdd-space'] / $jeruk['total-hdd-space']);
            $mem     = ($memperc * 100);
            $hdd     = ($hddperc * 100);

            $sehat         = $dhealth['temperature'];
            $platform      = $jeruk['platform'];
            $board         = $jeruk['board-name'];
            $version       = $jeruk['version'];
            $architecture  = $jeruk['architecture-name'];
            $cpu           = $jeruk['cpu'];
            $cpuload       = $jeruk['cpu-load'];
            $uptime        = $jeruk['uptime'];
            $cpufreq       = $jeruk['cpu-frequency'];
            $cpucount      = $jeruk['cpu-count'];
            $memory        = formatBytes($jeruk['total-memory']);
            $fremem        = formatBytes($jeruk['free-memory']);
            $mempersen     = number_format($mem, 3);
            $hdd           = formatBytes($jeruk['total-hdd-space']);
            $frehdd        = formatBytes($jeruk['free-hdd-space']);
            $hddpersen     = number_format($hdd, 3);
            $sector        = $jeruk['write-sect-total'];
            $setelahreboot = $jeruk['write-sect-since-reboot'];
            $kerusakan     = $jeruk['bad-blocks'];

            $text .= "📡 Resource</b>\n";
            $text .= "<code>Boardname: $board</code>\n";
            $text .= "<code>Platform : $platform</code>\n";
            $text .= "<code>Uptime is: $uptime</code>\n";
            $text .= "<code>Cpu Load : $cpuload%</code>\n";
            $text .= "<code>Cpu type : $cpu</code>\n";
            $text .= "<code>Cpu Hz   : $cpufreq Mhz/$cpucount core</code>\n==========================\n";
            $text .= "<code>Free memory and memory \n$memory-$fremem/$mempersen %</code>\n==========================\n";
            $text .= "<code>Free disk and disk      \n$hdd-$frehdd/$hddpersen %</code>\n==========================\n";
            $text .= "<code>Since reboot, bad blocks \n$sector-$setelahreboot/$kerusakan%</code>\n==========================\n";
        }

        $options = ['parse_mode' => 'html', ];
        return Bot::sendMessage($text, $options);
    } else {
        $denid = "Maaf..! Aksess Hanya untuk Adminstator";
        Bot::sendMessage($denid);
    }
});
$mkbot->cmd('Hotspot|hotspot|/hotspot|/Hotspot|!Hotspot', function ($user, $telo) {

    $info         = bot::message();
    $msgid        = $info['message_id'];
    $nametelegram = $info['from']['username'];
    $idtelegram   = $info['from']['id'];
    Bot::sendChatAction('typing');

    include ('../config/system.conn.php');
    if ($idtelegram == $id_own) {
        $API = new routeros_api();
        if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
            if ($user == 'aktif') {
                if ($telo != "") {
                    $pepaya = $API->comm("/ip/hotspot/active/print", ["?server" => "" . $telo . ""]);
                    $anggur = count($pepaya);
                    $apel   = $API->comm("/ip/hotspot/active/print", ["count-only" => "", "?server" => "" . $telo . ""]);
                } else {
                    $pepaya = $API->comm("/ip/hotspot/active/print");
                    $anggur = count($pepaya);
                    $apel   = $API->comm("/ip/hotspot/active/print", ["count-only" => "", ]);
                }
                $text .= "User Aktif $apel item\n\n";
                for ($i = 0; $i < $anggur; $i++) {
                    $mangga    = $pepaya[$i];
                    $id        = $mangga['.id'];
                    $server    = $mangga['server'];
                    $user      = $mangga['user'];
                    $address   = $mangga['address'];
                    $mac       = $mangga['mac-address'];
                    $uptime    = $mangga['uptime'];
                    $usesstime = $mangga['session-time-left'];
                    $bytesi    = formatBytes($mangga['bytes-in'], 2);
                    $byteso    = formatBytes($mangga['bytes-out'], 2);
                    $loginby   = $mangga['login-by'];
                    $comment   = $mangga['comment'];
                    $text .= "";
                    $text .= "👤 User aktif\n";
                    $text .= "┠ ID :$id\n";
                    $text .= "┠ User  : $user\n";
                    $text .= "┠ IP    : $address\n";
                    $text .= "┠ Uptime : $uptime\n";
                    $text .= "┠ Byte IN      : $bytesi\n";
                    $text .= "┠ Byte OUT   : $byteso\n";
                    $text .= "┠ Sesion  : $usesstime\n";
                    $text .= "┗ Login    : $loginby\n \n";
                    $text .= "/see_$server\n \n";
                }

                $arr2       = str_split($text, 4000);
                $amount_gen = count($arr2);
                for ($i = 0; $i < $amount_gen; $i++) {
                    $texta = $arr2[$i];
                    Bot::sendMessage($texta);
                }
            } elseif ($user == 'user') {
                $ARRAY = $API->comm("/ip/hotspot/user/print");
                $num   = count($ARRAY);
                $text  = "Total $num User\n\n";
                for ($i = 0; $i < $num; $i++) {
                    $no     = $i;
                    $data   = $ARRAY[$i]['.id'];
                    $dataid = str_replace('*', 'id', $data);
                    $server = $ARRAY[$i]['server'];
                    $name   = $ARRAY[$i]['name'];
                    $data3  = $ARRAY[$i]['password'];
                    $data4  = $ARRAY[$i]['mac-address'];
                    $data5  = $ARRAY[$i]['profile'];
                    $data6  = $ARRAY[$i]['limit-uptime'];
                    $text .= "";
                    $text .= "👥  ($dataid)\n";
                    $text .= "┣Nama : $name\n";
                    $text .= "┣password : $data3 \n";
                    $text .= "┣mac : $data4\n";
                    $text .= "┣Profil : $data5\n\n";
                    $text .= "┗RemoveNow User /rEm0v$dataid\n\n";
                }
                $arr2       = str_split($text, 4000);
                $amount_gen = count($arr2);
                for ($i = 0; $i < $amount_gen; $i++) {
                    $texta = $arr2[$i];

                    Bot::sendMessage($texta);
                }
            } else {
                $text .= "";
                $text = "User list or aktif\n";
                $text .= "Filter by server\n";
                $serverhot = $API->comm('/ip/hotspot/print');
                foreach ($serverhot as $index => $jambu) {
                    $sapubasah      = str_replace('-', '0', $jambu['name']);
                    $sapubasahbasah = str_replace(' ', '11', $sapubasah);

                    $text .= "/see_" . $sapubasahbasah . "\n";
                }

                $keyboard    = [['Hotspot user', 'Hotspot aktif'], ['!Menu', 'Help'], ['!Hide'], ];
                $replyMarkup = ['keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => true, 'selective' => true];
                $options     = [
                    'reply' => true,
                    'reply_markup' => json_encode($replyMarkup),
                ];
                Bot::sendMessage($text, $options);
            }
        } else {
            $text    = "Tidak dapat Terhubung dengan Mikrotik Coba Kembali";
            $options = [
                'reply' => true,
            ];
            Bot::sendMessage($text, $options);
        }
    } else {
        $denid = "Maaf..! Aksess Hanya untuk Administator";
        Bot::sendMessage($denid);
    }
});
$mkbot->cmd('?hs|!User|?user|!user|?', function ($name) {

    $info         = bot::message();
    $msgid        = $info['message_id'];
    $nametelegram = $info['from']['username'];
    $idtelegram   = $info['from']['id'];
    Bot::sendChatAction('typing');

    include ('../config/system.conn.php');
    if ($idtelegram == $id_own) {
        $API = new routeros_api();
        if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
            $ARRAY = $API->comm("/ip/hotspot/user/print", ["?name" => $name, ]);
            $get   = $API->comm("/system/scheduler/print", ["?name" => $name, ]);

            if (empty($ARRAY)) {
                $texta = "User tidak ditemukan...";
            } else {
                foreach ($ARRAY as $index => $baris) {
                    $text = "";
                    $text .= "Hotspot Client";
                    $text .= "\n=======================\n";
                    $text .= "Nama     :" . $baris['name'] . "\n";
                    $text .= "Password :" . $baris['password'] . "\n";
                    $text .= "Limit    :" . $baris['limit-uptime'] . "\n";
                    $text .= "Uptime   :" . formatDTM($baris['uptime']) . "\n";
                    $text .= "Upload   :" . formatBytes($baris['bytes-in']) . "\n";
                    $text .= "Downlaod :" . formatBytes($baris['bytes-out']) . "\n";
                    $text .= "Profil   :" . $baris['profile'] . "\n";
                    $data   = $baris['.id'];
                    $dataid = str_replace('*', 'id', $data);
                }
                foreach ($get as $index => $baris) {
                    $experid = "";
                    $experid .= "Start-time : <b>" . $baris['start-date'] . " " . $baris['start-time'] . "</b>\n";
                    $experid .= "Interval   : <b>" . $baris['interval'] . "</b>\n";
                    $experid .= "expired    : <b>" . $baris['next-run'] . "</b>\n<code>=======================</code>\n";
                }

                $texta = "<code>" . $text . "</code>$experid\nRemove User /rEm0v$dataid\n\n";
            }
        }

        $options = ['parse_mode' => 'html', ];
        Bot::sendMessage($texta, $options);
    } else {
        $denid = "Maaf..! Aksess Hanya untuk Administator";
        Bot::sendMessage($denid);
    }
});
$mkbot->cmd('/report', function ($name) {
    $info   = bot::message();
    $id     = $info['chat']['id'];
    $iduser = $info['from']['id'];
    $msgid  = $info['message_id'];
    Bot::sendChatAction('typing');

    $text .= "<code>      " . date('d-m-Y') . "</code>\n";
    $text .= "=========================\n";
    $text .= "Total Voucher Bulan ini\n";
    $text .= "" . countvoucher() . " Voucher\n";
    $text .= "=========================\n";
    $text .= "Top up Debit Bulan ini\n";
    $text .= "" . rupiah(getcounttopup()) . "\n";
    $text .= "=========================\n";
    $text .= "Mutasi Voucher Bulan ini\n";
    $text .= "" . rupiah(estimasidata()) . "\n";
    $text .= "=========================\n";
    $text .= "User + Bulan ini\n";
    $text .= "+ " . countuser() . " User\n";
    $text .= "=========================\n";

    $options = [
        'parse_mode' => 'html',
    ];
    Bot::sendMessage($text, $options);
});
$mkbot->cmd('/netwatch|/Netwatch', function () {
    $info         = bot::message();
    $msgid        = $info['message_id'];
    $nametelegram = $info['from']['username'];
    $idtelegram   = $info['from']['id'];
    Bot::sendChatAction('typing');

    include ('../config/system.conn.php');
    if ($idtelegram == $id_own) {
        $API = new routeros_api();
        if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
            $ARRAY = $API->comm("/tool/netwatch/print");
            $num   = count($ARRAY);
            $text .= "Daftar Host Netwatch $num\n\n";
            for ($i = 0; $i < $num; $i++) {
                $no       = $i + 1;
                $host     = $ARRAY[$i]['host'];
                $interval = $ARRAY[$i]['interval'];
                $timeout  = $ARRAY[$i]['timeout'];
                $status   = $ARRAY[$i]['status'];
                $since    = $ARRAY[$i]['since'];
                $text .= "📝 Netwatch$no\n";
                $text .= "┠ Host : $host \n";
                if ($status == "up") {
                    $text .= "┠ Status : ✔ UP \n";
                } else {
                    $text .= "┠ Status : ⚠ Down \n";
                }
                $text .= "┗ Since : $since \n\n";
            }
        } else {
            $text = "Tidak dapat Terhubung dengan Mikrotik Coba Kembali";
        }
        $arr2       = str_split($text, 4000);
        $amount_gen = count($arr2);
        for ($i = 0; $i < $amount_gen; $i++) {
            $texta   = $arr2[$i];
            $options = ['parse_mode' => 'html'];
            Bot::sendMessage($arr2[$i], $options);
        }
    } else {
        $text = "Maaf..! Aksess Hanya untuk Administator";
        Bot::sendMessage($text);
    }
});
$mkbot->cmd('dbg', function ($pesan) {
    $info    = bot::message();
    $id      = $info['chat']['id'];
    $text    = "<code>" . json_encode($info, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "</code>";
    $options = ['parse_mode' => 'html', ];
    return Bot::sendMessage($text, $options);
});
$mkbot->cmd('/qrcode', function () {
    include ('../config/system.conn.php');
    $info        = bot::message();
    $ambilgambar = $info['reply_to_message']['photo'][0]['file_id'];
    if (empty($ambilgambar)) {
        $text = "Balas Gambar/foto QRcode";
        Bot::sendMessage($text);
    } else {
        $cek           = Bot::getFile($ambilgambar);
        $hasilkirimaaa = json_decode($cek, true);
        $hasilurl      = $hasilkirimaaa['result']['file_path'];
        $urlkirim      = 'http://api.qrserver.com/v1/read-qr-code/?fileurl=https://api.telegram.org/file/bot' . $token . '/' . $hasilurl;
        $hasilurla     = file_get_contents($urlkirim);
        $hasilkirim    = json_decode($hasilurla, true);
        $terjemah      = "Hasil Scan QRCODE \n " . $hasilkirim[0]['symbol'][0]['data'];
        return Bot::sendMessage($terjemah);
    }
});
$mkbot->regex('/^\/see_/', function ($matches) {
    $info         = bot::message();
    $msgid        = $info['message_id'];
    $nametelegram = $info['from']['username'];
    $idtelegram   = $info['from']['id'];
    $isipesan     = $info['text'];
    Bot::sendChatAction('typing');
    include ('../config/system.conn.php');
    if ($idtelegram == $id_own) {
        if ($isi == '/see_') {
            $text .= "⛔  Periksa \n\n<b>KETERANGAN   :</b>\nTidak Ditemukan ";
        } else {
            $sapubasah  = str_replace('/see_', '', $isipesan);
            $sapulantai = str_replace('0', '-', $sapubasah);
            $sapuujuk   = str_replace('11', ' ', $sapulantai);
            $sapulidi   = str_replace('@' . $usernamebot . '', '', $sapuujuk);
            $API        = new routeros_api();
            if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
                $pepaya = $API->comm("/ip/hotspot/active/print", ["?server" => $sapulidi]);

                if (empty($pepaya)) {
                    $texta = "Tidak ada user aktif server $sapulidi";
                    Bot::sendMessage($texta);
                }

                for ($i = 0; $i < count($pepaya); $i++) {
                    $mangga    = $pepaya[$i];
                    $id        = $mangga['.id'];
                    $server    = $mangga['server'];
                    $user      = $mangga['user'];
                    $address   = $mangga['address'];
                    $mac       = $mangga['mac-address'];
                    $uptime    = $mangga['uptime'];
                    $usesstime = $mangga['session-time-left'];
                    $bytesi    = formatBytes($mangga['bytes-in'], 2);
                    $byteso    = formatBytes($mangga['bytes-out'], 2);
                    $loginby   = $mangga['login-by'];
                    $comment   = $mangga['comment'];
                    $text .= "";
                    $text .= "👤 User aktif $server\n";
                    $text .= "┠ ID :$id\n";
                    $text .= "┠ User  : $user\n";
                    $text .= "┠ IP    : $address\n";
                    $text .= "┠ Uptime : $uptime\n";
                    $text .= "┠ Byte IN      : $bytesi\n";
                    $text .= "┠ Byte OUT   : $byteso\n";
                    $text .= "┠ Sesion  : $usesstime\n";
                    $text .= "┗ Login    : $loginby\n \n";

                    Bot::sendMessage($text);
                    $total = "Total login $server " . count($pepaya);
                    Bot::sendMessage($total);
                }
            }
        }
    } else {
        $denid = "Maaf..! Aksess Hanya untuk Administator";
        Bot::sendMessage($denid);
    }
});
$mkbot->regex('/^\/rEm0vid/', function ($matches) {
    $info         = bot::message();
    $msgid        = $info['message_id'];
    $nametelegram = $info['from']['username'];
    $idtelegram   = $info['from']['id'];
    $isipesan     = $info['text'];
    Bot::sendChatAction('typing');
    $text = "";
    include ('../config/system.conn.php');

    if ($idtelegram == $id_own) {
        if ($isipesan == '/rEm0vid') {
            $text .= "⛔ Gagal dihapus \n\n<b>KETERANGAN   :</b>\nTidak Ditemukan Id User";
        } else {
            $id  = str_replace('/rEm0vid', '*', $isipesan);
            $ids = str_replace('@' . $usernamebot, '', $id);
            $API = new routeros_api();
            if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
                $ARRAY  = $API->comm("/ip/hotspot/user/print", ["?.id" => $ids, ]);
                $data1  = $ARRAY[0]['.id'];
                $data2  = $ARRAY[0]['name'];
                $data3  = $ARRAY[0]['password'];
                $data5  = $ARRAY[0]['profile'];
                $ARRAY2 = $API->comm("/ip/hotspot/user/remove", ["numbers" => $ids, ]);
                $texta  = json_encode($ARRAY2);
                if (strpos(strtolower($texta), 'no such item') !== false) {
                    $gagal = $ARRAY2['!trap'][0]['message'];
                    $text .= "⛔ Gagal dihapus \n\n<b>KETERANGAN   :</b>\n$gagal";
                } elseif (strpos(strtolower($texta), 'invalid internal item number') !== false) {
                    $gagal = $ARRAY2['!trap'][0]['message'];
                    $text .= "⛔ Gagal dihapus \n\n<b>KETERANGAN   :</b>\n$gagal";
                } elseif (strpos(strtolower($texta), 'default trial user can not be removed') !== false) {
                    $gagal = $ARRAY2['!trap'][0]['message'];
                    $text .= "⛔ Gagal dihapus \n\n<b>KETERANGAN   :</b>\n$gagal";
                } else {
                    $text .= "Berhasil Dihapus\n\n";
                    $text .= "<code>ID         : $ids</code>\n";
                    $text .= "<code>Server     : $data1</code>\n";
                    $text .= "<code>Name       : $data2</code>\n";
                    $text .= "<code>Password   : $data3</code>\n";
                    $text .= "<code>Profile   : $data5</code>\n";
                    sleep(2);
                    $ARRAY3 = $API->comm("/ip/hotspot/user/print");
                    $jumlah = count($ARRAY3);
                    $text .= "Jumlah user saat ini : $jumlah user";
                }
            } else {
                $text = "Gagal Periksa sambungan Kerouter";
            }
        }
        $options = ['parse_mode' => 'html', ];
        $texta   = json_encode($ARRAY2);
        return Bot::sendMessage($text, $options);
    } else {
        $denid = "Maaf..! Aksess Hanya untuk Administator";
        Bot::sendMessage($denid);
    }
});
/*//Disable by admin bugs not fix
$mkbot->cmd('/voucher', function ($voucher) {

    $info              = bot::message();
    $usernamepelanggan = $info['from']['username'];
    $id                = $info['from']['id'];
    $nama              = $info['from']['first_name'];
    $type              = $info['chat']['type'];
    $messageid         = $info['message_id'];
    Bot::sendChatAction('typing');
    include ('../config/system.conn.php');

    $harga    = json_decode($voucher_1, true);
    $cekharga = $harga[0]['price'] . "," . $harga[1]['price'] . "," . $harga[2]['price'] . "," . $harga[3]['price'] . "," . $harga[4]['price'] . "," . $harga[5]['price'];

    if (empty($voucher)) {
        $text = 'Mohon Maaf Anda Belum Memasukan Harga voucher untuk membeli voucher silahkan masukan perintah /voucher (harga)';
        Bot::sendMessage($text);
    } elseif (has($id) == false) {
        $text = 'Mohon Maaf Anda Belum terdaftar silahkan daftar terlebih dahulu ke admin atau klik /daftar';
        Bot::sendMessage($text);
    } else if (sisasaldo($id, $voucher)) {
        $text = 'Mohon Maaf Sisa saldo anda tidak cukup untuk membeli voucher ini silahkan isi saldo anda';
        Bot::sendMessage($text);
    } else if (preg_match('/' . $voucher . '/i', $cekharga)) {
        $API = new routeros_api();
        foreach ($harga as $hargas => $hargaasli) {
            $princevoc   = $hargaasli['price'];
            $profile     = $hargaasli['profile'];
            $length      = $hargaasli['length'];
            $vouchername = $hargaasli['Voucher'];
            $limituptime = $hargaasli['Limit'];
            $markup      = $hargaasli['markup'];
            $server      = $getdata['server'];
            $username    = "$usernamepelanggan[0]" . Crusername($length);
            //  $username = Crusername($length);
            $password = Crpas($length);

            if ($voucher == $princevoc) {
                $text = "";
                $text .= "<code>  Buy Voucher " . rupiah($princevoc) . "  </code>\n";
                $text .= "<code>========================</code>\n";
                $text .= "<code>  ID User  :</code> <code>$id</code>\n";
                $text .= "<code>  Username :</code> @$usernamepelanggan\n";
                $text .= "<code>  Status   : Pending </code>\n";
                $text .= "<code>========================</code>\n";

                $options = [
                    'parse_mode' => 'html'
                ];

                Bot::sendMessage($text, $options);

                Bot::sendChatAction('upload_photo');

                sleep(2);
                //kasih jeda untuk  ram

                if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
                    $add_user_api = $API->comm("/ip/hotspot/user/add", [
                        "server" => $server,
                        "profile" => $profile,
                        "name" => $username,
                        "password" => $password,
                        "limit-uptime" => $limituptime,
                        "comment" => "mkb_ $usernamepelanggan _Rp_" . $princevoc . "_" . date('d-m-Y'),
                    ]);

                    if (strpos(strtolower($limituptime), 'h') !== false) {
                        $uptime = str_replace('h', ' Jam', $limituptime);
                    } elseif (strpos(strtolower($limituptime), 'd') !== false) {
                        $uptime = str_replace('d', ' Hari', $limituptime);
                    } elseif (strpos(strtolower($limituptime), 'd') !== false) {
                        $uptime = str_replace('w', ' Minggu', $limituptime);
                    }
                    $caption = "";
                    $caption .= "<code>=========================</code>\n";
                    $caption .= "<code>  ID         : $add_user_api</code>\n";
                    $caption .= "<code>  Username   :</code> <code>$username</code>\n";
                    $caption .= "<code>  Password   :</code> <code>$password</code>\n";
                    $caption .= "<code>  Expe       :</code> <code>$uptime</code>\n";
                    $caption .= "<code>=========================</code>\n";
                    $caption .= "<code>GUNAKAN INTERNET DGN BIJAK</code>\n";
                    $caption .= "<code>=========================</code>\n";
                    $qrcode  = 'http://qrickit.com/api/qr.php?d=' . urlencode("$dnsname/login?username=$username&password=$password") . '&addtext=' . urlencode($Name_router) . '&txtcolor=000000&fgdcolor=000000&bgdcolor=FFFFFF&qrsize=500';
                    $options = [
                        'caption' => $caption,
                        'parse_mode' => 'html',
                    ];

                    $succes  = Bot::sendPhoto($qrcode, $options);
                    $success = json_decode($succes, true);
                    if ($success['ok'] !== true) {
                        $errorprint = true;
                    }
                } else {
                    $ganguan = true;
                }
                break;
            }
        }
        if (!empty($ganguan)) {
            $gagal = "";
            $gagal .= "<code>  Buy Voucher " . rupiah($princevoc) . "  </code>\n";
            $gagal .= "<code>========================</code>\n";
            $gagal .= "<code>  ID User  :</code> <code>$id</code>\n";
            $gagalt .= "<code>  Username :</code> @$usernamepelanggan\n";
            $gagal .= "<code>  Status   : Vaild Conect Server </code>\n";
            $gagal .= "<code>========================</code>\n";
            $gagalt .= "Maaf server mengalami gangguan silahkan hubungi admin\n";
            $options = [
                'parse_mode' => 'html'
            ];
            Bot::sendChatAction('typing');
            $keterangan = 'gagal';
            Bot::sendMessage($gagal, $options);
            $set = belivoucher($id, $usernamepelanggan, '0', $username, $password, $uptime, $keterangan);
        } elseif (!empty($errorprint)) {
            $gagalprint = "";
            $gagalprint .= "<code>  Buy Voucher " . rupiah($princevoc) . "   </code>\n";
            $gagalprint .= "<code>========================</code>\n";
            $gagalprint .= "<code>  ID User  :</code> <code>$id</code>\n";
            $gagalprint .= "<code>  Username :</code> @$usernamepelanggan\n";
            $gagalprint .= "<code>  Status   : Vaild Print Voucher </code>\n";
            $gagalprint .= "<code>========================</code>\n";
            $gagalprint .= "Maaf server mengalami gangguan silahkan hubungi admin\n";
            $options = [
                'parse_mode' => 'html'
            ];
            Bot::sendChatAction('typing');
            $keterangan = 'gagalprint';
            Bot::sendMessage($gagalprint, $options);
            $set = belivoucher($id, $usernamepelanggan, '0', $username, $password, $uptime, $keterangan);
        } else {
            $Success = "";
            $Success = "<code>  Buy Voucher " . rupiah($princevoc) . "  </code>\n";
            $Success .= "<code>========================</code>\n";
            $Success .= "<code>  ID User  :</code> <code>$id</code>\n";
            $Success .= "<code>  Username :</code> @$usernamepelanggan\n";
            $Success .= "<code>  Status   : Successful </code>\n";
            $Success .= "<code>========================</code>\n";

            $options = [
                'parse_mode' => 'html'
            ];
            Bot::sendChatAction('typing');
            Bot::sendMessage($Success, $options);
            if (isset($Success)) {
                $keterangan  = 'Success';
                $markupakhir = minus($princevoc, $markup);
                $set         = belivoucher($id, $usernamepelanggan, $markupakhir, $username, $password, $uptime, $keterangan);
            }
        }
    } else {
        $text = 'Maaf tidak ada voucher ' . $voucher;
        Bot::sendMessage($text);
    }

    return $harga = [];
});*/
$mkbot->cmd('!Menu|/Menu|/menu', function () {
    include ('../config/system.conn.php');
    $data = json_decode($voucher_1, true);
    $text = "";
    $text .= "<i>Silahkan Pilih voucher dibawah ini</i>\n\n";
    $text .= "<code>Daftar Harga :</code>\n";
    foreach ($data as $hargas) {
        $princevoc   = $hargas['price'];
        $vouchername = $hargas['Voucher'];
        $limituptime = $hargas['Limit'];
        if (strpos(strtolower($limituptime), 'h') !== false) {
            $uptime = str_replace('h', ' Jam', $limituptime);
        } elseif (strpos(strtolower($limituptime), 'd') !== false) {
            $uptime = str_replace('d', ' Hari', $limituptime);
        }

        $text .= "<code>Voucher  $uptime  : " . rupiah($princevoc) . "  </code>\n";
    }
    for ($i = 0; $i < count($data); $i++) {
        ${
            'database' . $i
        } = ['text' => $data[$i]['Voucher'] . '', 'callback_data' => 'Vcr' . $data[$i]['id'] . ''];
    }

    $vouchernamea0 = array_filter(
        [
            $database0,
            $database1

        ]);

    $vouchernameb1 = array_filter(
        [
            $database2,
            $database3

        ]);

    $vouchernamec2 = array_filter(
        [
            $database4,
            $database5

        ]);
    $menu_idakhir = [
        ['text' => '💰 Cek Saldo', 'callback_data' => 'ceksaldo'],
        ['text' => '🔖 iNFORMASI', 'callback_data' => 'informasi'],
    ];

    $send = [];
    array_push($send, $vouchernamea0);
    array_push($send, $vouchernameb1);
    array_push($send, $vouchernamec2);
    array_push($send, $menu_idakhir);

    $options = [
        'reply_markup' => json_encode(['inline_keyboard' => $send]),
        'parse_mode' => 'html'
    ];

    Bot::sendMessage($text, $options);
    unset($data, $voucher_1);
});
$mkbot->on('callback', function ($command) {

    $message           = Bot::message();
    $enkod             = json_encode($message);
    $id                = $message['from']['id'];
    $usernamepelanggan = $message['from']['username'];
    $namatele          = $message['from']['first_name'];
    $chatidtele        = $message["message"]['chat']['id'];
    $message_idtele    = $message["message"]["message_id"];

    include ('../config/system.conn.php');

    if (has($id)) {
        if (strpos($command, 'Vcr') !== false) {
            $data  = json_decode($voucher_1, true);
            $cekid = "Vcr" . $data[0]['id'] . ",Vcr" . $data[1]['id'] . ",Vcr" . $data[2]['id'] . ",Vcr" . $data[3]['id'] . ",Vcr" . $data[4]['id'] . ",Vcr" . $data[5]['id'];

            if (preg_match('/' . $command . '/i', $cekid)) {
                $API = new routeros_api();
                foreach ($data as $datas => $getdata) {
                    $getid2      = $getdata['id'];
                    $princevoc   = $getdata['price'];
                    $profile     = $getdata['profile'];
                    $length      = $getdata['length'];
                    $vouchername = $getdata['Voucher'];
                    $limituptime = $getdata['Limit'];
                    $markup      = $getdata['markup'];
                    $server      = $getdata['server'];
                    $type        = $getdata['type'];

                    $username = "$usernamepelanggan[0]" . Crusername($length);
                    $password = Crpas($length);

                    if ($command == 'Vcr' . $getid2) {
                        if (sisasaldo($id, $princevoc)) {
                            $limitsaldo .= "Maaf saldo anda tidak mencukupi untuk melakukan pembelian voucher\n";

                            $options = [
                                'chat_id' => $chatidtele,
                                'message_id' => (int) $message['message']['message_id'],
                                'text' => $limitsaldo,
                                'reply_markup' => json_encode([
                                    'inline_keyboard' => [
                                        [
                                            ['text' => 'Back', 'callback_data' => 'Menu'],
                                        ], ]]),
                                'parse_mode' => 'html'

                            ];

                            Bot::editMessageText($options);
                        } else {
                            $sendupdate = "";
                            $sendupdate .= "<code>  Buy Voucher " . rupiah($princevoc) . "   </code>\n";
                            $sendupdate .= "<code>========================</code>\n";
                            $sendupdate .= "<code>  ID User  :</code> <code>$id</code>\n";
                            $sendupdate .= "<code>  Username :</code> @$usernamepelanggan\n";
                            $sendupdate .= "<code>  Status   : Pending </code>\n";
                            $sendupdate .= "<code>========================</code>\n";
                            $sendupdate .= "Mohon ditunggu Voucher akan segera dibuat\n";

                            $options = [
                                'chat_id' => $chatidtele,
                                'message_id' => (int) $message['message']['message_id'],
                                'text' => $sendupdate,
                                'reply_markup' => json_encode([
                                    'inline_keyboard' => [
                                        [
                                            ['text' => 'Back', 'callback_data' => 'Menu'],
                                        ], ]]),
                                'parse_mode' => 'html'

                            ];

                            Bot::editMessageText($options);

                            sleep(2);
                            $delete = [
                                'chat_id' => $chatidtele,
                                'message_id' => (int) $message['message']['message_id'],
                            ];

                            Bot::deleteMessage($delete);
                            if ($type == 'up') {
                                $usernamereal = $username;
                                $passwordreal = $password;
                            } else {
                                $usernamereal = $username;
                                $passwordreal = $username;
                            }
                            if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
                                $add_user_api = $API->comm("/ip/hotspot/user/add", [
                                    "server" => $server,
                                    "profile" => $profile,
                                    "name" => $usernamereal,
                                    "password" => $passwordreal,
                                    "limit-uptime" => $limituptime,
                                    "comment" => "mkb_ $usernamepelanggan _Rp_" . $princevoc . "_" . date('d-m-Y'),
                                ]);

                                if (strpos(strtolower($limituptime), 'h') !== false) {
                                    $uptime = str_replace('h', ' Jam', $limituptime);
                                } elseif (strpos(strtolower($limituptime), 'd') !== false) {
                                    $uptime = str_replace('d', ' Hari', $limituptime);
                                }
                                $caption = "";
                                $caption .= "<code>=========================</code>\n";
                                $caption .= "<code>  ID         : $add_user_api</code>\n";
                                $caption .= "<code>  Username   :</code> <code>$usernamereal</code>\n";
                                $caption .= "<code>  Password   :</code> <code>$passwordreal</code>\n";
                                $caption .= "<code>  Expe       :</code> <code>$uptime</code>\n";
                                $caption .= "<code>=========================</code>\n";
                                $caption .= "<code>GUNAKAN INTERNET DGN BIJAK</code>\n";
                                $caption .= "<code>=========================</code>\n";
                                $qrcode  = 'http://qrickit.com/api/qr.php?d=' . urlencode("$dnsname/login?username=$usernamereal&password=$passwordreal") . '&addtext=' . urlencode($Name_router) . '&txtcolor=000000&fgdcolor=000000&bgdcolor=FFFFFF&qrsize=500';
                                $options = [
                                    'caption' => $caption,
                                    'parse_mode' => 'html',
                                ];

                                //Kasih jeda 2 detik

                                sleep(2);

                                $options = [
                                    'chat_id' => $chatidtele,
                                    'caption' => $caption,
                                    'parse_mode' => 'html'
                                ];

                                $succes  = Bot::sendPhoto($qrcode, $options);
                                $success = json_decode($succes, true);
                                if ($success['ok'] !== true) {
                                    $errorprint = true;
                                }
                            } else {
                                $ganguan = true;
                            }
                            break;
                        }
                    }
                }
                if (!empty($ganguan)) {
                    $gagal .= "<code>  Buy Voucher " . rupiah($princevoc) . "   </code>\n";
                    $gagal .= "<code>========================</code>\n";
                    $gagal .= "<code>  ID User  :</code> <code>$id</code>\n";
                    $gagalt .= "<code>  Username :</code> @$usernamepelanggan\n";
                    $gagal .= "<code>  Status   : Vaild Conect Server </code>\n";
                    $gagal .= "<code>========================</code>\n";
                    $gagalt .= "Maaf server mengalami gangguan silahkan hubungi admin\n";
                    $options = [
                        'chat_id' => $chatidtele,
                        'parse_mode' => 'html'

                    ];
                    $keterangan = 'gagal';
                    Bot::sendMessage($gagal, $options);
                    //remove user
                    if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
                        $add_user_apis = $API->comm("/ip/hotspot/user/remove", [
                            "numbers" => $add_user_api,
                        ]);
                    }
                    $set = belivoucher($id, $usernamepelanggan, '0', $usernamereal, $passwordreal, $uptime, $keterangan);
                } elseif (!empty($errorprint)) {

                    $gagalprint .= "<code>  Buy Voucher " . rupiah($princevoc) . "  </code>\n";
                    $gagalprint .= "<code>========================</code>\n";
                    $gagalprint .= "<code>  ID User  :</code> <code>$id</code>\n";
                    $gagalprint .= "<code>  Username :</code> @$usernamepelanggan\n";
                    $gagalprint .= "<code>  Status   : Vaild Print Voucher </code>\n";
                    $gagalprint .= "<code>========================</code>\n";
                    $gagalprint .= "Maaf server mengalami gangguan silahkan hubungi admin\n";
                    $options = [
                        'chat_id' => $chatidtele,
                        'parse_mode' => 'html'

                    ];
                    $keterangan = 'gagalprint';
                    Bot::sendMessage($gagalprint, $options);
                    Bot::sendMessage($gagal, $options);
                    //remove user
                    if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
                        $add_user_api = $API->comm("/ip/hotspot/user/remove", [
                            "id" => $add_user_api,
                        ]);
                    }
                    $set = belivoucher($id, $usernamepelanggan, '0', $usernamereal, $passwordreal, $uptime, $keterangan);
                } else if (!empty($succes)) {
                    $Success = "<code>  Buy Voucher " . rupiah($princevoc) . "   </code>\n";
                    $Success .= "<code>========================</code>\n";
                    $Success .= "<code>  ID User  :</code> <code>$id</code>\n";
                    $Success .= "<code>  Username :</code> @$usernamepelanggan\n";
                    $Success .= "<code>  Status   : Success </code>\n";
                    $Success .= "<code>========================</code>\n";
                    $options = [
                        'chat_id' => $chatidtele,
                        'reply_markup' => json_encode([
                            'inline_keyboard' => [
                                [
                                    ['text' => 'Back', 'callback_data' => 'Menu'],
                                ], ]]),
                        'parse_mode' => 'html'

                    ];

                    Bot::sendMessage($Success, $options);
                    if (isset($Success)) {
                        $keterangan  = 'Success';
                        $markupakhir  = minus($princevoc, $markup);
                        $set           = belivoucher($id, $usernamepelanggan, $markupakhir, $usernamereal, $passwordreal, $uptime, $keterangan);
                        $angka        = lihatsaldo($id);
                        $transsaksi.= "#Voucher-Markup#$princevoc-$markup=$markupakhir#sldo#:".rupiah($angka)." \n";

                    $options = [
                        'chat_id' => $chatidtele,
                        'parse_mode' => 'html'

                    ];

                    Bot::sendMessage($transsaksi, $options);
                    }
                }
            } else {
                $Success = "Maaf voucher ini tidak lagi tersedia \n";

                $options = [
                    'chat_id' => $chatidtele,
                    'parse_mode' => 'html'

                ];

                Bot::sendMessage($Success, $options);
            }
        } elseif ($command == 'Menu') {
            $text = "";
            $data = json_decode($voucher_1, true);
            $text .= "<i>Silahkan Pilih voucher dibawah ini</i>\n\n";
            $text .= "<code>Daftar Harga :</code>\n";
            foreach ($data as $hargas) {
                $princevoc   = $hargas['price'];
                $vouchername = $hargas['Voucher'];
                $limituptime = $hargas['Limit'];
                if (strpos(strtolower($limituptime), 'h') !== false) {
                    $uptime = str_replace('h', ' Jam', $limituptime);
                } elseif (strpos(strtolower($limituptime), 'd') !== false) {
                    $uptime = str_replace('d', ' Hari', $limituptime);
                }

                $text .= "<code>Voucher  $uptime  : Rp $princevoc </code>\n";
            }
            $datavoc = json_decode($voucher_1, true);
            for ($i = 0; $i < count($datavoc); $i++) {
                ${
                    'database' . $i
                } = ['text' => $datavoc[$i]['Voucher'] . '', 'callback_data' => 'Vcr' . $datavoc[$i]['id'] . ''];
            }

            $vouchernamea0 = array_filter(
                [
                    $database0,
                    $database1

                ]);

            $vouchernameb1 = array_filter(
                [
                    $database2,
                    $database3

                ]);

            $vouchernamec2 = array_filter(
                [
                    $database4,
                    $database5

                ]);

            $menu_idakhir = [
                ['text' => '💰 Cek Saldo', 'callback_data' => 'ceksaldo'],
                ['text' => '🔖 iNFORMASI', 'callback_data' => 'informasi'],
            ];
            $send = [];
            array_push($send, $vouchernamea0);
            array_push($send, $vouchernameb1);
            array_push($send, $vouchernamec2);
            array_push($send, $menu_idakhir);

            $options = [
                'chat_id' => $chatidtele,
                'message_id' => (int) $message['message']['message_id'],
                'text' => $text,
                'reply_markup' => json_encode(['inline_keyboard' => $send]),
                'parse_mode' => 'html'

            ];

            Bot::editMessageText($options);
        } elseif ($command == 'ceksaldo') {

            if (has($id) == false) {
                $text = 'Anda tidak terdaftar silahkan daftar terlebih dahulu ke admin atau klik /daftar';
            } else {
                $angka = lihatsaldo($id);
                $text  = "<code>      Informasi Saldo</code>\n";
                $text .= "<code>========================</code>\n";
                $text .= "<code>  ID User : $id</code>\n";
                $text .= "<code>  Name    : @$usernamepelanggan</code>\n";
                $text .= "<code>  Saldo   : " . rupiah($angka) . "</code>\n";
                $text .= "<code>========================</code>\n";
            }

            $options = [
                'chat_id' => $chatidtele,
                'message_id' => (int) $message['message']['message_id'],
                'text' => $text,
                'reply_markup' => json_encode([
                    'inline_keyboard' => [
                        [
                            ['text' => 'Back', 'callback_data' => 'Menu'],
                        ], ]]),
                'parse_mode' => 'html'

            ];

            Bot::editMessageText($options);
        } elseif ($command == 'informasi') {
            $text    = 'Tidak ada informasi terkini';
            $options = [
                'chat_id' => $chatidtele,
                'message_id' => (int) $message['message']['message_id'],
                'text' => $text,
                'reply_markup' => json_encode([
                    'inline_keyboard' => [
                        [
                            ['text' => 'Back', 'callback_data' => 'Menu'],
                        ], ]]),
                'parse_mode' => 'html'

            ];

            Bot::editMessageText($options);
        }
    } else {
        $text    = 'Maaf  anda tidak terdaftar silahkan daftar terlebih dahulu ke admin atau klik /daftar';
        $options = [
            'chat_id' => $chatidtele,
            'message_id' => (int) $message['message']['message_id'],
            'text' => $text,
        ];

        Bot::editMessageText($options);
    }
});

$mkbot->run();

/*Please contact @Bangachil for bugs
history
1 Maret 2019
-Make ceksaldo command
-Make cekid
2 Maret 2019
-Make callback data
-Make menu command
-Make array menu
-Make callback answer
3 Maret 2019
-Make database Saldo
-bugs fix daftar
-bugs fix menu
-bugs fix saldo minus
-bugs fix topup
-Make topup send to ID
-Make button menu
10 Maret 2019
-make emoticon button menu
-make cek id calbback
-make voucher defalut disable
-make voucher null
19 Maret 2019
-bugs fix menu command
-bugs fix callback answer
-bugs fix list Voucher array
-bugs fix database
Version update 1.2.3
20 maret 2019
-Make User id callback
-remove emotion calbback
-remove array_filter
-move data callback
-move ceksaldo
-Make ceksaldo cek id
Version update 1.2.11

2 april 2019
-remove start auto join
-make hitspot view
-make remove user hotspot cmd
-make help cmd
-Make hass user
Version update 1.2.13


3 april 2019
-edited vcr callback data

Version update 1.2.14


Thanks to topupGroup an member , SengkuniCode, and to all user support mini project
Thanks to SengkuniCode for web ui,

 */
