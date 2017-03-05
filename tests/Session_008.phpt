--TEST--
Session_008: Test isExpired(): expired
--FILE--
<?php
include ('model/Session.php');

$session = new Session(1);
$session->setVar('lastAction', time() - 70);
var_dump($session->isExpired());

?>
--EXPECT--
bool(true)
