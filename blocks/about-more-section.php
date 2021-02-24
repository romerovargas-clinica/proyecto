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
				<div>
					<ul class="list-group">
						<li class="list-group-item list-group-item-warning">
							<a class="list-group-item list-group-item-action list-group-item-danger" href="index.php"><?= __('mn_Home', $lang) ?></a>
							<div class="list-group">
								<a class="list-group-item list-group-item-action" href="index.php#we-do"><?= __('mn_We_Do', $lang) ?></a>
								<a class="list-group-item list-group-item-action" href="index.php#about"><?= __('mn_AboutUs', $lang) ?></a>
								<a class="list-group-item list-group-item-action" href="index.php#services"><?= __('mn_Speciality', $lang) ?></a>
								<a class="list-group-item list-group-item-action" href="index.php#testimonial"><?= __('testimonial-section-title', $lang) ?></a>
								<a class="list-group-item list-group-item-action" href="index.php#faq"><?= __('faq-section-title', $lang) ?></a>
								<a class="list-group-item list-group-item-action" href="index.php#team"><?= __('mn_Team', $lang) ?></a>
								<a class="list-group-item list-group-item-action" href="index.php#blog"><?= __('mn_News', $lang) ?></a>
								<a class="list-group-item list-group-item-action" href="index.php#contact"><?= __('mn_Contact', $lang) ?></a>
							</div>
						</li>
						<li class="list-group-item list-group-item-warning">
							<a class="list-group-item list-group-item-action list-group-item-danger" href="login.php"><?= __('mn_Login', $lang) ?></a>
							<div class="list-group">
								<a class="list-group-item list-group-item-action" href="cites.php"><?= __('mn_Cites', $lang) ?></a>
								<a class="list-group-item list-group-item-action" href="chat.php"><?= __('mn_Chat', $lang) ?></a>
							</div>
						</li>
						<li class="list-group-item list-group-item-warning">
							<a class="list-group-item list-group-item-action list-group-item-danger" href="admin.php"><?= __('mn_Admin', $lang) ?></a>
							<div class="list-group">
								<a class="list-group-item list-group-item-action" href="budget.php"><?= __('mn_budget', $lang) ?></a>
							</div>
						</li>
					</ul>
					</li>
				</div>
				<div class="about-content mb-55">
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