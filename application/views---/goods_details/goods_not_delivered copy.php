<style>
table th, td{
    outline: 1px solid #ccc;
    padding:0.25em 0.5em 0.25em 1em;
    text-indent: -0.5em;
}
th {
    top :-21px;
    position:sticky;
    background-color: #d5d7ca;
    font-weight:bold!important;
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
                     <h2 class="content-heading" style="    padding: 0px;">Goods Added to Trip sheet</h2>
                 </span>
               
                 <!-- <a href="<?= base_url() ?>goods_details/printall_goodsInTripsheet" class="btn btn-alt-primary"><i class="si si-printer mr-2"></i>Print all</a>&nbsp;
                 <a href="<?= base_url() ?>goods_details/printnew" class="btn btn-alt-primary"><i class="si si-printer mr-2"></i>New Print</a>&nbsp;
                 <a href="#" onclick="actiononselected(1)" class="btn btn-alt-primary"><i class="si si-printer mr-2"></i>Print Selected</a>&nbsp; -->
               
              
             </div>
        <div>


                  <?php 
                            //   print_r( $result ); die;

                ?>
                
             </div>
             <hr>
         </div>


         <div class="block">
             <div class="block-content goods-details">
                 <div class="">
                     <div id="ermsg"> <?= $this->session->flashdata('msgx'); ?> </div> 

                     <table class="table table-striped table-vcenter">
                         <thead>
                             <tr>
                             
                                 <th>Sl No</th>
                                 <th>Goods id</th>
                                 <th>trip no</th>
                                 <th>tracking no</th>
                                 <th>invoice no</th>
                                 <th>estimate arrival date</th> 
                                 <!-- <th class="text-center" style="width: 100px;">Actions</th> -->
                             </tr>
                         </thead>
                         <tbody>
                        <?php 
                         foreach ($result as $key => $resultvlu) {    
                            $key = $key+1;
                        ?>
                            <tr>
                                <td><?=$key?></td>
                                <td> <?=$resultvlu->goods_id ?></td>
                                <td> <?=$resultvlu->trip_no ?></td>
                                <td> <?=$resultvlu->tracking_no ?></td>
                                <td> <?=$resultvlu->invoiceno ?></td>

                                
                            <td> <?=$resultvlu->trip_sheet_cargos_estimate_arrival_date ?></td> </tr>
                        
                        <?php 
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
                            </ul>
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
                <form class="form-horizontal form-label-left ajaxModel" method="post" action="<?= base_url() ?>goods_details/transfer_goods">
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
                         <button type="submit" class="btn btn-success">Submit</button>

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
                 <form class="form-horizontal form-label-left ajaxModel" method="post" action="<?= base_url() ?>goods_details/update_info">

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


$('.checkbox-item').click(function (e) {
//    var id = $(event.target).attr('id' ) ;
//     if (e.target.checked) {
//         localStorage.setItem(id,'true');
//         var flag = 'true';
//     } else {
//         var flag = 'false';
//         localStorage.setItem(id,'false');
//     }
 
        // $.ajax({
        //     type:'POST',
        //     url:'<?php echo base_url() ?>goods_details/update_checked',
        //     data:{'id':id, 'flag': flag},
        //     success:function(data){
        //         //   $('#vehicle_details').html(data);
        //         // console.log(data, "sasas");
        //     }

        // });

})

$(document).ready(function () { 

    <?php if(($_GET['serachq']) == 'invoiceno') {?>
      
        $('#inptvalue').focus().select();
        
<?php } ?>
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