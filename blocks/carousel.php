<a name="carousel"></a>
<div class="container">
<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
  <?php
    $images = $db->select("block", "name = '".$name_block."'");
    $num_images = $images[0]['num#1'];    
    for ($i=0; $i<$num_images; $i++): ?>
      <div class="carousel-item<?=$i==0 ? " active" : ""?>">
        <img class="d-block w-100" src="images/carousel/<?=$images[0]['text#'.($i+1)]?>" alt="Slide#<?=$i?>" data-bs-interval="100">
      </div>
    <?php endfor;
  ?>    
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>