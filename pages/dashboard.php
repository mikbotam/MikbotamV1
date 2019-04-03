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

 error_reporting(0);
    if (!isset($_SESSION["Mikbotamuser"])) {
        header("Location:../admin/login.php");
    } else {
        include '../config/system.conn.php';
        include '../config/system.byte.php';
        include '../Api/routeros_api.class.php';
        $datavoucher = sethistory($id);
        date_default_timezone_set('Asia/Jakarta');
        $API = new routeros_api();
        if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
            $IDENTITY      = $API->comm('/system/identity/getall');
            $routername    = $IDENTITY['0']['name'];
            $health        = $API->comm("/system/health/print");
            $dhealth       = $health['0'];
            $ARRAY         = $API->comm("/system/resource/print");
            $first         = $ARRAY['0'];
            $memperc       = ($first['free-memory'] / $first['total-memory']);
            $hddperc       = ($first['free-hdd-space'] / $first['total-hdd-space']);
            $mem           = ($memperc * 100);
            $hdd           = ($hddperc * 100);
            $sehat         = $dhealth['temperature'];
            $platform      = $first['platform'];
            $board         = $first['board-name'];
            $version       = $first['version'];
            $architecture  = $first['architecture-name'];
            $cpu           = $first['cpu'];
            $cpuload       = $first['cpu-load'];
            $uptime        = $first['uptime'];
            $cpufreq       = $first['cpu-frequency'];
            $cpucount      = $first['cpu-count'];
            $memory        = formatBytes($first['total-memory']);
            $fremem        = formatBytes($first['free-memory']);
            $mempersen     = number_format($mem, 3);
            $hdd           = formatBytes($first['total-hdd-space']);
            $frehdd        = formatBytes($first['free-hdd-space']);
            $hddpersen     = number_format($hdd, 3);
            $sector        = $first['write-sect-total'];
            $setelahreboot = $first['write-sect-since-reboot'];
            $kerusakan     = $first['bad-blocks'];
        }
    }
