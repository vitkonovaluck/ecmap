<script type="text/javascript">
function set_passw(id){
	if(confirm(" Змінити пароль?")) {
            result = prompt("Задайте новий пароль","");
            if(result.length >0){
                result1 = prompt("Поаторіть новий пароль","");
                if(result == result1){
                    console.log("set_passw:<?php echo base_url();?>Login/set_passw?id="+id+"&txt="+result1);
                    $.ajax({                       
                        url:"<?php echo base_url();?>Login/set_passw?id="+id+"&txt="+result1,
                        method:"POST",
                        data:{id},
                        success:function(data){
                            if(data == 1){
                                alert("Пароль змінено!");
                            }else{
                                alert("Пароль не змінено!");
                            }
                        }    
                    });
                }else{
                    alert("Паролі не співпадають!");
                }
            }
       
	}
}</script>

<div><?php if($_SESSION['user_priv']>1){?>
       <a href="<?php echo base_url();?>Librarians/add" ><img src="<?php echo str_replace('/index.php', '', base_url());?>images/add.png" alt="Додати" class="login-card-img" width="32" height="32"></a></div>
   <?php }?>
<table class="table table-striped"  width="100%">
<thead style="background: #CFCFCF">
    <tr>
<th>Дії</th>
<th>№</th>
<th>ID</th>
<th>Призвіще</th>
<th>Ім'я та По-батькові</th>
<th>Бібліотека</th>
<th>Відділ</th>
<th>Телефон</th>
<th>E-mail</th>
<th>Права</th>
</tr>
</thead>
<tfoot>
</tfoot>
<tbody>
    <?php $no=1; foreach ($librarians as $library) {?>    
    <tr>
        <td width="8%">
            <a href="<?php echo base_url();?>Librarians/edit?id=<?php echo $library['user_id'];?>" ><img src="<?php echo str_replace('/index.php', '', base_url());?>images/edit.png" alt="Редагувати" class="login-card-img" width="32" height="32"></a>    
            <?php if($_SESSION['user_priv']>4){?><a href="<?php echo base_url();?>Librarians/del?id=<?php echo $library['user_id'];?>" ><img src="<?php echo str_replace('/index.php', '', base_url());?>images/delete.png" alt="Редагувати" class="login-card-img" width="32" height="32"></a>    <?php }?>
            <a href="javascript:set_passw(<?php echo $library['user_id'];?>)" ><img src="<?php echo str_replace('/index.php', '', base_url());?>images/passw.png" alt="Змінити пароль" class="login-card-img" width="32" height="32"></a>    
        </td>
        <td><?php echo $no;$no++;?></td>
        <td><?php echo $library['user_id'];?></td>
        <td><?php echo $library['user_name'];?></td>
        <td><?php echo $library['user_fname'];?></td>
        <td><?php echo $library['library_name'];?></td>
        <td><?php echo $library['dep_name'];?></td>
        <td><?php echo $library['user_login'];?></td>
        <td><?php echo $library['user_email'];?></td> 
        <td><?php echo $library['priv_name'];?></td> 
    </tr><!-- comment -->
   <?php }?>
</tbody>
</table>


<?php