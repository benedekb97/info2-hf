<?php

namespace Auto;

use Auto\Models\Service;

$page_title = "Szervízelések";

include "layouts/top.php";

?>
<table>
    <tr>
        <th>Autó</th>
        <th>Javította</th>
        <th>Ár</th>
        <th>Leírás</th>
    </tr>
    <?php
    foreach(Service::all() as $service){
        ?>
        <tr>
            <td><?= $service->getCar()->getType() ?></td>
            <td><?= $service->getFixer()->getFullName() ?></td>
            <td><?= $service->getCost() ?></td>
            <td><?= $service->getDescription() ?></td>
        </tr>
        <?php
    }
    ?>
</table>
<?php

include "layouts/bottom.php";