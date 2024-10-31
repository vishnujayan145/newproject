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
                                    <div class="">
                                    <div id="table-wrapper">
                                        <div id="table-scroll">
                                        <table id="" class="table align-middle mb-0" style="width:300%">
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

                                        </div>
                                </div>
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





<div id="transferToGoodsDetailModel" class="modal fade" role="dialog">
     <div class="modal-dialog modal-lg">
         <!-- Modal content-->
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="text-center">Transfer Goods</h4>
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title"></h4>
             </div>
             <div class="modal-body" id="model">
               
             <div id="shipment_transfer_msg" style="color:green;font-size:22px;"> </div>

                <form class="form-horizontal form-label-left ajaxModel" method="post" action="<?= base_url() ?>shipment/back_to_shipment">
                    


                    <div class="row">     
                        
                    <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-select">Back to Shipment list From Goods </label>
                                 
                            </div>                              
                        </div> 
                        
                    </div>

                    <input type="hidden" id="uid" name="id">
                     <input name="sel_shipment_id" id="sel_shipment_id" type="hidden">
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
 




<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> 
<script language="javascript" type="text/javascript">
        
     
$('#allcb').click(function (e) {       
    $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
    var checkboxes = $( ':checkbox' );
    var checkedArray = [];   
    if( this.checked == true){
    $('#selCnt').text('Total Count :'+ $('[type= checkbox]').length);
    }
    else {
    $('#selCnt').text('');
    resetSelected();

    } 
});

function transferGoodsModel( ) {
    
    var checkValues = $('.checkbox-item:checked').map(function(){
        return $(this).val();
    }).get();
    document.getElementById("sel_shipment_id").value = checkValues; 

    $('#transferToGoodsDetailModel').modal('show', {
             backdrop: 'true'
         });
}

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

    </script>