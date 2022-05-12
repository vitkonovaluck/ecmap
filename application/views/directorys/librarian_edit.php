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
                        Видалення бібліотекарів
                         <?php }else{?>
                        Редагування бібліотекарів
                         <?php }?></h1>

                <form action="<?php echo base_url();?>Librarians/save" method="post">
                  <!-- 2 column grid layout with text inputs for the first and last names -->
                  <input type="hidden" name="user_id" value="<?php echo $user_datas['user_id'];?>">
                  <div class="row">
                    <div class="col-12 col-md-6 mb-4">
                      <div class="form-outline">
                        <label class="form-label" for="form6Example2">Призвіще</label>
                        <input type="text" <?php echo $readonly;?> id="form6Example2" class="form-control" name="user_name" value="<?php echo $user_datas['user_name'];?>"/>
                        
                      </div>
                    </div>
                    <div class="col-12 col-md-6 mb-4">
                      <div class="form-outline">
                        <label class="form-label" for="form6Example1">Ім'я та По-батькові</label>
                        <input type="text" <?php echo $readonly;?> id="form6Example2" class="form-control" name="user_fname" value="<?php echo $user_datas['user_fname'];?>"/>
                          
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 col-md-6 mb-4">
                      <div class="form-outline">
                        <label class="form-label" for="form6Example1">Бібліотека</label>
                            <select id="form6Example2" <?php echo $readonly;?> class="form-control" name="user_libr">
                              <?php foreach ($librarys as $lt){?>
                                <option value="<?php echo $lt['library_id'];?>"
                                <?php if($lt['library_id']==$user_datas['user_libr']){echo 'selected';}  ?>        
                                ><?php echo $lt['library_name'];?></option>
                              <?php }?>
                            </select>
                    
                      </div>
                    </div>
                    <div class="col-12 col-md-6 mb-4">
                      <div class="form-outline">
                        <label class="form-label" for="form6Example1">Відділ</label>
                            <select id="form6Example2" <?php echo $readonly;?> class="form-control" name="user_dep">
                              <?php foreach ($departament as $dep){?>
                                <option value="<?php echo $dep['dep_id'];?>"
                                <?php if($dep['dep_id']==$user_datas['user_dep']){echo 'selected';}  ?>        
                                ><?php echo $dep['dep_name'];?></option>
                              <?php }?>
                            </select>
                    
                      </div>
                   </div>     
                  </div>
                 
                  <!--                    
 -->
                  <div class="row">
                    <div class="col-12 col-md-6 mb-4">
                      <div class="form-outline">
                        <label class="form-label" for="form6Example2">Телефон</label>
                        <input type="number" <?php echo $readonly;?> id="form6Example2" class="form-control" name="user_login" value="<?php echo $user_datas['user_login'];?>"/>
                      </div>
                    </div>
                    <div class="col-12 col-md-6 mb-4">
                      <div class="form-outline">
                        
                        <label class="form-label" for="form6Example2">Електронна пошта</label>
                        <input type="email" <?php echo $readonly;?> id="form6Example2" class="form-control" name="user_email" value="<?php echo $user_datas['user_email'];?>"/>
                        
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 col-md-6 mb-4">
                      <div class="form-outline">
                          <label class="form-label" for="form6Example2">Права</label><?php count($privilege);?>
                                  <select id="form6Example2" <?php echo $readonly;?> class="form-control" name="user_priv">
                              <?php foreach ($privilege as $priv){?>
                                <option value="<?php echo $priv['priv_id'];?>"
                                <?php if($priv['priv_id']==$user_datas['user_priv']){echo 'selected';}  ?>        
                                ><?php echo $priv['priv_name'];?></option>
                              <?php }?>
                            </select>
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
                        <button type="button" class="btn btn-secondary btn-rounded btn-block" onclick="location.href='<?php echo base_url();?>Librarians'">Назад</button>
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

