<?php

class UserDao extends DummyDb
{
  public function __construct() {
    $this->storage = array();
    $this->dataFile = 'userdb.txt';
    $this->loadData();
  }

  public function getByUsername($username) {
    return $this->get($username);
  }
}
