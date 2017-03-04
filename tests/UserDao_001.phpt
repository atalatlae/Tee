--TEST--
UserDao_001: Test the constructor
--FILE--
<?php
require_once('model/User.php');
require_once('tests/mocks/DummyDbMock.php');
require_once('model/UserDao.php');

$userDao = new UserDao();
var_dump($userDao);
?>
--EXPECT--
object(UserDao)#1 (2) {
  ["storage":protected]=>
  array(1) {
    ["foo"]=>
    object(User)#2 (3) {
      ["username"]=>
      string(3) "foo"
      ["password"]=>
      string(3) "var"
      ["roles"]=>
      array(1) {
        ["page1"]=>
        int(1)
      }
    }
  }
  ["dataFile"]=>
  string(10) "userdb.txt"
}
