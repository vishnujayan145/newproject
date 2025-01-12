<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
     

     <div class="main-content">
         <div class="page-content">
             <div class="container-fluid">
     
                 <!-- start page title -->
                 <div class="row">
                     <div class="col-12">
                         <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                             <h4 class="mb-sm-0 font-size-18"> </h4>
     
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
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Shipment list</h4>
                                <p class=" "  >        <input class="btn btn-primary  btn-sm" type="button" value="Transfer Goods"  onclick="transferGoodsModel();"/> &nbsp; </p>
                                
                                

                                <div class="table-rep-plugin">
                                    <div class="table-responsive mb-0" data-pattern="priority-columns">
                                        <table id="tech-companies-11" class="table table-striped">
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

                                                                <td><?= $key+1?></td>
                                                                <td><?= $resultvlu->name ?></td>
                                                                 
                                                                <td>
                                                                    <?= date('d-m-Y', strtotime($resultvlu->clearence_date)) ?>
                                                                </td> 
                                                                <td>
                                                                    <?= date('d-m-Y', strtotime($resultvlu->customs_cleared_date)) ?>
                                                                </td> 
                                                                <td class="text-center">
 
                                                                
                                                                <div class="btn-group"> 
                                                                    <button onclick="showDeleteModelShipment(<?=$resultvlu->id ?>)" class="btn  btn-outline-danger" data-toggle="tooltip" title="Delete">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>  
                                                                    <button onclick="location.href='<?= base_url() ?>shipment/update/<?= $resultvlu->id ?>'"  class="btn  btn-outline-warning" type="button" data-toggle="tooltip" title="Edit">
                                                                            <i class="fas fa-pencil-alt"></i>
                                                                    </button>  
                                                                    <button onclick="location.href='<?= base_url() ?>shipment/view/<?= $resultvlu->id ?>'"  class="btn  btn-outline-success" type="button" data-toggle="tooltip" title="View">
                                                                            <i class="fa fa-eye"></i>
                                                                    </button> 

                                                                    <button  onclick="customsClearedModel(<?= $resultvlu->id ?>);" class="btn  btn-outline-primary" type="button" data-toggle="tooltip" title="Customs Cleared">
                                                                    <i class="fas fa-check"></i>
                                                                    </button> 
                                                                    
                                                                    
                                                                </div>

                                                                <!-- <input class="btn btn-primary pull-right" style="margin-top:5px; font-size:12px;" type="button" value="Customs Cleared"  onclick="customsClearedModel(<?= $resultvlu->id ?>);"/> &nbsp;

                                                                <i class="fas fa-check"></i> -->
                                                               

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
                        </div>
                        <!-- end card -->
                    </div> <!-- end col -->

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Shipment Transferred List</h4>


                                <div class="table-rep-plugin">
                                    <div class="table-responsive mb-0" data-pattern="priority-columns">
                                        <table id="tech-companies-11" class="table table-striped">
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
                                                            <td><?= $key+1?></td>
                                                            <td><?= $resultvlu->name ?></td>                                                    
                                                            <td>
                                                                <?= date('d-m-Y', strtotime($resultvlu->clearence_date)) ?>
                                                            </td> 
                                                            <td><?= date('d-m-Y', strtotime($resultvlu->customs_cleared_date)) ?> </td> 

                                                            <td class="text-center">  
                                                                <div class="btn-group" role="group" aria-label="Basic outlined example"> 
  
                                                                <button onclick="location.href='<?= base_url() ?>shipment/transfer_list/<?= $resultvlu->id ?>'"  class="btn btn-outline-success" style="font-size:16px;" type="button" data-toggle="tooltip" title="Edit"> <i class="fa fa-eye"></i></button>
                                                                <button   onclick="showDeleteModel(<?=$resultvlu->id ?>)"   class="btn btn-outline-primary" style="font-size:16px;" type="button" data-toggle="tooltip" title="Back to Shipment">
                                                                <i class="mdi mdi-undo-variant"></i></button>
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
                        </div>
                        <!-- end card -->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->  





                 <!-- end row -->
             </div>
         </div>
     </div>
 



   <!-- transferToGoodsDetailModel -->
   <div class="modal fade" id="transferToGoodsDetailModel" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
        <!-- <div class="modal-dialog modal-lg-dialog-top"> -->
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div style="padding:5px;">
                <h4 class="text-primary">Transfer Goods</h4>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                            
                        <div class="row justify-content-center">
                            <div class="col-xl-10">
                            
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
            </div>
        </div>
    </div>
    <!-- end modal -->




   <!-- subscribeModal -->
   <div class="modal fade" id="customsClearedModel" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-top">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div style="padding:5px;">
                <h4 class="text-primary">Add Customs Cleared Date</h4>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                            
                        <div class="row justify-content-center">
                            <div class="col-xl-10">
                            
                            

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
            </div>
        </div>
    </div>
    <!-- end modal -->



 



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
  
    
    alert("Back to Shipment successfully");
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
