<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Goods Not Delivered</h4>

                       

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                             
                               
                           
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
                                                <th>Sl No</th>
                                                <th>Goods id</th>
                                                <th>trip no</th>
                                                <th>tracking no</th>
                                                <th>invoice no</th>
                                                <th>estimate arrival date</th> 



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