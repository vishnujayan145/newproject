<main id="main-container">
<!--add-->
    <?php
    if (isset($error)) {
        echo "<script>alert('$error');</script>";
    } ?>
<!--end-->
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Download Backup</h2>

        <!-- Full Table -->
        <div class="block">
            <div class="block-content">
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Download Backup</h3>
                    </div>
                    <div class="block-content">
 
  
                        <!--  -->
                            <div id="ermsg"> <?= $this->session->flashdata('msgx'); ?>  </div>
                            <div class="form-group">
                         
                                <?php
                                if(!empty( $files)) {?>
                                <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>File name</th>
                                    <th>Action</th> 
                                </tr>
                                </thead>
                                <tbody>  
                                    <?php
                                        foreach($files as $file){
                                            if(is_string($file)){ ?>
                                            <tr> 
                                            <td><?=$file?></td> <td>  
                                            <button onclick="location.href='<?= base_url() ?>dashboard/download/<?=$file?>'"  class="btn btn-md btn-primary" type="button"  >
                                            <i class="fa fa-download"></i> Download  </button> 

                                            <a href="<?= base_url() ?>dashboard/delete/<?=$file?>"  class="btn btn-md btn-danger" type="button"  
                                            onclick="return confirm('Are you sure you want to delete?');">
                                            <i class="fa fa-trash"></i> Delete  </a> 

                                           
                                            </td>
                                            </tr>
                                            
                                            <?php                                    		 
                                            }
                                        }
                                    ?>
                                </tbody>
                                </table>

                                   <?php
                                } else {
                                    echo "No backup files to download";
                                }
                                ?>

                            </div> 
                             
                        <!-- </form> -->
                       
                    </div>
                </div>
            </div>
        </div>
        <!-- END Full Table -->

    </div>
    <!-- END Page Content -->

</main>
<script>
 
</script>

