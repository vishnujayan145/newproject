<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

 
  <link href="https://raw.githack.com/ttskch/select2-bootstrap4-theme/master/dist/select2-bootstrap4.css" rel="stylesheet">
 



  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

 



<style>
    #table-wrapper {
        position:relative;
      }
      #table-scroll {
        height:450px;
        overflow:auto;  
        margin-top:20px;
      }
      #table-wrapper table {
        width:100%;
      
      }
      #table-wrapper table * {
        /* background:yellow; */
        color:black;
      }
      #table-wrapper table thead th .text {
        position:absolute;   
        top:-20px;
        z-index:2;
         
      }

      th {
        z-index:999;
        top :0px;
        position:sticky;
        background-color:  #d5d7ca !important;
        /* font-weight:bold!important; */
    } 
      </style>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Goods Details</h4>   <h3><?php if(isset($branch_name)) { echo $branch_name ; } ?></h3>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                <li class="breadcrumb-item active">Form Elements</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->  
            

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">                        
                            

                            
                            <form action="<?= base_url() ?>goods_details_admin/index?" method="get" name="myxfrm" enctype="multipart/form-data" onsubmit="return validateForm();">

                            <div class="btn-group" role="group" aria-label="Basic outlined example"> 

                                <button type="button" class="btn btn-outline-primary" onclick="location.href='<?= base_url() ?>goods_details_admin/printall'" ><i class="mdi mdi-printer "  style="font-size:20px;margin-right:5px;"></i>Print all</button>
                                <button type="button" class="btn btn-outline-primary" onclick="location.href='<?= base_url() ?>goods_details_admin/printnew'" ><i class="mdi mdi-printer "  style="font-size:20px;margin-right:5px;"></i>New Print</button>
                                <button type="button" class="btn btn-outline-primary" onclick="actiononselected(1)"><i class="mdi mdi-printer " style="font-size:20px;margin-right:5px;"></i>Print Selected</button>
                                <button type="button" class="btn btn-outline-primary" onclick="deleteSelected"><i class="mdi mdi-trash-can-outline " style="font-size:20px;margin-right:5px;"></i>Delete</button>  

                            </div> 

                            <div class="btn-group mt-2"  role="group" aria-label="Basic outlined example">
                                <button type="button" class="btn btn-outline-warning"><input type="submit" class="form-control" name="download_to_import" value="Download"></button>
                                <button type="button" class="btn btn-outline-warning" ><input type="submit" class="form-control" name="download_loading" value="Download Loading List"></button>
                                <button type="button" class="btn btn-outline-warning" > <input type="submit" class="form-control" name="download_sorting" value="Download Sorting List"></button>
                                <button type="button" class="btn btn-outline-warning" > <input type="submit" class="form-control" name="download_ogm" value="Download OGM"></button> 
                            </div>

                                <div class="row mt-2">   
                                <div class="col-md-2"><label for="example-select">Branch Name</label></div>
                                    <div class="col-md-2"><label for="example-select">Trip No</label></div>                                  
                                    <div class="col-md-1"><label for="example-select">Date</label></div>
                                    <div class="col-md-1"><label for="example-select">Filter</label></div>
                                    <div class="col-md-2"><label for="example-select">Value</label></div>
                                </div>

                                <div class="row">                                 

                                    <div class="col-md-2">                                   
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

                                    <div class="col-md-2"> 
                                        <?php /*                                  
                                    <select class="form-control select2" id="trip_no" size="5"  name="trip_no[]" multiple>                      
                                        <?php foreach($trip_no_arr as $trip_no) {  ?>
                                            <option   <?php if(!empty($_GET['trip_no'])) { if (  in_array($trip_no->trip_no , $_GET['trip_no']) ) {
                                                                                    echo 'selected="true"';
                                                                                } }  ?>  value="<?=$trip_no->trip_no?>"><?=$trip_no->trip_no?></option> 
                                                
                                        <?php } ?>
                                        </select>  */ ?>
                                        <select multiple placeholder="Choose trip no"  id="trip_no"  name="trip_no[]" data-allow-clear="1">
                                        <?php foreach($trip_no_arr as $trip_no) {  ?>
                                                <option   <?php if(!empty($_GET['trip_no'])) { if (  in_array($trip_no->trip_no , $_GET['trip_no']) ) {  echo 'selected="true"';  } }  ?>  value="<?=$trip_no->trip_no?>"><?=$trip_no->trip_no?></option> 

                                        <?php } ?>
                                    </select>   


                                    </div> 



                               
                                    <div class="col-md-1">                                   
                                        <input type="date" class="form-control" name="date" placeholder="date" value="<?php if (isset($_GET['date'])) {  echo $_GET['date'];  } ?>">
                                    </div>  
                                    <div class="col-md-1">                                   
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

                        <div id="selCnt" style="font-weight:bold"><?php if(isset($total_sel_cnt)) {
                                echo "<h4>Total Count : ". $total_sel_cnt;} ?></h4>
                            </div> 
