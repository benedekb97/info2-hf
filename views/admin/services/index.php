<?php

namespace Auto;

use Auto\Models\Car;
use Auto\Models\Service;
use Auto\Models\User;

if(!isset($current_user)){
    header("Location: ".Router::getLink('index.login'));
}

if(!$current_user->isAdmin()){
    header("Location: ".Router::getLink('index'));
}

$page_title = "Összes szerelés";

include __DIR__ . "/../../layouts/top.php";

?>
<table>
    <tr>
        <th>Autó</th>
        <th>Javította</th>
        <th>Ár</th>
        <th>Leírás</th>
        <th>Műveletek</th>
    </tr>
    <?php
    foreach(Service::all() as $service){
        ?>
        <form action="<?= Router::getLink('admin.services.modify', ['service' => $service->getId()]) ?>" method="POST">
            <tr>
                <td>
                    <select name="car-<?= $service->getId() ?>">
                        <?php
                        foreach(Car::all() as $car){
                            ?>
                                <option <?php
                                    if($service->getCar() == $car){
                                        echo "selected ";
                                    }
                                 ?>value="<?= $car->getId() ?>"><?= $car->getType() ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <select name="fixer-<?= $service->getId() ?>">
                        <?php
                        foreach(User::mechanics() as $mechanic){
                            ?>
                            <option <?php
                            if($service->getFixer() == $mechanic){
                                echo "selected ";
                            }
                            ?>value="<?= $mechanic->getId() ?>"><?= $mechanic->getFullName() ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <input name="cost-<?= $service->getId() ?>" type="text" value="<?= $service->getCost() ?>" placeholder="Ár">
                </td>
                <td>
                    <input name="description-<?= $service->getId() ?>" type="text" value="<?= $service->getDescription() ?>" placeholder="Leírás">
                </td>
                <td>
                    <input type="submit" value="Mentés">
                    <input type="button" value="Visszaállítás" onclick="window.location = window.location">
                    <input type="button" onclick="$('#delete-<?= $service->getId() ?>').submit()" value="&times;">
                </td>
            </tr>
        </form>
        <form id="delete-<?= $service->getId() ?>" action="<?= Router::getLink('admin.services.delete', ['service' => $service->getId()]) ?>" method="POST"></form>
        <?php
    }
    ?>
</table>

<br>
<br>

Új szervíz:
<form action="<?= Router::getLink('admin.services.new'); ?>" method="POST">
    <select name="car">
        <option value="">Autó kiválasztása</option>
        <?php
        foreach(Car::all() as $car){
            ?>
            <option value="<?= $car->getId() ?>"><?= $car->getType() ?></option>
            <?php
        }
        ?>
    </select>
    <select name="fixer">
        <option value="">Autószerelő kiválasztása</option>
        <?php
        foreach(User::mechanics() as $mechanic){
            ?>
            <option value="<?= $mechanic->getId() ?>"><?= $mechanic->getFullName() ?></option>
            <?php
        }
        ?>
    </select>
    <input type="text" name="cost" placeholder="Ár" maxlength="9" size="9">
    <input type="text" name="description" placeholder="Leírás">
    <input type="submit" value="Mentés">
</form>
<?php

include __DIR__ . "/../../layouts/bottom.php";