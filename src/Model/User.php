<?php
namespace Model;
use \Mailjet\Resources;

class User extends \atk4\data\Model {
  public $table = 'user';
  function init() {
    parent::init();

    $this->addFields([
      'email',
      ['name','required'=>true],
      'password',
      ['is_confirmed','type'=>boolean],
      ['is_admin','type'=>boolean],
    ]);

    $ref = $this->hasMany('Friends', new Friend());
    $ref = $this->hasMany('Loans', new Friend());
    $ref = $this->hasMany('Repayments', new Friend());
  }

  function sendEmailConfirmation() {

    $mj = new \Mailjet\Client((getenv('MJ_APIKEY_PUBLIC'))?getenv('MJ_APIKEY_PUBLIC'):'8225b5a3c569485aa0493908c57c30ab',
    (getenv('MJ_APIKEY_PRIVATE'))?getenv('MJ_APIKEY_PRIVATE'):'1ca594aedc8232ee70cc14921df50496',
    true,
    ['version' => 'v3.1']);
    $body = [
      'Messages' => [
        [
          'From' => [
            'Email' => "support@afrilims.co.za",
            'Name' => "Money Lending App"
          ],
          'To' => [
            [
              'Email' => $this['email'],
              'Name' => $this['name']
            ]
          ],
          'TemplateID' => 831150,
          'TemplateLanguage' => true,
          'Subject' => "Hi there, welcome to Money Lending ",
          'Variables' => [
            'name'=> $this['name'],
            'confirmation_link'=> 'http://www.google.com?s=agiletoolkit php'
          ]
        ]
      ]
    ];
    $response = $mj->post(Resources::$Email, ['body' => $body]);
    $response->success() && var_dump($response->getData());
  }
}
