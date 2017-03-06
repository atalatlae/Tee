--TEST--
IndexController_001: test the constructor
--FILE--
<?php
require_once('model/Session.php');
require_once('controller/IndexController.php');

$indexController = new IndexController();
var_dump($indexController);

?>
--EXPECT--
object(IndexController)#1 (1) {
  ["currentUser":"IndexController":private]=>
  NULL
}
