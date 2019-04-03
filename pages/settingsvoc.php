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
     *  all damage caused by editing we will not be responsible please think carefully,
     *
     */

    //=====================================================START SCRIPT====================//

    session_start();
 error_reporting(0);
    if (!isset($_SESSION["Mikbotamuser"])) {
        header("Location:../admin/login.php");
    } else {

        include '../Api/routeros_api.class.php';
        include '../config/system.conn.php';

        $API = new routeros_api();
        if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
            $ARRAY     = $API->comm('/ip/hotspot/user/profile/print');
            $serverhot = $API->comm('/ip/hotspot/print');
        }

        $id = $_SESSION['Mikbotamid'];

        if (isset($_POST['save'])) {
            if (!empty($_POST['vocname_1'])) {
                $voc1 = [
                    "id" => "0",
                    "Voucher" => $_POST['vocname_1'],
                    "price" => $_POST['price_2'],
                    "profile" => $_POST['profile_3'],
                    "markup" => $_POST['markup_0'],
                    "server" => $_POST['server_0'],
                    "Limit" => $_POST['limit_4'],
                    "type" => $_POST['Type_0'],
                    "length" => $_POST['length_1']
                ];
            } else {
            }
            if (!empty($_POST['vocname_5'])) {
                $voc2 = [
                    "id" => "1",
                    "Voucher" => $_POST['vocname_5'],
                    "price" => $_POST['price_6'],
                    "profile" => $_POST['profile_7'],
                    "markup" => $_POST['markup_1'],
                    "server" => $_POST['server_1'],
                    "Limit" => $_POST['limit_8'],
                    "type" => $_POST['Type_1'],
                    "length" => $_POST['length_2']
                ];
            }
            if (!empty($_POST['vocname_9'])) {
                $voc3 =
                    [
                    "id" => "2",
                    "Voucher" => $_POST['vocname_9'],
                    "price" => $_POST['price_10'],
                    "profile" => $_POST['profile_11'],
                    "markup" => $_POST['markup_2'],
                    "server" => $_POST['server_2'],
                    "Limit" => $_POST['limit_12'],
                    "type" => $_POST['Type_2'],
                    "length" => $_POST['length_3']
                ];
            }
            if (!empty($_POST['vocname_13'])) {
                $voc4 =
                    [
                    "id" => "3",
                    "Voucher" => $_POST['vocname_13'],
                    "price" => $_POST['price_14'],
                    "profile" => $_POST['profile_15'],
                    "markup" => $_POST['markup_3'],
                    "server" => $_POST['server_3'],
                    "Limit" => $_POST['limit_16'],
                    "type" => $_POST['Type_3'],
                    "length" => $_POST['length_4']
                ];
            }
            if (!empty($_POST['vocname_17'])) {
                $voc5 =
                    [
                    "id" => "4",
                    "Voucher" => $_POST['vocname_17'],
                    "price" => $_POST['price_18'],
                    "profile" => $_POST['profile_19'],
                    "markup" => $_POST['markup_4'],
                    "server" => $_POST['server_4'],
                    "Limit" => $_POST['limit_20'],
                    "type" => $_POST['Type_4'],
                    "length" => $_POST['length_5']
                ];
            }
            if (!empty($_POST['vocname_21'])) {
                $voc6 =
                    [
                    "id" => "5",
                    "Voucher" => $_POST['vocname_21'],
                    "price" => $_POST['price_22'],
                    "profile" => $_POST['profile_23'],
                    "markup" => $_POST['markup_5'],
                    "server" => $_POST['server_5'],
                    "type" => $_POST['Type_5'],
                    "Limit" => $_POST['limit_24'],
                    "length" => $_POST['length_6']
                ];
            }

            $voc        = [$voc1, $voc2, $voc3, $voc4, $voc5, $voc6];
            $first      = array_filter($voc);
            $sendfungsi = json_encode($first);
            $updatedata = upvoc($sendfungsi, $id);
            unset($datajson);
        }

        if (isset($_POST['hapus'])) {
            $first      = null;
            $sendfungsi = json_encode($first);
            $updatedata = upvoc($sendfungsi, $id);
        }

        $ARRAYvoc = getvoc($id);

        $datajson = json_decode($ARRAYvoc, true);
    }
