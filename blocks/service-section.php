	<!--========================= service-section start ========================= -->
	<section id="services" class="service-section pt-150">
		<div class="shape shape-3">
			<img src="assets/img/shapes/shape-3.svg" alt="">
		</div>
		<div class="container">
			<div class="row">
				<div class="col-xl-8 mx-auto">
					<div class="section-title text-center mb-55">
						<span class="wow fadeInDown" data-wow-delay=".2s"><?= __('mn_Speciality', $lang) ?></span>
						<h2 class="mb-15 wow fadeInUp" data-wow-delay=".4s">Experiencia y profesionalidad</h2>
						<p class="wow fadeInUp" data-wow-delay=".6s">Conoce en qué consisten las técnicas más modernas
							<br class="d-none d-lg-block"> que aplicamos en nuestra clínica para tu salud dental
						</p>
					</div>
				</div>
			</div>
			<div class="row">
				<?php
				// Parámetros de configuración del bloque
				$specialties = $db->select("block", "name = '" . $name_block . "'");
				$recordset = $db->send("SELECT * FROM treatmentscategories;"); ?>
				<?php foreach ($recordset as $specialty) : ?>
					<div class="col-lg-4 col-md-6">
						<div class="service-item mb-30">
							<div class="service-icon mb-25">
								<svg id="noun_dental_care_2692540" data-name="noun_dental care_2692540" xmlns="http://www.w3.org/2000/svg" width="70.285" height="58.102" viewBox="0 0 70.285 58.102">
									<g id="Group_156" data-name="Group 156">
										<path id="Path_84" data-name="Path 84" d="M17.336,17C14.2,22.319,7.223,26.405,0,27.04c0,13.45,3.61,28.3,17.337,32.13C31.061,55.34,34.674,40.489,34.674,27.04,27.373,25.929,20.467,22.319,17.336,17Zm0,37.576c-8.564-2.144-13-15.642-13-24.21,3.65-.224,10.44-2.565,13-7.149,2.561,4.584,9.352,6.925,13,7.149C30.338,38.934,25.9,52.432,17.337,54.576Zm2.144-17.593V32.655h-4.33v4.329h-4.33v4.33h4.33v4.33h4.33v-4.33h4.33v-4.33Z" transform="translate(0 -1.069)" fill="#393e46" />
										<path id="Path_85" data-name="Path 85" d="M72.777,7.735a7.668,7.668,0,0,0-2.063-5.6A7.393,7.393,0,0,0,66.72.127,8.515,8.515,0,0,0,65.246,0c-3.365.066-5.6,1.62-9.029,1.58C52.784,1.62,50.545.066,47.185,0a8.411,8.411,0,0,0-1.476.126,7.4,7.4,0,0,0-3.994,2.011,7.667,7.667,0,0,0-2.065,5.6A19.9,19.9,0,0,0,44,20.6a21.726,21.726,0,0,0-.974,6.388,17.447,17.447,0,0,0,1.408,7.128,8.114,8.114,0,0,0,1.477,2.28,3.178,3.178,0,0,0,2.136,1.085v0h.06l.078,0A2.689,2.689,0,0,0,50.2,36.391a11.413,11.413,0,0,0,1.632-3.6c.652-2.094,1.256-4.552,2.039-6.379a7.347,7.347,0,0,1,1.236-2.087,1.47,1.47,0,0,1,1.107-.573c.538-.008,1.086.351,1.761,1.486a35.937,35.937,0,0,1,2.431,6.94A19.3,19.3,0,0,0,61.652,35.5a4.76,4.76,0,0,0,.947,1.289,2.508,2.508,0,0,0,1.652.7H64.3A3.164,3.164,0,0,0,66.519,36.4c1.664-1.776,2.854-5.148,2.886-9.41a21.74,21.74,0,0,0-.974-6.387A19.876,19.876,0,0,0,72.777,7.735ZM65.619,33.029a5.612,5.612,0,0,1-.982,1.551,1.632,1.632,0,0,1-.305.255,6.733,6.733,0,0,1-.978-2.028c-.664-1.912-1.28-4.633-2.2-6.964A10.906,10.906,0,0,0,59.382,22.7a4.163,4.163,0,0,0-3.167-1.568h0a4.787,4.787,0,0,0-4.026,2.79c-1.262,2.2-1.954,5.131-2.675,7.507a17.169,17.169,0,0,1-1.048,2.844,2.546,2.546,0,0,1-.376.561,2.072,2.072,0,0,1-.474-.45c-.927-1.091-2-3.925-1.977-7.4A19.133,19.133,0,0,1,46.7,20.754a1.3,1.3,0,0,0-.236-1.273A17.2,17.2,0,0,1,42.268,7.737a5.021,5.021,0,0,1,1.3-3.753,4.794,4.794,0,0,1,2.587-1.277,5.972,5.972,0,0,1,1.028-.09c2.294-.066,4.822,1.541,9.031,1.58,4.206-.039,6.731-1.646,9.029-1.58a6.188,6.188,0,0,1,1.026.088,4.789,4.789,0,0,1,2.586,1.279,5.021,5.021,0,0,1,1.3,3.753,17.2,17.2,0,0,1-4.194,11.744,1.312,1.312,0,0,0-.239,1.273,19.049,19.049,0,0,1,1.06,6.236A14.968,14.968,0,0,1,65.619,33.029Z" transform="translate(-2.493 0)" fill="#00adb5" />
									</g>
								</svg>
							</div>
							<div class="service-content">
								<h4><?= $specialty['name'] ?></h4>
								<p style="overflow: hidden; text-overflow: ellipsis; width: 250px;"><?= $specialty['info'] ?></p>
								<a href="../categorieInterventions.php?categorie=<?= $specialty['id'] ?>" class="read-more">Leer más... <i class="lni lni-arrow-right"></i></a>
							</div>
							<div class="service-overlay img-bg"></div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<!--========================= service-section end ========================= -->