<?php
$db = new DataBase();
$result = $db->select("blocks", "id = " . $block["id"]);
?>
<!-- ========================= testimonial-section start ========================= -->
<section id="testimonial" class="testimonial-section pt-120 pb-150">
	<div class="shape shape-4">
		<img src="assets/img/shapes/shape-4.svg" alt="">
	</div>
	<div class="container">
		<div class="row">
			<div class="col-xl-6 mx-auto">
				<div class="section-title text-center mb-25">
					<span class="wow fadeInDown" data-wow-delay=".2s"><?= __($result[0]["title"], $lang) ?></span>
					<h2 class="wow fadeInUp" data-wow-delay=".4s"><?= __($result[0]["subtitle"], $lang) ?></h2>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xl-7 col-lg-9 mx-auto">
				<div id="customize_wrapper">
					<div class="customize testimonial-active" id="customize">
						<?php
						$ndb = new DataBase();
						$opiniones = $ndb->select('testimonial', "enabled = 1");
						$collapsed = array("One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Teen");
						$cont = 0;
						foreach ($opiniones as $opinion) : ?>
							<div class="single-testimonial">
								<div class="quote-icon">
									<svg xmlns="http://www.w3.org/2000/svg" width="111.704" height="83.778" viewBox="0 0 111.704 83.778">
										<path id="Icon_open-double-quote-sans-left" data-name="Icon open-double-quote-sans-left" d="M0,0V83.778L41.889,41.889V0ZM69.815,0V83.778L111.7,41.889V0Z" fill="#00adb5" opacity="0.32" />
									</svg>
								</div>
								<div class="testimonial-content">
									<p><?= $opinion['comment'] ?></p>
								</div>
								<div class="testimonial-info">
									<h5><?= $opinion['name'] ?></h5>
									<span><?= $opinion['occupation'] ?></span>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
					<?php
					$ndb->close();
					$ndb = new DataBase();
					$opiniones = $ndb->select('testimonial', "enabled = 1");
					?>
					<div class="customize-tools">
						<ul class="thumbnails d-flex justify-content-center" id="customize-thumbnails">
							<?php if ($opiniones) :
								foreach ($opiniones as $opinion) : ?>
									<li class="testimonial-img">
										<?php if (file_exists($opinion["image"])) : ?>
											<img src="<?= $opinion["image"] ?>" alt="">
										<?php else : ?>
											<img src="<?= $opinion["image"] ?>" alt="">
										<?php endif; ?>
									</li>
							<?php endforeach;
							endif; ?>
						</ul>
					</div>

				</div>
			</div>
		</div>
	</div>
</section>
<!-- ========================= testimonial-section end ========================= -->