--TEST--
UserDao_003: Test the get() method with valid key
--FILE--
<?php
require_once('tests/mocks/UserMock.php');
require_once('tests/mocks/DummyDbMock.php');
require_once('model/UserDao.php');

$userDao = new UserDao();
var_dump($userDao->get('foo'));

?>
--EXPECT--
object(User)#2 (3) {
  ["username"]=>
  string(3) "foo"
  ["password"]=>
  string(4) "pass"
  ["roles"]=>
  array(1) {
    ["page1"]=>
    int(1)
  }
}
