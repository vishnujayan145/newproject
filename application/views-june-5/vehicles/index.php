<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">List all Vehicles</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                <li class="breadcrumb-item active">Form Elements</li>
                            </ol>
                        </div>

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
                                    <a href="<?=base_url()?>vehicles/create" class="btn btn-primary">
                                                    <i class="fa fa-plus"></i>Add Vehicle</a>
                                </div>                                
                            </div>
                            <form action="<?=base_url()?>vehicles/index?" method="get" name="myxfrm" enctype="multipart/form-data" onsubmit="return validateForm();">

                                <div class="row">     
                                    <div class="col-md-2">  <label for="example-select">Status</label></div>                                    
                                    <div class="col-md-2"><label for="example-select">Contact Number</label> </div>
                                    <div class="col-md-2"><label for="example-select">Driver Name</label></div>
                                    <div class="col-md-2"><label for="example-select">Vehicle Type</label> </div>
                                    <div class="col-md-2"><label for="example-select">Vehicle No</label></div>
                                    <div class="col-md-2"><label for="example-select"></label></div>
                                </div>

                                <div class="row"> 
                                    <div class="col-md-2">                                          
                                        <select class="form-control" id="status1" name="status" style="display:block !important;">
                                            <option value="all" <?php if(isset($_GET['status']) && $_GET['status']=='all'){ echo 'selected="true"'; } ?>>All</option>
                                            <option value="0" <?php if(isset($_GET['status']) && $_GET['status']=='0'){ echo 'selected="true"'; } ?>>Active</option>
                                            <option value="1" <?php if(isset($_GET['status']) && $_GET['status']=='1'){ echo 'selected="true"'; } ?>>Inactive</option>
                                        </select>                                    
                                    </div>                                     
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" name="contactnumber" placeholder="Search Vehicle no.." value="<?php if(isset($_GET['contactnumber'])){ echo $_GET['contactnumber']; } ?>">                                             
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" name="driver_name" placeholder="Search driver name.." value="<?php if(isset($_GET['driver_name'])){ echo $_GET['driver_name']; } ?>">
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-control" id="vehicle_type" name="vehicle_type">
                                            <option value="all" <?php if(isset($_GET['vehicle_type']) && $_GET['vehicle_type']=='all'){ echo 'selected="true"'; } ?>>All</option>
                                            <option value="Bike" <?php if(isset($_GET['vehicle_type']) && $_GET['vehicle_type']=='Bike'){ echo 'selected="true"'; } ?>>Bike</option>
                                            <option value="Truck" <?php if(isset($_GET['vehicle_type']) && $_GET['vehicle_type']=='Truck'){ echo 'selected="true"'; } ?>>Truck</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">                                   
                                        <input type="text" class="form-control" name="vehicle_number" placeholder="Search Vehicle no.." value="<?php if(isset($_GET['vehicle_number'])){ echo $_GET['vehicle_number']; } ?>">
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
                                                    
                                                    <th>Vehicle No</th>
                                                    <th>Vehicle Type</th>
                                                    <th>Driver Name</th>
                                                    <th>Contact Number</th>
                                                    <th>Status</th>
                                                    <th>Action</th> 



                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if($result!=null) {
                                                foreach ($result as $key => $resultvlu) {
                                            ?>
                                                    <tr>
                                                        <td><?=$resultvlu->vehicle_number?></td>
                                                        <td><?=$resultvlu->vehicle_type?></td>
                                                        <td><?=$resultvlu->driver_name?></td>
                                                        <td><?=$resultvlu->contactnumber?></td>
                                                        <td>
                                                        <?php
                                                            if($resultvlu->status==0) {
                                                                echo " <span class='badge badge-pill badge-soft-success font-size-14'>Active</span>";
                                                            } else if($resultvlu->status==1) {
                                                                echo " <span class='badge badge-pill badge-soft-warning font-size-14'>InActive</span>";
                                                            }
                                                        ?>                                                
                                                        </td>
                                                        <td> 

                                                                <button type="button" class="btn btn-outline-secondary" onclick="location.href='<?= base_url() ?>vehicles/update/<?= $resultvlu->id ?>'" >  <i class="fas fa-pencil-alt"  style="font-size: 22px"></i> </button>  


                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>  
                                            </tbody>
                                        </table>

                                        <div align="right">
                                       
                                        <p><?php echo $links; ?></p>
 
                                    </div>
                                </div>
  

                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
    </div>
</div>