<!--========================= register-section start ========================= -->
<?php include "blocks/budget-clients-section.php"; ?>
<div class="container">
	<div class="row">
		<div class="alert alert-primary" id="warning" style="visibility: hidden"></div>
	</div>
</div>
<!--========================= register-section end ========================= -->
<script>
	var _input = document.getElementById("email");
	_input.addEventListener("blur", function(event) {
		validaEmail(this.value)
	}, true);

	function newUser() {
		//validaEmail($("#email").val());
		$('#warning').html("");
		$('#warning').attr("class", "alert alert-warning");
		$('#warning').attr("style", "visibility: hidden");
		var valid = true;
		valid = validateUser();
		// si no hay check, no continuar
		if ($('#loader').html() == '<i class="lni lni-checkmark text-success"></i>') {
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
					hash: '_' + Math.random().toString(36).substr(2, 9),
					lang: '<?= $lang ?>'
				}, function(m) {
					if (m["code"] == 200) {
						$('#warning').html("Se ha enviado un email de verificación a " + $('#email').val());
						$('#warning').attr("class", "alert alert-success");
						$('#warning').attr("style", "visibility: visible");
						resetfields();
					} else {
						$('#warning').html("Ha ocurrido un error");
						$('#warning').attr("class", "alert alert-danger");
						$('#warning').attr("style", "visibility: visible");
					}
				})
			}
		} else { // loader not check
			$('#warning').html("Introduzca otro email");
			$('#warning').attr("class", "alert alert-danger");
			$('#warning').attr("style", "visibility: visible");
		}
	}

	function resetfields() {
		console.log("reset");
		$('#firstname').val("");
		$('#lastname').val("");
		$('#email').val("");
		$('#phone').val("");
		$('#address').val("");
		$('#postalCode').val("");
		$('#city').val("");
		$('#province').val("");

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

		if ($('#email').attr("flag") == "no") {
			$("#email").css('background-color', '#FFFFDF');
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

	function validaEmail(email) {
		if (email != "") {
			$('#loader').html('<div class="loading"><img src="images/loader.gif" alt="loading" /></div>');
			var response = $.post("admin/verifymail.php", {
				email: email
			}, function(m) {
				if (m["code"] != 200) {
					$("#email").css('background-color', '#FFFFDF');
					$('#warning').html("Email already exists");
					$('#warning').attr("class", "alert alert-warning");
					$('#warning').attr("style", "visibility: visible");
					$('#email').attr("flag", "no");
					$('#loader').html('<i class="lni lni-close text-danger"></i>');
				} else {
					$('#email').attr("flag", "yes");
					$('#warning').attr("style", "visibility: hidden");
					$("#email").css('background-color', '#FFFFFF');
					$('#loader').html('<i class="lni lni-checkmark text-success"></i>');
				}
			})
		}
	}
</script>