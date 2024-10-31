<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">List all Branches</h4>

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
                                    <a href="<?=base_url()?>branches/create" class="btn btn-primary">
                                                    <i class="fa fa-plus"></i>Add Branch</a>
                                </div>                                
                            </div>
                            
                           
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
                                                        <?=$resultvlu->branch_name?>
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
                                                                echo " <span class='badge badge-pill badge-soft-success font-size-14'>Active</span>";
                                                            }
                                                            else if($resultvlu->status==1){
                                                                    echo " <span class='badge badge-pill badge-soft-warning font-size-14'>InActive</span>";
                                                            }
                                                        ?>                                                            
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn-group"> 

                                                                <button type="button" class="btn btn-outline-secondary" onclick="location.href='<?= base_url() ?>branches/update/<?= $resultvlu->id ?>'" >  <i class="fas fa-pencil-alt"  style="font-size: 22px"></i> </button>  


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