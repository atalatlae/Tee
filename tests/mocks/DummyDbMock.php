<?php

class DummyDb
{
  protected $storage;

  public function __construct(){
    $this->storage = array();
    $this->loadData();
  }

  public function add($key, $value) {
    $this->storage[$key] = $value;
  }

  public function exists($key) {
    return isset($this->storage[$key]);
  }

  public function get($key) {
    if ($this->exists($key)) {
      return $this->storage[$key];
    }
    return null;
  }

  public function count() {
    return count($this->storage);
  }

  public function loadData() {
    $user = new User('foo', 'var', array('page1' => 1));
    $this->add('foo', $user);
  }

  public function save() {

  }
}
