<div align="center">
<form name="periods" action="<?php echo base_url();?>Document/changes_status" method="post">
    <input name="doc_id" type="hidden" value="<?php echo $doc_id;?>">
    <input name="doc_os" type="hidden" value="<?php echo $old_stat_id;?>">
    <input name="doc_ns" type="hidden" value="<?php echo $new_stat_id;?>">
    <table border="0">
       <tr><td align="center" colspan="2">Змінити статус документа</td></tr>
       <tr><td align="center" colspan="2"><?php echo $doc_name;?></td></tr>
       <tr><td align="center" colspan="2">з <i><?php echo $old_stat;?></i> на <i><?php echo $new_stat;?></i>?</td></tr>
       <tr>
           <td><input align="center" name="passw" type="password" value="" placeholder="Введіть пароль"></td>
            
       </tr>
       <tr><td align="center" colspan="2"><input type="submit" value="Підтвердити"></td></tr>
    </table>   
</form>
    </div>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

