--TEST--
UserDao_007: Test the getAll() method
--FILE--
<?php
require_once('tests/mocks/UserMock.php');
require_once('tests/mocks/DummyDbMock.php');
require_once('model/UserDao.php');

$userDao = new UserDao();
$user = new User('buz', '123123', array('page1' => 1));
$userDao->add('buz', $user);
var_dump($userDao->getAll());

?>
--EXPECT--
array(2) {
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
  ["buz"]=>
  object(User)#3 (3) {
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
