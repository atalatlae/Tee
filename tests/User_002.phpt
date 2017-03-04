--TEST--
User_002: Test hasRole() method: return true
--FILE--
<?php

require_once('model/User.php');

$user = new User('foo', 'pass', array('page1' => 1, 'page2' => 1));
var_dump($user->hasRole('page1'));
?>
--EXPECT--
bool(true)
