<?php

namespace Auto;

use Auto\Models\User;

$page_title = "Autószerelők";

include "layouts/top.php";

?>
<table>
    <tr>
        <th>Név</th>
        <th>Születésnap</th>
        <th>Szervízek száma</th>
    </tr>
    <?php
        foreach(User::mechanics() as $mechanic){
            ?>
            <tr>
                <td><?= $mechanic->getFullName() ?></td>
                <td><?= $mechanic->getDOB() ?></td>
                <td><?= sizeof($mechanic->services()) ?></td>
            </tr>
            <?php
        }
    ?>
</table>
<?php

include "layouts/bottom.php";