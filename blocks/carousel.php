<a name="carousel"></a>
<div class="container">
    <div id="carouselCaptions" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#carouselCaptions" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#carouselCaptions" data-bs-slide-to="1"></li>
            <li data-bs-target="#carouselCaptions" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <?php
            $images = $db->select("block", "name = '" . $name_block . "'");
            $num_images = $images[0]['num#1'];
            for ($i = 0; $i < $num_images; $i++):?>
                <div class="carousel-item<?= $i == 0 ? " active" : "" ?>">
                    <img class="d-block w-100" src="images/carousel/<?= $images[0]['text#' . ($i + 1)] ?>"
                         alt="Slide#<?= $i ?>" data-bs-interval="100">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class="text-dark"><?= $images[0]['label#0' . ($i + 6)] ?></h5>
                        <p class="text-dark">Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                    </div>
                </div>
            <?php endfor;?>
        </div>
        <a class="carousel-control-prev" href="#carouselCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>