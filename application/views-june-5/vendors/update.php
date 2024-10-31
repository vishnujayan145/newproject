<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Update Vendor</h4>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                        <form action="<?=base_url()?>vendors/update_process" method="post" name="myxfrm" enctype="multipart/form-data" onsubmit="return validateForm();">
                                            <div id="ermsg"> <?= $this->session->flashdata('msgx'); ?>  </div>
                                        <input type="hidden" name="uid" value="<?=$id?>">

                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Vendor Name</label>
                                            <div class="col-md-10">
                                            <input type="text" class="form-control"  name="branch_name" id='branch_name' value="<?=$branch_name?>" placeholder="Vendor name..">

                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Username</label>
                                            <div class="col-md-10">
                                            <input type="text" class="form-control"  name="username" id='username' placeholder="Username" value="<?=$username?>" autocomplete="off">                                            

                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Email</label>
                                            <div class="col-md-10">
                                            <input type="text" class="form-control"  name="email" id='email' placeholder="Email id"  value="<?=$email?>" autocomplete="off">                                            


                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Password</label>
                                            <div class="col-md-10">
                                            <input type="password" class="form-control"  name="password" id='password' placeholder="Enter password">

                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Location</label>
                                            <div class="col-md-10">
                                            <input type="text" class="form-control"  name="location" id='location' value="<?=$location?>" placeholder="Location">
                                            </div>
                                        </div> 

                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Mobile</label>
                                            <div class="col-md-10">
                                            <input type="text" class="form-control"  name="mobile" id='mobile'  value="<?=$mobile?>" placeholder="Mobile">
                                            </div>
                                        </div>


                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Authorized Person</label>
                                            <div class="col-md-10">
                                            <input type="text" class="form-control"  name="authorized_person" id='authorized_person'  value="<?=$authorized_person?>" placeholder="Authorized Person">

                                            </div>
                                        </div>
                                        

                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Status</label>
                                            <div class="col-md-10">
                                            <select class="form-control" id="status1" name="status">
                                                    <option value="0" <?php if($status=='0'){ echo "selected='true'"; } ?> >Active</option>
                                                    <option value="1" <?php if($status=='1'){ echo "selected='true'"; } ?> >Inactive</option>
                                                </select>
                                            </div>
                                        </div> 

                                         
                                        <div class="">
                                        <a href="<?=base_url()?>vendors" class="btn btn-primary">Back</a> &nbsp;
                                            <a href="<?=base_url()?>vendors/delete_process/<?=$id?>" class="btn btn-danger mr-2">Delete</a>&nbsp;<button type="submit" class="btn btn-success">Update Now</button>

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



 