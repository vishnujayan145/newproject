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
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Goods Added to Trip sheet</h4>

                       

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <!-- <div class="row"  style="float:right;">                              
                                <div class="col-md-12">
                                    <a href="<?=base_url()?>vehicles/create" class="btn btn-primary">
                                                    <i class="fa fa-plus"></i>Add Vehicle</a>
                                </div>                                
                            </div> --> 


                            <form action="<?= base_url() ?>goods_details/goodsInTripsheet?" method="get" name="myxfrm" enctype="multipart/form-data" onsubmit="return validateForm();">


                            <div class="btn-group" role="group" aria-label="Basic outlined example"> 
                                <button type="button" class="btn btn-outline-primary" onclick="location.href='<?= base_url() ?>goods_details/printall_goodsInTripsheet'" ><i class="mdi mdi-printer "  style="font-size:20px;margin-right:5px;"></i>Print all</button>
                                <button type="button" class="btn btn-outline-primary" onclick="location.href='<?= base_url() ?>goods_details/printnew'" ><i class="mdi mdi-printer "  style="font-size:20px;margin-right:5px;"></i>Print all</button>
                                <button type="button" class="btn btn-outline-primary" onclick="actiononselected(1)"><i class="mdi mdi-printer " style="font-size:20px;margin-right:5px;"></i>Print Selected</button> 
                            </div> 
  



                            <div class="btn-group mt-2"  role="group" aria-label="Basic outlined example">
                                <button type="button" class="btn btn-outline-warning">   <input type="submit" class="form-control" name="export_goods_in_tripsheet" value="Download Goods in Tripsheet"> </button> 
                            </div>


                            <div class="row mt-2">   
                                    <!-- <div class="col-md-2"><label for="example-select">Trip No</label> <input type="button" value="Reset" id="butt"/></div>                                   -->
                                    <div class="col-md-2"><label for="example-select">Trip No</label></div>                                  
                                    <div class="col-md-2"><label for="example-select">Date</label></div>
                                    <div class="col-md-2"><label for="example-select">Filter</label></div>
                                    <div class="col-md-2"><label for="example-select">Value</label></div>
                                </div>

                                <div class="row">                                 

                                 
                                    <div class="col-md-2">                                   
                                    <?php /* <select class="form-control select2" id="trip_no" size="5"  name="trip_no[]" multiple>                      
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



                                
                            </form>
                               
                           
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
                                                    <th style="width=250px">Sender Address</th>
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
                                                    <th>Recciev.Date</th>`



                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                             
                                             if ($result != null) {
                                                foreach ($result as $key => $resultvlu) {                                         
                                                        $params = "";
                                                        $params .=$resultvlu->id;
                                                        ($resultvlu->rewight!="") ? $params .= ",".$resultvlu->rewight : $params .= ","."undefined";
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
                                                         <?php // if(  strtolower($goods_status) != 'short'  &&  strtolower($goods_status) != 'hold' ) { 
                                                         ?>
                                                            <b><input type="checkbox" name="invoice[]"  class="checkbox-item" id="chkBx-<?= $resultvlu->id ?>"  value="<?= $resultvlu->id ?>" /></b> 
                                                        <?php
                                                         // }
                                                         ?>
                                                      
                                                        
                                                     </td>  
                                                     <td><?= $key + 1 ?>  </td>
                                                     <td><?= $resultvlu->transfer_status??'-' ?></td>
                                                     <td>
                                                        <?php /*
                                                         <button onclick="showStatusModel(<?=$params ?>)" class="btn btn-sm btn-success" data-toggle="tooltip" title="Edit this row">
                                                             <i class="fa fa-pencil"></i>
                                                         </button>*/ ?>
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
                                                     <td><?= $resultvlu->sender_address  ?></td>
                                                     <td><?= $resultvlu->reciever_address ?></td>
            
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
            
              
                                                 </tr>
                                         <?php
                                                }
                                            }

                                            ?>  
                                            </tbody>
                                        </table>

                                        <div align="right">
                                       
                                        <p><?php echo $links; ?></p>
 
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
  
         $.each(localStorage, function(key, value){ 
             if( value == 'true') { 
                 $(document).find('#'+key).attr("checked", true);
             } 
         });
 
 
 $("#butt").click(function () {
 $("#trip_no > option").attr("selected",false);
 }); 
 
 });
 
 
      
 $('#allcb').click(function (e) {
        
    alert("sasa");
        $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
 
        var checkboxes = $( ':checkbox' );
        var checkedArray = [] ; 
         $.each($('[type= checkbox]'),function(index,value){ 
             var id = $(this).attr('id' ) ; 
             if( this.checked == true){
                 localStorage.setItem(id,'true');   
             } else {
                 localStorage.setItem(id,'false');
             }
         });      
 
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
 
 
     function transferGoodsModel( ) {       
         var checkValues = $('.checkbox-item:checked').map(function(){
             return $(this).val();
         }).get();
         document.getElementById("sel_goods_id").value = checkValues; 
         $('#transferGoodsModel').modal('show', {
              backdrop: 'true'
          });
     }
 
 
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
                  location.href = "<?php echo base_url() ?>" + 'goods_details/printall?ids=' + checkbox_arr.join('_');
              } else {
                  if (confirm('Are You Sure Want to Remove Selected Records ?') == true) {
                      $.ajax("<?php echo base_url() ?>" + "goods_details/removeGoodsRecords", {
                          type: 'POST', // http method
                          data: {
                              checkbox_arr: checkbox_arr
                          }, // data to submit
                          success: function(data, status, xhr) {
                              var resp = JSON.parse(data);
 
                              if (resp.status == 1) {
                                  setTimeout(function() {
                                      location.href = "<?php echo base_url() ?>" + 'goods_details?msg=1';
                                  }, 1000);
 
                              } else {
                                  alert(resp.message);
                              }
                              // $('p').append('status: ' + status + ', data: ' + data);
                          },
                          error: function(jqXhr, textStatus, errorMessage) {
                              alert('Error while sending request.Please try later');
                              // $('p').append('Error' + errorMessage);
                          }
                      });
 
                      // location.href = "<?php echo base_url() ?>"+'goods_details?isremove=1&ids='+checkbox_arr.join('_');
                  }
              }
          } else {
              alert('Please select checkbox');
          }
      }
  </script>