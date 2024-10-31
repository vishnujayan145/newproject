<link href='https://fonts.googleapis.com/css?family=Libre Barcode 39' rel='stylesheet'>
<style>
.barcode {
  font-family: 'Libre Barcode 39';font-size: 50px;
}
</style>
  <style type="text/css">
    @media print {
      @page {
        margin: 0;
      }

      .printxxxx:last-child {
          page-break-after: auto;
      }
      .printxxxx {
        page-break-after: always;
      }
      .print_btn {
        display:none;
      }
      .declaration{
        margin:0 20px 0 20px;
        padding-right:40px !important;
      }

      tbody td {
        font-size: 20px !important;
        padding:0px !important;
      }
      .fs-20{
        font-size: 20px !important;
      }
     
      .tab tr  td {
        padding:0px !important;
        
    }
    td {
       
        padding:0px !important;
        margin:0px !important;
        
    }
      
    }

    tbody td {
      font-size: 20px !important;
    }
        table {
            margin-left: auto;
            margin-right: auto;
            font-size: 20px;
            height: 100%;
            table-layout: fixed;
        }
    .no-margin{
      margin:0px !important;
    }
    .tab td {
      border:none !important;
    }
  </style>



<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">  
                  <div class="btn-group" role="group" aria-label="Basic outlined example">                               
                      <button type="button" class="btn btn-outline-primary print_btn"   onClick="window.print()" ><i class="mdi mdi-printer "  style="font-size:20px;margin-right:5px;"></i>Print</button>                            
                  </div>  
                </div>
              </div>
            </div>
          </div>
           
        <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">     

                      

