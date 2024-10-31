<main id="main-container">

                <!-- Page Content -->
                <div class="content">
                    <h2 class="content-heading">Vehicles</h2>

                    <!-- Full Table -->
                    <div class="block">
                        <div class="block-content">
                            <div class="block">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">Update Vehicle</h3>
                                </div>
                                <div class="block-content">
                                     <form action="<?=base_url()?>vehicles/update_process" method="post" name="myxfrm" enctype="multipart/form-data" onsubmit="return validateForm();">
                                            <div id="ermsg"> <?= $this->session->flashdata('msgx'); ?>  </div>
                                        <input type="hidden" name="uid" value="<?=$id?>">
                                        <div class="form-group">
                                            <label for="example-nf-email">Vehicle No</label>
                                            <input type="text" class="form-control"  name="vehicle_number" id='vehicle_number' placeholder="Vehicle no.." value="<?=$vehicle_number?>">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="example-select">Vehicle Type</label>
                                            <div>
                                                <select class="form-control" id="vehicle_type" name="vehicle_type">
                                                    <option value="Bike" <?php if($vehicle_type=='Bike'){ echo "selected='true'"; } ?>>Bike</option>
                                                    <option value="Truck" <?php if($vehicle_type=='Truck'){ echo "selected='true'"; } ?>>Truck</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="example-nf-email">Driver Name</label>
                                            <input type="text" class="form-control"  name="driver_name" id='driver_name' placeholder="Driver Name.." value="<?=$driver_name?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="example-nf-email">Contact Number</label>
                                            <input type="text" class="form-control"  name="contactnumber" id='contactnumber' placeholder="Contact Number.." value="<?=$contactnumber?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="example-nf-email">Password</label>
                                            <input type="password" class="form-control"  name="password" id='password' placeholder="Password">
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
                                            <a href="<?=base_url()?>vehicles" class="btn btn-alt-primary">Back</a> &nbsp;
                                            <a href="<?=base_url()?>vehicles/delete_process/<?=$id?>" class="btn btn-danger mr-2">Delete</a>&nbsp;<button type="submit" class="btn btn-alt-success">Update Now</button>
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