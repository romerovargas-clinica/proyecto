	<!-- ========================= JS here ========================= -->
	<script src="assets/js/bootstrap.bundle-5.0.0.alpha-min.js"></script>
	<script src="assets/js/wow.min.js"></script>
	<script src="assets/js/tiny-slider.js"></script>
	<script src="assets/js/main.js"></script>

	<!-- fa-icons -->
	<script src="https://kit.fontawesome.com/42adee8d9b.js" crossorigin="anonymous"></script>

	<script>
	  // cambios de idioma
	  const selectElement = document.getElementById('selectlang');
	  selectElement.addEventListener('change', (event) => {
	    let url = window.location.href.toString();
	    const regex = /\?lang\=[a-z]*/g;
	    url = url.replace(regex, '');
	    window.location.href = url + '?lang=' + selectElement.value;
	  });

	  // selector horario para citas
	  const selectHour = document.getElementById('customRange3');
	  const lblHours = document.getElementById("lbl");
	  const widthLbl = lblHours.scrollWidth;
	  selectHour.value = 0;
	  const duration = document.getElementById('duration').getAttribute("value");
	  const dur = parseInt(duration);
	  var h = "9";
	  var m = "0";

	  function horas(h) {
	    if (h < 10) {
	      return "0" + h;
	    } else {
	      return h.toString();
	    }
	  }

	  function minutos(m) {
	    if (m < 10) {
	      return "0" + m;
	    } else {
	      return m.toString();
	    }
	  }

	  function hourIsBetween(h_inicio, h_fin, h_inicio_ocupada, h_fin_ocupada) {
	    let f_inicio = Date.parse("Thu dec 28 1972 " + h_inicio + ":00 GMT");
	    let f_fin = Date.parse("Thu dec 28 1972 " + h_fin + ":00 GMT");
	    let f_inicio_ocupada = Date.parse("Thu dec 28 1972 " + h_inicio_ocupada + ":00 GMT");
	    let f_fin_ocupada = Date.parse("Thu dec 28 1972 " + h_fin_ocupada + ":00 GMT");
	    let libre = true;
	    if (f_inicio <= f_inicio_ocupada && f_fin > f_inicio_ocupada) libre = false;
	    if (f_inicio >= f_inicio_ocupada && f_inicio < f_fin_ocupada) libre = false;
	    return libre;
	  }

	  let arrF = new Array();
	  let arrU = new Array();
	  lblHours.innerHTML = horas(h) + ":" + minutos(m);
	  selectHour.addEventListener('input', (event) => {
	    let val = selectHour.value;
	    arrF = [];
	    arrU = [];
	    // hora inicial
	    mi = val % 60;
	    hi = 9 + Math.trunc((val - mi) / 60);
	    // hora final
	    mf1 = Math.trunc((mi + dur) / 60);
	    mf = (mi + dur) % 60;
	    hf = hi + mf1 + Math.trunc(dur / 60);
	    // Colección con todos los tramos horarios ocupados
	    let from = document.getElementsByClassName("from");
	    let until = document.getElementsByClassName("until");
	    Array.prototype.filter.call(from, function(occupedFrom) {
	      arrF.push(occupedFrom.getAttribute("value").substr(0, 5));
	    })
	    Array.prototype.filter.call(until, function(occupedUntil) {
	      arrU.push(occupedUntil.getAttribute("value").substr(0, 5));
	    })
	    color = true;
	    for (hora_ocupada_inicio of arrF) {
	      hora_ocupada_final = arrU[arrF.indexOf(hora_ocupada_inicio)];
	      horas_inicio = horas(hi) + ":" + minutos(mi);
	      horas_fin = horas(hf) + ":" + minutos(mf)
	      if (!hourIsBetween(horas_inicio, horas_fin, hora_ocupada_inicio, hora_ocupada_final)) {
	        color = false;
	        break;
	      }
	    }
	    let posX = Math.trunc((val * selectHour.scrollWidth / 600) - (widthLbl / 2));
	    lblHours.setAttribute("style", "transform: translate(" + posX + "px, 0);");
	    if (color) {
	      lblHours.setAttribute("class", "badge bg-success me-1");
	      lblHours.setAttribute("onclick", "location.href='cites.php?new&tab=3&hourfrom=" + horas(hi) + ":" + minutos(mi) + "&houruntil=" + horas(hf) + ":" + minutos(mf) + "'");
	      lblHours.innerHTML = horas(hi) + ":" + minutos(mi) + " - " + horas(hf) + ":" + minutos(mf);
	    } else {
	      lblHours.removeAttribute("onclick");
	      lblHours.setAttribute("class", "badge bg-danger me-1");
	      lblHours.innerHTML = horas(hi) + ":" + minutos(mi) + " - " + horas(hf) + ":" + minutos(mf);
	    }
	  })
	</script>