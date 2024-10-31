<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">List all Trip Sheet Cargos</h4>

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
                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                <button type="button" class="btn btn-outline-primary" onclick="showAllStatusModel();" >Change Status</button> 
                                <input type="hidden" id="trip_sheet_id" value="<?= $this->uri->segment(3) ?>" /> 

                                <button type="button" class="btn btn-outline-primary" onclick="location.href='<?= base_url() ?>trip_sheet_admin'" ><i class="si si-action-undo mr-5"></i>Back</button> 


                                <?php
                                if ($this->uri->segment(4)) {
                                    ?>
                                        <button type="button" class="btn btn-outline-primary" onclick="location.href='<?= base_url() ?>trip_sheet_admin/cargos/<?= $this->uri->segment(3) ?>'" ><i class="fa fa-plus mr-5"></i>Add Trip Sheet Cargos</button>

                                    <?php
                                } else {
                                    ?>
                                    <?php
                                }
                                ?>     
                               
                            </div> 


                            <?php /*
                                        if ($this->uri->segment(4)) {
                                            ?>
                                            <div class="row">
                                                <form action="<?= base_url() ?>trip_sheet_admin/cargo_update_process" method="post" name="myxfrm"
                                                    enctype="multipart/form-data" >
                                                    <input type="hidden" name="trip_sheet_id" value="<?= $this->uri->segment(3) ?>">
                                                    <input type="hidden" name="trip_sheet_cargo_id" value="<?= $this->uri->segment(4) ?>">  
                                                </form>
                                            </div>
                                            <!-- <div class="pl-10 pt-5">Cargos Data</div> -->
                                            <?php
                                        } else {
                                            ?>
                                            <div class="row">
                                                <form action="<?= base_url() ?>trip_sheet_admin/cargo_create_process" method="post" name="myxfrm"
                                                    enctype="multipart/form-data" >
                                                    <input type="hidden" name="trip_sheet_id" value="<?= $this->uri->segment(3) ?>">
                                                    <input name="is_transfer" id="is_transfer" type="hidden">
                                                    <input name="transfer_status" id="transfer_status" type="hidden">
                                                    <input name="tracking_no" id="tracking_no" type="hidden">

                                                    


                                                    <div class="dropdown  " style="display: none;">
                                                        <label for="example-select">Status</label>
                                                        <div>
                                                            <select class="form-control" id="status11" name="status">
                                                                <option value="1">Active</option>
                                                                <option value="2">Inactive</option>
                                                            </select>
                                                        </div>
                                                    </div>  
                                                    </div>
                                                </form>

                                            </div>
                                            <!-- <div class="pl-10 pt-5">Cargos Data</div> -->
                                            <?php
                                        } */
                                        ?>  





                            <form action="<?= base_url() ?>trip_sheet_admin/cargos/<?= $this->uri->segment(3) ?>" method="get" name="myxfrm" enctype="multipart/form-data" onsubmit="return validateForm();">


                            <div class="row mt-2">    
                                    <div class="col-md-2"><label for="example-select">Filter</label></div> 
                                </div>

                                <div class="row">                                 
 
                                        <div class="col-md-2">                                   
                                            <select class="form-control" onchange="onStatusChange(this);" id="stat" name="status">
                                                <option value="all" <?php if (isset($_GET['status']) && $_GET['status'] == 'all') { echo 'selected="true"'; } ?>>All</option>
                                                <option value="0"  <?php if (isset($_GET['status']) && $_GET['status'] == '0') { echo 'selected="true"'; } ?>>On the Way</option>
                                                <option value="1" <?php if (isset($_GET['status']) && $_GET['status'] == '1') { echo 'selected="true"'; } ?>>Out for Delivery</option>    
                                                <option value="2" <?php if (isset($_GET['status']) && $_GET['status'] == '2') { echo 'selected="true"'; } ?>>In Transit</option>    
                                                <option value="3" <?php if (isset($_GET['status']) && $_GET['status'] == '3') { echo 'selected="true"'; } ?>>Delivered</option>
                                                <option value="4" <?php if (isset($_GET['status']) && $_GET['status'] == '4') { echo 'selected="true"'; } ?>>Pending</option>
                                                <option value="5" <?php if (isset($_GET['status']) && $_GET['status'] == '5') { echo 'selected="true"'; } ?>>Not Delivered</option>
                                                <option value="6" <?php if (isset($_GET['status']) && $_GET['status'] == '6') { echo 'selected="true"'; } ?>>Recheck</option>   
                                            </select>
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
                                                    <th> <input type="checkbox" id="selectAll" /> Select All </th>            
                                                    <th>Sl No.</th> 
                                                    <th>Cargo Name</th>
                                                    <th>Tracking Number</th>
                                                    <th>Trip Number</th>
                                                    <th># No</th>
                                                    <th>Invoice Number</th>
                                                    <th>PCs</th>
                                                    <th>Weight</th>
                                                    <th>District</th>
                                                    <th>Mob.Number</th>
                                                    <th>Status</th>
                                                    <th class="text-center" style="width: 100px;">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    <?php
                                                     if ($result != null) {
                                                        $total_cnt = 0;
                                                        $total_pcs = 0;
                                                        $total_weight = 0;
                                                        foreach ($result as $key => $resultvlu) {
                                                            $total_cnt =  $total_cnt+1;
                                                            if($resultvlu->quantity != ''){
                                                                $total_pcs = $total_pcs + $resultvlu->quantity; 
                                                            } 
                            
                                                            if($resultvlu->weight != ''){ 
                                                                $total_weight = $total_weight + (int)$resultvlu->weight; 
                                                            }
                                                            // $total_pcs = $total_pcs + $resultvlu->quantity;
                                                            // $total_weight = $total_weight + $resultvlu->weight;
                                                            ?>
                                                            <tr>
                                                                <td align="center">
                                                                <input type="checkbox" name="bene_id[]" class="checkbox-item" id="1"   value="<?=$resultvlu->invoice_number?>" />
                                                                </td> 
                                                                 <td><?=$key+1?></td> 
                                                                <td>
                                                                    <?= $resultvlu->cargo_name ?> 
                                                                </td>
                                                                <td>
                                                                    <?= $resultvlu->tracking_no ?> 
                                                                </td>
                                                                <td>
                                                                    <?= $resultvlu->trip_no ?> 
                                                                </td>
                                                                <td>
                                                                    <?= $resultvlu->boxno ?> 
                                                                </td>
                                                                <td>
                                                                    <?= $resultvlu->invoice_number ?> 
                                                                </td>
                                                                <td>
                                                                    <?= $resultvlu->quantity ?> 
                                                                </td>
                                                                <td>
                                                                    <?= $resultvlu->weight ?> 
                                                                </td>
                                                                <td>
                                                                    <?= $resultvlu->place ?> 
                                                                </td>
                                                                <td>
                                                                    <?= $resultvlu->mobilenumber ?> 
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                        if ($resultvlu->status == 0) {
                                                                            ?>
                                                                            <button onclick="showStatusModel(<?= $this->uri->segment(3) ?>,<?= $resultvlu->id ?>,<?= $resultvlu->status ?>,`<?= $resultvlu->message ?>`,`<?= $resultvlu->invoice_number ?>`, `<?= $resultvlu->tracking_no ?>`)"
                                                                                    class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                                                                    title="Change Status">
                                                                                On the Way
                                                                            </button>
                                                                            <?php
                                                                        } elseif ($resultvlu->status == 1) {
                                                                            ?>
                                                                            <button onclick="showStatusModel(<?= $this->uri->segment(3) ?>,<?= $resultvlu->id ?>,<?= $resultvlu->status ?>,
                                                                                    `<?= $resultvlu->message ?>`,`<?= $resultvlu->invoice_number ?>`, `<?= $resultvlu->tracking_no ?>`)"
                                                                                    class="btn btn-sm btn-primary" data-toggle="tooltip"
                                                                                    title="Change Status">
                                                                                Out for Delivery
                                                                            </button>
                                                                            <?php
                                                                        } elseif ($resultvlu->status == 2) {
                                                                            ?>
                                                                            <button onclick="showStatusModel(<?= $this->uri->segment(3) ?>,<?= $resultvlu->id ?>,<?= $resultvlu->status ?>,
                                                                                    `<?= $resultvlu->message ?>`,`<?= $resultvlu->invoice_number ?>`, `<?= $resultvlu->tracking_no ?>`)"
                                                                                    class="btn btn-sm btn-info" data-toggle="tooltip"
                                                                                    title="Change Status">
                                                                                In Transit
                                                                            </button>
                                                                            <?php
                                                                        } elseif ($resultvlu->status == 3) {
                                                                            ?>
                                                                            <button onclick="showStatusModel(<?= $this->uri->segment(3) ?>,<?= $resultvlu->id ?>,<?= $resultvlu->status ?>,
                                                                                    `<?= $resultvlu->message ?>`,`<?= $resultvlu->invoice_number ?>`, `<?= $resultvlu->tracking_no ?>`)"
                                                                                    class="btn btn-sm btn-success" data-toggle="tooltip"
                                                                                    title="Change Status">
                                                                                    Delivered
                                                                            </button>
                                                                            <?php
                                                                       } elseif ($resultvlu->status == 4) {
                                                                        ?>
                                                                        <button onclick="showStatusModel(<?= $this->uri->segment(3) ?>,<?= $resultvlu->id ?>,<?= $resultvlu->status ?>,
                                                                                `<?= $resultvlu->message ?>`,`<?= $resultvlu->invoice_number ?>`, `<?= $resultvlu->tracking_no ?>`)"
                                                                                class="btn btn-sm btn-warning" data-toggle="tooltip"
                                                                                title="Change Status">
                                                                                Pending
                                                                        </button>
                                                                        <?php
                                                                    } elseif ($resultvlu->status == 5) {
                                                                        ?>
                                                                        <button onclick="showStatusModel(<?= $this->uri->segment(3) ?>,<?= $resultvlu->id ?>,<?= $resultvlu->status ?>,
                                                                                `<?= $resultvlu->message ?>`,`<?= $resultvlu->invoice_number ?>`, `<?= $resultvlu->tracking_no ?>`)"
                                                                                class="btn btn-sm btn-danger" data-toggle="tooltip"
                                                                                title="Change Status">
                                                                                Not Delivered
                                                                        </button>
                                                                        <?php
                                                                    }
                                                                    elseif ($resultvlu->status == 6) {
                                                                        ?>
                                                                        <button onclick="showStatusModel(<?= $this->uri->segment(3) ?>,<?= $resultvlu->id ?>,<?= $resultvlu->status ?>,
                                                                                `<?= $resultvlu->message ?>`,`<?= $resultvlu->invoice_number ?>`, `<?= $resultvlu->tracking_no ?>`)"
                                                                                class="btn btn-sm btn-danger" data-toggle="tooltip"
                                                                                title="Change Status">
                                                                               Recheck
                                                                        </button>
                                                                        <?php
                                                                    }                            
                                                                    ?> 
                                                                </td>




                                                            <td class="text-center">  
                                                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                                    <button type="button" class="btn btn-outline-danger"  onclick="location.href='<?= base_url() ?>trip_sheet_admin/cargos_delete_process/<?= $this->uri->segment(3) ?>/<?= $resultvlu->id ?>'"  data-toggle="tooltip" title="Delete cargo" ><i class="mdi mdi-trash-can-outline"  style="font-size: 22px"></i></button>                                                                     
                                                                    <button type="button" class="btn btn-outline-success" onclick="location.href='<?= base_url() ?>trip_sheet_admin/cargos/<?= $this->uri->segment(3) ?>/<?= $resultvlu->id ?>'" >  <i class="fas fa-pencil-alt"  style="font-size: 22px"></i> </button>  

                                                                    <?php if($resultvlu->filename  != '' || $resultvlu->filename != NULL){
                                                                        ?>  
                                                                            <button type="button" class="btn btn-outline-primary"  data-toggle="tooltip" title="POD" onclick="showImageModel('<?= $resultvlu->filename ?>' )" > <i class="fas fa-eye"  style="font-size: 22px"></i>  </button>
                                                                        <?php
                                                                        }
                                                                        ?>  
                                                                </div>
                                                            </td>


                            
                                                                <!-- <td class="text-center">
                                                                    <div class="btn-group">
                                                                        <a href="<?= base_url() ?>trip_sheet_admin/cargos_delete_process/<?= $this->uri->segment(3) ?>/<?= $resultvlu->id ?>"
                                                                           class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete Cargo">
                                                                            <i class="si si-trash"></i>
                                                                        </a>
                                                                        <a href="<?= base_url() ?>trip_sheet_admin/cargos/<?= $this->uri->segment(3) ?>/<?= $resultvlu->id ?>"
                                                                           class="btn btn-sm btn-success" data-toggle="tooltip"
                                                                           title="Update Values">
                                                                            <i class="fa fa-pencil"></i>
                                                                        </a>
                                                                        <?php if($resultvlu->filename  != '' || $resultvlu->filename != NULL){
                                                                        ?>
                                                                        <a href="#"   onclick="showImageModel('<?= $resultvlu->filename ?>' )" 
                                                                           class="btn btn-sm btn-primary" data-toggle="tooltip"
                                                                           title="View">
                                                                            <i class="fa fa-eye"></i></a>                            
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </td> -->
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>                            
                                                        <tr style="font-weight:bold">
                                                            <td colspan="5"> Total Count :<?= $total_cnt ?> </td> <td colspan="4">Total Pcs: <?= $total_pcs ?></td> <td colspan="5">Total Weight : <?= $total_weight ?></td>
                                                            </tr>
                                                        <?php
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
 


   <!-- asignModel -->
   <div class="modal fade" id="asignModel" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div style="padding:5px; text-align:center;"">
                <h4 class="text-primary">Update Status</h4>
                </div>
                <div class="modal-body">
                    <div class=" mb-4">
                            
                        <div class="row justify-content-center">
                            <div class="col-xl-12">                             
                            <div id="msg" style="color:green;font-size:22px;"> </div>
                            <form class="form-horizontal form-label-left ajaxModel" method="post" action="<?= base_url() ?>trip_sheet_admin/cargo_change_status" enctype = multipart/form-data>

                                <div class="form-group dropdown">
                                    <label for="example-select">Status</label>
                                    <div>
                                        <select class="form-control" onchange="onStatusChange(this);" id="stat" name="status">
                                            <option value="0">On the Way</option>
                                            <option value="1">Out for Delivery</option>    
                                            <option value="2">In Transit</option>    
                                            <option value="3">Delivered</option>
                                            <option value="4">Pending</option>
                                            <option value="5">Not Delivered</option>
                                            <option value="6">Recheck</option>                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="file" id="fileDiv" style="display:none">
                                    <label for="file-uplod">File</label>
                                    <div>
                                    <input type="file" id="file" name="file" accept="">
                                    </div>
                                </div>
                                <div class="file" id="deliveryDate" style="display:none">
                                    <label for="deliveryDate">Delivery Date</label>
                                    <div>
                                    <input type="date" class="form-control"  name="deliveryDate" id='deliveryDate' placeholder="Delivery Date..">
                                    </div>
                                </div>
                                <div class="file" id="intransitDiv"   style="display:none" >
                                    <label for="intransit">Url</label>
                                    <div>
                                    <input type="text" id="intransit" name="in_transit_url" class="form-control">
                                    </div>
                                </div>
                                <div class="dropdown" id="commentDiv">
                                    <label for="example-select">Comment</label>
                                    <div>
                                        <textarea class="form-control" name="comment" id="comment"
                                                placeholder="Enter Comment"></textarea>
                                    </div>
                                </div>
                                <input name="cargo_id" id="cargo_id" type="hidden">
                                <input name="invoiceno" id="invoice_no" type="hidden">
                                <input name="tripsheet_id" id="tripsheet_id" type="hidden">
                                <input name="tracking_no" id="tracking_no" type="hidden">                            
                                <div class="form-group">
                                    <br/>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                                    <button type="submit"  class="btn btn-success">Submit</button>

                                </div>
                            </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal -->
 



    

   <!-- asignModelSelected -->
   <div class="modal fade" id="asignModelSelected" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div style="padding:5px; text-align:center;"">
                <h4 class="text-primary">Update Status</h4>
                </div>
                <div class="modal-body">
                    <div class=" mb-4">
                            
                        <div class="row justify-content-center">
                            <div class="col-xl-12">                             
                            <div id="msg" style="color:green;font-size:22px;"> </div>
                            <form class="form-horizontal form-label-left ajaxModel" method="post" action="<?= base_url() ?>trip_sheet_admin/cargo_change_status_selected" enctype = multipart/form-data>

                        <div class="form-group dropdown">
                            <label for="example-select">Status</label>
                            <div>
                                <select class="form-control" onchange="onStatusChangeMultiple(this);" id="sel_stat" name="sel_status">
                                    <option value="0">On the Way</option>
                                    <option value="1">Out for Delivery</option>    
                                    <option value="2">In Transit</option>    
                                    <option value="3">Delivered</option>
                                    <option value="4">Pending</option>
                                    <option value="5">Not Delivered</option>
                                    <option value="6">Recheck</option>

                                    
                                    
                                </select>
                            </div>
                        </div>

                        <div class="file" id="fileDiv" style="display:none">
                            <label for="file-uplod">File</label>
                            <div>
                            <input type="file" id="sel_file" name="sel_file" accept="">
                            </div>
                        </div>

                        
                        <div class="file" id="deliveryDate" style="display:none">
                            <label for="deliveryDate">Delivery Date</label>
                            <div>
                            <input type="date" class="form-control"  name="deliveryDate" id='deliveryDate' placeholder="Delivery Date..">
                            </div>
                        </div>


                        <div class="file" id="intransitDiv"   style="display:none" >
                            <label for="intransit">Url</label>
                            <div>
                            <input type="text" id="intransit" name="in_transit_url" class="form-control">
                            </div>
                        </div>

                        <div class="dropdown" id="sel_commentDiv">
                            <label for="example-select">Comment</label>
                            <div>
                                <textarea class="form-control" name="sel_comment" id="sel_comment"
                                          placeholder="Enter Comment"></textarea>
                            </div>
                        </div>
                        <input name="sel_cargo_id" id="sel_cargo_id" type="hidden">
                        <input name="sel_invoiceno" id="sel_invoice_no" type="hidden">
                        <input name="sel_tripsheet_id" id="sel_tripsheet_id" type="hidden">
                        <div class="form-group">

                            <br/>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                            <button type="submit"  class="btn btn-success">Submit</button>

                        </div>
                    </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal -->



 



    

   <!-- myImageModal -->
   <div class="modal fade" id="myImageModal" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div style="padding:5px; text-align:center;"">
                <h4 class="text-primary">Update Status</h4>
                </div>
                <div class="modal-body">
                    <div class=" mb-4">
                            
                        <div class="row justify-content-center">
                            <div class="col-xl-12">                             
                            <div id="msg" style="color:green;font-size:22px;"> </div>
                            
                            <p id="imgUr" style="text-align:center;"></p>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal -->

 

    <script>
        $('#selectAll').click(function (e) {
            $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
        });

        var $checkboxes = $('.checkbox-item');
        $('.checkbox-item').change(function(){
        var checkboxesLength = $checkboxes.length;
        var checkedCheckboxesLength = $checkboxes.filter(':checked').length;
        if(checkboxesLength == checkedCheckboxesLength) {
            $('#selectAll').prop('checked', true);
        }else{
            $('#selectAll').prop('checked', false);
        }
        });
    </script>


    <script>
        $(document).ready(function(){
           
$('#inv_num').select2({
                placeholder: 'Enter Tracking Number..',
                minimumInputLength: 2,
                ajax: {
                    url:'<?php echo base_url() ?>trip_sheet_admin/get_invoices',
                    dataType: 'json',
                    delay: 250,
                    type:'POST',
                    data: function (params) {
                        return {
                            input: params.term // search term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.tracking_no
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
        });

    </script>


    <script>



        function showStatusModel(tripsheet_id, cargo_id_val, status, comment, invoice_no, tracking_no) {
          console.log("*");
            window.cargo_id_val = cargo_id_val;
            document.getElementById("cargo_id").value = cargo_id_val;
            if (status == 0) {
                $("#asignModel").find("#commentDiv").css({"display": "none"});
            }
            if (status == 1) {
                $("#asignModel").find("#commentDiv").css({"display": "inline"});
            }
            if (status == 2) {
                $("#asignModel").find("#commentDiv").css({"display": "inline"});
            }
            $("#asignModel").find("#stat").val(status);
            $("#asignModel").find("#comment").val(comment);
            $("#asignModel").find("#invoice_no").val(invoice_no);
            $("#asignModel").find("#tripsheet_id").val(tripsheet_id);    
            $("#asignModel").find("#tracking_no").val(tracking_no); 

            $('#asignModel').modal('show', {backdrop: 'true'});


        }
 

        function showImageModel( imgUrl ) { 

           $("#myImageModal").find("#imgUr").html('<img src="'+imgUrl+'" style="width:100%"/>');   
             $('#myImageModal').modal('show', {backdrop: 'true'});
        }

        function showAllStatusModel( ) {

            var checkValues = $('.checkbox-item:checked').map(function()
            {
                return $(this).val();
            }).get();

            document.getElementById("sel_cargo_id").value = checkValues; 
            var trip_sheet_id = document.getElementById("trip_sheet_id").value; 

            if (status == 0) {
                $("#asignModelSelected").find("#sel_commentDiv").css({"display": "none"});
            }
            if (status == 1) {
                $("#asignModelSelected").find("#sel_commentDiv").css({"display": "inline"});
            }
            if (status == 2) {
                $("#asignModelSelected").find("#sel_commentDiv").css({"display": "inline"});
            }
            $("#asignModelSelected").find("#sel_stat").val(status);
            $("#asignModelSelected").find("#sel_comment").val('');
            $("#asignModelSelected").find("#sel_invoice_no").val('');
            $("#asignModelSelected").find("#sel_tripsheet_id").val(trip_sheet_id);            
            $('#asignModelSelected').modal('show', {backdrop: 'true'});


        }

        function onStatusChangeMultiple(sel) {
            var value = sel.value;
            //   alert(value);

            //On the Way
            if (value == 0) {
                $("#asignModelSelected").find("#sel_commentDiv").css({"display": "none"});

            } else if (value == 1  ) {  //Out for Delivery

                $("#asignModelSelected").find("#sel_commentDiv").css({"display": "none"});
                $("#asignModelSelected").find("#intransitDiv").css({"display": "none"});
                $("#asignModelSelected").find("#fileDiv").css({"display": "none"});
                $("#asignModelSelected").find("#deliveryDate").css({"display": "none"});

            } else if (value == 2) {   //In Transit
               
                $("#asignModelSelected").find("#sel_commentDiv").css({"display": "inline"});
                $("#asignModelSelected").find("#intransitDiv").css({"display": "inline"});  
                $("#asignModelSelected").find("#fileDiv").css({"display": "none"});
                $("#asignModelSelected").find("#deliveryDate").css({"display": "none"});              
            }
            else  if (value == 3){ //Delivered
                $("#asignModelSelected").find("#fileDiv").css({"display": "block"});
                $("#asignModelSelected").find("#deliveryDate").css({"display": "block"}); 
                $("#asignModelSelected").find("#sel_commentDiv").css({"display": "block"});
                $("#asignModelSelected").find("#intransitDiv").css({"display": "none"});  
            }
            else  if (value == 4){  //Pending
                $("#asignModelSelected").find("#sel_commentDiv").css({"display": "inline"});
                $("#asignModelSelected").find("#intransitDiv").css({"display": "none"});  
                $("#asignModelSelected").find("#fileDiv").css({"display": "none"});
                $("#asignModelSelected").find("#deliveryDate").css({"display": "none"});
            }
            else  if (value == 5){ //Not Delivered
                $("#asignModelSelected").find("#sel_commentDiv").css({"display": "inline"});
                $("#asignModelSelected").find("#intransitDiv").css({"display": "none"});  
                $("#asignModelSelected").find("#fileDiv").css({"display": "none"});
                $("#asignModelSelected").find("#deliveryDate").css({"display": "none"});
            }
            else  if (value == 6){  //Recheck
                $("#asignModelSelected").find("#sel_commentDiv").css({"display": "inline"});
                $("#asignModelSelected").find("#intransitDiv").css({"display": "none"});  
                $("#asignModelSelected").find("#fileDiv").css({"display": "none"});
                $("#asignModelSelected").find("#deliveryDate").css({"display": "none"});
            }
 


            // if (value == 0) {
            //     $("#asignModelSelected").find("#sel_commentDiv").css({"display": "none"});
            // }
            // if (value == 1 || value == 5 ) {
            //     $("#asignModelSelected").find("#sel_commentDiv").css({"display": "inline"});
            // }
            // if (value == 2) {
               
            //     $("#asignModelSelected").find("#sel_commentDiv").css({"display": "inline"});
            //     $("#asignModelSelected").find("#intransitDiv").css({"display": "inline"});                
            // }
            // else {
            //     $("#asignModelSelected").find("#intransitDiv").css({"display": "none"});
            // }

            // if( value == 3 ){
                
            //     $("#asignModelSelected").find("#fileDiv").css({"display": "block"});
            //     $("#asignModelSelected").find("#deliveryDate").css({"display": "block"});
                
            // }
            // else {
            //     $("#asignModelSelected").find("#fileDiv").css({"display": "none"});

            // }
        }


        function onStatusChange(sel) {
            var value = sel.value; 

            //On the Way
            if (value == 0) {
                $("#asignModel").find("#commentDiv").css({"display": "none"});

            } else if (value == 1  ) {  //Out for Delivery

                $("#asignModel").find("#commentDiv").css({"display": "none"});
                $("#asignModel").find("#intransitDiv").css({"display": "none"});
                $("#asignModel").find("#fileDiv").css({"display": "none"});
                $("#asignModel").find("#deliveryDate").css({"display": "none"});

            } else if (value == 2) {   //In Transit
               
                $("#asignModel").find("#commentDiv").css({"display": "inline"});
                $("#asignModel").find("#intransitDiv").css({"display": "inline"});  
                $("#asignModel").find("#fileDiv").css({"display": "none"});
                $("#asignModel").find("#deliveryDate").css({"display": "none"});              
            }
            else  if (value == 3){ //Delivered
                $("#asignModel").find("#fileDiv").css({"display": "block"});
                $("#asignModel").find("#deliveryDate").css({"display": "block"}); 
                $("#asignModel").find("#commentDiv").css({"display": "block"});
                $("#asignModel").find("#intransitDiv").css({"display": "none"});  
            }
            else  if (value == 4){  //Pending
                $("#asignModel").find("#commentDiv").css({"display": "inline"});
                $("#asignModel").find("#intransitDiv").css({"display": "none"});  
                $("#asignModel").find("#fileDiv").css({"display": "none"});
                $("#asignModel").find("#deliveryDate").css({"display": "none"});
            }
            else  if (value == 5){ //Not Delivered
                $("#asignModel").find("#commentDiv").css({"display": "inline"});
                $("#asignModel").find("#intransitDiv").css({"display": "none"});  
                $("#asignModel").find("#fileDiv").css({"display": "none"});
                $("#asignModel").find("#deliveryDate").css({"display": "none"});
            }
            else  if (value == 6){  //Recheck
                $("#asignModel").find("#commentDiv").css({"display": "inline"});
                $("#asignModel").find("#intransitDiv").css({"display": "none"});  
                $("#asignModel").find("#fileDiv").css({"display": "none"});
                $("#asignModel").find("#deliveryDate").css({"display": "none"});
            }
 

            // if (value == 0) {
            //     $("#asignModel").find("#commentDiv").css({"display": "none"});
            // }
            // if (value == 1 || value == 5 ) {
            //     $("#asignModel").find("#commentDiv").css({"display": "inline"});
            // }
            // if (value == 2) {
               
            //     $("#asignModel").find("#commentDiv").css({"display": "inline"});
            //     $("#asignModel").find("#intransitDiv").css({"display": "inline"});                
            // }
            // else {
            //     $("#asignModel").find("#intransitDiv").css({"display": "none"});
            // }

            // if( value == 3 ){
                
            //     $("#asignModel").find("#fileDiv").css({"display": "block"});
            //     $("#asignModel").find("#deliveryDate").css({"display": "block"});
                
            // }
            // else {
            //     $("#asignModel").find("#fileDiv").css({"display": "none"});

            // }
        }
    </script>
    
    <script>
       function display_details(){
           
           var inv = jQuery("#inv_num").val(); 
           var invt = $("#inv_num option:selected").html();
           $.ajax({
    
		url:'<?php echo base_url() ?>trip_sheet_admin/display_details',
		data:{inv:inv},
		dataType : 'json',
		type:'POST',
		success:function(data){
		    
			// console.log(data);
            jQuery('#qty').val(data[0].pcs);
            jQuery('#weight').val(data[0].weight);
            jQuery('#district').val(data[0].district);
            jQuery('#mobile').val(data[0].phone);
            jQuery('#invhid').val(invt);
            jQuery('#cargo_name').val(data[0].company);
            jQuery('#cargo_id').val(data[0].company);
            jQuery('#is_transfer').val(data[0].is_transfer);
            jQuery('#transfer_status').val(data[0].transfer_status);
            jQuery('#tracking_no').val(data[0].tracking_no);

            

            
		}
    });
           
       }
    </script>
  <script>
  jQuery(document).ready(function() {

    // $('#inv_num').select2();
    // jQuery('.js-example-basic-single').select2();
    
    // jQuery('#inv_num').select2('open');


});


  </script>  
</main>
<!-- END Main Container -->