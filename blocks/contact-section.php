<?php
$db = new DataBase();
$result = $db->select("blocks", "id = " . $block["id"]);
?>
<!-- ========================= contact-section start ========================= -->
<section id="contact" class="contact-section pt-120 pb-160">
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
		<div class="row">
			<div class="col-xl-12">
				<div class="contact-form">
					<div id="contact-form" class="contact-form">
						<div class="row">
							<span id="userName-info" class="info"></span>
							<div class="col-md-6">
								<input type="text" id="name" name="name" placeholder="Name" required>
							</div>
							<div class="col-md-6">
								<input type="email" id="email" name="email" placeholder="Email" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<input type="text" name="subject" id="subject" placeholder="Subject" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<textarea name="message" id="message" rows="5" placeholder="Message" required></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col-xl-12">
								<button class="btn theme-btn" onClick="sendContact()">Send Message</button>
							</div>
						</div>
					</div>
					<p class="form-message pt-15"></p>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
	function sendContact() {
		var valid = true;
		valid = validateContact();
		if (valid) {
			$.post("assets/contact.php", {
				name: $("#name").val(),
				email: $("#email").val(),
				subject: $("#subject").val(),
				message: $("#message").val(),
				lang: '<?= $lang ?>'
			}, function(m) {
				if (m["code"] == 200) {
					$('#mail-status').html(m["mensaje"]);
					$('#mail-status').attr("class", "alert alert-success");
					$('#mail-status').attr("style", "visibility = visible");
					$('#name').empty();
					$('#email').empty();
					$('#subject').empty();
					$('#message').empty();
					$("#name").css('background-color', '#FFFFFF');
					$("#email").css('background-color', '#FFFFFF');
					$("#subject").css('background-color', '#FFFFFF');
					$("#message").css('background-color', '#FFFFFF');
				} else {
					$('#mail-status').html(m["mensaje"]);
					$('#mail-status').attr("class", "alert alert-warning");
					$('#mail-status').attr("style", "visibility = visible");
				}
			})
		}
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