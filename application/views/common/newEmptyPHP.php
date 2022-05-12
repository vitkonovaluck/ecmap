   <ul id="navbar" class="dropdown-menu">
	  <li><a href="#">Главная</a></li>
          
         <li><a href="#">Довідники</a>
	     <ul>
		 <li><a href="#">Клієнти</a></li>
             </ul>        
         </li>
	  <li><a href="#">Документи</a>
	    <ul class="sub-menu">
                <?php foreach($menu_rows as $menu):?>
                    <li class="sub"><a href="javascript:edit_doc(<?php echo $menu['doc_id']?>,0)"><?php echo $menu['doc_name']?></a></li>
                <?php endforeach; ?>
		
	    </ul>        
	  </li>
	  <li><a href="#">Звіти</a></li>
        </ul>
        
function load_doc(id){
    $.ajax({
        url:"<?php echo base_url();?>Upload?id="+id+"&dialog=0",
        method:"POST",
        data:{id},
        success:function(data){document.getElementById("pdialog").innerHTML=data;}
    });
    $("#pdialog").dialog({
        autoOpen: false,
        width: 450,
        height: 230,
        modal: true,
        resizable: false
    });
    $("#pdialog").dialog('open');

}
