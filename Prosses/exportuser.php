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
    	
  if (isset($_GET['id']) && !empty($_GET['id']) &&isset($_GET['profile']) && !empty($_GET['profile'])) {
  	    	include('../config/system.conn.php');
  	    			$id=$_GET['id'];
  	   if ($_GET['profile']=='no'){
  	   include '../include/header.php';
	
		$datavoucher = sethistoryid($id);

		
		
?>


				<div class="col-lg-12 mg-l-auto">
        <div class="bd-primary mg-t-10">
	
            <div class="card bd-primary">
				<div class="card-header card-header-default bg-primary justify-content-between">
                  <h6 class="mg-b-0 tx-14 tx-white tx-normal"><i class="fa fa-gear"></i> Export Report ID <?= $datavoucher[0]['id_user'];?> &nbsp; | &nbsp;&nbsp;<i onclick="Reload();" class="fa fa-refresh pointer " title="Reload data"></i></h6>
                  <div class="card-option tx-24">
                       <input action="action" onclick="window.history.go(-1); return false;" type="button" class="btn btn-danger lh-10 " value="Back" />
                  </div><!-- card-option -->
                </div>
               
               	                    <div class="card-body pd-sm-15">
                        <div class="table-wrapper">
                          <table id="userreport" class="table display  nowrap " width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID USER</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Saldo Awal</th>
                                        <th>Voucher</th>
                                        <th>Top Up</th>
                                        <th>Saldo Akhir</th>
                                    </tr>
                                </thead>
                                  <tfoot>
    <tr>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
     <th></th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
  </tfoot>
                                <tbody>
                                    <?php
                                      	

                                    	$TotalReg = count($datavoucher);
                                    	for ($i = 0; $i < $TotalReg; $i++) {
                                    		$datas                = $datavoucher[$i];
                                    	    $no               = $i + 1;
                                           $id_user          = $datas['id_user'];
                                           $nama_seller      = $datas['nama_seller'];
                                           $saldo_awal       = rupiah($datas['saldo_awal']);
                                           
                                           
                                           if(!empty($datas['beli_voucher'])){
                                           $beli_voucher     = rupiah($datas['beli_voucher']);
                                           }else{
                                           $beli_voucher     = ' ';
                                           }
                                           
                                           $saldo_akhir       = rupiah($datas['saldo_akhir']);
                                           
                                              if(!empty($datas['top_up'])){
                                           $top_up     = $datas['top_up'];
                                           }else{
                                           $top_up     = ' ';
                                           }
   
                                           $top_up_fromid    = $datas['top_up_fromid'];
                                           $username_voucher = $datas['username_voucher'];
                                           $password_voucher = $datas['password_voucher'];
                                           $exp_voucher      = $datas['exp_voucher'];
                                           $keterangan       = $datas['keterangan'];
                                           $Waktu            = $datas['Waktu'];
                                           $Tanggal          = $datas['Tanggal'];
                                           
                                           
                                    		echo "<tr>";
                                    		echo "<td>" . $no . "</td>";
                                    		echo "<td>" . $id_user . "</td>";
                                    		echo "<td>" . $Tanggal . "</td>";
                                    		echo "<td>" . $keterangan."</td>";
                                    		echo "<td>" . $saldo_awal."</td>";
                                    		
                                    		echo "<td>" . $beli_voucher. "</td>";
                                    		echo "<td>" . $top_up . "</td>";
                                    		echo "<td>" . $saldo_akhir . "</td>";
                                    		echo "</tr>";
                                    	}
                                    	
  	
                                    ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>

            </div>
            
            <!-- body -->
        </div>

<?php  
  	   }elseif ($_GET['profile']=='yes'){
  	   	
  	   			$seeuser=lihatuser($id);
  	   		if (isset($_POST['save'])=='save'){
			
			
		}
  	   	 ?>

				<div class="card bd bd-primary ">
					<div class="card-body ">
						<div class="card mg-b-20  pd-20 pd-sm-20  bg-primary ">
							<div class="signin-logo tx-center text-capitalize tx-20 tx-bold tx-white">
								<img src="../img/newuser.svg" alt="Mikbotam.id" style="width: 85%;" class="rounded-circle border-light ">
								<br>
								<?=$seeuser['nama_seller'];
								?>
							</div>
							<div class="tx-center text-capitalize tx-white">
								<?=rupiah($seeuser['saldo']);
								?>
							</div>
						</div>
			

        <div class="input-group mg-t-10">
  <span class="input-group-addon"><i class="fa fa-user tx-primary "></i></span>
  <input type="text" class="form-control" placeholder="Username" name="username" value="<?=$seeuser['nama_seller'];?>">
</div>
<div class="input-group mg-t-10">
  <span class="input-group-addon "><i class="fa fa-qrcode tx-primary"></i></span>
  <input type="text" class="form-control" placeholder="ID user" name="id_user"value="<?=$seeuser['id_user'];?>">
  
</div>
<div class="input-group mg-t-10">
  <span class="input-group-addon "><i class="fa fa-whatsapp tx-primary"></i></span>
  <input type="text" class="form-control" placeholder="Whatsaap" name="tlp" value="<?=$seeuser['nomer_tlp'];?>">
  
</div>
<div class="input-group mg-t-10">
  <span class="input-group-addon "><i class="fa fa-usd tx-primary"></i></span>
  <input type="text" class="form-control"  placeholder="Saldo" name="saldo" value="<?=rupiah($seeuser['saldo']);?>">
  
</div>
            

						</div>
						<div class="card-footer py-sm-custom">
							<div class="row mg-t-0">

										<div class="col-sm-15 mg-l-auto">
                                    <div class="form-layout-footer">
                       <button class="btn btn-success lh-0 tx-xthin mg-r-0 mg-t-8" onclick="topupsaldo();return false;"><i class="fa fa-thumbs-up mg-r-2"></i>  Save</button>
                                        <button class="btn btn-success lh-0 tx-xthin mg-r-2 mg-t-8"><i class="fa  fa-trash"> </i> Delete</button>
                                    </div>
                                    <!-- form-layout-footer -->
                                </div>

								<!-- col-8 -->
							</div>
							<!-- card -->
						</div>
					</div>
			
<?php 
  	   }elseif ($_GET['profile']=='delete') {
  	     $delete= deleteuser($id);
  	   
  	   	echo "<script>setTimeout(\"location.href = '../pages/index.php?Mikbotam=userlist';\");</script>";
  	   }
  	   
  }else{
  	
  
	
}

}



?>
