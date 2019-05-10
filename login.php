<?php
require 'vendor/autoload.php';

$app = new App();

$form = $app->add('Form');
$form->setModel(new Model\User($app->db), ['name', 'password']);
$form->onSubmit(function($form) {

  $user = new Model\User($app->db);
     $user->tryLoadBy('name', $form->model['name']);
     if ($user['password'] != $form->model['password']) {
         return [$form->error('name','Incorrect name or password!'),
                 $form->error('password','Incorrect name or password!')];
     } else {
       $_SESSION['user_id'] = $user['id'];
       return new \atk4\ui\jsExpression('document.location="user.php"');
     }
});
