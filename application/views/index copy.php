 
 <style>

/* The alert message box */
.alert {
  /* padding: 20px;
  background-color: #ff004a;  
  color: white;
  margin-bottom: 15px;
  font-size:20px;
  padding-top:30px; */
}

/* The close button */
.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

/* When moving the mouse over the close button */
.closebtn:hover {
  color: black;
}

 
 
.alert{
 
  padding: 20px 40px;
  min-width: 420px;
  /* position: absolute; */
  font-size:20px;
  right: 0;
  top: 10px;
  border-radius: 4px;
  /* border-left: 8px solid #ffa502; */
  overflow: hidden;
  /* opacity: 0; */
  /* pointer-events: none; */
}  
.alert-success{
    background: #ffdb9b;
    border-left: 8px solid #ffa502;
}
.alert-info {
    background: #ff9797;
    border-left: 8px solid #b60000;
}
 
.alert-warning {
    background: #fff0c3;
    border-left: 8px solid #e6c60e;
}

.alert-vechicle {
    background: #a7ff97;
    border-left: 8px solid #297100;
}

.alert.showAlert{
  opacity: 1;
  pointer-events: auto;
} 

.holding{ 
    position: absolute;
    left: 250px;
    width: 100px;
    top: 80px;
}

.pending{ 
    position: absolute;
    left: 250px;
    width: 100px;
    top: 160px;
}
.vehicle{ 
    position: absolute;
    left: 250px;
    width: 100px;
    top: 240px;
}


.pendingInvoice{ 
    position: absolute;
    right: 30px;
    width: 150px;
    top: 80px;
}


.notDeliveredInvoice{ 
    position: absolute;
    right: 30px;
    width: 150px;
    top: 160px;
}

.notDelivered{ 
    position: absolute;
    right: 30px;
    width: 150px;
    top: 240px;
}






</style>
 

<!-- Main Container -->
            <main id="main-container" >

                <!-- Page Content -->
                <div class="content"  >

              
                    <!-- Header -->  

                    <!-- <div class="block block-rounded bg-gd-dusk">
                        <div class="block-content bg-white-op-5">
                            <div class="py-30 text-center">
                                <h1 class="font-w700 text-white mb-10">Dashboard</h1>
                            </div>
                        </div>
                    </div> 
  -->
                    <?php if( isset($pending_invoices)) { ?>
                    <table style="float:right; display:inline-block;">
                        <tr>
                            <td> 
                                 <div class="alert alert-success alert-dismissible pendingInvoice ">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Pending invoice : </strong><?=count($pending_invoices);?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                    <a style="color:black; font-size:14px;" href="<?=base_url()?>trip_sheet/pendingInvoice"> click here </a>
                                </div> 
                            </td>                           
                        </tr>
                        <tr>
                            <td> 
                                <div class="alert alert-info alert-dismissible notDeliveredInvoice">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Not delivered Invoice: </strong><?= count($not_delivered_invoices);?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                    <a style="color:black; font-size:14px;" href="<?=base_url()?>trip_sheet/notDeliveredInvoice"> click here </a>
                                </div>
                            </td>                           
                        </tr>
                        <tr>
                            <td> 
                                <div class="alert alert-warning alert-dismissible notDelivered">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Not Delivered Goods: </strong><?php if($goods_not_delivered){  echo count($goods_not_delivered); }  else echo '0';?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                    <a style="color:black; font-size:14px;" href="<?=base_url()?>goods_details/notDelivered"> click here </a>
                                </div>
                            </td>                           
                        </tr>


                        
                        </table>
                      
                    <?php } ?> 


                    <?php if( isset($holding_count)) { ?>
                    <table style="float:left; display:inline-block;">
                        <tr>
                            <td> 
                                 <div class="alert alert-success alert-dismissible holding">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Holding Goods Count : </strong><?=$holding_count?> &nbsp; 
                                    <a style="color:black; font-size:14px;" href="<?=base_url()?>goods_details/index?inptvalue=hold&serachq=goods_status"> click here </a>
                                </div> 
                            </td>                           
                        </tr>
                        <tr>
                            <td> 
                                <div class="alert alert-info alert-dismissible pending">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Short Goods Count : </strong><?=$pending_count?> &nbsp;  
                                    <a style="color:black; font-size:14px;" href="<?=base_url()?>goods_details/index?inptvalue=short&serachq=goods_status"> click here </a>
                                   
                                </div>
                            </td>                           
                        </tr>

                        <tr>
                            <td> 
                                <div class="alert alert-vechicle alert-dismissible vehicle">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Vechicle on the way : </strong><?=$on_the_way?>    <a style="color:black; font-size:14px;" href="<?=base_url()?>trip_sheet/index?status=0&vehicle_number=all"> click here </a><br>
                                    <strong>Vechicle trip started : </strong><?=$trip_started?>    <a style="color:black; font-size:14px;" href="<?=base_url()?>trip_sheet/index?status=1&vehicle_number=all"> click here </a> 
                                </div>
                            </td>                           
                        </tr> 
                        </table>
                      
                    <?php } ?>  
 

                    <img src="<?=base_url()?>/assets/ilcbg.jpg" width="100%">
                    
                    </div> 

                </div>
                <!-- END Page Content -->

            </main>
            <!-- END Main Container -->