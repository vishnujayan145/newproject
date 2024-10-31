 <!-- Main Container -->
            <main id="main-container">

                <!-- Page Content -->
                <div class="content">
                  

                    <!-- Full Table -->
                    <div class="block">
                        <div class="block-header block-header-default">
                            <span class="block-title">
                                 <h2 class="content-heading">List all Vendors</h2>
                            </span>
                                                <a href="<?=base_url()?>vendors/create" class="btn btn-alt-primary">
                                                    <i class="fa fa-plus mr-5"></i>Add Vendor</a>
                        </div>
                        <div>
                            
                            
                        <form action="<?=base_url()?>vendors/index?" method="get" name="myxfrm" enctype="multipart/form-data" onsubmit="return validateForm();">
                            
                            
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
                                            <th>Vendor name</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Authorized Person</th>
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
                                                <?=$resultvlu->mobile?>
                                            </td>
                                            <td>
                                                <?=$resultvlu->authorized_person?>
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
                                                    <a href="<?=base_url()?>vendors/update/<?=$resultvlu->id?>" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Edit">
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