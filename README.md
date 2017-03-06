# tee
__tee__ is a small application that use MVC design pattern to show how can manage access control to different user profiles and manage the users with a REST API.
## Instaling
__tee__ don't need special instalation just copy the content into a valid web content directory
## Running
__tee__ runs in any webserver that support PHP. The required version to run Tee is PHP 5.5 or greather. Also you can use PHP biuld-in server to tun tee.

```
$ cd tee/
$ php -S localhost:8080
PHP 5.5 Development Server started at Sun Mar 5 13:05:31 2017
Listening on http://localhost:8080
Document root is /home/foo/tee
Press Ctrl-C to quit.
```
Now, you can access with your browser to http://localhost:8080 and see the login page.

## Default Users ##
* P1
  * Username: p1
  * Password: 123123
  * Role: page1
  * User p1 only can access to "Page1"
* P2
  * Username: p2
  * Password: 123123
  * Role: page2
  * User p2 only can access to "Page2"
* P3
  * Username: p3
  * Password: 123123
  * Role: page3
  * User p3 only can access to "Page3"
* FULL
  * Username: full
  * Password: 123123
  * Role: page1, page2, page3
  * User p2 can access to Page1, Page2 and Page3
* Admin
  * Username: admin
  * Password: 123123
  * Role: page1, page2, page3, admin
  * User p2 can access to Page1, Page2, Page3 and full access to the API

## The API
__tee__ provided a RESTful API

### Authentication
__tee__ API use HTTP basic authentication. You can use the se users that the web front page.

### Endpoints
#### Get all users
* uri: /api/Users/all
* method: GET
* params: none

#### Get user
* uri: /api/User/{USERNAME}
* method: GET
* params: none

#### Create User
* uri: /api/User/
* method: POST
* params:
  * username: the name of the user
  * password: the password in plain text
  * roles: a list of roles that the user will have

#### Delete User
* uri: /api/User/{USERNAME}
* method: DELETE
* params: none

#### Update User
* uri: /api/User/{USERNAME}
* method: PUT
* params:
  * username: the name of the user
  * password: the password in plain text
  * roles: a list of roles that the user will have

## The tests
__tee__ provide a sort of unitary tests written with [PEAR framework](https://pear.php.net/).

### Dependencies
__tee__ tests require the use of PEAR framework. To install it, please read [the following instructions](https://pear.php.net/manual/en/installation.php).

### Running Test
run the __tee__ tests it's so easy. Simply go to the __tee__ root directory and run the following command
```
$ pear run-tests tests/
Running 26 tests
PASS [ 1/26] IndexController_001: test the constructor[tests/IndexController_001.phpt]
PASS [ 2/26] IndexController_002: test the IndexAction() method: show login form[tests/IndexController_002.phpt]
PASS [ 3/26] IndexController_003: test the Page1() method: valid session[tests/IndexController_003.phpt]
PASS [ 4/26] IndexController_004: test the Page1() method: expired session[tests/IndexController_004.phpt]
PASS [ 5/26] IndexController_005: test the Page1() method: invalid role[tests/IndexController_005.phpt]
PASS [ 6/26] Session_001: Test the constructor[tests/Session_001.phpt]
PASS [ 7/26] Session_002: Test setVar() method: success[tests/Session_002.phpt]
PASS [ 8/26] Session_003: Test setVar() method: empty name[tests/Session_003.phpt]
PASS [ 9/26] Session_004: Test getVar() method: success[tests/Session_004.phpt]
PASS [10/26] Session_005: Test getVar() method: invalid key[tests/Session_005.phpt]
PASS [11/26] Session_006: Test destroy() method[tests/Session_006.phpt]
PASS [12/26] Session_007: Test isExpired(): not expired[tests/Session_007.phpt]
PASS [13/26] Session_008: Test isExpired(): expired[tests/Session_008.phpt]
PASS [14/26] Session_009: Test refresh()[tests/Session_009.phpt]
PASS [15/26] UserDao_001: Test the constructor[tests/UserDao_001.phpt]
PASS [16/26] UserDao_002: Test the add() method[tests/UserDao_002.phpt]
PASS [17/26] UserDao_003: Test the get() method with valid key[tests/UserDao_003.phpt]
PASS [18/26] UserDao_004: Test the get() method with invalid key[tests/UserDao_004.phpt]
PASS [19/26] UserDao_005: Test the exists() method with valid key[tests/UserDao_005.phpt]
PASS [20/26] UserDao_006: Test the exists() method with valid key[tests/UserDao_006.phpt]
PASS [21/26] UserDao_007: Test the getAll() method[tests/UserDao_007.phpt]
PASS [22/26] UserDao_008: Test the create() method[tests/UserDao_008.phpt]
PASS [23/26] UserDao_009: Test the delete() method[tests/UserDao_009.phpt]
PASS [24/26] User_0001: Test the constructor[tests/User_001.phpt]
PASS [25/26] User_002: Test hasRole() method: return true[tests/User_002.phpt]
PASS [26/26] User_003: Test hasRole() method: return fale[tests/User_003.phpt]
TOTAL TIME: 00:01
26 PASSED TESTS
0 SKIPPED TESTS
```
