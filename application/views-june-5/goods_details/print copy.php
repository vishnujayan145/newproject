<main id="main-container">
  <style type="text/css">
    @media print {
      @page {
        margin: 0;
      }

      .printxxxx {
        page-break-after: always;
      }

      tbody td {
        font-size: 20px !important;
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
  <!-- Page Content -->
  <div class="content">
    <!--   <h2 class="content-heading">Trip Sheet</h2> -->

    <!-- Full Table -->
    <div class="block">
      <div class="block-header block-header-default">
        <!--  <h3 class="block-title">TRIP SHEET</h3> -->
        <div class="block-options">
          <!-- Print Page functionality is initialized in Helpers.print() -->
          <button type="button" class="btn-block-option" onclick="Codebase.helpers('print-page');">
            <i class="si si-printer"></i> Print
          </button>
          <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
        </div>
      </div>
      <?php
      if ($result != null) {
        foreach ($result as $key => $resultvlu) {
          if($resultvlu->reciever_address !='') {
            $reciever = explode(",", $resultvlu->reciever_address);
            $reciever_name = $reciever[0];
          }
          else {
            $reciever_name ='';
          }
         
      
      ?>
          <div class="printxxxx">
            <div class="block-content ">
              <!-- Invoice Info -->
              <div class="row">
                <!-- Company Info -->
                <div class="col-12 ml-3">
                    <?php
                    if ($resultvlu->header){
                      if(get_cargo_company_header_image($resultvlu->header) != null ){
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

              <div class="row text-center table table-hover mb-0">
                <div class="col-12">
                  <div class="block" style="margin-bottom:0px !important;">
                    <div class="block-content">

                    <table style="width: 100%;border-collapse: collapse;">
                        <tr style=" border: 1px solid black; ">
                          <td colspan="3" style="text-align: left;   padding: 3px !important;"><h2 class="no-margin" style="color:grey;"></h2></td>
                          <td colspan="3" style="text-align: left;    padding: 3px !important;"><h2 class="no-margin" style="text-align:right;" >TRN: <?= $resultvlu->contact_no ?> </h2></td>
                        </tr> 

                        <tr> 
                          <td colspan="3" style="text-align: left;   padding: 3px !important;"><br>
                          <h2 class="no-margin" style=""> Airway Bill NO: <?= $resultvlu->goods_invoice ?> </h2>
                          <h2 class="no-margin" style=""> Cargo Type: Sea Door to Door India</h2>
                        </td>
                          <td colspan="3" style="text-align: left;    padding: 3px !important;"><br>
                          <h3 class="no-margin" style="text-align:right;" >Colletion Date: 21-03-2023</h3>
                          <h3 class="no-margin" style="text-align:right;" >Office: <?= $resultvlu->company ?></h3>
                          <h3 class="no-margin" style="text-align:right;" >Staff:Noujas</h3>
                        </td>
                        </tr> 
                          
                    </table>
                      <hr style="margin:0px;padding:0px;">
                    <div >
                      <table style="width: 50%; float:left;" class="tab">
                        <tr style="">
                          <td colspan="3" style="text-align: left;   padding: 3px !important;"><h2 class="no-margin" style="color:grey;">Customer</h2></td>
                          <td colspan="3" style="text-align: left;    padding: 3px !important;"><h2 class="no-margin" style="text-align:right;" ></h2></td>
                        </tr> 

                        <tr> 
                          <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                           Customer  
                          </td>
                          <td colspan="3" style="text-align: left;   padding: 3px !important; color:black;"> 
                           Noujas  
                          </td>                           
                        </tr> 
                        <tr> 
                          <td colspan="3" style="text-align: left;   padding: 3px !important; color:black;"> 
                           Mobile  
                          </td>
                          <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                           0558933726  
                          </td>                           
                        </tr> 
                        <tr> 
                          <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                           Sender  
                          </td>
                          <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                           Noujas  
                          </td>                           
                        </tr> 
                        <tr> 
                          <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                           Phone  
                          </td>
                          <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                           0558933726  
                          </td>                           
                        </tr> 
                        <tr> 
                          <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                           Emirates/State  
                          </td>
                          <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                           Dubai.  
                          </td>                           
                        </tr> 
                        <tr> 
                          <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                           Doc Type  
                          </td>
                          <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                           Emirates Id  
                          </td>                           
                        </tr> 
                        <tr> 
                          <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                           Doc No.  
                          </td>
                          <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                           789-9656-4656889-1  
                          </td>                           
                        </tr> 
                        <tr> 
                          <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                           Address  
                          </td>
                          <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                           Soanpur  
                          </td>                           
                        </tr>  
                    </table>

                    <table style="width: 50%;border-collapse: collapse;" class="tab">
                        <tr style="">
                          <td colspan="3" style="text-align: left;   padding: 3px !important;"><h2 class="no-margin" style="color:grey;">Delivery/Receiver</h2></td>
                          <td colspan="3" style="text-align: left;    padding: 3px !important;"><h2 class="no-margin" style="text-align:right;" ></h2></td>
                        </tr> 

                        <!-- <tr> 
                          <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                           Name  
                          </td>
                          <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                           Noujas  
                          </td>                           
                        </tr> 
                        <tr> 
                          <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                           Phone  
                          </td>
                          <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                           0558933726  
                          </td>                           
                        </tr>  
                        <tr> 
                          <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                           Doc. Type  
                          </td>
                          <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                           Aadhar Card  
                          </td>                           
                        </tr> 
                        <tr> 
                          <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                           Doc. No  
                          </td>
                          <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                           9898-9856-7879  
                          </td>                           
                        </tr>  -->
                        <tr> 
                          <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                           Name & Address  
                          </td>
                          <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                          <?= $resultvlu->reciever_address ?>  
                          </td>                           
                        </tr> 
                    </table>

                  </div>
                  <div style="  clear:both">
                    <table style="width: 50%; float:left; " class="tab">
                        <tr style="">
                          <td colspan="3" style="text-align: left;   padding: 3px !important;"><h2 class="no-margin" style="color:grey;">Cargo Details</h2></td>
                          <td colspan="3" style="text-align: left;    padding: 3px !important;"><h2 class="no-margin" style="text-align:right;" ></h2></td>
                        </tr> 

                        <tr> 
                          <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                           Total Weight  
                          </td>
                          <td colspan="3" style="text-align: left;   padding: 3px !important; color:black;"> 
                          <?= $resultvlu->tot_weight ?> 
                          </td>                           
                        </tr> 
                        <tr> 
                          <td colspan="3" style="text-align: left;   padding: 3px !important; color:black;"> 
                           Cargo Value  
                          </td>
                          <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                             
                          </td>                           
                        </tr> 
                        <tr> 
                          <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                           No.Of Boxes  
                          </td>
                          <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                          <?= $resultvlu->tot_pcs ?>
                          </td>                           
                        </tr> 
                        <tr> 
                          <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                           Box No <?= $resultvlu->goods_invoice ?> 
                          </td>
                          <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                          <?= $resultvlu->tot_weight ?> kg  
                          </td>                           
                        </tr>                        
                    </table>

                    <table style="width: 50%;border-collapse: collapse;" class="tab">
                        <tr style="">
                          <td colspan="3" style="text-align: left;   padding: 3px !important;"><h2 class="no-margin" style="color:grey;">Charges&Payments</h2></td>
                          <td colspan="3" style="text-align: left;    padding: 3px !important;"><h2 class="no-margin" style="text-align:right;" ></h2></td>
                        </tr> 

                        <tr> 
                          <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                           Normal  
                          </td>
                          <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                           30.10 kg * Dh. 5.00 = Dh.150.50  
                          </td>                           
                        </tr> 
                        <tr> 
                          <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                           Discount  
                          </td>
                          <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                           Dh.0.50  
                          </td>                           
                        </tr>  
                        <tr> 
                          <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                           Subtotal  
                          </td>
                          <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                           Dh. 150.00
                          </td>                           
                        </tr> 
                        <tr> 
                          <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                           Tax  
                          </td>
                          <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                          VAT (0.00%)-Dh. 0.00
                          </td>                           
                        </tr> 
                        <tr> 
                          <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                           <b>Total</b>
                          </td>
                          <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                          <b>Dh. 150.00  </b>
                          </td>                           
                        </tr> 

                        <tr> 
                          <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                           Paid  
                          </td>
                          <td colspan="3" style="text-align: left;   padding: 3px !important;color:black;"> 
                          Dh. 150.00  
                          </td>                           
                        </tr> 
                    </table>
                  </div>
                   
                  
                       <?php /* <table style="width: 100%;border-collapse: collapse;">
                        <tr>
                          <td colspan="3" style="text-align: left;    border: 1px solid black;    padding: 3px !important;">Invoice: <h2 class="no-margin"><?= $resultvlu->goods_invoice ?> </h2>
                          </td>
                          </tr> 
                          <tr>
                          <td style="text-align: left;    border: 1px solid black;    padding: 3px !important;">Pcs: <h2 class="no-margin"><?= $resultvlu->tot_pcs ?></h2>
                          </td>
                          <td style="text-align: left;    border: 1px solid black;    padding: 3px !important;">Weight: <h2 class="no-margin"><?= $resultvlu->tot_weight ?></h2>
                          </td>
                          <td style="text-align: left;    border: 1px solid black;    padding: 3px !important;">
                          Date: <h2 class="no-margin"><?=  $resultvlu->received_date!=''? $resultvlu->received_date: $resultvlu->sendingdate ?></h2>
                          </td>
                        </tr> 
                      </table> */ ?>
                    </div>
                  </div>
                </div>

              </div>
              <hr style="margin:0px;padding:0px;">
              <div class="row   ">
                <div class="col-12" style="margin-left:20px">
                   <b>Item Details:</b><?= $resultvlu->goods_desc ?>
                    
                </div> 
              </div>  

              <div class="row  ">
                <div class="col-12" style="margin-left:20px">
                <h2 class="content-heading mb-0" style="padding:10px 10px 0 10px; font-weight: 600;color:grey; font-weight: 600;"><b>CUSTOMER DECLARATION</b></h2> 
                </div> 
              </div>  

              <div class="row  ">
                <div class="col-12" style="margin-left:20px; color:black">
                <p class="mb-0">
                    <b>Note:</b> Any complaints arising against this consignment should be reported within seven days. Complaints will not be entertained after 7 days of delivery date.
                     Maximum payback for total lost will be Dhs.20/- per Kilogram. Total cargo value should not exceed Rs.20,000/-. BEST EXPRESS CARGO LLC is not responsible for any damages of 
                     fragile (glass etc.) items and shipment delay occurring due to the formalities of Government/Air/Sea authorities. We request our customers to cooperate with us.
                </p>     
                <p>I, NOUJAS holder of Emirates ID number: 786-1989-8579792-1 hereby declare that all the above said items are my personal effects/home appliances sending to my Mother Mr./Mrs. AYISHABI 
                  through BEST EXPRESS CARGO LLC, P O BOX.69190, Dubai, United Arab Emirates vide their waybill number : 5000 which is sent as the unaccompanied baggage of an international passenger.
                  </p>
                </div>  
              </div>
              <div class="row  ">
                <div class="col-12" style="margin-right:20px; color:black;text-align:right;"> Goods received in good condition</div>
              </div>

            

               <div class="row " style="margin-top:50px;margin-bottom:50px;">
                <div class="col-6"style=" padding-left: 50px;color:black;">Signature of the shipper/sender</div>
                <div class="col-6" style=" text-align:right;color:black;">Signature of the consignee/receiver<br><b><?=$reciever_name?></b></div>
              </div>
              <hr style="margin:0px;padding:0px;">
              <p style="text-align:center; color:black;margin:0px;padding:0px;">DELHI: +91 860648 5000 &nbsp;&nbsp; MUMBAI: +91 984728 5000 &nbsp;&nbsp; COCHIN: +91 860683 5000 <br> For Online Tracking www.indianlivecargo.com</p>
                 

<?php /*
               
              <div class="content">  
                <div class="block mb-0">  
                  <div class="col-12 ml-3"> 
                    <img src="<?= base_url() ?>assets/footer.jpg" style="width:100%;display: block;margin-right: auto;">  
                  </div>
                </div>
              </div>
*/ ?>
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