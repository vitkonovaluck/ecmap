<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Документ</th>
      <th scope="col">Період</th>
      <th scope="col">Бібліотека</th>
      <th scope="col">Відділ</th>
      <th scope="col">Статус</th>
    </tr>
    <tr>
    <form action="<?php echo base_url();?>" method="post">  
        <input type="hidden" name="filters" value="2217">
        <input type="hidden" name="fltr_doc" value="0">
        <input type="hidden" name="fltr_period" value="0">
        <input type="hidden" name="fltr_libr" value="0">
        <input type="hidden" name="fltr_status" value="0"> 
        
      <th scope="col"><button class="btn btn-primary" type="submit">Всі</button></th>
    </form>  
    <form action="<?php echo base_url();?>" method="post">  
        <input type="hidden" name="filter" value="22">
      <th scope="col"><select name="fltr_doc" class="form-select" aria-label="Документ" onchange="this.form.submit()">
                        <option value="0" selected>--Всі--</option>
                        <?php foreach ($document_doc as $dd) {?>
                            <option value="<?php echo $dd['document_id'];?>"<?php if($dd['document_id']==$_SESSION['fltr_doc']){echo 'selected';}?>><?php echo $dd['document_name'];?></option>
                        <?php }?>
                      </select>
      </th>
      <th scope="col"><select name="fltr_period" class="form-select" aria-label="Період" onchange="this.form.submit()">
                        <option value="0">--Всі--</option>
                        <?php foreach ($period_doc as $dd) {?>
                            <option value="<?php echo $dd['period_id'];?>" <?php if($dd['period_id']==$_SESSION['fltr_period']){echo 'selected';}?>><?php echo $dd['period_name'];?></option>
                        <?php }?>
                      </select></th>
      <th scope="col"><select name="fltr_libr" class="form-select" aria-label="Бібліотека" onchange="this.form.submit()">
                        <option value="0" selected>--Всі--</option>
                        <?php foreach ($library_doc as $dd) {?>
                            <option value="<?php echo $dd['library_id'];?>" <?php if($dd['library_id']==$_SESSION['fltr_libr']){echo 'selected';}?>><?php echo $dd['library_name'];?></option>
                        <?php }?>
                        </select></th>
                        <th scope="col"><!-- <select class="form-select" aria-label="Відділи">
                        <option value="0" selected>--Всі--</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                      </select>comment --></th>
      <th scope="col"><select name="fltr_status" class="form-select" aria-label="Статуси" onchange="this.form.submit()">
                        <option value="0" selected>--Всі--</option>
                        <?php foreach ($status_doc as $dd) {?>
                            <option value="<?php echo $dd['ds_id'];?>" <?php if($dd['ds_id']==$_SESSION['fltr_status']){echo 'selected';}?>><?php echo $dd['ds_name'];?></option>
                        <?php }?>
          </select> </th>
    </form>              
    </tr>
  </thead>
  <tbody>
    <?php $i=1; foreach ($journal_doc as $jd){?>
      <tr <?php echo $jd['ds_class'];?> onclick="javascript:open_doc(<?php echo $jd['journal_id'];?>);">
      <th scope="row"><?php echo $i; $i++;?></th>
      <td><?php echo $jd['document_name'];?></td>
      <td><?php echo $jd['period_name'];?></td>
      <td><?php echo $jd['library_name'];?></td>
      <td><?php echo $jd['dep_name'];?></td>
      <td><?php echo $jd['ds_name'];?></td>
    </tr>
    <?php }?>
  </tbody>
</table>
    
    <?php