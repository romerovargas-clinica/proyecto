<?php
$db = new DataBase();
$result = $db->select("blocks", "id = " . $block["id"]);
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
		<div class="col-xl-12 mx-auto">
			<?php
			$ndb = new DataBase();
			$list = $ndb->select("budgets", "enabled = 1");
			if ($list) : ?>
				<table class="table">
					<thead>
						<tr>
							<th scope="col">#
							<th>
							<th scope="col"><?= __('budget-list-date', $lang) ?>
							<th>
							<th scope="col"><?= __('budget-list-customer', $lang) ?>
							<th>
							<th scope="col"><?= __('budget-list-treatments', $lang) ?>
							<th>
							<th scope="col"><?= __('budget-list-amount', $lang) ?>
							<th>
							<th scope="col"><?= __('budget-list-discount', $lang) ?>
							<th>
							<th scope="col"><?= __('budget-list-action', $lang) ?>
							<th>
						</tr>
					</thead>
				</table>
			<?php else : ?>
				<div class="section-title text-center mb-25"><?= __('budget-list-none', $lang) ?></div>
			<?php endif; ?>
		</div>
	</div>
</section>
<?php $db->close() ?>
<!--========================= budget-list-section end ========================= -->