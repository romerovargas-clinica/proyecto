<?php
$db = new DataBase();
$result = $db->select("blocks", "id = " . $block["id"]);
?>
<!-- ========================= contact-section start ========================= -->
<section id="contact" class="contact-section pt-50 pb-160">
	<div class="shape shape-7">
		<img src="assets/img/shapes/shape-7.svg" alt="">
	</div>
	<div class="container">
		<div class="row">
			<div class="col-xl-8 mx-auto">
				<div class="section-title text-center mb-55">
					<span class="wow fadeInDown" data-wow-delay=".2s"><?= __($result[0]["title"], $lang) ?></span>
					<h2 class="mb-15 wow fadeInUp" data-wow-delay=".4s"><?= __($result[0]["subtitle"], $lang) ?></h2>
					<p class="wow fadeInLeft" data-wow-delay=".6s"><?= __($result[0]["text"], $lang) ?></p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xl-8 mx-auto">
				<div id="mail-status" style="visibility: hidden;"></div>
			</div>
		</div>

		<?php
		$ndb = new Database();
		$user = $ndb->select("users", "id = " . $_SESSION['id']);
		if ($user) : ?>
			<?php if (isset($errores)) : ?>
				<div class="row">
					<div class="contact-section">
						<?php if ($errores) : ?>
							<div class="alert alert-danger" role="alert">
							<?php else : ?>
								<div class="alert alert-primary" role="alert">
								<?php endif ?>
								<?= __($msgError, $lang) ?>
								</div>
							</div>
					</div>
				<?php endif ?>
				<div class="row">
					<div class="col-xl-12">

						<div class="contact-section">
							<form id="contact-form" class="contact-form" action="profile.php" method="POST">

								<div class="row">
									<div class="col-md-6">
										<label><?= __('frm_FirstName', $lang) ?></label>
										<input type="text" name="firstname" id="firstname" placeholder="<?= __('frm_FirstName', $lang) ?>*" required value="<?= $user[0]["firstname"] ?>">
									</div>
									<div class="col-md-6">
										<label><?= __('frm_LastName', $lang) ?></label>
										<input type="text" name="lastname" id="lastname" placeholder="<?= __('frm_LastName', $lang) ?>*" required value="<?= $user[0]["lastname"] ?>">
									</div>
								</div>

								<div class="row">
									<div class="col-md-5">
										<label><?= __('frm_Email', $lang) ?></label>
										<input type="email" flag="no" name="email" id="email" placeholder="<?= __('frm_Email', $lang) ?>*" required value="<?= $user[0]["email"] ?>">
									</div>
									<div class="col-md-1">
										<div id="loader"></div>
									</div>
									<div class="col-md-6">
										<label><?= __('frm_Phone', $lang) ?></label>
										<input type="text" name="phone" id="phone" placeholder="<?= __('frm_Phone', $lang) ?>*" required value="<?= $user[0]["phone"] ?>">
									</div>
								</div>

								<div class="row">
									<div class="col-md-8">
										<label><?= __('frm_Address', $lang) ?></label>
										<input type="text" name="address" id="address" placeholder="<?= __('frm_Address', $lang) ?>" value="<?= $user[0]["address"] ?>">
									</div>
									<div class="col-md-4">
										<label><?= __('frm_PostalCode', $lang) ?></label>
										<input type="text" name="postalcode" id="postalcode" placeholder="<?= __('frm_PostalCode', $lang) ?>" value="<?= $user[0]["postalcode"] ?>">
									</div>
								</div>

								<div class="row">
									<div class="col-md-6">
										<label><?= __('frm_City', $lang) ?></label>
										<input type="text" name="city" id="city" placeholder="<?= __('frm_City', $lang) ?>" value="<?= $user[0]["city"] ?>">
									</div>
									<div class="col-md-6">
										<label><?= __('frm_Province', $lang) ?></label>
										<input type="text" name="province" id="province" placeholder="<?= __('frm_Province', $lang) ?>" value="<?= $user[0]["province"] ?>">
									</div>
								</div>

								<div class="row">
									<label><?= __('frm_Lenguage', $lang) ?></label>
									<div class="col-md-6">
										<label for="es">Castellano<input type="radio" name="lang" id="es" value="es" <?= $user[0]["lang"] == "es" ? "checked" : "" ?>></label>
										<label for="en">English<input type="radio" name="lang" id="en" value="en" <?= $user[0]["lang"] == "en" ? "checked" : "" ?>></label>
									</div>
									<div class="col-md-6">
									</div>
								</div>

								<div class="row">
									<div class="col-xl-12">
										<button name="enviar" class="btn theme-btn" onClick="updateUser()"><?= __('btn_Update', $lang) ?></button>
									</div>
								</div>
							</form>

							<p class="form-message pt-15"></p>
						</div>
					</div>
				<?php else : ?>
					<div><?= __('err_RecoveryInfo', $lang) ?></div>
				<?php endif ?>
				</div>

				</div>
</section>
<script>
	function updateUser() {

	}

	function validateContact() {
		var valid = true;
		$(".info").html('');
		if (!$("#name").val()) {
			$("#name").css('background-color', '#FFFFDF');
			valid = false;
		}
		if (!$("#email").val()) {
			$("#email").css('background-color', '#FFFFDF');
			valid = false;
		}
		if (!$("#email").val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
			$("#email").css('background-color', '#FFFFDF');
			valid = false;
		}
		if (!$("#subject").val()) {
			$("#subject").css('background-color', '#FFFFDF');
			valid = false;
		}
		if (!$("#message").val()) {
			$("#message").css('background-color', '#FFFFDF');
			valid = false;
		}
		return valid;
	}
</script>
<?php $db->close() ?>
<!-- ========================= contact-section end ========================= -->