<?php
$db = new DataBase();
$result = $db->select("blocks", "id = " . $block["id"]);
?>
<!-- ========================= blog-section start ========================= -->
<section id="blog" class="blog-section pt-150">
	<div class="shape shape-7">
		<img src="assets/img/shapes/shape-6.svg" alt="">
	</div>
	<div class="container">
		<div class="row">
			<div class="col-xl-8 mx-auto">
				<div class="section-title text-center mb-55">
					<span class="wow fadeInDown" data-wow-delay=".2s"><?= __($result[0]["title"], $lang) ?></span>
					<h2 class="mb-15 wow fadeInUp" data-wow-delay=".4s"><?= __($result[0]["subtitle"], $lang) ?></h2>
					<p class="wow fadeInUp" data-wow-delay=".6s"><?= __($result[0]["text"], $lang) ?></p>
				</div>
			</div>
		</div>
		<div class="row">
			<?php
			// Parámetros de configuración del bloque
			$recordset = $db->select("articles", "category = 1 AND enabled = 1 ORDER BY date_published DESC LIMIT 0,3;");
			if ($recordset) :
				$cont = 1; // Atención: sólo 3
				foreach ($recordset as $article) : ?>
					<div class="col-xl-4 col-lg-4 col-md-6">
						<div class="single-blog mb-30 wow fadeInUp" data-wow-delay=".<?= $cont * 2 ?>s">
							<div class="blog-img">
								<?php if ($article["image"] == null) :
									$_img = "images/blank.png";
								else :
									$_img = "images/uploads/" . $article["image"];
								endif; ?>
								<a href="#"><img src="<?= $_img ?>" alt=""></a>
							</div>
							<div class="blog-content">
								<h4><a href="#"><?= $article["title"] ?></a></h4>
								<p><?= $article["subtitle"] ?></p>
								<a class="read-more" href="article.php?id=<?= $article["id"] ?>"><?= __('Learn_more', $lang) ?> <i class="lni lni-arrow-right"></i></a>
							</div>
						</div>
					</div>
				<?php
					$cont++;
					if ($cont == 4) break;
				endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</section>
<!-- ========================= blog-section end ========================= -->