<?php
require 'vendor/autoload.php';

$app = new App();
$app->initLayout('Centered');

$user = new Model\User($app->db);
$user->load(($_SESSION['user_id'])?$_SESSION['user_id']:1);

$app->add('CRUD')->setModel($user->ref('Friends'));
$app->add('CRUD')->setModel($user->ref('Loans'));
$app->add('CRUD')->setModel($user->ref('Repayments'));
