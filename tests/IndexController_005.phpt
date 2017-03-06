--TEST--
IndexController_005: test the Page1() method: invalid role
--FILE--
<?php
error_reporting(E_ALL);

ini_set('error_reporting', -1);

require_once('model/DummyDb.php');
require_once('model/Session.php');
require_once('model/User.php');
require_once('model/UserDao.php');
require_once('controller/IndexController.php');

session_start();
$_SESSION['lastAction'] = time();
$_SESSION['currentUser'] = new User('p1', 'xxx', array('page2' => 1));

$indexController = new IndexController();
$indexController->Page1Action();

?>
--EXPECT--
<html>

  <head>
    <title>Tee - UNAUTHORIZED</title>
  </head>

  <body>
    <h1>UNAUTHORIZED ACCESS</h1>
  </body>
</html>
