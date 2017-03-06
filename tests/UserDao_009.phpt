--TEST--
UserDao_009: Test the delete() method
--FILE--
<?php
require_once('tests/mocks/UserMock.php');
require_once('tests/mocks/DummyDbMock.php');
require_once('model/UserDao.php');

$userDao = new UserDao();
var_dump($userDao->getAll());
$userDao->delete('foo');
var_dump($userDao->getAll());

?>
--EXPECT--
array(1) {
  ["foo"]=>
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
}
array(0) {
}
