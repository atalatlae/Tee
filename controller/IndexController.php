<?php

class IndexController
{
  private $currentUser;

  public function __construct() {
    $session = new Session();
    $currentUser = $session->getVar('currentUser');

    if ($currentUser instanceof User) {
      $this->currentUser = $currentUser;
    }
  }

  public function IndexAction() {

    if (isset($_POST['send'])){
      $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
      $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
      $to = filter_input(INPUT_POST, 'to', FILTER_SANITIZE_STRING);

      $userDao = new UserDao();

      if ($userDao->exists($username)) {
        $user = $userDao->get($username);
        $hpassw = hash('sha256', $password);
        if ($user->password === $hpassw) {
          $session = new Session();
          $session->setVar('currentUser', $user);
          $session->setVar('lastAction', time());

          $destination = 'index.php';
          if ($to != '') {
            $destination .= $to;
          }

          header("Location: $destination");
          exit();

        }
        else {
          $message = "wrong user or password";
        }
      }
      else {
        $message = "wrong user or password";
      }

    }

    if ($this->currentUser instanceof User) {
      require_once('view/Index_Index.phtml');
    }
    else {
      if (isset($_GET['to'])) {
        $to = filter_input(INPUT_GET, 'to', FILTER_SANITIZE_STRING);
      }
      require_once('view/Index_Login.phtml');
    }
  }

  public function Page1Action() {
    $this->verifySession();
    $this->verifyPermissions('page1', '/Index/Page1');

    $user = $this->currentUser;

    require_once('view/Index_Page1.phtml');
  }

  public function Page2Action() {
    $this->verifySession();
    $this->verifyPermissions('page2', '/Index/Page2');

    $user = $this->currentUser;

    require_once('view/Index_Page2.phtml');
  }

  public function Page3Action() {
    $this->verifySession();
    $this->verifyPermissions('page3', '/Index/Page3');

    $user = $this->currentUser;

    require_once('view/Index_Page3.phtml');
  }

  public function LogoutAction($to = '') {
    $session = new Session();
    $session->destroy();
    $destination = '/index.php';

    if ($to != '') {
      $destination .= "?to=$to";
    }
    header('Location: '.$destination);
    exit();
  }

  private function unathorize() {
    header("HTTP/1.0 401 UNAUTHORIZED");
    require_once('view/unauthorize.phtml');
    exit();
  }

  private function verifySession() {
  }

  private function verifyPermissions($role = '', $to = '') {

    if ($this->currentUser instanceof User) {
      $user = $this->currentUser;

      if (!$user->hasRole($role)) {
        $this->unathorize();
      }
    }
    else {
      $this->LogoutAction($to);
    }
  }
}
