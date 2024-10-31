<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Update Goods details</h4> 

                    </div>
                </div>
            </div>
            <!-- end page title -->

            

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                        <form action="<?=base_url()?>goods_details/update_process" method="post" name="myxfrm" enctype="multipart/form-data" onsubmit="return validateForm();">
                                        <div id="ermsg"> <?= $this->session->flashdata('msgx'); ?>  </div>
                                        <input type="hidden" name="uid" value="<?=$id?>">
                             
 

                                        <div class="row"> 
                                                <div class="col-4 col-md-4 mb-3 ">
                                                    <div class="form-group">
                                                        <label for="example-select">Invoice Number</label>
                                                        <input type="text" class="form-control" name="invoiceno" placeholder="Enter Invoice Number.." value="<?=$invoiceno?>">
                                                    </div>
                                                </div>


                                                <div class="col-4 col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="example-select">Trip No</label>
                                                        <input type="text" class="form-control" name="trip_no" placeholder="Trip No.." value="<?=$trip_no?>"> 
                                                    </div>
                                                </div>

                                                <div class="col-4 col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="example-select">Tracking No</label> 
                                                        <input type="text" class="form-control" name="tracking_no" placeholder="Tracking No.." value="<?=$tracking_no?>"> 
                                                    </div>
                                                </div>

                                                
                                                <div class="col-4 col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="example-select">Vendor</label> 
                                                        <input type="text" class="form-control" name="vendor" placeholder="Vendor.." value="<?=$vendor?>"> 
                                                    </div>
                                                </div>
                                            
                                                <div class="col-4 col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="example-select">Docket</label> 
                                                        <input type="text" class="form-control" name="docket" placeholder="Docket.." value="<?=$docket?>"> 
                                                    </div>
                                                </div>

                                            

                                                <div class="col-4 col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="example-select">Ship.Name</label>
                                                        <input type="text" class="form-control" name="shipmentname" placeholder="Enter shipment name.." value="<?=$shipmentname?>">
                                                    </div>
                                                </div>


                                                <div class="col-4 col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="example-select">Company</label>
                                                        <input type="text" class="form-control" name="company" placeholder="Enter company.." value="<?=$company?>">
                                                    </div>
                                                </div>



                                                <div class="col-4 col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="example-select">Pcs</label>
                                                        <input type="text" class="form-control" name="pcs" placeholder="Enter pcs.." value="<?=$pcs?>">
                                                    </div>
                                                </div>

                                            
                                            
                                                <div class="col-4 col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="example-select">Received pcs</label> 
                                                        <input type="text" class="form-control" name="received_pcs" placeholder="Received pcs.." value="<?=$received_pcs?>"> 
                                                    </div>
                                                </div>
                                            

                                                
                                                <div class="col-4 col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="example-select">Weight</label> 
                                                        <input type="text" class="form-control" name="weight" placeholder="Weight.." value="<?=$weight?>"> 
                                                    </div>
                                                </div>



                                                <div class="col-4 col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="example-select">Boxno</label> 
                                                        <input type="text" class="form-control" name="boxno" placeholder="Boxno.." value="<?=$boxno?>"> 
                                                    </div>
                                                </div>


                                                <div class="col-4 col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="example-select">Re-wight</label> 
                                                        <input type="text" class="form-control" name="rewight" placeholder="Re-wight.." value="<?=$rewight?>"> 
                                                    </div>
                                                </div>





                                                
                                                <div class="col-4 col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="example-select">Date</label>
                                                        <input type="text" class="form-control" name="datex" placeholder="date.." value="<?=$date?>">
                                                    </div>
                                                </div>


                                                <div class="col-4 col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="example-select">Sending Date</label> 
                                                        <input type="text" class="form-control" name="sendingdate" placeholder="sending date.." value="<?=$sendingdate?>">
                                                    </div>
                                                </div>

                                                <div class="col-4 col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="example-select">Received Date</label>
                                                        <input type="text" class="form-control" name="recievingdate" placeholder="Received Date" value="<?=$recievingdate?>">
                                                        <input type="hidden" name="branch_id" value="<?=$branch_id?>" />
                                                    </div>
                                                </div>

                                                <div class="col-4 col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="example-select">Recieved at hub</label> 
                                                        <input type="text" class="form-control" name="recieved_at_hub" placeholder="Recieved at hub" value="<?=$recieved_at_hub?>"> 
                                                    </div>
                                                </div>
                                            
                                                <div class="col-4 col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="example-select">Connecting date</label> 
                                                        <input type="text" class="form-control" name="connecting_date" placeholder="Connecting date" value="<?=$connecting_date?>"> 
                                                    </div>
                                                </div>
                                            

                                                <div class="col-4 col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="example-select">Recieved at branch</label> 
                                                        <input type="text" class="form-control" name="recieved_at_branch" placeholder="Recieved at branch" value="<?=$recieved_at_branch?>"> 
                                                    </div>
                                                </div>
                                                
                                                <div class="col-4 col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="example-select">Address</label>
                                                        <textarea class="form-control" name="address" placeholder="Enter address.."><?=$address?></textarea>
                                                    </div>
                                                </div>    

                                                <div class="col-4 col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="example-select">Sender address</label> 
                                                        <textarea class="form-control" name="sender_address" placeholder="Enter sender address.."><?=$sender_address?></textarea> 
                                                    </div>
                                                </div>
                                            


                                                <div class="col-4 col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="example-select">Reciever address</label> 
                                                        <textarea class="form-control" name="reciever_address" placeholder="Enter reciever address.."><?=$reciever_address?></textarea> 
                                                    </div>
                                                </div>
                                            



                                                <div class="col-4 col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="example-select">State</label> 
                                                        <input type="text" class="form-control" name="state" placeholder="State" value="<?=$state?>"> 
                                                    </div>
                                                </div>


                                                <div class="col-4 col-md-4 mb-3">
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
                                                            <option value="Other state" <?php if($district=='Other state'){ echo "selected='true'"; } ?>>Other state</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-4 col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="example-select">Pincode</label> 
                                                        <input type="text" class="form-control" name="pincode" placeholder="Pincode.." value="<?=$pincode?>"> 
                                                    </div>
                                                </div>    

                                                
                                                <div class="col-4 col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="example-select">Phone</label> 
                                                        <input type="text" class="form-control" name="phone" placeholder="Phone.." value="<?=$phone?>"> 
                                                    </div>
                                                </div>

                                                <div class="col-4 col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="example-select">Contact no</label> 
                                                        <input type="text" class="form-control" name="contact_no" placeholder="Contact no" value="<?=$contact_no?>"> 
                                                    </div>
                                                </div>




                                                <div class="col-4 col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="example-select">Goods description</label> 
                                                        <input type="text" class="form-control" name="goods_desc" placeholder="Goods description" value="<?=$goods_desc?>"> 
                                                    </div>
                                                </div>
                                            

                                            
                                            

                                                <div class="col-4 col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="example-select">Remarks</label> 
                                                        <input type="text" class="form-control" name="remarks" placeholder="Remarks" value="<?=$remarks?>"> 
                                                    </div>
                                                </div>

                                                <div class="col-4 col-md-4 mb-3">
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




                                        <div class=" ">
                                            <a href="<?=base_url()?>goods_details" class="btn btn-primary">Back</a> &nbsp;
                                            <a href="<?=base_url()?>goods_details/delete_process/<?=$id?>" class="btn btn-danger mr-2">Delete</a>&nbsp;<button type="submit" class="btn btn-success">Update Now</button>
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
