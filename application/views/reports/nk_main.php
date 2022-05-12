 <script src='https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js'></script>

<script id="rendered-js" >
    let button = document.querySelector("#button-excel");

    button.addEventListener("click", e => {
      let table = document.querySelector("#simpleTable1");
      TableToExcel.convert(table);
    });
//# sourceURL=pen.js
</script><!-- comment -->

       
<script type="text/javascript">

$(function () {
    var html = ["<style type='text/css'>"];

    for (var i = 0; i <= 500; i += 5) {
        html.push(".h", i, "px { ");
        html.push("height:", i, "px; ");
        html.push("max-height:", i, "px; ");
        html.push("min-height:", i, "px; ");
        html.push("overflow:hidden; ");
        html.push("}\r\n");

        html.push("span.h", i, "px { display:inline-block; }\r\n");

        html.push(".w", i, "px { ");
        html.push("width:", i, "px; ");
        html.push("max-width:", i, "px; ");
        html.push("min-width:", i, "px; ");
        html.push("overflow:hidden; ");
        html.push("}\r\n");
    }

    html.push("</style>");

    $("head").append(html.join(""));
});

</script>    

<div style="width: 100%; height: <?php echo $hgth;?>; padding: 0 25px 0 0; overflow: auto;">
<?php  echo $stts;?>
    

<p>     </p><!-- comment -->
<table id="simpleTable1"><tr><td>
<?php foreach ($rep_title as $rt){?>
<?php $cl_cnt=$table_col[$rt['id']];?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th rowspan="5" colspan="2" style="width: 350px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </th>
            <th colspan="<?php echo $cl_cnt;?>"><b><?php echo $rt['name'];?></b></th>
        </tr>
        <tr>
        <?php foreach ($table_head1[$rt['id']] as $th){?>
            <td colspan="<?php echo $th['colspan'];?>" rowspan="<?php echo $th['rowspan'];?>"><?php echo $th['name'];?></td>
        <?php } ?>
        </tr>
        <tr>
        <?php foreach ($table_head2[$rt['id']] as $th2){?>
            <td colspan="<?php echo $th2['colspan'];?>" rowspan="<?php echo $th2['rowspan'];?>"><?php echo $th2['name'];?></td>
        <?php } ?>
        </tr>
        <tr>
        <?php foreach ($table_head3[$rt['id']] as $th3){?>
                <?php if(strlen($th3['css'])>0){$clas = 'class = "'.$th3['css'].'"';}else{$clas = '';}?>
            <td colspan="<?php echo $th3['colspan'];?>" rowspan="<?php echo $th3['rowspan'];?>"<?php echo $clas;?>><?php echo $th3['name'];?></td>
        <?php } ?>
        </tr>
        <tr>
        <?php for($c=1;$c<=$table_col[$rt['id']];$c++){?>
            <td><?php echo $c;?></td>
        <?php } ?>
        </tr>
    </thead>
    <tbody>
        <!-- Всього -->
    <tr><th colspan="2"  style="width: 350px;">Всього </th>
    <?php for($c=1;$c<=$cl_cnt;$c++){?>
        <?php $rs=4; ?>
        <th  align="center"><?php echo $rep_sum[$rt['id']][$c]; ?></th>
    <?php } ?>
         
    </tr>  
    <?php if(isset($rep_data[$rt['id']]))if(count($rep_data[$rt['id']]) > 0 ){?>
    <?php   for($a=0;$a<count($rep_data[$rt['id']]);$a++){?>
        <tr>
           <th><?php echo $a+1; ?></th> 
           <th style="width: 350px;"><?php echo $rep_data[$rt['id']][$a][0]; ?></th>    
          <?php for($b=1;$b<count($rep_data[$rt['id']][$a]);$b++){?>
                   <td  align="right"><?php echo $rep_data[$rt['id']][$a][$b]; ?></td>    
    <?php       }
        echo '</tr>';
    }
?>
    
    
    <?php }?>
    </tbody>
    
</table>

<p>     </p>
<?php }?>>
        </td></tr></table>                     
</div>
