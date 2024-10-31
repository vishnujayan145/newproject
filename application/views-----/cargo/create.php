<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Add Cargo</h4>

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

                        <form action="<?=base_url()?>cargo/create_process" method="post" name="myxfrm" enctype="multipart/form-data" onsubmit="return validateForm();">
                                            <div id="ermsg"> <?= $this->session->flashdata('msgx'); ?>  </div>

                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Cargo Name</label>
                                            <div class="col-md-10">
                                            <input type="text" class="form-control"  name="cargo_name" id='cargo_name' placeholder="Cargo Name..">

                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Address</label>
                                            <div class="col-md-10">
                                            <textarea  class="form-control"  name="address" id='address' placeholder="Address.."></textarea>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Header</label>
                                            <div class="col-md-10">
                                            <input type="file" class="form-control" name="header" id="header" required>
                                            <p>File size: 1500*250px</p>      
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Auth Person</label>
                                            <div class="col-md-10">
                                            <input type="text" class="form-control"  name="auth_person" id='auth_person' placeholder="Auth Person..">                                            
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Contact Number</label>
                                            <div class="col-md-10">
                                            <textarea cols="50" rows="5" class="form-control" name="contactnumber" id='contactnumber' ></textarea>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Status</label>
                                            <div class="col-md-10">
                                            <select class="form-control" id="status1" name="status">
                                                    <option value="0">Active</option>
                                                    <option value="1">Inactive</option>
                                                </select>
                                                <input type="hidden" name="branch_id" value="<?= $this->session->userdata['adminloginel']['id'] ?>" />
                                            </div>
                                        </div> 

                                         
                                        <div class="">
                                            <a href="<?=base_url()?>cargo" class="btn btn-primary">Back</a> &nbsp;<button type="submit" class="btn btn-success">Complete</button>
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
    var file_image = document.forms["myxfrm"]["file_image"].value;
    if (file_image == null || file_image == "" || file_image == 0) {
    document.getElementById("ermsg").innerHTML = "<div class='alert alert-danger'><span data-dismiss='alert' class='close' onclick=this.parentElement.style.display='none';>&times;</span><i class='fa fa-times-circle'></i>Select Image</div>";
    //   $('html, body').animate({scrollTop: ($('#url').first().offset().top-150)},"slow");
    $("html, body").animate({scrollTop:0},"slow");
    return false;
    }
    document.getElementById('lod').style.display = "block";
    document.getElementById('submit').disabled=true;
}
</script>

 