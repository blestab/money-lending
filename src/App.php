<?php

class App extends \atk4\ui\App {
  function __construct($is_admin = false) {

    parent::__construct('Money Lending');

    // Depending on the use, select appropriate layout for our pages
    if ($is_admin) {
      $this->initLayout('Admin');
      $this->layout->leftMenu->addItem(['Dashboard','icon'=>'dashboard'], ['dashboard']);
      $this->layout->leftMenu->addItem(['Admin','icon'=>'users'], ['admin']);
    } else {
      $this->initLayout('Centered');
    }
    $this->dbConnect(getenv('CLEARDB_DATABASE_URL')?getenv('CLEARDB_DATABASE_URL'):'mysql://root:@localhost/money-lending');
  }

}
