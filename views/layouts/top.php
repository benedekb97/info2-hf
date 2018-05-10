<?php
namespace Auto;
?><!DOCTYPE html>
<html lang="hu">
<head>
    <title><?= $page_title; ?></title>
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
<div class="container">
    <div class="header">
        <a class="header_link first" href="<?= Router::getLink('index'); ?>">Főoldal</a>
        <a class="header_link" href="<?= Router::getLink('cars'); ?>">Autók</a>
        <a class="header_link" href="<?= Router::getLink('mechanics'); ?>">Autószerelők</a>
        <a class="header_link" href="<?= Router::getLink('services'); ?>">Szervízelések</a>
        <?php
        if(!isset($current_user)){
            ?>
            <a class="header_link right first" href="#" id="login_button">Bejelentkezés</a>
            <?php
        }else{
            ?>
            <a class="header_link right first" href="<?= Router::getLink('logout'); ?>">Kijelentkezés</a>
            <?php
            if($current_user->isMechanic() || $current_user->isAdmin()){
                ?>
                <a class="header_link right" href="<?= Router::getLink('user.fixes', ['user' => $current_user->getId()]); ?>">Én szervízeléseim</a>
                <?php
            }
            ?>
            <a class="header_link right" href="<?= Router::getLink('user.cars', ['user' => $current_user->getId()]); ?>">Autóim</a>
            <?php
        }
        ?>
    </div>
    <div class="content">