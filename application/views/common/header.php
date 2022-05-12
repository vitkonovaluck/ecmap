<!-- <div align="center" style="background: #b6b6b6"><h1> <font color="#0000ff"><strong>Електронна система обліку роботи бібліотек</strong></font></h1></div> -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo base_url();?>"><img src="<?php echo base_url('..');?>/images/logo.png" width="70" height="20"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <?php echo $menu_main;?>
      
      </ul>
      <form class="d-flex" action="<?php echo base_url();?>Login/logout">
          <input class="form-control me-2" type="text" readonly="readonly" placeholder="Search" aria-label="Search"  value="<?php echo "".$_SESSION['user_name'];?>"l>
        <button class="btn btn-dark" type="submit">Вихід</button>
      </form>
    </div>
  </div>
</nav>  