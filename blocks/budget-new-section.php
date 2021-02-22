<?php
?>
<!--========================= budget-new-section start ========================= -->
<section id="budget-list" class="we-do-section pt-20">
	<div class="container">
		<div class="row">
			<div class="col-xl-6 mx-auto">
				<div class="section-title text-center mb-25">
					<span class="wow fadeInDown" data-wow-delay=".2s"><?= __('budget-new-title', $lang) ?></span>
					<p class="wow fadeInUp" data-wow-delay=".6s"><?= __('budget-new-text', $lang) ?></p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xl-12">
				<div class="contact-section">
					<div id="contact-form" class="contact-form">
						<div class="row">
							<span id="userName-info" class="info"></span>
							<div class="col-md-6">
								<input type="text" id="client" name="client" placeholder="<?= __('budget-list-customer', $lang) ?>" required>
								<div id="suggestions"></div>
							</div>
							<div class="col-md-6">
								<button class="btn theme-btn" onClick="location.href='budget.php?action=clients'"><i class="lni lni-users" style="font-size: 25px;"></i></button>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<label>Carta de Servicios</label><br>
								<select name="category" class="contact-form" id="allSelect" multiple="multiple">
									<?php
									$db = new DataBase();
									$result = $db->select("treatmentscategories", "1 = 1");
									foreach ($result as $category) : ?>
										<option value="0" disabled='disabled'><span class="badge bg-secondary"><?= $category["name"] ?></span></option>
										<?php
										$tratamientos = $db->select('treatmentsinterventions', 'categorie = ' . $category["id"]);
										foreach ($tratamientos as $tratamiento) : ?>
											<option value="<?= $tratamiento["id"] ?>">&nbsp; - <?= $tratamiento["name"] ?></option>
									<?php endforeach;
									endforeach; ?>
								</select>
							</div>
							<div class="col-md-2">
								<label>Añadir Item</label><br>
								<button class="btn theme-btn" onClick="addBudget()"><i class="lni lni-forward" style="font-size: 25px;"></i></button>
							</div>
							<div class="col-md-2">
								<label style="float:right">Quitar Item</label><br>
								<button class="btn theme-btn" style="float:right" onClick="removeBudget()"><i class="lni lni-backward" style="font-size: 25px;"></i></button>
							</div>
							<div class="col-md-4">
								<label>Tratamientos seleccionados</label><br>
								<select name="category" class="contact-form" id="mySelect" multiple="multiple">
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label>Fecha</label><br>
								<input type="date" name="date" id="date" placeholder="Date*" required>
							</div>

							<div class="col-md-6">
								<label>Descuento (%)</label><br>
								<input type="number" name="discount" id="discount" placeholder="Discount" max="100" min="0" step="0.01">
							</div>
						</div>
						<div class="row">
							<div class="col-xl-12">
								<button class="btn theme-btn" onClick="calcular(); sumarTotal();">Calcular Presupuesto</button>
							</div>
						</div>
					</div>
					<p class="form-message pt-15"></p>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xl-12 mx-auto mt-25">
		</div>
	</div>
</section>

<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><?= __('budget-client-subtitle', $lang) ?></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<h6>Cliente</h6>
			<div class="row">
				<div class="col-8">
					<div class="p-2" id="clientName"></div>
				</div>
				<div class="col-4">
					<div class="pe-2" id="dateBudget"></div>
				</div>
			</div>
			<h6>Tratamientos seleccionados:</h6>
			<div class="row">
				<div class="col-8">
					<div id="treatmentsList"></div>
				</div>
				<div class="col-4">
					<div class="pe-2" id="priceList"></div>
				</div>
			</div>
			<h6>Descuento:</h6>
			<div class="row">
				<div class="pe-2" id="discountBudget"></div>
			</div>
			<h6>Total Presupuesto:</h6>
			<div class="row">
				<div class="pe-2" id="total_"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= __('btn_Close', $lang) ?></button>
				<button type="button" class="btn btn-primary" onclick="aceptar();"><?= __('btn_Ok', $lang) ?></button>
			</div>
		</div>
	</div>
</div>


<?php $db->close() ?>
<!--========================= budget-new-section end ========================= -->
<script>
	function addBudget() {
		$('#allSelect :selected').map(function(i, el) {
			$('#mySelect').append(new Option($(el).text(), $(el).val()));
			$(el).attr('disabled', 'disabled');
			$(el).removeAttr('selected');
			$(el).prop('selected', false);
		});
	}


	function removeBudget() {
		$('#mySelect :selected').map(function(i, el) {
			var elementToEnabled = $(el).val();

			$('#allSelect option').map(function(j, eSearch) {
				if ($(eSearch).val() == elementToEnabled) {
					$(this).attr('disabled', false);
					$(this).removeAttr('disabled');
				}
			})
			$(this).remove();
		});
	}

	function calcular() {
		var amount = 0;
		var discount = parseFloat($('#discount').val());
		if (isNaN(discount)) discount = 0;
		var cont = 0;
		$('#treatmentsList').empty()
		$('#priceList').empty();
		$('#clientName').html($('#client').val());
		$('#dateBudget').html("<p style='text-align:right; padding-right: 30px;'>" + $('#date').val() + " € </p>");
		$('#discountBudget').html("<p style='text-align:right; padding-right: 30px;'>" + discount + " % </p>");
		$('#mySelect option').map(function(i, el) {
			cont++;
			$.post("admin/price.php", {
				treatments: $(el).val(),
			}, function(m) {
				if (m["code"] == 200) {
					$('#treatmentsList').append("<p>" + $(el).text() + "</p>");
					$('#priceList').append("<p class='font-monospace' style='text-align:right; padding-right: 30px;'>" + parseFloat(m["price"]) + "€ </p>");
					amount = amount + parseFloat(m["price"]);
				}
				$('#total_').attr("value", amount);
			})
		});
		$('#myModal').modal('show');
	}

	function sumarTotal() {
		var total = $('#total_').attr("value");
		total = total * (discount / 100);
		$('#total_').html("<p style='text-align:right; padding-right: 30px;'>" + total + " €</p>");
	}
</script>