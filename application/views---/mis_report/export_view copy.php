<main id="main-container">

                <!-- Page Content -->
                <div class="content">
                    <h2 class="content-heading">Goods details</h2>

                    <!-- Full Table -->
                    <div class="block">
                        <div class="block-content">
                            <div class="block">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">Export View MIS Report</h3>
                                </div>

                               
                                <div class="block-content">
                                  
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
                        </div>
                    </div>
                    <!-- END Full Table -->

                </div>
                <!-- END Page Content -->

            </main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


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