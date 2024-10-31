<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Update Profile</h4>

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

                        <form action="<?=base_url()?>profile/password_change_process" method="post" name="myxfrm" enctype="multipart/form-data" onsubmit="return validateForm();">
                                            <div id="ermsg"> <?= $this->session->flashdata('ermsg'); ?>  </div>

                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Username</label>
                                            <div class="col-md-4"> 
                                                    <input class="form-control" type="text" id="uname" name="uname">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Password</label>
                                            <div class="col-md-4">
                                                    <input class="form-control" type="password" id="password" name="password">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Confirm Password</label>
                                            <div class="col-md-4">
                                            <input class="form-control" type="password" id="cpassword" name="cpassword">
                                            </div>
                                        </div> 
                                         
                                        <div class="">
                                            <button  type="submit" id="submit" class="btn btn-success">Change Password</button>
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
        function validateForm()
        {
            var uname = document.forms["myxfrm"]["uname"].value;
            if (uname == "" || uname == "") {
            document.getElementById("ermsg").innerHTML = "<div class='alert alert-danger'><span data-dismiss='alert' class='close' onclick=this.parentElement.style.display='none';>&times;</span><i class='fa fa-times-circle'></i>Username required</div>";
            //   $('html, body').animate({scrollTop: ($('#url').first().offset().top-150)},"slow");
            $("html, body").animate({scrollTop:0},"slow");
            return false;
            }
            if (uname.length<6) {
            document.getElementById("ermsg").innerHTML = "<div class='alert alert-danger'><span data-dismiss='alert' class='close' onclick=this.parentElement.style.display='none';>&times;</span><i class='fa fa-times-circle'></i>Username Minimum length 6</div>";
            //   $('html, body').animate({scrollTop: ($('#url').first().offset().top-150)},"slow");
            $("html, body").animate({scrollTop:0},"slow");
            return false;
            }
            var password = document.forms["myxfrm"]["password"].value;
            var cpassword = document.forms["myxfrm"]["cpassword"].value;

            if (password == "" || cpassword == "") {
            document.getElementById("ermsg").innerHTML = "<div class='alert alert-danger'><span data-dismiss='alert' class='close' onclick=this.parentElement.style.display='none';>&times;</span><i class='fa fa-times-circle'></i>Password required</div>";
            //   $('html, body').animate({scrollTop: ($('#url').first().offset().top-150)},"slow");
            $("html, body").animate({scrollTop:0},"slow");
            return false;
            }
            if (password.length<6) {
            document.getElementById("ermsg").innerHTML = "<div class='alert alert-danger'><span data-dismiss='alert' class='close' onclick=this.parentElement.style.display='none';>&times;</span><i class='fa fa-times-circle'></i>Password Minimum length 6</div>";
            //   $('html, body').animate({scrollTop: ($('#url').first().offset().top-150)},"slow");
            $("html, body").animate({scrollTop:0},"slow");
            return false;
            }
            if (password != cpassword) {
            document.getElementById("ermsg").innerHTML = "<div class='alert alert-danger'><span data-dismiss='alert' class='close' onclick=this.parentElement.style.display='none';>&times;</span><i class='fa fa-times-circle'></i>Password does not match</div>";
            //   $('html, body').animate({scrollTop: ($('#url').first().offset().top-150)},"slow");
            $("html, body").animate({scrollTop:0},"slow");
            return false;
            }

            document.getElementById('lod').style.display = "block";
            document.getElementById('submit').disabled=true;
        }
    </script>
