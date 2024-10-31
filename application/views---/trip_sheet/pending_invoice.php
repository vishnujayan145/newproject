<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">List Pending Invoice</h4>

                      

                    </div>
                </div>
            </div>
            <!-- end page title -->  
            

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">   
                            
                             
                           
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
                                            if($pending_invoices!=null)
                                            {
                                            foreach ($pending_invoices as $key => $resultvlu) {
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