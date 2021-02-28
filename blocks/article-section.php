<?php
if (!isset($_GET['id'])) :
  $id = "Max(id)";
else :
  $id = $_GET['id'];
endif;
$db = new DataBase();
$result = $db->select("articles", "id = " . $id);
?>
<!-- ========================= about-section start ========================= -->
<section id="about" class="about-section pt-120">
  <div class="shape shape-2">
    <img src="assets/img/shapes/shape-2.svg" alt="">
  </div>
  <div class="container">
    <div class="row">
      <div class="col-5 text-center">
        <?php
        if (file_exists("images/uploads/" . $result[0]["image"])) :
          $_img = "images/uploads/" . $result[0]["image"];
        else :
          $_img = "images/blank.png";
        endif;
        ?>
        <img src="<?= $_img ?>" alt="" style="width:80%">
      </div>
      <div class="col-6">
        <div class="about-content text-center mb-55">
          <div class="section-title mb-30">
            <h2 class="mb-15 wow fadeInUp" data-wow-delay=".4s"><?= __($result[0]["title"], $lang) ?></h2>
            <span class="wow fadeInDown" data-wow-delay=".2s"><?= __($result[0]["subtitle"], $lang) ?></span>
          </div>

        </div>
      </div>
    </div>
    <div class="row">
      <p class="mb-35 wow fadeInUp" data-wow-delay=".6s"><?= __($result[0]["text"], $lang) ?></p>
    </div>
  </div>
  <div class="container">
    <div class="row mt-5">
      <div class="col-5 text-center">
        <div class="section-title mb-30">
          <span class="wow fadeInDown" data-wow-delay=".2s"><?= __('blog-section-title', $lang) ?></span>
        </div>
      </div>
      <div class="col-5 text-center">
      </div>
    </div>
    <div class="row">
      <div class="col-5 text-center">
        
          <?php
          $recordset = $db->select("articles", "category = 1 AND enabled = 1 AND id <> $id ORDER BY date_published DESC LIMIT 0,3;");
          if ($recordset) :
            foreach ($recordset as $article) : ?>
              <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                  <div class="col-md-4">
                    <?php
                    if (file_exists("images/uploads/" . $article["image"])) :
                      $_img = "images/uploads/" . $article["image"];
                    else :
                      $_img = "images/blank.png";
                    endif;
                    ?>
                    <img src="<?= $_img ?>" alt="">
                    <small class="text-muted"><?= $article["date_published"] ?></small>
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h5 class="card-title"><a href="article.php?id=<?= $article["id"] ?>"><?= $article["title"] ?></a></h5>
                      <p class="card-text"><?= strlen($article["text"]) > 125 ? substr($article["text"], 0, 125) . "..." : $article["text"] ?></p>
                      <p class="card-text"></p>
                    </div>
                  </div>
                </div>
              </div>
          <?php endforeach;
          endif;
          ?>
        
      </div>
    </div>
  </div>
  <div class="about-img text-center">
    <img src="assets/img/about/about-img.png" alt="">
  </div>
</section>
<?php $db->close() ?>
<!-- ========================= about-section end ========================= -->