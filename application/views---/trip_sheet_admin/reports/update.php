<main id="main-container">

                <!-- Page Content -->
                <div class="content">
                    <h2 class="content-heading">Trip Sheet</h2>

                    <!-- Full Table -->
                    <div class="block">
                        <div class="block-content">
                            <div class="block">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">Update Trip Sheet</h3>
                                </div>
                                <div class="block-content">
                                     <form action="<?=base_url()?>trip_sheet/update_process" method="post" name="myxfrm" enctype="multipart/form-data" onsubmit="return validateForm();">
                                            <div id="ermsg"> <?= $this->session->flashdata('msgx'); ?>  </div>
                                        <input type="hidden" name="uid" value="<?=$id?>">
                                        <div class="row">
                                            <div class="col-12 col-md-12">
                                                <div id="subloader" style="display: none;"></div>
                                                <div id="error_id"></div>
                                            </div>
                                            <div class="col-12 col-md-12">
                                                <div class="block-header block-header-default">
                                                    <h3 class="block-title"><b>Trip Details</b></h3>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="example-nf-email">Trip Date</label>
                                                    <input type="date" class="form-control"  name="trip_date" id='trip_date' placeholder="Trip Date.." value="<?=$trip_date?>">
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="example-nf-email">Trip Time</label>
                                                    <input type="time" class="form-control"  name="trip_time" id='trip_time' placeholder="Trip Time.." value="<?=$trip_time?>">
                                                </div>
                                            </div>
                                            <div class="col-4 col-md-4">   
                                                <div class="form-group">
                                                    
                                                    <label for="example-select">Vehicle Number</label>
                                                    <div>
                                                        <select class="form-control" id="vehicle_number" name="vehicle_number" onchange="vehiclenumberchange(this.value)" onclick="vehiclenumberchange(this.value)" >
                                                            <option value="0">Select Vehicle Number </option>
                                                            <?php
                                                            if($vehicles!=null)
                                                            {
                                                            foreach ($vehicles as $key => $vehiclesvlu) {
                                                            ?>
                                                            <option value="<?=$vehiclesvlu->id?>" <?php if($vehicle_id==$vehiclesvlu->id){ echo "selected='true'"; } ?>><?=$vehiclesvlu->vehicle_number?></option>
                                                            <?php
                                                            }
                                                            }
                                                            ?> 
                                                  
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-4 col-md-4">
                                                <div class="form-group">
                                                    <label for="example-nf-email">Driver Name</label>
                                                    <input type="text" class="form-control"  name="vehicle_drivername" id='vehicle_drivername' placeholder="Driver Name.." value="<?=$vehicle_drivername?>">
                                                </div>
                                            </div>
                                            <div class="col-4 col-md-4">
                                                <div class="form-group">
                                                    <label for="example-nf-email">Driver Mob</label>
                                                    <input type="text" class="form-control"  name="vehicle_drivermob" id='vehicle_drivermob' placeholder="Driver Mob.." value="<?=$vehicle_drivermobilenumber?>">
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="example-nf-email">Helper Name</label>
                                                    <input type="text" class="form-control"  name="helper_name" id='helper_name' placeholder="Helper Name.." value="<?=$helper_name?>">
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="example-nf-email">Helper Mob</label>
                                                    <input type="text" class="form-control"  name="helper_mobilenumber" id='helper_mobilenumber' placeholder="Helper Mob.." value="<?=$helper_mobilenumber?>">
                                                </div>
                                            </div>
                                            <div class="col-3 col-md-3">
                                                <div class="form-group">
                                                    <label for="example-nf-email">Start K.M</label>
                                                    <input type="text" class="form-control"  name="start_km" id='start_km' placeholder="Start K.M.." value="<?=$start_km?>">
                                                </div>
                                            </div>
                                            <div class="col-3 col-md-3">
                                                <div class="form-group">
                                                    <label for="example-nf-email">Stop K.M</label>
                                                    <input type="text" class="form-control"  name="stop_km" id='stop_km' placeholder="Stop K.M.." value="<?=$stop_km?>">
                                                </div>
                                            </div>
                                            <div class="col-3 col-md-3">
                                                <div class="form-group">
                                                    <label for="example-nf-email">Total K.M</label>
                                                    <input type="text" class="form-control"  name="total_km" id='total_km' placeholder="Total K.M.." value="<?=$total_km?>">
                                                </div>
                                            </div>
                                            <div class="col-3 col-md-3">
                                                <div class="form-group">
                                                    <label for="example-nf-email">Total Rent</label>
                                                    <input type="text" class="form-control"  name="total_rent" id='total_rent' placeholder="Total Rent.." value="<?=$total_rent?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-12">
                                                <div class="block-header block-header-default">
                                                    <h3 class="block-title"><b>Expense Details</b></h3>
                                                </div>
                                            </div>
                                            <div class="col-4 col-md-4">
                                                <div class="form-group">
                                                    <label for="example-nf-email">Diesel Amt</label>
                                                    <input type="text" class="form-control"  name="exp_diesel" id='exp_diesel' placeholder="Diesel Amt.." value="<?=$exp_diesel?>">
                                                </div>
                                            </div>
                                            <div class="col-4 col-md-4">
                                                <div class="form-group">
                                                    <label for="example-nf-email">Batha Amt</label>
                                                    <input type="text" class="form-control"  name="exp_batha" id='exp_batha' placeholder="Batha Amt.." value="<?=$exp_batha?>">
                                                </div>
                                            </div>
                                            <div class="col-4 col-md-4">
                                                <div class="form-group">
                                                    <label for="example-nf-email">Phone Exp</label>
                                                    <input type="text" class="form-control"  name="exp_phone" id='exp_phone' placeholder="Phone Exp.." value="<?=$exp_phone?>">
                                                </div>
                                            </div>
                                            <div class="col-4 col-md-4">
                                                <div class="form-group">
                                                    <label for="example-nf-email">Toll Exp</label>
                                                    <input type="text" class="form-control"  name="exp_toll" id='exp_toll' placeholder="Toll Exp.." value="<?=$exp_toll?>">
                                                </div>
                                            </div>
                                            <div class="col-4 col-md-4">
                                                <div class="form-group">
                                                    <label for="example-nf-email">Food Amt</label>
                                                    <input type="text" class="form-control"  name="exp_food" id='exp_food' placeholder="Food Amt.." value="<?=$exp_food?>">
                                                </div>
                                            </div>
                                            <div class="col-4 col-md-4">
                                                <div class="form-group">
                                                    <label for="example-nf-email">Other Exp</label>
                                                    <input type="text" class="form-control"  name="exp_other" id='exp_other' placeholder="Other Exp.." value="<?=$exp_other?>">
                                                </div>
                                            </div>
                                            <div class="col-4 col-md-4">
                                                <div class="form-group">
                                                    <label for="example-nf-email">Expense Total</label>
                                                    <input type="text" class="form-control"  name="exp_total" id='exp_total' placeholder="Expense Total.." value="<?=$exp_total?>">
                                                </div>
                                            </div>
                                            <div class="col-4 col-md-4">
                                                <div class="form-group">
                                                    <label for="example-nf-email">Advance Amt</label>
                                                    <input type="text" class="form-control"  name="exp_advance" id='exp_advance' placeholder="Advance Amt.." value="<?=$exp_advance?>">
                                                </div>
                                            </div>
                                            <div class="col-4 col-md-4">
                                                <div class="form-group">
                                                    <label for="example-nf-email">Balance Amt</label>
                                                    <input type="text" class="form-control"  name="balance_amt" id='balance_amt' placeholder="Balance Amt.." value="<?=$balance_amt?>">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="example-select">Status</label>
                                            <div>
                                                <select class="form-control" id="status" name="status">
                                                    <option value="0" <?php if($status=='0'){ echo "selected='true'"; } ?> >Active</option>
                                                    <option value="1" <?php if($status=='1'){ echo "selected='true'"; } ?> >Inactive</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <a href="<?=base_url()?>trip_sheet" class="btn btn-alt-primary">Back</a> &nbsp;
                                            <a href="<?=base_url()?>trip_sheet/delete_process/<?=$id?>" class="btn btn-danger mr-2">Delete</a>&nbsp;<button type="submit" class="btn btn-alt-success">Update Now</button>
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
            <script type="text/javascript">
            function vehiclenumberchange(sbid){
                document.getElementById('error_id').style.display = "none";
                document.getElementById('subloader').style.display = "block";
                $("#subloader").fadeIn(400).html('Loading datas.....   <img style="width: 23px;" src="<?=base_url()?>assets/loading.gif" />');

                $.ajax({
                type: "GET",
                url: "<?php echo base_url() ?>trip_sheet/serach_vehicle_id/"+sbid,
                dataType: "json",
                cache: false,
                success: function(result){
                if(result.length>0){
                try{
                $('#vehicle_drivername').val(result[0]['driver_name']);
                $('#vehicle_drivermob').val(result[0]['contactnumber']);
                document.getElementById('subloader').style.display = "none";
                }catch(e) {
                $('#vehicle_drivername').val('');
                $('#vehicle_drivermob').val('');
                document.getElementById('subloader').style.display = "none";
                }
                }else{
                $('#vehicle_drivername').val('');
                $('#vehicle_drivermob').val('');
                document.getElementById('subloader').style.display = "none";
                $("#error_id").fadeIn(400).html('<span style="margin-top: -30px;position: absolute;color: #f32a2a;">Empty Data</span>');
                }
                },
                error: function(){
                $('#vehicle_drivername').val('');
                $('#vehicle_drivermob').val('');
                document.getElementById('subloader').style.display = "none";
                $("#error_id").fadeIn(400).html('<span style="margin-top: -30px;position: absolute;color: #f32a2a;">Exception while request.</span>');
                }

                });
            }
            $("#start_km").on("change",function() {
                alert(this.value);
            });
            </script>
            <script>

            var loadFile = function(event) {
            var reader = new FileReader();
            reader.onload = function(){
            var output = document.getElementById('output');
            output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
            };

            function validateForm()
            {
                var dorder = document.forms["myxfrm"]["dorder"].value;
                if (dorder == null || dorder == "" || dorder == 0) {
                document.getElementById("ermsg").innerHTML = "<div class='alert alert-danger'><span data-dismiss='alert' class='close' onclick=this.parentElement.style.display='none';>&times;</span><i class='fa fa-times-circle'></i>Enter Data Order</div>";
                //   $('html, body').animate({scrollTop: ($('#url').first().offset().top-150)},"slow");
                $("html, body").animate({scrollTop:0},"slow");
                return false;
                }
                document.getElementById('lod').style.display = "block";
                document.getElementById('submit').disabled=true;
            }
    </script>