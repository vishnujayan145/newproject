<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Reports</h4> 
                    </div>
                </div>
            </div>
            <!-- end page title -->  
            

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">                        
                            

                        <form action="<?=base_url()?>trip_sheet_admin/reports?" method="get" name="myxfrm" enctype="multipart/form-data" onsubmit="return validateForm();"> 

                            <div class="row mt-2">    
                                    <div class="col-md-2"><label for="example-select">Cargo Name</label></div> 
                                    <div class="col-md-2"><label for="example-select">Vehicle Number</label></div> 
                                    <div class="col-md-2"><label for="example-select">Invoice No</label></div> 
                                </div>

                                <div class="row">                                 
 
                                        <div class="col-md-2">                                   
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

                                        <div class="col-md-2">                                   
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

                                        <div class="col-md-2">                                   
                                            <input type="text" class="form-control" name="invoice_number" placeholder="Search invoice number.." value="<?php if(isset($_GET['invoice_number'])){ echo $_GET['invoice_number']; } ?>">
                                        </div> 

                                        <div class="col-md-2">                                   
                                            <button type="submit" class="btn btn-secondary">
                                                            <i class="fa fa-search"></i>
                                                        </button>
                                        </div>
                                            
                                </div>   
                            </form>  
                            
                           
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body"> 

                                <div class="table-rep-plugin">
                                    <div class="table-responsive mb-0" data-pattern="priority-columns">
                                        <table id="tech-companies-1" class="table table-striped">
                                            <thead>
                                                <tr>                                                    
                                                    <th>S/N</th>
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
                                                                
                                                                <?php if( $resultvlu->destination == 'state') { ?>
                                                                <a href="<?= base_url() ?>trip_sheet_admin/cargos/<?=$resultvlu->trip_sheet_id?>"><b><?=$resultvlu->trip_sheet_name?></b></a>
                                                                <?php } else {?>
                                                                    <a href="<?= base_url() ?>trip_sheet_admin/cargos_other_state/<?=$resultvlu->trip_sheet_id?>"><b><?=$resultvlu->trip_sheet_name?></b></a>
                
                                                                <?php
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?=$resultvlu->created_at?>
                                                            </td>
                                                            <td>
                                                                <?=$resultvlu->vehicle_drivername?>
                                                            </td>
                                                            <td>
                                                                <?=$resultvlu->vehicle_number?>
                                                            </td>
                                                            <td>
                                                                <?=$resultvlu->cargo_name?>
                                                            </td>
                                                            <td>
                                                                <?=$resultvlu->invoice_number?>
                                                            </td>
                                                            <td>
                                                                <?=$resultvlu->place?>
                                                            </td>
                                                            <td>
                                                                <?=$resultvlu->quantity?>
                                                            </td>
                                                            <td>
                                                                <?=$resultvlu->weight?>
                                                            </td>
                                                            <td>
                                                                <?=$resultvlu->mobilenumber?>
                                                            </td>
                                                            <td>
                                                                <?=$st?>
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