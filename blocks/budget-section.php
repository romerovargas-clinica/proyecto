<?php
$db = new DataBase();
$result = $db->select("blocks", "id = " . $block["id"]);
?>
<!--========================= budget-section start ========================= -->
<section id="budget" class="we-do-section pt-20">
	<div class="shape shape-3">
		<img src="assets/img/shapes/shape-3.svg" alt="">
	</div>
	<div class="container">
		<div class="row">
			<div class="col-lg-3">
				<div class="we-do-item mb-25">
					<a href="budget.php?action=new">
						<div class="we-do-icon mb-20 d-none d-md-block">
							<i class="lni lni-add-files" style="font-size: 30px; color: #00ADB5; translate: 0 8px"></i>
						</div>
					</a>
					<h5><a href="budget.php?action=new"><?= __('budget-menu-new', $lang) ?></a></h5>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="we-do-item mb-30">
					<a href="budget.php?action=search">
						<div class="we-do-icon mb-25">
							<i class="lni lni-search-alt" style="font-size: 30px; color: #00ADB5; translate: 0 8px"></i>
						</div>
					</a>
					<h5><a href="budget.php?action=search"><?= __('budget-menu-search', $lang) ?></a></h5>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="we-do-item mb-30">
					<a href="budget.php?action=clients">
						<div class="we-do-icon mb-25">
							<i class="lni lni-users" style="font-size: 30px; color: #00ADB5; translate: 0 8px"></i>
						</div>
					</a>
					<h5><a href="budget.php?action=clients"><?= __('budget-menu-clients', $lang) ?></a></h5>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="we-do-item mb-30">
					<a href="budget.php?action=list">
						<div class="we-do-icon mb-25">
							<i class="lni lni-list" style="font-size: 30px; color: #00ADB5; translate: 0 8px"></i>
						</div>
					</a>
					<h5><a href="budget.php?action=list"><?= __('budget-menu-list', $lang) ?></a></h5>
				</div>
			</div>
		</div>
	</div>
</section>
<!--========================= budget-section end ========================= -->
<?php if (isset($_GET['action'])) :
	$action = $_GET["action"];
else :
	$action = "list";
endif;
switch ($action):
	case "list":
		include "blocks/budget-list-section.php";
		break;
	case "new":
		include "blocks/budget-new-section.php";
		break;
	case "clients":
		include "blocks/budget-clients-section.php";
		include "blocks/budget-clients-script-section.php";
		break;
endswitch;
