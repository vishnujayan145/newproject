<main id="main-container">

                <!-- Page Content -->
                <div class="content">
                    <h2 class="content-heading">Goods details</h2>

                    <!-- Full Table -->
                    <div class="block">
                        <div class="block-content">
                            <div class="block">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">Update Goods details</h3>
                                </div>
                                <div class="block-content">
                                    
                                     <form action="<?=base_url()?>goods_details/update_process" method="post" name="myxfrm" enctype="multipart/form-data" onsubmit="return validateForm();">
                                            <div id="ermsg"> <?= $this->session->flashdata('msgx'); ?>  </div>
                                        <input type="hidden" name="uid" value="<?=$id?>">


<div class="row"> 
    <div class="col-4 col-md-4">
        <div class="form-group">
            <label for="example-select">Invoice Number</label>
            <input type="text" class="form-control" name="invoiceno" placeholder="Enter Invoice Number.." value="<?=$invoiceno?>">
        </div>
    </div>


    <div class="col-4 col-md-4">
        <div class="form-group">
            <label for="example-select">Trip No</label>
            <input type="text" class="form-control" name="trip_no" placeholder="Trip No.." value="<?=$trip_no?>"> 
        </div>
    </div>

    <div class="col-4 col-md-4">
        <div class="form-group">
            <label for="example-select">Tracking No</label> 
            <input type="text" class="form-control" name="tracking_no" placeholder="Tracking No.." value="<?=$tracking_no?>"> 
        </div>
    </div>

    
    <div class="col-4 col-md-4">
        <div class="form-group">
            <label for="example-select">Vendor</label> 
            <input type="text" class="form-control" name="vendor" placeholder="Vendor.." value="<?=$vendor?>"> 
        </div>
    </div>
 
    <div class="col-4 col-md-4">
        <div class="form-group">
            <label for="example-select">Docket</label> 
            <input type="text" class="form-control" name="docket" placeholder="Docket.." value="<?=$docket?>"> 
        </div>
    </div>

  

    <div class="col-4 col-md-4">
        <div class="form-group">
            <label for="example-select">Ship.Name</label>
            <input type="text" class="form-control" name="shipmentname" placeholder="Enter shipment name.." value="<?=$shipmentname?>">
        </div>
    </div>


    <div class="col-4 col-md-4">
        <div class="form-group">
            <label for="example-select">Company</label>
            <input type="text" class="form-control" name="company" placeholder="Enter company.." value="<?=$company?>">
        </div>
    </div>



    <div class="col-4 col-md-4">
        <div class="form-group">
            <label for="example-select">Pcs</label>
            <input type="text" class="form-control" name="pcs" placeholder="Enter pcs.." value="<?=$pcs?>">
        </div>
    </div>

  
 
    <div class="col-4 col-md-4">
        <div class="form-group">
            <label for="example-select">Received pcs</label> 
            <input type="text" class="form-control" name="received_pcs" placeholder="Received pcs.." value="<?=$received_pcs?>"> 
        </div>
    </div>
 

    
    <div class="col-4 col-md-4">
        <div class="form-group">
            <label for="example-select">Weight</label> 
            <input type="text" class="form-control" name="weight" placeholder="Weight.." value="<?=$weight?>"> 
        </div>
    </div>



    <div class="col-4 col-md-4">
        <div class="form-group">
            <label for="example-select">Boxno</label> 
            <input type="text" class="form-control" name="boxno" placeholder="Boxno.." value="<?=$boxno?>"> 
        </div>
    </div>


    <div class="col-4 col-md-4">
        <div class="form-group">
            <label for="example-select">Re-wight</label> 
            <input type="text" class="form-control" name="rewight" placeholder="Re-wight.." value="<?=$rewight?>"> 
        </div>
    </div>


    
    <div class="col-4 col-md-4">
        <div class="form-group">
            <label for="example-select">Date</label>
            <input type="text" class="form-control" name="datex" placeholder="date.." value="<?=$date?>">
        </div>
    </div>


    <div class="col-4 col-md-4">
        <div class="form-group">
            <label for="example-select">Sending Date</label> 
            <input type="text" class="form-control" name="sendingdate" placeholder="sending date.." value="<?=$sendingdate?>">
        </div>
    </div>

    <div class="col-4 col-md-4">
        <div class="form-group">
            <label for="example-select">Received Date</label>
            <input type="text" class="form-control" name="recievingdate" placeholder="Received Date" value="<?=$recievingdate?>">
            <input type="hidden" name="branch_id" value="<?=$branch_id?>" />
        </div>
    </div>

    <div class="col-4 col-md-4">
        <div class="form-group">
            <label for="example-select">Recieved at hub</label> 
            <input type="text" class="form-control" name="recieved_at_hub" placeholder="Recieved at hub" value="<?=$recieved_at_hub?>"> 
        </div>
    </div>
 
    <div class="col-4 col-md-4">
        <div class="form-group">
            <label for="example-select">Connecting date</label> 
            <input type="text" class="form-control" name="connecting_date" placeholder="Connecting date" value="<?=$connecting_date?>"> 
        </div>
    </div>
 

    <div class="col-4 col-md-4">
        <div class="form-group">
            <label for="example-select">Recieved at branch</label> 
            <input type="text" class="form-control" name="recieved_at_branch" placeholder="Recieved at branch" value="<?=$recieved_at_branch?>"> 
        </div>
    </div>
    
    <div class="col-4 col-md-4">
        <div class="form-group">
            <label for="example-select">Address</label>
            <textarea class="form-control" name="address" placeholder="Enter address.."><?=$address?></textarea>
        </div>
    </div>    

    <div class="col-4 col-md-4">
        <div class="form-group">
            <label for="example-select">Sender address</label> 
            <textarea class="form-control" name="sender_address" placeholder="Enter sender address.."><?=$sender_address?></textarea> 
        </div>
    </div>
 


    <div class="col-4 col-md-4">
        <div class="form-group">
            <label for="example-select">Reciever address</label> 
            <textarea class="form-control" name="reciever_address" placeholder="Enter reciever address.."><?=$reciever_address?></textarea> 
        </div>
    </div>
 



    <div class="col-4 col-md-4">
        <div class="form-group">
            <label for="example-select">State</label> 
            <input type="text" class="form-control" name="state" placeholder="State" value="<?=$state?>"> 
        </div>
    </div>


    <div class="col-4 col-md-4">
        <div class="form-group">
            <label for="example-select">District</label>
            <select class="form-control" id="district" name="district">
                <option value="Alappuzha" <?php if($district=='Alappuzha'){ echo "selected='true'"; } ?>>Alappuzha</option>
                <option value="Ernakulam" <?php if($district=='Ernakulam'){ echo "selected='true'"; } ?>>Ernakulam</option>
                <option value="Idukki" <?php if($district=='Idukki'){ echo "selected='true'"; } ?>>Idukki</option>
                <option value="Kannur" <?php if($district=='Kannur'){ echo "selected='true'"; } ?>>Kannur</option>
                <option value="Kasaragod" <?php if($district=='Kasaragod'){ echo "selected='true'"; } ?>>Kasaragod</option>
                <option value="Kollam" <?php if($district=='Kollam'){ echo "selected='true'"; } ?>>Kollam</option>
                <option value="Kottayam" <?php if($district=='Kottayam'){ echo "selected='true'"; } ?>>Kottayam</option>
                <option value="Kozhikode" <?php if($district=='Kozhikode'){ echo "selected='true'"; } ?>>Kozhikode</option>
                <option value="Malappuram" <?php if($district=='Malappuram'){ echo "selected='true'"; } ?>>Malappuram</option>
                <option value="Palakkad" <?php if($district=='Palakkad'){ echo "selected='true'"; } ?>>Palakkad</option>
                <option value="Pathanamthitta" <?php if($district=='Pathanamthitta'){ echo "selected='true'"; } ?>>Pathanamthitta</option>
                <option value="Thiruvananthapuram" <?php if($district=='Thiruvananthapuram'){ echo "selected='true'"; } ?>>Thiruvananthapuram</option>
                <option value="Thrissur" <?php if($district=='Thrissur'){ echo "selected='true'"; } ?>>Thrissur</option>
                <option value="Wayanad" <?php if($district=='Wayanad'){ echo "selected='true'"; } ?>>Wayanad</option>
            </select>
        </div>
    </div>

    <div class="col-4 col-md-4">
        <div class="form-group">
            <label for="example-select">Pincode</label> 
            <input type="text" class="form-control" name="pincode" placeholder="Pincode.." value="<?=$pincode?>"> 
        </div>
    </div>    

     
    <div class="col-4 col-md-4">
        <div class="form-group">
            <label for="example-select">Phone</label> 
            <input type="text" class="form-control" name="phone" placeholder="Phone.." value="<?=$phone?>"> 
        </div>
    </div>

    <div class="col-4 col-md-4">
        <div class="form-group">
            <label for="example-select">Contact no</label> 
            <input type="text" class="form-control" name="contact_no" placeholder="Contact no" value="<?=$contact_no?>"> 
        </div>
    </div>




    <div class="col-4 col-md-4">
        <div class="form-group">
            <label for="example-select">Goods description</label> 
            <input type="text" class="form-control" name="goods_desc" placeholder="Goods description" value="<?=$goods_desc?>"> 
        </div>
    </div>
 

