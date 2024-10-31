<main id="main-container">
<!--add-->
    <?php
    if (isset($error)) {
        echo "<script>alert('$error');</script>";
    } ?>
<!--end-->
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Goods details</h2>

        <!-- Full Table -->
        <div class="block">
            <div class="block-content">
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Add Goods details</h3>
                    </div>
                    <div class="block-content">
                        <form action="<?= base_url() ?>goods_details/create_process" method="post" name="myxfrm"
                              enctype="multipart/form-data" onsubmit="return validateForm();">
                            <div id="ermsg"> <?= $this->session->flashdata('msgx'); ?>  </div>
                            <div class="form-group">
                                <label for="example-select">Invoice Number</label>
                                <div>
                                    <input type="text" class="form-control" name="invoiceno"
                                           placeholder="Enter Invoice Number.." value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-select">Date</label>
                                <div>
                                    <input type="text" class="form-control" name="datex" placeholder="date.." value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-select">District</label>
                                <div>
                                    <select class="form-control" id="district" name="district">
                                        <option value="Alappuzha">Alappuzha</option>
                                        <option value="Ernakulam">Ernakulam</option>
                                        <option value="Idukki">Idukki</option>
                                        <option value="Kannur">Kannur</option>
                                        <option value="Kasaragod">Kasaragod</option>
                                        <option value="Kollam">Kollam</option>
                                        <option value="Kottayam">Kottayam</option>
                                        <option value="Kozhikode">Kozhikode</option>
                                        <option value="Malappuram">Malappuram</option>
                                        <option value="Palakkad">Palakkad</option>
                                        <option value="Pathanamthitta">Pathanamthitta</option>
                                        <option value="Thiruvananthapuram">Thiruvananthapuram</option>
                                        <option value="Thrissur">Thrissur</option>
                                        <option value="Wayanad">Wayanad</option>
                                        <option value="Other state" selected>Other State</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-select">Company</label>
                                <div>
                                    <input type="text" class="form-control" name="company" placeholder="Enter company.."
                                           value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-select">Header</label>
                                <div>
                                    <input type="file" class="form-control" name="header" id="header" required>
                                </div>
                                <p>File size: 1500*250px</p>
                            </div>
                            <div class="form-group">
                                <label for="example-select">Address</label>
                                <div>
                                    <textarea class="form-control" name="address"
                                              placeholder="Enter address.."></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-select">Pcs</label>
                                <div>
                                    <input type="text" class="form-control" name="pcs" placeholder="Enter pcs.."
                                           value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-select">Weight</label>
                                <div>
                                    <input type="text" class="form-control" name="weight" placeholder="Enter weight.."
                                           value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-select">Ship.Name</label>
                                <div>
                                    <input type="text" class="form-control" name="shipmentname"
                                           placeholder="Enter shipment name.." value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-select">Sending Date</label>
                                <div>
                                    <input type="text" class="form-control" name="sendingdate"
                                           placeholder="sending date.." value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-select">Recciev.Date</label>
                                <div>
                                    <input type="text" class="form-control" name="recievingdate"
                                           placeholder="reciev.date.." value="">
                                    <input type="hidden" name="branch_id" value="<?= $this->session->userdata['adminloginel']['id'] ?>" />

                                </div>
                            </div>

                            <div class="form-group">
                                <a href="<?= base_url() ?>goods_details" class="btn btn-alt-primary">Back</a> &nbsp;<button
                                        type="submit" class="btn btn-alt-success">Complete
                                </button>
                            </div>
                        </form>
                        <!--                                    <form method="post" action="-->
                        <? //=base_url('goods_details/create_process')?><!--" enctype="multipart/form-data">-->
                        <!--                                        <input type="file" id="profile_image" name="profile_image" size="33" />-->
                        <!--                                        <input type="submit" value="Upload Image" />-->
                        <!--                                    </form>-->
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