?>


    <div class="sl-pagebody">
        <div class="bd-primary mg-t-10">
            <div class="card bd-primary">
                <div class="card-header bg-primary tx-white"> <i class="fa fa-gear"></i> Voucher Settings &nbsp; | &nbsp;&nbsp;<i onclick="Reload();" class="fa fa-refresh pointer " title="Reload data"></i></div>
                <div class="card-body pd-sm-15">
                    <form method="post">
                        <div class="row row-sm mg-t--1">
                            <div class="col-xl-6 mg-t-10">
                                <div class="card bd-primary">
                                    <div class="card-header bg-primary tx-white">Voucher
                                        <?=markup($datajson[0]['price'], $datajson[0]['markup']);?>
                                    </div>
                                    <div class="card-body pd-sm-15">
                                        <!-- row -->
                                        <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Nama Voucher  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <input type="text" class="form-control" name="vocname_1" value="<?=$datajson[0]['Voucher'];?>">
                                            </div>
                                        </div>
                                        <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Harga Voucher  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <div class="input-group">
                                                    <span class="input-group-addon bg-transparent">
<label class="wd-8 lh-8">
                                            Rp.
                                                </label>
                                                </span>
                                                    <input type="text" class="form-control" name="price_2" value="<?=$datajson[0]['price'];?>" onkeypress="return isNumber(event)">
                                                </div>
                                            </div>
                                        </div>
                                         <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Markup Voucher  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <div class="input-group">
                                                    <span class="input-group-addon bg-transparent">
<label class="wd-8 lh-8">
                                            Rp.
                                                </label>
                                                </span>
                                                    <input type="text" class="form-control" name="markup_0" value="<?php if (!empty($datajson[0]['markup'])) {echo $datajson[0]['markup'];} else {echo '0';}?>" onkeypress="return isNumber(event)">
                                                </div>
                                            </div>
                                        </div>
                                                                                <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Server  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <select class="form-control select2id" name="server_0" data-placeholder="Select Server  ">

                                <option value="<?=$datajson[0]['server'];?>"><?=$datajson[0]['server'];?></option>
                                <option value="all">all</option>

                                <?php foreach ($serverhot as $index => $jambu): ?>
                                           <option value="<?=$jambu['name'];?>"><?php echo $jambu['name']; ?></option>
                                        <?php endforeach;?>

                                </select>
                                            </div>
                                        </div>
                                        <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Profile  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <select class="form-control select2id" name="profile_3" data-placeholder="Select Profile">
                                <option value="<?=$datajson[0]['profile'];?>"><?=$datajson[0]['profile'];?></option>
                                <?php foreach ($ARRAY as $index => $jambu): ?>
                                           <option value="<?=$jambu['name'];?>"><?php echo $jambu['name']; ?></option>
                                        <?php endforeach;?>

                                </select>
                                            </div>
                                        </div>
                                        <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Limit Uptime  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <input type="text" class="form-control" name="limit_4" value="<?=$datajson[0]['Limit'];?>">
                                            </div>
                                        </div>
                                                                                  <div class="row mg-t-10 mg-b-10">
                                            <label class="col-sm-4 form-control-label">Type Login  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">                                           <select class="form-control select2id" name="Type_0" data-placeholder="Select Type">
                                <option value="<?=$datajson[0]['type'];?>"><?=$datajson[0]['type'];?></option>

                                 <option value="up">Username & Password</option>
                                  <option value="userpass">Username = Password</option>

                                </select>
                                </div>
                                        </div>
                                        <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Length Character  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">

                                                <input id="colorful1" class="form-control" name="length_1" type="number"  min="1" max="10" value="<?php if (!empty($datajson[1]['length'])) {echo $datajson[1]['length'];} else {echo '1';}?>" onkeypress="return isNumber(event)"/>
                                            </div>
                                        </div>
                                        <!-- card-body -->
                                    </div>
                                    <!-- card-body -->
                                </div>
                                <!-- card -->
                            </div>
                            <div class="col-xl-6 mg-t-10">
                                <div class="card bd-primary">
                                    <div class="card-header bg-primary tx-white">Voucher
                                         <?=markup($datajson[1]['price'], $datajson[1]['markup']);?>
                                    </div>
                                    <div class="card-body pd-sm-15">
                                        <!-- row -->
                                        <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Nama Voucher  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <input type="text" class="form-control" name="vocname_5" value="<?=$datajson[1]['Voucher'];?>">
                                            </div>
                                        </div>

                                        <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Harga Voucher  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <div class="input-group">
                                                    <span class="input-group-addon bg-transparent">
