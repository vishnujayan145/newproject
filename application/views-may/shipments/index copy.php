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
            <input class="btn btn-alt-primary pull-right" type="button" value="Transfer Goods"  onclick="transferGoodsModel();"/> &nbsp;
            <h2 class="content-heading" style="    padding: 0px;">Shipment list</h2> 
                    <table class="">
                        <thead>
                            <tr> 
                                <th>
                                    <!-- <input type="checkbox" id="allcb" name="allcb" /> -->
                                </th> 
                                <th>Sl No</th>
                                <th>Shipment Name</th>
                                <th>Clearence Date</th> 
                                <th>Customs Cleared Date</th>

                                <th class="text-center" style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result != null) {
                                foreach ($result as $key => $resultvlu) {                                         
                                    ?>   
                                    <tr  <?php if(  $resultvlu->customs_cleared_date != NULL) { ?>  style="background-color:#7eebff" <?php } ?>>
                                        <td>    
                                        <?php if(  $resultvlu->customs_cleared_date != NULL) { ?>                                              
                                        <input type="checkbox" name="invoice[]"  class="checkbox-item" id="chkBx-<?= $resultvlu->id ?>"  value="<?= $resultvlu->id ?>"/>
                                        <?php } ?>
                                        </td>

                                        <td><b><?= $key+1?></b></td>
                                        <td><b><?= $resultvlu->name ?></b></td>
                                        <!-- <td style="text-align:center">
                                            <img src="<?= base_url() ?>assets/uploads/headers/<?=get_cargo_company_header_image($resultvlu->cargo_id)?>" style="width:200px; margin-right: auto;">                                           
                                        </td> -->
                                        <td>
                                            <b><?= date('d-m-Y', strtotime($resultvlu->clearence_date)) ?></b>
                                        </td> 
                                        <td>
                                            <b><?= date('d-m-Y', strtotime($resultvlu->customs_cleared_date)) ?></b>
                                        </td> 
                                        <td class="text-center">
                                        <div class="btn-group">
                                            <button onclick="showDeleteModelShipment(<?=$resultvlu->id ?>)" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Delete">
                                                <i class="si si-trash"></i>
                                            </button>  
                                            <button onclick="location.href='<?= base_url() ?>shipment/update/<?= $resultvlu->id ?>'"  class="btn btn-sm btn-secondary" type="button" data-toggle="tooltip" title="Edit">
                                                    <i class="fa fa-pencil"></i>
                                            </button> 
                                            
                                            <button onclick="location.href='<?= base_url() ?>shipment/view/<?= $resultvlu->id ?>'"  class="btn btn-sm btn-secondary" type="button" data-toggle="tooltip" title="Edit">
                                                    <i class="fa fa-eye"></i>View
                                            </button> 

                                            <input class="btn btn-alt-primary pull-right" type="button" value="Customs Cleared"  onclick="customsClearedModel(<?= $resultvlu->id ?>);"/> &nbsp;
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
                            } 
                        ?>
                        </ul>
                </div> 
        </div>

 
    <div class="col-6 col-md-6" style="overflow:auto">   
        <h2 class="content-heading" style="    padding: 0px;">Shipment Transferred List</h2>  
            <table class="">
                <thead>
                    <tr>                        
                        <th>Sl No</th>
                        <th>Shipment Name</th>
                        <th>Clearence Date</th> 
                        <th>Customs Cleared Date</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($transfer_shipment != null) {
                        foreach ($transfer_shipment as $key => $resultvlu) {                                         
                            ?>   
                                
                                <tr>
                                <td><b><?= $key+1?></b></td>
                                <td><b><?= $resultvlu->name ?></b></td>
                                <!-- <td style="text-align:center">  
                                    <img src="<?= base_url() ?>assets/uploads/headers/<?=get_cargo_company_header_image($resultvlu->cargo_id)?>" style="width:200px; margin-right: auto;">   
                               
                                </td> -->
                                <td>
                                    <b><?= date('d-m-Y', strtotime($resultvlu->clearence_date)) ?></b>
                                </td> 
                                <td>
                                            <b><?= date('d-m-Y', strtotime($resultvlu->customs_cleared_date)) ?></b>
                                        </td> 
                                <td class="text-center">
                                <div class="btn-group"> 
                                    <button onclick="location.href='<?= base_url() ?>shipment/transfer_list/<?= $resultvlu->id ?>'"  class="btn btn-sm btn-secondary" type="button" data-toggle="tooltip" title="Edit">
                                            <i class="fa fa-eye"></i>View
                                    </button>   
                                    </div> 
                                    <div class="mt-5">
                                    <a href="#"   onclick="showDeleteModel(<?=$resultvlu->id ?>)"  type="button" class="btn btn-primary  btn-xs" >Back to Shipment</a>
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
                            } 
                        ?>
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
                                <label for="example-select">Transfer From</label>
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


 
function showDeleteModel(goods_id ) {

let person = prompt("Please enter your password", "");
if (person == 'Indianlive@2324') { 
    window.location = "<?= base_url() ?>shipment/back_to_shipment/"+goods_id;      
  
    
    alert("Deleted successfully");
}
else {
    alert("Password incorrect");
}  

}



function showDeleteModelShipment(goods_id ) {
 

let person = prompt("Please enter your password", "");
if (person == 'Indianlive@2324') { 
    window.location = "<?= base_url() ?>shipment/delete_process/"+goods_id;      
  
    
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

  


</script>