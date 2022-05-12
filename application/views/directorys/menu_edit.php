<section class="intro">
  <div class="bg-image-vertical h-100" style="background-color: #34383c;">
    <div class="mask d-flex align-items-center h-100">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-lg-10">
            <div class="card" style="border-radius: 1rem;">
              <div class="card-body p-5">

                <h1 class="mb-5 text-center">Редагування меню</h1>

                <form action="<?php echo base_url('Menu/save');?>" method="post">
                  <!-- 2 column grid layout with text inputs for the first and last names -->
                  <input type="hidden" name="menu_id" value="<?php echo $menu_datas['menu_id'];?>">
                  <input type="hidden" name="menu_icon" value="">
                <div class="row">
                    <div class="col-12 col-md-6 mb-4">
                      <div class="form-outline">
                        <label class="form-label" for="form6Example1">Меню</label>
                          <select id="form6Example2" class="form-control" name="menu_parrent">
                              <option value="0">---</option>
                              <?php foreach ($menu_all as $ma){?>
                                <option value="<?php echo $ma['menu_id'];?>"
                                <?php if($ma['menu_id']==$menu_datas['menu_parrent']){echo 'selected';}  ?>        
                                ><?php echo $ma['menu_name'];?></option>
                              <?php }?>
                          </select>
                        
                      </div>
                    </div>
                    <div class="col-12 col-md-6 mb-4">
                      <div class="form-outline">
                        <label class="form-label" for="form6Example2">Назва</label>
                        <input type="text" id="form6Example2" class="form-control" name="menu_name" value="<?php echo $menu_datas['menu_name'];?>"/>
                        
                      </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 mb-4">
                      <div class="form-outline">
                        <label class="form-label" for="form6Example1">Порядок сортування</label>
                        <input type="number" id="form6Example1" class="form-control" name="menu_sort" value="<?php echo $menu_datas['menu_sort'];?>"/>
                       
                      </div>
                    </div>
                    <div class="col-12 col-md-6 mb-4">
                      <div class="form-outline">
                        <label class="form-label" for="form6Example2">Адреса</label>
                        <input type="text" id="form6Example2" class="form-control" name="menu_url" value="<?php echo $menu_datas['menu_url'];?>"/>
                        
                      </div>
                    </div>
                </div>
                  
                <div class="row">
                    <div class="col-12 col-md-6 mb-4">
                      <div class="form-outline">
                        <label class="form-label" for="form6Example1">Права</label>
                            <select id="form6Example2" class="form-control" name="menu_priv">
                              <?php foreach ($privilege as $priv){?>
                                <option value="<?php echo $priv['priv_id'];?>"
                                <?php if($priv['priv_id']==$menu_datas['menu_priv']){echo 'selected';}  ?>        
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
                        <button type="submit" class="btn btn-success btn-rounded btn-block">Зберегти</button>
                    </div>
                    <div class="col-12 col-md-6 mb-4">
                        <button type="button" class="btn btn-secondary btn-rounded btn-block" onclick="location.href='<?php echo base_url();?>Menu'">Назад</button>
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