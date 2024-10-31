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
 
 
                                        <table id="tech-companies-1" class="table">
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
                                                    $font_color ='';
                                                    if(  isset($goods_transfer_list_cnt[$resultvlu->id])  == 0) {                                         
                                                        $bgcolor ='#e11717';
                                                        $font_color = "#fff;";
                                                    }
                                                   
                                                    ?>   
                                                    <tr style="--bs-table-bg:<?=$bgcolor?>;--bs-table-color:<?=$font_color?>">
                                                        <td><?=$key+1?></td>                                      
                                                        <td><?= $resultvlu->shipment_name ?></td>                                       
                                                        <td>
                                                            <?= date('d-m-Y', strtotime($resultvlu->created_at)) ?>
                                                        </td> 
                                                        <td class="text-center"  style="--bs-table-bg:#fff; ">
                                                            <div class="btn-group">                                            
                                                                <button onclick="location.href='<?= base_url() ?>goods_details/listTransferGoodsById/<?= $resultvlu->id ?>'"  class="btn btn-outline-success mr-5" type="button" data-toggle="tooltip" title="Edit">
                                                                        <i class="fa fa-eye"  style="font-size: 22px"></i>
                                                                </button> 
                    
                                                                <button onclick="backToGoodsGoods(<?= $resultvlu->id ?>);"  class="btn btn-outline-primary ml-5" type="button" data-toggle="tooltip" title="Edit">
                                                                        <i class=""  style="font-size: 22px"></i>Return
                                                                </button> 
                                                            </div>
                                                        </td>

<!--                                                         
                                                        <td class="text-center">  
                                                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                                    <button type="button" class="btn btn-outline-secondary"  onclick="showDeleteModel(<?=$resultvlu->id ?>)"  data-toggle="tooltip" title="Delete" ><i class="mdi mdi-trash-can-outline"  style="font-size: 22px"></i></button> 
                                                                    <button type="button" class="btn btn-outline-primary"  data-toggle="tooltip" title="POD" onclick="location.href='<?= base_url() ?>goods_details/print_pod/<?= $resultvlu->id ?>'" > <i class="mdi mdi-printer"  style="font-size: 22px"></i>  </button>
                                                                    <button type="button" class="btn btn-outline-danger" data-toggle="tooltip" title="Print" onclick="location.href='<?= base_url() ?>goods_details/print/<?= $resultvlu->id ?>'" > <i class="mdi mdi-printer"  style="font-size: 22px"></i>  </button>
                                                                    <button type="button" class="btn btn-outline-secondary" onclick="location.href='<?= base_url() ?>goods_details/update/<?= $resultvlu->id ?>'" >  <i class="fas fa-pencil-alt"  style="font-size: 22px"></i> </button>  
                                                                </div>
                                                            </td> -->

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