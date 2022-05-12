<h1 align="center">Загальні відомості по</h1>         
<h2 align="center"><?php echo $dog_name;?></h2>

<table class="minimalistBlack"  width="100%">
<thead>
<tr>
<th width="80%">Документ</th>
<th width="15%">Сума</th>
<th width="5%"></th>
</tr>
</thead>
<tfoot>
<tr>
    <td>Документів:<?php echo count($j_rows);?></td>
    <td align="right"><b><?php echo $j_sum;?></b></td>
<td ></td>
</tr>
</tfoot>
        <?php foreach($d_dogovirs as $dogovirs):?>
		<option value="<?php echo $dogovirs['journal_id'];?>"><?php echo $dogovirs['doc_name']." № ".$dogovirs['journal_numb']." від ".$dogovirs['journal_date'];?></option>
	<?php endforeach; ?>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

