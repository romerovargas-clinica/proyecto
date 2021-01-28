<a name="article"></a>
<div class="container " style="border-top: 8px solid white">
  <?php
    // Parámetros de configuración del bloque
   
    $num_articles =$db->send("SELECT Count(*) FROM articles");
    $num_articles = $num_articles[0][0];
    $truncate = 0;
   
    $recordset = $db->send("SELECT * FROM articles WHERE enabled = 1 ORDER BY date_created DESC LIMIT 0, $num_articles");
  ?>
  <div class="row" style="border-top: 8px solid black">
    <nav class="navbar navbar-expand-lg shadow navbar-dark" style="padding-top: 0; background-color:#0ee3d8">
      <a class="navbar-brand" href="#"><?= __('mn_News', $lang)?></a>
    </nav>
  </div>
  <?php
    $cont=0;
    foreach ($recordset as $article): ?>
  <?php if($cont>0) echo "<hr class='my-4'>";?>
  <div class="container-fluid px-3 py-3" style="background-color: white">
    <h2><?=$article['title']?></h2>
    <p class="lead"><?=$article['subtitle']?></p>
    <?php
        $texto = strip_tags($article['text']);
        ?>
    <p<?=$truncate!=0 ? " class='d-inline-block text-truncate' style='max-width: 100%;'" : "" ?>><?=$texto?></p>
      <div class="clearfix"></div>
      <a class="btn btn-primary btn-md" href="article.php?id=<?=$article['id']?>"
        role="button"><?=__('Learn_more', $lang)?></a>
  </div>
  <?php 
    $cont++;
    endforeach;?>
</div>