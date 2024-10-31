<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Import Goods details</h4> 

                    </div>
                </div>
            </div>
            <!-- end page title -->

            

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                        <form action="<?= base_url() ?>goods_details/import_process" method="post" name="myxfrm"
                              enctype="multipart/form-data" onsubmit="return validateForm();">
                            <div id="ermsg" class="col-4"> <?= $this->session->flashdata('msgx'); ?>  </div>
                             
 

                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Trip No / Shipment No</label>
                                            <div class="col-md-5">
                                            <input type="text" class="form-control  col-4" name="trip_no" placeholder="Enter trip no"
                                           required> 
                                            </div>
                                            <span class="error"><?php echo form_error('trip_no'); ?></span>
                                        </div> 
 

                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Date</label>
                                            <div class="col-md-5">
                                            <input type="date" class="form-control" name="clearence_date" placeholder="Enter clearence_date"
                                           required>
                                            </div>
                                            <span class="error"><?php echo form_error('clearence_date'); ?></span>
                                        </div>


                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">CSV File</label>
                                            <div class="col-md-5">
                                            <input type="file" class="form-control" name="upload_file" placeholder="Enter pcs.."
                                           required>
                                            </div>
                                            <span class="error"><?php echo form_error('name'); ?></span>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Header</label>
                                            <div class="col-md-5">
                                           
                                            <select name="cargo_id" id="cargo_id"  class="form-control" required> 
                                                <?php foreach($cargos_arr as $cargo) { ?>
                                                    <option value="<?=$cargo->id?>"> <?=$cargo->cargo_name?> </option>                                
                                                <?php } ?>
                                            </select>
                                            </div>
                                            <span class="error"><?php echo form_error('clearence_date'); ?></span>
                                        </div> 

                                         
                                        <div class="">
                                            <a href="<?=base_url()?>goods_details" class="btn btn-primary">Back</a> &nbsp;<button type="submit" class="btn btn-success">Import Data</button>
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
