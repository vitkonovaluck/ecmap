<?php  
 foreach ($doc_title as $dt){
?>
<div id="doc_title" <?php echo $dt['ds_class'];?> >
        <div class="fill-caption-right" style="float: right; margin-top: -3px;">
        <?php if($dt['ds_id'] == 2)
             if($dt['journal_user']==$_SESSION['user_id']){ ?>   
            <input type="button" value="Надіслати" name="send" onclick="javascript:send_doc()">
        <?php }
              if($dt['ds_id'] == 3)
                if($this->CI->user_privilege($dt['journal_user'])<$this->CI->user_privilege($_SESSION['user_id'])){ ?>   
                <input type="button" value="Перевірити" name="check" onclick="javascript:check_doc()">
                <input type="button" value="Повернути" name="back" onclick="javascript:back_doc()">
            <input type="button" value="Прийняти" name="accept" onclick="javascript:accept_doc()">
        <?php }
             if($dt['ds_id'] == 4){
             if($dt['journal_user']==$_SESSION['user_id']){ ?>   
            <input type="button" value="Надіслати" name="send" onclick="javascript:send_doc()">
             <?php } 
             if($_SESSION['user_id']==1){ ?>   
            <input type="button" value="Надіслати" name="send" onclick="javascript:send_doc()">
             <?php }
             
             }
        
            ?>
                <span id="doc_stat" class="label label-big label-important".label.label-big style="font-weight: bold;"><?php echo $dt['ds_name'];?></span>
        </div>
        <div id="fill_caption" class="fill-caption" style="font-size: 140%;font-weight: bold;">
            <span><?php echo $dt['library_name'].', звіт "'.$dt['document_name'].' [за період:'.$dt['period_name'].']"'?></span>
        </div>
</div>
 <?php }?>