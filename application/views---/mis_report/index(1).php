<main id="main-container">

                <!-- Page Content -->
                <div class="content">
                    <h2 class="content-heading">Goods details</h2>

                    <!-- Full Table -->
                    <div class="block">
                        <div class="block-content">
                            <div class="block">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">Export MIS Report</h3>
                                </div>

                               
                                <div class="block-content">
                                     <form action="<?=base_url()?>mis_report/export_post" method="post" name="myxfrm">
                                            <div id="ermsg"> <?= $this->session->flashdata('msgx'); ?>  </div>
                                            <div class="form-group" id="">
                                                <select name="report_type" id="report_type"  class="form-control" >
                                                    <option value="">--- Select ---</option>
                                                    <option value="shipment">Shipment Name</option>
                                                    <option value="cargocompany">Cargo Company</option>
                                                </select>
                                            </div>

                                            <div class="form-group" id="shipment">
                                                <label for="example-select">Select Shipment name</label>
                                                <div>
                                                    <select class="form-control" name="shipmentname" >
                                                        <option value="">Select</option>
                                                        <?php 
                                                        foreach($shipments as $k => $shipment){ 
                                                        if($k!=0){
                                                        ?>
                                                        <option value="<?=$shipment->shipmentname?>"><?=$shipment->shipmentname?></option>
                                                        <?php } } ?>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="form-group" id="company">
                                                <label for="example-select">Select Cargo Company</label>
                                                <div>
                                                <select name="cargo_company" id="cargo_company"  class="form-control" > 
                                                    <?php foreach($cargos_arr as $cargo) { ?>
                                                        <option value="<?=$cargo->cargo_name?>"> <?=$cargo->cargo_name?> </option>                                
                                                    <?php } ?>
                                                </select>
                                                </div>
                                            </div>
                                            <span class="error"><?php echo form_error('name'); ?></span>
                                        
                                                  
                                
                                        <div class="form-group" id="export">
                                            <a href="<?=base_url()?>goods_details" class="btn btn-alt-primary">Back</a> &nbsp;<button type="submit" class="btn btn-alt-success">Export</button>
                                        </div>
                                    </form>
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

                    }
                    else if(demovalue == 'cargocompany'){
                        $("div#company").show();
                        $("div#shipment").hide();
                        $("div#export").show();

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