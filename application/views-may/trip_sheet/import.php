<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Import TripSheet</h4> 

                    </div>
                </div>
            </div>
            <!-- end page title -->

            

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                        
                        <form action="<?=base_url()?>trip_sheet/import_process" method="post" name="myxfrm" enctype="multipart/form-data" onsubmit="return validateForm();">
                                            <div id="ermsg"> <?= $this->session->flashdata('msgx'); ?>  </div>
                                            <div class="form-group mb-3">
                                                <label for="example-select">CSV File</label>
                                                <div>
                                                    <input type="file" class="form-control" name="upload_file" placeholder="Enter pcs.." value="">
                                                </div>
                                                <span class="error"><?php echo form_error('name'); ?></span>
                                            </div>

                                        <div class="">
                                            <a href="<?=base_url()?>trip_sheet" class="btn btn-primary">Back</a> &nbsp;<button type="submit" class="btn btn-success">Import Data</button>
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