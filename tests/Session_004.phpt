--TEST--
Session_004: Test getVar() method: success
--FILE--
<?php
include ('model/Session.php');

$session = new Session();

$_SESSION['id'] = 123456;
var_dump($session->getVar('id'));

?>
--EXPECT--
int(123456)
