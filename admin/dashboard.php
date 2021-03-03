<div class="container overflow-hidden">
  <div class="row gx-5">
    <div class="col">
      <div class="p-3 border bg-light text-center"><img src="assets/img/logo/logo-dark.png" style="width:280px" alt="Logo"></div>
    </div>
    <div class="col">
      <div class="p-3 border bg-light">
        <div class="card">
          <div class="card-header">
            Citas para Hoy
          </div>
          <div class="card-body">
            <h5 class="card-title"><?= date("d/m/Y") ?></h5>
            <p class="card-text">Hoy están previstas las siguientes citas:</p>
            <?php
            $db = new Database();
            $hoy = date("Y-m-d");
            $cites = $db->send("SELECT * FROM cites a INNER JOIN users b ON a.user_id = b.id WHERE a.date = '" . $hoy . "'");
            if ($cites) :
              echo "<ul>";
              foreach ($cites as $cite) : ?>
                <li>
                  <?= $cite["time_from"] . " / " . $cite["time_until"] . " | " . $cite["firstname"] . " " . $cite["lastname"] ?>
                </li>
            <?php endforeach;
              echo "</ul>";
            else :
              echo "No existen citas";
            endif;
            ?>
            <a href="admin.php?section=cites" class="btn btn-primary">Gestionar Citas</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>