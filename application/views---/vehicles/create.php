<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Add Vehicle</h4>

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

                            <form action="<?=base_url()?>vehicles/create_process" method="post" name="myxfrm" enctype="multipart/form-data" onsubmit="return validateForm();">
                                        <div id="ermsg"> <?= $this->session->flashdata('msgx'); ?>  </div>

                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Vehicle No</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text"  name="vehicle_number" id='vehicle_number' placeholder="Vehicle no..">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Vehicle Type</label>
                                            <div class="col-md-10">
                                                <select class="form-control" id="vehicle_type" name="vehicle_type">
                                                    <option value="Bike">Bike</option>
                                                    <option value="Truck">Truck</option>
                                                </select>
                                            </div>
                                        </div>
                                         

                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Driver Name</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="driver_name" id='driver_name' placeholder="Driver Name..">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Contact Number</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="contactnumber" id='contactnumber' placeholder="Contact Number..">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Password</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="password"   name="password" id='password' placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Status</label>
                                            <div class="col-md-10">
                                            <select class="form-control" id="status1" name="status">
                                                    <option value="0">Active</option>
                                                    <option value="1">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- <div>
                                        <button class="btn btn-primary" type="submit">Complete</button>
                                        </div> --> 
                                        
                                         
                                        <div class="">
                                            <a href="<?=base_url()?>vehicles" class="btn btn-primary">Back</a> &nbsp;<button type="submit" class="btn btn-success">Complete</button>
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