<label class="wd-8 lh-8">
                                            Rp.
                                                </label>
                                                </span>
                                                    <input type="text" class="form-control" name="price_6" value="<?=$datajson[1]['price'];?>" onkeypress="return isNumber(event)"></div>
                                            </div>
                                        </div>
                                                                                 <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Markup Voucher  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <div class="input-group">
                                                    <span class="input-group-addon bg-transparent">
<label class="wd-8 lh-8">
                                            Rp.
                                                </label>
                                                </span>
                                                    <input type="text" class="form-control" name="markup_1" value="<?php if (!empty($datajson[1]['markup'])) {echo $datajson[1]['markup'];} else {echo '0';}?>" onkeypress="return isNumber(event)">
                                                </div>
                                            </div>
                                        </div>
                                                                                <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Server  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <select class="form-control select2id" name="server_1" data-placeholder="Select Server  ">

                                <option value="<?=$datajson[1]['server'];?>"><?=$datajson[1]['server'];?></option>
                               <option value="all">all</option>
                                <?php foreach ($serverhot as $index => $jambu): ?>
                                           <option value="<?=$jambu['name'];?>"><?php echo $jambu['name']; ?></option>
                                        <?php endforeach;?>

                                </select>
                                            </div>
                                        </div>
                                        <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Profile  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <select class="form-control select2id" name="profile_7" data-placeholder="Select Profile">
                                <option value="<?=$datajson[1]['profile'];?>"><?=$datajson[1]['profile'];?></option>
                                <?php foreach ($ARRAY as $index => $jambu): ?>
                                           <option value="<?=$jambu['name'];?>"><?php echo $jambu['name']; ?></option>
                                        <?php endforeach;?>

                                </select>
                                            </div>
                                        </div>
                                        <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Limit Uptime  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <input type="text" class="form-control" name="limit_8" value="<?=$datajson[1]['Limit'];?>" >
                                            </div>
                                        </div>
                                          <div class="row mg-t-10 mg-b-10">
                                            <label class="col-sm-4 form-control-label">Type Login  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">                                           <select class="form-control select2id" name="Type_1" data-placeholder="Select Type">
                                <option value="<?=$datajson[1]['type'];?>"><?=$datajson[1]['type'];?></option>

                                 <option value="up">Username & Password</option>
                                  <option value="userpass">Username = Password</option>

                                </select>
                                </div>
                                        </div>
                                        <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Length Character  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">

                                                <input id="colorful2" class="form-control" name="length_2" type="number"  min="1" max="10" value="<?php if (!empty($datajson[1]['length'])) {echo $datajson[1]['length'];} else {echo '1';}?>" onkeypress="return isNumber(event)"/>
                                            </div>
                                        </div>
                                        <!-- card-body -->
                                    </div>
                                    <!-- card-body -->
                                </div>
                                <!-- card -->
                            </div>
                            <div class="col-xl-6 mg-t-10">
                                <div class="card bd-primary">
                                    <div class="card-header bg-primary tx-white">Voucher
                                       <?=markup($datajson[2]['price'], $datajson[2]['markup']);?>
                                    </div>
                                    <div class="card-body pd-sm-15">
                                        <!-- row -->
                                        <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Nama Voucher  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <input type="text" class="form-control" name="vocname_9" value="<?=$datajson[2]['Voucher'];?>">
                                            </div>
                                        </div>
                                        <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Harga Voucher  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <div class="input-group">
                                                    <span class="input-group-addon bg-transparent">
<label class="wd-8 lh-8">
                                            Rp.
                                                </label>
                                                </span>
                                                    <input type="text" class="form-control" name="price_10" value="<?=$datajson[2]['price'];?>" onkeypress="return isNumber(event)"></div>
                                            </div>
                                        </div>
                                                                                 <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Markup Voucher  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <div class="input-group">
                                                    <span class="input-group-addon bg-transparent">
