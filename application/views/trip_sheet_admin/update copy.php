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

                                     <form action="<?=base_url()?>trip_sheet_admin/update_process" method="post" name="myxfrm" enctype="multipart/form-data" onsubmit="return validateForm();">

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

                                    <label for="example-nf-email">Estimated Arrival Date</label>

                                    <input type="date" class="form-control" name="estimate_arrival_date" id='estimate_arrival_date'
                                               placeholder="Estimated Arrival Date" value="<?=$estimate_arrival_date?>">
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

                                                    <input type="text" class="form-control"  name="start_km" id='start_km' placeholder="Start K.M.." value="<?=$start_km?>" onkeyup="totalkmx();">

                                                </div>

                                            </div>

                                            <div class="col-3 col-md-3">

                                                <div class="form-group">

                                                    <label for="example-nf-email">Stop K.M</label>

                                                    <input type="text" class="form-control"  name="stop_km" id='stop_km' placeholder="Stop K.M.." value="<?=$stop_km?>" onkeyup="totalkmx();">

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
                                <div class="col-3 col-md-3">
                                    <div class="form-group">
                                        <label for="example-nf-email">Select Destination</label>
                                        <select name="destination" class="form-control" id="destination" required>
                                            <option value="state"   <?php if($destination=='state'){ echo "selected='true'"; } ?>  >State</option>
                                            <option value="other_state"  <?php if($destination=='other_state'){ echo "selected='true'"; } ?> >Vendor</option>
                                        </select>                                       
                                    </div>
                                </div>
                            </div>
                            
