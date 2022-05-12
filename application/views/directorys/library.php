   <div><a href="<?php echo base_url();?>Librarys/add" ><img src="<?php echo str_replace('/index.php', '', base_url());?>images/add.png" alt="Додати" class="login-card-img" width="32" height="32"></a></div>
<table class="table table-striped"  width="100%">
<thead style="background: #CFCFCF">
    <tr>
<th>Дії</th>
<th>№</th>
<th>ID</th>
<th>Назва бібліотеки</th>
<th>Тип бібліотеки</th>
<th>Тип нас. пункта</th>
<th>Населений пункт</th>
<th>Адреса</th>
</tr>
</thead>
<tfoot>
</tfoot>
<tbody>
    <?php $no=1; foreach ($librarys as $library) {?>    
    <tr>
        <td>
            <a href="<?php echo base_url();?>Librarys/edit?id=<?php echo $library['library_id'];?>" ><img src="<?php echo str_replace('/index.php', '', base_url());?>images/edit.png" alt="Редагувати" class="login-card-img" width="32" height="32"></a>    
            <a href="<?php echo base_url();?>Librarys/del?id=<?php echo $library['library_id'];?>" ><img src="<?php echo str_replace('/index.php', '', base_url());?>images/delete.png" alt="Редагувати" class="login-card-img" width="32" height="32"></a>    
        </td>
        <td><?php echo $no;?></td>
        <td><?php echo $library['library_id'];?></td>
        <td><?php echo $library['library_name'];?></td>
        <td><?php echo $library['lt_name'];?></td>
        <td><?php echo $library['library_sity_type'];?></td>
        <td><?php echo $library['library_sity'];?></td>
        <td><?php echo $library['library_address'];?></td> 
    </tr><!-- comment -->
   <?php $no++; }?>
</tbody>
</table>


<?php