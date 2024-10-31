<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Export View MIS Report</h4>

                         

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




                                <?php  
                                        $limit= 1000;
                                        $loop =  (int)($total_row/$limit);                                    
                                        $offset = 0; 
                                        for($i = 1 ; $i<= $loop+1; $i ++) {

                                        ?> 
                                            <form action="<?=base_url()?>mis_report/export_view" method="post" name="myxfrm">
                                            <div class="row"> 
                                                    <div class="col-md-2">                                                       
                                                        <div class="form-group">
                                                        <input type="hidden" name="offset" value="<?=$offset?>" />
                                                        <input type="hidden" name="limit" value="<?=$limit?>" />
                                                        <input type="hidden" name="condition" value="<?=$condition?>" />
                                                        <input type="submit" name="Page-$i" value="Page-<?=$i?>" class="form-control" />
                                                        </div> 
                                                    </div> 
                                            </div>  
                                            </form>
                                        <?php
                                         $offset =  $offset +$limit;
                                    }?>

 

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


          



    </script>