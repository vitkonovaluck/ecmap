<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Вхід користувача</title>
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo str_replace('index.php/', '', base_url());?>stylesheet/login.css">


</head>
<body>
  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
      <div class="card login-card">
        <div class="row no-gutters">
          <div class="col-md-5">
              <img src="<?php echo str_replace('/index.php', '', base_url());?>images/login.jpg" alt="login" class="login-card-img">
          </div>
          <div class="col-md-7">
            <div class="card-body">
              <div class="brand-wrapper">
                <img src="<?php echo str_replace('/index.php', '', base_url());?>images/logo.png" alt="logo" class="logo">
              </div>
                <?php foreach ($usr as $user){?>
              <p class="login-card-description">Відновлення паролю</p>
              <p class="login-card-footer-text">Доброго дня <b><?php echo $user['user_fname'];?></b></p>
              <p class="login-card-footer-text">Виберіть спосіб відновлення паролю</p>
              <form name="forma_1" action="<?php echo base_url('Login/fogot2');?>" method="post">
                  <input type="hidden" value="<?php echo $user['user_id'];?>" name="user_id">
                    <label for="email" class="sr-only"> </label>
                    <label for="email" class="sr-only"></label><!-- comment -->
                    <div class="form-group">
                      <div class="form-check">
                          <input class="form-check-input" type="radio" name="phone" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                         Телефон:<?php echo $user['user_login'];?>
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="email" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">
                          E-mail: <?php echo $user['user_email'];?>
                        </label>
                      </div>
                  </div>
                  <input name="login" id="login" class="btn btn-block login-btn mb-4" type="submit" value="Далі >" >
                </form>
                <?php }?>
                  <nav class="login-card-footer-nav">
                  <a href="#!">.</a>
                  <a href="#!"></a>
                </nav>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="card login-card">
        <img src="assets/images/login.jpg" alt="login" class="login-card-img">
        <div class="card-body">
          <h2 class="login-card-title">Login</h2>
          <p class="login-card-description">Sign in to your account to continue.</p>
          <form action="#!">
            <div class="form-group">
              <label for="email" class="sr-only">Email</label>
              <input type="email" name="email" id="email" class="form-control" placeholder="Email">
            </div>
            <div class="form-group">
              <label for="password" class="sr-only">Password</label>
              <input type="password" name="password" id="password" class="form-control" placeholder="Password">
            </div>
            <div class="form-prompt-wrapper">
              <div class="custom-control custom-checkbox login-card-check-box">
                <input type="checkbox" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">Remember me</label>
              </div>              
              <a href="#!" class="text-reset">Forgot password?</a>
            </div>
            <input name="login" id="login" class="btn btn-block login-btn mb-4" type="button" value="Login">
          </form>
          <p class="login-card-footer-text">Don't have an account? <a href="#!" class="text-reset">Register here</a></p>
        </div>
      </div> -->
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
