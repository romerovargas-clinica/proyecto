<a name="article"></a>
<div class="container bg-light" style="border-top: 8px solid black">
  <?php
    // Parámetros de configuración del bloque
    $articles = $db->select("block", "name = '".$name_block."'");
    $num_articles = $articles[0]['num#1'];
    $truncate = 0;
    if($articles[0]['num#2']==1) $truncate = $articles[0]['num#3'];
    $recordset = $db->send("SELECT * FROM articles WHERE enabled = 1 ORDER BY date_created DESC LIMIT 0, $num_articles");
  ?>
  <div class="row" style="border-top: 8px solid #00A797">
    <nav class="navbar navbar-expand-lg bg-primary shadow navbar-dark" style="padding-top: 0">
      <a class="navbar-brand" href="#"><?=$name_block?></a>
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