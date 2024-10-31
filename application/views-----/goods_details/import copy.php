<main id="main-container">

    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Goods details</h2>

        <!-- Full Table -->
        <div class="block">
            <div class="block-content">
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Import Goods details</h3>
                    </div>
                    <div class="block-content">
                        <form action="<?= base_url() ?>goods_details/import_process" method="post" name="myxfrm"
                              enctype="multipart/form-data" onsubmit="return validateForm();">
                            <div id="ermsg" class="col-4"> <?= $this->session->flashdata('msgx'); ?>  </div>

                            <div class="form-group">
                                <label for="tripno">Trip No / Shipment No</label>
                                <div>
                                    <input type="text" class="form-control  col-4" name="trip_no" placeholder="Enter trip no"
                                           required>
                                </div>
                                <span class="error"><?php echo form_error('trip_no'); ?></span>
                            </div>

                            <div class="form-group">
                                <label for="tripno">Date</label>
                                <div>
                                    <input type="date" class="form-control col-4" name="clearence_date" placeholder="Enter clearence_date"
                                           required>
                                </div>
                                <span class="error"><?php echo form_error('clearence_date'); ?></span>
                            </div>


                            <div class="form-group">
                                <label for="example-select">CSV File</label>
                                <div>
                                    <input type="file" class="form-control  col-4" name="upload_file" placeholder="Enter pcs.."
                                           required>
                                </div>
                                <span class="error"><?php echo form_error('name'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="example-select">Header</label>
                                <div> 
                                <select name="cargo_id" id="cargo_id"  class="form-control  col-4" required> 
                                <?php foreach($cargos_arr as $cargo) { ?>
                                    <option value="<?=$cargo->id?>"> <?=$cargo->cargo_name?> </option>                                
                                <?php } ?>
                                </select>
<!-- 
                                    <input type="file" class="form-control" name="upload_header" id="upload_header"
                                           required> -->
                                </div>
                                <!-- <p>File size: 1500*250px</p> -->
                                <span class="error"><?php echo form_error('name'); ?></span>
                            </div>



                            <div class="form-group">
                                <a href="<?= base_url() ?>goods_details" class="btn btn-alt-primary">Back</a> &nbsp;<button
                                        type="submit" class="btn btn-alt-success">Import Data
                                </button>
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
        var file_image = document.forms["myxfrm"]["file_image"].value;
        if (file_image == null || file_image == "" || file_image == 0) {
            document.getElementById("ermsg").innerHTML = "<div class='alert alert-danger'><span data-dismiss='alert' class='close' onclick=this.parentElement.style.display='none';>&times;</span><i class='fa fa-times-circle'></i>Select Image</div>";
            //   $('html, body').animate({scrollTop: ($('#url').first().offset().top-150)},"slow");
            $("html, body").animate({scrollTop: 0}, "slow");
            return false;
        }
        document.getElementById('lod').style.display = "block";
        document.getElementById('submit').disabled = true;
    }
</script>