--TEST--
Session_003: Test setVar() method: empty name
--FILE--
<?php
include ('model/Session.php');

$session = new Session();
$session->setVar('', 123456);
var_dump($_SESSION);
?>
--EXPECT--
array(0) {
}
