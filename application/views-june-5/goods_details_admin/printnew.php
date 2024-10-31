<style type="text/css">
   @media print {
    @page { margin: 0; }
    
    
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


                <main id="main-container" style="margin-top: -31px;">

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
<div class="row" >
                            <div class="table-responsive push">
                                <table class="table table-hover" style="border: 1px; ; solid black;">
                                    <thead>
                                        <tr >
                                          <th colspan="6" class="text-center" style="border: 1px solid black;padding: 0px;height: 27px;"><b></b> </th>
                                        </tr>
                                        <tr>
                                            <th class="text-center" style="width: 23%;border: 1px solid black;padding: 0px;">Cargo NO</th>
                                            <th class="text-center" style="width: 8%;border: 1px solid black;padding: 0px;">PCS</th>
                                            <th class="text-center" style="width: 11%;border: 1px solid black;padding: 0px;">Weight</th>
                                            <th class="text-center" style="width: 10%;border: 1px solid black;padding: 0px;">DISTRICT</th>
                                            <th class="text-center" style="width: 120px;border: 1px solid black;padding: 0px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <tr></tr>
<?php
if($result!=null)
{
foreach ($result as $key => $resultvlu) {
?>

                                        <tr>
                                          
                                            <td class="text-center" style="border: 1px solid black;padding: 0px;">
                                                <p class="font-w600 mb-5"><?=$resultvlu->invoiceno?></p>
                                            </td>
                                            <td class="text-center" style="border: 1px solid black;padding: 0px;">
                                               <?=$resultvlu->pcs?>
                                            </td>
                                            <td class="text-center" style="border: 1px solid black;padding: 0px;"><?=$resultvlu->weight?></td>
                                            <td class="text-center" style="border: 1px solid black;padding: 0px;"><?=$resultvlu->district?></td>
                                            <td class="text-center" style="border: 1px solid black;padding: 0px;"></td>
                                        </tr>
<?php
}
}
?> 
                                    </tbody>
                                </table>
                            </div>
                        </div>



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