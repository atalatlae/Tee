--TEST--
UserDao_008: Test the create() method
--FILE--
<?php
require_once('tests/mocks/DummyDbMock.php');
require_once('model/User.php');
require_once('model/UserDao.php');

$userDao = new UserDao();
$user = new User('buz', '123123', array('page2' => 1));
$userDao->create($user);
var_dump($userDao->getAll());

?>
--EXPECT--
array(2) {
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
  ["buz"]=>
  object(User)#3 (3) {
    ["username"]=>
    string(3) "buz"
    ["password"]=>
    string(6) "123123"
    ["roles"]=>
    array(1) {
      ["page2"]=>
      int(1)
    }
  }
}
