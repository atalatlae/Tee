<?php

class Application
{
  private $_controller;
  private $_action;

  public function __construct() {
    spl_autoload_register(array($this, "autoLoadClass"));
    $this->router();
  }

  public function autoLoadClass($className) {
    $className = str_replace("Chicoco\\", '', $className);

    if (is_file('controller/'.$className.'.php')) {
      require_once("controller/".$className.".php");
    }
    else {
      throw new Exception("Unable to load class $className.");
    }
  }

  public function router() {
		try {
      $r = preg_match("|index.php/([a-zA-Z]{0,50})/?([a-zA-Z]{0,50})|", $_SERVER['PHP_SELF'], $matches);

      $this->_controller = 'IndexController';
      $this->_action = 'IndexAction';

      if ($r) {
        if (isset($matches[1]) && $matches[1] != '') {
          $this->_controller = $matches[1].'Controller';
        }

        if (isset($matches[2]) && $matches[2] != '') {
          $this->_action = $matches[2].'Action';
        }
      }
    }
    catch (Exception $e) {
      return false;
    }
  }

  public function run() {
    $controller = new $this->_controller;
    $controller->{$this->_action}();
  }
}
