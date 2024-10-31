<style media="print">
 @page {
  size: A4;
  margin: 5mm 5mm 5mm 5mm;  
       }
</style> 

<main id="main-container">

    <!-- Page Content -->
    <div class="content">
        <!--   <h2 class="content-heading">Trip Sheet</h2> -->

        <!-- Full Table -->
        <div class="block">
            <div class="block-header block-header-default">
                <!--  <h3 class="block-title">TRIP SHEET</h3> -->
                <div class="block-options">
                    <!-- Print Page functionality is initialized in Helpers.print() -->
                    <button type="button" class="btn-block-option" onclick="Codebase.helpers('print-page');">
                        <i class="si si-printer"></i> Print
                    </button>
                    <button type="button" class="btn-block-option" data-toggle="block-option"
                            data-action="fullscreen_toggle"></button>
                </div>
            </div>

            <div class="block-content">
                <!-- Invoice Info -->
                <div class="row my-20">
                    <!-- Company Info -->
                    <div class="col-12 ml-3">
                        <?php
                        if ($header){
                        ?>
                            <img src="<?= base_url() ?>assets/uploads/headers/<?=get_cargo_company_header_image($header)?>" style="width:96%;display: block;margin-right: auto;">
                        <?php
                        }else{
                        ?>
                        <img src="<?= base_url() ?>assets/print_header.png"
                             style="width:96%;display: block;margin-right: auto;">
                            <?php
                        }
                        ?>
                    </div>

                    <!-- END Client Info -->
                </div>
                <!-- END Invoice Info -->

                <!-- Table -->

                <div class="row text-center table table-hover" style="border: 1px solid black;">
                    <div class="col-6">
                        <div class="block">
                            <div class="block-content" style="padding: 0px;">
                                <table style="width: 100%;border-collapse: collapse;">
                                    <tr>
                                        <td style="text-align: left;border: 0px;padding: 0px;font-weight: bold;color: black;">
                                            Trip NO :
                                        </td>
                                        <td style="text-align: left;border: 0px;padding: 0px;font-weight: 600;color: black;">
                                            :
                                        </td>
                                        <td style="text-align: left;border: 0px;padding: 0px;font-weight: 600;color: black;"><?= $trip_sheet_name ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left;border: 0px;padding: 0px;font-weight: 600;color: black;">
                                            Date
                                        </td>
                                        <td style="text-align: left;border: 0px;padding: 0px;font-weight: 600;color: black;">
                                            :
                                        </td>
                                        <td style="text-align: left;border: 0px;padding: 0px;font-weight: 600;color: black;"><?= $trip_date ?> <?= $trip_time ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left;border: 0px;padding: 0px;font-weight: 600;color: black;">
                                            Vehicle NO
                                        </td>
                                        <td style="text-align: left;border: 0px;padding: 0px;font-weight: 600;color: black;">
                                            :
                                        </td>
                                        <td style="text-align: left;border: 0px;padding: 0px;font-weight: 600;color: black;"><?= $vehicle_number ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="block">
                            <div class="block-content" style="padding: 0px;">
                                <table style="width: 100%;border-collapse: collapse;">
                                    <tr>
                                        <td style="text-align: left;border: 0px;padding: 0px;font-weight: bold;color: black;">
                                            Driver :
                                        </td>
                                        <td style="text-align: left;border: 0px;padding: 0px;font-weight: bold;color: black;">
                                            :
                                        </td>
                                        <td style="text-align: left;border: 0px;padding: 0px;font-weight: bold;color: black;"><?= $vehicle_drivername ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left;border: 0px;padding: 0px;font-weight: bold;color: black;">
                                            Mobile
                                        </td>
                                        <td style="text-align: left;border: 0px;padding: 0px;font-weight: bold;color: black;">
                                            :
                                        </td>
                                        <td style="text-align: left;border: 0px;padding: 0px;font-weight: bold;color: black;"><?= $vehicle_drivermobilenumber ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left;border: 0px;padding: 0px;font-weight: bold;color: black;">
                                            Helper
                                        </td>
                                        <td style="text-align: left;border: 0px;padding: 0px;font-weight: bold;color: black;">
                                            :
                                        </td>
                                        <td style="text-align: left;border: 0px;padding: 0px;font-weight: bold;color: black;"><?= $helper_name ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left;border: 0px;padding: 0px;font-weight: bold;color: black;">
                                            Mobile
                                        </td>
                                        <td style="text-align: left;border: 0px;padding: 0px;font-weight: bold;color: black;">
                                            :
                                        </td>
                                        <td style="text-align: left;border: 0px;padding: 0px;font-weight: bold;color: black;"><?= $helper_mobilenumber ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                <!-- </div>
                <br>
                <div class="row text-center table table-hover"> -->
                    <div class="col-4" style="padding: 0px;">
                        <div class="block">
                            <div class="block-content" style="padding: 0px;">
                                <table style="width: 100%;border-collapse: collapse;">
                                    <tr>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;background-color: #dedede !important;
    -webkit-print-color-adjust: exact;">Start KM :
                                        </td>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;background-color: #dedede !important;
    -webkit-print-color-adjust: exact;">:
                                        </td>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;background-color: #dedede !important;
    -webkit-print-color-adjust: exact;border-right: 2px solid white;"><?= $start_km ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;"><br></td>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;"></td>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;"></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;background-color: #dedede !important;-webkit-print-color-adjust: exact;">
                                            Stop KM
                                        </td>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;background-color: #dedede !important;-webkit-print-color-adjust: exact;">
                                            :
                                        </td>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;background-color: #dedede !important;-webkit-print-color-adjust: exact;border-right: 2px solid white;"><?= $stop_km ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;"><br></td>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;"></td>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;"></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;background-color: #dedede !important;-webkit-print-color-adjust: exact;">
                                            Total Rent
                                        </td>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;background-color: #dedede !important;-webkit-print-color-adjust: exact;">
                                            :
                                        </td>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;background-color: #dedede !important;-webkit-print-color-adjust: exact;border-right: 2px solid white;"><?= $total_rent ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;"><br></td>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;"></td>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-4" style="padding: 0px;">
                        <div class="block">
                            <div class="block-content" style="padding: 0px;">
                                <table style="width: 100%;border-collapse: collapse;">
                                    <tr>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;background-color: #dedede !important;-webkit-print-color-adjust: exact;">
                                            Diesel :
                                        </td>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;background-color: #dedede !important;-webkit-print-color-adjust: exact;">
                                            :
                                        </td>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;background-color: #dedede !important;-webkit-print-color-adjust: exact;    border-right: 1px solid white;"><?= $exp_diesel ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;">Phone</td>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;">:</td>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;"><?= $exp_phone ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;background-color: #dedede !important;-webkit-print-color-adjust: exact;">
                                            Batha
                                        </td>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;background-color: #dedede !important;-webkit-print-color-adjust: exact;">
                                            :
                                        </td>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;background-color: #dedede !important;-webkit-print-color-adjust: exact;border-right: 2px solid white;"><?= $exp_batha ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;">Toll</td>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;">:</td>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;"><?= $exp_toll ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;background-color: #dedede !important;-webkit-print-color-adjust: exact;">
                                            Food
                                        </td>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;background-color: #dedede !important;-webkit-print-color-adjust: exact;">
                                            :
                                        </td>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;background-color: #dedede !important;-webkit-print-color-adjust: exact;"><?= $exp_food ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;">Other</td>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;">:</td>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;"><?= $exp_other ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-4" style="padding: 0px;">
                        <div class="block">
                            <div class="block-content" style="padding: 0px;">
                                <table style="width: 100%;border-collapse: collapse;">
                                    <tr>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;background-color: #dedede !important;-webkit-print-color-adjust: exact;">
                                            <b>Total EXP</b></td>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;background-color: #dedede !important;-webkit-print-color-adjust: exact;">
                                            <b>:</b></td>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;background-color: #dedede !important;-webkit-print-color-adjust: exact;">
                                            <b><?= $exp_total ?></b></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;"><b>Advance</b></td>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;"><b>:</b></td>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;"><b><?= $exp_advance ?></b></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;background-color: #dedede !important;-webkit-print-color-adjust: exact;">
                                            <b>Balance</b></td>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;background-color: #dedede !important;-webkit-print-color-adjust: exact;">
                                            <b>:</b></td>
                                        <td style="text-align: left; font-weight: bold; color:black; padding: 0px;background-color: #dedede !important;-webkit-print-color-adjust: exact;">
                                            <b><?= $balance_amt ?></b></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="table-responsive push">
                        <table class="table table-hover" style="border: 1px solid black; ">
                            <thead>
                            <tr>
                                <th width="3%" class="text-center" style="order: 1px solid black; font-weight: bold; color:black; padding: 0px;">S/N</th>
                                <!-- <th width="3%" class="text-center" style="order: 1px solid black; font-weight: bold; color:black; padding: 0px;">sort order</th> -->
                                <!-- <th width="20%" class="text-center" style="border: 1px solid black; font-weight: bold; color:black; padding: 0px;">
                                    Cargo
                                </th> -->
                                <th width="4%" class="text-center" style="border: 1px solid black; font-weight: bold; color:black; padding: 0px;">
                                    # No
                                </th> 
                               
                                <th width="20%" class="text-center" style="border: 1px solid black; font-weight: bold; color:black; padding: 0px;">
                                    Invoice No
                                </th>
                                <th width="4%" class="text-center" style="order: 1px solid black; font-weight: bold; color:black; padding: 0px;">Qnt</th>
                                <th width="5%" class="text-center" style="border: 1px solid black; font-weight: bold; color:black; padding: 0px;">
                                    Weight
                                </th>
                                <th width="10%" class="text-center" style="border: 1px solid black; font-weight: bold; color:black; padding: 0px;">
                                    Place
                                </th>
                                <th width="10%" class="text-center" style="border: 1px solid black; font-weight: bold; color:black; padding: 0px;">
                                    State
                                </th>
                                <th width="20%" class="text-center" style="border: 1px solid black; font-weight: bold; color:black; padding: 0px;">
                                    Trip No
                                </th>
                                <!-- <th width="8%" class="text-center" style="border: 1px solid black; font-weight: bold; color:black; padding: 0px;">Phone
                                    Number
                                </th> -->
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($trip_sheet_cargos != null) {
                                $slno = 1;                                
                                $total_cnt = 0;
                                $total_pcs = 0;
                                $total_weight = 0;

                                foreach ($trip_sheet_cargos as $key => $trip_sheet_cargosvlu) {                                    
                                    $total_cnt =  $total_cnt+ 1;
                                    $total_pcs = $total_pcs + $trip_sheet_cargosvlu->tot_pcs;
                                    $total_weight = $total_weight + $trip_sheet_cargosvlu->tot_weight;

                                    ?>
                                    <tr>
                                        <td class="text-center"  style="border: 1px solid black; font-weight: bold; color:black; padding: 0px;"><?= $slno++ ?></td>
                                        <?php /* <td class="text-center"  style="border: 1px solid black; font-weight: bold; color:black; padding: 0px;"><?= $trip_sheet_cargosvlu->sort_order ?></td> */ ?>
                                        <!-- <td class="text-center" style="border: 1px solid black; font-weight: bold; color:black; padding: 0px;">
                                            <p class="font-w600 mb-5"><?= $trip_sheet_cargosvlu->cargo_name ?></p>
                                        </td> -->
                                        <td class="text-center"
                                            style="border: 1px solid black; font-weight: bold; color:black; padding: 0px;">
                                            
                                            <?php   
                                                    $res_str1 = array_chunk(explode(",",$trip_sheet_cargosvlu->grp_boxno),2);
                                                    foreach( $res_str1 as &$val){
                                                    $val  = implode(",",$val);
                                                    }
                                                    echo implode(",<br>",$res_str1);  
                                            ?>

                                            </td> 
                                        <td class="text-center" style="border: 1px solid black; font-weight: bold; color:black; padding: 0px;">
                                            <?php  
                                                    $res_str = array_chunk(explode(",",$trip_sheet_cargosvlu->goods_invoice),2);
                                                    foreach( $res_str as &$val){
                                                    $val  = implode(",",$val);
                                                    }
                                                    echo implode(",<br>",$res_str);  
                                            ?>
                                        </td>
                                        <td class="text-center"
                                            style="border: 1px solid black; font-weight: bold; color:black; padding: 0px;"><?= $trip_sheet_cargosvlu->tot_pcs ?></td>
                                        <td class="text-center"
                                            style="border: 1px solid black; font-weight: bold; color:black; padding: 0px;"><?= $trip_sheet_cargosvlu->tot_weight ?></td>
                                        <td class="text-center"
                                            style="border: 1px solid black; font-weight: bold; color:black; padding: 0px;"><?= $trip_sheet_cargosvlu->place ?></td>
                                        <td class="text-center"
                                            style="border: 1px solid black; font-weight: bold; color:black; padding: 0px;"><?= $trip_sheet_cargosvlu->state ?></td>
                                        <!-- <td class="text-center"
                                            style="border: 1px solid black; font-weight: bold; color:black; padding: 0px;"><?= $trip_sheet_cargosvlu->mobilenumber ?></td> -->
                                        <td class="text-center" style="border: 1px solid black; font-weight: bold; color:black; padding: 0px;">
                                            <?= $trip_sheet_cargosvlu->trip_no ?>  </td>  
                                    </tr>
                                    <?php
                                }
                                ?>

                                <tr style="font-weight:bold;  color:black;">
                                <td colspan="2"> Total Count :<?= $total_cnt ?> </td> <td colspan="2">Total Pcs: <?= $total_pcs ?></td> <td colspan="3">Total Weight : <?= $total_weight ?></td>
                                </tr>
                        <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END Table -->

                <!-- Footer -->

                <!-- END Footer -->
            </div>
        </div>
        <!-- END Full Table -->

    </div>
    <!-- END Page Content -->

</main>
<script type="text/javascript">
    function vehiclenumberchange(sbid) {
        document.getElementById('error_id').style.display = "none";
        document.getElementById('subloader').style.display = "block";
        $("#subloader").fadeIn(400).html('Loading datas.....   <img style="width: 23px;" src="<?=base_url()?>assets/loading.gif" />');

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
                    $("#error_id").fadeIn(400).html('<span style="margin-top: -30px;position: absolute;color: #f32a2a;">Empty Data</span>');
                }
            },
            error: function () {
                $('#vehicle_drivername').val('');
                $('#vehicle_drivermob').val('');
                document.getElementById('subloader').style.display = "none";
                $("#error_id").fadeIn(400).html('<span style="margin-top: -30px;position: absolute;color: #f32a2a;">Exception while request.</span>');
            }

        });
    }

    $("#start_km").on("change", function () {
        alert(this.value);
    });
</script>
<script>

    var loadFile = function (event) {
        var reader = new FileReader();
        reader.onload = function () {
            var output = document.getElementById('output');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    };

    function validateForm() {
        var dorder = document.forms["myxfrm"]["dorder"].value;
        if (dorder == null || dorder == "" || dorder == 0) {
            document.getElementById("ermsg").innerHTML = "<div class='alert alert-danger'><span data-dismiss='alert' class='close' onclick=this.parentElement.style.display='none';>&times;</span><i class='fa fa-times-circle'></i>Enter Data Order</div>";
            //   $('html, body').animate({scrollTop: ($('#url').first().offset().top-150)},"slow");
            $("html, body").animate({scrollTop: 0}, "slow");
            return false;
        }
        document.getElementById('lod').style.display = "block";
        document.getElementById('submit').disabled = true;
    }
</script>