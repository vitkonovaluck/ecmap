<script type="text/javascript">


function save_form_id(fm,to){

   var errors=0;
   <?php foreach ($doc_group as $docgr) {?>
    if(fm == <?php echo $docgr['id']?>){
        errors += frm_group<?php echo $docgr['id']?>();
    }
   <?php }?>
   console.log("помилок: "+errors);
    if(errors == 0){
        datas = $('#frmGroup'+fm).serialize();
        $.ajax({
            url:"<?php echo base_url();?>Documents/save_doc?id=<?php echo $_GET['id'];?>",
            method:"POST",
            data:{datas},
            success:function(data){document.getElementById("report").innerHTML="Дані збережено!";console.log(data);}
        });
        if(to == 'n'){
            btn_next();
        }
        if(to == 'p'){
            btn_prev()
        }
        if(to == 's'){
            send_doc()
        }
        title_doc();
    }else{
        alert('На сторінці помилка! Перевірте будь-ласка дані.');   
    }    
    
}

function form_id(fm,to){

        if(to == 'n'){
            btn_next();
        }
        if(to == 'p'){
            btn_prev()
        } 
}


function send_doc(){
   var errors=0;
   <?php foreach ($doc_group as $docgr) {?>
    errors += frm_group<?php echo $docgr['id']?>();
   <?php }?>

    if(errors > 0){
        alert('У звіті помилка! Перевірте будь-ласка дані.');   
    }else{
        let issend = confirm("Ви впенені, що хочите відправити звіт?");
        
        if(issend){
            $.ajax({
                url:"<?php echo base_url();?>Documents/send_doc?id=<?php echo $_GET['id'];?>",
                method:"POST",
                data:{},
                success:function(data){
                    title_doc();
                }
            });
            alert( "Звіт відправлено" );
            document.location.href = "<?php echo base_url();?>";
        }else{
            alert( "Звіт не відправлено" );
        }
    }
//    $.ajax({
///        url:"http://microcode.ddns.net/biblio/index.php/Documents/send_doc_check?id="+<?php echo $_GET['id'];?>,
//       method:"POST",
//        data:{},
//        success:function(data){}
//    })

}

function back_doc(){
        let issend = confirm("Ви впенені, що хочите повернути звіт?");
        
        if(issend){
            $.ajax({
                url:"<?php echo base_url();?>Documents/back_doc?id=<?php echo $_GET['id'];?>",
                method:"POST",
                data:{},
                success:function(data){
                    title_doc();
                }
            });
            alert( "Звіт повернуто" );
            document.location.href = "<?php echo base_url();?>";
        }else{
            alert( "Звіт не повернуто" );
        }

}

