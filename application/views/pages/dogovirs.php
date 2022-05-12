          
        <?php foreach($d_dogovirs as $dogovirs):?>
		<option value="<?php echo $dogovirs['journal_id'];?>"><?php echo $dogovirs['doc_name']." № ".$dogovirs['journal_numb']." від ".$dogovirs['journal_date'];?></option>
	<?php endforeach; ?>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