<label class="wd-8 lh-8">
                                            Rp.
                                                </label>
                                                </span>
                                                    <input type="text" class="form-control" name="markup_2" value="<?php if (!empty($datajson[2]['markup'])) {echo $datajson[2]['markup'];} else {echo '0';}?>" onkeypress="return isNumber(event)">
                                                </div>
                                            </div>
                                        </div>
                                                                                <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Server  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <select class="form-control select2id" name="server_2" data-placeholder="Select Server  ">

                                <option value="<?=$datajson[2]['server'];?>"><?=$datajson[2]['server'];?></option>
                               <option value="all">all</option>
                                <?php foreach ($serverhot as $index => $jambu): ?>
                                           <option value="<?=$jambu['name'];?>"><?php echo $jambu['name']; ?></option>
                                        <?php endforeach;?>

                                </select>
                                            </div>
                                        </div>
                                        <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Profile  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <select class="form-control select2id" name="profile_11" data-placeholder="Select Profile">
                                <option value="<?=$datajson[2]['profile'];?>"><?=$datajson[2]['profile'];?></option>
                                <?php foreach ($ARRAY as $index => $jambu): ?>
                                           <option value="<?=$jambu['name'];?>"><?php echo $jambu['name']; ?></option>
                                        <?php endforeach;?>

                                </select>
                                            </div>
                                        </div>
                                        <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Limit Uptime  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <input type="text" class="form-control" name="limit_12" value="<?=$datajson[2]['Limit'];?>">
                                            </div>
                                        </div>

                                                                                  <div class="row mg-t-10 mg-b-10">
                                            <label class="col-sm-4 form-control-label">Type Login  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">                                           <select class="form-control select2id" name="Type_2" data-placeholder="Select Type">
                                <option value="<?=$datajson[2]['type'];?>"><?=$datajson[2]['type'];?></option>

                                 <option value="up">Username & Password</option>
                                  <option value="userpass">Username = Password</option>

                                </select>
                                </div>
                                        </div>
                                        <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Length Character  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">

                                                <input id="colorful3" class="form-control" name="length_3" type="number"  min="1" max="10" value="<?php if (!empty($datajson[2]['length'])) {echo $datajson[2]['length'];} else {echo '1';}?>" onkeypress="return isNumber(event)"/>
                                            </div>
                                        </div>
                                        <!-- card-body -->
                                    </div>
                                    <!-- card-body -->
                                </div>
                                <!-- card -->
                            </div>
                            <div class="col-xl-6 mg-t-10">
                                <div class="card bd-primary">
                                    <div class="card-header bg-primary tx-white">Voucher
                                        <?=markup($datajson[3]['price'], $datajson[3]['markup']);?>
                                    </div>
                                    <div class="card-body pd-sm-15">
                                        <!-- row -->
                                        <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Nama Voucher  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <input type="text" class="form-control" name="vocname_13" value="<?=$datajson[3]['Voucher'];?>">
                                            </div>
                                        </div>
                                        <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Harga Voucher  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <div class="input-group">
                                                    <span class="input-group-addon bg-transparent">
<label class="wd-8 lh-8">
                                            Rp.
                                                </label>
                                                </span>
                                                    <input type="text" class="form-control" name="price_14" value="<?=$datajson[3]['price'];?>" onkeypress="return isNumber(event)"></div>
                                            </div>
                                        </div>
                                                                                 <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Markup Voucher  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <div class="input-group">
                                                    <span class="input-group-addon bg-transparent">
<label class="wd-8 lh-8">
                                            Rp.
                                                </label>
                                                </span>
                                                    <input type="text" class="form-control" name="markup_3" value="<?php if (!empty($datajson[3]['markup'])) {echo $datajson[3]['markup'];} else {echo '0';}?>" onkeypress="return isNumber(event)">
                                                </div>
                                            </div>
                                        </div>
                                                                                <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Server  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <select class="form-control select2id" name="server_3" data-placeholder="Select Server  ">

                                <option value="<?=$datajson[3]['server'];?>"><?=$datajson[3]['server'];?></option>
                                <option value="all">all</option>

                                <?php foreach ($serverhot as $index => $jambu): ?>
                                           <option value="<?=$jambu['name'];?>"><?php echo $jambu['name']; ?></option>
                                        <?php endforeach;?>

                                </select>
                                            </div>
                                        </div>
                                        <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Profile  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <select class="form-control select2id" name="profile_15" data-placeholder="Select Profile">
                                <option value="<?=$datajson[3]['profile'];?>"><?=$datajson[3]['profile'];?></option>
                                <?php foreach ($ARRAY as $index => $jambu): ?>
                                           <option value="<?=$jambu['name'];?>"><?php echo $jambu['name']; ?></option>
                                        <?php endforeach;?>

                                </select>
                                            </div>
                                        </div>
                                        <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Limit Uptime  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <input type="text" class="form-control" name="limit_16" value="<?=$datajson[3]['Limit'];?>">
                                            </div>
                                        </div>
                                                                                  <div class="row mg-t-10 mg-b-10">
                                            <label class="col-sm-4 form-control-label">Type Login  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">                                           <select class="form-control select2id" name="Type_3" data-placeholder="Select Type">
                                <option value="<?=$datajson[3]['type'];?>"><?=$datajson[3]['type'];?></option>

                                 <option value="up">Username & Password</option>
                                  <option value="userpass">Username = Password</option>

                                </select>
                                </div>
                                        </div>

                                        <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Length Character  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">

                                                <input id="colorful4" class="form-control" name="length_4" type="number"  min="1" max="10" value="<?php if (!empty($datajson[3]['length'])) {echo $datajson[3]['length'];} else {echo '1';}?>" onkeypress="return isNumber(event)"/>
                                            </div>
                                        </div>
                                        <!-- card-body -->
                                    </div>
                                    <!-- card-body -->
                                </div>
                                <!-- card -->
                            </div>
                            <div class="col-xl-6 mg-t-10">
                                <div class="card bd-primary">
                                    <div class="card-header bg-primary tx-white">Voucher
                                        <?=markup($datajson[4]['price'], $datajson[4]['markup']);?>
                                    </div>
                                    <div class="card-body pd-sm-15">
                                        <!-- row -->
                                        <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Nama Voucher  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <input type="text" class="form-control" name="vocname_17" value="<?=$datajson[4]['Voucher'];?>">
                                            </div>
                                        </div>
                                        <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Harga Voucher  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <div class="input-group">
                                                    <span class="input-group-addon bg-transparent">
