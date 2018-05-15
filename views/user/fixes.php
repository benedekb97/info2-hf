<?php

namespace Auto;

use Auto\Models\Car;

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
                    <form action="<?= Router::getLink('user.services.delete', ['user' => $current_user->getId(), 'service' => $service->getId()]) ?>" method="POST">
                        <input type="submit" value="&times;">
                    </form>
                </td>
            </tr>
            <?php
        }

    }
    ?>
</table>
<br>
<br>
<form action="<?= Router::getLink('user.service.add', ['user' => $current_user]) ?>" method="POST">
    <select required name="car">
        <option selected disabled hidden></option>
        <?php
        foreach(Car::all() as $car){
            ?>
            <option value="<?= $car ?>"><?= $car->getType() ?> - <?= $car->getOwner()->getFullName() ?></option>
            <?php

        }
        ?>
    </select>
    <input required type="number" placeholder="Ár" name="cost">
    <input required type="text" placeholder="Leírás" name="description">
    <input type="submit" value="Mentés">
</form>
<?php

include __DIR__ . "/../layouts/bottom.php";
