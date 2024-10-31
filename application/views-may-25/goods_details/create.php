<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Add Good Details</h4> 

                    </div>
                </div>
            </div>
            <!-- end page title -->

            

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="<?= base_url() ?>goods_details/create_process" method="post" name="myxfrm" enctype="multipart/form-data" onsubmit="return validateForm();">
                            <div id="ermsg"> <?= $this->session->flashdata('msgx'); ?>  </div>
                             
 

                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Invoice Number</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text"  name="invoiceno" placeholder="Enter Invoice Number.." value="">
                                            </div>
                                        </div> 
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Date</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text"  name="datex" placeholder="date.." value="">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">District</label>
                                            <div class="col-md-10"> 
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
                                         

                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Company</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="company" placeholder="Enter company.."
                                           value="" >
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Header</label>
                                            <div class="col-md-10"> 
                                            <input type="file" class="form-control" name="header" id="header" required>                                               
                                            </div>
                                            <p>File size: 1500*250px</p>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Address</label>
                                            <div class="col-md-10">
                                            <textarea class="form-control" name="address"
                                              placeholder="Enter address.."></textarea>
                                            </div>
                                        </div>



                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Pcs</label>
                                            <div class="col-md-10">
                                            <input type="text" class="form-control" name="pcs" placeholder="Enter pcs.."
                                           value="">
                                            </div>
                                        </div>




                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Weight</label>
                                            <div class="col-md-10">
                                            <input type="text" class="form-control" name="weight" placeholder="Enter weight.."
                                           value="">
                                            </div>
                                        </div>



                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Ship.Name</label>
                                            <div class="col-md-10">
                                            <input type="text" class="form-control" name="shipmentname"
                                           placeholder="Enter shipment name.." value="" >
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Agency.Name</label>
                                            <div class="col-md-10">
                                            <input type="text" class="form-control" name="agencyname"
                                           placeholder="Enter agency name.." value="" >
                                            </div>
                                        </div>



                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Sending Date</label>
                                            <div class="col-md-10">
                                            <input type="text" class="form-control" name="sendingdate"
                                           placeholder="sending date.." value="">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Recciev.Date</label>
                                            <div class="col-md-10">
                                            <input type="text" class="form-control" name="recievingdate"
                                           placeholder="reciev.date.." value="">
                                            </div>
                                            <input type="hidden" name="branch_id" value="<?= $this->session->userdata['adminloginel']['id'] ?>" />

                                        </div> 
                          
                                        
                                         
                                        <div class="">
                                            <a href="<?=base_url()?>goods_details" class="btn btn-primary">Back</a> &nbsp;<button type="submit" class="btn btn-success">Complete</button>
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
