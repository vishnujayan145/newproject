<style>
    .select2-container--default .select2-selection--single {
    height: 37px !important;
        border: 1px solid #ced4da;
    }
    .select2-container--open .select2-dropdown--below{
      width: max-content !important;
    }
    .select2-container--open .select2-dropdown--above{
      width: max-content !important;
    }
    
    .select2-container .select2-selection--single{
    height:34px !important;
}
.select2-container--default .select2-selection--single{
         border: 1px solid #ccc !important; 
     border-radius: 0px !important; 
}
.showEstimateDate{
    display:none;
}

.itemShow {
display:block;
}
     

</style>
<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<!-- Main Container -->
<main id="main-container">

    <!-- Page Content -->
    <div class="content">


        <!-- Full Table -->
        <div class="block">
            <div class="block-header block-header-default">
                            <span class="block-title">
                                <h2 class="content-heading">List all Trip Sheet Cargos</h2>
                                <input class="btn btn-alt-primary" type="button" value="Change status"  onclick="showAllStatusModel()"/>
                                <input class="btn btn-alt-primary" type="button" value="Add LR No/ URL"  onclick="addLRNoModel()"/>
                                <input type="hidden" id="trip_sheet_id" value="<?= $this->uri->segment(3) ?>" />
                            </span>
                <a href="<?= base_url() ?>trip_sheet_admin" class="btn btn-alt-primary"><i class="si si-action-undo mr-5"></i>Back</a>
                <?php
                if ($this->uri->segment(4)) {
                    ?>
                    <a href="<?= base_url() ?>trip_sheet_admin/cargos/<?= $this->uri->segment(3) ?>"
                       class="btn btn-alt-primary"><i class="fa fa-plus mr-5"></i>Add Trip Sheet Cargos</a>
                    <?php
                } else {
                    ?>
                    <?php
                }
                ?>

            </div>
           <div class="block"> 

           </div>

            <hr>
            <div class="block-content">
                <div class="table-responsive">
                    <div id="ermsg"> <?= $this->session->flashdata('ermsg'); ?>  </div>
                    <table class="table table-striped table-vcenter">
                        <thead>
                        <tr>
                            <th> <input type="checkbox" id="selectAll" /> Select All </th>                             
                            <th>Sl No.</th> 
                            <th>Cargo Name</th>
                            <th>Tracking Number</th>
                            <th>Trip Number</th>
                            <th># No</th>
                            <th>Estimate Arrival Date</th>
                            <th>Invoice Number</th>
                            <th>PCs</th>
                            <th>Weight</th>
                            <!-- <th>Address</th> -->
                            <th>LR No</th>
                            <th>Tracking Url</th>
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
                                    $total_weight = $total_weight + $resultvlu->weight; 
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
                                        <b><?= $resultvlu->shipment_name ?></b>
                                    </td>
                                    <td>
                                        <b><?= $resultvlu->tracking_no ?></b>
                                    </td>
                                    <td>
                                        <b><?= $resultvlu->trip_no ?></b>
                                    </td>
                                    <td>
                                        <b><?= $resultvlu->boxno ?></b>
                                    </td>
                                    <td>
                                        <b><?= date('d-m-Y', strtotime($resultvlu->estimate_arrival_date)) ?></b>
                                    </td>
                                    <td>
                                        <b><?= $resultvlu->invoice_number ?></b>
                                    </td>
                                    <td>
                                        <b><?= $resultvlu->quantity ?></b>
                                    </td>
                                    <td>
                                        <b><?= $resultvlu->weight ?></b>
                                    </td>
                                    <!-- <td>
                                        <b><?= $resultvlu->address ?></b>
                                    </td> -->
                                    <td>
                                        <b><?= $resultvlu->lr_no ?></b>
                                    </td>

                                    <td>
                                        <b><?= $resultvlu->tracking_url ?></b>
                                    </td>
                                    <td> <?php // echo "<pre>";  print_r($resultvlu); echo "</pre>";die; ?>
                       
                                        <b><?php
                                
                                // if($resultvlu->tracking_url == NULL ) {
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
                                        }elseif ($resultvlu->status == 6) {
                                            ?>
                                            <button onclick="showStatusModel(<?= $this->uri->segment(3) ?>,<?= $resultvlu->id ?>,<?= $resultvlu->status ?>,
                                                    `<?= $resultvlu->message ?>`,`<?= $resultvlu->invoice_number ?>`, `<?= $resultvlu->tracking_no ?>`)"
                                                    class="btn btn-sm btn-danger" data-toggle="tooltip"
                                                    title="Change Status">
                                                    Recheck
                                            </button>
                                            <?php
                                        }
                                            
                                // }
                                            ?></b>
                                    </td>

                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="<?= base_url() ?>trip_sheet_admin/cargos_delete_process_other_state/<?= $this->uri->segment(3) ?>/<?= $resultvlu->id ?>"
                                               class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete Cargo">
                                                <i class="si si-trash"></i>
                                            </a>
                                            <!-- <a href="<?= base_url() ?>trip_sheet_admin/cargos/<?= $this->uri->segment(3) ?>/<?= $resultvlu->id ?>"
                                               class="btn btn-sm btn-success" data-toggle="tooltip"
                                               title="Update Values">
                                                <i class="fa fa-pencil"></i>
                                            </a> -->
                                        </div>
                                    </td>
                                </tr>

                                <!-- $total_cnt =  $total_cnt = +1;
                                $total_pcs = $total_pcs + $resultvlu->quantity;
                                $total_weight = $total_weight + $resultvlu->weight; -->

                               
                                <?php
                            }
                            ?>

                                <tr style="font-weight:bold">
                                <td colspan="5"> Total Count :<?= $total_cnt ?> </td> <td colspan="4">Total Pcs: <?= $total_pcs ?></td> <td colspan="6">Total Weight : <?= $total_weight ?></td>
                                </tr>
                        <?php
                        }
                        ?>


                        </tbody>
                    </table>
                    <div align="right">
                        <ul class="pagination">

                            <!-- Show pagination links -->
                            <?php foreach ($links as $link) {

                                echo "<li>" . $link . "</li>";
                            } ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Full Table -->

    </div>
    <!-- END Page Content -->

    <div id="asignModel" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="text-center">Update Status</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body" id="model">
                    <form class="form-horizontal form-label-left ajaxModel" method="post"
                          action="<?= base_url() ?>trip_sheet_admin/cargo_change_status" enctype = multipart/form-data>

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
                                    <option value="5">Recheck</option>
                                    
                                    
                                </select>
                            </div>
                        </div>

                        <div class="file" id="fileDiv" style="display:none">
                            <label for="file-uplod">File</label>
                            <div>
                            <input type="file" id="file" name="file" accept="">
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



    <div id="asignModelSelected" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="text-center">Update Status</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body" id="model">
                    <form class="form-horizontal form-label-left ajaxModel" method="post"
                          action="<?= base_url() ?>trip_sheet_admin/cargo_change_status_selected" enctype = multipart/form-data>

                        <div class="form-group dropdown">
                            <label for="example-select">Status</label>
                            <div>
                                <select class="form-control" onchange="onStatusChange(this);" id="sel_stat" name="sel_status">
                                    <option value="0">On the Way</option>
                                    <option value="1">Out for Delivery</option>    
                                    <option value="2">In Transit</option>    
                                    <option value="3">Delivered</option>
                                    <option value="4">Pending</option>
                                    <option value="5">Not Delivered</option>
                                    <option value="5">Recheck</option>

                                    
                                    
                                </select>
                            </div>
                        </div>

                        <div class="file" id="fileDiv" style="display:none">
                            <label for="file-uplod">File</label>
                            <div>
                            <input type="file" id="sel_file" name="sel_file" accept="">
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


  


    <div id="addLRNoModel" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="text-center">Update LR No / Url</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body" id="model1">
                    <form class="form-horizontal form-label-left ajaxModel" method="post"
                          action="<?= base_url() ?>trip_sheet_admin/updateLrNo" enctype = multipart/form-data>

                        <div id="cntnt"> </div> 
                        <div class="form-group">

                            <br/>
                            <input name="sel_tripsheet_id_lr" id="sel_tripsheet_id_lr" type="hidden">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                            <button type="submit"  class="btn btn-success">Submit</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    

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

    // $('#estimateDelDate').click(function (e) { 
      
    // });

    $(document).on('click', '#estimateDelDate', function(){
          if($(this).is(":checked")) { 
              $('.showEstimateDate').addClass("itemShow");       
          } else {
            $('.showEstimateDate').removeClass("itemShow");
          }           
    });

