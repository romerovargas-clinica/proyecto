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
								<input type="email" name="email" id="email" placeholder="<?= __('frm_Email', $lang) ?>*" required>
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
<script>
	function newUser() {
		var valid = true;
		valid = validateUser();
		if (valid) {
			$.post("admin/newUser.php", {
				firstname: $("#firstname").val(),
				lastname: $("#lastname").val(),
				email: $("#email").val(),
				phone: $("#phone").val(),
				address: $("#address").val(),
				postalCode: $("#postalCode").val(),
				city: $("#city").val(),
				province: $("#province").val(),
				lang: '<?= $lang ?>'
			}, function(m) {
				if (m["code"] == 200) {
					$('#messageBox').html(m["msg"]);
					$('#messageBox').attr("class", "alert alert-success");
					$('#messageBox').attr("style", "visibility = visible");
					$('#firstname').empty();
					$('#lastname').empty();
					$('#email').empty();
					$('#phone').empty();
					$('#address').empty();
					$('#postalCode').empty();
					$('#city').empty();
					$('#province').empty();
					$("#firstname").css('background-color', '#FFFFFF');
					$("#lastname").css('background-color', '#FFFFFF');
					$("#email").css('background-color', '#FFFFFF');
					$("#phone").css('background-color', '#FFFFFF');
					$("#address").css('background-color', '#FFFFFF');
					$("#postalCode").css('background-color', '#FFFFFF');
					$("#city").css('background-color', '#FFFFFF');
					$("#province").css('background-color', '#FFFFFF');
				} else {
					$('#messageBox').html(m["msg"]);
					$('#messageBox').attr("class", "alert alert-warning");
					$('#messageBox').attr("style", "visibility = visible");
				}
			})
		}
	}

	function validateUser() {
		var valid = true;
		if (!$("#email").val()) {
			$("#email").css('background-color', '#FFFFDF');
			valid = false;
		}
		if (!$("#email").val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
			$("#email").css('background-color', '#FFFFDF');
			valid = false;
		}
		if (!$("#phone").val()) {
			$("#phone").css('background-color', '#FFFFDF');
			valid = false;
		}
		if (!$("#lastname").val()) {
			$("#lastname").css('background-color', '#FFFFDF');
			valid = false;
		}
		if (!$("#firstname").val()) {
			$("#firstname").css('background-color', '#FFFFDF');
			valid = false;
		}
		return valid;
	}
</script>