<!-- 
                            <h4 class="card-title">Textual inputs</h4>
                            <p class="card-title-desc">Here are examples of <code>.form-control</code> applied to
                                each
                                textual HTML5 <code>&lt;input&gt;</code> <code>type</code>.</p> -->




                                <div class="table-rep-plugin">
                                    <!-- <div class="table-responsive mb-0" data-pattern="priority-columns"> -->
                                    <div class="table-responsive mb-0">

                                    
                                    <div id="table-wrapper">
                                        <div id="table-scroll">
                                        <!-- <table id="tech-companies-1" class="table align-middle mb-0"> -->
                                        <table id="" class="table align-middle mb-0" style="width:300%">

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
                                                         <tr style="font-size: 1rem; --bs-table-bg:<?=$color?>"  >
                                                         <td> 
                                                              <?php
                                                                if(  strtolower($goods_status) != 'short'  &&  strtolower($goods_status) != 'hold' ) { 
                                                                 ?>
                                                                    <input type="checkbox" name="invoice[]"  class="checkbox-item" id="chkBx-<?= $resultvlu->goods_id ?>"  value="<?= $resultvlu->goods_id ?>"
                                                                    <?php if($resultvlu->sort_order != NUll) { echo "checked";} ?>
                                                                    /> 
                                                                <?php
                                                                  }  
                                                                 ?>
                                                                
                                                             </td>  
                                                             
                                                             <td><?= $key + 1 ?></td>
                                                             <td><?= $resultvlu->sort_order ?></td>
                                                             <td><?= $resultvlu->transfer_status??'-' ?></td>
                                                             <td>
                                                                 <button onclick="showStatusModel(<?=$params ?>)" class="btn btn-sm btn-success editBtn" data-toggle="tooltip" title="Edit this row">
                                                                     <i class="fas fa-pencil-alt"></i>
                                                                 </button>
                                                                 <?= $resultvlu->company ?>
                                                             </td>
                                                             <td><?= $resultvlu->shipmentname ?></td>
                                                             <td><?= $resultvlu->origin ?></td>
                                                             <td><?= $resultvlu->branch_name ?></td>
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
                                                                 <?= $resultvlu->sendingdate ?>
                                                             </td>
                                                             <td>
                                                                 <?= $resultvlu->recievingdate ?>
                                                             </td>
                    

                                                             <td class="text-center">  
                                                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                                    <button type="button" class="btn btn-outline-secondary"  onclick="showDeleteModel(<?=$resultvlu->id ?>)"  data-toggle="tooltip" title="Delete" ><i class="mdi mdi-trash-can-outline"  style="font-size: 22px"></i></button> 
                                                                    <button type="button" class="btn btn-outline-primary"  data-toggle="tooltip" title="POD" onclick="location.href='<?= base_url() ?>goods_details_admin/print_pod/<?= $resultvlu->id ?>'" > <i class="mdi mdi-printer"  style="font-size: 22px"></i>  </button>
                                                                    <button type="button" class="btn btn-outline-danger" data-toggle="tooltip" title="Print" onclick="location.href='<?= base_url() ?>goods_details_admin/print/<?= $resultvlu->id ?>'" > <i class="mdi mdi-printer"  style="font-size: 22px"></i>  </button>
                                                                    <button type="button" class="btn btn-outline-secondary" onclick="location.href='<?= base_url() ?>goods_details_admin/update/<?= $resultvlu->id ?>'" >  <i class="fas fa-pencil-alt"  style="font-size: 22px"></i> </button>  
                                                                </div>
                                                            </td> 
                                                             
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



 

 




    <?php /*

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
               
             </div>
         </div>
     </div>
 </div>




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

 




   <!-- changeStatusModel -->
   <div class="modal fade" id="changeStatusModel" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div style="padding:5px; text-align:center;"">
                <h4 class="text-primary">Change Status</h4>
                </div>
                <div class="modal-body">
                    <div class=" mb-4">
                            
                        <div class="row justify-content-center">
                            <div class="col-xl-12">                             
                            <div id="msg" style="color:green;font-size:22px;"> </div>
                                <form class="form-horizontal form-label-left ajaxModel" name="change_status_form" id="change_status_form" method="post" action="#">
                                    <div class="row">
                                        <input type="hidden" id="uid" name="id">
                                        <div class="col-md-6">
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
                                            <div class="form-group">
                                                <label for="example-select">Remarks</label>
                                                <div>
                                                    <input type="text" class="form-control" name="remarks" id="remarks">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                            <br />
                                            <button type="button" id="ChangeStatusPopup" class="btn btn-success">Submit</button>
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                                        </div>
                                        </div>
                                        <div class="col-md-6">  
                                        
                                        </div>
                                    </div>

                                    <input name="cargo_id_sel" id="cargo_id_sel" type="hidden">
                                    <input name="redirectURL" id="redirectURL" type="hidden" value="">                                  
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal -->



 



   <!-- deleteModel -->
   <div class="modal fade" id="deleteModel" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div style="padding:5px; text-align:center;"">
                <h4 class="text-primary">Delete</h4>
                </div>
                <div class="modal-body">
                    <div class=" mb-4">
                            
                        <div class="row justify-content-center">
                            <div class="col-xl-12">                             
                            <div id="msg" style="color:green;font-size:22px;"> </div>
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



$(document).ready(function () { 
    const count = 0; 
 
   
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