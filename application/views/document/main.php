<div id="report">

</div>
<?php foreach ($doc_title as $doct) {?>
<?php 
if($doct['journal_user']<>$_SESSION['user_id']){
$readonly_doc = "readonly='readonly'";  
}

if($_SESSION['user_id']==1){
$readonly_doc = "";  
}
if($doct['journal_status']>2)
    if($doct['journal_status']<>4){
        $readonly_doc = "readonly='readonly'";  
    }
?>

<div class="fill-report">
    <div id="title"> title
    </div>    
    <nav>
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <?php $i=0; $actv="";$arr_sel='';?> 
        <?php foreach ($doc_group as $docgr) {?>
          <?php if($i == 0){ 
                $actv=" active";
                $arr_sel='true';
                $i++; 
             }else{ 
                $actv="";
                $arr_sel='false';
            } ?>
            <button class="nav-link<?php echo $actv;?>" id="nav-<?php echo $docgr['id_name']?>-tab" data-bs-toggle="tab" data-bs-target="#nav-<?php echo $docgr['id_name']?>" type="button" role="tab" aria-controls="nav-<?php echo $docgr['id_name']?>" aria-selected="<?php echo $arr_sel?>"><?php echo $docgr['name']?></button>
        <?php  }?>

         </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <?php $i=0; $actv="";$arr_sel='';?> 
        <?php foreach ($doc_group as $docgr) {?>
          <?php if($i == 0){ 
                $actv="  show active";
                $arr_sel='true';
                
             }else{ 
                $actv="";
                $arr_sel='false';
            } ?>
        <?php $i++; ?>
        <div class="tab-pane fade<?php echo $actv;?>" id="nav-<?php echo $docgr['id_name'];?>" role="tabpanel" aria-labelledby="nav-<?php echo $docgr['id_name']?>-tab">
        <div class="center" style="height: <?php echo $hgth-140;?>px; margin-left: 160px;margin-right: 160px; max-width: 1024px;">
            <div class="fill-caption" style="font-size: 120%;font-weight: bold;">
                <span><?php echo $docgr['name']?></span>
            </div>

            <div class="fill-area" style="height: <?php echo $hgth-250;?>px;">
                <div>
                    <!<!-- onsubmit="return false;" data-bind="validate: true" novalidate="novalidate" -->
                    <form id="frmGroup<?php echo $docgr['id']?>" onchange="javascript:frm_group<?php echo $docgr['id']?>();" class="fill-form" metod="POST" action="http://192.168.1.253/biblio/index.php/Documents/save_doc?id=<?php echo $_GET['id'];?>" >
                        <input type="hidden" id="id" name="datas" value="123">
                        <input type="hidden" id="id" name="id" value="<?php echo $_GET['id'];?>">
                        
                        <?php foreach ($doc_sect[$docgr['id']] as $doc_sct) {?>
                            <div class="fill-section">
                              <?php if(strlen($doc_sct['description'])>1){?>  
                                <div class="alert alert-info"><?php echo $doc_sct['description'];?>  </div>       
                              <?php }?>                      
                            <table class="fill-table">
                                <tbody>
                                <?php foreach ($doc_field[$doc_sct['id']] as $doc_fld) {//readonly="'readonly'"?>
                                    <tr>
                                        <td class="td-label">
                                            <label class="control-label"><?php echo $doc_fld['name'];?></label>
                                        </td>
                                        <td class="td-controls">
                                            <?php if(strlen($doc_fld['formula'])>0){
                                                $readonlydoc="readonly=&#39;readonly&#39;";
                                             }else{
                                                 $readonlydoc=$readonly_doc;
                                             }?>
                                            
                                            <?php if($doc_fld['datatypeid'] == 1){?>
                                            <?php }ELSEif($doc_fld['datatypeid'] == 2){?>
                                               <input type="number"  class="form-control" title="<?php echo $doc_fld['name'];?>" <?php echo $readonlydoc;?> aria-required="true" name="ko_unique_<?php echo $doc_fld['id'];?>" id="ko_unique_<?php echo $doc_fld['id'];?>"  value="<?php echo $doc_data[$doc_fld['id']];?>">
                                            <?php }elseif($doc_fld['datatypeid'] == 3){?>
                                               <input type="text"   class="form-control" title="<?php echo $doc_fld['name'];?>" <?php echo $readonlydoc;?> aria-required="true" name="ko_unique_<?php echo $doc_fld['id'];?>"  id="ko_unique_<?php echo $doc_fld['id'];?>" value="<?php echo $doc_data[$doc_fld['id']];?>">
                                            <?php }elseif($doc_fld['datatypeid'] == 5){?>
                                               <textarea rows="3" cols="0"  title="<?php echo $doc_fld['name'];?>" <?php echo $readonlydoc;?> class="required valid" aria-required="true" name="ko_unique_<?php echo $doc_fld['id'];?>" aria-invalid="false"> <?php echo $doc_data[$doc_fld['id']];?></textarea>
                                            <?php }elseif($doc_fld['datatypeid'] == 6){?>    
                                               <?php $sel_array=explode(",",$doc_fld['select']); ?>
                                                <select  class="form-control"  title="<?php echo $doc_fld['name'];?>" <?php echo $readonlydoc;?> aria-required="true" name="ko_unique_<?php echo $doc_fld['id'];?>" id="ko_unique_<?php echo $doc_fld['id'];?>"  aria-invalid="false">
                                                    <?php foreach ($sel_array as $sel) {?>
                                                    <option value="<?php echo $sel; ?>" <?php if(strcmp($doc_data[$doc_fld['id']],$sel) == 0){echo ' selected=""';} ?>><?php echo $sel?></option>
                                                    <?php } ?>
                                                </select>
                                            <?php }else{?>
                                                <?php echo $doc_fld['datatypeid'];?>
                                            <?php }?>
                                               
                                        </td>
                                        <td class="td-postfix">
                                            <span><?php echo $doc_fld['postfix'];?></span>
                                        </td>
                                        <td class="td-message">
                                            <?php if(strlen($doc_fld['formula'])>0){?>
                                                <span class="label label-big validation-label">Розраховується автоматично</span>
                                            <?php }?>
                                                <span class="label label-big label-important validation-label" id="val_mess_<?php echo $doc_fld['id'];?>"  style="display: none"><font color="#FF0000"> <?php echo str_replace('^', '"', $doc_fld['validationmessage']);?></font></span>
                                        </td>
                                </tr>
                                <?php }?>                    
                                </tbody>
                            </table>    
                            </div>
                        <?php }?>                    
                        
                </form>
            </div>
    </div>
    <?php 
    if(strlen($readonly_doc)>2){
        $js="form_id";
    }else{
        $js="save_form_id";
    }
    ?>
    <?php if($i == 1){?>
            <div class="fill-buttons">
            <button type="button" class="btn"  disabled="" onclick="javascript:<?php echo $js;?>(<?php echo $docgr['id']?>,'p');">
                <i class="fa fa-arrow-left"></i>
                Попередня сторінка
            </button>
            
            <button type="button" class="btn"  onclick="javascript:<?php echo $js;?>(<?php echo $docgr['id']?>,'n');">
                Наступна сторінка
                <i class="fa fa-arrow-right fa-last"></i>
            </button>
        </div>
    <?php }elseif($i == count($doc_group)){ ?>        
            <div class="fill-buttons">
            <button type="button" class="btn"  onclick="javascript:<?php echo $js;?>(<?php echo $docgr['id']?>,'p');">
                <i class="fa fa-arrow-left"></i>
                Попередня сторінка
            </button>
            
            <button type="button" class="btn" onclick="javascript:<?php echo $js;?>(<?php echo $docgr['id']?>,'s');">
                Зберегти

            </button>
        </div>
    <?php }else{ ?>        
        <div class="fill-buttons">
            <button type="button" class="btn" onclick="javascript:<?php echo $js;?>(<?php echo $docgr['id']?>,'p');">
                <i class="fa fa-arrow-left"></i>
                Попередня сторінка
            </button>
            
            <button type="button" class="btn"  onclick="javascript:<?php echo $js;?>(<?php echo $docgr['id']?>,'n')">
                Наступна сторінка
                <i class="fa fa-arrow-right fa-last"></i>
            </button>
        </div>
    <?php } ?>        
            
        </div>
        </div>
      <?php  }?>
    </div>
</div>
<?php }?>
