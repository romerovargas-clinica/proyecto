<div class="container-fluid bg-light p-2">
    <a name="login"></a>
    <div class="container p-2 mt-2 mb-2 bg-white">
        <div class="h1"><?= __($tt_name_int, $lang) ?></div>
        <!-- login -->
        <div class="row">
            <div class="col-lg">
                <div class="container-fluid container-sm p-5" style="width: 20rem;">
                    <form id="frmLogin" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
                        <div class="mb-3">
                            <label for="frmInputEmail" class="form-label"><?= __('frm_Email', $lang) ?></label>
                            <input type="text" class="form-control" name="frmInputEmail" id="frmInputEmail" placeholder="nick our name@example.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="frmInputPass" class="form-label"><?= __('frm_Pass', $lang) ?></label>
                            <input type="password" class="form-control" name="frmInputPass" id="frmInputPass" placeholder="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="frmInputRemember" class="form-label"><?= __('frm_Remember', $lang) ?>
                                <input type="checkbox" class="" name="frmInputRemember" id="frmInputRemember" value="1"></label>
                        </div>
                        <div class="mb-3">
                            <input type="submit" class="btn btn-primary" value="<?= __('frm_Send', $lang) ?>">
                        </div>
                    </form>
                    <div class="container-fluid container-sm" style="width: 20rem;">
                        <?= __('lbl_QuestionNotRegister', $lang) ?> | <a class="small" href="register.php"><?= __('frm_Register', $lang) ?></a>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <img src="images/carousel/chair-2589771_640.jpg" class="img-thumbnail">
            </div>
        </div>
    </div>
</div>