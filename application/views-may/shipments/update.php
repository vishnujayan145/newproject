<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Update Shipment</h4>

                        <!-- <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                <li class="breadcrumb-item active">Form Elements</li>
                            </ol>
                        </div> -->

                    </div>
                </div>
            </div>
            <!-- end page title -->

            

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                        <form action="<?=base_url()?>shipment/update_process" method="post" name="myxfrm" enctype="multipart/form-data" onsubmit="return validateForm();">
                            <div id="ermsg"> <?= $this->session->flashdata('msgx'); ?>  </div>
                            <input type="hidden" name="uid" value="<?=$id?>">

                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Shiment name</label>
                                            <div class="col-md-4">
                                                    <input type="text" class="form-control"  name="name" id='name' placeholder="Trip Date.." value="<?=$name?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Clearence Date</label>
                                            <div class="col-md-4">
                                            <input type="date" class="form-control"  name="clearence_date" id='clearence_date' placeholder="Trip Date.." value="<?=$clearence_date?>">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Header</label>
                                            <div class="col-md-4">
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
                                         
                                        <div class="">
                                        <a href="<?=base_url()?>Shipment" class="btn btn-primary">Back</a> &nbsp;
                                         <a href="<?=base_url()?>trip_sheet/delete_process/<?=$id?>" class="btn btn-danger mr-2">Delete</a>&nbsp;<button type="submit" class="btn btn-success">Update Now</button>
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

 