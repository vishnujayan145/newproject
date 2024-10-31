<!-- Main Container -->
            <main id="main-container">

                <!-- Page Content -->
                <div class="content">
                    <h2 class="content-heading">Update Profile</h2>

  

           

                        <div class="row">             
                        <div class="col-12">
                            <!-- Simple Wizard -->
                            <div class="js-wizard-simple block">
                                <!-- Step Tabs -->
                                <ul class="nav nav-tabs nav-tabs-block nav-fill" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#profile_chnage_password" data-toggle="tab">Change Password</a>
                                    </li>
                                </ul>
                                <!-- END Step Tabs -->

                                <!-- Form -->
                                
                                    <!-- Steps Content -->
                                    <div class="block-content block-content-full tab-content" style="min-height: 265px;">

                                        <!-- Step 2 -->
                                        <div class="tab-pane active" id="profile_chnage_password" role="tabpanel">
                                            <form action="<?=base_url()?>profile/password_change_process" method="post" name="myxfrm" enctype="multipart/form-data" onsubmit="return validateForm();">
                                            <div id="ermsg"> <?= $this->session->flashdata('ermsg'); ?>  </div>
                                                <div class="form-group">
                                                    <label for="wizard-simple-email">Username</label>
                                                    <input class="form-control" type="text" id="uname" name="uname">
                                                </div>
                                                <div class="form-group">
                                                    <label for="wizard-simple-email">Password</label>
                                                    <input class="form-control" type="password" id="password" name="password">
                                                </div>
                                                <div class="form-group">
                                                    <label for="wizard-simple-email">Confirm Password</label>
                                                    <input class="form-control" type="password" id="cpassword" name="cpassword">
                                                </div>
                                                <div class="form-group">
                                                    <button  type="submit" id="submit" class="btn btn-alt-success">Change Password</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- END Step 2 -->

              
                                        
                                        <!-- END Step 3 -->
                                    </div>
                                    <!-- END Steps Content -->

                                    <!-- Steps Navigation -->
                                
                                    <!-- END Steps Navigation -->
                      
                                <!-- END Form -->
                            </div>
                            <!-- END Simple Wizard -->
                        </div>
                    </div>
                                        
                               
                        
                                  <img id="lod" src="<?=base_url()?>assets/loading.gif" style="display: none;align-items: center;margin-left: 50%;">
                 


                </div>
                <!-- END Page Content -->

            </main>
            <!-- END Main Container -->
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