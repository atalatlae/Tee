--TEST--
UserDao_006: Test the exists() method with valid key
--FILE--
<?php
require_once('tests/mocks/UserMock.php');
require_once('tests/mocks/DummyDbMock.php');
require_once('model/UserDao.php');

$userDao = new UserDao();
var_dump($userDao->exists('noexists'));

?>
--EXPECT--
bool(false)
