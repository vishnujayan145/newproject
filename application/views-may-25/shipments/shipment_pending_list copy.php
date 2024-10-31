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
    </div> 
        <div class="block" style="">
            <div class="block-header block-header-default" style="    padding: 0px;">   
            </div>
        <div>   

         <div class="block">
            <div class="block-content goods-details">
                <div class="">
                    <div id="ermsg"> <?php //$this->session->flashdata('msgx'); ?> </div>                  
        <div class="row">
            <div class="col-6 col-md-6 " style="overflow:auto"> 
            <h2 class="content-heading" style="    padding: 0px;">Shipment Pending list</h2> 
                    <table class="">
                        <thead>
                            <tr> 
                                <th>Si</th>                                
                                <th>Shipment Name</th>
                                <th>Date</th> 
                                <th class="text-center" style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                         
                            if ($goods_transfer_list != null) {
                                foreach ($goods_transfer_list as $key => $resultvlu) {  
                                    $bgcolor ='';
                                    if(  isset($goods_transfer_list_cnt[$resultvlu->id])  == 0) {                                         
                                        $bgcolor ='background-color:red;color:#fff;';
                                    }
                                   
                                    ?>   
                                    <tr style="<?=$bgcolor?>">
                                        <td><?=$key+1?></td>                                      
                                        <td><b><?= $resultvlu->shipment_name ?></b></td>                                       
                                        <td>
                                            <b><?= date('d-m-Y', strtotime($resultvlu->created_at)) ?></b>
                                        </td> 
                                        <td class="text-center">
                                        <div class="btn-group">                                            
                                            <button onclick="location.href='<?= base_url() ?>goods_details/listTransferGoodsById/<?= $resultvlu->id ?>'"  class="btn btn-sm btn-secondary mr-5" type="button" data-toggle="tooltip" title="Edit">
                                                    <i class="fa fa-eye"></i>View
                                            </button>



                                            <button onclick="backToGoodsGoods(<?= $resultvlu->id ?>);"  class="btn btn-sm btn-secondary ml-5" type="button" data-toggle="tooltip" title="Edit">
                                                    <i class=""></i>Return
                                            </button> 
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
                        
                        
                        </ul>
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

                <form class="form-horizontal form-label-left ajaxModel" method="post" action="<?= base_url() ?>shipment/transfer_to_goods_details">
                    <div class="row">                
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-select">Transfer From </label>
                                <div>
                                    <select name="transfer_from"  class="form-control"  disabled="true"  />
                                    <?php foreach ($branches as $key => $val) { ?>
                                        <option  <?php  if($current_branch_id == $val->id) { echo "selected"; } ?>  value="<?=$val->id?>"><?=$val->name?> </option>

                                    <?php } ?>
                                    </select>
                                    <input type="hidden" name="transfer_from" value="<?=$current_branch_id ?>" />
                                    <input type="hidden" name="transfer_to" value="<?=$current_branch_id ?>" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-select">Transfer Date</label>
                                <div>
                                    <input type="date" name="transfer_date" id="transfer_date" class="form-control" value="<?=date('Y-m-d')?>"/>
                                </div>
                            </div>                              
                        </div>
 
                    </div>


                    <div class="row">     

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




<div id="customsClearedModel" class="modal fade" role="dialog">
     <div class="modal-dialog modal-md">
         <!-- Modal content-->
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="text-center">Add Customs Cleared Date</h4>
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title"></h4>
             </div>
             <div class="modal-body" id="model">
               
             <div id="shipment_transfer_msg" style="color:green;font-size:22px;"> </div>

                <form class="form-horizontal form-label-left ajaxModel" method="post" action="<?= base_url() ?>shipment/update_customs_cleared_date">
                    <div class="row">    

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-select">Date</label>
                                <div>
                                    <input type="date" name="customs_cleared_date" id="customs_cleared_date" class="form-control" value="<?=date('Y-m-d')?>"/>
                                </div>
                            </div>                              
                        </div>
 
                    </div>


                    <div class="row">     

                    </div>

                    <input type="hidden" id="uid" name="id">
                     <input name="shipment_id" id="shipment_id" type="hidden">
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



 <div id="backToGoodsGoodsModel" class="modal fade" role="dialog">
     <div class="modal-dialog modal-lg">
         <!-- Modal content-->
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="text-center">Confirm Not Transfer </h4>
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title"></h4>
             </div>
             <div class="modal-body" id="model">
                <form class="form-horizontal form-label-left ajaxModel" method="post" action="<?= base_url() ?>goods_details/confirm_back_to_goods">  
 
                     <input name="transfer_id" id="transfer_id" type="hidden" value=""> 

                     <div class="form-group">

                         <br />
                         <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                         <button type="submit" class="btn btn-success">Confirm</button>

                    </div>


                </form>
             </div>
         </div>
     </div>
 </div> 




 



<script type="text/javascript">
    $(document).ready(function () { 

    });
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
        
     
$('#allcb').click(function (e) {       
    $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
    var checkboxes = $( ':checkbox' );
    var checkedArray = [];   
    if( this.checked == true){
    // $('#selCnt').text('Total Count :'+ $('[type= checkbox]').length);
    }
    else {
    $('#selCnt').text('');
    resetSelected();

    } 
}); 
 
function backToGoodsGoods(id) {    
      
    document.getElementById("transfer_id").value = id; 
    $('#backToGoodsGoodsModel').modal('show', {
            backdrop: 'true'
    });

}



function transferGoodsModel( ) {
    
    var checkValues = $('.checkbox-item:checked').map(function(){
        return $(this).val();
    }).get();
    document.getElementById("sel_shipment_id").value = checkValues; 
    $('#transferToGoodsDetailModel').modal('show', {
             backdrop: 'true'
         });
}

function customsClearedModel( id ) {    
    var id = id;    
    document.getElementById("shipment_id").value = id; 
    $('#customsClearedModel').modal('show', {
             backdrop: 'true'
         });
}




// $('#trgds').click(function (e) {       
//     $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
//     var checkboxes = $( ':checkbox' );
//     var checkedArray = [];   
//     if( this.checked == true){
//     // $('#selCnt').text('Total Count :'+ $('[type= checkbox]').length);
//     }
//     else {
//     $('#selCnt').text('');
//     resetSelected();

//     } 
// });





</script>