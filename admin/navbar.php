<div class="container-fluid bg-primary">
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <a class="navbar-brand text-light" href="index.php"><?=__('app_Title', $lang)?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
  <div class="col">
                <div class="p-3 border bg-light">
                    
                <?php if(!isAuthenticated()):?>
                    <i class="fas fa-users my-2 my-sm-0"></i> | <a href="login.php"><?=__('mn_Login', $lang)?></a>
                    <?php else: ?>
                    <i class="fas fa-user my-2 my-sm-0"></i> | <?=$_SESSION['name']?>
                    <?php endif;?>
                </div>
              </div>
  </div>
</nav>
</div>