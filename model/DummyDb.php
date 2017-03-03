<?php

class DummyDb
{
  protected $storage;

  public function __construct() {
    $this->storage = array();
    $this->loadData('userdb.txt');
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

  private function LoadData($theFile) {
    $lines = file($theFile);

    foreach($lines as $l) {
      list($key, $value) = explode('|', $l);
      $obj = unserialize($value);
      $this->add($key, $obj);
    }
  }
}
