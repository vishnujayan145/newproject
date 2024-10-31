<main id="main-container">

                <!-- Page Content -->
                <div class="content">
                    <h2 class="content-heading">Goods details</h2>

                    <!-- Full Table -->
                    <div class="block">
                        <div class="block-content">
                            <div class="block">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">Update Goods details</h3>
                                </div>
                                <div class="block-content">
                                     <form action="<?=base_url()?>goods_details/update_process" method="post" name="myxfrm" enctype="multipart/form-data" onsubmit="return validateForm();">
                                            <div id="ermsg"> <?= $this->session->flashdata('msgx'); ?>  </div>
                                        <input type="hidden" name="uid" value="<?=$id?>">
                                        <div class="form-group">
                                            <label for="example-select">Invoice Number</label>
                                             <div>
                                                <input type="text" class="form-control" name="invoiceno" placeholder="Enter Invoice Number.." value="<?=$invoiceno?>">
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label for="example-select">Date</label>
                                             <div>
                                                <input type="text" class="form-control" name="datex" placeholder="date.." value="<?=$date?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="example-select">District</label>
                                            <div>
                                                <select class="form-control" id="district" name="district">
                                                    <option value="Alappuzha" <?php if($district=='Alappuzha'){ echo "selected='true'"; } ?>>Alappuzha</option>
                                                    <option value="Ernakulam" <?php if($district=='Ernakulam'){ echo "selected='true'"; } ?>>Ernakulam</option>
                                                    <option value="Idukki" <?php if($district=='Idukki'){ echo "selected='true'"; } ?>>Idukki</option>
                                                    <option value="Kannur" <?php if($district=='Kannur'){ echo "selected='true'"; } ?>>Kannur</option>
                                                    <option value="Kasaragod" <?php if($district=='Kasaragod'){ echo "selected='true'"; } ?>>Kasaragod</option>
                                                    <option value="Kollam" <?php if($district=='Kollam'){ echo "selected='true'"; } ?>>Kollam</option>
                                                    <option value="Kottayam" <?php if($district=='Kottayam'){ echo "selected='true'"; } ?>>Kottayam</option>
                                                    <option value="Kozhikode" <?php if($district=='Kozhikode'){ echo "selected='true'"; } ?>>Kozhikode</option>
                                                    <option value="Malappuram" <?php if($district=='Malappuram'){ echo "selected='true'"; } ?>>Malappuram</option>
                                                    <option value="Palakkad" <?php if($district=='Palakkad'){ echo "selected='true'"; } ?>>Palakkad</option>
                                                    <option value="Pathanamthitta" <?php if($district=='Pathanamthitta'){ echo "selected='true'"; } ?>>Pathanamthitta</option>
                                                    <option value="Thiruvananthapuram" <?php if($district=='Thiruvananthapuram'){ echo "selected='true'"; } ?>>Thiruvananthapuram</option>
                                                    <option value="Thrissur" <?php if($district=='Thrissur'){ echo "selected='true'"; } ?>>Thrissur</option>
                                                    <option value="Wayanad" <?php if($district=='Wayanad'){ echo "selected='true'"; } ?>>Wayanad</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="example-select">Company</label>
                                             <div>
                                                <input type="text" class="form-control" name="company" placeholder="Enter company.." value="<?=$company?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="example-select">Address</label>
                                             <div>
                                                <textarea class="form-control" name="address" placeholder="Enter address.."><?=$address?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="example-select">Pcs</label>
                                             <div>
                                                <input type="text" class="form-control" name="pcs" placeholder="Enter pcs.." value="<?=$pcs?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="example-select">Weight</label>
                                             <div>
                                                <input type="text" class="form-control" name="weight" placeholder="Enter weight.." value="<?=$weight?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="example-select">Ship.Name</label>
                                             <div>
                                                <input type="text" class="form-control" name="shipmentname" placeholder="Enter shipment name.." value="<?=$shipmentname?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="example-select">Sending Date</label>
                                             <div>
                                                <input type="text" class="form-control" name="sendingdate" placeholder="sending date.." value="<?=$sendingdate?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="example-select">Recciev.Date</label>
                                             <div>
                                                <input type="text" class="form-control" name="recievingdate" placeholder="reciev.date.." value="<?=$recievingdate?>">
                                                <input type="hidden" name="branch_id" value="<?=$branch_id?>" />
                                            </div>
                                        </div> 

                                        <div class="form-group">
                                            <a href="<?=base_url()?>goods_details" class="btn btn-alt-primary">Back</a> &nbsp;
                                            <a href="<?=base_url()?>goods_details/delete_process/<?=$id?>" class="btn btn-danger mr-2">Delete</a>&nbsp;<button type="submit" class="btn btn-alt-success">Update Now</button>
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