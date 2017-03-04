--TEST--
Session_002: Test setVar() method: success
--FILE--
<?php
include ('model/Session.php');

$session = new Session();
$session->setVar('id', 123456);
var_dump($_SESSION);
?>
--EXPECT--
array(1) {
  ["id"]=>
  int(123456)
}
