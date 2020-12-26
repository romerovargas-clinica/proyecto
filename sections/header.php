<div class="container bg-light">
    <div class="row align-items-start">
      <div class="col">
        <figure class="figure">
          <img class="rounded float-start" src="images/logoAzul.svg" width="300" height="175">
        </figure>
      </div>
      <div class="col">
        <div class="social">
          <div class="container px-4">
            <div class="row gx-5">
              <div class="col ">
                <div class="p-3 border bg-light">
                    <i class="fab fa-twitter-square my-2 my-sm-0"></i> | 
                    <i class="fab fa-facebook-square my-2 my-sm-0"></i> |
                    <i class="fab fa-instagram-square my-2 my-sm-0"></i> |
                    <i class="fab fa-google-plus-square my-2 my-sm-0"></i>
                </div>                
              </div>        
                            
              <div class="col">
                <div class="p-3 border bg-light">
                    
                <?php if(!isAuthenticated()):?>
                    <i class="fas fa-users my-2 my-sm-0"></i> | <a href="login.php"><?=__('mn_Login', $lang)?></a>
                    <?php else: ?>
                    <i class="fas fa-user my-2 my-sm-0"></i> | <?=$_SESSIONS['name']?>
                    <?php endif;?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>