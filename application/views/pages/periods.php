<div align="center">
<form name="periods" action="<?php echo base_url();?>Periods/changes" method="post">
    <input name="period" type="hidden" value="2">
    <table border="0">
       <tr><td align="center" colspan="2">Змінити період</td></tr>
       <tr>
            <td> з <input name="date1" type="date" value="<?php echo $period1;?>"></td>
            <td>по <input name="date2" type="date" value="<?php echo $period2;?>"></td>
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

