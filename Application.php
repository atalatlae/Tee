<?php

class Application
{
  private $_controller;
  private $_action;
  private $_params;

  public function __construct() {
    $this->params = array();
    $this->_controller = 'IndexController';
    $this->_action = 'IndexAction';

    spl_autoload_register(array($this, "autoLoadClass"));
    $this->router();
  }

  public function autoLoadClass($className) {
    $className = str_replace("Chicoco\\", '', $className);

    if (is_file('controller/'.$className.'.php')) {
      require_once('controller/'.$className.'.php');
    }
    else if (is_file('model/'.$className.'.php')){
      require_once('model/'.$className.'.php');
    }
    else {
      throw new Exception("Unable to load class $className.");
    }
  }

  public function router() {
		try {
      $r = preg_match("|index.php/([a-zA-Z]{0,50})/?([a-zA-Z0-9]{0,50})|", $_SERVER['PHP_SELF'], $matches);

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
    try {
      $this->parseParams();
      $controller = new $this->_controller;
      $controller->params = $this->params;

      if (!method_exists($controller, $this->_action)) {
        throw new Exception('Action not exist');
      }
      $controller->{$this->_action}();
    }
    catch(Exception $e) {
      header("HTTP/1.0 404");
      include('view/404.phtml');
    }
  }

  private function parseParams() {
    $parts = explode('/', $_SERVER['PHP_SELF']);
    $parts = array_filter($parts);

    if (count($parts) > 3) {
      for($i = 4; $i <= count($parts); $i++) {
        $this->params[] = $parts[$i];
      }
    }
  }
}