function accept_doc(){
        let issend = confirm("Ви впенені, що хочите прийняти звіт?");
        
        if(issend){
            $.ajax({
                url:"<?php echo base_url();?>Documents/accept_doc?id=<?php echo $_GET['id'];?>",
                method:"POST",
                data:{},
                success:function(data){
                    title_doc();
                }
            });
            alert( "Звіт прийнято" );
            document.location.href = "<?php echo base_url();?>";
        }else{
            alert( "Звіт не прийнято" );
        }

}

   <?php foreach ($doc_group as $docgr) {?>


function frm_group<?php echo $docgr['id']?>(){
    var err = 0;
                <?php foreach ($formula_validat as $fv) {
                if($fv['groupid'] == $docgr['id']){
echo "////////////////////F O R M U L A////////////////////////////////////////////\n";
                    if(strlen($fv['formula'])>2){
                        $frml = $fv['formula'];
                        $frml = str_replace("{", "ko_unique_", $frml);
                        $frml = str_replace("}", "", $frml);
                        $tmpm = explode('+',$frml);
                        $q=1;
                        $total="var total=0";
                        foreach ($tmpm as $vals){
                            $vals = str_replace(" ", "", $vals);
    echo "\n    var a".$q." = parseInt($('input[name=".$vals."]').val());";
                        $total .=" + a".$q."";
                            $q++;
                        }
                    echo "\n    ".$total.";";    
                    echo "\n    document.getElementById('ko_unique_".$fv['id']."').value= total;\n";
                    }
echo "////////////////////V A L I D A T I O N ////////////////////////////////////////////\n";
                    if(strlen($fv['validation'])>2){
                        $frml1 = $fv['validation'];
    
                        $frml1 = str_replace("{", "ko_unique_", $frml1);
                        $frml1 = str_replace("}", "", $frml1);
                        $c_form = explode("&&",$frml1); //Якщо 2 та більше умов 
                        foreach ($c_form as $frml) {
                            $frml = str_replace("(", "  ", $frml);
                            $frml = str_replace(")", "", $frml);
                       
                            $func = 0;
                            $pos = strpos($frml, '==');
                            if($pos > 0){
                                $funk = 1;
                            }else{
                                $pos = strpos($frml, '<=');
                                if($pos > 0){
                                    $funk = 2;
                                }else{
                                    $pos = strpos($frml, '>=');
                                    if($pos > 0){
                                        $funk = 3;
                                    }else{
                                        $pos = strpos($frml, '<');
                                        if($pos > 0){
                                            $funk = 4;
                                        }else{
                                            $pos = strpos($frml, '>');
                                            if($pos > 0){
                                                $funk = 5;
                                            }                                    }    
                                    }
                                }    
                            }
                            switch ($funk) {
                                case 1:
                                    $funk_s = "==";
                                    break;
                                case 2:
                                    $funk_s = "<=";
                                    break;
                                case 3:
                                    $funk_s = ">=";
                                    break;
                                case 4:
                                    $funk_s = "<";
                                    break;
                                case 5:
                                    $funk_s = ">";
                                    break;
                            }
                            $uslov = explode($funk_s,$frml);
                            $val1 = str_replace(" ", "", $uslov[1]);
        echo "\n    var b = parseInt($('input[name=".$val1."]').val());";
                              $tmpm = explode('+',$uslov[0]);
                            $q=1;
                            $total="var total=0";
                            foreach ($tmpm as $vals){
                                $vals = str_replace(" ", "", $vals);
        echo "\n    var a".$q." = parseInt($('input[name=".$vals."]').val());";
                            $total .=" + a".$q."";
                                $q++;
                            }
                        echo "\n    ".$total.";";    


        echo "\n    if(total ".$funk_s." b){document.getElementById(\"".str_replace(' ', '', str_replace('ko_unique_', 'val_mess_', $uslov[1]))."\").style.display = \"none\";}else{err++;console.log(\"".$frml."\");document.getElementById(\"".str_replace(' ', '', str_replace('ko_unique_', 'val_mess_', $uslov[1]))."\").style.display = \"inline\";}";

                        echo "\n  \n";
                        }
                    }  
                }
                
            }echo "\n";?>   return err;
} 

   <?php }?>        



function title_doc(){    
    $.ajax({
        url:"<?php echo base_url();?>Documents/title_doc?id=<?php echo $_GET['id'];?>",
        method:"POST",
        data:{},
        success:function(data){document.getElementById("title").innerHTML=data;}
    })

}


function check_doc(){    
    $.ajax({
        url:"<?php echo base_url();?>Documents/check_doc?id=<?php echo $_GET['id'];?>",
        method:"POST",
        data:{},
        success:function(data){document.getElementById("title").innerHTML=data;}
    })

}


$(document).ready ( function(){
 title_doc();
 
});

    
    
    
            
function btn_next(){
    
        
    object = $('.nav-tabs  > .active').next('button');
    object.trigger('click');
    object.click();
    
 }

function btn_prev(){
    object = $('.nav-tabs  > .active').prev('button');
    object.trigger('click');
    object.click();
}
  
</script>
