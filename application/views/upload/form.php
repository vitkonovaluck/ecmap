<html>
<head>
<title>Upload Form</title>
</head>
<body>

<?php echo $error;?>


<form name="periods" action="<?php echo base_url();?>upload/do_upload" enctype="multipart/form-data" method="post">    
    <input name="doc_id" type="hidden" value="<?php echo $doc_id;?>">
    <table border="0">
        <tr><td align="center"><b>Загрузити документ</b>
                <br> <?php echo $doc_name;?>
            </td></tr>
       <tr><td><input type="file" name="userfile" size="20" /></td></tr>
       <tr><td align="center" ><input type="submit" value="Загрузити"> <input class="docum-form-btn1" type="button" value="Закрити" onclick="location.href='<?php echo base_url();?>'"></td></tr>
    </table> 
</form>

</body>
</html>