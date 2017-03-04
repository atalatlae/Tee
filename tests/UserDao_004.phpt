--TEST--
UserDao_004: Test the get() method with invalid key
--FILE--
<?php
require_once('tests/mocks/UserMock.php');
require_once('tests/mocks/DummyDbMock.php');
require_once('model/UserDao.php');

$userDao = new UserDao();
var_dump($userDao->get('noexists'));

?>
--EXPECT--
NULL
