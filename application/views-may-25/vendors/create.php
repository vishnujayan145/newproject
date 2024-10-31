<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Add Vendor</h4>

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

                                        <form action="<?=base_url()?>vendors/create_process" method="post" name="myxfrm" enctype="multipart/form-data" onsubmit="return validateForm();">
                                            <div id="ermsg"> <?= $this->session->flashdata('msgx'); ?>  </div>

                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Vendor Name</label>
                                            <div class="col-md-10">
                                            <input type="text" class="form-control"  name="branch_name" id='branch_name' placeholder="Vendor name..">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Username</label>
                                            <div class="col-md-10">
                                            <input type="text" class="form-control"  name="username" id='username' placeholder="Username" autocomplete="off">     
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Email</label>
                                            <div class="col-md-10">
                                            <input type="text" class="form-control"  name="email" id='email' placeholder="Email id" autocomplete="off">                                            

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
                                            <input type="text" class="form-control"  name="location" id='location' value="" placeholder="Location">
                                            </div>
                                        </div> 


                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Mobile</label>
                                            <div class="col-md-10">
                                            <input type="text" class="form-control"  name="mobile" id='mobile' placeholder="Mobile">

                                            </div>
                                        </div>


                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Authorized Person</label>
                                            <div class="col-md-10">
                                            <input type="text" class="form-control"  name="authorized_person" id='authorized_person' placeholder="Authorized Person">
                                            </div>
                                        </div>
                                        

                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Status</label>
                                            <div class="col-md-10">
                                            <select class="form-control" id="status1" name="status">
                                                    <option value="0">Active</option>
                                                    <option value="1">Inactive</option>
                                                </select>
                                            </div>
                                        </div> 

                                         
                                        <div class="">
                                            <a href="<?=base_url()?>vendors" class="btn btn-primary">Back</a> &nbsp;<button type="submit" class="btn btn-success">Complete</button>

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



 