?>
    <div class="sl-pagebody">
        <div class="row row-sm">
            <div class="col-sm-6 col-xl-3">
                <div class="card pd-20 pd-sm-10 ">
                    <div class="d-flex align-items-center">
                    <span> <img src="../img/vocher.svg" alt="mikbotam.id" ></span >
                                <div class="mg-l-15">
                            <span class="tx-15 tx-spacing-1 tx-gray-500">
                    Total Voucher<br> Bulan ini<br><br>
                                    <h6 class="tx-inverse mg-b-0"><?=countvoucher();?> Voucher</h6>
                    </div>
                </div></div>
                <!-- card -->
            </div>
            <!-- col-3 -->
            <div class="col-sm-6 col-xl-3 mg-t-10 mg-sm-t-0">
            <div class="card pd-20 pd-sm-10 ">
                    <div class="d-flex align-items-center">

                   <img src="../img/topup.svg" alt="mikbotam.id" >
                                <div class="mg-l-10">
                            <span class="tx-15 tx-spacing-1 tx-gray-500">
                    Top up Debit</br> bulan ini<br><br>
                                    <h6 class="tx-inverse mg-b-0">  <?=rupiah(getcounttopup());?></h6>
                    </div>
                </div></div>



                <!-- card -->
            </div>
            <!-- col-3 -->
            <div class="col-sm-6 col-xl-3 mg-t-10 mg-xl-t-0">
                            <div class="card pd-15 pd-sm-10 ">
                    <div class="d-flex align-items-center">

                   <img src="../img/mutasi.svg" alt="mikbotam.id" >
                                <div class="mg-l-10">
                            <span class="tx-15 tx-spacing-1 tx-gray-500">
                    Mutasi Voucher</br> bulan ini<br><br>
                                    <h6 class="tx-inverse mg-b-0">   <?=rupiah(estimasidata());?></h6>
                    </div>
                </div></div>

                <!-- card -->
            </div>
            <!-- col-3 -->
            <div class="col-sm-6 col-xl-3 mg-t-10 mg-xl-t-0">
                <div class="card pd-20 pd-sm-10 ">
                    <div class="d-flex align-items-center">

                   <img src="../img/newuser.svg" alt="mikbotam.id" >
                                <div class="mg-l-10">
                            <span class="tx-15 tx-spacing-1 tx-gray-500">
                    User + </br> bulan ini<br><br>
                    <h6 class="tx-inverse mg-b-0">   <?='+' . countuser() . ' User';?></h6>
                    </div>
                </div></div>
                <!-- card -->
            </div>
            <!-- col-3 -->
        </div>
        <!-- row -->
        <div class="row row-sm mg-t-10-force">
            <div class="col-lg-8">
                <div class="card bd-primary mg-t-10 ">
                    <div class="card-header bg-primary tx-white "><i class="fa fa-usd"></i> Pendapatan Bulan ini </div>
                    <div class="card-body">
                        <div class="table-wrapper">
                            <table id="userhistory" class="table display  nowrap " width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID USER</th>
                                        <th>Keterangan</th>
                                                    <th>Jumlah</th>
                                        <th>Waktu</th>
                                        <th>Tanggal</th>
                                        <th>Saldo Akhir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $TotalReg = count($datavoucher);
                                        for ($i = 0; $i < $TotalReg; $i++) {
                                            $datas            = $datavoucher[$i];
                                            $no               = $i + 1;
                                            $id_user          = $datas['id_user'];
                                            $nama_seller      = $datas['nama_seller'];
                                            $saldo_awal       = $datas['saldo_awal'];
                                            $beli_voucher     = $datas['beli_voucher'];
                                            $saldo_akhir      = $datas['saldo_akhir'];
                                            $top_up           = $datas['top_up'];
                                            $top_up_fromid    = $datas['top_up_fromid'];
                                            $username_voucher = $datas['username_voucher'];
                                            $password_voucher = $datas['password_voucher'];
                                            $exp_voucher      = $datas['exp_voucher'];

                                            $keterangan = $datas['keterangan'];
                                            if ($keterangan == 'Success') {
                                                $ket = "<span class='label label-success m-r-15'>$keterangan  Voc $exp_voucher</span>";
                                            } elseif ($keterangan == 'gagalprint') {
                                                $ket = "<span class='label label-warning m-r-15'>$keterangan </span>";
                                            } elseif ($keterangan == 'gagal') {
                                                $ket = "<span class='label label-warning m-r-15'>$keterangan</span>";
                                            } else {
                                                $ket          = "<span class='label label-info m-r-15'>$keterangan</span>";
                                                $beli_voucher = $top_up;
                                            }
                                            $Waktu   = $datas['Waktu'];
                                            $Tanggal = $datas['Tanggal'];
                                            echo "<tr>";
                                            echo "<td>" . $no . "</td>";
                                            echo "<td>" . $id_user . "</td>";
                                            echo "<td>" . $ket . "</td>";
                                            echo "<td>" . rupiah($beli_voucher) . "</td>";
                                            echo "<td>" . $Waktu . "</td>";
                                            echo "<td>" . $Tanggal . "</td>";

                                            echo "<td>" . rupiah($saldo_akhir) . "</td>";

                                            echo "</tr>";
                                        }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- card-body -->
                </div>
                <div class="card bd-primary mg-t-20">
                    <div class="card-header bg-primary tx-white "><i class="fa fa-television"></i> Traffic </div>
                    <div class="card-body">
                    </div>
                    <!-- card-body -->
                </div>
            </div>
            <div class="col-lg-4 mg-t-10">
                <div class="card bd bd-primary">
                    <div class="card-body ">
                        <div class="pd-8 pd-sm-8 bg-primary">
                            <div class="d-flex align-items-center">
                               <img src="../img/router.svg" alt="mikbotam.id" style="width: 20%;">
                                <div class="mg-l-10">
                                    <span class="tx-15 tx-spacing-1 tx-white">
                    Router Name : <?=$routername;?><br>
                    Model :  <?=$board;?><br>
                    Router OS : <?=$version;?><br>
                    <div class="up-time"> </div>
                    </span>
                                    <h6 class="tx-inverse mg-b-0"></h6>
                                </div>
                            </div>
                        </div>
                        <!-- card -->
                        <hr>
                       <div class="pd-8 pd-sm-8  mg-t-2">
                            <div class="d-flex align-items-center">
                                <img src="../img/cpu.svg" alt="mikbotam.id" style="width: 20%;">
                                <div class="mg-l-15">
                                    <span class="tx-15 tx-spacing-1 tx-gray-500">
                    Cpu : <?=$cpu;?><br>
                    Cpu Freq : <?=$cpufreq;?><br>
                   <div class="cpu-load"> </div>
                    Cpu Count: <?=$cpucount;?></span>
                                    <h6 class="tx-inverse mg-b-0"></h6>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="pd-8 pd-sm-8  mg-t-2">
                            <div class="d-flex align-items-center">
                                <img src="../img/tools.svg" alt="mikbotam.id" style="width: 20%;">
                                <div class="mg-l-15">
                                    <span class="tx-15 tx-spacing-1 tx-gray-500">
                    Memory free : <?=$fremem;?><br>
                    Hardisk free :  <?=$frehdd;?><br>
                    BadBlock hd : <?=$kerusakan . ' %';?></span>
                                    <h6 class="tx-inverse mg-b-0"></h6>
                                </div>
                            </div>
                        </div>
                        <!-- card -->

                        <!-- card -->
                        <hr>
                        <div class="pd-8 pd-sm-8  mg-t-2">
                            <div class="d-flex align-items-center">
                                <img src="../img/tower.svg" alt="mikbotam.id" style="width: 20%;">
                                <div class="mg-l-15">
                                    <span class="tx-15 tx-spacing-1 tx-gray-500">
                    <div class="ap-online">  </div>
                    Tgl    :  <?=date('d-m-Y');?><br>
                    </span>
                                    <h6 class="tx-inverse mg-b-0"></h6>
                                </div>
                            </div>
                        </div>
                        <!-- card -->
                        <hr>
                       <div class="pd-8 pd-sm-8  mg-t-2">
                            <div class="d-flex align-items-center">
                                <img src="../img/newuser.svg" alt="mikbotam.id" style="width: 20%;">
                                <div class="mg-l-10">
                                    <span><div class="user-online"></div>  <br>
                  </span>
                                    <h6 class="tx-inverse mg-b-0"></h6>
                                </div>
                            </div>
                        </div>
                                                <hr>
                        <div class="pd-8 pd-sm-8  mg-t-2">
                            <div class="d-flex align-items-center">
                               <img src="../img/logoM.svg" alt="mikbotam.id" style="width: 20%;">
                                <div class="mg-l-15">
                                    <span class="tx-15 tx-spacing-1 tx-gray-500">
                    Name : Mikbotam <br>
                    Version :  1.2 Beta <br>
                    Tgl    :  <?=date('d-m-Y');?><br>
                    </span>
                                    <h6 class="tx-inverse mg-b-0"></h6>
                                </div>
                            </div>
                        </div>
                        <!-- card -->
                    </div>
                    <!-- card -->
                </div>
            </div>
        </div>
    </div>

