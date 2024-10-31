<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">List all Reviews</h4>

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
                                    <!-- <a href="<?=base_url()?>branches/create" class="btn btn-primary">
                                                    <i class="fa fa-plus"></i>Add Branch</a> -->
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
                                                    <th>Name</th>
                                                    <th>Phone</th>
                                                    <th>Email</th>
                                                    <th>Comments</th>
                                                    <th>Star rate</th>
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
                                                    <b><?=$resultvlu->name?></b>
                                                    </td>
                                                    <td>
                                                        <?=$resultvlu->phone?>
                                                    </td>
                                                    <td>
                                                        <?=$resultvlu->email?>
                                                    </td>
                                                    <td>
                                                        <?=$resultvlu->comment?>
                                                    </td>
                                                    <td>
                                                        <?=$resultvlu->star_rate?>
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