<label class="wd-8 lh-8">
                                            Rp.
                                                </label>
                                                </span>
                                                    <input type="text" class="form-control" name="price_18" value="<?=$datajson[4]['price'];?>" onkeypress="return isNumber(event)">
                                                </div>
                                            </div>
                                        </div>
                                                                                 <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Markup Voucher  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <div class="input-group">
                                                    <span class="input-group-addon bg-transparent">
<label class="wd-8 lh-8">
                                            Rp.
                                                </label>
                                                </span>
                                                    <input type="text" class="form-control" name="markup_4" value="<?php if (!empty($datajson[4]['markup'])) {echo $datajson[4]['markup'];} else {echo '0';}?>" onkeypress="return isNumber(event)">
                                                </div>
                                            </div>
                                        </div>
                                                                               <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Server  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <select class="form-control select2id" name="server_4" data-placeholder="Select Server  ">

                                <option value="<?=$datajson[4]['server'];?>"><?=$datajson[4]['server'];?></option>
                               <option value="all">all</option>
                                <?php foreach ($serverhot as $index => $jambu): ?>
                                           <option value="<?=$jambu['name'];?>"><?php echo $jambu['name']; ?></option>
                                        <?php endforeach;?>

                                </select>
                                            </div>
                                        </div>
                                        <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Profile  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <select class="form-control select2id" name="profile_19" data-placeholder="Select Profile">
                                <option value="<?=$datajson[4]['profile'];?>"><?=$datajson[4]['profile'];?></option>
                                <?php foreach ($ARRAY as $index => $jambu): ?>
                                           <option value="<?=$jambu['name'];?>"><?php echo $jambu['name']; ?></option>
                                        <?php endforeach;?>

                                </select>
                                            </div>
                                        </div>
                                        <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Limit Uptime  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <input type="text" class="form-control" name="limit_20" value="<?=$datajson[4]['Limit'];?>">
                                            </div>
                                        </div>

                                                                                  <div class="row mg-t-10 mg-b-10">
                                            <label class="col-sm-4 form-control-label">Type Login  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">                                           <select class="form-control select2id" name="Type_4" data-placeholder="Select Type">
                                <option value="<?=$datajson[4]['type'];?>"><?=$datajson[4]['type'];?></option>

                                 <option value="up">Username & Password</option>
                                  <option value="userpass">Username = Password</option>

                                </select>
                                </div>
                                        </div>
                                        <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Length Character  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <input id="colorful5" class="form-control" name="length_5" type="number"  min="0" max="10" value="<?php if (!empty($datajson[4]['length'])) {echo $datajson[4]['length'];} else {echo '1';}?>" onkeypress="return isNumber(event)" />
                                            </div>
                                        </div>
                                        <!-- card-body -->
                                    </div>
                                    <!-- card-body -->
                                </div>
                                <!-- card -->
                            </div>
                            <div class="col-xl-6 mg-t-10">
                                <div class="card bd-primary">
                                    <div class="card-header bg-primary tx-white">Voucher
                                        <?=markup($datajson[5]['price'], $datajson[5]['markup']);?>
                                    </div>
                                    <div class="card-body pd-sm-15">
                                        <!-- row -->
                                        <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Nama Voucher  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <input type="text" class="form-control" name="vocname_21" value="<?=$datajson[5]['Voucher'];?>">
                                            </div>
                                        </div>
                                        <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Harga Voucher  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <div class="input-group">
                                                    <span class="input-group-addon bg-transparent">
