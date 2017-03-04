--TEST--
User_003: Test hasRole() method: return fale
--FILE--
<?php

require_once('model/User.php');

$user = new User('foo', 'pass', array('page1' => 1, 'page2' => 1));
var_dump($user->hasRole('page3'));
?>
--EXPECT--
bool(false)
