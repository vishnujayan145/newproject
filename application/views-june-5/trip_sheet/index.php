<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">List all Trip Sheet</h4>

                        <!-- <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                <li class="breadcrumb-item active">Form Elements</li>
                            </ol>
                        </div> -->

                    </div>
                </div>
            </div>
            <!-- end page title -->  
            

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">     
                            
                        <div class="row"  style="float:right;">                              
                                <div class="col-md-12"> 
                                    <a href="<?=base_url()?>trip_sheet/create" class="btn btn-primary">
                                                    <i class="fa fa-plus"></i>Add Trip Sheet</a>
                                </div>                                
                            </div>
 
                            
                            <form action="<?=base_url()?>trip_sheet/index?" method="get" name="myxfrm" enctype="multipart/form-data" onsubmit="return validateForm();">

                          

                                <div class="row mt-2">   
                                                          
                                    <div class="col-md-2"><label for="example-select">Vendor</label></div>
                                    <div class="col-md-2"><label for="example-select">Vehicle Number</label></div>
                                    <div class="col-md-2"><label for="example-select">Status</label></div>
                                </div>

                                <div class="row">                                 

                                 
                                    <div class="col-md-2">                                   
                                  
                                        <select class="form-control" id="vendor_name" name="vendor_name">
                                        <option value="all" <?php if(isset($_GET['vendor_name']) && $_GET['vendor_name']=='all'){ echo 'selected="true"'; } ?>>All</option>
                                            <?php foreach($vendors as $vendor ) { ?>                                  
                                            <option value="<?=$vendor->id?>" <?php if(isset($_GET['vendor_name']) && $_GET['vendor_name']== $vendor->id ){ echo 'selected="true"'; } ?> ><?=$vendor->branch_name?></option>  
                                            <?php } ?>
                                        </select>
                                        
                                    </div>  

                               
                                    <div class="col-md-2">                                   
                                        <select class="form-control" id="vehicle_number" name="vehicle_number" onchange="vehiclenumberchange(this.value)" onclick="vehiclenumberchange(this.value)" >
                                            <option value="all" <?php if(isset($_GET['vehicle_number']) && $_GET['vehicle_number']=='all'){ echo 'selected="true"'; } ?>>All</option>
                                            <?php
                                            if($vehicles!=null) {
                                            foreach ($vehicles as $key => $vehiclesvlu) {
                                            ?>
                                            <option value="<?=$vehiclesvlu->id?>" <?php if(isset($_GET['vehicle_number']) && $_GET['vehicle_number']==$vehiclesvlu->id){ echo 'selected="true"'; } ?> ><?=$vehiclesvlu->vehicle_number?></option>
                                            <?php
                                            }
                                            }
                                            ?> 
                                        </select>
                                    </div>  
                                    <div class="col-md-2">                                   
                                        <select class="form-control" id="status1" name="status">
                                            <option value="all" <?php if(isset($_GET['status']) && $_GET['status']=='all'){ echo 'selected="true"'; } ?>>All</option> 
                                            <option value="7" <?php if(isset($_GET['status']) && $_GET['status']=='7'){ echo 'selected="true"'; } ?> >Trip Created</option>
                                            <option value="1" <?php if(isset($_GET['status']) && $_GET['status']=='1'){ echo 'selected="true"'; } ?> >Trip Started</option>
                                            <option value="0" <?php if(isset($_GET['status']) && $_GET['status']=='0'){ echo 'selected="true"'; } ?> >On the Way</option>
                                            <option value="2" <?php if(isset($_GET['status']) && $_GET['status']=='2'){ echo 'selected="true"'; } ?> >Trip Finished</option>  
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-2">                                   
                                    <button type="submit" class="btn btn-secondary">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                    </div>

                                </div> 
                                        
                            </form>
                                <!-- Filter By -->
                           
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
<!-- 
                            <h4 class="card-title">Textual inputs</h4>
                            <p class="card-title-desc">Here are examples of <code>.form-control</code> applied to
                                each
                                textual HTML5 <code>&lt;input&gt;</code> <code>type</code>.</p> -->




                                <div class="table-rep-plugin">
                                    <div class="table-responsive mb-0" data-pattern="priority-columns">
                                        <table id="tech-companies-1" class="table table-striped">
                                            <thead>
                                                <tr>                                                    
                                                
                                                <th>Trip NO</th>
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
                                        $bgcolor =  ($resultvlu->destination =='other_state') ? '--bs-table-bg:#f1c9ff':'';
                                    ?>
                                        <tr style="<?=$bgcolor?>">
                                            <td>
                                                <b><?=$resultvlu->trip_sheet_name?></b>                                            
                                            </td>
                                            <td>
                                                <?php if( $resultvlu->vendor_or_vehicle == 'vendor') { ?>
                                                    <b>Vendor Name</b>  :<?=$resultvlu->vendor_name?><br>
                                                    <b>Vendor Mobile</b> :<?=$resultvlu->mobile?><br>
                                                    <b>Authorized Person</b>  :<?=$resultvlu->authorized_person?><br>
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
                                                            echo " <span class='badge badge-pill badge-soft-secondary font-size-14 '>On the Way</span>";
                                                        } else if($resultvlu->status==1){
                                                             echo " <span class='badge badge-pill badge-soft-warning font-size-14 '>Trip Started</span>";
                                                        } else if($resultvlu->status==2){
                                                             echo " <span class='badge badge-pill badge-soft-success font-size-14 '>Trip Finished</span>";
                                                        } else if($resultvlu->status==7){
                                                            echo " <span class='badge badge-pill badge-soft-info font-size-14 '>Trip Created</span>";
                                                       }  
                                                    ?>
                                            </td>
                                            <!-- <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="<?=base_url()?>trip_sheet/print/<?=$resultvlu->id?>" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Print">
                                                        <i class="si si-printer"></i>
                                                    </a>

                                                   <?php  if($resultvlu->destination =='other_state') { ?>
                                                        <a href="<?=base_url()?>trip_sheet/cargos_other_state/<?=$resultvlu->id?>" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Add Cargos">
                                                        <i class="fa fa-truck"></i>
                                                    <?php } else { ?>
                                                        <a href="<?=base_url()?>trip_sheet/cargos/<?=$resultvlu->id?>" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Add Cargos">
                                                        <i class="fa fa-truck"></i>
                                                        </a>
                                                    <?php }  ?>
                                                    <a href="<?=base_url()?>trip_sheet/update/<?=$resultvlu->id?>" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Update Trip Sheet">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                </div>
                                            </td> -->


                                            <td class="text-center">  
                                                <div class="btn-group" role="group" aria-label="Basic outlined example">

                                                <button type="button" class="btn btn-outline-secondary" onclick="location.href='<?=base_url()?>trip_sheet/print/<?=$resultvlu->id?>'" ><i class="mdi mdi-printer"  style="font-size: 22px"></i></button> 
                                                <?php  if($resultvlu->destination =='other_state') { ?> 
                                                    <button type="button" class="btn btn-outline-secondary" onclick="location.href='<?=base_url()?>trip_sheet/cargos_other_state/<?=$resultvlu->id?>'" >
                                                    <i class="fa fa-truck"  style="font-size: 22px"></i></button>  
                                                <?php } else { ?>
                                                        <button type="button" class="btn btn-outline-secondary" onclick="location.href='<?=base_url()?>trip_sheet/cargos/<?=$resultvlu->id?>'" >
                                                        <i class="fa fa-truck"  style="font-size: 22px"></i></button>                                                        
                                                <?php }  ?>

                                                <button type="button" class="btn btn-outline-secondary" onclick="location.href='<?= base_url() ?>trip_sheet/update/<?= $resultvlu->id ?>'" >  <i class="fas fa-pencil-alt"  style="font-size: 22px"></i> </button>   
                                                  
                                                </div>
                                            </td> 
                                        </tr>

                                        <?php
                                        }
                                        }
                                        ?>

                                            </tbody>
                                        </table>                                        
                                </div>
  

                                <div align="right">
                                    <p><?php echo $links; ?></p>  
                                </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
    </div>
</div>