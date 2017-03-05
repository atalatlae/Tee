--TEST--
Session_001: Test the constructor
--FILE--
<?php
include ('model/Session.php');

$session = new Session();
var_dump($session);
?>
--EXPECT--
object(Session)#1 (1) {
  ["maxLife":"Session":private]=>
  int(300)
}
