<?php

class DummyDb
{
  protected $storage;
  protected $dataFile;

  public function __construct() {
    $this->storage = array();
    $this->dataFile = 'data.txt';
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

  protected function LoadData() {
    $lines = file($this->dataFile);

    foreach($lines as $l) {
      list($key, $value) = explode('|', $l);
      $obj = unserialize($value);
      $this->add($key, $obj);
    }
  }

  public function save() {
    foreach($this->storage as $k => $v) {
      $data[$k] = "$k|".serialize($v)."\n";
    }
    return file_put_contents($this->dataFile, $data);
  }
}
