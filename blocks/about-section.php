<?php
$db = new DataBase();
$result = $db->select("blocks", "id = " . $block["id"]);
?>
<!-- ========================= about-section start ========================= -->
<section id="about" class="about-section pt-120">
	<div class="shape shape-2">
		<img src="assets/img/shapes/shape-2.svg" alt="">
	</div>
	<div class="container">
		<div class="row">
			<div class="col-xl-10 col-lg-11 mx-auto">
				<div class="about-content text-center mb-55">
					<div class="section-title mb-30">
						<span class="wow fadeInDown" data-wow-delay=".2s"><?= __($result[0]["title"], $lang) ?></span>
						<h2 class="mb-15 wow fadeInUp" data-wow-delay=".4s"><?= __($result[0]["subtitle"], $lang) ?></h2>
					</div>
					<p class="mb-35 wow fadeInUp" data-wow-delay=".6s"><?= __($result[0]["text"], $lang) ?></p>
					<a href="about-more.php" class="btn theme-btn wow fadeInUp" data-wow-delay=".8s"><?= __('btn_mapweb', $lang) ?></a>
				</div>
			</div>
		</div>
	</div>
	<div class="about-img text-center">
		<img src="assets/img/about/about-img.png" alt="">
	</div>
</section>
<?php $db->close() ?>
<!-- ========================= about-section end ========================= -->