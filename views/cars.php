<?php

namespace Auto;

use Auto\Models\Car;

$page_title = "Autók";

include "layouts/top.php";


if(Request::type() == "POST"){
    if(Request::post('search_value')!=null){
    $search_value = Request::post('search_value');

    $cars = Car::search($search_value);

        ?>

        <?php
    }

}else {
    $cars = Car::all();
}
?>
<form action="<?= Router::getLink('cars.search') ?>" method="POST">
    Keresés:
    <input type="text" name="search_value" placeholder="Autó típusa">
    <input type="submit" value="Keresés">
    <input type="button" onclick="window.location = window.location" value="Összes">
</form>
    <table>
        <tr>
            <th>Típus</th>
            <th>Életkor</th>
            <th>Műszaki vizsga</th>
            <?php
            if(isset($current_user) && ($current_user->isAdmin() || $current_user->isMechanic())){
                ?>
                <th>Tulajdonos</th>
                <?php
            }
            if(isset($current_user) && $current_user->isAdmin()){
                ?>
                <th>Műveletek</th>
                <?php
            }
            ?>
        </tr>
        <?php
        foreach($cars as $car){
            ?>
            <tr>
                <td><?= $car->getType() ?></td>
                <td><?= $car->getAge() ?></td>
                <td><?= $car->getTechnicalExamYear() ?></td>
                <?php
                if(isset($current_user) && ($current_user->isAdmin() || $current_user->isMechanic())){
                    ?>
                    <td><?= $car->getOwner()->getFullName() ?></td>
                    <?php
                }
                if(isset($current_user) && $current_user->isAdmin()){
                    ?>
                    <td>
                        <form action="<?= Router::getLink('user.cars.delete', ['user' => $car->getOwner()->getId(), 'car' => $car->getId()]) ?>" method="POST">
                            <input type="hidden" name="return_to" value="cars">
                            <input type="submit" value="&times;">
                        </form>
                    </td>
                    <?php
                }
                ?>
            </tr>
            <?php
        }
        ?>
    </table>
<?php

include "layouts/bottom.php";