<main id="main-container">

  <!-- Page Content -->
  <div class="content">
    <!--   <h2 class="content-heading">Trip Sheet</h2> -->

    <!-- Full Table -->
    <div class="block">
      <div class="block-header block-header-default">
        <!--  <h3 class="block-title">TRIP SHEET</h3> -->
        <div class="block-options">
          <!-- Print Page functionality is initialized in Helpers.print() -->        


        </div>
      </div>
      <?php
      if ($result != null) {
        foreach ($result as $key => $resultvlu) {
          $reciever = explode(",", $resultvlu->reciever_address);
          $reciever_name = $reciever[0];

          $invoice_arr = explode(",",$resultvlu->goods_invoice)
      ?>
          <div class="printxxxx">
            <div class="block-content ">
              <!-- Invoice Info -->
              <div class="row">
                <!-- Company Info -->
                <div class="col-12 ml-3">
                    <?php
                      if ($resultvlu->header){ 
                        if(get_cargo_company_header_image($resultvlu->header) != ''){                      
                          ?>
                        <img src="<?= base_url() ?>assets/uploads/headers/<?=get_cargo_company_header_image($resultvlu->header)?>" style="width:96%;display: block;margin-right: auto;">
                              <?php
                          } else { ?>
                        <img src="<?= base_url() ?>assets/uploads/headers/<?=$resultvlu->header?>" style="width:96%;display: block;margin-right: auto;">
                          <?php 
                          } 
                      }else{
                          ?>
                          <img src="<?= base_url() ?>assets/print_header.png" style="width:96%;display: block;margin-right: auto;">
                          <?php
                      }
                    ?>
                  </div>

                <!-- END Client Info -->
              </div>
              <!-- END Invoice Info -->

              <!-- Table -->

              <div class="row ">
                <div class="col-12">
                  <div class="block" style="margin-bottom:0px !important;">
                    <div class="block-content1">

                    <table style="width: 100%;" class="tab"> 
                              <tr> 
                                <td style="text-align: left;   padding: 3px !important;">
                                  <p class="barcode"  style="padding:0px; margin:0px; height:45px"><?= $resultvlu->tracking_no ?></p>
                                  <p class="no-margin" style="padding:0px;margin:0px;"><?= $resultvlu->tracking_no ?></p>                                             
                                </td>
                                <td><br><span style="font-size:28px"><b>PROOF OF DELIVERY</b></span></td>
                                <td  style="text-align: left;    padding: 3px !important;">
                                  <h4 class="no-margin" style="text-align:right;" >Date: 
                                  <?php 
                                  if( $resultvlu->is_transfer == 0) { 
                                        echo date('d-m-Y',  strtotime($resultvlu->transfer_date));
                                      } else {
                                        echo date('d-m-Y', strtotime($resultvlu->received_date)); 
                                    }
                                  ?>   
                                  </h4>
                                  <h4 class="no-margin" style="text-align:right;" >Company: <?= $resultvlu->company ?> <br><?= $resultvlu->shipmentname ?></h4>
                                </td>
                              </tr>  
                          </table>
                          <hr style="margin:0px;padding:0px;">
                      <div class="row">   
                          <div class="col-12" >   
                            
                          </div>


                          <div class="col-6" >   
                              <div class="row " style="text-align:left;">
                                    <div class="col-10" ><h2 class="no-margin" style="color:grey;padding:0px !important;margin:0px !important;">Cargo Details</h2></div>
                                    <div class="col-5  " style="font-size:20px;">Total Weight    </div>
                                    <div class="col-5" style="font-size:20px;" >: &nbsp;&nbsp;<?= $resultvlu->tot_weight ?>   </div>

                                    <div class="col-5  " style="font-size:20px;"> No.Of Boxes     </div>
                                    <div class="col-5" style="font-size:20px;" >: &nbsp;&nbsp;<?= $resultvlu->tot_pcs ?>  </div>

                                    
                                    <!-- <div class="col-10" style="font-size:20px;" ><?= $resultvlu->sender_address ?>  </div> -->
                                          <div class="col-10" style="text-align:left" >                                     
                                              <?php  
                                                      
                                                      foreach( $invoice_arr as $key => $val ){
                                                        $key = $key+1;
                                                        ?>
                                                          <div class="row " style=""> 
                                                            <div class="col-1" style="font-size:20px;"><?=$key?></div>
                                                            <div class="col-6" style="font-size:20px;"> <?=$val?></div>
                                                            <div class="col-3" style="font-size:20px;">  <span class="border border-primary"> &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;</span></div>  
                                                        </div>                                              
                                                        <?php                                    
                                                      }  
                                                ?>
                                          </div>
                              </div>   
                          </div>  



                           
                          <div class="col-6" >   
                                <div class="row">
                                      <div class="col-10" > 

                                                <table style="margin:0px;" class="tab">
                                                <tr style="">
                                                  <td colspan="3" style="text-align: left;   padding: 3px !important;"><h2 class="no-margin" style="color:grey;">Delivery Details</h2></td>
                                                  <td colspan="3" style="text-align: left;    padding: 3px !important;"><h2 class="no-margin" style="text-align:right;" ></h2></td>
                                                </tr> 

                                                <tr> 
                                                  <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                                                  Receiver Name  
                                                  </td>
                                                  <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                                                  : ...................................................
                                                  </td>                           
                                                </tr> 
                                                <tr> 
                                                  <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                                                  Contact No  
                                                  </td>
                                                  <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                                                  : ...................................................
                                                  </td>                           
                                                </tr>  
                                                <tr> 
                                                  <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                                                  Date & Time  
                                                  </td>
                                                  <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                                                  : ...................................................
                                                  </td>                           
                                                </tr> 
                                                <tr> 
                                                  <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                                                  Document Type  
                                                  </td>
                                                  <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                                                  : ...................................................
                                                  </td>                           
                                                </tr> 
                                                <tr> 
                                                  <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                                                  <b>Doc. Number</b>
                                                  </td>
                                                  <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                                                  : ...................................................
                                                  </td>                           
                                                </tr> 
                                            </table> 

                                      </div>

                                      <div class="col-8" >  
                                          <table style="" class=" ">
                                              <tr style="">
                                                <td colspan="3" style="text-align: left;   "><h2 class="no-margin" style="color:grey;">Delivery/Receiver</h2></td>
                                                <td colspan="3" style="text-align: left;    "><h2 class="no-margin" style="text-align:right;" ></h2></td>
                                              </tr>  
                                              <tr> 
                                                <td colspan="6" style="text-align: left;   color:black; word-break:break-all;">  
                                                <!-- </td>
                                                <td colspan="3" style="text-align: left;   color:black;">  -->
                                                <?= $resultvlu->reciever_address ?>  
                                                </td>                           
                                              </tr> 
                                          </table>
                                      </div>

                                  </div> 

                          </div>                       


                      </div> 



                      
                    </div>
                  </div>
                </div>
              </div>

 



              <div class="row   ">
                <div class="col-12">
                  <div class="block" style="margin-bottom:0px !important;">
                    <div class="block-content1">
                      <hr>                   
                        <b>Item Details:</b><?= $resultvlu->goods_desc ?>                      
                    </div>
                  </div>
                </div>
              </div>  

              <div class="row  ">
                  <div class="col-12">
                    <div class="block" style="margin-bottom:0px !important; padding-top:0px; padding-bottom:0px;">
                      <div class="block-content" style="padding-top:0px; padding-bottom:0px;">
                        <h2 class="content-heading mb-0" style="  font-weight: 600;color:grey; font-weight: 600;"><b>CUSTOMER DECLARATION</b></h2> 
                      </div>
                    </div>
                  </div>
              </div>  

              <div class="row  ">
                <div class="col-12 declaration" style="margin-left:20px; color:black">
                <p class="mb-0"  style="text-align:justify;">
                    <b>Note:</b> Any complaints arising against this consignment should be reported within seven days. Complaints will not be entertained after 7 days of delivery date. Maximum payback for total lost will be Dhs.20/- per Kilogram. Total cargo value should not exceed Rs.20,000/-. Best Express Cargo is not responsible for any damages of fragile (glass etc.) items and shipment delay occurring due to the formalities of Government/Air/Sea authorities. We request our customers to cooperate with us.
                </p>     
                <p class="mb-0"  style="text-align:justify;"> I, .................. holder of Indian Passport number : hereby declare that all the above said items are my personal effects/home appliances sending to my RELATIVE Mr./Mrs. ........................... through Best Express Cargo, PO Box 69190, Dubai, United Arab Emirates vide their way bill number : 0 which is send as the unaccompanied baggage of an international passenger. There is no commercial value for these goods. I undertake the complete responsibility in respect of the payment of any charges or customs duty/compensation whatever so to the concerned authorities. If any dutiable/illegal goods are found other than the above said items n my parcel/packet/ box which is handed over to you as per the above list, I am taking the whole responsibilities on any legal action against the consignment.
                  </p>
                </div>  
              </div>
              <div class="row  ">
                <div class="col-12" style="margin-right:20px; color:black;text-align:right;"> Goods received in good condition</div>
              </div>

            

               <div class="row " style="margin-top:40px;margin-bottom:5px;">
                <div class="col-6"style=" padding-left: 50px;color:black;">Signature of the shipper/sender<br>Signature ..................................................</div>
                <div class="col-6" style=" text-align:right;color:black;">Signature of the consignee/receiver <br><b><?=$reciever_name?></b><br>Signature ..................................................</div>
              </div>

              <!-- <div class="row  ">
                  <div class="col-12">
                    <div class="block" style="margin-bottom:0px !important; padding:0px !important;">
                      <div class="block-content"  style="padding:0px !important;">
                      <div class="col-6"style=" float:left;color:black;">Signature of the shipper/sender</div>
                       <div class="col-6" style=" float:left;text-align:right;color:black;">Signature of the consignee/receiver</div>
                       
                      </div>
                    </div>
                  </div>
              </div>   -->

              

              <div class="row  " style="padding-left:30px; !important;">
                  <div class="col-12">
                    <div class="block" style="margin-bottom:0px !important; padding:0px !important;">
                      <div class="block-content"  style="padding:0px !important;">
                      <hr>
                      <p style="text-align:center; color:black;margin:0px;padding:0px;">
                      <?= get_cargo_company_contact_number($resultvlu->header) != null ?  get_cargo_company_contact_number($resultvlu->header):'DELHI: +91 860648 5000  /  MUMBAI: +91 984728 5000 /  COCHIN: +91 860683 5000'?> 
                      <br> For Online Tracking www.indianlivecargo.com</p>
                       
                      </div>
                    </div>
                  </div>
              </div>  

            
              <!-- <p style="text-align:center; color:black;margin:0px;padding:0px;"> For Online Tracking www.indeianlivecargo.com<p>  -->

 
              <!-- END Table -->

              <!-- Footer -->

              <!-- END Footer -->
            </div>
          </div>
      <?php
        }
      }
      ?>
    </div>
    <!-- END Full Table -->

  </div>
  <!-- END Page Content -->

</main>



         
          </div>  
        </div>
    </div>
</div>


 

             
        </div>
    </div>
</div>


 
  