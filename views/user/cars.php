<?php

namespace Auto;

use Auto\Models\User;

if(!isset($current_user)){
    header("Location: ".Router::getLink('index.login'));
}

$user = User::find(Request::get('user'));


if(!$current_user->isAdmin() && $current_user != $user){
    header("Location: ".Router::getLink('index'));
}

$page_title = "Én autóim";

include __DIR__ . "/../layouts/top.php";

?>
<table>
    <tr>
        <th>Típus</th>
        <th>Életkor</th>
        <th>Műszaki vizsga éve</th>
        <th>Műveletek</th>
    </tr>
    <?php
    foreach($user->getCars() as $car){
        ?>
        <tr>
            <td><?= $car->getType(); ?></td>
            <td><?= $car->getAge(); ?></td>
            <td><?= $car->getTechnicalExamYear(); ?></td>
            <td>
                <form action="<?= Router::getLink('user.cars.delete', ['user' => $user->getId(), 'car' => $car->getId()]) ?>" method="POST">
                    <input type="submit" value="&times;">
                </form>
            </td>
        </tr>
        <?php
    }
    ?>
</table>
<br>
<form action="<?= Router::getLink('user.cars.add', ['user' => $user->getId()]); ?>" method="POST">
    Új autó hozzárendelése:
    <input type="text" placeholder="Autó Típusa" name="type">
    <input type="text" placeholder="Életkor" name="age">
    <input type="text" placeholder="Műszaki vizsga éve" name="technical_exam_year">
    <input type="submit" value="Mentés">
</form>
<?php
include __DIR__ . "/../layouts/bottom.php";