<!-- 
                                        <div class="row">
                                            <div class="col-12 col-md-12">
                                                <div class="block-header block-header-default">
                                                    <h3 class="block-title"><b>Import CSV</b></h3>
                                                </div>
                                            </div>

                                            <div class="col-4 col-md-4">
                                                <div class="form-group">
                                                    <label for="upload_file">Import file</label>
                                                    <input type="file" class="form-control" name="upload_file" id='upload_file'
                                                        placeholder="Upload CSV..">
                                                </div>
                                            </div>
                                        </div> -->


                                        <div class="row">

                                            <div class="col-12 col-md-12">

                                                <div class="block-header block-header-default">

                                                    <h3 class="block-title"><b>Expense Details</b></h3>

                                                </div>

                                            </div>

                                            <div class="col-4 col-md-4">

                                                <div class="form-group">

                                                    <label for="example-nf-email">Diesel Amt</label>

                                                    <input type="text" class="form-control"  name="exp_diesel" id='exp_diesel' placeholder="Diesel Amt.." value="<?=$exp_diesel?>" onkeyup="expensetotalx();">

                                                </div>

                                            </div>

                                            <div class="col-4 col-md-4">

                                                <div class="form-group">

                                                    <label for="example-nf-email">Batha Amt</label>

                                                    <input type="text" class="form-control"  name="exp_batha" id='exp_batha' placeholder="Batha Amt.." value="<?=$exp_batha?>" onkeyup="expensetotalx();">

                                                </div>

                                            </div>

                                            <div class="col-4 col-md-4">

                                                <div class="form-group">

                                                    <label for="example-nf-email">Phone Exp</label>

                                                    <input type="text" class="form-control"  name="exp_phone" id='exp_phone' placeholder="Phone Exp.." value="<?=$exp_phone?>" onkeyup="expensetotalx();">

                                                </div>

                                            </div>

                                            <div class="col-4 col-md-4">

                                                <div class="form-group">

                                                    <label for="example-nf-email">Toll Exp</label>

                                                    <input type="text" class="form-control"  name="exp_toll" id='exp_toll' placeholder="Toll Exp.." value="<?=$exp_toll?>" onkeyup="expensetotalx();">

                                                </div>

                                            </div>

                                            <div class="col-4 col-md-4">

                                                <div class="form-group">

                                                    <label for="example-nf-email">Food Amt</label>

                                                    <input type="text" class="form-control"  name="exp_food" id='exp_food' placeholder="Food Amt.." value="<?=$exp_food?>" onkeyup="expensetotalx();">

                                                </div>

                                            </div>

                                            <div class="col-4 col-md-4">

                                                <div class="form-group">

                                                    <label for="example-nf-email">Other Exp</label>

                                                    <input type="text" class="form-control"  name="exp_other" id='exp_other' placeholder="Other Exp.." value="<?=$exp_other?>" onkeyup="expensetotalx();">

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

                                                    <input type="text" class="form-control"  name="exp_advance" id='exp_advance' placeholder="Advance Amt.." value="<?=$exp_advance?>" onkeyup="balanceamountx();">

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
                                                    <option value="7" <?php if($status=='7'){ echo "selected='true'"; } ?> >Trip Created</option>
                                                    <option value="0" <?php if($status=='0'){ echo "selected='true'"; } ?> >On the Way</option>
                                                    <option value="1" <?php if($status=='1'){ echo "selected='true'"; } ?> >Trip Started</option>
                                                    <option value="2" <?php if($status=='2'){ echo "selected='true'"; } ?> >Trip Finished</option>


                            

                                                    <!-- <option value="3" <?php if($status=='3'){ echo "selected='true'"; } ?> >Delivered</option>
                                                    <option value="4" <?php if($status=='4'){ echo "selected='true'"; } ?> >Pending</option>
                                                    <option value="5" <?php if($status=='5'){ echo "selected='true'"; } ?> >Not Delivered</option>  -->
                                                </select>

                                                <input type="hidden" name="branch_id" value="<?=$branch_id?>" />                                                 
                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <a href="<?=base_url()?>trip_sheet_admin" class="btn btn-alt-primary">Back</a> &nbsp;

                                            <a href="<?=base_url()?>trip_sheet_admin/delete_process/<?=$id?>" class="btn btn-danger mr-2">Delete</a>&nbsp;<button type="submit" class="btn btn-alt-success">Update Now</button>

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

                url: "<?php echo base_url() ?>trip_sheet_admin/serach_vehicle_id/"+sbid,

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

            <script type="text/javascript">

            function totalkmx() {

                  var start_kmvlu = document.getElementById('start_km').value;

                  var stop_kmvlu = document.getElementById('stop_km').value;

                  var result = parseInt(stop_kmvlu) - parseInt(start_kmvlu);

                  if (!isNaN(result)) {

                     document.getElementById('total_km').value = result;

                  }

            }

            function expensetotalx() {

                  var exp_dieselv = document.getElementById('exp_diesel').value;

                  var exp_bathav = document.getElementById('exp_batha').value;

                  var exp_phonev = document.getElementById('exp_phone').value;

                  var exp_tollv = document.getElementById('exp_toll').value;

                  var exp_foodv = document.getElementById('exp_food').value;

                  var exp_otherv = document.getElementById('exp_other').value;

                  var resultx = parseInt(exp_dieselv) + parseInt(exp_bathav)+ parseInt(exp_phonev)+ parseInt(exp_tollv)+ parseInt(exp_foodv)+ parseInt(exp_otherv);

                  if (!isNaN(resultx)) {

                     document.getElementById('exp_total').value = resultx;

                     this.balanceamountx();

                  }

            }

            function balanceamountx() {

                  var exp_dieselv = document.getElementById('exp_diesel').value;

                  var exp_bathav = document.getElementById('exp_batha').value;

                  var exp_phonev = document.getElementById('exp_phone').value;

                  var exp_tollv = document.getElementById('exp_toll').value;

                  var exp_foodv = document.getElementById('exp_food').value;

                  var exp_otherv = document.getElementById('exp_other').value;

                  var resultx = parseInt(exp_dieselv) + parseInt(exp_bathav)+ parseInt(exp_phonev)+ parseInt(exp_tollv)+ parseInt(exp_foodv)+ parseInt(exp_otherv);

                  if (!isNaN(resultx)) {

                     document.getElementById('exp_total').value = resultx;

                  }

                  

                  var exp_advancev = document.getElementById('exp_advance').value;

                  var result = parseInt(resultx) - parseInt(exp_advancev);

                  if (!isNaN(result)) {

                     document.getElementById('balance_amt').value = result;

                  }

            }

    </script>