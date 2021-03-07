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

    <div class="d-flex">
      
      <div class="align-self-start">
        <?php
        if (file_exists("images/uploads/" . $result[0]["image"])) :
          $_img = "images/uploads/" . $result[0]["image"];
        else :
          $_img = "images/blank.png";
        endif;
        ?>
        <img src="<?= $_img ?>" alt="" style="max-width:400px">
      </div>

      <div class="align-self-start">
        <div class="about-content mb-55">
          <div class="section-title mb-30" style="margin-left:15px">
            <h2 class="mb-15 wow fadeInUp" data-wow-delay=".4s"><?= __($result[0]["title"], $lang) ?></h2>
            <span class="wow fadeInDown" data-wow-delay=".2s"><?= __($result[0]["subtitle"], $lang) ?></span>
          </div>

        </div>
      </div>
    </div>

  </div>
</section>
<div class="container">
  <div class="row">
  <code style="font-family:Arial"><?= $result[0]["date_published"] ?></code>
  </div>
  <div class="row">
    <div class="col-8">
      <code style="font-family:Arial"><?= $result[0]["text"] ?></code>
    </div>
    <div class="col-4">
      <div class="section-title mb-30">
        <span class="wow fadeInDown" data-wow-delay=".2s"><?= __('blog-section-title', $lang) ?></span>
        <?php
        $recordset = $db->select("articles", "category = 1 AND enabled = 1 AND id <> $id ORDER BY date_published DESC LIMIT 0,3;");
        if ($recordset) :
          foreach ($recordset as $article) : ?>
            <div class="card mb-3" style="max-width: 540px;">
              <div class="row g-0 d-flex">
                <div class="col-md-4">
                  <?php
                  if (file_exists("images/uploads/" . $article["image"])) :
                    $_img = "images/uploads/" . $article["image"];
                  else :
                    $_img = "images/blank.png";
                  endif;
                  ?>
                  <img style="padding: 1rem 1rem;" src="<?= $_img ?>" alt="">
                  <small class="text-muted" style="font-size: small; margin: 5px 0 0 10px"><?= substr($article["date_published"],0,10) ?></small>
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title"><a href="article.php?id=<?= $article["id"] ?>"><?= $article["title"] ?></a></h5>
                    <p class="card-text" style="font-size: small"><?= strlen($article["text"]) > 125 ? filter_var(substr($article["text"], 0, 125) . "...",FILTER_SANITIZE_STRING) : filter_var($article["text"],FILTER_SANITIZE_STRING) ?></p>
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
</div>
<!-- -->

<div class="about-img text-center">
  <img src="assets/img/about/about-img.png" alt="">
</div>
</section>
<?php $db->close() ?>
<!-- ========================= about-section end ========================= -->