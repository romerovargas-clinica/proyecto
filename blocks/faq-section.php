<?php
$db = new DataBase();
$result = $db->select("blocks", "id = " . $block["id"]);
?>
<!--========================= faq-section start ========================= -->
<section id="faq" class="faq-section theme-bg">
	<div class="faq-video-wrapper">
		<div class="faq-video">
			<img src="assets/img/faq/faq-img.jpg" alt="">
			<div class="video-btn">
				<a class="popup-video glightbox" href="#"><i class="lni lni-play"></i></a>
			</div>
		</div>
	</div>
	<div class="shape">
		<img src="assets/img/shapes/shape-8.svg" alt="" class="shape-faq">
	</div>
	<div class="container">
		<div class="row">
			<div class="col-xl-6 offset-xl-6 col-lg-8 col-md-10">
				<div class="faq-content-wrapper pt-90 pb-90">
					<div class="section-title">
						<span class="text-white wow fadeInDown" data-wow-delay=".2s"><?= __($result[0]["title"], $lang) ?></span>
						<h2 class="text-white mb-35 wow fadeInUp" data-wow-delay=".4s"><?= __($result[0]["subtitle"], $lang) ?></h2>
					</div>
					<div class="faq-wrapper accordion" id="accordionExample">
						<?php
						$ndb = new DataBase();
						$faqs = $ndb->select('faq', "enabled = 1");
						$collapsed = array("One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Teen");
						$cont = 0;
						?>
						<?php foreach ($faqs as $faq) : ?>
							<div class="faq-item mb-20">
								<div id="heading<?= $collapsed[$cont] ?>">
									<h5 class="mb-0">
										<button class="faq-btn btn<?= $cont != 0 ? " collapsed" : "" ?>" type="button" data-toggle="collapse" data-target="#collapse<?= $collapsed[$cont] ?>" aria-expanded="true" aria-controls="collapse<?= $collapsed[$cont] ?>">
											<?= $faq['question'] ?><i class="lni"></i>
										</button>
									</h5>
								</div>

								<div id="collapse<?= $collapsed[$cont] ?>" class="collapse<?= $cont == 0 ? " show" : "" ?>" aria-labelledby="heading<?= $collapsed[$cont] ?>" data-parent="#accordionExample">
									<div class="faq-content">
										<?= $faq['response'] ?>
									</div>
								</div>
							</div>
						<?php
							$cont++;
						endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!--========================= faq-section end ========================= -->