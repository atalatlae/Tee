--TEST--
Session_005: Test getVar() method: invalid key
--FILE--
<?php
include ('model/Session.php');

$session = new Session();
var_dump($session->getVar('id'));

?>
--EXPECT--
NULL
