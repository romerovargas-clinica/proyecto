	<!-- ========================= footer start ========================= -->
	<footer class="footer pt-100 img-bg" style="background-image:url('assets/img/bg/footer-bg.jpg');">
		<div class="container">
			<div class="footer-widget-wrapper">
				<div class="row">
					<div class="col-xl-4 col-lg-5 col-md-6">
						<div class="footer-widget mb-30">
							<a href="index.php" class="logo"><img src="assets/img/logo/logo-dark.png" alt="" width="250" style="filter: drop-shadow(1px 1px 10px rgba(250, 250, 250, 1));"></a>
							<p><?= __('footer-text', $lang) ?></p>
							<div class="footer-social-links">
								<ul>
									<?php
									$db->close();
									$db = new DataBase();
									$social = $db->send("SELECT * FROM settings WHERE type = 'social' AND value<>'';");
									if (!empty($social)) :
										foreach ($social as $key) : ?>
											<li><a href="<?= $key['value'] ?>"><i class="<?= $key['label'] ?>"></i></a></li>
									<?php endforeach;
									endif;
									$mapSRC = $db->send("SELECT value FROM settings WHERE type = 'map';");
									$especialities = $db->send("SELECT id, name FROM treatmentscategories ;");
									$db->close();
									?>
								</ul>
							</div>
						</div>
					</div>
					<?php
					if ($_SERVER['PHP_SELF'] == "/index.php") :
						$href = "";
					else :
						$href = "index.php";
					endif;
					?>
					<div class="col-xl-2 col-lg-3 col-md-6">
						<div class="footer-widget mb-30">
							<h4><?= __('footer-quick-link', $lang) ?></h4>
							<ul class="footer-links">
								<li><a href="#">Home</a></li>
								<li><a href="<?= $href ?>#about"><?= __('mn_AboutUs', $lang) ?></a></li>
								<li><a href="<?= $href ?>#services"><?= __('mn_Speciality', $lang) ?></a></li>
								<li><a href="<?= $href ?>#team"><?= __('mn_Team', $lang) ?></a></li>
								<li><a href="<?= $href ?>#blog"><?= __('mn_News', $lang) ?></a></li>
								<li><a href="<?= $href ?>#contact"><?= __('mn_Contact', $lang) ?></a></li>
							</ul>
						</div>
					</div>
					<div class="col-xl-2 col-lg-3 col-md-5">
						<div class="footer-widget mb-30">
							<h4><?= __('footer-quick-link', $lang) ?></h4>
							<ul class="footer-links">

								<?php foreach ($especialities  as $categorie) : ?>

								<li><a href="/categorieInterventions.php?categorie=<?= $categorie['id']?>"><?= $categorie['name']?></a></li>

								<?php endforeach;?>

							</ul>
						</div>
					</div>
					<div class="col-xl-4 col-lg-12 col-md-7">
						<div class="footer-widget mb-30">
							<h4><?= __('footer-location', $lang) ?></h4>
							<div class="map-canvas">
								<iframe class="map" id="gmap_canvas" src="<?= $mapSRC[0][0] ?>"></iframe>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="copyright-area">
				<p class="mb-0 text-center">CaberSL. Soluciones Informáticas</p>
			</div>
		</div>
	</footer>
	<!-- ========================= footer end ========================= -->

	<!-- ========================= scroll-top ========================= -->
	<a href="#" class="scroll-top">
		<i class="lni lni-arrow-up"></i>
	</a>