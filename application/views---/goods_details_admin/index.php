<style>
   
table th, td{
    outline: 1px solid #ccc;
    padding:0.25em 0.5em 0.25em 1em;
    text-indent: -0.5em;
    text-align:center;
}
 
th {
    top :-21px;
    position:sticky;
    background-color: #d5d7ca;
    /* font-weight:bold!important; */

} 
</style>
 


<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
 
<!-- Main Container -->
 <main id="main-container" style="">

     <!-- Page Content -->
     <div class="content">

         <!-- Full Table -->
        <div class="block" style="">
            <div class="block-header block-header-default" style="    padding: 0px;">
                 <span class="block-title" style="    padding: 0px;">
                     <h2 class="content-heading" style="    padding: 0px;">Goods details</h2>
                 </span>
                 <!-- <input class="btn btn-alt-primary" type="button" value="Reset Selected"  onclick="resetSelected();"/> &nbsp; -->
                 <!-- <input class="btn btn-alt-primary" type="button" value="Transfer Goods"  onclick="transferGoodsModel();"/> &nbsp; -->
                 <!-- <input class="btn btn-alt-primary" type="button" value="Confirm Received"  onclick="confirmReceived();"/> &nbsp;&nbsp; -->
                 <!-- <a href="<?= base_url() ?>goods_details_admin/create" class="btn btn-alt-primary"><i class="fa fa-plus mr-2"></i>Add Goods details</a>&nbsp; -->
                 <!-- <input class="btn btn-alt-primary"  type="button" value="Add Cargos"  onclick="addCargosModel();"/> &nbsp;  -->
                 <a href="<?= base_url() ?>goods_details_admin/printall" class="btn btn-alt-primary"><i class="si si-printer mr-2"></i>Print all</a>&nbsp;
                 <a href="<?= base_url() ?>goods_details_admin/printnew" class="btn btn-alt-primary"><i class="si si-printer mr-2"></i>New Print</a>&nbsp;
                 <a href="#" onclick="actiononselected(1)" class="btn btn-alt-primary"><i class="si si-printer mr-2"></i>Print Selected</a>&nbsp;
                 <a href="#" onclick="deleteSelected()" class="btn btn-alt-primary"><i class="si si-trash mr-2"></i>Delete</a>
             </div>
        <div>


                 <form action="<?= base_url() ?>goods_details_admin/index?" method="get" name="myxfrm" enctype="multipart/form-data" onsubmit="return validateForm();">
                     <div class="dropdown float-right">
                         <label for="example-select">&nbsp;</label>
                         <div class="input-group-append">
                             <button type="submit" class="btn btn-secondary">
                                 <i class="fa fa-search"></i>
                             </button>
                         </div>
                     </div>


                     <div class="dropdown float-right">
                         <label for="example-select">value</label>
                         <div>
                             <input type="text" class="form-control" name="inptvalue" id="inptvalue" placeholder="search.." value="<?php if (isset($_GET['inptvalue'])) {
                                                                                                                        echo $_GET['inptvalue'];
                                                                                                                    } ?>">
                         </div>
                     </div>
                     <div class="dropdown float-right">
                         <label for="example-select">Filter</label>
                         <div>
                             <select class="form-control" id="serachq" name="serachq">
                                 <option value="all" <?php if (isset($_GET['serachq']) && $_GET['serachq'] == 'all') {
                                                            echo 'selected="true"';
                                                        } ?>>All</option>
                                 <option value="invoiceno" <?php if (isset($_GET['serachq']) && $_GET['serachq'] == 'invoiceno') {
                                                                echo 'selected="true"';
                                                            } ?>>Invoice No</option>
                                 <!-- <option value="date" <?php if (isset($_GET['serachq']) && $_GET['serachq'] == 'date') {
                                                                echo 'selected="true"';
                                                            } ?>>Date</option> -->
                                 <option value="company" <?php if (isset($_GET['serachq']) && $_GET['serachq'] == 'company') {
                                                                echo 'selected="true"';
                                                            } ?>>Company</option>
                                 <option value="address" <?php if (isset($_GET['serachq']) && $_GET['serachq'] == 'address') {
                                                                echo 'selected="true"';
                                                            } ?>>Address</option>
                                 <option value="pcs" <?php if (isset($_GET['serachq']) && $_GET['serachq'] == 'pcs') {
                                                            echo 'selected="true"';
                                                        } ?>>Pcs</option>
                                 <option value="weight" <?php if (isset($_GET['serachq']) && $_GET['serachq'] == 'weight') {
                                                            echo 'selected="true"';
                                                        } ?>>Weight</option>
                                 <option value="shipmentname" <?php if (isset($_GET['serachq']) && $_GET['serachq'] == 'shipmentname') {
                                                                    echo 'selected="true"';
                                                                } ?>>Ship.Name</option>
                                 <option value="sendingdate" <?php if (isset($_GET['serachq']) && $_GET['serachq'] == 'sendingdate') {
                                                                    echo 'selected="true"';
                                                                } ?>>Sending Date</option>
                                 <option value="recievingdate" <?php if (isset($_GET['serachq']) && $_GET['serachq'] == 'recievingdate') {
                                                                    echo 'selected="true"';
                                                                } ?>>Recciev.Date</option>
                                                                <option value="phone" <?php if (isset($_GET['serachq']) && $_GET['serachq'] == 'phone') {
                                                                    echo 'selected="true"';
                                                                } ?>>Mobile</option>

                                                                <option value="transfer" <?php if (isset($_GET['serachq']) && $_GET['serachq'] == 'transfer') {
                                                                    echo 'selected="true"';
                                                                } ?>>Transfer</option>

                                                                <option value="vendor" <?php if (isset($_GET['serachq']) && $_GET['serachq'] == 'vendor') {
                                                                    echo 'selected="true"';
                                                                } ?>>Vendor</option>

                                                                <option value="state" <?php if (isset($_GET['serachq']) && $_GET['serachq'] == 'state') {
                                                                    echo 'selected="true"';
                                                                } ?>>State</option>

                                                                <option value="district" <?php if (isset($_GET['serachq']) && $_GET['serachq'] == 'district') {
                                                                    echo 'selected="true"';
                                                                } ?>>District</option>
                                                                 <option value="trip_no" <?php if (isset($_GET['serachq']) && $_GET['serachq'] == 'trip_no') {
                                                                    echo 'selected="true"';
                                                                } ?>>Trip No</option>
                                                                 <option value="tracking_no" <?php if (isset($_GET['serachq']) && $_GET['serachq'] == 'tracking_no') {
                                                                    echo 'selected="true"';
                                                                } ?>>Tracking No</option>
                                                                 <option value="boxno" <?php if (isset($_GET['serachq']) && $_GET['serachq'] == 'boxno') {
                                                                    echo 'selected="true"';
                                                                } ?>># No</option>

                                                                <option value="goods_status" <?php if (isset($_GET['serachq']) && $_GET['serachq'] == 'goods_status') {
                                                                    echo 'selected="true"';
                                                                } ?>>Status</option>

                             </select>
                         </div>

                     </div>
                     <div class="dropdown float-right">
                         <label for="example-select">date</label>
                         <div>
                             <input type="date" class="form-control" name="date" placeholder="date" value="<?php if (isset($_GET['date'])) {
                                                                                                                echo $_GET['date'];
                                                                                                            } ?>">
                         </div>
                     </div>

                     <!-- <div class="dropdown float-right mr-3">
                         <label for="example-select">Export as OGM</label>
                         <div>
                             <input type="submit" class="form-control" name="download_ogm" value="Download OGM">
                         </div>
                     </div>
                     <div class="dropdown float-right mr-3">
                         <label for="example-select">Export as Sorting List</label>
                         <div>
                             <input type="submit" class="form-control" name="download_sorting" value="Download Sorting List">
                         </div>
                     </div>
                     <div class="dropdown float-right mr-3">
                         <label for="example-select">Export as Loading list</label>
                         <div>
                             <input type="submit" class="form-control" name="download_loading" value="Download Loading List">
                         </div>
                     </div>
                     <div class="dropdown float-right mr-3">
                         <label for="example-select">Download</label>
                         <div>
                             <input type="submit" class="form-control" name="download_to_import" value="Download">
                         </div>
                     </div> -->
                     <div class="dropdown float-right mr-3">
                         <label for="example-select">Trip No</label> <input type="button" value="Reset" id="butt"/>
                         <div>
                         <select class="form-control select2" id="trip_no" size="5"  name="trip_no[]" multiple> 
                     
                         <?php foreach($trip_no_arr as $trip_no) {  ?>
                            <option   <?php if(!empty($_GET['trip_no'])) { if (  in_array($trip_no->trip_no , $_GET['trip_no']) ) {
                                                                    echo 'selected="true"';
                                                                } }  ?>  value="<?=$trip_no->trip_no?>"><?=$trip_no->trip_no?></option> 
 
                                
                        <?php } ?>
                        </select>
                         </div>
                     </div>

                     <div class="dropdown float-right">
                                 <label for="example-select">Branch Name</label>
                                 <div>
                                    <select class="form-control" id="branch_id" name="branch_id" >
                                       <option value="all" <?php if(isset($_GET['branch_id']) && $_GET['branch_id']=='all'){ echo 'selected="true"'; } ?>>All</option>
                                        <?php
                                        if($branches_arr!=null)
                                        {
                                        foreach ($branches_arr as $key => $branch) {
                                        ?>
                                        <option value="<?=$branch->id?>" <?php if(isset($_GET['branch_id']) && $_GET['branch_id']==$branch->id){ echo 'selected="true"'; } ?> ><?=$branch->branch_name?></option>
                                        <?php
                                        }
                                        }
                                        ?>    
                                    </select>
                                 </div>   
                            </div>

                 </form>
                 Filter By
             </div>
             <hr>
         </div>
         <div class="block" style="margin-top:50px;">
            <div class="block-content tails">
                <div id="selCnt" style="font-weight:bold"><?php if(isset($total_sel_cnt)) {
                     echo "Total Count : ". $total_sel_cnt;} ?></div> 
            </div> 
        </div>
         <div class="block">
             <div class="block-content goods-details">
                 <div class="">
                     <div id="ermsg"> <?= $this->session->flashdata('msgx'); ?> </div> 
                   
                     <table class="table table-striped table-vcenter">
                         <thead>
                             <tr>
                                 <th><input type="checkbox" id="allcb" name="allcb" /></th> 
                                 <th>Sl No</th>
                                 <th>Sort Order</th>
                                 <th>Transfer Status</th>
                                 <th>Company</th>
                                 <th>Ship.Name</th>
                                 <th>Origin</th>
                                 <th>Current Branch</th>
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
                                 <th class="text-center" style="width: 100px;">Actions</th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php
                           
                                if ($result != null) {
                                    foreach ($result as $key => $resultvlu) {                                         
                                            $params = "";
                                            $params .=$resultvlu->goods_id;
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
                                            if($goods_status == 'short') {
                                                $color = "#b0ffb0";

                                            } else if( $goods_status == 'hold') {
                                                $color = "#ffbbbb";

                                            } else if( $goods_status == 'received') {
                                                $color = "#c0ecff";

                                            }else {
                                                $color = "#fff";
                                            }
                                       
                                ?>
                                     <tr style="font-size: 1rem; background-color:<?=$color?>"  >
                                     <td> 
                                          <?php
                                            if(  strtolower($goods_status) != 'short'  &&  strtolower($goods_status) != 'hold' ) { 
                                             ?>
                                                <b><input type="checkbox" name="invoice[]"  class="checkbox-item" id="chkBx-<?= $resultvlu->goods_id ?>"  value="<?= $resultvlu->goods_id ?>"
                                                <?php if($resultvlu->sort_order != NUll) { echo "checked";} ?>
                                                /></b> 
                                            <?php
                                              }  
                                             ?>
                                            
                                         </td>  
                                         
                                         <td><?= $key + 1 ?></td>
                                         <td><?= $resultvlu->sort_order ?></td>
                                         <td><?= $resultvlu->transfer_status??'-' ?></td>
                                         <td>
                                             <button onclick="showStatusModel(<?=$params ?>)" class="btn btn-sm btn-success editBtn" data-toggle="tooltip" title="Edit this row">
                                                 <i class="fa fa-pencil"></i>
                                             </button>
                                             <?= $resultvlu->company ?>
                                         </td>
                                         <td><b><?= $resultvlu->shipmentname ?></b></td>
                                         <td><b><?= $resultvlu->origin ?></b></td>
                                         <td><b><?= $resultvlu->branch_name ?></b></td>
                                         <td><b><?= $resultvlu->boxno ?></b></td>
                                         <td><?= $resultvlu->tracking_no ?></td>
                                         <td><?= $resultvlu->trip_no ?></td>
                                         <td>
                                             <b><?= isset($resultvlu->invoiceno)? $resultvlu->invoiceno :'--'?></b>
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
                                         <td  width="100px"><b><?= $resultvlu->sender_address  ?></b></td>
                                         <td  width="100px"><b><?= $resultvlu->reciever_address ?></b></td>

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
                                                 <!-- <a href="<?= base_url() ?>goods_details/delete_process/<?= $resultvlu->goods_id ?>" class="btn btn-sm btn-secondary" data-toggle="tooltip" onclick="return confirm('Are you sure you want to delete this item?');" title="Delete"> -->

                                                 <button onclick="showDeleteModel(<?=$resultvlu->goods_id ?>)" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Delete">
                                                 <i class="si si-trash"></i>
                                                </button> 

                                                     <!-- <i class="si si-trash"></i> -->
                                                 </a> <a href="<?= base_url() ?>goods_details_admin/print/<?= $resultvlu->goods_id ?>" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Print">
                                                     <i class="si si-printer"></i>
                                                 </a>
                                                 <a href="<?= base_url() ?>goods_details_admin/update/<?= $resultvlu->goods_id ?>" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Edit">
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

                                    echo "<li>" . $link . "</li>";
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

 <div id="transferGoodsModel" class="modal fade" role="dialog">
     <div class="modal-dialog modal-lg">
         <!-- Modal content-->
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="text-center">Transfer Goods</h4>
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title"></h4>
             </div>
             <div class="modal-body" id="model">
                <form class="form-horizontal form-label-left ajaxModel" method="post" action="<?= base_url() ?>goods_details_admin/transfer_goods">
                    <div class="row">                
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-select">Transfer From</label>
                                <div>
                                    <select name="transfer_from"  class="form-control"  disabled="true"  />
                                    <?php foreach ($branches as $key => $val) { ?>
                                        <option  <?php  if($current_branch_id == $val->id) { echo "selected"; } ?>  value="<?=$val->id?>"><?=$val->name?> </option>

                                    <?php } ?>
                                    </select>
                                    <input type="hidden" name="transfer_from" value="<?=$current_branch_id ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-select">Transfer To</label>
                                <div>
                                    <select name="transfer_to" class="form-control"/>
                                    <?php foreach ($branches as $key => $val) { ?>
                                        <option value="<?=$val->id?>"><?=$val->name?> -( <?=$val->role?> ) </option>

                                    <?php } ?>
                                    </select> 
                                </div>
                            </div>                              
                        </div>
                    </div>


                    <div class="row">         
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-select">vehicles</label>
                                <div>
                                    <select name="vehicle_id"  class="form-control"   id="vehicle_id" onchange="getVehicleDetails(this)"/>
                                    <option value="">-Select-</option>
                                    <?php foreach ($vehicles as $key => $val) { ?>
                                        <option   value="<?=$val->id?>"><?=$val->vehicle_number?>-<?=$val->vehicle_type?> </option>

                                    <?php } ?>
                                    </select>  
                                </div>
                            </div>
                        </div>  
                        <div class="col-md-6">

                            <div class="form-group" id="vehicle_details">
                                
                            </div>
 
                        </div>
                    </div>

                    <input type="hidden" id="uid" name="id">
                     <input name="sel_goods_id" id="sel_goods_id" type="hidden">
                     <div class="form-group">

                         <br />
                         <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                         <button type="submit" id="transferGoodsSubmit" class="btn btn-success">Submit</button>

                    </div>


                </form>
             </div>
         </div>
     </div>
 </div>



 <div id="addCargosModel" class="modal fade" role="dialog">
     <div class="modal-dialog modal-lg">
         <!-- Modal content-->
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="text-center">Add Cargos</h4>
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title"></h4>
             </div>
             <div class="modal-body" id="model">
                <form class="form-horizontal form-label-left ajaxModel" method="post" action="<?= base_url() ?>trip_sheet/add_good_cargos">
                    <div class="row">                
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-select">Trip Sheets</label>
                                <div>
                                    <select name="trip_sheet_id"  class="form-control"  />
                                    <?php foreach ($trip_sheets as $key => $val) { ?>
                                        <option  value="<?=$val->id?>"><?=$val->trip_sheet_name?> </option>

                                    <?php } ?>
                                    </select>
                                    
                                </div>
                            </div>
                        </div> 
                    </div> 

                    <input type="hidden" id="uid" name="id">
                     <input name="sel_goods_id_cargos" id="sel_goods_id_cargos" type="hidden">
                     <div class="form-group">

                         <br />
                         <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                         <button type="submit" class="btn btn-success">Submit</button>

                    </div>


                </form>
             </div>
         </div>
     </div>
 </div>



 <?php /*

 <div id="confirmReceived" class="modal fade" role="dialog">
     <div class="modal-dialog modal-lg">
         <!-- Modal content-->
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="text-center">Confirm received</h4>
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title"></h4>
             </div>
             <div class="modal-body" id="model">
                <form class="form-horizontal form-label-left ajaxModel" method="post" action="<?= base_url() ?>goods_details/confirm_received_goods">
                   
                    
 
                     <input name="sel_goods_id_received" id="sel_goods_id_received" type="hidden">
                     <div class="form-group">

                         <br />
                         <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                         <button type="submit" class="btn btn-success">Confirm Received Goods</button>

                    </div>


                </form>
             </div>
         </div>
     </div>
 </div> 

*/ ?>


 <div id="asignModel" class="modal fade" role="dialog">
     <div class="modal-dialog modal-lg">
         <!-- Modal content-->
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="text-center">Edit Info</h4>
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title"></h4>
             </div>
             <div class="modal-body" id="model">
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





 <div id="deleteModel" class="modal fade" role="dialog">
     <div class="modal-dialog modal-lg">
         <!-- Modal content-->
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="text-center">Delete</h4>
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title"></h4>
             </div>
             <div class="modal-body" id="model">
                 <form class="form-horizontal form-label-left ajaxModel" method="post" action="<?= base_url() ?>goods_details_admin/update_info">

                
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
                                <button type="submit" class="btn btn-success">Submit</button>
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

 


 <script type="text/javascript">


$(document).ready(function () { 
    const count = 0; 
<?php if(($_GET['serachq']) == 'invoiceno') {?> 
    // $('#inptvalue').focus().select(); 
    $('.editBtn').focus().select(); 

    // alert("ssasa");
    // editBtn
<?php } ?>
   
$("#EditPopup").click(function () {

    var data = $('form#editForm').serialize();  

        $.ajax({
            type:'POST',
            url:'<?php echo base_url() ?>goods_details_admin/update_info', 
            data: data,
            success:function(data){
                  $('#msg').text(data);

                  $('#asignModel').modal('hide'); 
                  window.location.reload();
                    $('#inptvalue').focus().select();

                // $('#selCnt').text('Total Count :'+ data);
                //   $('#vehicle_details').html(data);
                // console.log(data, "sasas");
            }
        }); 
}); 

/*
$("#rewight").click(function () {

    alert("Sasa");
    return false;


});
*/

$('body').on('keydown', '#rewight', function(e) {
        if (e.which == 13) {
            e.preventDefault();
            var data = $('form#editForm').serialize();
                $.ajax({
                    type:'POST',
                    url:'<?php echo base_url() ?>goods_details_admin/update_info', 
                    data: data,
                    success:function(data){
                        $('#msg').text(data);

                        $('#asignModel').modal('hide'); 
                        window.location.reload();
                            $('#inptvalue').focus().select();

                        // $('#selCnt').text('Total Count :'+ data);
                        //   $('#vehicle_details').html(data);
                        // console.log(data, "sasas");
                    }
                }); 

        } 
});

 

    $('body').on('keydown', '.editBtn', function(e) {
        if (e.which == 9) {
            e.preventDefault();
            $('#rewight').focus().select();         
        }
    });

    $("#butt").click(function () {
        $("#trip_no > option").attr("selected",false);
    }); 

});

function resetSelected() {

    $.ajax({
            type:'POST',
            url:'<?php echo base_url() ?>goods_details_admin/reset_checked',
            // data:{'id':id, 'flag': flag},
            success:function(data){
                 location.reload();
            }

        });

}


$('.checkbox-item1').click(function (e) {
    
   var id = $(event.target).attr('id' ) ;
    if (e.target.checked) {
        // count = count+1;
        localStorage.setItem(id,'true');
        var flag = 'true';
    } else {
        // count = count-1;
        var flag = 'false';
        localStorage.setItem(id,'false');
    }
     
    
        $.ajax({
            type:'POST',
            url:'<?php echo base_url() ?>goods_details_admin/update_checked',
            data:{'id':id, 'flag': flag},
            success:function(data){
                $('#selCnt').text('Total Count :'+ data);
                //   $('#vehicle_details').html(data);
                // console.log(data, "sasas");
            }

        });

})




     
$('#allcb').click(function (e) {
       
       $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);

       var checkboxes = $( ':checkbox' );
       var checkedArray = [] ; 
   
    if( this.checked == true){
       $('#selCnt').text('Total Count :'+ $('[type= checkbox]').length);
    }
    else {
       $('#selCnt').text('');
       resetSelected();

    }
 
    $.ajax({
                type:'POST',
                url:'<?php echo base_url() ?>goods_details_admin/update_checked_multipe',
                data:  $('.checkbox-item:checked').serialize(),
                success:function(data){
                    $('#selCnt').text('Total Count :'+ data);
                    
                }

            });

        // $.each($('[type= checkbox]'),function(index,value){ 
        
        //     var id = $(this).attr('id' ) ; 
        //     if( this.checked == true){
        //         localStorage.setItem(id,'true');  
                

        //     } else {
        //         localStorage.setItem(id,'false');

                 
        //     }
        // });      

   });

   var $checkboxes = $('.checkbox-item');
   $('.checkbox-item').change(function(){
   var checkboxesLength = $checkboxes.length;
   var checkedCheckboxesLength = $checkboxes.filter(':checked').length;
   if(checkboxesLength == checkedCheckboxesLength) {
       $('#allcb').prop('checked', true);
   }else{
       $('#allcb').prop('checked', false);
   }
   }); 


    function getVehicleDetails(obj){
        var id = $(obj).val();
        $.ajax({
            type:'POST',
            url:'<?php echo base_url() ?>vehicles/getVehicleDetails',
            data:{'id':id},
            success:function(data){
                  $('#vehicle_details').html(data);
                // console.log(data, "sasas");
            }

        });
 


    }


     function showStatusModel(cargo_id_val, rewight, recieved_pcs, recieved_at_hub, connecting_date,vendor,docket,status,remarks, weight, invoiceno, tracking_no, boxno, goods_status, state,district ) {
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



     function showDeleteModel(goods_id ) {

        let person = prompt("Please enter your password", "");
        if (person == 'Indianlive@2324') {
            window.location = "<?= base_url() ?>goods_details_admin/delete_process/"+goods_id;           
            alert("Deleted successfully");
        }
        else {
            alert("Password incorrect");
        }  

     }

    function transferGoodsModel( ) {       
        var checkValues = $('.checkbox-item:checked').map(function(){
            return $(this).val();
        }).get();
        document.getElementById("sel_goods_id").value = checkValues; 
        $('#transferGoodsModel').modal('show', {
             backdrop: 'true'
         });
    }

  
        //reload page after trasnferring goods

        document.getElementById( 'transferGoodsSubmit').addEventListener('click', (e) => {
        document.getElementById('transferGoodsModel').style.visibility = "hidden";
       
            window.location.reload();
        });


    function addCargosModel( ) {       
        var checkValues = $('.checkbox-item:checked').map(function(){
            return $(this).val();
        }).get();

        // $("#addCargosModel").find("#uid").val(cargo_id_val);

        document.getElementById("sel_goods_id_cargos").value = checkValues; 
        $('#addCargosModel').modal('show', {
             backdrop: 'true'
         });
    }

        


    //     function confirmReceived( ) {
       
    //     var checkValues = $('.checkbox-item:checked').map(function()
    //     {
    //         return $(this).val();
    //     }).get();

    //     document.getElementById("sel_goods_id").value = checkValues;  

    //     $('#transferGoodsModel').modal('show', {
    //             backdrop: 'true'
    //         });

    //    }



        


  
    //     $(function() {
    //      $('#allcb').change(function() {
    //          if ($(this).prop('checked')) {
    //              $('tbody tr td input[type="checkbox"]').each(function() {
    //                  $(this).prop('checked', true);
    //              });
    //          } else {
    //              $('tbody tr td input[type="checkbox"]').each(function() {
    //                  $(this).prop('checked', false);
    //              });
    //          }
    //      });
    //  });



    function deleteSelected(){
        var checkbox_arr = [];
        $('tbody tr td input[type="checkbox"]:checked').each(function() {
             checkbox_arr.push($(this).val());
         });
         if (checkbox_arr.length > 0) {             
                let person = prompt("Please enter your password", "");
                    if (person == '') {                         
                    // if (person == 'Indianlive@2324') {   
                        $.ajax({
                                type:'POST',
                                url:'<?php echo base_url() ?>goods_details_admin/removeGoodsRecords',                                 
                                data: { 'checkbox_arr': checkbox_arr }, 
                                success:function(data){
                                    if (resp.status == 1) {
                                            setTimeout(function() {
                                                location.href = "<?php echo base_url() ?>" + 'goods_details_admin?msg=1';
                                            }, 1000);

                                        } else {
                                            alert(resp.message);
                                        }
                                }
                            });
                        alert("Deleted successfully");
                        location.reload();
                    }
                    else {
                        alert("Password incorrect");
                    }                 
             } else {
             alert('Please select checkbox');
         }

    }


     function actiononselected(type) {
         var checkbox_arr = [];
         // $('input:checkbox[name=checkedbox]:checked').each(function(){
         //     checkbox_arr.push($(this).val());
         // });
         $('tbody tr td input[type="checkbox"]:checked').each(function() {
             // $(this).prop('checked', true);
             checkbox_arr.push($(this).val());
         });
         // alert(checkbox_arr.length)

         if (checkbox_arr.length > 0) {
             //print
             if (type == 1) {
                 location.href = "<?php echo base_url() ?>" + 'goods_details_admin/printall?ids=' + checkbox_arr.join('_');
             } else {

                let person = prompt("Please enter your password", "");
                    if (person == 'Indianlive@2324') {                         
                    
                                $.ajax("<?php echo base_url() ?>" + "goods_details_admin/removeGoodsRecords", {
                                    type: 'POST', // http method
                                    data: {
                                        checkbox_arr: checkbox_arr
                                    }, // data to submit
                                    success: function(data, status, xhr) {
                                        var resp = JSON.parse(data);

                                        if (resp.status == 1) {
                                            setTimeout(function() {
                                                location.href = "<?php echo base_url() ?>" + 'goods_details_admin?msg=1';
                                            }, 1000);

                                        } else {
                                            alert(resp.message);
                                        }
                                     
                                        // $('p').append('status: ' + status + ', data: ' + data);
                                    },
                                    error: function(jqXhr, textStatus, errorMessage) {
                                        alert('Error while sending request.Please try later');
                                        
                                    }
                                });

                               

                        // alert("Deleted successfully");
                        // location.reload();
                    }
                    else {
                        alert("Password incorrect");
                    }                 
             }
         } else {
             alert('Please select checkbox');
         }
     }
 </script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>