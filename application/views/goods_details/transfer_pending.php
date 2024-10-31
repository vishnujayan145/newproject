<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- select2 -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

  <!-- select2-bootstrap4-theme -->
  <link href="https://raw.githack.com/ttskch/select2-bootstrap4-theme/master/dist/select2-bootstrap4.css" rel="stylesheet"> <!-- for live demo page -->



  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>


<div class="main-content">
       <?php

    $month = date('m');
    $day = date('d');
    $year = date('Y');

    $today = $year . '-' . $month . '-' . $day;
    echo date("d-m-Y");
    echo "test";
    ?>
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Transfer Pending Goods</h4>

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
                                <button type="button" class="btn btn-outline-primary" onclick="confirmReceived();" > &nbsp;&nbsp;Confirm Received &nbsp;&nbsp;</button>
                                
                            </div> 
 
                            <form action="<?= base_url() ?>goods_details/listTransferPending?" method="get" name="myxfrm" enctype="multipart/form-data" onsubmit="return validateForm();"> 
                                <div class="row mt-2">   
                                  
                                    <div class="col-md-2"><label for="example-select">Trip No</label> </div>
                                    <div class="col-md-2"><label for="example-select">Date</label></div>
                                    <div class="col-md-2"><label for="example-select">Filter</label></div>
                                    <div class="col-md-2"><label for="example-select">Value</label></div>
                                </div>

                                <div class="row"> 
                                 
                                <div class="col-md-2">   
                                    <?php /*                                
                                    <select class="form-control select2" id="trip_no" size="5"  name="trip_no[]" multiple>                      
                                        <?php foreach($trip_no_arr as $trip_no) {  ?>
                                            <option   <?php if(!empty($_GET['trip_no'])) { if (  in_array($trip_no->trip_no , $_GET['trip_no']) ) {
                                                                                    echo 'selected="true"';
                                                                                } }  ?>  value="<?=$trip_no->trip_no?>"><?=$trip_no->trip_no?></option> 
                                                
                                        <?php } ?>
                                        </select> */ ?>

                                    <select multiple placeholder="Choose trip no"  id="trip_no"  name="trip_no[]" data-allow-clear="1">
                                        <?php foreach($trip_no_arr as $trip_no) {  ?>
                                                <option   <?php if(!empty($_GET['trip_no'])) { if (  in_array($trip_no->trip_no , $_GET['trip_no']) ) {  echo 'selected="true"';  } }  ?>  value="<?=$trip_no->trip_no?>"><?=$trip_no->trip_no?></option> 

                                        <?php } ?>
                                    </select>   

                                    </div> 

                               
                                    <div class="col-md-2">                                   
                                        <input type="date" class="form-control" name="date" value="<?php echo $today; ?>" placeholder="date" value="<?php if (isset($_GET['date'])) {  echo $_GET['date'];  } ?>">
                                    </div>  
                                    <div class="col-md-2">                                   
                                        <select class="form-control" id="serachq" name="serachq">
                                            <option value="all" <?php if (isset($_GET['serachq']) && $_GET['serachq'] == 'all') {   echo 'selected="true"';  } ?>>All</option>
                                            <option value="invoiceno" <?php if (isset($_GET['serachq']) && $_GET['serachq'] == 'invoiceno') {   echo 'selected="true"';   } ?>>Invoice No</option>                                
                                            <option value="company" <?php if (isset($_GET['serachq']) && $_GET['serachq'] == 'company') {  echo 'selected="true"';  } ?>>Company</option>
                                            <option value="address" <?php if (isset($_GET['serachq']) && $_GET['serachq'] == 'address') {   echo 'selected="true"';  } ?>>Address</option>
                                            <option value="pcs" <?php if (isset($_GET['serachq']) && $_GET['serachq'] == 'pcs') {  echo 'selected="true"';  } ?>>Pcs</option>
                                            <option value="weight" <?php if (isset($_GET['serachq']) && $_GET['serachq'] == 'weight') {  echo 'selected="true"';  } ?>>Weight</option>
                                            <option value="shipmentname" <?php if (isset($_GET['serachq']) && $_GET['serachq'] == 'shipmentname') {   echo 'selected="true"';  } ?>>Ship.Name</option>
                                            <option value="agencyname" <?php if (isset($_GET['serachq']) && $_GET['serachq'] == 'agencyname') {   echo 'selected="true"';  } ?>>Agency Name</option>
                                            <option value="sendingdate" <?php if (isset($_GET['serachq']) && $_GET['serachq'] == 'sendingdate') { echo 'selected="true"'; } ?>>Sending Date</option>
                                            <option value="recievingdate" <?php if (isset($_GET['serachq']) && $_GET['serachq'] == 'recievingdate') {  echo 'selected="true"';  } ?>>Recciev.Date</option>
                                            <option value="phone" <?php if (isset($_GET['serachq']) && $_GET['serachq'] == 'phone') {  echo 'selected="true"'; } ?>>Mobile</option>
                                            <option value="transfer" <?php if (isset($_GET['serachq']) && $_GET['serachq'] == 'transfer') { echo 'selected="true"'; } ?>>Transfer</option>
                                            <option value="vendor" <?php if (isset($_GET['serachq']) && $_GET['serachq'] == 'vendor') { echo 'selected="true"'; } ?>>Vendor</option>
                                            <option value="state" <?php if (isset($_GET['serachq']) && $_GET['serachq'] == 'state') { echo 'selected="true"'; } ?>>State</option>
                                            <option value="district" <?php if (isset($_GET['serachq']) && $_GET['serachq'] == 'district') { echo 'selected="true"'; } ?>>District</option>
                                            <option value="trip_no" <?php if (isset($_GET['serachq']) && $_GET['serachq'] == 'trip_no') { echo 'selected="true"'; } ?>>Trip No</option>
                                            <option value="tracking_no" <?php if (isset($_GET['serachq']) && $_GET['serachq'] == 'tracking_no') { echo 'selected="true"'; } ?>>Tracking No</option>
                                            <option value="boxno" <?php if (isset($_GET['serachq']) && $_GET['serachq'] == 'boxno') { echo 'selected="true"'; } ?>># No</option>
                                            <option value="goods_status" <?php if (isset($_GET['serachq']) && $_GET['serachq'] == 'goods_status') { echo 'selected="true"'; } ?>>Status</option>
                                            <option value="gt_reweight" <?php if (isset($_GET['serachq']) && $_GET['serachq'] == 'gt_reweight') { echo 'selected="true"'; } ?>>GT Reweight</option>

                                        </select>
                                    </div>
                                    <div class="col-md-2">                                   
                                        <input type="text" class="form-control" name="inptvalue" id="inptvalue" placeholder="search.." value="<?php if (isset($_GET['inptvalue'])) { echo $_GET['inptvalue'];  } ?>">
                                    </div>

                                    <div class="col-md-2">                                   
                                    <button type="submit" class="btn btn-secondary">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                    </div>

                                </div> 
                                        
                            </form>
                                <!-- Filter By -->
                           
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
                                        <table id="tech-companies-1" class="table ">
                                            <thead>
                                                <tr>
                                                    
                                                <th><input type="checkbox" id="allcb" name="allcb" /></th> 
                                 <th>Sl No</th>
                                 <th>Transfer Status</th>
                                 <th>Company</th>
                                 <th>Ship.Name</th>
                                 <th>Agency Name</th>
                                 <th>Origin</th>
                                 <th>Tracking Number</th>
                                 <th>Invoice</th>
                                 <th>Trip NO</th>
                                 <th>Pcs</th>
                                 <th>Weight</th>
                                 <th>Re weight</th>
                                 <th>Recieved Pcs</th>
                                 <th>Sender Address</th>
                                 <th>Reciever Address</th>
                                 <th>Phone</th>
                                 <th>Sate</th>
                                 <th>District</th>
                                 <th>Pincode</th>
                                 <th>Desc. of Goods</th>
                                 <th>Recieved at Hub</th>
                                 <th>Connecting Date</th>
                                 <th>Recieved at Branch</th>
                                 <th>Vendor</th>
                                 <th>Contact Number</th>
                                  <th>Docket</th>
                                 <th>Status</th>
                                 <th>Remark</th>
                                 <th>Sending Date</th>
                                 <th>Recciev.Date</th>
                                 <th class="text-center" style="width: 100px;">Actions</th>



                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            
                                            if ($result != null) {
                                                foreach ($result as $key => $resultvlu) {                                         
                                                    $params = "";
                                                    $params .=$resultvlu->id;
                                                    (trim($resultvlu->rewight)!="") ? $params .= ",".$resultvlu->rewight : $params .= ","."undefined";
                                                    ($resultvlu->received_pcs!="") ? $params .= ",".$resultvlu->received_pcs : $params .= ","."undefined";
                                                    ($resultvlu->recieved_at_hub!="") ? $params .= ",`".date('Y-m-d',strtotime($resultvlu->recieved_at_hub))."`" : $params .= ","."undefined";
                                                    ($resultvlu->connecting_date!="") ? $params .= ",`".date('Y-m-d',strtotime($resultvlu->connecting_date))."`" : $params .= ","."undefined";
                                                    ($resultvlu->vendor!="") ? $params .= ",`".$resultvlu->vendor."`" : $params .= ","."undefined";
                                                    ($resultvlu->docket!="") ? $params .= ",`".$resultvlu->docket."`" : $params .= ","."undefined";
                                                    ($resultvlu->status) ? $params .= ",`".$resultvlu->status."`" : $params .= ","."undefined";
                                                    ($resultvlu->remarks) ? $params .= ",`".$resultvlu->remarks."`" : $params .= ","."undefined";
                                                    ($resultvlu->weight) ? $params .= ",`".$resultvlu->weight."`" : $params .= ","."undefined";
                                                    ($resultvlu->invoiceno) ? $params .= ",`".$resultvlu->invoiceno."`" : $params .= ","."undefined";
                                                    ($resultvlu->tracking_no) ? $params .= ",`".$resultvlu->tracking_no."`" : $params .= ","."undefined";
                                                    ($resultvlu->boxno) ? $params .= ",`".$resultvlu->boxno."`" : $params .= ","."undefined";
                                                    ($resultvlu->goods_status) ? $params .= ",`".$resultvlu->goods_status."`" : $params .= ","."undefined";
                                                    ($resultvlu->state) ? $params .= ",`".$resultvlu->state."`" : $params .= ","."undefined";
                                                    ($resultvlu->district) ? $params .= ",`".$resultvlu->district."`" : $params .= ","."undefined";
                                                   
                                            ?>
                                                 <tr style="font-size: 1rem; --bs-table-bg:<?= $resultvlu->bg_color!=''? $resultvlu->bg_color:'#fff'?>;" >
                                                     <td>
                                                         
                                                            <b><input type="checkbox" name="invoice[]"  class="checkbox-item" id="1"  value="<?= $resultvlu->id ?>" /></b> 
                                                      
                                                        
                                                     </td>  
                                                     <td><?= $key + 1 ?></td>
                                                     <td><?= $resultvlu->transfer_status??'-' ?></td>
                                                     <td>
                                                         <button onclick="showStatusModel(<?=$params ?>)" class="btn btn-sm btn-success" data-toggle="tooltip" title="Edit this row">
                                                             <i class="fas fa-pencil-alt"></i>
                                                         </button>
                                                         <?= $resultvlu->company ?>
                                                     </td>
                                                     <td><b><?= $resultvlu->shipmentname ?></b></td>
                                                     <td><b><?= $resultvlu->agencyname ?></b></td>
                                                     <td><b><?= $resultvlu->origin ?></b></td>
                                                     <td><?= $resultvlu->tracking_no ?></td>
                                                     <td>
                                                         <b><?= isset($resultvlu->invoiceno)? $resultvlu->invoiceno :'--'?></b>
                                                     </td>
                                                     <td>
                                                         <b><?= $resultvlu->trip_no ?></b>
                                                     </td>
                                                     <td>
                                                         <b><?= $resultvlu->pcs ?></b>
                                                     </td>
                                                     <td>
                                                         <b><?= $resultvlu->weight ?></b>
                                                     </td>
                                                     <td>
                                                         <b><?= $resultvlu->rewight ?></b>
                                                     </td>
                                                     <td>
                                                         <b><?= $resultvlu->received_pcs ?></b>
                                                     </td>
                                                     <td><b><?= $resultvlu->sender_address ?></b></td>
                                                     <td><b><?= $resultvlu->reciever_address ?></b></td>
                                                     <td><b><?= $resultvlu->phone ?></b></td>
                                                     <td><b><?= $resultvlu->state ?></b></td>
                                                     <td>
                                                         <b><?= $resultvlu->district ?></b>
                                                     </td>
                                                     <td><b><?= $resultvlu->pincode ?></b></td>
                                                     <td><b><?= substr($resultvlu->goods_desc,0,50) ?></b></td>
                                                     <td><b><?= $resultvlu->recieved_at_hub ?></b></td>
                                                     <td><b><?= $resultvlu->connecting_date ?></b></td>
                                                     <td><b><?= $resultvlu->recieved_at_branch ?></b></td>
                                                     <td><b><?= $resultvlu->vendor ?></b></td>
                                                     <td><b><?= $resultvlu->contact_no ?></b></td>
                                                      <td><b><?= $resultvlu->docket ?></b></td>
                                                     <td><b><?= $resultvlu->goods_status ?></b></td>
                                                     <td><b><?= $resultvlu->remarks ?></b></td>
                                                     <td>
                                                         <b><?= $resultvlu->sendingdate ?></b>
                                                     </td>
                                                     <td>
                                                         <b><?= $resultvlu->recievingdate ?></b>
                                                     </td>
             
            
                                                     <td class="text-center"> 
                                                         <div class="btn-group">
                                                             <a href="<?= base_url() ?>goods_details/delete_process/<?= $resultvlu->id ?>" class="btn btn-sm btn-secondary" data-toggle="tooltip" onclick="return confirm('Are you sure you want to delete this item?');" title="Delete">
                                                                 <i class="mdi mdi-trash-can-outline"></i>
                                                             </a> <a href="<?= base_url() ?>goods_details/print/<?= $resultvlu->id ?>" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Print">
                                                                 <i class="mdi mdi-printer"  style="font-size: 22px""></i>
                                                             </a>
                                                             <a href="<?= base_url() ?>goods_details/update/<?= $resultvlu->id ?>" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Edit">
                                                             <i class="fas fa-pencil-alt"  style="font-size: 22px"></i>
                                                             </a>
                                                         </div>
                                                     </td>
                                                 </tr>
                                         <?php
                                                }
                                            } else { ?>
                                                <tr>
                                                <td colspan="18" style="text-align:center;"><b>No Pending Transfer Goods</b></td>
                                                <td colspan="12" style="text-align:center;"></td>                                
                                            </tr>
            
                                           <?php     
                                            }

                                            ?>  
                                            </tbody>
                                        </table>

                                        <div align="right">
                                       
                                        <p><?php  echo $links; ?></p>
 
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




   <!-- asignModel -->
   <div class="modal fade" id="asignModel" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div style="padding:5px; text-align:center;"">
                <h4 class="text-primary">Edit Info</h4>
                </div>
                <div class="modal-body">
                    <div class="mb-4">
                            
                        <div class="row justify-content-left">
                            <div class="col-xl-12">                             
                                 
                            
                            <div id="msg" style="color:green;font-size:22px;"> </div>
                                    <!-- <form class="form-horizontal form-label-left ajaxModel" method="post" action="<?= base_url() ?>goods_details/update_info"> -->
                                    <form class="form-horizontal form-label-left ajaxModel" name="editForm" id="editForm" method="post" action="#">

                                    <div class="row mb-5">
                                            <div class="col-md-6">
                                            State : <span id="state"></span><br>
                                            Invoice No : <span id="invoiceNo"></span><br>
                                            Weight : <span id="weight"></span><br>
                                            
                                        </div>

                                        <div class="col-md-6">
                                            District : <span id="district"></span><br>
                                            Tracking No : <span id="trackingNo"></span><br> 
                                            # No : <span id="boxNo"></span><br>
                                        </div>
                                    </div>
                                        <div class="row">
                                            <input type="hidden" id="uid" name="id">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="example-select">Re weight</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="rewight" id="rewight">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="example-select">Recieved Pcs</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="recieved_pcs" id="recieved_pcs">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="example-select">Vendor</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="vendor" id="vendor">
                                                    </div>
                                                </div>
                                                <!-- <div class="form-group">
                                                    <label for="example-select">Docket</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="docket" id="docket">
                                                    </div>
                                                </div> -->
                                                <div class="form-group">
                                                    <label for="example-select">Remarks</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="remarks" id="remarks">
                                                    </div>
                                                </div>

                                                <div class="form-group">

                                                <br />
                                                <button type="button" id="EditPopup" class="btn btn-success">Submit</button>
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>


                                            </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="example-select">Recieved Date at Hub</label>
                                                    <div>
                                                        <input type="date" class="form-control" name="recieved_at_hub" id="recieved_at_hub">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="example-select">Connecting Date</label>
                                                    <div>
                                                        <input type="date" class="form-control" name="connecting_date" id="connecting_date">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="example-select">Status</label>
                                                    <div>

                                                <select class="form-control" id="goods_status" name="goods_status">
                                                    <option value="received">Received</option>
                                                    <option value="hold">Hold</option>
                                                    <option value="short">Short</option>
                                                </select> 
                                                    </div>
                                                </div>
                                            
                                            </div>
                                        </div>


                                        <input name="cargo_id" id="cargo_id" type="hidden">
                                        <input name="redirectURL" id="redirectURL" type="hidden" value="">
                                        <!-- <div class="form-group">

                                            <br />
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-success">Submit</button>

                                        </div> -->
                                    </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal -->

 

      <!-- confirmReceived -->
      <div class="modal fade" id="confirmReceived" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div style="padding:5px; text-align:center;"">
                <h4 class="text-primary">Confirm received</h4>
                </div>
                <div class="modal-body">
                    <div class=" mb-4">
                            
                        <div class="row justify-content-center">
                            <div class="col-xl-12">                             
                                 
                            <form class="form-horizontal form-label-left ajaxModel" method="post" action="<?= base_url() ?>goods_details/confirm_received_goods">
                   
                    
 
                   <input name="sel_goods_id_received" id="sel_goods_id_received" type="hidden">
                   <div class="form-group">

                       <br />
                       <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                       <button type="submit" id="confirmReceivedGoods" class="btn btn-success">Confirm Received Goods</button>

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

