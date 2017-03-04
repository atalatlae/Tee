<?php

class User
{
  public $username;
  public $password;
  public $roles;

  public function __construct($username = '', $password = '', Array $roles = array()) {
    $this->username = 'foo';
    $this->password = 'pass';
    $this->roles = array('page1' => 1);
  }

  public function hasRole($role) {
    return isset($this->roles[$role]);
  }
}
