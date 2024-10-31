 <!-- Main Container -->
            <main id="main-container">


                        <!-- Page Content -->
                        <div class="content">

                            <!-- Full Table -->
                            <div class="block">
                                <div class="block-header block-header-default">
                                    <span class="block-title">
                                        <h2 class="content-heading">Manifestos</h2>
                                    </span>
                                    
                                    <a href="<?=base_url()?>manifesto/create" class="btn btn-alt-primary">
                                        <i class="fa fa-plus mr-5"></i>Upload Manifesto
                                    </a>

                                </div>
                            <div>
                        </div>
                        <hr>
                        <div class="block-content">
                            <div class="table-responsive">
                            
                            <div id="ermsg"><?= $this->session->flashdata('ermsg'); ?></div>

                            <table class="table table-striped table-vcenter">
                                    <thead>
                                        <tr>
                                            <th>Manifesto Id</th>
                                            <th>Branch</th>
                                            <th>OGM</th>

                                            <th>Loading LIst</th>
                                            <th>Sorting List</th>
                                            <!-- <th style="width: 15%;">Status</th>
                                            <th class="text-center" style="width: 100px;">Actions</th> -->
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
                                                <b><?=$resultvlu->id?></b>
                                            </td>
                                            <td>
                                                <b><?=$resultvlu->send_branch?></b>
                                            </td>
                                            <td>
                                                <a href="<?=base_url()?>manifesto/generate_ogm/<?=$resultvlu->id ?>">
                                                    Download OGM
                                                </a>
                                            </td>

                                            <td>
                                                <a href="<?=base_url()?>manifesto/generate_loading_list/<?=$resultvlu->id ?>">
                                                    Download Loading List
                                                </a>
                                            </td>

                                            <td>
                                                <a href="<?=base_url()?>manifesto/generate_sorting_list/<?=$resultvlu->id ?>">
                                                    Download Sorting List
                                                </a>
                                            </td>>

                                        </tr>
<?php
}
}
?> 
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <!-- END Full Table -->

                </div>
                <!-- END Page Content -->

            </main>
            <!-- END Main Container -->