<script type="text/javascript">

$(function () {
  $('select').each(function () {
    $(this).select2({
      theme: 'bootstrap4',
      width: 'style',
      placeholder: $(this).attr('placeholder'),
      allowClear: Boolean($(this).data('allow-clear')),
    });
  });
});


    //reload page after confirm received goods
    document.getElementById( 'confirmReceivedGoods').addEventListener('click', (e) => {
    document.getElementById('confirmReceived').style.visibility = "hidden";
    
        window.location.reload();
    });




    function showStatusModel(cargo_id_val, rewight, recieved_pcs, recieved_at_hub, connecting_date,vendor,docket,status,remarks, weight, invoiceno, tracking_no, boxno, goods_status, state,district ) {
        console.log("*"); 
         window.cargo_id_val = cargo_id_val;
         document.getElementById("cargo_id").value = cargo_id_val;
         console.log(connecting_date);
         $("#asignModel").find("#rewight").val(rewight);
         $("#asignModel").find("#recieved_pcs").val(recieved_pcs);

         $("#asignModel").find("#vendor").val(vendor);
         $("#asignModel").find("#docket").val(docket);
         $("#asignModel").find("#status").val(status);
         $("#asignModel").find("#remarks").val(remarks);
         $("#asignModel").find("#uid").val(cargo_id_val);

         $("#asignModel").find("#invoiceNo").text(invoiceno);
         $("#asignModel").find("#weight").text(weight);
         $("#asignModel").find("#trackingNo").text(tracking_no);
         $("#asignModel").find("#boxNo").text(boxno);
         $("#asignModel").find("#state").text(state);
         $("#asignModel").find("#district").text(district);
         const currentUrl = window.location.href;
         $("#asignModel").find("#redirectURL").val(currentUrl); 


         if(goods_status != undefined ){
            $("#asignModel").find("#goods_status").val(goods_status); 
         }

         if(recieved_at_hub != undefined ){
            $("#asignModel").find("#recieved_at_hub").val(recieved_at_hub);
         } else {     
            $("#asignModel").find("#recieved_at_hub").val('<?=date('Y-m-d')?>');
         }
         if(connecting_date != undefined ){
            $("#asignModel").find("#connecting_date").val(connecting_date);
         }else {
            $("#asignModel").find("#connecting_date").val('<?=date('Y-m-d')?>');            
         }

         $('#asignModel').modal('show', {
             backdrop: 'true'
         }); 

     }

     

    function confirmReceived( ) {
    
    var checkValues = $('.checkbox-item:checked').map(function()
    {
        return $(this).val();
    }).get();

    document.getElementById("sel_goods_id_received").value = checkValues;  

    $('#confirmReceived').modal('show', {
            backdrop: 'true'
        });

    }
  
</script>