<label class="wd-8 lh-8">
                                            Rp.
                                                </label>
                                                </span>
                                                    <input type="text" class="form-control" name="price_22" value="<?=$datajson[5]['price'];?>" onkeypress="return isNumber(event)">
                                                </div>
                                            </div>
                                        </div>
                                                                                 <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Markup Voucher  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <div class="input-group">
                                                    <span class="input-group-addon bg-transparent">
<label class="wd-8 lh-8">
                                            Rp.
                                                </label>
                                                </span>
                                                    <input type="text" class="form-control" name="markup_5" value="<?php if (!empty($datajson[5]['markup'])) {echo $datajson[5]['markup'];} else {echo '0';}?>" onkeypress="return isNumber(event)">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Server  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <select class="form-control select2id" name="server_5" data-placeholder="Select Server ">

                                <option value="<?=$datajson[5]['server'];?>"><?=$datajson[5]['server'];?></option>
                               <option value="all">all</option>
                                <?php foreach ($serverhot as $index => $jambu): ?>
                                           <option value="<?=$jambu['name'];?>"><?php echo $jambu['name']; ?></option>
                                        <?php endforeach;?>

                                </select>
                                            </div>
                                        </div>
                                           <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Profile  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <select class="form-control select2id" name="profile_23" data-placeholder="Select Profile">

                                <option value="<?=$datajson[5]['profile'];?>"><?=$datajson[5]['profile'];?></option>

                                <?php foreach ($ARRAY as $index => $jambu): ?>
                                           <option value="<?=$jambu['name'];?>"><?php echo $jambu['name']; ?></option>
                                        <?php endforeach;?>

                                </select>
                                            </div>
                                        </div>
                                        <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Limit Uptime  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <input type="text" class="form-control" name="limit_24" value="<?=$datajson[5]['Limit'];?>">
                                            </div>
                                        </div>
                                                                                  <div class="row mg-t-10 mg-b-10">
                                            <label class="col-sm-4 form-control-label">Type Login  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">                                           <select class="form-control select2id" name="Type_5" data-placeholder="Select Type">
                                <option value="<?=$datajson[5]['type'];?>"><?=$datajson[5]['type'];?></option>

                                 <option value="up">Username & Password</option>
                                  <option value="userpass">Username = Password</option>

                                </select>
                                </div>
                                        </div>

                                        <div class="row mg-t-8">
                                            <label class="col-sm-4 form-control-label">Length Character  </label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <input id="colorful6" class="form-control" name="length_6" type="number"  min="0" max="10" value="<?php if (!empty($datajson[5]['length'])) {echo $datajson[5]['length'];} else {echo '1';}?>" onkeypress="return isNumber(event)" />

                                            </div>
                                        </div>
                                        <!-- card-body -->
                                    </div>
                                    <!-- card-body -->
                                </div>
                                <!-- card -->
                            </div>
                            <div class="col-xl-12 mg-t-15">
                                <div class="row row-xs mg-t-10">
                                    <div class="col-sm-20 mg-l-auto">
                                        <div class="form-layout-footer">
                                            <button class="btn btn-success lh-0 tx-xthin mg-r-0" type="submit" onClick="document.location.reload(true)" style="cursor: pointer;" name="save"><i class="fa fa-thumbs-up mg-r-2"></i> Save</button>
                                            <button class="btn btn-success lh-0 tx-xthin mg-r-0" type="submit" onClick="return confirm('Delete : Anda Yakin ?...')" style="cursor: pointer;" name="hapus"><i class="fa fa-trash mg-r-2"></i> Delete</button>
                                        </div>
                                        <!-- form-layout-footer -->
                                    </div>
                                    <!-- col-8 -->
                                </div>
                            </div>
                        </div>
                        </form>
                </div>
            </div>
            <!-- body -->
        </div>
    </div>
<script src="../js/MikbotamNumberCheck.js" ></script>
<script>

$('#colorful1,#colorful2,#colorful3,#colorful4,#colorful5,#colorful6').bootstrapNumber({
    upClass: 'success',
    downClass: 'danger'
});
</script>

