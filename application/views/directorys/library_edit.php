<section class="intro">
  <div class="bg-image-vertical h-100" style="background-color: #34383c;">
    <div class="mask d-flex align-items-center h-100">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-lg-10">
            <div class="card" style="border-radius: 1rem;">
              <div class="card-body p-5">

                <h1 class="mb-5 text-center">
                         <?php if(strlen($readonly) >0){?>
                        Видалення бібліотек
                         <?php }else{?>
                        Редагування бібліотек
                         <?php }?></h1>

                <form action="<?php echo base_url();?>Librarys/save" method="post">
                  <!-- 2 column grid layout with text inputs for the first and last names -->
                  <input type="hidden" name="library_id" value="<?php echo $library_datas['library_id'];?>">
                  <div class="row">
                    <div class="col-12 col-md-6 mb-4">
                      <div class="form-outline">
                        <label class="form-label" for="form6Example2">Назва</label>
                        <input type="text" <?php echo $readonly;?> id="form6Example2" class="form-control" name="library_name" value="<?php echo $library_datas['library_name'];?>"/>
                        
                      </div>
                    </div>
                    <div class="col-12 col-md-6 mb-4">
                      <div class="form-outline">
                        <label class="form-label" for="form6Example1">Тип бібліотеки</label>
                          <select id="form6Example2" <?php echo $readonly;?> class="form-control" name="library_type">
                              <?php foreach ($library_type as $lt){?>
                                <option value="<?php echo $lt['lt_id'];?>"
                                <?php if($lt['lt_id']==$library_datas['library_type']){echo 'selected';}  ?>        
                                ><?php echo $lt['lt_name'];?></option>
                              <?php }?>
                          </select>
                        
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 col-md-6 mb-4">
                      <div class="form-outline">
                        <label class="form-label" for="form6Example1">Тип населеного пункту</label>
                        <input type="text" <?php echo $readonly;?> id="form6Example1" class="form-control" name="library_sity_type" value="<?php echo $library_datas['library_sity_type'];?>"/>
                       
                      </div>
                    </div>
                    <div class="col-12 col-md-6 mb-4">
                      <div class="form-outline">
                        <label class="form-label" for="form6Example2">Населений пункт</label>
                        <input type="text" <?php echo $readonly;?> id="form6Example2" class="form-control" name="library_sity" value="<?php echo $library_datas['library_sity'];?>"/>
                        
                      </div>
                    </div>
                  </div>

                  <!-- Text input -->
                  <div class="row">
                    <div class="col-12 col-md-6 mb-4">
                      <div class="form-outline">
                        <label class="form-label" for="form6Example2">Адреса</label>
                        <input type="text" <?php echo $readonly;?> id="form6Example2" class="form-control" name="library_address" value="<?php echo $library_datas['library_address'];?>"/>
                      </div>
                    </div>
                    <div class="col-12 col-md-6 mb-4">
                      <div class="form-outline">
                        
                      </div>
                    </div>
                  </div>

                  
                              <!-- Submit button -->
                 <div class="row">
                    <div class="col-12 col-md-6 mb-4">
                         <?php if(strlen($readonly) >0){?>
                        <button type="submit" class="btn btn-danger btn-rounded btn-block">Видалити</button>
                         <?php }else{?>
                        <button type="submit" class="btn btn-success btn-rounded btn-block">Зберегти</button>
                         <?php }?>
                         
                    </div>
                    <div class="col-12 col-md-6 mb-4">
                        <button type="button" class="btn btn-secondary btn-rounded btn-block" onclick="location.href='<?php echo base_url();?>Librarys'">Назад</button>
                    </div>
                 </div>     
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php