<div>
<table>
<tr>

    <td>Invoice no</td>
    <td>Lr No </td>
</tr>

<?php  foreach( $checkValues as $val) { ?>
<tr>

    <td>   <input type="text" name="invoice_no[]" value="<?=$val?>"> </td>
    <td> <input type="text" name="lr_no[]"></td>
</tr>
    


<?php 
}
 ?>
</table>
</div>
