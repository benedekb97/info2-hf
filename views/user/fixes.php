<?php

namespace Auto;

if(!isset($current_user)){
    header("Location: ".Router::getLink('index.login'));
}

if(!$current_user->isAdmin() && !$current_user->isMechanic()){
    header("Location: ".Router::getLink('index'));
}

$page_title = "Én szereléseim";

include __DIR__ . "/../layouts/top.php";

?>
<table>
    <tr>
        <th>Autó</th>
        <th>Autó tulajdonos</th>
        <th>Ár</th>
        <th>Leírás</th>
        <th>Műveletek</th>
    </tr>
    <?php
    if($current_user->services() != null){
        foreach($current_user->services() as $service){
            ?>
            <tr>
                <td><?= $service->getCar()->getType() ?></td>
                <td><?= $service->getCar()->getOwner()->getFullName() ?></td>
                <td><?= $service->getCost() ?></td>
                <td><?= $service->getDescription() ?></td>
                <td>
                </td>
            </tr>
            <?php
        }

    }
    ?>
</table>
<?php

include __DIR__ . "/../layouts/bottom.php";
