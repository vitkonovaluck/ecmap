<section class="intro">
  <div class="bg-image-vertical h-100" style="background-color: #34383c;">
    <div class="mask d-flex align-items-center h-100">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-lg-10">
            <div class="card" style="border-radius: 1rem;">
              <div class="card-body p-5">

                <h1 class="mb-5 text-center">Створення документів</h1>

                <form action="<?php echo base_url('Documents/create_doc');?>" method="post">
                  <!-- 2 column grid layout with text inputs for the first and last names -->
                  <input type="hidden" name="doc_create" value="<?php echo date("Ymd");?>">
                   <div class="row">
                    <div class="col-12 col-md-6 mb-4">
                      <div class="form-outline">
                        <label class="form-label" for="form6Example2">Документ</label>
                            <select id="form6Example2" class="form-control" name="document">
                              <?php foreach ($docs as $doc){?>
                                <option value="<?php echo $doc['document_id'];?>"
                                ><?php echo $doc['document_name'];?></option>
                              <?php }?>
                            </select>
                        
                      </div>
                    </div>
                    <div class="col-12 col-md-6 mb-4">
                      <div class="form-outline">
                        <label class="form-label" for="form6Example1">Період</label>
                        <input type="text" id="form6Example2" class="form-control" name="periods" value="<?php //echo $user_datas['user_fname'];?>"/>
                          
                      </div>
                    </div>
                  </div>
                  <!--                    
 -->
                  <div class="row">
                    <div class="col-12 col-md-6 mb-4">
                      <div class="form-outline">
                        <label class="form-label" for="form6Example2">Примітка</label>
                        <input type="text" id="form6Example2" class="form-control" name="prim" value=""/>
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
                     
                        <button type="submit" class="btn btn-success btn-rounded btn-block">Створити</button>
                     
                         
                    </div>
                    <div class="col-12 col-md-6 mb-4">
                        <button type="button" class="btn btn-secondary btn-rounded btn-block" onclick="location.href='<?php echo base_url('Documents');?>'">Назад</button>
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

