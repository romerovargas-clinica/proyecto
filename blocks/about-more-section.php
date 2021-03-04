<?php
$db = new DataBase();
$result = $db->select("blocks", "id = " . $block["id"]);
?>
<!-- ========================= about-more-section start ========================= -->
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
						<!--<h2 class="mb-15 wow fadeInUp" data-wow-delay=".4s"><?= __($result[0]["subtitle"], $lang) ?></h2> -->
					</div>
					<p class="mb-35 wow fadeInUp" data-wow-delay=".6s"><?= __($result[0]["text"], $lang) ?></p>
				</div>
			</div>
		</div>
		<div class="row">

			<div class="col-xl-8 col-lg-9 mx-auto">
				<ul class="list-group">

					<li class="list-group-item list-group-item-info">
						<a class="list-group-item list-group-item-action text-light" style="background-color: #00ADB5" href="index.php"><?= __('mn_Home', $lang) ?></a>
						<div class="list-group">
							<?php
							$bloques = $db->select("blocks", "id_page = 1 AND enabled = 1 ORDER BY order_n ASC");
							if ($bloques) : ?>
								<?php foreach ($bloques as $bloque) : ?>
									<a class="list-group-item list-group-item-action" href="index.php#<?= $bloque["name"] ?>"><?= $bloque["label"] ?></a>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>
					</li>

					<li class="list-group-item list-group-item-info">
						<a class="list-group-item list-group-item-action text-light" style="background-color: #00ADB5" href="login.php"><?= __('mn_Login', $lang) ?></a>
						<div class="list-group">
							<a class="list-group-item list-group-item-action" href="cites.php"><?= __('mn_Cites', $lang) ?></a>
						</div>
					</li>

					<li class="list-group-item list-group-item-info">
						<a class="list-group-item list-group-item-action text-light" style="background-color: #00ADB5" href="admin.php"><?= __('mn_Admin', $lang) ?></a>
						<div class="list-group">
							<a class="list-group-item list-group-item-action" href="budget.php"><?= __('mn_budget', $lang) ?></a>
						</div>
					</li>
				</ul>
				</li>
			</div>

		</div>
		<div class="row">
			<div class="col-xl-8 col-lg-9 mx-auto">
				<div class="about-content mb-55 text-center">
					<div class="section-title mt-10">
						<a href="index.php" class="btn theme-btn wow fadeInUp" data-wow-delay=".8s"><?= __('mn_Home', $lang) ?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	<div class="about-img text-center">
		<img src="assets/img/about/about-img.png" alt="">
	</div>
</section>
<?php $db->close() ?>
<!-- ========================= about-more-section end ========================= -->