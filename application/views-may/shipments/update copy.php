<main id="main-container">
    <div class="content">
        <h2 class="content-heading">Shipment</h2> 
            <div class="block">
                <div class="block-content">
                    <div class="block">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Update Shipment</h3>
                        </div>

        <div class="block-content"> 
            <form action="<?=base_url()?>shipment/update_process" method="post" name="myxfrm" enctype="multipart/form-data" onsubmit="return validateForm();">
                    <div id="ermsg"> <?= $this->session->flashdata('msgx'); ?>  </div>
                    <input type="hidden" name="uid" value="<?=$id?>">

                <div class="row">
                    <div class="col-12 col-md-12">
                        <div id="subloader" style="display: none;"></div>
                        <div id="error_id"></div>
                    </div>

                    <div class="col-12 col-md-12">
                        <div class="block-header block-header-default">
                            <h3 class="block-title"><b>Shipment Details</b></h3>
                        </div>
                    </div>
                </div>  
                <div class="row">
                    <div class="col-6 col-md-6">
                        <div class="form-group">
                            <label for="example-nf-email">Shiment name</label>
                            <input type="text" class="form-control"  name="name" id='name' placeholder="Trip Date.." value="<?=$name?>">
                        </div>
                    </div> 
                </div> 
                    
                <div class="row">
                    <div class="col-6 col-md-6">
                        <div class="form-group">
                            <label for="example-nf-email">Clearence Date</label>
                            <input type="date" class="form-control"  name="clearence_date" id='clearence_date' placeholder="Trip Date.." value="<?=$clearence_date?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6 col-md-6">
                        <div class="form-group">
                            <label for="example-nf-email">Header</label> 
                            <select class="form-control select2" id="cargo_id" name="cargo_id"  >
                                <option value="0">Select Cargo</option>
                                <?php
                                if (!empty($cargos_arr)) {
                                    foreach ($cargos_arr as $key => $vendorvlu) {
                                        ?>
                                        <option value="<?= $vendorvlu->id ?>"  <?php if($cargo_id==$vendorvlu->id){ echo "selected='true'"; } ?> ><?= $vendorvlu->cargo_name ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                                     
                        </div>
                    </div> 
                </div> 
                <div class="row mt-20">
                    <div class="col-12 col-md-12"  >
                        <div class="form-group">
                            <a href="<?=base_url()?>Shipment" class="btn btn-alt-primary">Back</a> &nbsp;
                            <a href="<?=base_url()?>trip_sheet/delete_process/<?=$id?>" class="btn btn-danger mr-2">Delete</a>&nbsp;<button type="submit" class="btn btn-alt-success">Update Now</button>
                        </div>
                    </div> 
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
<script type="text/javascript">

</script>