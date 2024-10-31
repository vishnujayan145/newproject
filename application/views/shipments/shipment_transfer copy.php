<style>
    body {
  padding : 10px ;
  
}
 

table th, td{
  /*  outline: 1px solid #ccc;
    padding:0.25em 0.5em 0.25em 1em;
    text-indent: -0.5em;
    text-align:center;*/
}
table { 
    outline: 1px solid #ccc;
    border-collapse: separate;
    border-spacing: 2px; 
    /* text-indent: -0.5em; */
}
 
th {
    top :-21px;
    position:sticky;
    background-color: #d5d7ca;
    z-index:999;
    /* font-weight:bold!important; */

} 
 
</style>
 <?php /*
 
 
 */ ?>



<!-- Main Container -->
<main id="main-container" style="">

    <!-- Page Content -->
    <div class="content">
        <!-- Full Table -->
    <div class="block" style="">
        <div class="block-header block-header-default" style="    padding: 0px;">
                <span class="block-title" style="    padding: 0px;">
                    <h2 class="content-heading" style="    padding: 0px;">Shipment Transferred list</h2>
                </span> 
               <!-- <input class="btn btn-alt-primary" type="button" value="Undo Transfer Goods"  onclick="transferGoodsModel();"/> &nbsp; -->
        <!--  <a href="<?= base_url() ?>goods_details/create" class="btn btn-alt-primary"><i class="fa fa-plus mr-2"></i>Add Goods details</a>&nbsp;
                <input class="btn btn-alt-primary"  type="button" value="Add Cargos"  onclick="addCargosModel();"/> &nbsp; 
                <a href="<?= base_url() ?>goods_details/printall" class="btn btn-alt-primary"><i class="si si-printer mr-2"></i>Print all</a>&nbsp;
                <a href="<?= base_url() ?>goods_details/printnew" class="btn btn-alt-primary"><i class="si si-printer mr-2"></i>New Print</a>&nbsp;
                <a href="#" onclick="actiononselected(1)" class="btn btn-alt-primary"><i class="si si-printer mr-2"></i>Print Selected</a>&nbsp;
                <a href="#" onclick="actiononselected(2)" class="btn btn-alt-primary"><i class="si si-trash mr-2"></i>Delete</a> -->         

            </div>
        <div> 
    </div>
    <hr>
    </div>
  
    <div class="block">
        <div class="block-content">  

            <div class="">
                <div id="ermsg"> <?= $this->session->flashdata('msgx'); ?> </div> 

                
                
            <div id="exTab3">	 
                <button onclick="location.href='<?= base_url() ?>shipment/view/<?=$shipment_id?>'"  class="btn btn-primary" type="button">Shipment List</button> 
                

                    <div class="tab-content clearfix">
                        <div class="tab-pane active  goods-details" id="tabs-1"> 
                        <table class="table table-striped table-vcenter ">
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
                                                    <b><input type="checkbox" name="invoice[]"  class="checkbox-item" id="chkBx-<?= $resultvlu->id ?>"  value="<?= $resultvlu->id ?>"
                                                    <?php if($resultvlu->sort_order != NUll) { echo "checked";} ?>
                                                    /></b>
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
                                                <td><b><?= $resultvlu->shipmentname ?></b></td>
                                                <td><b><?= $resultvlu->origin ?></b></td>
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
                                                    <b><?=!empty($resultvlu->sendingdate) ? date('d/m/Y', strtotime($resultvlu->sendingdate)):'-'?></b>
                                                </td>
                                                <td>
                                                    <b><?= !empty($resultvlu->recievingdate) ? date('d/m/Y', strtotime($resultvlu->recievingdate)): '-'?></b>
                                                </td>
                                                <td>
                                                    <b><?= !empty($resultvlu->estimate_delivery_date) ? date('d/m/Y', strtotime($resultvlu->estimate_delivery_date)): '-' ?></b>
                                                </td>

                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <!-- <a href="<?= base_url() ?>goods_details/delete_process/<?= $resultvlu->id ?>" class="btn btn-sm btn-secondary" data-toggle="tooltip" onclick="return confirm('Are you sure you want to delete this item?');" title="Delete"> -->

                                                        <button onclick="showDeleteModel(<?=$resultvlu->id ?>)" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Delete">
                                                        <i class="si si-trash"></i>
                                                    </button> 

                                                            <!-- <i class="si si-trash"></i> -->
                                                        <!-- </a> <a href="<?= base_url() ?>goods_details/print/<?= $resultvlu->id ?>" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Print">
                                                            <i class="si si-printer"></i>
                                                        </a> -->

                                                        <button onclick="location.href='<?= base_url() ?>goods_details/print/<?= $resultvlu->id ?>'"  class="btn btn-sm btn-secondary" type="button" data-toggle="tooltip" title="Print">
                                                                <i class="si si-printer"></i>
                                                        </button> 

                                                        <button onclick="location.href='<?= base_url() ?>goods_details/update/<?= $resultvlu->id ?>'"  class="btn btn-sm btn-secondary" type="button" data-toggle="tooltip" title="Edit">
                                                                <i class="fa fa-pencil"></i>
                                                        </button> 


                                                        <!-- <a href="<?= base_url() ?>goods_details/update/<?= $resultvlu->id ?>" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Edit">
                                                            <i class="fa fa-pencil"></i>
                                                        </a> -->
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
                        <div class="tab-pane" id="tabs-2">
            
                    
                        </div>
                                
                    </div>
            </div>

                        
                            

                                    



                        </div>
                    </div>
                </div>
                <!-- END Full Table -->

            </div>
            <!-- END Page Content -->

</main>
<!-- END Main Container -->




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