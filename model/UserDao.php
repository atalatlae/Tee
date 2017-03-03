<?php

class UserDao extends DummyDb
{
  public function __construct() {
    parent::__construct();
  }

  public function getByUsername($username) {
    return $this->get($username);
  }
}