<!--  
    <div class="col-4 col-md-4">
        <div class="form-group">
            <label for="example-select">Url</label> 
            <input type="text" class="form-control" name="url" placeholder="reciev.date.." value="<?=$url?>"> 
        </div>
    </div> -->
  

    <div class="col-4 col-md-4">
        <div class="form-group">
            <label for="example-select">Remarks</label> 
            <input type="text" class="form-control" name="remarks" placeholder="Remarks" value="<?=$remarks?>"> 
        </div>
    </div>

    <div class="col-4 col-md-4">
        <div class="form-group">
            <label for="example-select">Goods status</label> 
            <select class="form-control" id="goods_status" name="goods_status">
                    <option value="received"  <?php if($goods_status=='received'){ echo "selected='true'"; } ?>>Received</option>
                    <option value="hold"  <?php if($goods_status=='hold'){ echo "selected='true'"; } ?>>Hold</option>
                    <option value="short"  <?php if($goods_status=='short'){ echo "selected='true'"; } ?>>Short</option>
            </select>             
        </div>
    </div>
  
</div>


                                        
                                       
                                       
              

                                        <div class="form-group">
                                            <a href="<?=base_url()?>goods_details" class="btn btn-alt-primary">Back</a> &nbsp;
                                            <a href="<?=base_url()?>goods_details/delete_process/<?=$id?>" class="btn btn-danger mr-2">Delete</a>&nbsp;<button type="submit" class="btn btn-alt-success">Update Now</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Full Table -->

                </div>
                <!-- END Page Content -->

            </main>
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