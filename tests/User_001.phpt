--TEST--
User_0001: Test the constructor
--FILE--
<?php
require_once('model/User.php');

$user = new User('foo', 'pass', array('page1' => 1, 'page2' => 1));
var_dump($user);
?>
--EXPECT--
object(User)#1 (3) {
  ["username"]=>
  string(3) "foo"
  ["password"]=>
  string(4) "pass"
  ["roles"]=>
  array(2) {
    ["page1"]=>
    int(1)
    ["page2"]=>
    int(1)
  }
}
