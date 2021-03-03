	<!-- ========================= JS here ========================= -->
	<script src="assets/js/bootstrap.bundle-5.0.0.alpha-min.js"></script>
	<script src="assets/js/contact-form.js"></script>
	<script src="assets/js/selectr.min.js"></script>
	<script src="assets/js/wow.min.js"></script>
	<script src="assets/js/date.js"></script>	
	<script src="assets/js/glightbox.min.js"></script>
	<script src="assets/js/main.js"></script>

	<script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

	<!-- JQuery -->
	<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

	<!-- fa-icons -->
	<script src="https://kit.fontawesome.com/42adee8d9b.js" crossorigin="anonymous"></script>

	<script>
		// cambios de idioma
		/*
		const selectElement = document.getElementById('selectlang');
		selectElement.addEventListener('change', (event) => {
			let url = window.location.href.toString();
			const regex = /\?lang\=[a-z]\*/
		/*g;
					url = url.replace(regex, '');
					window.location.href = url + '?lang=' + selectElement.value;
				});
				*/
	</script>

	<script>
		(function(d, t) {
			var BASE_URL = "https://app.chatwoot.com";
			var g = d.createElement(t),
				s = d.getElementsByTagName(t)[0];
			g.src = BASE_URL + "/packs/js/sdk.js";
			s.parentNode.insertBefore(g, s);
			g.onload = function() {
				window.chatwootSDK.run({
					websiteToken: 'gztoHeTAfwnfs3QgWXXovkEy',
					baseUrl: BASE_URL
				})
			}
		})(document, "script");
	</script>