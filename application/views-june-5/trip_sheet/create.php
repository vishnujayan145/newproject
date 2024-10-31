<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Add Trip Sheet</h4> 

                    </div>
                </div>
            </div>
            <!-- end page title -->

            

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                        <form action="<?= base_url() ?>trip_sheet/create_process" method="post" name="myxfrm"    enctype="multipart/form-data" onsubmit="return validateForm();">
                            <div id="ermsg"> <?= $this->session->flashdata('msgx'); ?> </div>
                             


                            <div class="row">  
                                <div class="col-12 col-md-12 mb-3 ">
                                    <div id="subloader" style="display: none;"></div>
                                    <div id="error_id"></div>
                                </div>
                                <div class="col-12 col-md-12 mb-3 ">
                                    <div class="block-header block-header-default">
                                        <h3 class="block-title"><b>Trip Details</b></h3>
                                    </div>
                                </div>
                                <div class="col-4 col-md-4 mb-3 ">
                                    <div class="form-group">
                                        <label for="example-nf-email">Trip Date</label>
                                        <input type="date" class="form-control" name="trip_date" id='trip_date'
                                                placeholder="Trip Date..">
                                    </div>
                                </div>
                                <div class="col-4 col-md-4  mb-3 ">
                                    <div class="form-group">
                                        <label for="example-nf-email">Trip Time</label>
                                        <input type="time" class="form-control" name="trip_time" id='trip_time'
                                                placeholder="Trip Time..">
                                    </div>
                                </div>
                                <div class="col-4 col-md-4  mb-3 ">
                                    <div class="form-group">
                                    <label for="example-nf-email">Estimated Arrival Date</label>
                                    <input type="date" class="form-control" name="estimate_arrival_date" id='estimate_arrival_date'
                                                placeholder="Estimated Arrival Date">
                                    </div>
                                </div>
                                <div class="col-4 col-md-4  mb-3 ">
                                    <div class="form-group">
                                        <label for="header file">Header</label>
                                        <!-- <input type="file" class="form-control" name="header" id="header" required>
                                        <p>File size: 1500*250px</p> -->
                                        <select name="cargo_id" id="cargo_id"  class="form-control" required> 
                                        <?php foreach($cargos_arr as $cargo) { ?>
                                            <option value="<?=$cargo->id?>"> <?=$cargo->cargo_name?> </option>                                
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4 col-md-4  mb-3 ">
                                    <div class="form-group">
                                        <label for="example-select">Vehicle/ Vendor</label>                                       
                                        <div>
                                            <select class="form-control" id="vendor_or_vehicle"
                                                    name="vendor_or_vehicle"
                                                    onchange="vendor_or_vehiclechange(this.value)"  required> 
                                                <option value="vehicle">Vehicle</option>
                                                <option value="vendor">Vendor</option>                                               
                                            </select>
                                        </div>
                                    </div>
                                </div> 

                                <div class="col-4 col-md-4  mb-3  vehicle">
                                    <div class="form-group">
                                        <label for="example-select">Vehicle Number</label>                                       
                                        <div>
                                            <select class="form-control select2" id="vehicle_number"
                                                    name="vehicle_number"
                                                    onchange="vehiclenumberchange(this.value)"
                                                    onclick="vehiclenumberchange(this.value)"  >
                                                <option value="0">Select Vehicle Number</option>
                                                <?php
                                                if (!empty($vehicles)) {
                                                    foreach ($vehicles as $key => $vehiclesvlu) {
                                                        ?>
                                                        <option value="<?= $vehiclesvlu->id ?>"><?= $vehiclesvlu->vehicle_number ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-4 col-md-4  mb-3  vehicle">
                                    <div class="form-group">
                                        <label for="example-nf-email">Driver Name</label>
                                        <input type="text" class="form-control" name="vehicle_drivername"
                                                id='vehicle_drivername' placeholder="Driver Name..">
                                    </div>
                                </div>

                                <div class="col-4 col-md-4  mb-3  vehicle">
                                    <div class="form-group">
                                        <label for="example-nf-email">Driver Mob</label>
                                        <input type="text" class="form-control" name="vehicle_drivermob"
                                                id='vehicle_drivermob' placeholder="Driver Mob..">
                                    </div>
                                </div>

                                <div class="col-4 col-md-4  mb-3  vendor">
                                    <div class="form-group">
                                        <label for="example-nf-email">Vednor Name</label>                                       
                                        <select class="form-control select2" id="vendor_id"
                                                    name="vendor_id"
                                                    onchange="vendornamechange(this.value)"
                                                    onclick="vendornamechange(this.value)"   >
                                                <option value="0">Select Vendor Name</option>
                                                <?php
                                                if (!empty($vendor)) {
                                                    foreach ($vendor as $key => $vendorvlu) {
                                                        ?>
                                                        <option value="<?= $vendorvlu->id ?>"><?= $vendorvlu->branch_name ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                    </div>
                                </div>                              

                                <div class="col-4 col-md-4  mb-3  vendor">
                                    <div class="form-group">
                                        <label for="example-nf-email">Vendor Location</label>
                                        <input type="text" class="form-control" name="vendor_location"
                                                id='vendor_location' placeholder="vendor location..">
                                        <input type="hidden" class="form-control" name="vendor_name"
                                                id='vendor_name' placeholder="vendor location.." value="">
                                    </div>
                                </div> 
                                <div class="col-4 col-md-4  mb-3  vendor">
                                    <div class="form-group">
                                        <label for="example-nf-email">Mobile</label>
                                        <input type="text" class="form-control" name="mobile"
                                                id='mobile' placeholder="Mobile">
                                    </div>
                                </div> 
                                <div class="col-4 col-md-4  mb-3  vendor">
                                    <div class="form-group">
                                        <label for="example-nf-email">Authorized Person</label>
                                        <input type="text" class="form-control" name="authorized_person"
                                                id='authorized_person' placeholder="Authorized Person..">
                                    </div>
                                </div>                                

                                </div>
                                <div class="row">
                                <div class="col-4 col-md-4  mb-3 ">
                                    <div class="form-group">
                                        <label for="example-nf-email">Helper Name</label>
                                        <input type="text" class="form-control" name="helper_name" id='helper_name'
                                                placeholder="Helper Name..">
                                    </div>
                                </div>

                                <div class="col-4 col-md-4  mb-3 ">
                                    <div class="form-group">
                                        <label for="example-nf-email">Helper Mob</label>
                                        <input type="text" class="form-control" name="helper_mobilenumber"
                                                id='helper_mobilenumber' placeholder="Helper Mob..">
                                    </div>
                                </div>

                                <div class="col-4 col-md-4  mb-3 ">
                                    <div class="form-group">
                                        <label for="example-nf-email">Start K.M</label>
                                        <input type="text" class="form-control" name="start_km" id='start_km'
                                                placeholder="Start K.M.." value="0" onkeyup="totalkmx();">
                                    </div>
                                </div>

                                <div class="col-4 col-md-4  mb-3 ">
                                    <div class="form-group">
                                        <label for="example-nf-email">Stop K.M</label>
                                        <input type="text" class="form-control" name="stop_km" id='stop_km'
                                                placeholder="Stop K.M.." value="0" onkeyup="totalkmx();">
                                    </div>
                                </div>

                                <div class="col-4 col-md-4  mb-3 ">
                                    <div class="form-group">
                                        <label for="example-nf-email">Total K.M</label>
                                        <input type="text" class="form-control" name="total_km" id='total_km'
                                                placeholder="Total K.M.." value="0">
                                    </div>
                                </div>

                                <div class="col-4 col-md-4  mb-3 ">
                                    <div class="form-group">
                                        <label for="example-nf-email">Total Rent</label>
                                        <input type="text" class="form-control" name="total_rent" id='total_rent'
                                                placeholder="Total Rent..">
                                    </div>
                                </div>
                                </div>


                                <div class="row">
                                <div class="col-4 col-md-4  mb-3 ">
                                    <div class="form-group">
                                        <label for="example-nf-email">Select Destination</label>
                                        <select name="destination" class="form-control" id="destination" required>
                                            <option value="state" >State</option>
                                            <option value="other_state">Vendor</option>
                                        </select>                                       
                                    </div>
                                </div>
                                </div>
                                <?php /*
                                <div class="row" id="other_state" style="">
                                <div class="col-12 col-md-12">
                                    <div class="block-header block-header-default">
                                        <h3 class="block-title"><b>Import CSV</b></h3>
                                    </div>
                                </div>

                                <div class="col-4 col-md-4  mb-3 ">
                                    <div class="form-group">
                                        <label for="upload_file_other_state">Import file</label>
                                        <input type="file" class="form-control" name="upload_file_other_state" id='upload_file_other_state'
                                            placeholder="Upload CSV.."  accept=".csv">
                                    </div>
                                </div>
                                </div>
                                */ ?>

                                <div class="row">
                                <div class="col-12 col-md-12">
                                    <div class="block-header block-header-default">
                                        <h3 class="block-title"><b>Expense Details</b></h3>
                                    </div>
                                </div>
                                <div class="col-4 col-md-4  mb-3 ">
                                    <div class="form-group">
                                        <label for="example-nf-email">Diesel Amt</label>
                                        <input type="text" class="form-control" name="exp_diesel" id='exp_diesel'
                                                placeholder="Diesel Amt.." value="0" onkeyup="expensetotalx();">
                                    </div>
                                </div>

                                <div class="col-4 col-md-4  mb-3 ">
                                    <div class="form-group">
                                        <label for="example-nf-email">Batha Amt</label>
                                        <input type="text" class="form-control" name="exp_batha" id='exp_batha'
                                                placeholder="Batha Amt.." value="0" onkeyup="expensetotalx();">
                                    </div>
                                </div>

                                <div class="col-4 col-md-4  mb-3 ">
                                    <div class="form-group">
                                        <label for="example-nf-email">Phone Exp</label>
                                        <input type="text" class="form-control" name="exp_phone" id='exp_phone'
                                                placeholder="Phone Exp.." value="0" onkeyup="expensetotalx();">
                                    </div>
                                </div>

                                <div class="col-4 col-md-4  mb-3 ">
                                    <div class="form-group">
                                        <label for="example-nf-email">Toll Exp</label>
                                        <input type="text" class="form-control" name="exp_toll" id='exp_toll'
                                                placeholder="Toll Exp.." value="0" onkeyup="expensetotalx();">
                                    </div>
                                </div>

                                <div class="col-4 col-md-4  mb-3 ">
                                    <div class="form-group">
                                        <label for="example-nf-email">Food Amt</label>
                                        <input type="text" class="form-control" name="exp_food" id='exp_food'
                                                placeholder="Food Amt.." value="0" onkeyup="expensetotalx();">
                                    </div>
                                </div>

                                <div class="col-4 col-md-4  mb-3 ">
                                    <div class="form-group">
                                        <label for="example-nf-email">Other Exp</label>
                                        <input type="text" class="form-control" name="exp_other" id='exp_other'
                                                placeholder="Other Exp.." value="0" onkeyup="expensetotalx();">
                                    </div>
                                </div>

                                <div class="col-4 col-md-4  mb-3 ">
                                    <div class="form-group">
                                        <label for="example-nf-email">Expense Total</label>
                                        <input type="text" class="form-control" name="exp_total" id='exp_total'
                                                placeholder="Expense Total.." value="0" onkeyup="balanceamountx();">
                                    </div>
                                </div>

                                <div class="col-4 col-md-4  mb-3 ">
                                    <div class="form-group">
                                        <label for="example-nf-email">Advance Amt</label>
                                        <input type="text" class="form-control" name="exp_advance" id='exp_advance'
                                                placeholder="Advance Amt.." value="0" onkeyup="balanceamountx();">
                                    </div>
                                </div>

                                <div class="col-4 col-md-4  mb-3 ">
                                    <div class="form-group">
                                        <label for="example-nf-email">Balance Amt</label>
                                        <input type="text" class="form-control" name="balance_amt" id='balance_amt'
                                                placeholder="Balance Amt..">
                                    </div>
                                </div>
                                </div> 

                                <div class="form-group"> 
                                <label for="example-select">Status</label> 
                                <div> 
                                    <select class="form-control" id="status" name="status">  
                                        <option value="7">Trip Created</option>
                                        <option value="1">Trip Started</option>
                                        <option value="0">On the Way</option>
                                        <option value="2">Trip Finished</option>
                                    </select> 
                                    <input type="hidden" name="branch_id" value="<?= $this->session->userdata['adminloginel']['id'] ?>" />  
                                </div>
                                </div>
 
 

                                        <div class=" ">
                                        <a href="<?= base_url() ?>trip_sheet" class="btn btn-primary">Back</a> &nbsp;<button
                                        type="submit" class="btn btn-success">Complete
                                         </button>
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



<script type="text/javascript">


    $(document).ready(function(){
        $('.vendor').hide();
        $("div#other_state").hide();
        $('#destination').on('change', function(){
            var demovalue = $(this).val(); 
            if(demovalue == 'state'){
                $("div#other_state").hide();
            }
            else {
                $("div#other_state").show();
            }
        
        });
    });

    function vendor_or_vehiclechange( val){
       if( val == 'vendor'){
            $('.vendor').show();
            $('.vehicle').hide();
       } else if( val == 'vehicle' ) {
            $('.vendor').hide();
            $('.vehicle').show();
       }

    }

    function vehiclenumberchange(sbid) { 
        document.getElementById('error_id').style.display = "none";
        document.getElementById('subloader').style.display = "block";
        $("#subloader").fadeIn(400).html(
            'Loading datas.....   <img style="width: 23px;" src="<?=base_url()?>assets/loading.gif" />');
        $.ajax({
            type: "GET",
            url: "<?php echo base_url() ?>trip_sheet/serach_vehicle_id/" + sbid,
            dataType: "json",
            cache: false,
            success: function (result) {
                if (result.length > 0) {
                    try {
                        $('#vehicle_drivername').val(result[0]['driver_name']);
                        $('#vehicle_drivermob').val(result[0]['contactnumber']);
                        document.getElementById('subloader').style.display = "none";
                    } catch (e) {
                        $('#vehicle_drivername').val('');
                        $('#vehicle_drivermob').val('');
                        document.getElementById('subloader').style.display = "none";
                    }
                } else {
                    $('#vehicle_drivername').val('');
                    $('#vehicle_drivermob').val('');
                    document.getElementById('subloader').style.display = "none";
                    $("#error_id").fadeIn(400).html(
                        '<span style="margin-top: -30px;position: absolute;color: #f32a2a;">Empty Data</span>'
                    );
                }
            },
            error: function () {
                $('#vehicle_drivername').val('');
                $('#vehicle_drivermob').val('');
                document.getElementById('subloader').style.display = "none";
                $("#error_id").fadeIn(400).html(
                    '<span style="margin-top: -30px;position: absolute;color: #f32a2a;">Exception while request.</span>'
                );
            }
        });
    }


    function vendornamechange(sbid) {
        document.getElementById('error_id').style.display = "none";
        document.getElementById('subloader').style.display = "block";
        $("#subloader").fadeIn(400).html(
            'Loading datas.....   <img style="width: 23px;" src="<?=base_url()?>assets/loading.gif" />');
        $.ajax({
            type: "GET",
            url: "<?php echo base_url() ?>trip_sheet/serach_vendor_id/" + sbid,
            dataType: "json",
            cache: false,
            success: function (result) {
                console.log( result.length);
                if (result.length > 0) {
                    try {
                        $('#vendor_name').val(result[0]['branch_name']);
                        $('#vendor_location').val(result[0]['location']);
                        $('#mobile').val(result[0]['mobile']);
                        $('#authorized_person').val(result[0]['authorized_person']);
                        
                        document.getElementById('subloader').style.display = "none";
                    } catch (e) {
                        // $('#vendor_name').val('');
                        $('#vendor_name').val('');
                        $('#vendor_location').val('');
                        $('#mobile').val('');
                        $('#authorized_person').val(''); 
                        document.getElementById('subloader').style.display = "none";
                    }
                } else {
                        $('#vendor_name').val('');
                    $('#vendor_location').val('');
                    $('#mobile').val('');
                    $('#authorized_person').val(''); 
                    document.getElementById('subloader').style.display = "none";
                    $("#error_id").fadeIn(400).html(
                        '<span style="margin-top: -30px;position: absolute;color: #f32a2a;">Empty Data</span>'
                    );
                }
            },
            error: function () {
                // $('#vendor_name').val('');
                $('#vendor_name').val('');
                $('#vendor_location').val('');
                $('#mobile').val('');
                $('#authorized_person').val(''); 
                document.getElementById('subloader').style.display = "none";
                $("#error_id").fadeIn(400).html(
                    '<span style="margin-top: -30px;position: absolute;color: #f32a2a;">Exception while request.</span>'
                );
            }
        });

    }

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
        var resultx = parseInt(exp_dieselv) + parseInt(exp_bathav) + parseInt(exp_phonev) + parseInt(exp_tollv) + parseInt(
            exp_foodv) + parseInt(exp_otherv);
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
        var resultx = parseInt(exp_dieselv) + parseInt(exp_bathav) + parseInt(exp_phonev) + parseInt(exp_tollv) + parseInt(
            exp_foodv) + parseInt(exp_otherv);
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