<?php
    session_start();

 error_reporting(0); 
    if (!isset($_SESSION["Mikbotamuser"])) {
        header("Location:admin/login.php");
    } else {
		include '../config/system.conn.php';
		include '../config/system.byte.php';
		include '../Api/routeros_api.class.php';
		$API = new routeros_api();
		if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port));
$getallqueue = $API->comm("/queue/simple/print", array(
    "?dynamic" => "false",
  ));

  if (isset($_POST['saveprofile'])&&!empty($_POST['name'])) {
  	 $name           = $_POST['name'];
    $shared_users   = $_POST['shared-users'];
    $rate_limit     = $_POST['rate-limit'];
    $valid          = $_POST['valid_time'];
    $lock_mac       = $_POST['lock_mac'];
    $typeexperid    = $_POST['typeexperid'];
    $getperpaid     = $_POST['graceperiod'];
    $getprice       = $_POST['price'];
    $parent 		  = $_POST['parent'];
    $trasparants  	  =$_POST['checkbox'];
    
    if (empty($getprice)) {
      $price = 0;
    } else {
      $price = $getprice;
    }
    
    $getgetan = $_POST['unrok'];
    
    if ($getgetan==true) {
      $lock = ';[:local mac $"mac-address"; /ip hotspot user set mac-address=$mac [find where name=$user]]';
    } else {
      $lock = "";
    }
    
        if ($trasparants==true) {
     $trasparant='yes';
    } else {
      $trasparant = "no";
    }
    
    $onlogin1 = ':put (",rem,' . $price . ',' . $valid . ',' . $getperpaid . ',,' . $getgetan . ',"); {:local date [/system clock get date ];:local time [/system clock get time ];:local uptime (' . $valid . ');[/system scheduler add disabled=no interval=$uptime name=$user on-event="[/ip hotspot active remove [find where user=$user]];[/ip hotspot user set limit-uptime=1s [find where name=$user]];[/sys sch re [find where name=$user]];[/sys script run [find where name=$user]];[/sys script re [find where name=$user]]" start-date=$date start-time=$time];[/system script add name=$user source=":local date [/system clock get date ];:local time [/system clock get time ];:local uptime (' . $getperpaid . ');[/system scheduler add disabled=no interval=\$uptime name=$user on-event= \"[/ip hotspot user remove [find where name=$user]];[/ip hotspot active remove [find where user=$user]];[/sys sch re [find where name=$user]]\"]"]';
    $onlogin2 = ':put (",ntf,' . $price . ',' . $valid . ',,,' . $getgetan . ',"); {:local date [/system clock get date ];:local time [/system clock get time ];:local uptime (' . $valid . ');[/system scheduler add disabled=no interval=$uptime name=$user on-event= "[/ip hotspot user set limit-uptime=1s [find where name=$user]];[/ip hotspot active remove [find where user=$user]];[/sys sch re [find where name=$user]]" start-date=$date start-time=$time]';
    $onlogin3 = ':put (",remc,' . $price . ',' . $valid . ',' . $getperpaid . ',,' . $getgetan . ',"); {:local price ("' . $price . '");:local date [/system clock get date ];:local time [/system clock get time ];:local uptime (' . $valid . ');[/system scheduler add disabled=no interval=$uptime name=$user on-event="[/ip hotspot active remove [find where user=$user]];[/ip hotspot user set limit-uptime=1s [find where name=$user]];[/sys sch re [find where name=$user]];[/sys script run [find where name=$user]];[/sys script re [find where name=$user]]" start-date=$date start-time=$time];[/system script add name=$user source=":local date [/system clock get date ];:local time [/system clock get time ];:local uptime (' . $getperpaid . ');[/system scheduler add disabled=no interval=\$uptime name=$user comment=$date-$time on-event= \"[/ip hotspot user remove [find where name=$user]];[/ip hotspot active remove [find where user=$user]];[/sys sch re [find where name=$user]]\"]"];:local bln [:pick $date 0 3]; :local thn [:pick $date 7 11];[:local mac $"mac-address"; :local profile [:put  [/ip hotspot user get $user profile]]; :local comment [:put [/ip hotspot user get $user comment]]; /system script add name="$date-|-$time-|-$user-|-$price-|-$address-|-$mac-|-' . $valid . '-|-$profile-|-$comment" owner="$bln$thn" source=$date comment=mikhbotam]';
    $onlogin4 = ':put (",ntfc,' . $price . ',' . $valid . ',,,' . $getgetan . ',"); {:local price ("' . $price . '");:local date [/system clock get date ];:local time [/system clock get time ];:local uptime (' . $valid . ');[/system scheduler add disabled=no interval=$uptime name=$user on-event= "[/ip hotspot user set limit-uptime=1s [find where name=$user]];[/ip hotspot active remove [find where user=$user]];[/sys sch re [find where name=$user]]" start-date=$date start-time=$time];:local bln [:pick $date 0 3]; :local thn [:pick $date 7 11];[:local mac $"mac-address"; :local profile [:put  [/ip hotspot user get $user profile]]; :local comment [:put [/ip hotspot user get $user comment]]; /system script add name="$date-|-$time-|-$user-|-$price-|-$address-|-$mac-|-' . $valid . '-|-$profile-|-$comment" owner="$bln$thn" source=$date comment=mikhbotam]';

    if ($typeexperid == "rem") {
      $onlogin = $onlogin1 . $lock . "}}";
    } elseif ($typeexperid == "ntf") {
      $onlogin = $onlogin2 . $lock . "}}";
    } elseif ($typeexperid == "remc") {
      $onlogin = $onlogin3 . $lock . "}}";
    } elseif ($typeexperid == "ntfc") {
      $onlogin = $onlogin4 . $lock . "}}";
    } elseif ($typeexperid == "0" && $price != "") {
      $onlogin = ':put (",,' . $price . ',,,noexp,' . $getgetan . ',")' . $lock;
    } else {
      $onlogin = "";
    }
	
    $cekout=$API->comm("/ip/hotspot/user/profile/add", array(
			  		  /*"add-mac-cookie" => "yes",*/
      "name" => $name,
      "rate-limit" => $rate_limit,
      "shared-users" => $shared_users,
      "status-autorefresh" => "1m",
      "transparent-proxy" => $trasparant,
      "on-login" => $onlogin,
      "parent-queue" => $parent,
    ));

    $getprofile = $API->comm("/ip/hotspot/user/profile/print", array(
      "?name" => $name,
    ));
    $pid = $getprofile[0]['.id'];

  	echo "<script>setTimeout(\"location.href = '?Mikbotam=addprofile';\");</script>"; }
}
?>

   <div class="sl-pagebody">
