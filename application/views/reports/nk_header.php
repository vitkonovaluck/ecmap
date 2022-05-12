<section class="intro">
  <div class="bg-image-vertical" style="background-color: #34383c;">
    <div class="mask d-flex align-items-center">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col col-lg">
            <div class="card" style="border-radius: 1rem;">
              <div class="card-body">
                  <p class="text-center"><b>Річний звіт (6-НК)</b></p>
                <form action="<?php echo base_url("Reports/nk");?>" method="post">
                    <input type="hidden" name="do_repa" value="1">
                <div class="row">
                    <div class="col-3">
                      <div class="form-outline">
                          <label class="form-label" for="form6Example2">Статус звіту</label>
                          <select name="status">
                            <option value="0">--Всі--</option>  
                            <?php foreach ($doc_status as $stat){?>
                                <option value="<?php echo $stat['ds_id'];?>"><?php echo $stat['ds_name'];?></option>
                            <?php }?>
                        
                          </select>
                        </div>
                    </div>
                    <div class="col-3">
                      <div class="form-outline">
                          <label class="form-label" for="form6Example2">Тип бібліотеки</label>
                          <select name="type_libr">
                            <option value="0">--Всі--</option>  
                            <?php foreach ($type_libr as $tlibr){?>
                                <option value="<?php echo $tlibr['lt_id'];?>"><?php echo $tlibr['lt_name'];?></option>
                            <?php }?>
                          </select>                        
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-outline">
                          <label class="form-label" for="form6Example2">Бібліотека</label>
                          <select name="library">
                            <option value="0">--Всі--</option>  
                            <?php foreach ($librarys as $libr){?>
                                <option value="<?php echo $libr['library_id'];?>"><?php echo $libr['library_name'];?></option>
                            <?php }?>
                          </select>                        
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="form-outline">
                          <label class="form-label" for="form6Example2">Період</label>
                          <select name="period">
                              <option value="0">--Всі--</option>  
                              <?php $i=0;?>
                            <?php foreach ($period as $libr){?>
                                <option value="<?php echo $libr['period_id'];?>" <?php if($i == 0){echo "selected";} $i++; ?>><?php echo $libr['period_name'];?></option>
                            <?php }?>

                          </select>
                        </div>
                    </div>
                    <div class="col">
                      <div class="form-outline">
                          
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-outline">
                          <button type="submit" class="btn btn-success btn-rounded btn-block">Зформувати</button>
                          <button type="button" class="btn btn-secondary btn-rounded btn-block" onclick="location.href='<?php echo base_url("Reports/nk");?>'">Очистити</button>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                        <div class="form-outline">
                            <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" name="detal" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">Детальний звіт</label>
                          </div>
                        </div>
                    </div>
                    <div class="col">
                      <div class="form-outline">
                          
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-outline">
                          <?php if(isset($filter)){?>
                            <button class="btn btn-warning btn-rounded btn-block" id="button-excel">Експорт</button
                          <?php }?>
                      </div>
                    </div>`
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

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

