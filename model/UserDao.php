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

  public function getAll() {
    return $this->storage;
  }

  public function create(User $user) {
    $this->add($user->username, $user);
    $this->save();
    return true;
  }

  public function delete($username) {
    if ($this->exists($username)) {
      unset($this->storage[$username]);
      $this->save();
      return true;
    }
    else {
      return false;
    }
  }
}
