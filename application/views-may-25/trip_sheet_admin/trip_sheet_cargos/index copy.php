<style>
    .select2-container--default .select2-selection--single {
    height: 37px !important;
        border: 1px solid #ced4da;
    }
    .select2-container--open .select2-dropdown--below{
      width: max-content !important;
    }
    .select2-container--open .select2-dropdown--above{
      width: max-content !important;
    }
    
    .select2-container .select2-selection--single{
    height:34px !important;
}
.select2-container--default .select2-selection--single{
         border: 1px solid #ccc !important; 
     border-radius: 0px !important; 
}


</style>
<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<!-- Main Container -->
<main id="main-container">

    <!-- Page Content -->
    <div class="content">


        <!-- Full Table -->
        <div class="block1">
            <div class="block-header block-header-default">
                            <span class="block-title">
                                 <h2 class="content-heading">List all Trip Sheet Cargos</h2>
                                 <input class="btn btn-alt-primary" type="button" value="Change status"  onclick="showAllStatusModel()"/>
                                <input type="hidden" id="trip_sheet_id" value="<?= $this->uri->segment(3) ?>" />
                            </span>
                <a href="<?= base_url() ?>trip_sheet_admin" class="btn btn-alt-primary"><i class="si si-action-undo mr-5"></i>Back</a>
                <?php
                if ($this->uri->segment(4)) {
                    ?>
                    <a href="<?= base_url() ?>trip_sheet_admin/cargos/<?= $this->uri->segment(3) ?>"
                       class="btn btn-alt-primary"><i class="fa fa-plus mr-5"></i>Add Trip Sheet Cargos</a>
                    <?php
                } else {
                    ?>
                    <?php
                }
                ?>

            </div>
            <?php
            if ($this->uri->segment(4)) {
                ?>
                <div class="float-right">
                    <form action="<?= base_url() ?>trip_sheet_admin/cargo_update_process" method="post" name="myxfrm"
                          enctype="multipart/form-data" >
                        <input type="hidden" name="trip_sheet_id" value="<?= $this->uri->segment(3) ?>">
                        <input type="hidden" name="trip_sheet_cargo_id" value="<?= $this->uri->segment(4) ?>">

                        <?php /*
                        <div class="dropdown float-left">
                            <label for="example-select">Cargo Name</label>
                            <div>
                                <select class="form-control" id="cargo_name" name="cargo_name">
                                    <?php
                                    if ($cargos != null) {
                                        foreach ($cargos as $key => $cargosvlu) {
                                            ?>
                                            <option value="<?= $cargosvlu->id ?>" <?php if ($trip_sheet_cargosdtls[0]->cargo_id == $cargosvlu->id) {
                                                echo "selected='true'";
                                            } ?>><?= $cargosvlu->cargo_name ?></option>
                                            <?php
                                        }
                                    }
                                    ?>

                                </select>
                            </div>

                        </div>
                        <div class="dropdown float-left" style="width: 134px;">
                            <label for="example-select">Invoice Number</label>
                            <div>
                                <input type="text" class="form-control" name="invoice_number"
                                       placeholder="Enter Invoice Number.."
                                       value="<?= $trip_sheet_cargosdtls[0]->invoice_number ?>">
                            </div>
                        </div>
                        <div class="dropdown float-left" style="width: 67px;">
                            <label for="example-select">PCs</label>
                            <div>
                                <input type="text" class="form-control" name="quantity" placeholder="Enter quantity.."
                                       value="<?= $trip_sheet_cargosdtls[0]->quantity ?>">
                            </div>
                        </div>
                        <div class="dropdown float-left" style="width: 67px;">
                            <label for="example-select">Weight</label>
                            <div>
                                <input type="text" class="form-control" name="weight" placeholder="Enter weight.."
                                       value="<?= $trip_sheet_cargosdtls[0]->weight ?>">
                            </div>
                        </div>
                        <div class="dropdown float-left" style="width: 129px;">
                            <label for="example-select">Place</label>
                            <div>
                                <select class="form-control" id="place" name="place">
                                    <option value="Alappuzha" <?php if ($trip_sheet_cargosdtls[0]->place == 'Alappuzha') {
                                        echo "selected='true'";
                                    } ?>>Alappuzha
                                    </option>
                                    <option value="Ernakulam" <?php if ($trip_sheet_cargosdtls[0]->place == 'Ernakulam') {
                                        echo "selected='true'";
                                    } ?>>Ernakulam
                                    </option>
                                    <option value="Idukki" <?php if ($trip_sheet_cargosdtls[0]->place == 'Idukki') {
                                        echo "selected='true'";
                                    } ?>>Idukki
                                    </option>
                                    <option value="Kannur" <?php if ($trip_sheet_cargosdtls[0]->place == 'Kannur') {
                                        echo "selected='true'";
                                    } ?>>Kannur
                                    </option>
                                    <option value="Kasaragod" <?php if ($trip_sheet_cargosdtls[0]->place == 'Kasaragod') {
                                        echo "selected='true'";
                                    } ?>>Kasaragod
                                    </option>
                                    <option value="Kollam" <?php if ($trip_sheet_cargosdtls[0]->place == 'Kollam') {
                                        echo "selected='true'";
                                    } ?>>Kollam
                                    </option>
                                    <option value="Kottayam" <?php if ($trip_sheet_cargosdtls[0]->place == 'Kottayam') {
                                        echo "selected='true'";
                                    } ?>>Kottayam
                                    </option>
                                    <option value="Kozhikode" <?php if ($trip_sheet_cargosdtls[0]->place == 'Kozhikode') {
                                        echo "selected='true'";
                                    } ?>>Kozhikode
                                    </option>
                                    <option value="Malappuram" <?php if ($trip_sheet_cargosdtls[0]->place == 'Malappuram') {
                                        echo "selected='true'";
                                    } ?>>Malappuram
                                    </option>
                                    <option value="Palakkad" <?php if ($trip_sheet_cargosdtls[0]->place == 'Palakkad') {
                                        echo "selected='true'";
                                    } ?>>Palakkad
                                    </option>
                                    <option value="Pathanamthitta" <?php if ($trip_sheet_cargosdtls[0]->place == 'Pathanamthitta') {
                                        echo "selected='true'";
                                    } ?>>Pathanamthitta
                                    </option>
                                    <option value="Thiruvananthapuram" <?php if ($trip_sheet_cargosdtls[0]->place == 'Thiruvananthapuram') {
                                        echo "selected='true'";
                                    } ?>>Thiruvananthapuram
                                    </option>
                                    <option value="Thrissur" <?php if ($trip_sheet_cargosdtls[0]->place == 'Thrissur') {
                                        echo "selected='true'";
                                    } ?>>Thrissur
                                    </option>
                                    <option value="Wayanad" <?php if ($trip_sheet_cargosdtls[0]->place == 'Wayanad') {
                                        echo "selected='true'";
                                    } ?>>Wayanad
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="dropdown float-left">
                            <label for="example-select">Mob.Number</label>
                            <div>
                                <input type="text" class="form-control" name="mobilenumber"
                                       placeholder="Enter mobile Number.."
                                       value="<?= $trip_sheet_cargosdtls[0]->mobilenumber ?>">
                            </div>
                        </div>
                        <div class="dropdown float-left">
                            <label for="example-select">&nbsp;</label>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-secondary">
                                    <i class="si si-pencil"></i>
                                </button>
                            </div>
                        </div> */ ?>

                    </form>
                </div>
                <!-- <div class="pl-10 pt-5">Cargos Data</div> -->
                <?php
            } else {
                ?>
                <div class="float-right">
                    <form action="<?= base_url() ?>trip_sheet_admin/cargo_create_process" method="post" name="myxfrm"
                          enctype="multipart/form-data" >
                        <input type="hidden" name="trip_sheet_id" value="<?= $this->uri->segment(3) ?>">
                        <input name="is_transfer" id="is_transfer" type="hidden">
                        <input name="transfer_status" id="transfer_status" type="hidden">
                        <input name="tracking_no" id="tracking_no" type="hidden">

                        


                        <div class="dropdown float-left" style="display: none;">
                            <label for="example-select">Status</label>
                            <div>
                                <select class="form-control" id="status" name="status">
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <?php /*

                        <div class="dropdown float-left">
                            <label for="example-select">Company Name</label>
                            <div>
                                 
                                <input type="text" id="cargo_name" class="form-control" name="cargo_name">
                               
                                
                                
                            </div>

                        </div>
                        <div class="dropdown float-left" style="width: 134px;">
                            <label for="example-select">Tracking Number</label>
                            <div>
                                 
                                       <select id="inv_num" class="form-control" autofocus="true" name="tracking_number"
                                       placeholder="Enter Tracking Number.." onchange="display_details()">
                                        <option value=""></option>
                                                            <?php
                                                            if($details!=null)
                                                            {
                                                            foreach ($details as $key => $detailss) {
                                                            ?>
                                                            <option value="<?=$detailss->id?>"><?=$detailss->tracking_n0?></option>
                                                            <?php
                                                            }
                                                            }
                                                            ?> 
                                        </select> 
                                        <input type="hidden" name="invhid" id="invhid">
                            </div>
                        </div>
                        <div class="dropdown float-left" style="width: 67px;">
                            <label for="example-select">PCs</label>
                            <div>
                                <input type="text" id="qty" class="form-control" name="quantity" placeholder="Enter quantity.."
                                       value="">
                            </div>
                        </div>
                        <div class="dropdown float-left" style="width: 67px;">
                            <label for="example-select">Weight</label>
                            <div>
                                <input type="text" class="form-control" id="weight" name="weight" placeholder="Enter weight.."
                                       value="">
                            </div>
                        </div>
                        <div class="dropdown float-left" style="width: 129px;">
                            <label for="example-select">DISTRICT</label>
                            <div>
                                <!--<select class="form-control" id="place" name="place">-->
                                <!--    <option value="Alappuzha">Alappuzha</option>-->
                                <!--    <option value="Ernakulam">Ernakulam</option>-->
                                <!--    <option value="Idukki">Idukki</option>-->
                                <!--    <option value="Kannur">Kannur</option>-->
                                <!--    <option value="Kasaragod">Kasaragod</option>-->
                                <!--    <option value="Kollam">Kollam</option>-->
                                <!--    <option value="Kottayam">Kottayam</option>-->
                                <!--    <option value="Kozhikode">Kozhikode</option>-->
                                <!--    <option value="Malappuram">Malappuram</option>-->
                                <!--    <option value="Palakkad">Palakkad</option>-->
                                <!--    <option value="Pathanamthitta">Pathanamthitta</option>-->
                                <!--    <option value="Thiruvananthapuram">Thiruvananthapuram</option>-->
                                <!--    <option value="Thrissur">Thrissur</option>-->
                                <!--    <option value="Wayanad">Wayanad</option>-->
                                <!--</select>-->
                            <input type="text" id="district" class="form-control" name="place" 
                                       >    
                                
                            </div>
                        </div>
                        <div class="dropdown float-left">
                            <label for="example-select">Mob.Number</label>
                            <div>
                                <input type="text" id="mobile" class="form-control" name="mobilenumber"
                                       placeholder="Enter mobile Number" value="">
                            </div>
                        </div>
                        <div class="dropdown float-left">
                            <label for="example-select">&nbsp;</label>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-secondary">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>

                            */ ?>
                        </div>
                    </form>

                </div>
                <!-- <div class="pl-10 pt-5">Cargos Data</div> -->
                <?php
            }
            ?>  

            <hr>
            <div class="block-content">
                <div class="table-responsive">
                    <div id="ermsg"> <?php //$this->session->flashdata('ermsg'); ?>  </div>
                    
                    <table class="table table-striped table-vcenter">
                        <thead>
                        <tr>
                            <th> <input type="checkbox" id="selectAll" /> Select All </th>            
                            <th>Sl No.</th> 
                            <th>Cargo Name</th>
                            <th>Tracking Number</th>
                            <th>Trip Number</th>
                            <th># No</th>
                            <th>Invoice Number</th>
                            <th>PCs</th>
                            <th>Weight</th>
                            <th>District</th>
                            <th>Mob.Number</th>
                            <th>Status</th>

                            <th class="text-center" style="width: 100px;">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php


                        if ($result != null) {
                            $total_cnt = 0;
                            $total_pcs = 0;
                            $total_weight = 0;
                            foreach ($result as $key => $resultvlu) {
                                $total_cnt =  $total_cnt+1;
                                if($resultvlu->quantity != ''){
                                    $total_pcs = $total_pcs + $resultvlu->quantity; 
                                } 

                                if($resultvlu->weight != ''){
                                    $total_weight = $total_weight + $resultvlu->weight; 
                                }
                                // $total_pcs = $total_pcs + $resultvlu->quantity;
                                // $total_weight = $total_weight + $resultvlu->weight;
                                ?>
                                <tr>
                                    <td align="center">
                                    <input type="checkbox" name="bene_id[]" class="checkbox-item" id="1"   value="<?=$resultvlu->invoice_number?>" />
                                    </td> 
                                     <td><?=$key+1?></td> 
                                    <td>
                                        <b><?= $resultvlu->cargo_name ?></b>
                                    </td>
                                    <td>
                                        <b><?= $resultvlu->tracking_no ?></b>
                                    </td>
                                    <td>
                                        <b><?= $resultvlu->trip_no ?></b>
                                    </td>
                                    <td>
                                        <b><?= $resultvlu->boxno ?></b>
                                    </td>
                                    <td>
                                        <b><?= $resultvlu->invoice_number ?></b>
                                    </td>
                                    <td>
                                        <b><?= $resultvlu->quantity ?></b>
                                    </td>
                                    <td>
                                        <b><?= $resultvlu->weight ?></b>
                                    </td>
                                    <td>
                                        <b><?= $resultvlu->place ?></b>
                                    </td>
                                    <td>
                                        <b><?= $resultvlu->mobilenumber ?></b>
                                    </td>
                                    <td>
                                        <b><?php
                      
                                

                                            if ($resultvlu->status == 0) {
                                                ?>
                                                <button onclick="showStatusModel(<?= $this->uri->segment(3) ?>,<?= $resultvlu->id ?>,<?= $resultvlu->status ?>,`<?= $resultvlu->message ?>`,`<?= $resultvlu->invoice_number ?>`, `<?= $resultvlu->tracking_no ?>`)"
                                                        class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                                        title="Change Status">
                                                    On the Way
                                                </button>
                                                <?php
                                            } elseif ($resultvlu->status == 1) {
                                                ?>
                                                <button onclick="showStatusModel(<?= $this->uri->segment(3) ?>,<?= $resultvlu->id ?>,<?= $resultvlu->status ?>,
                                                        `<?= $resultvlu->message ?>`,`<?= $resultvlu->invoice_number ?>`, `<?= $resultvlu->tracking_no ?>`)"
                                                        class="btn btn-sm btn-primary" data-toggle="tooltip"
                                                        title="Change Status">
                                                    Out for Delivery
                                                </button>
                                                <?php
                                            } elseif ($resultvlu->status == 2) {
                                                ?>
                                                <button onclick="showStatusModel(<?= $this->uri->segment(3) ?>,<?= $resultvlu->id ?>,<?= $resultvlu->status ?>,
                                                        `<?= $resultvlu->message ?>`,`<?= $resultvlu->invoice_number ?>`, `<?= $resultvlu->tracking_no ?>`)"
                                                        class="btn btn-sm btn-info" data-toggle="tooltip"
                                                        title="Change Status">
                                                    In Transit
                                                </button>
                                                <?php
                                            } elseif ($resultvlu->status == 3) {
                                                ?>
                                                <button onclick="showStatusModel(<?= $this->uri->segment(3) ?>,<?= $resultvlu->id ?>,<?= $resultvlu->status ?>,
                                                        `<?= $resultvlu->message ?>`,`<?= $resultvlu->invoice_number ?>`, `<?= $resultvlu->tracking_no ?>`)"
                                                        class="btn btn-sm btn-success" data-toggle="tooltip"
                                                        title="Change Status">
                                                        Delivered
                                                </button>
                                                <?php
                                           } elseif ($resultvlu->status == 4) {
                                            ?>
                                            <button onclick="showStatusModel(<?= $this->uri->segment(3) ?>,<?= $resultvlu->id ?>,<?= $resultvlu->status ?>,
                                                    `<?= $resultvlu->message ?>`,`<?= $resultvlu->invoice_number ?>`, `<?= $resultvlu->tracking_no ?>`)"
                                                    class="btn btn-sm btn-warning" data-toggle="tooltip"
                                                    title="Change Status">
                                                    Pending
                                            </button>
                                            <?php
                                        } elseif ($resultvlu->status == 5) {
                                            ?>
                                            <button onclick="showStatusModel(<?= $this->uri->segment(3) ?>,<?= $resultvlu->id ?>,<?= $resultvlu->status ?>,
                                                    `<?= $resultvlu->message ?>`,`<?= $resultvlu->invoice_number ?>`, `<?= $resultvlu->tracking_no ?>`)"
                                                    class="btn btn-sm btn-danger" data-toggle="tooltip"
                                                    title="Change Status">
                                                    Not Delivered
                                            </button>
                                            <?php
                                        }
                                        elseif ($resultvlu->status == 6) {
                                            ?>
                                            <button onclick="showStatusModel(<?= $this->uri->segment(3) ?>,<?= $resultvlu->id ?>,<?= $resultvlu->status ?>,
                                                    `<?= $resultvlu->message ?>`,`<?= $resultvlu->invoice_number ?>`, `<?= $resultvlu->tracking_no ?>`)"
                                                    class="btn btn-sm btn-danger" data-toggle="tooltip"
                                                    title="Change Status">
                                                   Recheck
                                            </button>
                                            <?php
                                        }
                                            

                                            ?></b>
                                    </td>

                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="<?= base_url() ?>trip_sheet_admin/cargos_delete_process/<?= $this->uri->segment(3) ?>/<?= $resultvlu->id ?>"
                                               class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete Cargo">
                                                <i class="si si-trash"></i>
                                            </a>
                                            <a href="<?= base_url() ?>trip_sheet_admin/cargos/<?= $this->uri->segment(3) ?>/<?= $resultvlu->id ?>"
                                               class="btn btn-sm btn-success" data-toggle="tooltip"
                                               title="Update Values">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>

                            <tr style="font-weight:bold">
                                <td colspan="5"> Total Count :<?= $total_cnt ?> </td> <td colspan="4">Total Pcs: <?= $total_pcs ?></td> <td colspan="5">Total Weight : <?= $total_weight ?></td>
                                </tr>
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
                    </div>
                </div>
            </div>
        </div>
        <!-- END Full Table -->

    </div>
    <!-- END Page Content -->

    <div id="asignModel" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="text-center">Update Status</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body" id="model">
                    <form class="form-horizontal form-label-left ajaxModel" method="post"
                          action="<?= base_url() ?>trip_sheet_admin/cargo_change_status" enctype = multipart/form-data>

                        <div class="form-group dropdown">
                            <label for="example-select">Status</label>
                            <div>
                                <select class="form-control" onchange="onStatusChange(this);" id="stat" name="status">
                                    <option value="0">On the Way</option>
                                    <option value="1">Out for Delivery</option>    
                                    <option value="2">In Transit</option>    
                                    <option value="3">Delivered</option>
                                    <option value="4">Pending</option>
                                    <option value="5">Not Delivered</option>
                                    <option value="6">Recheck</option>
                                    
                                    
                                </select>
                            </div>
                        </div>

                        <div class="file" id="fileDiv" style="display:none">
                            <label for="file-uplod">File</label>
                            <div>
                            <input type="file" id="file" name="file" accept="">
                            </div>
                        </div>


                        <div class="file" id="deliveryDate" style="display:none">
                            <label for="deliveryDate">Delivery Date</label>
                            <div>
                            <input type="date" class="form-control"  name="deliveryDate" id='deliveryDate' placeholder="Delivery Date..">
                            </div>
                        </div>
 


                        <div class="file" id="intransitDiv"   style="display:none" >
                            <label for="intransit">Url</label>
                            <div>
                            <input type="text" id="intransit" name="in_transit_url" class="form-control">
                            </div>
                        </div>

                        <div class="dropdown" id="commentDiv">
                            <label for="example-select">Comment</label>
                            <div>
                                <textarea class="form-control" name="comment" id="comment"
                                          placeholder="Enter Comment"></textarea>
                            </div>
                        </div>
                        <input name="cargo_id" id="cargo_id" type="hidden">
                        <input name="invoiceno" id="invoice_no" type="hidden">
                        <input name="tripsheet_id" id="tripsheet_id" type="hidden">
                        <input name="tracking_no" id="tracking_no" type="hidden">
                       
                        <div class="form-group">

                            <br/>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                            <button type="submit"  class="btn btn-success">Submit</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <div id="asignModelSelected" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="text-center">Update Status</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body" id="model">
                    <form class="form-horizontal form-label-left ajaxModel" method="post"
                          action="<?= base_url() ?>trip_sheet_admin/cargo_change_status_selected" enctype = multipart/form-data>

                        <div class="form-group dropdown">
                            <label for="example-select">Status</label>
                            <div>
                                <select class="form-control" onchange="onStatusChange(this);" id="sel_stat" name="sel_status">
                                    <option value="0">On the Way</option>
                                    <option value="1">Out for Delivery</option>    
                                    <option value="2">In Transit</option>    
                                    <option value="3">Delivered</option>
                                    <option value="4">Pending</option>
                                    <option value="5">Not Delivered</option>
                                    <option value="6">Recheck</option>

                                    
                                    
                                </select>
                            </div>
                        </div>

                        <div class="file" id="fileDiv" style="display:none">
                            <label for="file-uplod">File</label>
                            <div>
                            <input type="file" id="sel_file" name="sel_file" accept="">
                            </div>
                        </div>

                        <div class="file" id="intransitDiv"   style="display:none" >
                            <label for="intransit">Url</label>
                            <div>
                            <input type="text" id="intransit" name="in_transit_url" class="form-control">
                            </div>
                        </div>

                        <div class="dropdown" id="sel_commentDiv">
                            <label for="example-select">Comment</label>
                            <div>
                                <textarea class="form-control" name="sel_comment" id="sel_comment"
                                          placeholder="Enter Comment"></textarea>
                            </div>
                        </div>
                        <input name="sel_cargo_id" id="sel_cargo_id" type="hidden">
                        <input name="sel_invoiceno" id="sel_invoice_no" type="hidden">
                        <input name="sel_tripsheet_id" id="sel_tripsheet_id" type="hidden">
                        <div class="form-group">

                            <br/>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                            <button type="submit"  class="btn btn-success">Submit</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        $('#selectAll').click(function (e) {
            $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
        });

        var $checkboxes = $('.checkbox-item');
        $('.checkbox-item').change(function(){
        var checkboxesLength = $checkboxes.length;
        var checkedCheckboxesLength = $checkboxes.filter(':checked').length;
        if(checkboxesLength == checkedCheckboxesLength) {
            $('#selectAll').prop('checked', true);
        }else{
            $('#selectAll').prop('checked', false);
        }
        });
    </script>


    <script>
        $(document).ready(function(){
           
$('#inv_num').select2({
                placeholder: 'Enter Tracking Number..',
                minimumInputLength: 2,
                ajax: {
                    url:'<?php echo base_url() ?>trip_sheet_admin/get_invoices',
                    dataType: 'json',
                    delay: 250,
                    type:'POST',
                    data: function (params) {
                        return {
                            input: params.term // search term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.tracking_no
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
        });

    </script>


    <script>



        function showStatusModel(tripsheet_id, cargo_id_val, status, comment, invoice_no, tracking_no) {
            window.cargo_id_val = cargo_id_val;
            document.getElementById("cargo_id").value = cargo_id_val;
            if (status == 0) {
                $("#asignModel").find("#commentDiv").css({"display": "none"});
            }
            if (status == 1) {
                $("#asignModel").find("#commentDiv").css({"display": "inline"});
            }
            if (status == 2) {
                $("#asignModel").find("#commentDiv").css({"display": "inline"});
            }
            $("#asignModel").find("#stat").val(status);
            $("#asignModel").find("#comment").val(comment);
            $("#asignModel").find("#invoice_no").val(invoice_no);
            $("#asignModel").find("#tripsheet_id").val(tripsheet_id);    
            $("#asignModel").find("#tracking_no").val(tracking_no); 

            $('#asignModel').modal('show', {backdrop: 'true'});


        }


        function showAllStatusModel( ) {

            var checkValues = $('.checkbox-item:checked').map(function()
            {
                return $(this).val();
            }).get();

            document.getElementById("sel_cargo_id").value = checkValues; 
            var trip_sheet_id = document.getElementById("trip_sheet_id").value; 

            if (status == 0) {
                $("#asignModelSelected").find("#sel_commentDiv").css({"display": "none"});
            }
            if (status == 1) {
                $("#asignModelSelected").find("#sel_commentDiv").css({"display": "inline"});
            }
            if (status == 2) {
                $("#asignModelSelected").find("#sel_commentDiv").css({"display": "inline"});
            }
            $("#asignModelSelected").find("#sel_stat").val(status);
            $("#asignModelSelected").find("#sel_comment").val('');
            $("#asignModelSelected").find("#sel_invoice_no").val('');
            $("#asignModelSelected").find("#sel_tripsheet_id").val(trip_sheet_id);            
            $('#asignModelSelected').modal('show', {backdrop: 'true'});


        }


        function onStatusChange(sel) {
            var value = sel.value;
            // alert(value);
            if (value == 0) {
                $("#asignModel").find("#commentDiv").css({"display": "none"});
            }
            if (value == 1 || value == 5 ) {
                $("#asignModel").find("#commentDiv").css({"display": "inline"});
            }
            if (value == 2) {
                $("#asignModel").find("#commentDiv").css({"display": "inline"});
                $("#asignModel").find("#intransitDiv").css({"display": "inline"});                
            }
            else {
                $("#asignModel").find("#intransitDiv").css({"display": "none"});
            }

            if( value == 3 ){
                
                $("#asignModel").find("#fileDiv").css({"display": "block"});
                $("#asignModel").find("#deliveryDate").css({"display": "block"});
                
            }
            else {
                $("#asignModel").find("#fileDiv").css({"display": "none"});

            }
        }
    </script>
    
    <script>
       function display_details(){
           
           var inv = jQuery("#inv_num").val(); 
           var invt = $("#inv_num option:selected").html();
           $.ajax({
    
		url:'<?php echo base_url() ?>trip_sheet_admin/display_details',
		data:{inv:inv},
		dataType : 'json',
		type:'POST',
		success:function(data){
		    
			// console.log(data);
            jQuery('#qty').val(data[0].pcs);
            jQuery('#weight').val(data[0].weight);
            jQuery('#district').val(data[0].district);
            jQuery('#mobile').val(data[0].phone);
            jQuery('#invhid').val(invt);
            jQuery('#cargo_name').val(data[0].company);
            jQuery('#cargo_id').val(data[0].company);
            jQuery('#is_transfer').val(data[0].is_transfer);
            jQuery('#transfer_status').val(data[0].transfer_status);
            jQuery('#tracking_no').val(data[0].tracking_no);

            

            
		}
    });
           
       }
    </script>
  <script>
  jQuery(document).ready(function() {

    // $('#inv_num').select2();
    // jQuery('.js-example-basic-single').select2();
    
    // jQuery('#inv_num').select2('open');


});


  </script>  
</main>
<!-- END Main Container -->