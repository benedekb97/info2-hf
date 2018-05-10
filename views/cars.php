<?php

namespace Auto;

use Auto\Models\Car;

$page_title = "Autók";

include "layouts/top.php";

?>
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
        foreach(Car::all() as $car){
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
