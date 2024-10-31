 <!-- Main Container -->

            <main id="main-container">



                <!-- Page Content -->

                <div class="content">

                  



                    <!-- Full Table -->

                    <div class="block">



                        <div class="block-header block-header-default">

                            <span class="block-title">

                                 <h2 class="content-heading">List all Trip Sheet</h2>

                            </span>

                            <!-- <a href="<?=base_url()?>trip_sheet_admin/create" class="btn btn-alt-primary">

                                <i class="fa fa-plus mr-5"></i>Add Trip Sheet</a>&nbsp;  -->

                        

                        </div>

                        <div>

                            

                            

                        <form action="<?=base_url()?>trip_sheet_admin/index?" method="get" name="myxfrm" enctype="multipart/form-data" onsubmit="return validateForm();">

                            <div class="dropdown float-right">

                                <label for="example-select">&nbsp;</label>

                                <div class="input-group-append">

                                    <button type="submit" class="btn btn-secondary">

                                        <i class="fa fa-search"></i>

                                    </button>

                                </div>

                            </div>

                            <div class="dropdown float-right">

                                 <label for="example-select">Status</label>

                                 <div>

                                     <select class="form-control" id="status" name="status">

                                        <option value="all" <?php if(isset($_GET['status']) && $_GET['status']=='all'){ echo 'selected="true"'; } ?>>All</option>

                                        <!-- <option value="0" <?php if(isset($_GET['status']) && $_GET['status']=='0'){ echo 'selected="true"'; } ?>>Active</option>
                                        <option value="1" <?php if(isset($_GET['status']) && $_GET['status']=='1'){ echo 'selected="true"'; } ?> >Inactive</option> -->
                                        <!-- <option value="0" <?php if(isset($_GET['status']) && $_GET['status']=='0'){ echo 'selected="true"'; } ?> >On the Way</option>
                                        <option value="1" <?php if(isset($_GET['status']) && $_GET['status']=='1'){ echo 'selected="true"'; } ?> > Out for Delivery</option>
                                        <option value="2" <?php if(isset($_GET['status']) && $_GET['status']=='2'){ echo 'selected="true"'; } ?> >In Transit</option>
                                        <option value="3" <?php if(isset($_GET['status']) && $_GET['status']=='3'){ echo 'selected="true"'; } ?> >Delivered</option> -->

                                        <option value="7" <?php if(isset($_GET['status']) && $_GET['status']=='7'){ echo 'selected="true"'; } ?> >Trip Created</option>
                                        <option value="1" <?php if(isset($_GET['status']) && $_GET['status']=='1'){ echo 'selected="true"'; } ?> >Trip Started</option>
                                        <option value="0" <?php if(isset($_GET['status']) && $_GET['status']=='0'){ echo 'selected="true"'; } ?> >On the Way</option>
                                        <option value="2" <?php if(isset($_GET['status']) && $_GET['status']=='2'){ echo 'selected="true"'; } ?> >Trip Finished</option>  
                                     </select>

                                 </div> 

                            </div>

                            <div class="dropdown float-right">
                                 <label for="example-select">Vehicle Number</label>
                                 <div>
                                    <select class="form-control" id="vehicle_number" name="vehicle_number" onchange="vehiclenumberchange(this.value)" onclick="vehiclenumberchange(this.value)" >
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
                                 <label for="example-select">Branch Name</label>
                                 <div>
                                    <select class="form-control" id="branch_id" name="branch_id"  >
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

                                            <th>Trip NO</th>
                                            <th>Branch</th>

                                            <th>Vehicle/Vendor Details</th>

                                            <th>Trip Details</th>

                                            <th>Expense Details</th>

                                            <th style="width: 15%;">Status</th>

                                            <th class="text-center" style="width: 100px;">Actions</th>

                                        </tr>

                                    </thead>

                                    <tbody>

<?php

if($result!=null)

