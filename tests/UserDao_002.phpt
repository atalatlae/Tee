--TEST--
UserDao_002: Test the add() method
--FILE--
<?php
require_once('tests/mocks/UserMock.php');
require_once('tests/mocks/DummyDbMock.php');
require_once('model/UserDao.php');

$userDao = new UserDao();
$user = new User();

var_dump($userDao->count());
$userDao->add('buz', $user);
var_dump($userDao->count());

?>
--EXPECT--
int(1)
int(2)
