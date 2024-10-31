 <!-- Main Container -->
            <main id="main-container">

                <!-- Page Content -->
                <div class="content">
                  

                    <!-- Full Table -->
                    <div class="block">
                        <div class="block-header block-header-default">
                            <span class="block-title">
                                 <h2 class="content-heading">List all Branches</h2>
                            </span>
                                                <a href="<?=base_url()?>branches/create" class="btn btn-alt-primary">
                                                    <i class="fa fa-plus mr-5"></i>Add Branch</a>
                        </div>
                        <div>
                            
                            
                        <form action="<?=base_url()?>branches/index?" method="get" name="myxfrm" enctype="multipart/form-data" onsubmit="return validateForm();">
                            <?php /* <div class="dropdown float-right">
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
                                        <option value="0" <?php if(isset($_GET['status']) && $_GET['status']=='0'){ echo 'selected="true"'; } ?>>Active</option>
                                        <option value="1" <?php if(isset($_GET['status']) && $_GET['status']=='1'){ echo 'selected="true"'; } ?>>Inactive</option>
                                     </select>
                                 </div>
                                 
                            </div>
                            <div class="dropdown float-right">
                                <label for="example-select">Contact Number</label>
                                 <div>
                                    <input type="text" class="form-control" name="contactnumber" placeholder="Search Vehicle no.." value="<?php if(isset($_GET['contactnumber'])){ echo $_GET['contactnumber']; } ?>">
                                </div>
                            </div>
                            <div class="dropdown float-right">
                                <label for="example-select">Driver Name</label>
                                 <div>
                                    <input type="text" class="form-control" name="driver_name" placeholder="Search driver name.." value="<?php if(isset($_GET['driver_name'])){ echo $_GET['driver_name']; } ?>">
                                </div>
                            </div>
                            <div class="dropdown float-right">
                                 <label for="example-select">Vehicle Type</label>
                                 <div>
                                     <select class="form-control" id="vehicle_type" name="vehicle_type">
                                        <option value="all" <?php if(isset($_GET['vehicle_type']) && $_GET['vehicle_type']=='all'){ echo 'selected="true"'; } ?>>All</option>
                                        <option value="Bike" <?php if(isset($_GET['vehicle_type']) && $_GET['vehicle_type']=='Bike'){ echo 'selected="true"'; } ?>>Bike</option>
                                        <option value="Truck" <?php if(isset($_GET['vehicle_type']) && $_GET['vehicle_type']=='Truck'){ echo 'selected="true"'; } ?>>Truck</option>
                                     </select>
                                 </div>
                                 
                            </div>
                            <div class="dropdown float-right">
                                <label for="example-select">Vehicle No</label>
                                 <div>
                                    <input type="text" class="form-control" name="vehicle_number" placeholder="Search Vehicle no.." value="<?php if(isset($_GET['vehicle_number'])){ echo $_GET['vehicle_number']; } ?>">
                                </div>
                            </div>  */ ?>
                            
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
                                            <th>Branch name</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Location</th>
                                            <th style="width: 15%;">Status</th>
                                            <th class="text-center" style="width: 100px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
if($result!=null)
{
foreach ($result as $key => $resultvlu) {
?>
                                        <tr>
                                            <td>
                                                <b><?=$resultvlu->branch_name?></b>
                                            </td>
                                            <td>
                                                <?=$resultvlu->username?>
                                            </td>
                                            <td>
                                                <?=$resultvlu->email?>
                                            </td>
                                            <td>
                                                <?=$resultvlu->location?>
                                            </td>
                                            <td>
                                                    <?php
                                                        if($resultvlu->status==0){
                                                            echo " <span class='badge badge-success'>Active</span>";
                                                        }
                                                        else if($resultvlu->status==1){
                                                             echo " <span class='badge badge-warning'>InActive</span>";
                                                        }
                                                    ?>
                                               
                                            </td>

                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="<?=base_url()?>branches/update/<?=$resultvlu->id?>" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Edit">
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