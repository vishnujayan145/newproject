 <!-- Main Container -->
 <?php
 error_reporting(0);?>
            <main id="main-container">

                <!-- Page Content -->
                <div class="content">
                  

                    <!-- Full Table -->
                    <div class="block">
                        <div class="block-header block-header-default">
                            <span class="block-title">
                                 <h2 class="content-heading">Reports</h2>
                            </span>
                        </div>
                        <div>
                            
                            
                        <form action="<?=base_url()?>trip_sheet_admin/reports?" method="get" name="myxfrm" enctype="multipart/form-data" onsubmit="return validateForm();">
                            <div class="dropdown float-right">
                                <label for="example-select">&nbsp;</label>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-secondary">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="dropdown float-right">
                                 <label for="example-select">Cargo Name</label>
                                 <div>
                                    <select class="form-control" id="cargo_name" name="cargo_name">
                                        <option value=""></option>
                                        <option value="all" <?php if(isset($_GET['cargo_name']) && $_GET['cargo_name']=='all'){ echo 'selected="true"'; } ?>>All</option>
                                        <?php
                                        if($cargos!=null)
                                        {
                                        foreach ($cargos as $key => $cargosvlu) {
                                        ?>
                                        <option value="<?=$cargosvlu->cargo_name?>" <?php if(isset($_GET['cargo_name']) && $_GET['cargo_name']==$cargosvlu->id){ echo 'selected="true"'; } ?>><?=$cargosvlu->cargo_name?></option>
                                        <?php
                                        }
                                        }
                                        ?> 
                              
                                    </select>
                                 </div>
                                 
                            </div>
                            <div class="dropdown float-right">
                                 <label for="example-select">Vehicle Number</label>
                                 <div>
                                    <select class="form-control" id="vehicle_number" name="vehicle_number" onchange="vehiclenumberchange(this.value)" onclick="vehiclenumberchange(this.value)" >
                                    <option value=""></option>
                                       <option value="all" <?php if(isset($_GET['vehicle_number']) && $_GET['vehicle_number']=='all'){ echo 'selected="true"'; } ?>>All</option>
                                        <?php
                                        if($vehicles!=null)
                                        {
                                        foreach ($vehicles as $key => $vehiclesvlu) {
                                        ?>
                                        <option value="<?=$vehiclesvlu->id?>" <?php if(isset($_GET['vehicle_number']) && $_GET['vehicle_number']==$vehiclesvlu->id){ echo 'selected="true"'; } ?> ><?=$vehiclesvlu->vehicle_number?></option>
                                        <?php
                                        }
                                        }
                                        ?> 
                              
                                    </select>
                                 </div>
                                 
                            </div>
                            <div class="dropdown float-right">
                                <label for="example-select">Invoice No.</label>
                                 <div>
                                    <input type="text" class="form-control" name="invoice_number" placeholder="Search invoice number.." value="<?php if(isset($_GET['invoice_number'])){ echo $_GET['invoice_number']; } ?>">
                                </div>
                            </div>


                            <div class="dropdown float-right">
                                 <label for="example-select">Branch Name</label>
                                 <div>
                                    <select class="form-control" id="branch_id" name="branch_id" >
                                       <option value="all" <?php if(isset($_GET['branch_id']) && $_GET['branch_id']=='all'){ echo 'selected="true"'; } ?>>All</option>
                                        <?php
                                        if($branches_arr!=null)
                                        {
                                        foreach ($branches_arr as $key => $branch) {
                                        ?>
                                        <option value="<?=$branch->id?>" <?php if(isset($_GET['branch_id']) && $_GET['branch_id']==$branch->id){ echo 'selected="true"'; } ?> ><?=$branch->branch_name?></option>
                                        <?php
                                        }
                                        }
                                        ?>    
                                    </select>
                                 </div>   
                            </div>
                        </form>
                            Filter By
                        </div>
                       

                        
                        <hr>
                        <div class="block-content">
                            <div class="table-responsive">
                                 <div id="ermsg"> <?= $this->session->flashdata('ermsg'); ?>  </div>
                                <table class="table table-striped table-vcenter">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Branch</th>
                                            <th>Trip No.</th>
                                            <th>Date</th>
                                            <th>Driver</th>
                                            <th>Vehicle Number</th>
                                            <th>Cargo</th>
                                            <th>Invoice</th>
                                            <th>Place</th>
                                            <th>Pcs</th>
                                            <th>Weight</th>
                                            <th>Mob.No</th>
                                            <th>Status</th>
                                            <th>Comment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
if($result!=null)
{
$slno=1;
foreach ($result as $key => $resultvlu) {
    
    if($resultvlu->status==0){
        $st="On the Way";
    }else if($resultvlu->status==1){
        $st="Out for Delivery";
    }else if($resultvlu->status==2){
        $st="In Trnsit";
    }else if($resultvlu->status==3){
        $st="Delivered";
    }else if($resultvlu->status==4){
        $st="Pending";
    }else if($resultvlu->status==5){
        $st="Not Delivered";
    }else if($resultvlu->status==6){
        $st="Recheck";
    }


   

?>
                                        <tr>
                                            <td>
                                                <?=$slno++?>
                                            </td>
                                            <td>
                                                <b><?=$resultvlu->branch_name?></b>
                                            </td>
                                            <td>
                                               
                                                <?php if( $resultvlu->destination == 'state') { ?>
                                                <a href="<?= base_url() ?>trip_sheet/cargos/<?=$resultvlu->trip_sheet_id?>"><b><?=$resultvlu->trip_sheet_name?></b></a>
                                                <?php } else {?>
                                                    <a href="<?= base_url() ?>trip_sheet/cargos_other_state/<?=$resultvlu->trip_sheet_id?>"><b><?=$resultvlu->trip_sheet_name?></b></a>

                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <b><?=$resultvlu->created_at?></b>
                                            </td>
                                            <td>
                                                <b><?=$resultvlu->vehicle_drivername?></b>
                                            </td>
                                            <td>
                                                <b><?=$resultvlu->vehicle_number?></b>
                                            </td>
                                            <td>
                                                <b><?=$resultvlu->cargo_name?></b>
                                            </td>
                                            <td>
                                                <b><?=$resultvlu->invoice_number?></b>
                                            </td>
                                            <td>
                                                <b><?=$resultvlu->place?></b>
                                            </td>
                                            <td>
                                                <b><?=$resultvlu->quantity?></b>
                                            </td>
                                            <td>
                                                <b><?=$resultvlu->weight?></b>
                                            </td>
                                            <td>
                                                <b><?=$resultvlu->mobilenumber?></b>
                                            </td>
                                            <td>
                                                <b><?=$st?></b>
                                            </td>
                                            <td>
                                                <?= ($resultvlu->status!=0) ? $resultvlu->message : ""; ?>
                                            </td>
                                        </tr>
<?php
}
}
?> 
                                    </tbody>
                                </table>
<div align="right">
<ul class="pagination">

<!-- Show pagination links -->
<?php foreach ($links as $link) {

echo "<li>". $link."</li>";
} ?>
</div>
                            </div>
                        </div>
                    </div>
                    <!-- END Full Table -->

                </div>
                <!-- END Page Content -->

            </main>
            <!-- END Main Container -->