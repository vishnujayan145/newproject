<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Shipment Transferred list</h4>                       

                    </div>
                </div>
            </div>
            <!-- end page title -->

             
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">                        
                        <button onclick="location.href='<?= base_url() ?>shipment/view/<?=$shipment_id?>'"  class="btn btn-primary" type="button">Shipment List</button> 
 
                            <!-- <form action="<?= base_url() ?>goods_details/listTransferPending?" method="get" name="myxfrm" enctype="multipart/form-data" onsubmit="return validateForm();"> 
                                <div class="row mt-2">   
                                  
                                    <div class="col-md-1"><label for="example-select">Trip No</label></div>
                                    <div class="col-md-1"><label for="example-select">Date</label></div>
                                    <div class="col-md-1"><label for="example-select">Filter</label></div>
                                    <div class="col-md-1"><label for="example-select">Value</label></div>
                                </div>

                                <div class="row"> 
                                 
                                <div class="col-md-2">                                   
                                    <select class="form-control select2" id="trip_no" size="5"  name="trip_no[]" multiple>                      
                                        <?php foreach($trip_no_arr as $trip_no) {  ?>
                                            <option   <?php if(!empty($_GET['trip_no'])) { if (  in_array($trip_no->trip_no , $_GET['trip_no']) ) {
                                                                                    echo 'selected="true"';
                                                                                } }  ?>  value="<?=$trip_no->trip_no?>"><?=$trip_no->trip_no?></option> 
                                                
                                        <?php } ?>
                                        </select>
                                    </div> 

                               
                                    <div class="col-md-2">                                   
                                        <input type="date" class="form-control" name="date" placeholder="date" value="<?php if (isset($_GET['date'])) {  echo $_GET['date'];  } ?>">
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
                                        
                            </form> -->
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
                                        <table id="tech-companies-1" class="table table-striped">
                                            <thead>
                                                <tr>
                                                    
                                                <th><input type="checkbox" id="allcb" name="allcb" /></th> 
                                                <th>Sl No</th>
                                                <th>Sort Order</th>
                                                <th>Transfer Date</th>
                                                <th>Transfer Status</th>
                                                <th>Company</th>
                                                <th>Ship.Name</th>
                                                <th>Origin</th>
                                                <th># No</th>
                                                <th>Tracking Number</th>
                                                <th>Trip Number</th>
                                                <th>Invoice</th>
                                                <th>Pcs</th>
                                                <th>Weight</th>
                                                <th>Re weight</th>
                                                <th>Recieved Pcs</th>
                                                <th >Sender Address</th>
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
                                                <th>Estimate Delivery Date</th>
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
    
                                                    $goods_status =  strtolower($resultvlu->goods_status);
                                                    if($resultvlu->bg_color == NULL) {
                                                        if($goods_status == 'short') {
                                                            $color = "#b0ffb0";
    
                                                        } else if( $goods_status == 'hold') {
                                                            $color = "#ffbbbb";
    
                                                        } else if( $goods_status == 'received') {
                                                            $color = "#c0ecff";
    
                                                        }else {
                                                            $color = "#fff";
                                                        }
                                                    } else {
                                                        $color = $resultvlu->bg_color;
                                                    }
                                                
                                        ?>
                                                <tr style="font-size: 1rem; background-color:<?=$color?>"  >
                                                    <td>
                                                        <input type="checkbox" name="invoice[]"  class="checkbox-item" id="chkBx-<?= $resultvlu->id ?>"  value="<?= $resultvlu->id ?>"
                                                        <?php if($resultvlu->sort_order != NUll) { echo "checked";} ?>
                                                        />
                                                    </td>  
                                                    <td><?= $key + 1 ?></td>
                                                    <td><?= $resultvlu->sort_order ?></td>
                                                    <td><?= $resultvlu->transfer_date? date('d-m-Y', strtotime($resultvlu->transfer_date)):'-' ?></td>
                                                    <td><?= $resultvlu->transfer_status??'-' ?></td>
                                                    <td>
                                                        <!-- <button onclick="showStatusModel(<?=$params ?>)" class="btn btn-sm btn-success editBtn" data-toggle="tooltip" title="Edit this row">
                                                            <i class="fa fa-pencil"></i>
                                                        </button> -->
                                                        <?= $resultvlu->company ?>
                                                    </td>
                                                    <td><?= $resultvlu->shipmentname ?></td>
                                                    <td><?= $resultvlu->origin ?></td>
                                                    <td><?= $resultvlu->boxno ?></td>
                                                    <td><?= $resultvlu->tracking_no ?></td>
                                                    <td><?= $resultvlu->trip_no ?></td>
                                                    <td>
                                                        <?= isset($resultvlu->invoiceno)? $resultvlu->invoiceno :'--'?>
                                                    </td>
                                                    <td>
                                                        <?= $resultvlu->pcs ?>
                                                    </td>
                                                    <td>
                                                        <?= $resultvlu->weight ?>
                                                    </td>
                                                    <td>
                                                        <?= $resultvlu->rewight ?>
                                                    </td>
                                                    <td>
                                                        <?= $resultvlu->received_pcs ?>
                                                    </td>
                                                    <td  width="100px"><?= $resultvlu->sender_address  ?></td>
                                                    <td  width="100px"><?= $resultvlu->reciever_address ?></td>
    
                                                    <td><?= $resultvlu->phone ?></td>
                                                    <td><?= $resultvlu->state ?></td>
                                                    <td>
                                                        <?= $resultvlu->district ?>
                                                    </td>
                                                    <td><?= $resultvlu->pincode ?></td>
                                                    <td><?= substr($resultvlu->goods_desc,0,50) ?></td>
                                                    <td><?= $resultvlu->recieved_at_hub ?></td>
                                                    <td><?= $resultvlu->connecting_date ?></td>
                                                    <td><?= $resultvlu->recieved_at_branch ?></td>
                                                    <td><?= $resultvlu->vendor ?></td>
                                                    <td><?= $resultvlu->contact_no ?></td>
                                                    <td><?= $resultvlu->docket ?></td>
                                                    <td><?= $resultvlu->goods_status ?></td>
                                                    <td><?= $resultvlu->remarks ?></td>
                                                    <td>
                                                        <?=!empty($resultvlu->sendingdate) ? date('d/m/Y', strtotime($resultvlu->sendingdate)):'-'?>
                                                    </td>
                                                    <td>
                                                        <?= !empty($resultvlu->recievingdate) ? date('d/m/Y', strtotime($resultvlu->recievingdate)): '-'?>
                                                    </td>
                                                    <td>
                                                        <?= !empty($resultvlu->estimate_delivery_date) ? date('d/m/Y', strtotime($resultvlu->estimate_delivery_date)): '-' ?>
                                                    </td>
    

                                                    <td class="text-center">  
                                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                            <button type="button" class="btn btn-outline-secondary"  onclick="showDeleteModel(<?=$resultvlu->id ?>)"  data-toggle="tooltip" title="Delete" ><i class="mdi mdi-trash-can-outline"  style="font-size: 22px"></i></button>  
                                                            
                                                            <button type="button" class="btn btn-outline-primary" data-toggle="tooltip" title="Print" onclick="location.href='<?= base_url() ?>goods_details/print/<?= $resultvlu->id ?>'" > <i class="mdi mdi-printer"  style="font-size: 22px"></i>  </button>
                                                            <button type="button" class="btn btn-outline-secondary" onclick="location.href='<?= base_url() ?>goods_details/update/<?= $resultvlu->id ?>'" >  <i class="fas fa-pencil-alt"  style="font-size: 22px"></i> </button>  
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