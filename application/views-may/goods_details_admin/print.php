<style type="text/css">
    @media print {
      @page {
        margin: 0;
      }

      .printxxxx {
        page-break-after: always;
      }

      .printxxxx:last-child {
          page-break-after: auto;
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
          <!-- <button type="button" class="btn-block-option" onclick="Codebase.helpers('print-page');">
            <i class="si si-printer"></i> Print
          </button>
          <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button> -->
        </div>
      </div>
      <?php
      if ($result != null) {
        foreach ($result as $key => $resultvlu) {
      ?>
          <div class="printxxxx">
            <div class="block-content ">
              <!-- Invoice Info -->
              <div class="row">
                <!-- Company Info -->
                <div class="col-12 ml-3">
                    <?php
                    if ($resultvlu->header){
                    ?>
                  <img src="<?= base_url() ?>assets/uploads/headers/<?=get_cargo_company_header_image($resultvlu->header)?>" style="width:96%;display: block;margin-right: auto;">
                        <?php
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
                  <div class="block">
                    <div class="block-content">
                      <table style="width: 100%;border-collapse: collapse;">
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
                          Date: <h2 class="no-margin"><?= $resultvlu->sendingdate ?></h2>
                          </td>
                        </tr>
                        <!--<tr>-->
                        <!--  <td colspan="2" style="border: 1px solid black;     padding: 0px !important;">-->
                        <!--    <table style="width: 100%;background: white">-->
                        <!--      <tr>-->
                        <!--        <td style="border: 0px;    padding: 0px !important;"><b>AIR CARGO</b></td>-->
                        <!--        <td style="border: 0px;    padding: 0px !important;"><b>SEA CARGO</b></td>-->
                        <!--        <td style="border: 0px;    padding: 0px !important;"><b>COURIER</b></td>-->
                        <!--      </tr>-->
                        <!--    </table>-->
                        <!--  </td>-->
                        <!--  <td colspan="1" style="border: 1px solid black;     padding: 0px !important;">-->
                        <!--    <table style="width: 100%;background: white">-->
                        <!--      <tr>-->
                        <!--        <td style="border: 0px;    padding: 0px !important;"><b>DATE:<?= $resultvlu->date ?></b></td>-->
                        <!--      </tr>-->
                        <!--    </table>-->
                        <!--  </td>-->
                        <!--</tr>-->
                      </table>
                    </div>
                  </div>
                </div>

              </div>

              <div class="row text-center table table-hover mb-0">
                <div class="col-12">
                  <div class="block  mb-0 pb-0">

                    <div class="block-content">
                      <h1  style="color: #0c0c0c;font-size: 2rem;font-weight: 600;"><b><?= $resultvlu->company ?></b></h1>
                      <h1 class="content-heading" style="color: #0c0c0c;font-size: 1.5rem;font-weight: 600;"><b><?= $resultvlu->shipmentname ?></b></h1>
                      <table style="width: 100%;border-collapse: collapse;">
                        <tr>
                        <td style="-webkit-print-color-adjust:exact;width: 50%;border-top: 1.5px solid black;background-color: #dedede !important;border-right: 1.5px solid black;color: #0c0c0c;"><b>CONSIGNEE NAME & ADDRESS </b>
                          </td>
                          <td style="width: 50%;-webkit-print-color-adjust:exact;border-top: 1.5px solid black;background-color: #dedede !important;color: #0c0c0c;"><b>GOODS DESCRIPTION </b></td>
                        </tr>
                        <tr>
                        <td rowspan="3" style="width: 50%;border-right: 1.5px solid black;color: #0c0c0c; word-wrap: break-word;
                          text-align: justify;"><?= $resultvlu->reciever_address ?></td>
                          <td style="width: 50%;"><?= $resultvlu->goods_desc ?> </td>
                        </tr>

                        <tr>
                          <!-- <td style="-webkit-print-color-adjust:exact;width: 50%;background-color: #dedede !important;border-right: 1.5px solid black;color: #0c0c0c;text-align: left;"><b>BOX MARKING</b></td> -->
                          <td style="width: 50%;-webkit-print-color-adjust:exact;background-color: #dedede !important;color: #0c0c0c;"></td>
                        </tr>

                        <tr>
                          <!-- <td style="width: 50%;border-right: 1.5px solid black;color: #0c0c0c;text-align: left;"><b>PAGE DESCRIPTION</b> -->
                            <!-- <p><?// $resultvlu->goods_desc ?></p> -->
                          </td>
                          <td style="width: 50%">
                            <table style="width: 100%;background: white">
                              <tr>
                                <td colspan="1" style="border: 0px;text-align: left;color: #0c0c0c;"><b>P</b></td>
                                <td colspan="2" style="border: 0px;color: #0c0c0c;"><b>RECIEVER NAME</b></td>
                              </tr>
                              <tr>
                                <td colspan="3" style="border: 0px;"></td>
                              </tr>
                              <tr style="-webkit-print-color-adjust:exact;">
                                <td style="border: 0px;text-align: left;color: #0c0c0c;"><b>O</b></td>
                                <td style="-webkit-print-color-adjust:exact;border: 0px;color: #0c0c0c;background-color: #dedede !important; "><b>DATE</b></td>
                                <td style="-webkit-print-color-adjust:exact;border: 0px;color: #0c0c0c;background-color: #dedede !important; "><b>TIME</b></td>
                              </tr>
                              <tr>
                                <td colspan="3" style="border: 0px;"></td>
                              </tr>
                              <tr>
                                <td colspan="1" style="border: 0px;text-align: left;color: #0c0c0c;"><b>D</b></td>
                                <td colspan="2" style="-webkit-print-color-adjust:exact;border: 0px;color: #0c0c0c;text-align: left;background-color: #dedede !important;"><b>SIGNATURE</b></td>
                              </tr>
                              
                            </table>
                          </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 25px;padding-bottom: 0px;" colspan="2" class="mt-5 text-right"><h4 style="color: #0c0c0c;font-size: 1.7rem;font-weight: 600;"><?= $resultvlu->company ?></h4></td>
                        </tr> 
                      </table>
                    </div>
                  </div>
                </div>

              </div>
              <div class="content">


                <!-- Full Table -->
                <div class="block mb-0">
                  <!--                         <div class="block-header block-header-default">
                            <span class="block-title text-center">
                                 <h2 class="content-heading"><b>DECLARATION</b></h2>
                            </span>
                        </div> -->
                  <h5 class="content-heading text-center mb-0" style="font-size: 1rem;font-weight: 600;"><b>DECLARATION</b></h5>
                  <p class="mb-0">
                    I declare that the above goods are for any international air- rail and sea transport application
                    dangerous goods regulation and civil aviation regulation, family/friends personal use as gift /Not for
                    sale 2. Shipper also here by authorized live well. To clear the parcels on behalf of me, and same
                    should be delivered to the consignee address.
                  </p>
                </div>
                <div class="block mb-0">
                  <h5 class="content-heading text-center mb-0" style="font-size: 1rem;font-weight: 600;"> <b>TERMS AND CONDITIONS</b></h5>
                  
                  <p class="mb-0">
                    Company will not responsible for any payment made by your side without or knowledge. No
                    guarantee for glassware’s CD Disc and electronics items. Which does not have original company
                    packing.
                  </p>
                  <h1 class="mb-0"><strong><center>CLEARING AND FORWARDING AGENT</center></strong></h1>

                  <div class="col-12 ml-3">

                    <img src="<?= base_url() ?>assets/footer.jpg" style="width:100%;display: block;margin-right: auto;">

                  </div>
                </div>
              </div>

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