<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">List Not Delivered Invoice</h4>

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
                            
                        <!-- <div class="row"  style="float:right;">                              
                                <div class="col-md-12"> 
                                    <a href="<?=base_url()?>trip_sheet/create" class="btn btn-primary">
                                                    <i class="fa fa-plus"></i>Add Trip Sheet</a>
                                </div>                                
                            </div> -->
 
                            
                             
                           
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
                                                
                                                <th>Trip sheet Id </th>
                                                <th>Invoice Number</th>
                                                <th>Cargo Name</th>
                          

                                                </tr>
                                            </thead>
                                            <tbody>
                                             

                                            <?php  
                                            if($not_delivered_invoices!=null)  {
                                                foreach ($not_delivered_invoices as $key => $resultvlu) {
                                            ?>
                                                    <tr>
                                                        <td>
                                                            <b><?=$resultvlu->trip_sheet_id?></b>
                                                        </td>
                                                        <td>
                                                            <?=$resultvlu->invoice_number?>
                                                        </td>
                                                        <td>
                                                            <?=$resultvlu->cargo_name?>
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
                                    <p><?php //echo $links; ?></p>  
                                </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
    </div>
</div>