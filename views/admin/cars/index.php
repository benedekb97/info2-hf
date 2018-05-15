<?php

namespace Auto;

use Auto\Models\Car;
use Auto\Models\User;

if (!isset($current_user)) {
    Router::redirect('index.login');
}

if (!$current_user->isAdmin()) {
    Router::redirect('index');
}

$page_title = "Összes autó";

include __DIR__ . "/../../layouts/top.php";

?>
    <table>
        <tr>
            <th>Típus</th>
            <th>Életkor</th>
            <th>Műszaki vizsga éve</th>
            <th>Tulajdonos</th>
            <th>Műveletek</th>
        </tr>
        <?php
        foreach (Car::all() as $car) {
            ?>
            <form action="<?= Router::getLink('admin.cars.modify', ['car' => $car]) ?>" method="POST">
                <tr>
                    <td>
                        <input type="text" name="type_<?= $car ?>" placeholder="Autó típusa" value="<?= $car->getType() ?>">
                    </td>
                    <td>
                        <input type="number" name="age_<?= $car ?>" placeholder="Életkor" value="<?= $car->getAge() ?>">
                    </td>
                    <td>
                        <input type="number" name="technical_exam_year_<?= $car ?>" placeholder="Műszaki vizsga éve" value="<?= $car->getTechnicalExamYear() ?>">
                    </td>
                    <td>
                        <select name="owner_<?= $car ?>" required>
                            <?php
                            foreach(User::all() as $user){
                                ?>
                                <option <?php
                                if($car->getOwner()->getId() == $user->getId()){
                                    echo "selected ";
                                }
                                 ?>value="<?= $user ?>"><?= $user->getFullName() ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        <input type="submit" value="Mentés">
                        <input type="button" onclick="window.location = window.location" value="Visszaállítás">
                        <input type="button" onclick="$('#delete-<?= $car ?>').submit()" value="&times;">
                    </td>
                </tr>
            </form>
            <form id="delete-<?= $car ?>" action="<?= Router::getLink('admin.cars.delete', ['car' => $car]) ?>" method="POST"></form>
            <?php
        }
        ?>
    </table>
<br>
<br>
<form action="<?= Router::getLink('admin.cars.new') ?>" method="POST">
    <input required type="text" name="type" placeholder="Típus">
    <input required type="number" name="age" placeholder="Életkor">
    <input required type="number" name="technical_exam_year" placeholder="Műszaki vizsga éve">
    <select name="owner" required>
        <option>Tulajdonos</option>
        <option>---</option>
        <?php
        foreach(User::all() as $user){
            ?>
            <option value="<?= $user ?>"><?= $user->getFullName() ?></option>
            <?php
        }
        ?>
    </select>
    <input type="submit" value="Mentés">
</form>
    <?php

include __DIR__ . "/../../layouts/bottom.php";