</script>


    <script>
        function showStatusModel(tripsheet_id, cargo_id_val, status, comment, invoice_no, tracking_no) {
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


        function addLRNoModel( ) {                        
            $('#addLRNoModel').modal('show', {backdrop: 'true'}); 

            var trip_sheet_id = document.getElementById("trip_sheet_id").value; 
            $("#addLRNoModel").find("#sel_tripsheet_id_lr").val(trip_sheet_id);    

             var checkValues = $('.checkbox-item:checked').map(function()
             {
                 return $(this).val();
             }).get(); 

            $.ajax({
    
                url:'<?php echo base_url() ?>trip_sheet_admin/ajaxLoadupdate_lrNo',
                data:{checkValues:checkValues},
                dataType : 'html',
                type:'POST',
                success:function(data){
                     
                       jQuery('#cntnt').html(data);
                     
                }
            });

        
        }



        


        function onStatusChange(sel) {
            var value = sel.value;
            if (value == 0) {
                $("#asignModel").find("#commentDiv").css({"display": "none"});
            }
            if (value == 1 || value == 5) {
                $("#asignModel").find("#commentDiv").css({"display": "inline"});
            }
            if (value == 2) {
                $("#asignModel").find("#commentDiv").css({"display": "inline"});
                $("#asignModel").find("#intransitDiv").css({"display": "inline"});                
            }
            else {
                $("#asignModel").find("#intransitDiv").css({"display": "none"});
            }

            if( value == 3 ){
                
                $("#asignModel").find("#fileDiv").css({"display": "block"});
            }
            else {
                $("#asignModel").find("#fileDiv").css({"display": "none"});

            }
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
		}
    });
           
       }
    </script>
  <script>
  jQuery(document).ready(function() {

    $('#inv_num').select2();
    jQuery('.js-example-basic-single').select2();
    
    // jQuery('#inv_num').select2('open');


});


  </script>  
</main>
<!-- END Main Container -->