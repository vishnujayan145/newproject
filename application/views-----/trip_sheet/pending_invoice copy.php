 <!-- Main Container -->
 <main id="main-container">

<!-- Page Content -->
<div class="content">
  

    <!-- Full Table -->
    <div class="block">
        <div class="block-header block-header-default">
            <span class="block-title">
                 <h2 class="content-heading">List Pending Invoice</h2>
            </span>
                               
        </div>
        <div>
            
            
       
        </div>
        <hr>
        <div class="block-content">
            <div class="table-responsive">
                 <div id="ermsg"> <?= $this->session->flashdata('ermsg'); ?>  </div>
                <table class="table table-striped table-vcenter">
                    <thead> 
                        <tr>
                            <th>Trip sheet Id </th>
                            <th>Invoice Number</th>
                            <th>Cargo Name</th>
                          
                        </tr>
                    </thead>
                    <tbody>
<?php
if($pending_invoices!=null)
{
foreach ($pending_invoices as $key => $resultvlu) {
?>
                        <tr>
                            <td>
                                <b><?=$resultvlu->trip_sheet_id?></b>
                            </td>
                            <td>
                                <?=$resultvlu->invoice_number?>
                            </td>
                            <td>
                                <?=$resultvlu->cargo_name?>
                            </td>
                            
                        </tr>
<?php
}
}
?> 
                    </tbody>
                </table>


<div align="right">
<ul class="pagination">

<!-- Show pagination links -->
<?php  /*foreach ($links as $link) {

echo "<li>". $link."</li>";
}  */ ?>
</div>
            </div>
        </div>
    </div>
    <!-- END Full Table -->

</div>
<!-- END Page Content -->

</main>
<!-- END Main Container -->