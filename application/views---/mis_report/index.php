<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Export MIS Report</h4>

                         

                    </div>
                </div>
            </div>
            <!-- end page title -->

           

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">


                        <form action="<?=base_url()?>mis_report/export_post" method="post" name="myxfrm">
                                            <div id="ermsg"> <?= $this->session->flashdata('msgx'); ?>  </div>
                                            <div class="form-group mb-4" id="">
                                                <select name="report_type" id="report_type"  class="form-control" >
                                                    <option value="">--- Select ---</option>
                                                    <option value="shipment">Shipment Name</option>
                                                    <option value="cargocompany">Cargo Company</option>
                                                </select>
                                            </div>

                                            <div class="form-group mb-4" id="shipment">
                                                <label for="example-select">Select Shipment name</label>
                                                <div>
                                                    <select class="form-control select2" name="shipmentname" id="shipmentname">
                                                        <option value="">--Select--</option>
                                                        <?php 
                                                        foreach($shipments as $k => $shipment){ 
                                                        if($k!=0){
                                                        ?>
                                                        <option value="<?=$shipment->shipmentname?>"><?=$shipment->shipmentname?></option>
                                                        <?php } } ?>
                                                    </select>
                                                </div>
                                            </div>


                                            <div id="company">


                                            <div class="row mb-4"> 
                                                    <div class="col-md-2">                                                       
                                                        <div class="form-group">
                                                            <label for="example-select">From Date</label>
                                                            <div>
                                                            <input type="date" name="from"  id="from" class="form-control"/>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="example-select">To Date</label>
                                                            <div>
                                                            <input type="date" name="to" id="to" class="form-control"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>

                                               

                                                <div class="form-group mb-4">
                                                    <label for="example-select">Select Cargo Company</label>
                                                    <div>
                                                    <select name="cargo_company" id="cargo_company"  class="form-control select2"> 
                                                        <option value="">--Select--</option>
                                                        <?php foreach($cargos_arr as $cargo) { ?>
                                                            <option value="<?=$cargo->cargo_name?>"> <?=$cargo->cargo_name?> </option>                                
                                                        <?php } ?>
                                                    </select>
                                                    </div>
                                                </div>
                                                <span class="error"><?php echo form_error('name'); ?></span>
                                            </div>           
                                                  
                                
                                        <div class="form-group" id="export">
                                            <a href="<?=base_url()?>goods_details" class="btn btn-primary">Back</a> &nbsp;
                                            <button type="button"  onclick="getMisReport()" class="btn btn-success">Export</button>
                                        </div>
                                    </form>


 

                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
    </div>
</div>



<script>

$(document).ready(function() {
    $('.select2"').select2();
});

        $(document).ready(function(){
        
                
            $("div#shipment").hide();
            $("div#company").hide();
            $("div#export").hide();

            
                $('#report_type').on('change', function(){
                    var demovalue = $("#report_type").val(); 
                    if(demovalue == 'shipment'){
                        $("div#company").hide();
                        $("div#shipment").show(); 
                        $("div#export").show();
                        $('.select2"').select2();

                    }
                    else if(demovalue == 'cargocompany'){
                        $("div#company").show();
                        $("div#shipment").hide();
                        $("div#export").show();
                        $('.select2"').select2();

                    }
                });
            });



            var loadFile = function(event) {
            var reader = new FileReader();
            reader.onload = function(){
            var output = document.getElementById('output');
            output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
            };


          

function getMisReport(){
  

   var cargo_company = $('#cargo_company').val(); 
   var from =  $('#from').val(); 
   var to =  $('#to').val(); 
   var report_type =  $('#report_type').val();   
   var shipmentname =   $('#shipmentname').val();  


    $.ajax({
     
        type:'GET',
        headers: {
            'Access-Control-Allow-Origin': '*',
            'Content-Type':'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        },
      
        url:'https://misreport.indianlivecargo.com/api/export',
        data:{'cargo_company':cargo_company, 'from':from, 'to':to , 'report_type':report_type , 'shipmentname':shipmentname}, 
        dataType: 'html',        
        cache: true,
        // contentType: "application/application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
      
        crossDomain: true,
        xhrFields:{
            responseType: 'blob'
        },
        success:function(result){
                // $('#vehicle_details').html(data); 

          
            window.open('https://misreport.indianlivecargo.com/storage/mis_report.xlsx','_blank' );

        // const blob = new Blob([result], {type: 'application/application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'});
        // const downloadUrl = URL.createObjectURL(blob);
        // const a = document.createElement("a");
        // a.href = downloadUrl;
        // a.download = "file.xls";
        // document.body.appendChild(a);
        // a.click();


       
                
            // var blob = result;
            // var downloadUrl = URL.createObjectURL('http://127.0.0.1:8000/storage/users.xlsx');
            // var a = document.createElement("a");
            // a.href = downloadUrl;
            // a.download = "users.xlsx";
            // document.body.appendChild(a);
            // a.click();
 
        }
 
  

    });



} 
</script>