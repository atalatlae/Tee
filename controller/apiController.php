<?php

class   apiController
{
  private $username;
  private $password;

  public function __construct() {
    $this->username = $_SERVER['PHP_AUTH_USER'];
    $this->password = hash('sha256', $_SERVER['PHP_AUTH_PW']);
  }

  public function IndexAction() {
    $this->verifyPermissions();
    $this->outputAsJson(array());
  }

  public function UserAction() {
    $param = isset($this->params[0])?$this->params[0]:null;

    if ($param != '') {
      if ($this->requestIs('GET')) {
        $this->verifyPermissions();
        $this->username = $param;
        $this->getUser();
      }
      else if ($this->requestIs('DELETE')) {
        $this->verifyPermissions('admin');
        $this->username = $param;
        $this->deleteUser();
      }
      else if ($this->requestIs('PUT')) {
        $this->verifyPermissions('admin');
        $this->updateUser($param);
      }
      else {
        $this->methodNotAllowed();
      }
    }
    else {
      if ($this->requestIs('POST')) {
        $this->createUser();
      }
      else {
        $this->methodNotAllowed();
      }
    }

    $this->outputAsJson(array());
  }

  public function UsersAction() {
    if (!$this->requestIs('GET')) {
      $this->verifyPermissions();
      $this->methodNotAllowed();
    }

    $param = isset($this->params[0])?$this->params[0]:null;
    if ($param == 'all') {
      $this->verifyPermissions();
      $this->getAllUsers();
    }

    $this->outputAsJson(array());
  }

  private function outputAsJson($jsonArray, $httpCode = 200) {
    header("HTTP/1.1 $httpCode");
    header("Content-Type: application/json");
    echo json_encode($jsonArray);
    exit();
  }

  private function outputUnauthorize() {
    $jsonArray = array('result' => 'ERROR', 'message' => 'Unauthorized access');
    $this->outputAsJson($jsonArray, 401);
  }

  private function verifyPermissions($role = '') {

    $userDao = new userDao();
    $user = $userDao->get($this->username);

    if ($user instanceof User) {
      if ($role != '' && !$user->hasRole('admin')) {
        $this->outputUnauthorize();
      }

      if ($user->password != $this->password) {
        $this->outputUnauthorize();
      }
      return true;
    }
    $this->outputUnauthorize();
  }

  private function getUser() {
    $userDao = new UserDao();
    $user = $userDao->get($this->username);

    if ($user instanceof User) {
      $jsonArray = array(
        'username' => $user->username,
        'roles' => $user->roles
      );
      $httpCode = 200;
    }
    else {
      $jsonArray = array(
        'result' => 'ERROR',
        'message' => 'Username does not exist'
      );
      $httpCode = 404;
    }
    $this->outputAsJson($jsonArray, $httpCode);
  }

  private function createUser() {
    $userDao = new UserDao();

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $roles = $_POST['roles'];

    if ($username == '' || $password == '' || count($roles) == 0) {
      $jsonArray = array(
        'result' => 'ERROR',
        'message' => 'data missing'
      );
      $this->outputAsJson($jsonArray, 422);
    }

    if ($userDao->exists($username)) {
      $jsonArray = array(
        'result' => 'ERROR',
        'message' => 'User exists'
      );
      $this->outputAsJson($jsonArray, 409);
    }

    $password = hash('sha256', $password);
    $user = new User($username, $password, $roles);
    $r = $userDao->create($user);

    if ($r) {
      $jsonArray = array('result' => 'OK');
      $httpCode = 201;
    }
    else {
      $jsonArray = array(
        'result' => 'ERROR',
        'message' => 'There was an error creating the user'
      );
      $httpCode = 500;
    }
    $this->outputAsJson($jsonArray, $httpCode);
  }

  private function updateUser() {
    $userDao = new UserDao();

    $username = filter_input(INPUT_GET, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_GET, 'password', FILTER_SANITIZE_STRING);
    $roles = $_GET['roles'];

    if ($username == '' || $password == '' || count($roles) == 0) {
      $jsonArray = array(
        'result' => 'ERROR',
        'message' => 'data missing'
      );
      $this->outputAsJson($jsonArray, 422);
    }

    if (!$userDao->exists($username)) {
      $jsonArray = array(
        'result' => 'ERROR',
        'message' => 'User not exists'
      );
      $this->outputAsJson($jsonArray, 404);
    }

    $tmpRoles = array();
    foreach($roles as $r) {
      $tmpRoles[$r] = 1;
    }
    $roles = $tmpRoles;

    $password = hash('sha256', $password);
    $user = new User($username, $password, $roles);
    $r = $userDao->create($user);

    if ($r) {
      $jsonArray = array('result' => 'OK');
      $httpCode = 200;
    }
    else {
      $jsonArray = array(
        'result' => 'ERROR',
        'message' => 'There was an error updating the user'
      );
      $httpCode = 500;
    }
    $this->outputAsJson($jsonArray, $httpCode);
  }

  private function deleteUser() {
    $userDao = new UserDao();

    if (!$userDao->exists($this->username)) {
      $jsonArray = array(
        'result' => 'ERROR',
        'message' => 'Username does not exist'
      );
      $this->outputAsJson($jsonArray, 404);
    }

    $r = $userDao->delete($this->username);

    if ($r) {
      $jsonArray = array('result' => 'OK');
      $httpCode = 200;
    }
    else {
      $jsonArray = array(
        'result' => 'ERROR',
        'message' => 'There was an error deleting the user'
      );
      $httpCode = 500;
    }
    $this->outputAsJson($jsonArray, $httpCode);
  }

  private function getAllUsers() {
    if (!$this->requestIs('GET')) {
      $this->methodNotAllowed();
    }

    $userDao = new UserDao();
    $users = $userDao->getAll();

    $jsonArray = array();
    foreach($users as $u) {
      $user = array(
        'username' => $u->username,
        'roles' => $u->roles
      );

      $jsonArray[$u->username] = $user;
    }

    $this->outputAsJson($jsonArray);
  }

  private function requestIs($method) {
		$method = strtoupper($method);
		return ($_SERVER['REQUEST_METHOD'] == $method);
	}

  private function methodNotAllowed() {
    header("HTTP/1.0 405 METHOD NOT ALLOWED");
    exit();
  }
}
