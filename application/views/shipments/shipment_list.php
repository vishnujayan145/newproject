<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Shipment list</h4>                       

                    </div>
                </div>
            </div>
            <!-- end page title -->

             
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">    

                            <div class="block" style="margin-top:50px;">
                                <div class="block-content tails">
                                    <div id="selCnt" style="font-weight:bold"><?php if(isset($total_sel_cnt)) {
                                        echo "Total Count : ". $total_sel_cnt;} ?></div> 
                                </div> 
                            </div>

                            <button onclick="location.href='<?= base_url() ?>shipment/transfer_list/<?=$shipment_id?>'"  class="btn btn-primary" type="button">Shipment Transferred List</button> 
                
 
                           
                           
                        </div>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
<!-- 
                            <h4 class="card-title">Textual inputs</h4>
                            <p class="card-title-desc">Here are examples of <code>.form-control</code> applied to
                                each
                                textual HTML5 <code>&lt;input&gt;</code> <code>type</code>.</p> -->




                                <div class="table-rep-plugin">
                                    <div class="table-responsive mb-0" data-pattern="priority-columns">
                                        <table id="tech-companies-1" class="table">
                                            <thead>
                                                <tr>
                                                    
                                                <th><input type="checkbox" id="allcb" name="allcb" /></th> 
                                                <th>Sl No</th>
                                                <th>Sort Order</th>
                                                <th>Transfer Status</th>
                                                <th>Company</th>
                                                <th>Ship.Name</th> 
                                                <th>Agency Name</th>
                                                <th>Origin</th>
                                                <th># No</th>
                                                <th>Tracking Number</th>
                                                <th>Trip Number</th>
                                                <th>Invoice</th>
                                                <th>Pcs</th>
                                                <th>Weight</th>
                                                <th>Re weight</th>
                                                <th>Recieved Pcs</th>
                                                <th >Sender Address</th>
                                                <th>Reciever Address</th>
                                                <th>Phone</th>
                                                <th>Sate</th>
                                                <th>District</th>
                                                <th>Pincode</th>
                                                <th>Desc. of Goods</th>
                                                <th>Recieved at Hub</th>
                                                <th>Connecting Date</th>
                                                <th>Recieved at Branch</th>
                                                <th>Vendor</th>
                                                <th>Contact Number</th>
                                                <th>Docket</th>
                                                <th>Status</th>
                                                <th>Remark</th>
                                                <th>Sending Date</th>
                                                <th>Recciev.Date</th>
                                                <th class="text-center" style="width: 100px;">Actions</th>


                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if ($result != null) {
                                                foreach ($result as $key => $resultvlu) {                                         
                                                        $params = "";
                                                        $params .=$resultvlu->id;
                                                        (trim($resultvlu->rewight)!="") ? $params .= ",".$resultvlu->rewight : $params .= ","."undefined";
                                                        ($resultvlu->received_pcs!="") ? $params .= ",".$resultvlu->received_pcs : $params .= ","."undefined";
                                                        ($resultvlu->recieved_at_hub!="") ? $params .= ",`".date('Y-m-d',strtotime($resultvlu->recieved_at_hub))."`" : $params .= ","."undefined";
                                                        ($resultvlu->connecting_date!="") ? $params .= ",`".date('Y-m-d',strtotime($resultvlu->connecting_date))."`" : $params .= ","."undefined";
                                                        ($resultvlu->vendor!="") ? $params .= ",`".$resultvlu->vendor."`" : $params .= ","."undefined";
                                                        ($resultvlu->docket!="") ? $params .= ",`".$resultvlu->docket."`" : $params .= ","."undefined";
                                                        ($resultvlu->status) ? $params .= ",`".$resultvlu->status."`" : $params .= ","."undefined";
                                                        ($resultvlu->remarks) ? $params .= ",`".$resultvlu->remarks."`" : $params .= ","."undefined";
                                                        ($resultvlu->weight) ? $params .= ",`".$resultvlu->weight."`" : $params .= ","."undefined";
                                                        ($resultvlu->invoiceno) ? $params .= ",`".$resultvlu->invoiceno."`" : $params .= ","."undefined";
                                                        ($resultvlu->tracking_no) ? $params .= ",`".$resultvlu->tracking_no."`" : $params .= ","."undefined";
                                                        ($resultvlu->boxno) ? $params .= ",`".$resultvlu->boxno."`" : $params .= ","."undefined";
                                                        ($resultvlu->goods_status) ? $params .= ",`".$resultvlu->goods_status."`" : $params .= ","."undefined";
                                                        ($resultvlu->state) ? $params .= ",`".$resultvlu->state."`" : $params .= ","."undefined";
                                                        ($resultvlu->district) ? $params .= ",`".$resultvlu->district."`" : $params .= ","."undefined";
        
                                                        $goods_status =  strtolower($resultvlu->goods_status);
                                                        if($resultvlu->bg_color == NULL) {
                                                            if($goods_status == 'short') {
                                                                $color = "#b0ffb0";
        
                                                            } else if( $goods_status == 'hold') {
                                                                $color = "#ffbbbb";
        
                                                            } else if( $goods_status == 'received') {
                                                                $color = "#c0ecff";
        
                                                            }else {
                                                                $color = "#fff";
                                                            }
                                                        } else {
                                                            $color = $resultvlu->bg_color;
                                                        }
                                                    
                                            ?>
                                                    <tr style="font-size: 1rem; --bs-table-bg:<?=$color?>"  >
                                                        <td>
                                                            <?php  if(  strtolower($goods_status) != 'short'  &&  strtolower($goods_status) != 'hold' ) { 
                                                            ?>
                                                            <input type="checkbox" name="invoice[]"  class="checkbox-item" id="chkBx-<?= $resultvlu->id ?>"  value="<?= $resultvlu->id ?>"
                                                            <?php if($resultvlu->sort_order != NUll) { echo "checked";} ?>
                                                            /> 
                                                        <?php
                                                            }
                                                            ?>
                                                        
                                                        
                                                        </td>  
                                                        <td><?= $key + 1 ?></td>
                                                        <td><?= $resultvlu->sort_order ?></td>
                                                        <td><?= $resultvlu->transfer_status??'-' ?></td>
                                                        <td>
                                                            <!-- <button onclick="showStatusModel(<?=$params ?>)" class="btn btn-sm btn-success editBtn" data-toggle="tooltip" title="Edit this row">
                                                                <i class="fa fa-pencil"></i>
                                                            </button> -->
                                                            <?= $resultvlu->company ?>
                                                        </td>
                                                        <td><?= $resultvlu->shipmentname ?></td>
                                                        <td><?= $resultvlu->agencyname ?></td>
                                                        <td><?= $resultvlu->origin ?></td>
                                                        <td><?= $resultvlu->boxno ?></td>
                                                        <td><?= $resultvlu->tracking_no ?></td>
                                                        <td><?= $resultvlu->trip_no ?></td>
                                                        <td>
                                                            <?= isset($resultvlu->invoiceno)? $resultvlu->invoiceno :'--'?>
                                                        </td>
                                                        <td>
                                                            <?= $resultvlu->pcs ?>
                                                        </td>
                                                        <td>
                                                            <?= $resultvlu->weight ?>
                                                        </td>
                                                        <td>
                                                            <?= $resultvlu->rewight ?>
                                                        </td>
                                                        <td>
                                                            <?= $resultvlu->received_pcs ?>
                                                        </td>
                                                        <td  width="100px"><?= $resultvlu->sender_address  ?></td>
                                                        <td  width="100px"><?= $resultvlu->reciever_address ?></td>
        
                                                        <td><?= $resultvlu->phone ?></td>
                                                        <td><?= $resultvlu->state ?></td>
                                                        <td>
                                                            <?= $resultvlu->district ?>
                                                        </td>
                                                        <td><?= $resultvlu->pincode ?></td>
                                                        <td><?= substr($resultvlu->goods_desc,0,50) ?></td>
                                                        <td><?= $resultvlu->recieved_at_hub ?></td>
                                                        <td><?= $resultvlu->connecting_date ?></td>
                                                        <td><?= $resultvlu->recieved_at_branch ?></td>
                                                        <td><?= $resultvlu->vendor ?></td>
                                                        <td><?= $resultvlu->contact_no ?></td>
                                                        <td><?= $resultvlu->docket ?></td>
                                                        <td><?= $resultvlu->goods_status ?></td>
                                                        <td><?= $resultvlu->remarks ?></td>
                                                        <td>
                                                            <?= $resultvlu->sendingdate ?>
                                                        </td>
                                                        <td>
                                                            <?= $resultvlu->recievingdate ?>
                                                        </td> 

                                                        <td class="text-center">  
                                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                                <button type="button" class="btn btn-outline-secondary"  onclick="showDeleteModel(<?=$resultvlu->id ?>)"  data-toggle="tooltip" title="Delete" ><i class="mdi mdi-trash-can-outline"  style="font-size: 22px"></i></button>  
                                                                <button type="button" class="btn btn-outline-primary" data-toggle="tooltip" title="Print" onclick="location.href='<?= base_url() ?>goods_details/print/<?= $resultvlu->id ?>'" > <i class="mdi mdi-printer"  style="font-size: 22px"></i>  </button>
                                                                <button type="button" class="btn btn-outline-secondary" onclick="location.href='<?= base_url() ?>goods_details/update/<?= $resultvlu->id ?>'" >  <i class="fas fa-pencil-alt"  style="font-size: 22px"></i> </button>  
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
                                       
                                        <p><?php  echo $links; ?></p>
 
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