<div class="container-fluid bg-light p-2">
<a name="headerimage"></a>
<div class="container p-2 mt-2 mb-2 bg-white">
    <?php
    // Parámetros de configuración del bloque
    $specialties = $db->select("block", "name = '" . $name_block . "'");
    $recordset = $db->send("SELECT * FROM block where name = '$name_block';");
    ?>
    <div class="h1">Bienvenidos</div>
    <div class="row">
        <div class="col-lg">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </div>
        <div class="col-sm">
            <img src="images/carousel/doctor-563429_640.jpg" class="img-thumbnail" >
        </div>
    </div>
</div>
</div>