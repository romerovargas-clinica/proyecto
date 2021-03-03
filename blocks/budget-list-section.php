<?php
$db = new DataBase();
$result = $db->select("blocks", "id = " . $block["id"]);

$ndb = new DataBase();
// Acción del
if (isset($_GET['del'])) :
	$eliminar1 = $ndb->delete("budgets", "id = " . $_GET['del']);
	$eliminar2 = $ndb->delete("budgets_treatments", "id_budget = " . $_GET['del']);
endif;
?>
<!--========================= budget-list-section start ========================= -->
<section id="budget-list" class="we-do-section pt-20">
	<div class="container">
		<div class="row">
			<div class="col-xl-6 mx-auto">
				<div class="section-title text-center mb-25">
					<span class="wow fadeInDown" data-wow-delay=".2s"><?= __('budget-list-title', $lang) ?></span>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xl-8 mx-auto">
			<?php

			$list = $ndb->select("budgets", "enabled = 1");
			if ($list) : ?>
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th><?= __('budget-list-date', $lang) ?></th>
							<th><?= __('budget-list-customer', $lang) ?></th>
							<th><?= __('budget-list-treatments', $lang) ?></th>
							<th><?= __('budget-list-amount', $lang) ?></th>
							<th><?= __('budget-list-discount', $lang) ?></th>
							<th>Total</th>
							<th><?= __('budget-list-action', $lang) ?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($list as $budget) : ?>
							<tr>
								<td><?= $budget["id"] ?></td>
								<td><?= $budget["date"] ?></td>
								<td><?= $budget["customer_id"] ?></td>
								<td><?= $budget["date"] ?></td>
								<td><?= $budget["amount"] ?> </td>
								<td><?= $budget["discount"] ?> %</td>
								<td><?= $budget["amount"] - ($budget["amount"] * $budget["discount"] / 100) ?></td>
								<td class="nav-item">
									<a href="#"><i class="lni lni-eye" style="font-size: 30px; color: #00ADB5;"></i></a>
									<a href="admin/printPdf.php?id=<?= $budget['id'] ?>"><i class="lni lni-printer" style="font-size: 30px; color: #00ADB5;" id="pri_<?= $budget['id'] ?>"></i></a>
									<a href="#"><i class="lni lni-trash" style="font-size: 30px; color: #00ADB5;" id="del_<?= $budget['id'] ?>" onclick="deleteBudget(this)"></i></a>
								</td>
								<!--  -->
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			<?php else : ?>
				<div class="section-title text-center mb-25"><?= __('budget-list-none', $lang) ?></div>
			<?php endif; ?>
		</div>
	</div>
</section>
<!-- Modal -->
<?php

?>
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><?= __('modal_title_confirm', $lang) ?></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="lni lni-close"></i></button>
			</div>
			<div class="modal-body"><?= __('modal_text_confirm', $lang) ?></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= __('btn_Close', $lang) ?></button>
				<button type="button" class="btn btn-primary" id="buttonOk" value="" onclick="deleteConfirm();"><?= __('btn_Ok', $lang) ?></button>
			</div>
		</div>
	</div>
</div>
<?php $db->close() ?>
<script>
	function deleteBudget(budget) {
		let elem = $(budget).attr("id");
		elem = elem.substr(4, 5);
		console.log(elem);
		$('#buttonOk').attr("value", elem);
		$('#myModal').modal("show");
	}

	function deleteConfirm() {
		let val = $('#buttonOk').attr("value");
		window.location = "budget.php?action=list&del=" + val;
	}

	function printPdf(budget) {
		console.log("clik");
		$.post("admin/printPdf.php", {
			treatments: 1,
		}, function(m) {
			console.log("open")
		});
	}
</script>

<!--========================= budget-list-section end ========================= -->