--TEST--
IndexController_004: test the Page1() method: expired session
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
$_SESSION['lastAction'] = time() - 301;
$_SESSION['currentUser'] = new User('p1', 'xxx', array('page1' => 1));

$indexController = new IndexController();
$indexController->Page1Action();

?>
--EXPECT--
<html>

  <head>
    <title>Tee - Login</title>
  </head>

  <body>
    <h1>Login</h1>

    <h3>Session expired</h3>
    <form method="post" action="/index.php">
      Username <input type="text" name="username" value="" placeholder="username"><br>
      Password <input type="password" name="password" value="" placeholder="********"><br>
      <input type="hidden" name="to" value="">
      <input type="submit" name="send" value="Send">
    </form>
  </body>
</html>
