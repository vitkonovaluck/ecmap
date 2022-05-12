   <div><a href="<?php echo base_url();?>Menu/add" ><img src="<?php echo str_replace('/index.php', '', base_url());?>images/add.png" alt="Додати" class="login-card-img" width="32" height="32"></a></div>
<table class="minimalistBlack"  width="100%">
<thead style="background: #CFCFCF">
    <tr>
<th>Дії</th>
<th>№</th>
<th>Батько</th>
<th>Назва</th>
<th>Порядок</th>
<th>Адреса</th>
<th>Привелегія</th>
</tr>
</thead>
<tfoot>
</tfoot>
<tbody>
<?php function print_menu($menu_datas,$pid){ ?>    
   
    <?php foreach ($menu_datas as $ms){ ?>    
        <?php if($ms['menu_parrent']==$pid){?>
            
            <tr>
            <td>
                <a href="<?php echo base_url();?>Menu/edit?id=<?php echo $ms['menu_id']; ?>"><img src="<?php echo str_replace('/index.php', '', base_url());?>images/edit.png" alt="Редагувати" class="login-card-img" width="32" height="32"></a>
                <a href="<?php echo base_url();?>Menu/del?id=<?php echo $ms['menu_id']; ?>"><img src="<?php echo str_replace('/index.php', '', base_url());?>images/delete.png" alt="Видалити" class="login-card-img" width="32" height="32"></a>
                </th>
            <td><?php echo $ms['menu_id']; ?></td>
            <td><?php echo $ms['menu_parrent']; ?></td>
            <td><?php echo $ms['menu_name']; ?></td>
            <td><?php echo $ms['menu_sort']; ?></td>
            <td><?php echo $ms['menu_url']; ?></td></th>
            <td><?php echo $ms['priv_name']; ?></td></th>
            </tr>
            <?php print_menu($menu_datas,$ms['menu_id'])?>    
        <?php }?>    
    <?php }?>   
<?php }?>    

<?php print_menu($menu_datas,0)?>    
</tbody>
</table>


<?php