--TEST--
IndexController_002: test the IndexAction() method: show login form
--FILE--
<?php
require_once('model/Session.php');
require_once('controller/IndexController.php');

$indexController = new IndexController();
$r  = $indexController->IndexAction();

?>
--EXPECT--
<html>

  <head>
    <title>Tee - Login</title>
  </head>

  <body>
    <h1>Login</h1>

    
    <form method="post" action="/index.php">
      Username <input type="text" name="username" value="" placeholder="username"><br>
      Password <input type="password" name="password" value="" placeholder="********"><br>
      <input type="hidden" name="to" value="">
      <input type="submit" name="send" value="Send">
    </form>
  </body>
</html>
