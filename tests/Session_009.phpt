--TEST--
Session_009: Test refresh()
--FILE--
<?php
include ('model/Session.php');

$session = new Session(1);
$session->setVar('lastAction', 1);
$session->refresh();
$lastAction = $session->getVar('lastAction');

if ($lastAction > 1) {
  var_dump(true);
}
?>
--EXPECT--
bool(true)
