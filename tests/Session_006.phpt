--TEST--
Session_006: Test destroy() method
--FILE--
<?php
include ('model/Session.php');

$session = new Session();

var_dump(isset($_SESSION));
$session->destroy();
var_dump(isset($_SESSION));

?>
--EXPECT--
bool(true)
bool(false)
