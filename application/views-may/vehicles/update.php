<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Update Vehicle</h4>

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

                        <form action="<?=base_url()?>vehicles/update_process" method="post" name="myxfrm" enctype="multipart/form-data" onsubmit="return validateForm();">
                                        <div id="ermsg"> <?= $this->session->flashdata('msgx'); ?>  </div>
                                        <input type="hidden" name="uid" value="<?=$id?>"> 

                                    
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Vehicle No</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control"  name="vehicle_number" id='vehicle_number' placeholder="Vehicle no.." value="<?=$vehicle_number?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Vehicle Type</label>
                                            <div class="col-md-10">
                                            <select class="form-control" id="vehicle_type" name="vehicle_type">
                                                    <option value="Bike" <?php if($vehicle_type=='Bike'){ echo "selected='true'"; } ?>>Bike</option>
                                                    <option value="Truck" <?php if($vehicle_type=='Truck'){ echo "selected='true'"; } ?>>Truck</option>
                                                </select>
                                            </div>
                                        </div>
                                         

                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Driver Name</label>
                                            <div class="col-md-10">
                                            <input type="text" class="form-control"  name="driver_name" id='driver_name' placeholder="Driver Name.." value="<?=$driver_name?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Contact Number</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control"  name="contactnumber" id='contactnumber' placeholder="Contact Number.." value="<?=$contactnumber?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Password</label>
                                            <div class="col-md-10">
                                            <input type="password" class="form-control"  name="password" id='password' placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Status</label>
                                            <div class="col-md-10">
                                            <select class="form-control" id="status1" name="status"> 
                                                    <option value="0" <?php if($status=='0'){ echo "selected='true'"; } ?> >Active</option>
                                                    <option value="1" <?php if($status=='1'){ echo "selected='true'"; } ?> >Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                       
                                        <div class="">
                                            <a href="<?=base_url()?>vehicles" class="btn btn-primary">Back</a> &nbsp;
                                            <a href="<?=base_url()?>vehicles/delete_process/<?=$id?>" class="btn btn-danger mr-2">Delete</a>&nbsp;<button type="submit" class="btn btn-success">Update Now</button>
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
    document.getElementById('lod').style.display = "block";
    document.getElementById('submit').disabled=true;
}
</script>