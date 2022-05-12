<table style="border-collapse: collapse; width: 100%; height: 670px;" border="0">
  <tbody>
    <tr style="height: 18px;">
      <td style="width: 100%; height: 16px; border-color: #1962ff;  text-align: center;  background-color: #1962ff;"><font color="#fffff"><strong>Електронний документ</strong></font></span></td>
    </tr>
    <tr style="height: 18px; background: #b6b6b6;">
      <td style="width: 100%; height: 18px;">
       <ul id="navbar">
	  <li><a href="#">Главная</a></li>
          
         <li><a href="#">Довідники</a>
	     <ul>
		 <li><a href="#">Клієнти</a></li>
             </ul>        
         </li>
	  <li><a href="#">Документи</a>
	    <ul>
                <?php foreach($menu_rows as $menu):?>
                    <li><a href="javascript:edit_doc('<?php echo $menu['doc_code']?>',0)"><?php echo $menu['doc_name']?></a></li>
                <?php endforeach; ?>
		
	    </ul>        
	  </li>
	  <li><a href="#">Звіти</a></li>
        </ul>
        
    </td>
    <tr style="height: 34px;">
      <td style="width: 100%; height: 34px;">
           <a href="<?php echo base_url();?>Login/logout"><img src="<?php echo base_url()."../stylesheet/img/exit.png";?>" width="32" height="32" alt="Вихід" border="0"></a>
                <?php foreach($menu_rows as $menu):?>
                    <?php
                     if(strlen($menu['doc_img'])>4){
                         $srcs = $menu['doc_img'];
                     }else{
                           $srcs = "null.png";
                     }
                    ?>
                    <a href="javascript:edit_doc('<?php echo $menu['doc_code']?>',0)"><img src="<?php echo base_url()."../stylesheet/img/".$srcs;?>" width="32" height="32" alt="<?php echo $menu['doc_name']?>" border="0"></a>
                <?php endforeach; ?>	
      </td>
    </tr>
   