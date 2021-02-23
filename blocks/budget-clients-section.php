<?php
$db = new DataBase();
$result = $db->select("blocks", "id = " . $block["id"]);
?>
<!--========================= budget-clients-section start ========================= -->
<section id="budget-list" class="we-do-section pt-20">
	<div class="container">
		<div class="row">
			<div class="col-xl-6 mx-auto">
				<div class="section-title text-center mb-25">
					<span class="wow fadeInDown" data-wow-delay=".2s"><?= __('budget-clients-title', $lang) ?></span>
					<p class="wow fadeInUp" data-wow-delay=".6s"><?= __('budget-clients-text', $lang) ?></p>
					<p class="wow fadeInUp visually-hidden text-danger" id="messageBox" data-wow-delay=".6s"></p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xl-12">
				<div class="contact-section">
					<div id="contact-form" class="contact-form">

						<div class="row">
							<div class="col-md-6">
								<input type="text" name="firstname" id="firstname" placeholder="<?= __('frm_FirstName', $lang) ?>*" required>
							</div>
							<div class="col-md-6">
								<input type="text" name="lastname" id="lastname" placeholder="<?= __('frm_LastName', $lang) ?>*" required>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<input type="email" flag="no" name="email" id="email" placeholder="<?= __('frm_Email', $lang) ?>*" required>
							</div>
							<div class="col-md-6">
								<input type="text" name="phone" id="phone" placeholder="<?= __('frm_Phone', $lang) ?>*" required>
							</div>
						</div>

						<div class="row">
							<div class="col-md-8">
								<input type="text" name="address" id="address" placeholder="<?= __('frm_Address', $lang) ?>">
							</div>
							<div class="col-md-4">
								<input type="text" name="postalCode" id="postalCode" placeholder="<?= __('frm_PostalCode', $lang) ?>">
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<input type="text" name="city" id="city" placeholder="<?= __('frm_City', $lang) ?>">
							</div>
							<div class="col-md-6">
								<input type="text" name="province" id="province" placeholder="<?= __('frm_Province', $lang) ?>">
							</div>
						</div>

						<div class="row">
							<div class="col-xl-12">
								<button class="btn theme-btn" onClick="newUser()"><?= __('frm_ButtonSend', $lang) ?></button>
							</div>
						</div>
					</div>
					<p class="form-message pt-15"></p>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xl-12 mx-auto">

		</div>
	</div>
</section>
<?php $db->close() ?>
<!--========================= budget-clients-section end ========================= -->