--TEST--
Session_007: Test isExpired(): not expired
--FILE--
<?php
include ('model/Session.php');

$session = new Session();
$session->setVar('lastAction', time());
var_dump($session->isExpired());

?>
--EXPECT--
bool(false)