{

foreach ($result as $key => $resultvlu) {

    $bgcolor =  ($resultvlu->destination =='other_state') ? 'background-color:#f1c9ff':'';

?>

                                        <tr style="<?=$bgcolor?>">

                                            <td>

                                                <b><?=$resultvlu->trip_sheet_name?></b>                                            

                                            </td>

                                            <td>

                                                <b><?=$resultvlu->branch_name?></b>                                            

                                                </td>

                                            <td>
                                            <?php if( $resultvlu->vendor_or_vehicle == 'vendor') { ?>
                                                    <b>Vendor Name</b>  :<?=$resultvlu->vendor_name?><br>
                                                    <b>Vendor Mobile</b> :<?=$resultvlu->mobile?><br>
                                                    <b>Authorized Person</b>  :<?=$resultvlu->autorized_person?><br>
                                                <?php 
                                                 } else { ?>

                                                <b>Vehicle No</b>  :<?=$resultvlu->vehicle_number?><br>

                                                <b>Driver Name</b> :<?=$resultvlu->vehicle_drivername?><br>

                                                <b>Driver Mob</b>  :<?=$resultvlu->vehicle_drivermobilenumber?><br>

                                                <?php } ?>

                                            </td>

                                            <td>

                                                <b>Trip Date</b> :<?=$resultvlu->trip_date?> <?=$resultvlu->trip_time?><br>

                                                <b>Start K.M</b> :<?=$resultvlu->start_km?> | <b>Stop K.M</b> :<?=$resultvlu->stop_km?><br>

                                               <b>Total K.M</b>  :<?=$resultvlu->total_km?><br>

                                            </td>

                                            <td>

                                                <b>Expense Total</b>   :<?=$resultvlu->exp_total?><br>

                                                <b>Expense Advance</b> :<?=$resultvlu->exp_advance?><br>

                                                <b>Balance</b>         :<?=$resultvlu->balance_amt?><br>

                                            </td>

                                            <td> 

                                                    <?php

                                                        if($resultvlu->status==0){

                                                            echo " <span class='badge badge-secondary'>On the Way</span>";

                                                        }

                                                        else if($resultvlu->status==1){

                                                             echo " <span class='badge badge-warning'>Trip Started</span>";

                                                        } else if($resultvlu->status==2){

                                                             echo " <span class='badge badge-info'>Trip Finished</span>";

                                                        } 
                                                        
                                                        // else if($resultvlu->status==3){

                                                        //      echo " <span class='badge badge-success'>Delivered</span>";

                                                        
                                                        // } else if($resultvlu->status==4){

                                                        //     echo " <span class='badge badge-warning'>Pending</span>";

                                                        // } else if($resultvlu->status==5){

                                                        //     echo " <span class='badge badge-danger'>Not Delivered</span>";

                                                        // }

                                                        

                                                    ?>

                                               

                                            </td>



                                            <td class="text-center">

                                                <div class="btn-group">

                                                    <a href="<?=base_url()?>trip_sheet_admin/print/<?=$resultvlu->id?>" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Print">

                                                        <i class="si si-printer"></i>

                                                    </a>
                                                   <?php  if($resultvlu->destination =='other_state') { ?>
                                                        <a href="<?=base_url()?>trip_sheet_admin/cargos_other_state/<?=$resultvlu->id?>" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Add Cargos">
                                                        <i class="fa fa-truck"></i>
                                                    <?php } else { ?>
                                                        <a href="<?=base_url()?>trip_sheet_admin/cargos/<?=$resultvlu->id?>" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Add Cargos">
                                                        <i class="fa fa-truck"></i>
                                                        </a>
                                                    <?php }  ?>
                                                    <a href="<?=base_url()?>trip_sheet_admin/update/<?=$resultvlu->id?>" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Update Trip Sheet">

                                                        <i class="fa fa-pencil"></i>

                                                    </a>

                                                </div>

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