<?php

class User
{
  public $username;
  public $password;
  public $roles;

  public function __construct($username = '', $password = '', Array $roles = array()) {
    $this->username = $username;
    $this->password = $password;
    $this->roles = $roles;
  }

  public function hasRole($role) {
    return isset($this->roles[$role]);
  }
}