<div class="col-sm-6 pd-1-force mg-t-8">
    <div class="card bd-primary">
        <div class="card-header bg-primary tx-white">Add Profile Hotspot</div>
        <div class="card-body pd-sm-15">
                                <form method="post" action="">
            <div class="row mg-t-8">
                <label class="col-sm-4 form-control-label">Name Profile</label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" class="form-control" name="name" value="">
                </div>
            </div>
            <div class="row mg-t-8">
                <label class="col-sm-4 form-control-label">Parent Queue</label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <select class="form-control select2id" name="parent">
                        <option>none</option>
                        <?php  foreach( $getallqueue as $index => $barisan ) : ?> 

                        <option value="<?=$barisan['name']?>"><?=$barisan['name']?></option>

                       <?php  endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="row mg-t-8">
                <label class="col-sm-4 form-control-label">Rate limit [TX/RX]</label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" class="form-control" name="rate-limit" value="">
                </div>
            </div>
            <div class="row mg-t-8">
                <label class="col-sm-4 form-control-label">Shared Users</label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input id="colorful2" class="form-control" name="shared-users" type="number" min="1" max="10" value="1" onkeypress="return isNumber(event)" />
                </div>
            </div>
                        <div class="row mg-t-8">
                <label class="col-sm-4 form-control-label">Expired Mode</label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <select class="form-control select2id" name="typeexperid" data-placeholder="Select Profile">
                        <option value="0">Disable</option>
                        <option value="remc">Remove & Record</option>
                    </select>
                </div>
            </div>
                        <div class="row mg-t-8">
                <label class="col-sm-4 form-control-label">Price</label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <div class="input-group"> 
                    <span class="input-group-addon bg-transparent">
								<label class="wd-8 lh-8">Rp. </label></span>
                        <input type="text" class="form-control" name="price" value="">
                    </div>
                </div>
            </div>
                   <div class="row mg-t-8">
                <label class="col-sm-4 form-control-label">Validity</label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        <input type="text" class="form-control" name="valid_time" value="">
                </div>
            </div>

                        <div class="row mg-t-10 mg-b-10">
                <label class="col-sm-4 form-control-label">Grace Period</label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                      <input type="text" class="form-control" name="graceperiod" value="">
                </div>
            </div>

            <div class="row mg-t-10 mg-b-10">
                <label class="col-sm-4 form-control-label">Lock User</label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <select class="form-control select2id" name="unrok" data-placeholder="Select Type">
                               <option value="Disable">Disable</option>
        <option value="Enable">Enable</option>
                    </select>
                </div>
            </div>
                        <div class="row mg-t-10 mg-b-10">
                <label class="col-sm-4 form-control-label">Transparent Proxy</label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                	 <label class="ckbox">
                <input type="checkbox" name="checkbox" value="true" ><span>Transparent</span>  </label>
                </div>
            </div>
             <div class="row row-xs mg-t-8">
                                <div class="col-sm-15 mg-l-auto">
                                    <div class="form-layout-footer">
                                        <button class="btn btn-success lh-0 tx-xthin mg-r-0 mg-t-8" name="saveprofile" type="submit"><i class="fa fa-send mg-r-2"></i> Save</button>
                                        <button class="btn btn-success lh-0 tx-xthin mg-r-2 mg-t-8"><i class="fa fa-trash mg-r-2"></i> Delete</button>
                                    </div>
                                    <!-- form-layout-footer -->
                                </div>
                                <!-- col-8 -->
                            </div>
                            <!-- card-body -->
                        </form>
        </div>
    </div>
</div></div>
<script src="../js/MikbotamNumberCheck.js"></script>
<script>
$('#colorful1,#colorful2,#colorful3,#colorful4,#colorful5,#colorful6').bootstrapNumber({
    upClass: 'success',
    downClass: 'danger'
});
</script>