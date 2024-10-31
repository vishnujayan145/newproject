<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Shipment Pending list</h4>                       

                    </div>
                </div>
            </div>
            <!-- end page title -->

             
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">                        
                         
                        </div>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
 




                                <div class="table-rep-plugin">
                                    <div class="table-responsive mb-0" data-pattern="priority-columns">
                                        <table id="tech-companies-1" class="table table-striped">
                                            <thead>
                                                <tr>
                                                    
                                                <th>Si</th>                                
                                                <th>Shipment Name</th>
                                                <th>Date</th> 
                                                <th class="text-center" style="width: 100px;">Actions</th>


                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if ($goods_transfer_list != null) {
                                                foreach ($goods_transfer_list as $key => $resultvlu) {  
                                                    $bgcolor ='';
                                                    if(  isset($goods_transfer_list_cnt[$resultvlu->id])  == 0) {                                         
                                                        $bgcolor ='background-color:red;color:#fff;';
                                                    }
                                                   
                                                    ?>   
                                                    <tr style="<?=$bgcolor?>">
                                                        <td><?=$key+1?></td>                                      
                                                        <td><?= $resultvlu->shipment_name ?></td>                                       
                                                        <td>
                                                            <?= date('d-m-Y', strtotime($resultvlu->created_at)) ?>
                                                        </td> 
                                                        <td class="text-center">
                                                        <div class="btn-group">                                            
                                                            <button onclick="location.href='<?= base_url() ?>goods_details/listTransferGoodsById/<?= $resultvlu->id ?>'"  class="btn btn-sm btn-secondary mr-5" type="button" data-toggle="tooltip" title="Edit">
                                                                    <i class="fa fa-eye"></i>View
                                                            </button>
                
                
                
                                                            <button onclick="backToGoodsGoods(<?= $resultvlu->id ?>);"  class="btn btn-sm btn-secondary ml-5" type="button" data-toggle="tooltip" title="Edit">
                                                                    <i class=""></i>Return
                                                            </button> 
                                                            </div>
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            }

                                            ?>  
                                            </tbody>
                                        </table>

                                        <div align="right">
                                       
                                        <p><?php //echo $links; ?></p>
 
                                    </div>
                                </div>
  

                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
    </div>
</div>