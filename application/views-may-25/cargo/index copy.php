 <!-- Main Container -->
            <main id="main-container">

                <!-- Page Content -->
                <div class="content">
                  

                    <!-- Full Table -->
                    <div class="block">
                        <div class="block-header block-header-default">
                            <span class="block-title">
                                 <h2 class="content-heading">List all Cargo</h2>
                            </span>
                                                <a href="<?=base_url()?>cargo/create" class="btn btn-alt-primary">
                                                    <i class="fa fa-plus mr-5"></i>Add Cargo</a>
                        </div>
                        <div>
                            
                            
                        <form action="<?=base_url()?>cargo/index?" method="get" name="myxfrm" enctype="multipart/form-data" onsubmit="return validateForm();">
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
                                        <option value="0" <?php if(isset($_GET['status']) && $_GET['status']=='0'){ echo 'selected="true"'; } ?>>Active</option>
                                        <option value="1" <?php if(isset($_GET['status']) && $_GET['status']=='1'){ echo 'selected="true"'; } ?>>Inactive</option>
                                     </select>
                                 </div>
                                 
                            </div>
                            <div class="dropdown float-right">
                                <label for="example-select">Contact Number</label>
                                 <div>
                                    <input type="text" class="form-control" name="contactnumber" placeholder="Search Cargo no.." value="<?php if(isset($_GET['contactnumber'])){ echo $_GET['contactnumber']; } ?>">
                                </div>
                            </div>
                            <div class="dropdown float-right">
                                <label for="example-select">Auth Person</label>
                                 <div>
                                    <input type="text" class="form-control" name="auth_person" placeholder="Search auth person.." value="<?php if(isset($_GET['auth_person'])){ echo $_GET['auth_person']; } ?>">
                                </div>
                            </div>
                            <div class="dropdown float-right">
                                <label for="example-select">Address</label>
                                 <div>
                                    <input type="text" class="form-control" name="address" placeholder="Search address.." value="<?php if(isset($_GET['address'])){ echo $_GET['address']; } ?>">
                                </div>
                            </div>
                            <div class="dropdown float-right">
                                <label for="example-select">Cargo Name</label>
                                 <div>
                                    <input type="text" class="form-control" name="cargo_name" placeholder="Search Cargo name.." value="<?php if(isset($_GET['cargo_name'])){ echo $_GET['cargo_name']; } ?>">
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
                                            <th>Cargo Name</th>
                                            <th>Contact Number</th>
                                            <th>Header</th>
                                            <th>Auth Person</th>
                                            <th>Address</th>
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
                                                <b><?=$resultvlu->cargo_name?></b>
                                            </td>
                                            <td>
                                                <?=$resultvlu->contactnumber?>
                                            </td>
                                            <td>
                                                
                                            <img  src="<?= base_url() ?>assets/uploads/headers/<?=$resultvlu->header?>" alt="Header" style="width:100%;max-width:200px"> 
                                               
                                            </td>
                                            <td>
                                                <?=$resultvlu->auth_person?>
                                            </td>
                                            <td>
                                                <?=$resultvlu->address?>
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
                                                    <a href="<?=base_url()?>cargo/update/<?=$resultvlu->id?>" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Edit">
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


                <!-- The Modal -->
<div id="myModal" class="modal">

<!-- The Close Button -->
<span class="close">&times;</span>

<!-- Modal Content (The Image) -->
<img class="modal-content" id="img01">

<!-- Modal Caption (Image Text) -->
<div id="caption"></div>
</div>



            </main>
            <!-- END Main Container -->