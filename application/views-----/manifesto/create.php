<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Add Manifesto</h4>

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

                        <form action="<?=base_url()?>manifesto/create_process" method="post" name="myxfrm" enctype="multipart/form-data" onsubmit="return validateForm();">
                                            <div id="ermsg"> <?= $this->session->flashdata('msgx'); ?>  </div>

                                        
                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Branch</label>
                                            <div class="col-md-10">
                                                
                                                <select name="branch" class="form-control" id="branch"  >
                                                <option value="1">Branch 1</option>
                                                <option value="2">Branch 2</option>
                                                <option value="3">Branch 3</option>
                                                <option value="4">Branch 4</option>
                                            </select>

                                            </div>
                                        </div>
                                         

                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">File</label>
                                            <div class="col-md-10">
                                            <input type="file" class="form-control"  name="upload_file" id='contactnumber' placeholder="Upload File">
                                            </div> 
                                        </div>
                                        <div class="mb-3 row">  
                                            <label for="example-text-input" class="col-md-2 col-form-label">Send Date</label>
                                            <div class="col-md-10">
                                            <input type="datetime-local" class="form-control"  name="send_date" id='send_date' placeholder="Send date">
                                            </div>
                                        </div>
                                        
                                        
                                         
                                        <div class="">
                                        <a href="<?=base_url()?>manifesto" class="btn btn-primary">Back</a> &nbsp;<button type="submit" class="btn btn-success">Complete</button> 
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